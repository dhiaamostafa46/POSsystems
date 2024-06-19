<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\ProdUnit ;
use App\Models\Volume;
use App\Models\VolumeDetail;
use Exception;
use Illuminate\Http\Request;





class VolumeController extends Controller
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

       try
       {
            session()->put('page','products');
            session()->put('sub-page','Volume');
            $Volume = Volume::where('orgID',auth()->user()->orgID)->get();

            $Product =Product::where('orgID',auth()->user()->orgID)->where(function ($query) {$query->where('TypeProdect',1)->OrWhere('TypeProdect', 3);})->get();
        }
        catch(Exception $e)
        {

            session()->flash('faild',    trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

        return view('admin.Volume.index')->with('Volume',$Volume)->with('Product' ,  $Product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if(empty($request->Prodect)){
            session()->flash('faild', 'لا يوجد منتج');
            return redirect(url()->previous());
        }

        $store=Product::findorFail($request->Prodect);


        if(empty($store)){
            session()->flash('faild', 'تاكد من ادخال باركود المنتج');
            return redirect(url()->previous());
        }

        session()->put('page','products');
        session()->put('sub-page','Volume');
        try
        {
            $items_all = Product::where('status','1')->where('orgID',auth()->user()->orgID)->get();
            $items = Product::where('status','1')->where('orgID',auth()->user()->orgID)->pluck('nameAr');

            $Volume = Volume::where('orgID',auth()->user()->orgID)->where('ProdectID', $store->id)->first();
            if($Volume ==null)
            {
                $Flage=0;
            }else{
                $Flage=1;
            }


        }
        catch(Exception $e)
        {

            session()->flash('faild',  trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Volume.create')->with('store' ,  $store)->with('items',$items)->with('items_all',$items_all)->with('Volume',$Volume)->with('Flage',$Flage);
        //
    }



    public function getBarcode(Request $request,$id)
    {
        $items = Product::where('barcode',$id)->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();
        $br=Branch::findorFail(auth()->user()->branchID);
       $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId', $br->DepotStore[0]->id)->where('compon',1)->first();

       if($unit !=null){

        }else{

            $unit=ProdUnit::where('prodID',  $items[0]->id)->where('StoreId', $br->DepotStore[0]->id)->orderBy('id', 'DESC')->first();

        }

        $quantity = 1;
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
                 'unit'   =>  $unit->unitname,
                'CostStore'=>  $unit->costprodect,
                'unitcostid'=>  $unit->id,
                'countAll'=> ($unit->count+$unit->start+$unit->comeIn)-($unit->saller+$unit->Tainted+$unit->ComeOut+$unit->hang),
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


        try
        {
          // dd($request->all());
                //********* Insert Stockinout ************************ */
                if($request->Flage ==1)
                {
                     $Volume =Volume::findorFail($request->idVome);
                    $Volume->VolumeDetail()->delete();
                    // $bill->OrderinvDetails()->delete();
                }else{
                    $Volume = new Volume();
                }

                $Volume->orgID = auth()->user()->orgID;
                $Volume->branchID = auth()->user()->branchID;
                $Volume->userID = auth()->user()->id;
                $Volume->ProdectID = $request->From;
                $Volume->desc = $request->comment;
                $Volume->nameprodect = $request->FromName;
                $Volume->countVol = $request->count;
                $Volume->totalPrice = $request->TotalAlldata;

                $Volume->totalcost = $request->TotalAlldata;
                $Volume->totalguenty = $request->viewguenty;
                $Volume->costvol = $request->costAll;


                $Volume->save();
                $br=Branch::findorFail(auth()->user()->branchID);
                UniteVolume($request->From,$request->costAll, $br->DepotStore[0]->id);
                //*********** Insert Bill details ************** */
                $count = $request->count;
                $sum=0;
                for($i = 1;$i <= $count;$i++)
                {

                    if($request->input("item".$i))
                    {
                        $VolumeDetail = new VolumeDetail();
                        $VolumeDetail->orgID     =  auth()->user()->orgID;
                        $VolumeDetail->Quantity  =  $request->input("quantity".$i);
                        $VolumeDetail->ProdectId =  $request->input("item".$i);
                        $VolumeDetail->VolumeID  =  $Volume->id;
                        $VolumeDetail->QuantityTotal  = (float)$request->input("rtotalwvat".$i);
                        $VolumeDetail->unit  =   $request->input("unit".$i);
                        $VolumeDetail->coststore  =   $request->input("CostStore".$i);
                        $VolumeDetail->unitID  =   $request->input("unitid".$i);
                        $VolumeDetail->save();



                    }
                }
        }
        catch(Exception $e)
        {


            session()->flash('faild',   trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

             session()->flash('success',    trans('Dadhoard.Addedsuccessfully'));

               return redirect(route('Volume.index'));


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $vom=Volume::findorFail($id);
        session()->put('page','products');
        session()->put('sub-page','Volume');


        // dd($vom->VolumeDetail);
        return view('admin.Volume.show')->with('vom' ,  $vom);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        session()->put('page','products');
        session()->put('sub-page','Volume');
        try
        {
            $items_all = Product::where('status','1')->where('orgID',auth()->user()->orgID)->get();
            $items = Product::where('status','1')->where('orgID',auth()->user()->orgID)->pluck('nameAr');
            $Volume =Volume::findorFail($id);
        }
        catch(Exception $e)
        {

            session()->flash('faild',   trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Volume.edit')->with('items',$items)->with('items_all',$items_all)->with('Volume',$Volume)->with('Flage',1);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try
        {
          // dd($request->all());
                //********* Insert Stockinout ************************ */

                $Volume =Volume::findorFail($id);
                $Volume->desc = $request->comment;
                $Volume->countVol = $request->count;
                $Volume->totalPrice = $request->TotalAlldata;
                $Volume->totalcost = $request->TotalAlldata;
                $Volume->totalguenty = $request->viewguenty;
                $Volume->costvol = $request->costAll;
                $Volume->save();


                $br=Branch::findorFail(auth()->user()->branchID);
                UniteVolume($request->From,$request->costAll, $br->DepotStore[0]->id);
                //*********** Insert Bill details ************** */
                $Volume->VolumeDetail()->delete();
                $count = $request->count;
                $sum=0;
                for($i = 1;$i <= $count;$i++)
                {

                    if($request->input("item".$i))
                    {
                        $VolumeDetail = new VolumeDetail();
                        $VolumeDetail->orgID     =  auth()->user()->orgID;
                        $VolumeDetail->Quantity  =  $request->input("quantity".$i);
                        $VolumeDetail->ProdectId =  $request->input("item".$i);
                        $VolumeDetail->VolumeID  =  $Volume->id;
                        $VolumeDetail->QuantityTotal  = (float)$request->input("rtotalwvat".$i);
                        $VolumeDetail->unit  =   $request->input("unit".$i);
                        $VolumeDetail->coststore  =   $request->input("CostStore".$i);
                        $VolumeDetail->unitID  =   $request->input("unitid".$i);
                        $VolumeDetail->save();



                    }
                }
        }
        catch(Exception $e)
        {

            session()->flash('faild',  trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

        session()->flash('success',    trans('Dadhoard.Updatedsuccessfully'));
        return redirect(route('Volume.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
      try{


            $vom=Volume::findorFail($id);
            $vom->VolumeDetail()->delete();
            $vom->delete();
        }
        catch(Exception $e)
        {

            session()->flash('faild',    trans('Dadhoard.Deletionerror'));
            return redirect()->back();
       }
       session()->flash('success',    trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('Volume.index'));
    }
}
