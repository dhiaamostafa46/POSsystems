<?php

namespace App\Http\Controllers;

use App\Models\DepotStore;
use App\Models\IncomTransfers;
use App\Models\IncomTransfersDetials;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\Stock;
use App\Models\StoreConversion;
use App\Models\StoreConversiondetails;
use Exception;
use Illuminate\Http\Request;

class StoreConversionController extends Controller
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
        // $items = Product::where('barcode',"50003")->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();
        // dd(   $items[0]->stocks->where('orgID',auth()->user()->orgID)->where('depotID' ,'8'));

        session()->put('page', 'Stores');
        session()->put('sub-page', 'StoreConversion');
        try {
            $StoreConversion = StoreConversion::where('orgID', auth()->user()->orgID)
                ->orderBy('id', 'DESC')
                ->get();
            $DepotStore = DepotStore::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.StoreConversion.index')->with('StoreConversion', $StoreConversion)->with('DepotStore', $DepotStore);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function indextransfers()
    {
        //
        // $items = Product::where('barcode',"50003")->where('status',1)->where('orgID',auth()->user()->orgID)->take(1)->get();
        // dd(   $items[0]->stocks->where('orgID',auth()->user()->orgID)->where('depotID' ,'8'));

        session()->put('page', 'Stores');
        session()->put('sub-page', 'Intransfers');
        try {
            $StoreConversion = IncomTransfers::where('orgID', auth()->user()->orgID)
                ->orderBy('id', 'DESC')
                ->get();
            $DepotStore = DepotStore::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.transfers.index')->with('StoreConversion', $StoreConversion)->with('DepotStore', $DepotStore);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function getBarcodeIntransfers(Request $request, $id)
    {
        $items = StoreConversion::where('orgID', auth()->user()->orgID)
            ->where('branchTow', $id)
            ->where('status', '!=', 4)
            ->orderBy('id', 'DESC')
            ->get();
        $Stor = [];

        if (count($items) != 0) {
            foreach ($items as $row) {
                array_push($Stor, [$row->DepotStoreOne->name, $row->DepotStoretow->name]);
            }
        } else {
            return response()->json([
                'items' => 1,
                'Store' => 1,
                'flage' => 0,
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
                'Store' => $Stor,
                'flage' => 1,
            ]);
        }
    }
    public function getBarcode(Request $request, $id)
    {
        $items = Product::where('barcode', $id)
            ->where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->take(1)
            ->get();

        $quantity = 1;

        if (count($items) != 0) {
            $unit = ProdUnit::where('prodID', $items[0]->id)
                ->where('StoreId', $request->id)
                ->get();
            if (count($unit) == 0) {
                return response()->json([
                    'items' => 1,
                    'quantity' => 1,
                    'unit' => 1,
                    'flage' => 2,
                ]);
            }
        } else {
            return response()->json([
                'items' => 1,
                'quantity' => 1,
                'unit' => 1,
                'flage' => 0,
            ]);
        }

        if (count($items) == 0) {
            ///to get mizan parcode
            $code = substr($id, 2, 5);
            $items = Product::where('barcode', $code)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->take(1)
                ->get();
            if (count($items) > 0) {
                ///to get mizan quantity
                $quantity = number_format(substr($id, 7, 6) / 1000 / $items->first()->prodPrice, 2);
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
                'quantity' => $quantity,
                'unit' => $unit,
                'flage' => 1,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            //
            //  dd($request->all());
            $store = DepotStore::findorFail($request->AccountSelect);
            if (empty($store)) {
                session()->flash('faild', 'تأكد من رقم حساب المستودع');
                return redirect(url()->previous());
            }

            session()->put('page', 'Stores');
            session()->put('sub-page', 'StoreConversion');
            $items_all = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $depon = DepotStore::where('orgID', auth()->user()->orgID)->get();
            return view('admin.StoreConversion.create')->with('DepotStore', $depon)->with('store', $store)->with('items', $items)->with('items_all', $items_all);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function createTransfers($id)
    {
        //

        $store = StoreConversion::findorFail($id);
        if (empty($store)) {
            session()->flash('faild', 'تأكد من  رقم القيد ');
            return redirect(url()->previous());
        }

        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Intransfers');
            $items_all = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $depon = DepotStore::where('orgID', auth()->user()->orgID)->get();
            return view('admin.transfers.create')->with('DepotStore', $depon)->with('store', $store)->with('items', $items)->with('items_all', $items_all);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function StockSum(Request $request)
    {
        $Stock = Stock::groupBy('productID')
            ->where('productID', $request->id)
            ->where('orgID', auth()->user()->orgID)
            ->where('branchID', auth()->user()->branchID)
            ->selectRaw('sum(quantityIn) as sumIn ,sum(quantityOut) as sumout ,productID ')
            ->get();
        return response()->json(['count' => $Stock], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //''

        //  $data=explode("::", $request->input("unit1"));
        //  dd($data);
        $this->validate($request, [
            'TOStore' => 'required',
        ]);
        try {
            //********* Insert Stockinout ************************ */
            $StoreConversion = new StoreConversion();
            $StoreConversion->orgID = auth()->user()->orgID;
            $StoreConversion->branchOne = $request->From;
            $StoreConversion->branchTow = $request->TOStore;
            $StoreConversion->userID = auth()->user()->id;
            $StoreConversion->status = 1;
            $StoreConversion->comment = $request->comment;
            $StoreConversion->type = $request->type;
            $StoreConversion->items = $request->count;
            $StoreConversion->dateCon = $request->datetime;

            $StoreConversion->totalcost = $request->TotalAlldata;
            $StoreConversion->totalguenty = $request->viewguenty;
            $StoreConversion->costvol = $request->costAll;
            $StoreConversion->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;
            $sum = 0;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $data = explode('::', $request->input('unit' . $i));
                    $StoreConversiondetails = new StoreConversiondetails();
                    $StoreConversiondetails->idConvert = $StoreConversion->id;
                    $StoreConversiondetails->quantity = $request->input('quantity' . $i);
                    $StoreConversiondetails->productID = $request->input('item' . $i);
                    $StoreConversiondetails->nameprodect = $request->input('nameitems' . $i);
                    $StoreConversiondetails->priceprodect = 'dd';
                    $StoreConversiondetails->uniteid = $data[0];
                    $StoreConversiondetails->nameunitr = $data[3];
                    $StoreConversiondetails->indexunit = $data[1];
                    $StoreConversiondetails->status = 1;
                    $StoreConversiondetails->costprodect = $data[4];
                    $StoreConversiondetails->index = $request->input('index' . $i);
                    $StoreConversiondetails->oldquantity = $request->input('quantity' . $i);
                    $StoreConversiondetails->countprodect = $data[2];
                    $StoreConversiondetails->save();

                    /***************** Stock ************ */
                    //  UiteAllSub( $data[1],$request->input("item".$i) ,$data[4],$request->input("quantity".$i), $request->From);
                    //  UiteAllAdd( $data[1],$request->input("item".$i) ,$data[4],$request->input("quantity".$i), $request->TOStore);
                    UiteAllSellerStoreConversionsub($data[1], $request->input('item' . $i), $request->input('quantity' . $i), $request->From);

                    // UiteAllSellerStoreConversionadd($request->input("item".$i) ,$request->input("quantity".$i) , $request->TOStore);

                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityOut = $request->input('quantity' . $i);
                    $stock->comment = 'سحب من المخزون - ' . $request->comment;
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $request->From;
                    $stock->uniteid = $data[0];
                    $stock->indexunit = $data[1];
                    $stock->costUnit = $data[4];
                    $stock->kind = 2;
                    $stock->countprodect = $data[2];
                    $stock->save();

                    // $stock = new Stock();
                    // $stock->productID = $request->input("item".$i);
                    // $stock->quantityIn = $request->input("quantity".$i);

                    // $stock->comment = "اضافة للمخزون - ".$request->comment;
                    // $stock->userID = auth()->user()->id;
                    // $stock->branchID = auth()->user()->branchID;
                    // $stock->orgID = auth()->user()->orgID;
                    // $stock->depotID =    $request->TOStore;
                    // $stock->uniteid   =   $data[0];
                    // $stock->indexunit =   $data[1];
                    // $stock->costUnit  =   $data[4];
                    // $stock->save();
                }
            }

            //     $acou=$StoreConversion->DepotStoreOne->Accounting_guide->ReportData;
            //     $acou->creditSecond=$sum+$acou->creditSecond;
            //    // $acou->debitSecond=$sum+$acou->debitSecond;
            //     $acou->save();
            //     $acou=$StoreConversion->DepotStoretow->Accounting_guide->ReportData;
            //     // $acou->creditSecond=$sum+$acou->creditSecond;
            //     $acou->debitSecond=$sum+$acou->debitSecond;
            //     $acou->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return redirect(route('StoreConversion.index'));
    }

    public function storeIntransfers(Request $request)
    {
        //''

        $this->validate($request, [
            'TOStore' => 'required',
        ]);
        try {
            //********* Insert Stockinout ************************ */
            $StoreConversion = new IncomTransfers();
            $store = StoreConversion::findorFail($request->IdConvert);
            $StoreConversion->orgID = auth()->user()->orgID;
            $StoreConversion->branchOne = $request->From;
            $StoreConversion->branchTow = $request->TOStore;
            $StoreConversion->userID = auth()->user()->id;
            $StoreConversion->status = 2;
            $StoreConversion->comment = $request->comment;
            $StoreConversion->type = $request->type;
            $StoreConversion->items = $request->count;
            $StoreConversion->dateCon = $request->datetime;

            $StoreConversion->totalcost = $request->TotalAlldata;
            $StoreConversion->totalguenty = $request->viewguenty;
            $StoreConversion->costvol = $request->costAll;
            $StoreConversion->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;
            $sum = 0;
            $flageCoutINcom = 0;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $data = explode('::', $request->input('unit' . $i));
                    $Transfer = new IncomTransfersDetials();
                    $Transfer->idConvert = $StoreConversion->id;
                    $Transfer->quantity = $request->input('quantity' . $i);
                    $Transfer->productID = $request->input('item' . $i);
                    $Transfer->nameprodect = $request->input('nameitems' . $i);
                    $Transfer->priceprodect = 'dd';
                    $Transfer->uniteid = $data[0];
                    $Transfer->nameunitr = $data[3];
                    $Transfer->indexunit = $data[1];
                    $Transfer->status = 1;
                    $Transfer->costprodect = $data[4];
                    $Transfer->index = $request->input('index' . $i);
                    $Transfer->save();

                    foreach ($store->StoreConversiondetails as $items) {
                        if ($items->index == $Transfer->index) {
                            if ($Transfer->quantity == $items->quantity) {
                                $items->quantity = 0;
                                $items->save();
                            } elseif ($Transfer->quantity > $items->quantity) {
                                $flageCoutINcom = 1;
                                $items->quantity = $items->quantity - $Transfer->quantity;
                                $items->save();
                            } elseif ($Transfer->quantity < $items->quantity) {
                                $flageCoutINcom = 1;
                                $items->quantity = $items->quantity - $Transfer->quantity;
                                $items->save();
                            } else {
                                $flageCoutINcom = 1;
                                $items->quantity = $items->quantity - $Transfer->quantity;
                                $items->save();
                            }
                        }
                    }

                    /***************** Stock ************ */

                    UiteAllSellerStoreConversionadd($data[1], $request->input('item' . $i), $request->input('quantity' . $i), $request->TOStore);

                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityIn = $request->input('quantity' . $i);

                    $stock->comment = 'اضافة للمخزون - ' . $request->comment;
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $request->TOStore;
                    $stock->uniteid = $data[0];
                    $stock->indexunit = $data[1];
                    $stock->costUnit = $data[4];
                    $stock->kind = 3;
                    $stock->save();
                }
            }

            if ($flageCoutINcom == 0) {
                $store->status = 4;
                $store->Save();
                $tran = IncomTransfers::findorFail($StoreConversion->id);
                $tran->status = 4;
                $tran->Save();
            } else {
                $store->status = 2;
                $store->Save();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

        return redirect(route('Intransfers.index'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'StoreConversion');
            $StoreConversion = StoreConversion::findorFail($id);
            return view('admin.StoreConversion.show')->with('StoreConversion', $StoreConversion);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function showIntransfers(string $id)
    {
        //
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Intransfers');
            $StoreConversion = IncomTransfers::findorFail($id);
            return view('admin.transfers.show')->with('StoreConversion', $StoreConversion);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $store = StoreConversion::findorFail($id);
        if (empty($store)) {
            session()->flash('faild', 'تأكد من  رقم القيد ');
            return redirect(url()->previous());
        }

        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'Intransfers');
            $items_all = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $depon = DepotStore::where('orgID', auth()->user()->orgID)->get();
            return view('admin.StoreConversion.edit')->with('DepotStore', $depon)->with('store', $store)->with('items', $items)->with('items_all', $items_all);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
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

        try {
            $store = StoreConversion::findorFail($id);

            foreach ($store->StoreConversiondetails as $items) {
                $stock = new Stock();
                $stock->productID = $items->productID;
                $stock->quantityIn = $items->quantity;

                $stock->comment = ' إلغاء التحويل ';
                $stock->userID = auth()->user()->id;
                $stock->branchID = auth()->user()->branchID;
                $stock->orgID = auth()->user()->orgID;
                $stock->depotID = $store->branchOne;
                $stock->uniteid = $items->uniteid;
                $stock->indexunit = $items->indexunit;
                $stock->costUnit = $items->costprodect;
                $stock->kind = 2;

                $stock->save();

                UiteAllSellerStoreConversionadd($items->indexunit, $items->productID, $items->quantity, $store->branchOne);
            }

            $store->status = 3;
            $store->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
        return redirect(route('StoreConversion.index'));
    }
}
