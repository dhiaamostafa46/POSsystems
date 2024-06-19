<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Costcenteer;
use App\Models\CostStore;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Purchase;
use App\Models\Purchasedetails;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\ProdUnit;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Treasury;
use App\Services\MovementService;
use Exception;

class PurchasesController extends Controller
{
    private MovementService $movementService;

    public function __construct(MovementService $movementService)
    {
        $this->middleware('auth');
        $this->movementService = $movementService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            session()->put('page', 'purchases');
            session()->put('sub-page', 'purchasesList');
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $purchases = Purchase::where('status', '!=', 5)
                ->where('orgID', auth()->user()->orgID)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->orderBy('created_at', 'DESC')
                ->get();
            return view('admin.purchases.index', ['purchases' => $purchases, 'RoutAccount' => $RoutAccount]);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('page', 'purchases');
        session()->put('sub-page', 'purchasesList');

        try {
            $bank = Bank::where('orgID', auth()->user()->orgID)->count();
            $trueasy = Treasury::where('orgID', auth()->user()->orgID)->count();
            $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)->count();

            if ($bank == 0 || $trueasy == 0 || $DepotStore == 0) {
                session()->flash('faild', 'تأكد من   حساب بنكي او صندوق او مخزون ');
                return redirect(url()->previous());
            }

            $Supplier = Supplier::where('orgID', auth()->user()->orgID)->count();

            if ($Supplier == 0) {
                session()->flash('faild', 'لا يوجد موردين');
                return redirect(url()->previous());
            }

            session()->put('page', 'purchases');
            session()->put('sub-page', 'purchasesAdd');
            $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();

            if (auth()->user()->organization->activity === 3) {
                return view('admin.purchases.create_non-profit');
            } elseif (auth()->user()->organization->activity == 1) {
                return view('admin.purchases.createshop')->with('cost', $Cost);
            } else {
                $items_all = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');

                session()->put('page', 'purchases');
                return view('admin.purchases.create')->with('cost', $Cost)->with('items', $items)->with('items_all', $items_all);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function getBarcodepurches(Request $request, $id)
    {
        if (auth()->user()->organization->activity == 2) {
            $items = Product::where('barcode', $id)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeProdect', 2)
                ->take(1)
                ->get();
            if (count($items) > 0) {
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
        } else {
            $items = Product::where('barcode', $id)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->take(1)
                ->get();
            if (count($items) > 0) {
                $br = Branch::findorFail(auth()->user()->branchID);
                $unit = ProdUnit::where('prodID', $items[0]->id)
                    ->where('StoreId', $br->DepotStore[0]->id)
                    ->get();
            }
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

    public function getBarcode(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'items' => Product::where('barcode', $id)->get(),
            ]);
        }
    }

    public function totaldispuch()
    {
        try {
            $order = Purchase::all();
            foreach ($order as $items) {
                if ($items->discount != null || $items->discount != 0) {
                    $items->totaldis = $items->totalwvat - $items->totalwvat * ($items->discount / 100);
                    $items->save();
                } else {
                    $items->totaldis = $items->totalwvat;
                    $items->save();
                }
            }
            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsea
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplierID' => 'required',
            'type' => 'required',
        ]);
        try {
            $br = Branch::findorFail(auth()->user()->branchID);
            // 1 - فاتورة مشتريات
            // 2- مرتجع مشتريات
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            //********* Insert Purchase ************************ */

            $year = date('Y');
            $last_bill = Purchase::where('orgID', auth()->user()->orgID)
                ->orderBy('id', 'desc')
                ->whereYear('created_at', $year)
                ->first();

            if (!empty($last_bill->invoicesID)) {
                $bill_num = (int) $last_bill->invoicesID + 1;
            } else {
                $bill_num = 1;
            }
            // dd(strlen($bill_num));
            if (strlen($bill_num) == 1) {
                $bill_num = '00000' . $bill_num;
            }
            if (strlen($bill_num) == 2) {
                $bill_num = '0000' . $bill_num;
            }
            if (strlen($bill_num) == 3) {
                $bill_num = '000' . $bill_num;
            }
            if (strlen($bill_num) == 4) {
                $bill_num = '00' . $bill_num;
            }
            if (strlen($bill_num) == 5) {
                $bill_num = '0' . $bill_num;
            }

            $supplier = explode('::', $request->supplierID);
            $bill = new Purchase();
            $bill->supplierID = $supplier[0];
            $bill->invoicesID = $bill_num;
            $bill->serial = $request->serial;
            $bill->invoiceDate = $request->invoiceDate;
            $bill->payDate = $request->payDate;
            $bill->type = $request->type;
            $bill->discount = $request->Decscontall;
            $totals = 0;
            if ($request->Decscontall != null) {
                $totals = $request->totalwvat - $request->totalwvat * ($request->Decscontall / 100);
                $bill->totaldis = $totals;
            } else {
                $bill->totaldis = $request->totalwvat;
                $totals = $request->totalwvat;
            }
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->TypeFatorah;
            $bill->AccountPurch = $RoutAccount->purchases;
            // $bill->CostCenter = $request->costcenter;
            if ($request->type != 3) {
                $data = explode('::', $request->paymentTypeitems);
                $bill->NameAcount = $data[2];
                $bill->AccountID = $data[1];

                if ($request->TypeFatorah == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->purchases)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::findorFail($data[0]);
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                }
            } else {
                $bill->NameAcount = 'تكلفة مبيعات';
                $bill->AccountID = $supplier[1];

                if ($request->TypeFatorah == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->purchases)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $supplier[1])
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                }
            }

            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $data = explode('::', $request->input('unit' . $i));
                    $billdetails = new Purchasedetails();
                    $billdetails->purchaseID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->unitProdecid = $data[0];
                    $billdetails->idxUnit = $data[1];
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->kind = $request->TypeFatorah;
                    $billdetails->created_at = $request->invoiceDate;
                    $billdetails->save();

                    /***************** Stock ************ */

                    if ($request->TypeFatorah == 2) {
                        $stock = new Stock();
                        $stock->productID = $request->input('item' . $i);
                        $stock->quantityIn = $request->input('quantity' . $i);
                        $stock->purchaseID = $bill->id;
                        $stock->comment = 'فاتورة مشتريات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 9;
                        $stock->save();

                        UiteAllAdd($data[1], $request->input('item' . $i), $request->input('price' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return redirect(route('purchases.index', $bill->id));
    }

    public function store_enon_profit(Request $request)
    {
        try {
            //********* Insert Purchase ************************ */
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $available_balance = auth()->user()->organization->available_balance;

            $bill = new Purchase();
            $bill->supplierID = $request->supplierID;
            $bill->serial = $request->serial;
            $bill->invoiceDate = $request->invoiceDate;
            $bill->payDate = $request->payDate;
            $bill->type = $request->type;
            $bill->discount = $request->totaldiscount ?? 0;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->AccountPurch = $RoutAccount->purchases;
            $bill->save();
            $sum_totle = 0;
            foreach ($request->addMoreInputFields as $key => $value) {
                $billdetails = new Purchasedetails();
                $billdetails->productID = 0;
                $billdetails->purchaseID = $bill->id;
                $billdetails->item_name = $value['item_name'];
                $billdetails->quantity = $value['quantity'];
                $billdetails->price = $value['price'];
                $billdetails->discount = $value['discount'];
                $billdetails->userID = auth()->user()->id;
                $billdetails->branchID = auth()->user()->branchID;
                $billdetails->orgID = auth()->user()->orgID;
                $billdetails->save();

                $sum_totle += $value['totle'];
            }

            $this->movementService->MovementStore('مشتريات', auth()->user()->branchID, 1, $sum_totle, $available_balance, auth()->user()->orgID);

            return redirect(route('purchases.show', $bill->id));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function SearchAccount(Request $request)
    {
        $data = [];

        $data = Accounting_guide::where('SourceID', '=', $request->id)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        $count = Accounting_guide::where('SourceID', '=', $request->id)
            ->where('orgID', auth()->user()->orgID)
            ->count();

        return response()->json(['data' => $data, 'count' => $count]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $purchase = Purchase::findorFail($id);
            if (auth()->user()->organization->activity == 2) {
                return view('admin.purchases.showReturn')->with('purchase', $purchase);
            } else {
                return view('admin.purchases.showReturnshop')->with('purchase', $purchase);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function showprint($id)
    {
        try {
            $purchase = Purchase::findorFail($id);

            if (auth()->user()->organization->activity == 2) {
                return view('admin.purchases.show')->with('purchase', $purchase);
            } else {
                return view('admin.purchases.showshop')->with('purchase', $purchase);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function confirm($id)
    {
        try {
            $purchase = Purchase::findorFail($id);

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();

            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $RoutAccount->purchases)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->debitSecond = $purchase->totaldis + $RPtData->debitSecond;
            $RPtData->save();
            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $purchase->AccountID)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->creditSecond = $purchase->totaldis + $RPtData->creditSecond;
            $RPtData->save();

            $br = Branch::where('orgID', auth()->user()->orgID)->first();
            foreach ($purchase->purchasedetails as $items) {
                $stock = new Stock();
                $stock->productID = $items->productID;
                $stock->quantityIn = $items->quantity;
                $stock->purchaseID = $purchase->id;
                $stock->comment = 'فاتورة مشتريات';
                $stock->userID = auth()->user()->id;
                $stock->branchID = auth()->user()->branchID;
                $stock->orgID = auth()->user()->orgID;
                $stock->depotID = $br->DepotStore[0]->id;
                $stock->kind = 9;
                $stock->save();
                $items->kind = 2;
                $items->save();
                UiteAllAdd($items->idxUnit, $items->productID, $items->price, $items->quantity, $br->DepotStore[0]->id);
            }
            $purchase->kind = 2;
            $purchase->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        return redirect(route('purchases.index'));
    }

    public function createInvoice($id)
    {
        try {
            $purchase = Purchase::where('serial', $id)->first();
            if (empty($purchase)) {
                session()->flash('faild', 'تأكد من رقم فاتورة المشتريات');
                return redirect(url()->previous());
            }
            return view('admin.purchases.confirm')->with('purchase', $purchase);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $purchase = Purchase::findorFail($id);
            $items_all = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        if (auth()->user()->organization->activity == 2) {
            return view('admin.purchases.edit')->with('purchase', $purchase)->with('items', $items)->with('items_all', $items_all);
        } else {
            return view('admin.purchases.editshop')->with('purchase', $purchase)->with('items', $items)->with('items_all', $items_all);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $bill = Purchase::findorFail($id);
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $supplier = explode('::', $request->supplierID);
            $bill->supplierID = $supplier[0];
            $bill->supplierID = $request->supplierID;
            $bill->serial = $request->serial;
            $bill->invoiceDate = $request->invoiceDate;
            $bill->payDate = $request->payDate;
            $bill->type = $request->type;

            $bill->discount = $request->Decscontall;

            $totals = 0;
            if ($request->Decscontall != null) {
                $totals = $request->totalwvat - $request->totalwvat * ($request->Decscontall / 100);
                $bill->totaldis = $totals;
            } else {
                $bill->totaldis = $request->totalwvat;
                $totals = $request->totalwvat;
            }

            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->kind = $request->TypeFatorah;
            if ($request->type != 3) {
                $data = explode('::', $request->paymentTypeitems);
                $bill->NameAcount = $data[2];
                $bill->AccountID = $data[1];
                if ($request->TypeFatorah == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->purchases)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::findorFail($data[0]);
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                }
            } else {
                $bill->NameAcount = 'تكلفة مبيعات';
                $bill->AccountID = $supplier[1];

                if ($request->TypeFatorah == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->purchases)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $supplier[1])
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                }
            }
            $bill->save();

            $br = Branch::findorFail(auth()->user()->branchID);

            $count = $request->count;
            $bill->purchasedetails()->delete();
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $data = explode('::', $request->input('unit' . $i));
                    $billdetails = new Purchasedetails();
                    $billdetails->purchaseID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->unitProdecid = $data[0];
                    $billdetails->idxUnit = $data[1];
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->kind = $request->TypeFatorah;
                    $billdetails->created_at = $request->invoiceDate;
                    $billdetails->save();
                    /***************** Stock ************ */

                    if ($request->TypeFatorah == 2) {
                        $stock = new Stock();
                        $stock->productID = $request->input('item' . $i);
                        $stock->quantityIn = $request->input('quantity' . $i);
                        $stock->purchaseID = $bill->id;
                        $stock->comment = 'فاتورة مشتريات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 9;
                        $stock->save();
                        UiteAllAdd($data[1], $request->input('item' . $i), $request->input('price' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        return redirect(route('purchases.show', $bill->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $purchase = Purchase::findorFail($id);
            $purchasedetails = Purchasedetails::where('purchaseID', $id)->get();
            foreach ($purchasedetails as $details) {
                $details->delete();
            }
            $purchase->delete();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('purchases.index'));
    }
}
