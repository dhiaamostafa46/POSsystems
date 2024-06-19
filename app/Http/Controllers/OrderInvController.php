<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Costcenteer;
use App\Models\CostStore;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\Inv;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\OrderInv;
use App\Models\OrderinvDetails;
use App\Models\OrderRow;
use App\Models\OrderRowDetalis;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Treasury;
use Exception;
use Illuminate\Http\Request;

class OrderInvController extends Controller
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
        session()->put('page', 'orders');
        session()->put('sub-page', 'Salesinvoice');

        try {
            if (auth()->user()->organization->activity == 2) {
                $orders = OrderInv::where('nadel', null)
                    ->where('orgID', auth()->user()->orgID)

                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $orders = OrderInv::where('status', 1)
                    ->where('orgID', auth()->user()->orgID)

                    ->orderBy('id', 'desc')
                    ->get();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.orders.Invoices.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $bank = Bank::where('orgID', auth()->user()->orgID)->count();
            $trueasy = Treasury::where('orgID', auth()->user()->orgID)->count();
            $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)->count();

            if ($bank == 0 || $trueasy == 0 || $DepotStore == 0) {
                session()->flash('faild', 'تأكد من   حساب بنكي او صندوق او مخزون ');
                return redirect(url()->previous());
            }

            session()->put('page', 'orders');
            session()->put('sub-page', 'Salesinvoice');
            $items_all = Product::where('status', '1')->get();
            $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');

            if (auth()->user()->organization->activity == 2) {
                return view('admin.orders.Invoices.create')->with('cost', $Cost);
            } else {
                return view('admin.orders.Invoices.createshop')->with('cost', $Cost);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     *
     *
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //********* Insert Order ************************ */

        //         $unit=ProdUnit::where('prodID',  '1495')->get();

        try {
            $br = Branch::findorFail(auth()->user()->branchID);

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();

            $bill = new OrderInv();
            $bill->type = $request->type; //type=1 for cash ,2 shabaka,3 postPaid,4 cash & shabaka

            if (empty($request->customerID)) {
                $customer = Customer::where('name', 'عميل افتراضي')
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $customer = $customer->first();
                if (empty($customer)) {
                    $customer = new Customer();
                    $customer->name = 'عميل افتراضي ';
                    $customer->status = 1;

                    $customer->userID = auth()->user()->id;
                    $customer->branchID = auth()->user()->branchID;
                    $customer->orgID = auth()->user()->orgID;
                    $customer->AccountID = $RoutAccount->Customers . '00' . $count + 1;
                    $customer->save();
                    $yu = Accounting_guide::where('SourceID', '=', '124')
                        ->where('orgID', auth()->user()->orgID)
                        ->count();
                    $sum = $yu + 1;
                    $AccountingGuide = new Accounting_guide();
                    $AccountingGuide->AccountID = '12400' . $sum;
                    $AccountingGuide->AccountName = 'عميل افتراضي ';
                    $AccountingGuide->AccountNameEn = 'العملاء';
                    $AccountingGuide->type = 'العملاء';
                    $AccountingGuide->maxAccount = 0;
                    $AccountingGuide->minAccount = 0;
                    $AccountingGuide->Account_Source = 1;
                    $AccountingGuide->Account_status = 1;
                    $AccountingGuide->SourceID = '124';
                    $AccountingGuide->typeProcsss = 0;
                    $AccountingGuide->orgID = auth()->user()->orgID;
                    $AccountingGuide->save();
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
                }
            } elseif ($request->customerID == -1) {
                $yu = Accounting_guide::where('SourceID', '=', '124')
                    ->where('orgID', auth()->user()->orgID)
                    ->count();
                $sum = $yu + 1;
                $customer = new Customer();
                $customer->name = $request->customerName;
                $customer->vatNo = $request->customerVat;
                $customer->phone = $request->phoneVat;
                $customer->status = 1;
                $customer->userID = auth()->user()->id;
                $customer->branchID = auth()->user()->branchID;
                $customer->orgID = auth()->user()->orgID;
                $customer->AccountID = '12400' . $sum;
                $customer->save();
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = '12400' . $sum;
                $AccountingGuide->AccountName = $request->customerName;
                $AccountingGuide->AccountNameEn = 'العملاء';
                $AccountingGuide->type = 'العملاء';
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 1;
                $AccountingGuide->Account_status = 1;
                $AccountingGuide->SourceID = '124';
                $AccountingGuide->typeProcsss = 0;
                $AccountingGuide->orgID = auth()->user()->orgID;
                $AccountingGuide->save();
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
            } else {
                $customer = Customer::findorFail($request->customerID);
            }
            // dd($customer->id);

            if ($request->typeINV == 2) {
                $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
                if ($Inv == null) {
                    $Inv = new Inv();
                    $Inv->Inv = '1';
                    $Inv->orgID = auth()->user()->orgID;
                    $Inv->save();
                } else {
                    $Inv->Inv = $Inv->Inv + 1;
                    $Inv->save();
                }
                if (strlen($Inv->Inv) == 1) {
                    $bill_num = '00000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 2) {
                    $bill_num = '0000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 3) {
                    $bill_num = '000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 4) {
                    $bill_num = '00' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 5) {
                    $bill_num = '0' . $Inv->Inv;
                }

                $bill->serial = $bill_num;
            }

            $bill->customerID = $customer->id;

            $bill->type = $request->type;
            if ($request->type == 4) {
                $bill->cash = $request->cash;
                $bill->card = $request->card;
            } elseif ($request->type == 1) {
                $bill->cash = $request->totalwvat;
                $bill->card = 0;
            } elseif ($request->type == 2) {
                $bill->cash = 0;
                $bill->card = $request->totalwvat;
            }

            $bill->discount = $request->totaldiscount;
            $bill->ispaied = $request->Decscontall;
            $totals = 0;
            if ($request->Decscontall != null) {
                $bill->orderType = 3;

                $totals = $request->totalwvat - $request->totalwvat * ($request->Decscontall / 100);
                $bill->totaldis = $totals;
            } else {
                $bill->totaldis = $request->totalwvat;
                $totals = $request->totalwvat;
            }

            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            // $bill->durationID = auth()->user()->branch->durations->first()->id;
            //  $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->kind;
            $bill->created_at = $request->ordertime;
            // Kind 1 نافذة مبيعات  ,2 فاتورة مبيعات ,3 عرض سعر , 4 مرتجع مبيعات

            $bill->CostCenter = $request->costcenter;
            $bill->salaseAccount = $RoutAccount->sales;
            $bill->TypeInv = $request->typeINV;
            if ($request->type != 3) {
                $data = explode('::', $request->paymentTypeitems);
                $bill->NameAcount = $data[2];
                $bill->AccountID = $data[1];
                if ($request->typeINV == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->sales)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();

                    $acc = Accounting_guide::findorFail($data[0]);
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                }
            } else {
                $bill->NameAcount = 'اجل ';
                $bill->AccountID = $customer->AccountID;
                if ($request->typeINV == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->sales)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $customer->AccountID)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                }
            }

            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new OrderinvDetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->total = $request->input('rtotalwvat' . $i);
                    $billdetails->vat = $request->input('vatOrder' . $i);
                    $billdetails->desc = $request->input('desc' . $i);
                    $billdetails->kind = $request->typeINV;

                    if (auth()->user()->organization->activity != 2) {
                        $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i);
                    }

                    if ($request->input('discountval' . $i) == null) {
                        $billdetails->discount = 0;
                        if ($request->Decscontall == null) {
                            $bill = OrderInv::findOrFail($bill->id);
                            $bill->orderType = 1;
                            $bill->save();
                        }
                    } else {
                        $bill = OrderInv::findOrFail($bill->id);
                        $bill->orderType = 4;
                        $bill->save();
                        $billdetails->discount = $request->input('discountval' . $i);
                    }

                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();
                    /***************** Stock ************ */
                    // $this->checkStore($request->input("item".$i),$request->input("quantity".$i));//الفرتقة للكراتين و كدا
                    // ///add transaciions to stock table

                    if ($request->typeINV == 2) {
                        $stock = new Stock();
                        $stock->productID = $request->input('item' . $i);
                        $stock->quantityOut = $request->input('quantity' . $i);
                        $stock->orderID = $bill->id;
                        $stock->comment = 'فاتورة مبيعات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 7;
                        $stock->save();

                        UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));

            return redirect()->back();
        }

        return redirect(route('OrderInvoices.show', $bill->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $order = OrderInv::findorFail($id);
            if (auth()->user()->organization->activity == 2) {
                return view('admin.orders.Invoices.show')->with('order', $order);
            } else {
                return view('admin.orders.Invoices.showshop')->with('order', $order);
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function totaldis()
    {
        try {
            $order = OrderInv::all();
            foreach ($order as $items) {
                if ($items->ispaied != null || $items->ispaied != 0) {
                    $items->totaldis = $items->totalwvat - $items->totalwvat * ($items->ispaied / 100);
                    $items->save();
                } else {
                    $items->totaldis = $items->totalwvat;
                    $items->save();
                }
            }
            return back();
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function showInv(string $id)
    {
        //
        try {
            $order = OrderInv::findorFail($id);

            if (auth()->user()->organization->activity == 2) {
                return view('admin.orders.Invoices.showInv')->with('order', $order);
            } else {
                return view('admin.orders.Invoices.showInvshop')->with('order', $order);
            }
        } catch (\Exception $e) {
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
        session()->put('page', 'orders');
        session()->put('sub-page', 'Salesinvoice');
        try {
            $order = OrderInv::findorFail($id);
            $items_all = Product::where('status', '1')->get();
            $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');

            if (auth()->user()->organization->activity == 2) {
                return view('admin.orders.Invoices.edite')->with('cost', $Cost)->with('order', $order);
            } else {
                return view('admin.orders.Invoices.editeshop')->with('cost', $Cost)->with('order', $order);
            }
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
        //********* Insert Order ************************ */

        // dd($request->all());
        try {
            $br = Branch::findorFail(auth()->user()->branchID);
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();

            $bill = OrderInv::findorFail($id);
            $bill->type = $request->type; //type=1 for cash ,2 shabaka,3 postPaid,4 cash & shabaka

            if (empty($request->customerID)) {
                $customer = Customer::where('name', 'لا يوجد')
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $customer = $customer->first();
                if (empty($customer)) {
                    $customer = new Customer();
                    $customer->name = 'لا يوجد';
                    $customer->status = 1;

                    $customer->userID = auth()->user()->id;
                    $customer->branchID = auth()->user()->branchID;
                    $customer->orgID = auth()->user()->orgID;
                    $customer->AccountID = $RoutAccount->Customers . '00' . $count + 1;
                    $customer->save();
                    $yu = Accounting_guide::where('SourceID', '=', '124')
                        ->where('orgID', auth()->user()->orgID)
                        ->count();
                    $sum = $yu + 1;
                    $AccountingGuide = new Accounting_guide();
                    $AccountingGuide->AccountID = '12400' . $sum;
                    $AccountingGuide->AccountName = $request->customerName;
                    $AccountingGuide->AccountNameEn = 'العملاء';
                    $AccountingGuide->type = 'العملاء';
                    $AccountingGuide->maxAccount = 0;
                    $AccountingGuide->minAccount = 0;
                    $AccountingGuide->Account_Source = 1;
                    $AccountingGuide->Account_status = 1;
                    $AccountingGuide->SourceID = '124';
                    $AccountingGuide->typeProcsss = 0;
                    $AccountingGuide->orgID = auth()->user()->orgID;
                    $AccountingGuide->save();
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
                }
            } elseif ($request->customerID == -1) {
                $yu = Accounting_guide::where('SourceID', '=', '124')
                    ->where('orgID', auth()->user()->orgID)
                    ->count();
                $sum = $yu + 1;
                $customer = new Customer();
                $customer->name = $request->customerName;
                $customer->vatNo = $request->customerVat;
                $customer->phone = $request->phoneVat;
                $customer->status = 1;
                $customer->userID = auth()->user()->id;
                $customer->branchID = auth()->user()->branchID;
                $customer->orgID = auth()->user()->orgID;
                $customer->AccountID = '12400' . $sum;
                $customer->save();
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = '12400' . $sum;
                $AccountingGuide->AccountName = $request->customerName;
                $AccountingGuide->AccountNameEn = 'العملاء';
                $AccountingGuide->type = 'العملاء';
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 1;
                $AccountingGuide->Account_status = 1;
                $AccountingGuide->SourceID = '124';
                $AccountingGuide->typeProcsss = 0;
                $AccountingGuide->orgID = auth()->user()->orgID;
                $AccountingGuide->save();
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
            } else {
                $customer = Customer::findorFail($request->customerID);
            }
            // dd($customer->id);
            if ($request->typeINV == 2) {
                $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
                if ($Inv == null) {
                    $Inv = new Inv();
                    $Inv->Inv = '1';
                    $Inv->orgID = auth()->user()->orgID;
                    $Inv->save();
                } else {
                    $Inv->Inv = $Inv->Inv + 1;
                    $Inv->save();
                }
                if (strlen($Inv->Inv) == 1) {
                    $bill_num = '00000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 2) {
                    $bill_num = '0000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 3) {
                    $bill_num = '000' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 4) {
                    $bill_num = '00' . $Inv->Inv;
                }
                if (strlen($Inv->Inv) == 5) {
                    $bill_num = '0' . $Inv->Inv;
                }

                $bill->serial = $bill_num;
            }

            $bill->customerID = $customer->id;

            $bill->type = $request->type;
            if ($request->type == 4) {
                $bill->cash = $request->cash;
                $bill->card = $request->card;
            } elseif ($request->type == 1) {
                $bill->cash = $request->totalwvat;
                $bill->card = 0;
            } elseif ($request->type == 2) {
                $bill->cash = 0;
                $bill->card = $request->totalwvat;
            }

            $bill->discount = $request->totaldiscount;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->ispaied = $request->Decscontall;
            $totals = 0;
            if ($request->Decscontall != null) {
                $bill->orderType = 3;

                $totals = $request->totalwvat - $request->totalwvat * ($request->Decscontall / 100);
                $bill->totaldis = $totals;
            } else {
                $bill->totaldis = $request->totalwvat;
                $totals = $request->totalwvat;
            }
            // $bill->durationID = auth()->user()->branch->durations->first()->id;
            // $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->kind;
            $bill->created_at = $request->ordertime;
            // Kind 1 نافذة مبيعات  ,2 فاتورة مبيعات ,3 عرض سعر , 4 مرتجع مبيعات

            $bill->CostCenter = $request->costcenter;
            $bill->salaseAccount = $RoutAccount->sales;
            $bill->TypeInv = $request->typeINV;

            if ($request->type != 3) {
                $data = explode('::', $request->paymentTypeitems);
                $bill->NameAcount = $data[2];
                $bill->AccountID = $data[1];
                if ($request->typeINV == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->sales)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();
                    $acc = Accounting_guide::findorFail($data[0]);
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                }
            } else {
                $bill->NameAcount = 'اجل ';
                $bill->AccountID = $customer->AccountID;
                if ($request->typeINV == 2) {
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $RoutAccount->sales)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $totals + $RPtData->creditSecond;
                    $RPtData->save();

                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $customer->AccountID)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $totals + $RPtData->debitSecond;
                    $RPtData->save();
                }
            }
            $bill->save();
            //*********** Insert Bill details ************** */
            $count = $request->count;
            $bill->orderdetails()->delete();
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new OrderinvDetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->total = $request->input('rtotalwvat' . $i);
                    $billdetails->vat = $request->input('vatOrder' . $i);
                    $billdetails->desc = $request->input('desc' . $i);
                    $billdetails->kind = $request->typeINV;
                    if (auth()->user()->organization->activity != 2) {
                        $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i);
                    }
                    // $billdetails->totalcost = $request->input("cprice".$i) * $request->input("quantity".$i);

                    if ($request->input('discountval' . $i) == null || $request->input('discountval' . $i) == 0) {
                        $billdetails->discount = 0;
                        if ($request->Decscontall == null) {
                            $bill = OrderInv::findOrFail($bill->id);
                            $bill->orderType = 1;
                            $bill->save();
                        }
                    } else {
                        $bill = OrderInv::findOrFail($bill->id);
                        $bill->orderType = 4;
                        $bill->save();
                        $billdetails->discount = $request->input('discountval' . $i);
                    }

                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();
                    /***************** Stock ************ */

                    ///add transaciions to stock table

                    if ($request->typeINV == 2) {
                        $stock = new Stock();
                        $stock->productID = $request->input('item' . $i);
                        $stock->quantityOut = $request->input('quantity' . $i);
                        $stock->orderID = $bill->id;
                        $stock->comment = 'فاتورة مبيعات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 7;
                        $stock->save();

                        UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));

            return redirect()->back();
        }

        return redirect(route('OrderInvoices.show', $bill->id));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function confirm($id)
    {
        try {
            $order = OrderInv::findorFail($id);

            $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
            if ($Inv == null) {
                $Inv = new Inv();
                $Inv->Inv = '1';
                $Inv->orgID = auth()->user()->orgID;
                $Inv->save();
            } else {
                $Inv->Inv = $Inv->Inv + 1;
                $Inv->save();
            }
            if (strlen($Inv->Inv) == 1) {
                $bill_num = '00000' . $Inv->Inv;
            }
            if (strlen($Inv->Inv) == 2) {
                $bill_num = '0000' . $Inv->Inv;
            }
            if (strlen($Inv->Inv) == 3) {
                $bill_num = '000' . $Inv->Inv;
            }
            if (strlen($Inv->Inv) == 4) {
                $bill_num = '00' . $Inv->Inv;
            }
            if (strlen($Inv->Inv) == 5) {
                $bill_num = '0' . $Inv->Inv;
            }
            $order->serial = $bill_num;
            $order->TypeInv = 2;
            $order->save();
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في تغيرات على الفاتورة ');
            return redirect()->back();
        }
    }

    public function saveChange(Request $request)
    {
        try {
            $order = OrderInv::findorFail($request->idorder);
            $order->OrderRow()->delete();
            $order->OrderRowDetalis()->delete();
            $Count = $request->Rowcount;
            for ($i = 0; $i < (int) $Count; $i++) {
                $row = new OrderRow();
                $row->orgID = auth()->user()->orgID;
                $row->after = $request->rmove[$i][0];
                $row->sort = $request->valcode[$i][0];
                $row->nameAr = $request->head[$i][0];
                $row->nameEn = $request->headEn[$i][0];
                $row->orderId = $request->idorder;
                $row->save();
            }

            $Count = $request->count;
            for ($i = 0; $i < (int) $Count; $i++) {
                $roww = OrderRow::where('orgID', auth()->user()->orgID)
                    ->where('orderId', $request->idorder)
                    ->get();
                for ($j = 0; $j < count($roww); $j++) {
                    $name = $request->input($roww[$j]->sort)[$i];
                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $name[0];
                    $rowdetail->orderId = $request->idorder;
                    $rowdetail->orderrowid = $row->id;
                    $rowdetail->save();
                }
            }

            return redirect(route('OrderInvoices.ShowChang', $order->id));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في تغيرات على الفاتورة ');
            return redirect()->back();
        }
    }

    public function ShowChang($id)
    {
        try {
            $order = OrderInv::findorFail($id);

            return view('admin.orders.Invoices.ShowRow')->with('order', $order);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function showInfo(string $id)
    {
        //
        try {
            $data = [['رقم', 'index', 0, 'number'], ['اسم المنتج', 'name', 1, 'Name Prodect'], ['الكمية', 'quantity', 0, 'quantity'], ['سعر الحبة', 'price', 0, 'price'], ['الخصم (%)', 'discount', 0, 'discount'], ['قيمة الخصم', 'pricequantity', 0, 'Value discount'], ['الاجمالي قبل الضريبة', 'befortext', 1, 'befor Tax'], ['ضريبة القيمة المضافة', 'tax', 1, 'Tax'], ['الاجمالي شامل الضريبة', 'total', 1, 'Total']];

            $order = OrderInv::findorFail($id);

            $flage = 0;

            if (count($order->OrderRow) == 0) {
                foreach ($data as $index => $roww) {
                    foreach ($order->orderdetails as $sw => $items) {
                        if ($items->discount != 0) {
                            $flage = 1;
                        }
                    }

                    if ($index != 4 && $index != 5) {
                        $row = new OrderRow();
                        $row->orgID = auth()->user()->orgID;
                        $row->after = $roww[2];
                        $row->sort = $roww[1];
                        $row->nameAr = $roww[0];
                        $row->nameEn = $roww[3];
                        $row->orderId = $order->id;
                        $row->save();
                    } else {
                        if ($flage == 1) {
                            $row = new OrderRow();
                            $row->orgID = auth()->user()->orgID;
                            $row->after = $roww[2];
                            $row->sort = $roww[1];
                            $row->nameAr = $roww[0];
                            $row->nameEn = $roww[3];
                            $row->orderId = $order->id;
                            $row->save();
                        }
                    }
                }
            }

            if (count($order->OrderRowDetalis) == 0) {
                foreach ($order->orderdetails as $index => $items) {
                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $index;
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $items->productName;
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $items->quantity;
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $items->price;
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    if ($flage == 1) {
                        $rowdetail = new OrderRowDetalis();
                        $rowdetail->orgID = auth()->user()->orgID;
                        $rowdetail->after = 1;
                        $rowdetail->sort = 1;
                        $rowdetail->name = $items->discount;
                        $rowdetail->orderId = $order->id;
                        $rowdetail->orderrowid = $order->id;
                        $rowdetail->save();

                        $rowdetail = new OrderRowDetalis();
                        $rowdetail->orgID = auth()->user()->orgID;
                        $rowdetail->after = 1;
                        $rowdetail->sort = 1;
                        $rowdetail->name = $items->price * $items->quantity - $items->total;
                        $rowdetail->orderId = $order->id;
                        $rowdetail->orderrowid = $order->id;
                        $rowdetail->save();
                    }

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = $items->total;
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = number_format($items->total - $items->total / 1.15, 2);
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();

                    $rowdetail = new OrderRowDetalis();
                    $rowdetail->orgID = auth()->user()->orgID;
                    $rowdetail->after = 1;
                    $rowdetail->sort = 1;
                    $rowdetail->name = number_format($items->total - $items->total / 1.15 + $items->total, 2);
                    $rowdetail->orderId = $order->id;
                    $rowdetail->orderrowid = $order->id;
                    $rowdetail->save();
                }
            }

            $order = OrderInv::findorFail($id);
            return view('admin.orders.Invoices.showInvChange')->with('order', $order);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function Recovery($id)
    {
        try {
            $order = OrderInv::findorFail($id);

            $order->OrderRow()->delete();
            $order->OrderRowDetalis()->delete();

            return redirect(route('OrderInvoices.Showinvo', $order->id));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
