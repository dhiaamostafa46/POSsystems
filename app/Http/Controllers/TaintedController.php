<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\DepotStore;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\Stock;
use App\Models\Tainted;
use App\Models\TaintedDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TaintedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        session()->put('page','Stores');
        session()->put('sub-page','TaintedStore');
        try{
            $Tainted = Tainted::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $DepotStore = DepotStore::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            return view('admin.Tainted.index')->with('Tainted',$Tainted)->with('DepotStore',$DepotStore);;

        }
        catch(Exception $e)
        {

            session()->flash('faild',   trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

    }



    public function getBarcode(Request $request,$id)
    {
        $items = Product::where('barcode',$id)->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();

        $quantity = 1;

        if(count($items)!=0){
            $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId',$request->id)->orderBy('id', 'desc')->get();
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
     * Show the form for creating a new resource.
     */
      public function createTainted(Request $request)
    {
        //
        $store=DepotStore::findorFail($request->AccountSelect);
        if(empty($store)){
            session()->flash('faild', 'تأكد من رقم حساب المستودع');
            return redirect(url()->previous());
        }
        try{

            session()->put('page','Stores');
            session()->put('sub-page','TaintedStore');
            $items_all = Product::where('status','1')->where('orgID',auth()->user()->orgID)->get();
            $items = Product::where('status','1')->where('orgID',auth()->user()->orgID)->pluck('nameAr');

            $users = User::where('status',1)->where('orgID',auth()->user()->orgID)->get();

        }
        catch(Exception $e)
        {

            session()->flash('faild',     trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return view('admin.Tainted.create')->with('store' ,  $store)->with('User' , $users )->with('items',$items)->with('items_all',$items_all);;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

//   dd($request->all());



    try{

            $data=explode("::",  $request->reasonid);
            $Tainted = new Tainted();
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
                    $TaintedDetail = new TaintedDetail();
                    $TaintedDetail->idConvert =   $Tainted ->id;
                    $TaintedDetail->quantity = $request->input("quantity".$i);
                    $TaintedDetail->productID = $request->input("item".$i);
                    $TaintedDetail->nameprodect = $request->input("nameitems".$i);
                    $TaintedDetail->unitProdecid =   $data[0];
                    $TaintedDetail->priceprodect = "dd";
                    $TaintedDetail->AccountID = $request->From;
                    $TaintedDetail->dateTan =    $request->datetime;
                    $TaintedDetail->orgID =auth()->user()->orgID;
                    $TaintedDetail->reasonid   =    $data[0];
                    $TaintedDetail->reasonname =    $data[1];
                    $TaintedDetail->uniteid =  $dataunit[0];
                    $TaintedDetail->nameunitr =  $dataunit[3];
                    $TaintedDetail->indexunit = $dataunit[1];
                    $TaintedDetail->save();


                        /***************** Stock ************ */
                        $sum=  $sum+ $request->input("quantity".$i);
                        $stock = new Stock();
                        $stock->productID = $request->input("item".$i);
                        $stock->quantityOut = $request->input("quantity".$i);
                        $stock->comment = " مخزون تالف  - ".$request->comment;
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID =    $request->From;
                        $stock->uniteid   =   $dataunit[0];
                        $stock->indexunit =   $dataunit[1];
                        $stock->costUnit  =   $dataunit[4];
                        $stock->kind  =   4;
                        $stock->save();
                        TaintedUnite( $dataunit[1], $request->input("item".$i),$request->input("quantity".$i) ,$request->From);
                        // UiteAllSeller( $request->input("item".$i) ,$request->input("quantity".$i) ,$request->From);

                }
            }

            // $acou= $Tainted->DepotStoreOne->Accounting_guide->ReportData;
            // $acou->creditSecond=$sum+$acou->creditSecond;
            // $acou->save();

        }
        catch(Exception $e)
        {
            session()->flash('faild',  trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success',    trans('Dadhoard.Addedsuccessfully'));
       return redirect(route('Tainted.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try{
            session()->put('page','Stores');
            session()->put('sub-page','TaintedStore');
            $Tainted = Tainted::findorFail($id);

            return view('admin.Tainted.show')->with('Tainted',$Tainted);

        }
        catch(Exception $e)
        {
            session()->flash('faild',       trans('Dadhoard.Displayerror'));
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
