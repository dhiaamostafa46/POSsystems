<?php

namespace App\Http\Controllers;

use App\Models\Arrangement;
use App\Models\ArrangementDetails;
use App\Models\Branch;
use App\Models\CostStore;
use App\Models\DepotStore;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\Stock;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ArrangementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // $items = Product::where('barcode','50004')->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();

        // $br=Branch::findorFail(auth()->user()->branchID);
        // $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId', $br->DepotStore[0]->id)->orderBy('id', 'desc')->first();

        // dd(  $unit);
        session()->put('page','Stores');
        session()->put('sub-page','ArrangementStore');


        try{

            $DepotStore = DepotStore::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $Tainted = Arrangement::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            return view('admin.Arrangement.index')->with('Tainted',$Tainted)->with('DepotStore',$DepotStore);

        }
        catch(Exception $e)
        {

            session()->flash('faild',   trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create(Request $request)
    {
        //


        $store=DepotStore::findorFail($request->AccountSelect);
        if(empty($store)){
            session()->flash('faild', 'تأكد من رقم حساب المستودع');
            return redirect(url()->previous());
        }

        session()->put('page','Stores');
        session()->put('sub-page','ArrangementStore');

        try{
            $items_all = Product::where('status','1')->where('orgID',auth()->user()->orgID)->get();
            $items = Product::where('status','1')->where('orgID',auth()->user()->orgID)->pluck('nameAr');
            $users = User::where('status',1)->where('orgID',auth()->user()->orgID)->get();
        }
        catch(Exception $e)
        {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

        return view('admin.Arrangement.create')->with('store' ,  $store)->with('User' , $users )->with('items',$items)->with('items_all',$items_all);
    }







    public function getBarcode(Request $request,$id)
    {
        $items = Product::where('barcode',$id)->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();

        $quantity = 1;

        if(count($items)!=0){
            $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId',$request->id)->get();
            if( count($unit)==0){
                return response()->json([
                    'items' => 1,
                    'quantity' => 1,
                    'unit'    => 1,
                    'flage'    => 2,
                ]);
            }
        }else{
            return response()->json([
                'items' => 1,
                'quantity' => 1,
                'unit'    => 1,
                'flage'    => 0,
            ]);
        }

        if(count($items)==0){
            ///to get mizan parcode
            $code = substr($id,2,5);
            $items = Product::where('barcode',$code)->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();
            if(count($items)>0){
                ///to get mizan quantity
                $quantity = number_format((substr($id,7,6)/1000)/$items->first()->prodPrice,2);
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
                'quantity' => $quantity,
                'unit'    => $unit,
                'flage'    => 1,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



         try{
            $data=explode("::",  $request->reasonid);
            $Tainted = new Arrangement();
            $Tainted ->orgID = auth()->user()->orgID;
            $Tainted ->branch =  $request->From;
            $Tainted ->userID = auth()->user()->id;
            $Tainted ->status = 1;
            $Tainted ->comment = $request->comment;
            $Tainted ->type = $request->type;
            $Tainted ->items = $request->count;
            $Tainted ->dateCon = $request->datetime;
            $Tainted ->reasonid   = $data[0];
            $Tainted ->reasonname = $data[1];
            $Tainted ->save();




            //*********** Insert Bill details ************** */
            $count = $request->count;
            $sum=0;
            for($i = 1;$i <= $count;$i++)
            {

                if($request->input("item".$i))
                {

                    $dataunit=explode("::", $request->input("unit".$i));
                    $TaintedDetail = new ArrangementDetails();
                    $TaintedDetail->idConvert =   $Tainted ->id;
                    $TaintedDetail->quantity = $request->input("quantity".$i);
                    $TaintedDetail->productID = $request->input("item".$i);
                    $TaintedDetail->nameprodect = $request->input("nameitems".$i);
                    $TaintedDetail->priceprodect = "dd";
                    $TaintedDetail->AccountID = $request->FromAccount;
                    $TaintedDetail->dateTan =  $request->datetime;
                    $TaintedDetail->orgID =auth()->user()->orgID;
                    $TaintedDetail->reasonid   =    $data[0];
                    $TaintedDetail->reasonname =    $data[1];
                    $TaintedDetail->process =   $request->input("NotArrag".$i);
                    $TaintedDetail->countActive =   $request->input("Countitems".$i);
                    $TaintedDetail->uniteid =  $dataunit[0];
                    $TaintedDetail->nameunitr =  $dataunit[4];
                    $TaintedDetail->indexunit = $dataunit[1];
                    $TaintedDetail->costprodect = $dataunit[3];
                    $TaintedDetail->save();



                       // UiteAllSellerArrangement($request->input("item".$i) , $request->input("quantity".$i) ,$request->From ,$request->input("NotArrag".$i));
                       Arrangementunit($dataunit[1],$request->input("item".$i), $request->input("Countitems".$i),$request->input("quantity".$i), $request->From,  $request->input("NotArrag".$i),$dataunit[3]);


                    if($request->input("quantity".$i) < $request->input("Countitems".$i)){
                        /***************** Stock ************ */
                        $count =$request->input("Countitems".$i) - $request->input("quantity".$i) ;
                        $stock = new Stock();
                        $stock->productID = $request->input("item".$i);
                        $stock->quantityOut = $count;
                        $stock->comment = "  تسوية مخزون  عجز مخوون  - ".$request->comment;
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID =    $request->From;
                        $stock->uniteid   =   $dataunit[0];
                        $stock->indexunit =   $dataunit[1];
                        $stock->costUnit  =   $dataunit[3];
                          $stock->kind  =   5;
                        $stock->save();

                    }else if($request->input("quantity".$i) > $request->input("Countitems".$i)){

                        /***************** Stock ************ */
                        $count =$request->input("quantity".$i) - $request->input("Countitems".$i);
                        $sum=  $sum+ $request->input("quantity".$i);
                        $stock = new Stock();
                        $stock->productID = $request->input("item".$i);
                        $stock->quantityIn =$count;
                        $stock->comment = " تسوية مخزون  فائض في المخزون    - ".$request->comment;
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID =    $request->From;
                        $stock->uniteid   =   $dataunit[0];
                        $stock->indexunit =   $dataunit[1];
                        $stock->costUnit  =   $dataunit[3];
                          $stock->kind  =   5;
                        $stock->save();

                    }


                }
            }

        // $acou= $Tainted->DepotStoreOne->Accounting_guide->ReportData;
        // $acou->creditSecond=$sum+$acou->creditSecond;
        // $acou->save();

        }
        catch(Exception $e)
        {

            session()->flash('faild',   trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }


       session()->flash('success',     trans('Dadhoard.Addedsuccessfully'));
       return redirect(route('Arrangement.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            session()->put('page','Stores');
            session()->put('sub-page','ArrangementStore');
            $Tainted = Arrangement::findorFail($id);
            // dd(    $Tainted->ArrangementDetails[0]->product->unitprobreanch );
        // $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId', $Tainted->branch)->orderBy('id', 'desc')->first();
            return view('admin.Arrangement.show')->with('Tainted',$Tainted);
        }
        catch(Exception $e)
        {
          
            session()->flash('faild',  trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
