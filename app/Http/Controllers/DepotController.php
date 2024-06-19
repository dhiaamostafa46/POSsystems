<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Branch;
use App\Models\CostStore;
use App\Models\DepotStore;
use App\Models\Organization;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Stockinout;
use App\Models\Stockinoutdetails;
use Exception;
use Illuminate\Http\Request;

class DepotController extends Controller
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
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'itemsStock');
            $DepotStore = DepotStore::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.depotStore.index')->with('DepotStore', $DepotStore);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $branch = Organization::findorFail(auth()->user()->orgID);
            return view('admin.depotStore.create', ['branch' => $branch]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function StockDepotcreate()
    {
        try {
            $items_all = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $DepotStore = DepotStore::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.depotStore.stocks.create')->with('DepotStore', $DepotStore)->with('items', $items)->with('items_all', $items_all);
    }

    public function getBarcode(Request $request, $id)
    {
        $items = Product::where('barcode', $id)
            ->where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->take(1)
            ->get();

        if (count($items) != 0) {
            $br = Branch::findorFail(auth()->user()->branchID);
            $unit = ProdUnit::where('prodID', $items[0]->id)
                ->where('StoreId', $br->DepotStore[0]->id)
                ->get();
        } else {
            return response()->json([
                'items' => 1,
                'quantity' => 1,
                'unit' => 1,
                'flage' => 0,
            ]);
        }
        $quantity = 1;
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

    public function StockDepot()
    {
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'openStore');

            // $DepotStore =DepotStore::findorFail($id);
            // $Stock =Stock::groupBy('productID')->where('depotID',$id)->where('orgID',auth()->user()->orgID)->where('branchID',auth()->user()->branchID)->selectRaw('sum(quantityIn) as sumIn ,sum(quantityOut) as sumout ,productID ')->get();
            // return view('admin.depotStore.stocks.index' ,['DepotStore'=>$DepotStore ,'products'=>$Stock]);

            $DepotStore = Stockinout::where('orgID', auth()->user()->orgID)->get();
            return view('admin.depotStore.stocks.index', ['DepotStore' => $DepotStore]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd( $request->all());
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'branchID' => 'required',
        ]);

        try {
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Store)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $yu = Accounting_guide::where('SourceID', '=', $RoutAccount->Store)
                ->where('orgID', auth()->user()->orgID)
                ->count();

            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID = $Account->AccountID . '00' . $yu + 1;
            $AccountingGuide->AccountName = $request->name;
            $AccountingGuide->AccountNameEn = $request->name;
            $AccountingGuide->type = $Account->AccountName;
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount = 0;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->Account_status = 1;
            $AccountingGuide->SourceID = $Account->AccountID;
            $AccountingGuide->typeProcsss = 0;
            $AccountingGuide->orgID = auth()->user()->orgID;
            $AccountingGuide->save();

            $bank = new DepotStore();
            $bank->AccountID = $Account->AccountID . '00' . $yu + 1;
            $bank->name = $request->name;
            $bank->status = $request->status;
            $bank->main = $request->SourceAccount;
            $bank->branchID = $request->branchID;
            $bank->orgID = auth()->user()->orgID;
            $bank->GuidesID = $AccountingGuide->id;
            $bank->date = date('Y-m-d');
            $bank->save();

            $ReportData = new ReportData();
            $ReportData->orgID = auth()->user()->orgID;
            $ReportData->debitFrist = 0;
            $ReportData->creditFrist = 0;
            $ReportData->debitSecond = 0;
            $ReportData->creditSecond = 0;
            $ReportData->debitThird = 0;
            $ReportData->creditThird = 0;
            $ReportData->AccountID = $AccountingGuide->id;
            $ReportData->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('depotStore.index'));
    }

    public function StockDepotstore(Request $request)
    {
        //

        try {
            //********* Insert Stockinout ************************ */
            $stockinout = new Stockinout();
            $stockinout->comment = $request->comment;
            $stockinout->type = $request->type;
            $stockinout->userID = auth()->user()->id;
            $stockinout->branchID = auth()->user()->branchID;
            $stockinout->orgID = auth()->user()->orgID;
            $stockinout->depotID = $request->branchID;
            $stockinout->status = 1;
            $stockinout->items = $request->count;
            $stockinout->date = $request->datatime;

            $stockinout->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            $sum = 0;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $data = explode('::', $request->input('unit' . $i));
                    $stockinoutdetails = new Stockinoutdetails();
                    $stockinoutdetails->stockinoutID = $stockinout->id;
                    $stockinoutdetails->productID = $request->input('item' . $i);
                    $stockinoutdetails->quantity = $request->input('quantity' . $i);
                    $stockinoutdetails->unitProdecid = $data[0];
                    $stockinoutdetails->userID = auth()->user()->id;
                    $stockinoutdetails->branchID = auth()->user()->branchID;
                    $stockinoutdetails->orgID = auth()->user()->orgID;
                    $stockinoutdetails->depotID = $request->branchID;

                    $stockinoutdetails->save();
                    UiteAllAddStart($data[1], $request->input('item' . $i), $request->input('rtotalwvat' . $i), $request->input('quantity' . $i), $request->branchID);

                    /***************** Stock ************ */
                    $sum = $sum + $request->input('quantity' . $i);
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    if ($request->type == 1) {
                        $stock->quantityIn = $request->input('quantity' . $i);
                        $stock->quantityOut = 0;
                        $stock->comment = ' رصيد اففتاحي - ' . $request->comment;
                    } else {
                        $stock->quantityIn = 0;
                        $stock->quantityOut = $request->input('quantity' . $i);
                        $stock->comment = 'سحب من المخزون - ' . $request->comment;
                    }
                    $stock->stockinoutID = $stockinout->id;

                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $request->branchID;
                    $stock->uniteid = $data[0];
                    $stock->indexunit = $data[1];
                    $stock->costUnit = $data[2];
                    $stock->kind = 1;
                    $stock->countprodect = $data[3];
                    $stock->save();
                }
            }

            //*********** ReportData   ************** */
            //  $acou=$stockinout->DepotStore->Accounting_guide->ReportData;
            //  $acou->debitFrist=$sum+$acou->debitSecond;
            //  $acou->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
        return redirect(route('StockDepot.index', $request->branchID));
    }

    public function show($id)
    {
        //
        try {
            session()->put('page', 'Stores');
            session()->put('sub-page', 'itemsStock');

            $unit = ProdUnit::where('StoreId', $id)->groupBy('prodID')->get();
            // //   $DepotStore =DepotStore::findorFail($id);
            // $Stock =Stock::groupBy('productID')->where('depotID',$id)->where('orgID',auth()->user()->orgID)->where('branchID',auth()->user()->branchID)->selectRaw('sum(quantityIn) as sumIn ,sum(quantityOut) as sumout ,productID ')->get();
            // return view('admin.depotStore.showcount' ,['DepotStore'=>$DepotStore ,'products'=>$Stock]);
            return view('admin.depotStore.showcount', ['unit' => $unit]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function StockDepotshow(string $id)
    {
        //
        session()->put('page', 'Stores');
        session()->put('sub-page', 'openStore');

        try {
            $Stockinout = Stockinout::findorFail($id);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.depotStore.stocks.show', ['Stockinout' => $Stockinout]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $DepotStore = DepotStore::findorFail($id);
            $branch = Organization::findorFail(auth()->user()->orgID);
            return view('admin.depotStore.edit', ['DepotStore' => $DepotStore, 'branch' => $branch]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'branchID' => 'required',
        ]);

        try {
            $bank = DepotStore::findorFail($id);
            $bank->name = $request->name;
            $bank->status = $request->status;
            $bank->main = $request->SourceAccount;
            $bank->branchID = $request->branchID;
            $bank->save();

            $AccountingGuide = Accounting_guide::where('AccountID', $bank->AccountID)
                ->where('orgID', auth()->user()->orgID)
                ->FirstorFail();
            $AccountingGuide->AccountName = $request->name;
            $AccountingGuide->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('depotStore.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
