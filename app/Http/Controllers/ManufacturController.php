<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\DepotStore;
use App\Models\Manufactur;
use App\Models\Manufacturdetials;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\Stock;
use App\Models\Volume;
use Exception;
use Illuminate\Http\Request;

class ManufacturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ددد

        session()->put('page', 'Stores');
        session()->put('sub-page', 'Manufactur');
        try {
            $Manufactur = Manufactur::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'DESC')
                ->get();
            $DepotStore = DepotStore::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Volume = Volume::where('orgID', auth()->user()->orgID)->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Manufactur.index')->with('Manufactur', $Manufactur)->with('Volume', $Volume)->with('DepotStore', $DepotStore);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        try {
            //  dd( $request->all());
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Manufactur');
            $Volume = Volume::findorFail($request->Prodect);
            // $br=Branch::findorFail(auth()->user()->branchID);
            $DepotStore = DepotStore::findorFail($request->AccountSelect);
            $unit = ProdUnit::where('prodID', $Volume->ProdectID)
                ->where('StoreId', $request->AccountSelect)
                ->get();
            //    $uu= $Volume->VolumeDetail[0]->product->unitprodect->where('StoreId',$request->AccountSelect)->where('id',$Volume->VolumeDetail[0]->unitID)->first();
            //  dd(   $uu->saller);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Manufactur.newCreate')->with('Volume', $Volume)->with('unit', $unit)->with('DepotStore', $DepotStore);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            //  dd($request->all());

            //********* Insert Stockinout ************************ */
            $Manufactur = new Manufactur();
            $Manufactur->orgID = auth()->user()->orgID;
            $Manufactur->branchID = auth()->user()->branchID;
            $Manufactur->productID = $request->idprodect;
            $Manufactur->desc = $request->desc;
            $Manufactur->Quantity = $request->viewguenty;
            $Manufactur->VolumeID = $request->idvom;
            $Manufactur->nameprodect = $request->prodectname;
            $Manufactur->unit = $request->Unit;
            $Manufactur->kind = $request->kind;
            $Manufactur->date = $request->date;
            $Manufactur->totalcost = $request->TotalAlldata;
            $Manufactur->storeid = $request->storeid;

            $Manufactur->save();

            if ($request->kind == 2) {
                Manufacturunit($request->idprodect, $request->viewguenty, $request->storeid);
            }

            // UiteAllAdd( $data[1], $request->idprodect, $request->input("price".$i), $request->Quantity , $br->DepotStore[0]->id);

            //*********** Insert Bill details ************** */

            $count = $request->Count;
            for ($i = 1; $i <= $count; $i++) {
                $VolumeDetail = new Manufacturdetials();
                $VolumeDetail->orgID = auth()->user()->orgID;
                $VolumeDetail->Quantity = $request->input('quantity' . $i);
                $VolumeDetail->ProdectId = $request->input('item' . $i);
                $VolumeDetail->VolumeID = $Manufactur->id;
                $VolumeDetail->QuantityTotal = (float) $request->input('rtotalwvat' . $i);
                $VolumeDetail->unit = $request->input('unit' . $i);
                $VolumeDetail->coststore = $request->input('CostStore' . $i);
                $VolumeDetail->storeid = $request->storeid;
                $VolumeDetail->save();

                if ($request->kind == 2) {
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityOut = $request->input('quantity' . $i);
                    $stock->comment = 'أمر تصنيع ';
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $request->storeid;
                    $stock->kind = 6;
                    $stock->save();

                    UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $request->storeid);
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return redirect(route('Manufactur.index'));
    }

    public function confirm(string $id)
    {
        try {
            $br = Branch::findorFail(auth()->user()->branchID);
            $Manufactur = Manufactur::findorFail($id);
            $Manufactur->kind = 2;
            $Manufactur->save();
            Manufacturunit($Manufactur->productID, $Manufactur->Quantity, $Manufactur->storeid);

            foreach ($Manufactur->Manufacturdetials as $items) {
                $stock = new Stock();
                $stock->productID = $items->ProdectId;
                $stock->quantityOut = $items->Quantity;
                $stock->comment = 'أمر تصنيع ';
                $stock->userID = auth()->user()->id;
                $stock->branchID = auth()->user()->branchID;
                $stock->orgID = auth()->user()->orgID;
                $stock->depotID = $items->storeid;
                $stock->kind = 6;
                $stock->save();

                UiteAllSeller($items->ProdectId, $items->Quantity, $items->storeid);
            }
            return redirect(route('Manufactur.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Manufactur');
            $vom = Manufactur::findorFail($id);

            //  dd(   $vom->Unit);
            // dd($vom->VolumeDetail);
            return view('admin.Manufactur.show')->with('vom', $vom);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Manufactur');
            $vom = Manufactur::findorFail($id);
            $br = Branch::findorFail(auth()->user()->branchID);
            $unit = ProdUnit::where('prodID', $vom->productID)
                ->where('StoreId', $br->DepotStore[0]->id)
                ->get();
            //  dd(   $vom->Unit);
            // dd($vom->VolumeDetail);
            return view('admin.Manufactur.newedit')->with('Volume', $vom)->with('unit', $unit);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try {
            //   dd($request->all());
            //********* Insert Stockinout ************************ */
            $Manufactur = Manufactur::findorFail($id);
            $Manufactur->desc = $request->desc;
            $Manufactur->Quantity = $request->viewguenty;
            $Manufactur->nameprodect = $request->prodectname;
            $Manufactur->unit = $request->Unit;
            $Manufactur->kind = $request->kind;
            $Manufactur->date = $request->date;
            $Manufactur->totalcost = $request->TotalAlldata;
            $Manufactur->save();

            //*********** Insert Bill details ************** */

            $br = Branch::findorFail(auth()->user()->branchID);
            if ($request->kind == 2) {
                Manufacturunit($request->idprodect, $request->viewguenty, $br->DepotStore[0]->id);
            }
            $Manufactur->Manufacturdetials()->delete();
            $count = $request->Count;
            for ($i = 1; $i <= $count; $i++) {
                $VolumeDetail = new Manufacturdetials();
                $VolumeDetail->orgID = auth()->user()->orgID;
                $VolumeDetail->Quantity = $request->input('quantity' . $i);
                $VolumeDetail->ProdectId = $request->input('item' . $i);
                $VolumeDetail->VolumeID = $Manufactur->id;
                $VolumeDetail->QuantityTotal = (float) $request->input('rtotalwvat' . $i);
                $VolumeDetail->unit = $request->input('unit' . $i);
                $VolumeDetail->coststore = $request->input('CostStore' . $i);
                $VolumeDetail->save();

                if ($request->kind == 2) {
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityOut = $request->input('quantity' . $i);
                    $stock->comment = 'أمر تصنيع ';
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $br->DepotStore[0]->id;
                    $stock->kind = 6;
                    $stock->save();

                    UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

        return redirect(route('Manufactur.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
