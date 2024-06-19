<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Costcenteer;
use App\Models\CostStore;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\Stock;
use App\Models\Extra;
use App\Models\extrasdetials;
use App\Models\Inv;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Tbl;
use App\Models\Treasury;
use App\Models\VirtualAccounts;
use App\Models\Volume;
use Exception;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'billsList');
            if (auth()->user()->organization->activity == 2) {
                $orders = Order::where('nadel', null)
                    ->where('orgID', auth()->user()->orgID)
                    ->where('created_at', '>=', session('dateFrom'))
                    ->where('created_at', '<', session('dateTo'))
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $orders = Order::where('status', 1)
                    ->where('orgID', auth()->user()->orgID)
                    ->where('created_at', '>=', session('dateFrom'))
                    ->where('created_at', '<', session('dateTo'))
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));

            return redirect()->back();
        }
        return view('admin.orders.index')->with('orders', $orders);
    }
    /**
     * Display a listing of the resource.
     *
     *
     */

    public function ChangeTable(Request $request)
    {
        try {
            $order = Order::findorFail($request->idOrder);
            $order->tblNo = $request->Tableid;
            $order->save();
            session()->flash('success', 'تم تحويل الطلب بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا  في تحويل الطاولة');
            return redirect()->back();
        }
    }




    public function Orderdept()
    {

        $order = Order::all();
        foreach( $order  as $items){

                $items->totaldis= $items->totalwvat ;
                $items->save();

        }
        return  back();
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function ordersToday()
    {
        try {
            date_default_timezone_set('Asia/Riyadh');
            $date = date('Y-m-d h:i:s');
            $prev_date = date('Y-m-d h:i:s', strtotime($date . ' -1 day'));

            //   dd(   $prev_date );
            session()->put('page', 'orders');
            session()->put('sub-page', 'ordersToday');

            $orders = Order::where('orgID', auth()->user()->orgID)
                ->whereDate('created_at', '>', $prev_date)
                ->whereDate('created_at', '<=', $date)
                ->orderBy('id', 'DESC')
                ->get();
            $table = Tbl::where('branchID', auth()->user()->branchID)->get();
            return view('admin.orders.today')->with('orders', $orders)->with('table', $table);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function AjaxOrderToday()
    {
        $orders = Order::where('orgID', auth()->user()->orgID)
            ->where('created_at', '>=', session('dateFrom'))
            ->where('created_at', '<', session('dateTo'))
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json(['data' => $orders], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $bank = Bank::where('orgID', auth()->user()->orgID)->count();
            $trueasy = Treasury::where('orgID', auth()->user()->orgID)->count();
            $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)->count();

            if ($bank == 0 || $trueasy == 0 || $DepotStore == 0) {
                session()->flash('faild', 'تأكد من   حساب بنكي او صندوق او مخزون ');
                return redirect(url()->previous());
            }
            session()->put('page', 'orders');
            session()->put('sub-page', 'billsCreate');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.create')->with('items', $items)->with('items_all', $items_all);
            } else {
                //  branchID
                $tbls = Tbl::where('status', 1)
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $prds = Product::where(function ($query) {
                    $query->where('TypeProdect', 2)->Where('saleable', 1)->orWhere('TypeProdect', 1);
                })
                    ->where('orgID', auth()->user()->orgID)
                    ->get();

                return view('admin.orders.createForRestaurant')->with('table', $tbls)->with('prds', $prds);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function InvoicesCreate()
    {
        try {
            $bank = Bank::where('orgID', auth()->user()->orgID)->count();
            $trueasy = Treasury::where('orgID', auth()->user()->orgID)->count();
            $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)->count();

            if ($bank == 0 || $trueasy == 0 || $DepotStore == 0) {
                session()->flash('faild', 'تأكد من   حساب بنكي او صندوق او مخزون ');
                return redirect(url()->previous());
            }

            session()->put('page', 'orders');
            session()->put('sub-page', 'billsList');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')->get();
                $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.Invoices.create')->with('items', $items)->with('items_all', $items_all)->with('cost', $Cost);
            } else {
                //  branchID
                $tbls = Tbl::where('status', 1)
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                return view('admin.orders.createForRestaurant')->with('table', $tbls);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     *
     */

    public function SalesReturnsIndex()
    {
        session()->put('page', 'orders');
        session()->put('sub-page', 'SalesReturnsIndex');
        $orders = Order::where('status', 1)
            ->where('kind', '=', '4')
            ->where('orgID', auth()->user()->orgID)
            ->where('created_at', '>=', session('dateFrom'))
            ->where('created_at', '<', session('dateTo'))
            ->get();

        return view('admin.orders.Return.index')->with('orders', $orders);
    }

    /**
     * Display a listing of the resource.
     *
     *
     */

    public function SalesReturnsCreate()
    {
        session()->put('page', 'orders');
        session()->put('sub-page', 'SalesReturnsIndex');

        $items_all = Product::where('status', '1')->get();
        $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
        $items = Product::where('status', '1')
            ->where('orgID', auth()->user()->orgID)
            ->pluck('nameAr');
        return view('admin.orders.Return.create')->with('items', $items)->with('items_all', $items_all)->with('cost', $Cost);
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function getBarcode(Request $request, $id)
    {
        if (auth()->user()->organization->activity == 2) {
            $items = Product::where('barcode', $id)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeProdect', 1)
                ->take(1)
                ->get();
        } else {
            $items = Product::where('barcode', $id)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->take(1)
                ->get();
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

            return response()->json([
                'items' => 1,
                'quantity' => 1,
                'flage' => 0,
            ]);
        }
        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
                'quantity' => $quantity,
                'flage' => 1,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function getExtras(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'items' => Extra::where('productID', $id)->get(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //********* Insert Order ************************ */

        //  dd( $request->all());

        try {
            $br = Branch::findorFail(auth()->user()->branchID);

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

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();

            $bill = new Order();
            $bill->type = $request->type; //type=1 for cash ,2 shabaka,3 postPaid,4 cash & shabaka

            if (empty($request->customerID)) {
                $customer = Customer::where('name', 'عميل افتراضي')
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $customer = $customer->first();
                if (empty($customer)) {
                    $yu = Accounting_guide::where('SourceID', '=', '124')
                        ->where('orgID', auth()->user()->orgID)
                        ->count();
                    $customer = new Customer();
                    $customer->name = 'عميل افتراضي ';
                    $customer->status = 1;
                    $customer->userID = auth()->user()->id;
                    $customer->branchID = auth()->user()->branchID;
                    $customer->orgID = auth()->user()->orgID;
                    $customer->AccountID = $RoutAccount->Customers . '00' . $yu + 1;
                    $customer->save();

                    $sum = $yu + 1;
                    $AccountingGuide = new Accounting_guide();
                    $AccountingGuide->AccountID = '12400' . $sum;
                    $AccountingGuide->AccountName = 'عميل افتراضي ';
                    $AccountingGuide->AccountNameEn = 'عميل افتراضي ';
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
                $customer->AccountID = $RoutAccount->Customers . '00' . $count + 1;
                $customer->save();
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = '12400' . $sum;
                $AccountingGuide->AccountName = $request->customerName;
                $AccountingGuide->AccountNameEn = $request->customerName;
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
            $bill->customerID = $customer->id;
            $bill->serial = $bill_num;
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
            $bill->totaldis=  $request->totalwvat;
            // $bill->durationID = auth()->user()->branch->durations->first()->id;
            $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->kind;

            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            if ($request->type == 121) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $bill->salaseAccount = $Vir->sale;
                $bill->cash = $request->totalwvat;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();

                $bill->NameAcount = 'نافذة بيع';
                $bill->AccountID = $Vir->treasury;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->treasury)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            } elseif ($request->type == 122) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $bill->salaseAccount = $Vir->sale;
                $bill->card = $request->totalwvat;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();

                $bill->NameAcount = 'نافذة بيع';
                $bill->AccountID = $Vir->bank;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->bank)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            } elseif ($request->type == 7) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                if ($request->NetMulti == null) {
                    $bill->card = 0;
                } else {
                    $bill->card = $request->NetMulti;
                    $bill->AccountID = $Vir->bank.'-'.$Vir->treasury;
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $Vir->bank)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $request->card + $RPtData->debitSecond;
                    $RPtData->save();
                }
                if ($request->CashMulti == null) {
                    $bill->cash = 0;
                } else {
                    $bill->cash = $request->CashMulti;
                    $bill->AccountID = $Vir->bank.'-'.$Vir->treasury;
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $Vir->treasury)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $request->cash + $RPtData->debitSecond;
                    $RPtData->save();
                }

                $bill->salaseAccount = $Vir->sale;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();
                $bill->NameAcount = 'نافذة بيع';
            }

            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------

            if ($request->type == 3) {
                $bill->TypeInv = 1;
            } else {
                $bill->TypeInv = 2;
            }

            $bill->save();
            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Orderdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->total = $request->input('price' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                    $billdetails->kind = 2;
                    if (auth()->user()->organization->activity != 2) {
                        $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i);
                    }

                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();
                    /***************** Stock ************ */
                    //   $this->checkStore($request->input("item".$i),$request->input("quantity".$i));//الفرتقة للكراتين و كدا
                    ///add transaciions to stock table

                    if ($request->type != 3) {
                        $vol = Volume::where('ProdectID', $billdetails->productID)->first();
                        if ($vol != null) {
                            foreach ($vol->VolumeDetail as $Items) {
                                $stock = new Stock();
                                $stock->productID = $Items->ProdectId;
                                $stock->quantityOut = $Items->Quantity * (float) $request->input('quantity' . $i);
                                $stock->orderID = $bill->id;
                                $stock->comment = 'نافذة مبيعات';
                                $stock->userID = auth()->user()->id;
                                $stock->branchID = auth()->user()->branchID;
                                $stock->orgID = auth()->user()->orgID;
                                $stock->depotID = $br->DepotStore[0]->id;
                                $stock->kind = 7;
                                $stock->save();

                                UiteAllSeller($Items->ProdectId, $Items->Quantity * (float) $request->input('quantity' . $i), $br->DepotStore[0]->id);
                            }
                        } else {
                            $stock = new Stock();
                            $stock->productID = $request->input('item' . $i);
                            $stock->quantityOut = $request->input('quantity' . $i);
                            $stock->orderID = $bill->id;
                            $stock->comment = 'نافذة مبيعات';
                            $stock->userID = auth()->user()->id;
                            $stock->branchID = auth()->user()->branchID;
                            $stock->orgID = auth()->user()->orgID;
                            $stock->depotID = $br->DepotStore[0]->id;
                            $stock->kind = 7;
                            $stock->save();

                            UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                        }
                        $vol = null;
                    }

                    // UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    // $stock = new Stock();
                    // $stock->productID = $request->input('item' . $i);
                    // $stock->quantityOut = $request->input('quantity' . $i);
                    // $stock->orderID = $bill->id;
                    // $stock->comment = 'نافذة مبيعات';
                    // $stock->userID = auth()->user()->id;
                    // $stock->branchID = auth()->user()->branchID;
                    // $stock->orgID = auth()->user()->orgID;
                    // $stock->depotID = $br->DepotStore[0]->id;
                    // $stock->kind = 7;
                    // $stock->save();
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        if(empty(auth()->user()->organization->vatNo) )
        {
             session()->flash('faild', 'تم حفظ الفاتورة لكن لا يوجد رقم ضريبي للمنشأة');
             return redirect()->back();
        }

        return redirect(route('orders.show', $bill->id));
    }

    public function storeRest(Request $request)
    {
        // dd($request->all());

        try {
            //********* Insert Order ************************ */
            $year = date('Y');
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

            $bill = new Order();
            $bill->type = $request->type;

            if (empty($request->customerID)) {
                $customer = Customer::where('name', 'عميل افتراضي ')
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $customer = $customer->first();
                if (empty($customer)) {
                    $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
                    $yu = Accounting_guide::where('SourceID', '=', '124')
                        ->where('orgID', auth()->user()->orgID)
                        ->count();
                    $customer = new Customer();
                    $customer->name = 'عميل افتراضي ';
                    $customer->status = 1;
                    $customer->userID = auth()->user()->id;
                    $customer->branchID = auth()->user()->branchID;
                    $customer->orgID = auth()->user()->orgID;
                    $customer->AccountID = $RoutAccount->Customers . '00' . $yu + 1;
                    $customer->save();

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
            } else {
                $customer = Customer::findorFail($request->customerID);
            }

            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            if ($request->type == 121) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $bill->salaseAccount = $Vir->sale;
                $bill->cash = $request->totalwvat;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();

                $bill->NameAcount = 'نافذة بيع';
                $bill->AccountID = $Vir->treasury;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->treasury)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            } elseif ($request->type == 122) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $bill->salaseAccount = $Vir->sale;
                $bill->card = $request->totalwvat;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();

                $bill->NameAcount = 'نافذة بيع';
                $bill->AccountID = $Vir->bank;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->bank)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            } elseif ($request->type == 7) {
                $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                if ($request->NetMulti == null) {
                    $bill->card = 0;
                } else {
                    $bill->card = $request->NetMulti;
                    $bill->AccountID = $Vir->bank;
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $Vir->bank)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $request->card + $RPtData->debitSecond;
                    $RPtData->save();
                }
                if ($request->CashMulti == null) {
                    $bill->cash = 0;
                } else {
                    $bill->cash = $request->CashMulti;
                    $bill->AccountID = $Vir->treasury;
                    $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                        ->where('AccountID', '=', $Vir->treasury)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $request->cash + $RPtData->debitSecond;
                    $RPtData->save();
                }

                $bill->salaseAccount = $Vir->sale;
                $bill->CostCenter = $Vir->costcenter;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $Vir->sale)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();
                $bill->NameAcount = 'نافذة بيع';
            }

            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------

            $bill->customerID = $customer->id;
            $bill->serial = $bill_num;
            $bill->type = $request->type;
            $bill->orderType = $request->orderType;
            $bill->tblNo = $request->tblNo;
            $bill->discount = $request->totaldiscount;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->totaldis=  $request->totalwvat;
            $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->userID = auth()->user()->id;
            $bill->ordBy = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            if ($request->type == 3) {
                $bill->TypeInv = 1;
            } else {
                $bill->TypeInv = 2;
            }
            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;
            $br = Branch::findorFail(auth()->user()->branchID);
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Orderdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->kitchenID = $request->input('kitchenID' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->total = $request->input('price' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                    $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->Extracount = $request->input('Exitetcount' . $i);
                    $billdetails->Extratotal = $request->input('Exitetprice' . $i);
                    if ($request->type == 3) {
                        $billdetails->kind = 1;
                    } else {
                        $billdetails->kind = 2;
                    }

                    $billdetails->save();

                    if ($request->input('Exitetcount' . $i) != 0) {
                        $countExtra = (int) $request->input('Exitetcount' . $i);
                        for ($im = 1; $im <= $countExtra; $im++) {
                            $extra = new extrasdetials();
                            $extra->userID = auth()->user()->id;
                            $extra->orgID = auth()->user()->orgID;
                            $extra->productID = $request->input('extraitem' . $i . '-' . $im);
                            $extra->nameAr = $request->input('extraname' . $i . '-' . $im);
                            $extra->price = $request->input('extrapriceItems' . $i . '-' . $im);
                            $extra->IDorder = $billdetails->id;
                            $extra->quantity = $request->input('quantity' . $i . '-' . $im);
                            $extra->save();

                            if ($request->type != 3) {
                                $stock = new Stock();
                                $stock->productID = $request->input('extraitem' . $i . '-' . $im);
                                $stock->quantityOut = $request->input('quantity' . $i . '-' . $im);
                                $stock->orderID = $bill->id;
                                $stock->comment = 'نافذة مبيعات';
                                $stock->userID = auth()->user()->id;
                                $stock->branchID = auth()->user()->branchID;
                                $stock->orgID = auth()->user()->orgID;
                                $stock->depotID = $br->DepotStore[0]->id;
                                $stock->kind = 7;
                                $stock->save();

                                UiteAllSeller($request->input('extraitem' . $i . '-' . $im), $request->input('quantity' . $i . '-' . $im), $br->DepotStore[0]->id);
                            }
                        }
                    }

                    if ($request->type != 3) {
                        $vol = Volume::where('ProdectID', $billdetails->productID)->first();
                        //    $vol = $billdetails->product->Volume->VolumeDetail;
                        if ($vol != null) {
                            foreach ($vol->VolumeDetail as $Items) {
                                $stock = new Stock();
                                $stock->productID = $Items->ProdectId;
                                $stock->quantityOut = $Items->Quantity * (float) $request->input('quantity' . $i);
                                $stock->orderID = $bill->id;
                                $stock->comment = 'نافذة مبيعات';
                                $stock->userID = auth()->user()->id;
                                $stock->branchID = auth()->user()->branchID;
                                $stock->orgID = auth()->user()->orgID;
                                $stock->depotID = $br->DepotStore[0]->id;
                                $stock->kind = 7;
                                $stock->save();

                                UiteAllSeller($Items->ProdectId, $Items->Quantity * (float) $request->input('quantity' . $i), $br->DepotStore[0]->id);
                            }
                        } else {
                            $stock = new Stock();
                            $stock->productID = $request->input('item' . $i);
                            $stock->quantityOut = $request->input('quantity' . $i);
                            $stock->orderID = $bill->id;
                            $stock->comment = 'نافذة مبيعات';
                            $stock->userID = auth()->user()->id;
                            $stock->branchID = auth()->user()->branchID;
                            $stock->orgID = auth()->user()->orgID;
                            $stock->depotID = $br->DepotStore[0]->id;
                            $stock->kind = 7;
                            $stock->save();

                            UiteAllSeller($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                        }
                        $vol = null;
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

        if(empty(auth()->user()->organization->vatNo) )
        {
             session()->flash('faild', 'تم حفظ الفاتورة لكن لا يوجد رقم ضريبي للمنشأة');
             return redirect()->back();
        }
        if ($request->type != 3) {
            return redirect(route('orders.show', $bill->id));
        } else {
            return redirect()->back();
        }
    }

    function getQr($seller, $tax, $tim, $total, $vat)
    {
        $result1 = bin2hex($seller);
        $result2 = bin2hex($tax);
        $result3 = bin2hex($tim);
        $result4 = bin2hex($total);
        $result5 = bin2hex($vat);

        // $result1 = bin2hex("Eyein Cafeee");
        // $result2 = bin2hex("310524172700003");
        // $result3 = bin2hex("2023-05-25T18:30:00Z");
        // $result4 = bin2hex("100.000");
        // $result5 = bin2hex("15.000");

        $hexafinal = '010c' . $result1 . '020F' . $result2 . '0314' . $result3 . '0407' . $result4 . '0506' . $result5;
        $FINAL = self::hex_to_base64($hexafinal);

        return $FINAL;
    }

    function hex_to_base64($hex)
    {
        $return = '';
        foreach (str_split($hex, 2) as $pair) {
            $return .= chr(hexdec($pair));
        }
        return base64_encode($return);
    }

    function getTLVForValue($tagNum, $tagValue)
    {
        $tagBuf = utf8_encode(chr($tagNum));
        $tagValueLenBuf = utf8_encode(chr(strlen($tagValue)));
        $tagValueBuf = utf8_encode($tagValue);
        $bufsArray = [$tagBuf, $tagValueLenBuf, $tagValueBuf];
        return implode($bufsArray);
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
            $order = Order::findorFail($id);

            $seller = auth()->user()->organization->nameEn;
            if (strlen($seller) > 12) {
                $seller = substr($seller, 0, 12);
            } elseif (strlen($seller) < 12) {
                $seller = $seller . str_repeat(' ', 12 - strlen($seller));
            }

            //*********************************************************** */
            $total_price = $order->totalwvat;

            if (strlen($total_price) < 7) {
                $temp = 7;
                if (strpos($total_price, '.') == false) {
                    $total_price .= '.';
                }
                $total_price = $total_price . str_repeat('0', $temp - strlen($total_price));
            }

            //*********************************************************** */
            $total_vat = $order->totalvat;
            if (strlen($total_vat) < 6) {
                $temp = 6;
                if (strpos($total_vat, '.') == false) {
                    $total_vat .= '.';
                }
                $total_vat = $total_vat . str_repeat('0', $temp - strlen($total_vat));
            }

            //$dtime = new DateTime();
            $created_at = $order->created_at->format('Y-m-d\TH:i:s\Z');
            //dd($seller." ".auth()->user()->organization->vatNo." ".$created_at." ".$total_price." ".$total_vat);
            $qr = $this->getQr($seller, auth()->user()->organization->vatNo, $created_at, $total_price, $total_vat);

            if (empty($order->customer->vatNo)) {
                $page = 'show-small';
            } else {
                $page = 'show-small';
            }
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في عرض فاتورة مبيعات ');
            return redirect()->back();
        }
        return view('admin.orders.' . $page)
            ->with('order', $order)
            ->with('qr', $qr);
    }

    public function SalesReturnsShow($id)
    {
        $order = Order::findorFail($id);

        $seller = auth()->user()->organization->nameEn;
        if (strlen($seller) > 12) {
            $seller = substr($seller, 0, 12);
        } elseif (strlen($seller) < 12) {
            $seller = $seller . str_repeat(' ', 12 - strlen($seller));
        }
        //*********************************************************** */
        $total_price = $order->totalwvat;
        if (strlen($total_price) < 7) {
            $temp = 7;
            if (strpos($total_price, '.') == false) {
                $total_price .= '.';
            }
            $total_price = $total_price . str_repeat('0', $temp - strlen($total_price));
        }

        //*********************************************************** */
        $total_vat = $order->totalvat;
        if (strlen($total_vat) < 6) {
            $temp = 6;
            if (strpos($total_vat, '.') == false) {
                $total_vat .= '.';
            }
            $total_vat = $total_vat . str_repeat('0', $temp - strlen($total_vat));
        }

        //$dtime = new DateTime();
        $created_at = $order->created_at->format('Y-m-d\TH:i:s\Z');
        //dd($seller." ".auth()->user()->organization->vatNo." ".$created_at." ".$total_price." ".$total_vat);
        $qr = $this->getQr($seller, auth()->user()->organization->vatNo, $created_at, $total_price, $total_vat);

        return view('admin.orders.Return.show')->with('order', $order)->with('qr', $qr);
    }

    public function showToday($id)
    {
      
        try {
            $order = Order::findorFail($id);
            return view('admin.orders.showtoday')->with('order', $order);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OrderInvoicesShow($id)
    {
        try {
            $order = Order::findorFail($id);

            $seller = auth()->user()->organization->nameEn;
            if (strlen($seller) > 12) {
                $seller = substr($seller, 0, 12);
            } elseif (strlen($seller) < 12) {
                $seller = $seller . str_repeat(' ', 12 - strlen($seller));
            }
            //*********************************************************** */
            $total_price = $order->totalwvat;
            if (strlen($total_price) < 7) {
                $temp = 7;
                if (strpos($total_price, '.') == false) {
                    $total_price .= '.';
                }
                $total_price = $total_price . str_repeat('0', $temp - strlen($total_price));
            }

            //*********************************************************** */
            $total_vat = $order->totalvat;
            if (strlen($total_vat) < 6) {
                $temp = 6;
                if (strpos($total_vat, '.') == false) {
                    $total_vat .= '.';
                }
                $total_vat = $total_vat . str_repeat('0', $temp - strlen($total_vat));
            }

            //$dtime = new DateTime();
            $created_at = $order->created_at->format('Y-m-d\TH:i:s\Z');
            //dd($seller." ".auth()->user()->organization->vatNo." ".$created_at." ".$total_price." ".$total_vat);
            $qr = $this->getQr($seller, auth()->user()->organization->vatNo, $created_at, $total_price, $total_vat);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

        return view('admin.orders.Invoices.show')->with('order', $order)->with('qr', $qr);
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
            $order = Order::findorFail($id);
            return view('admin.orders.edit')->with('order', $order);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function todayOrders(Request $request)
    {
        $items = Order::where('branchID', auth()->user()->branchID)
            ->orderBy('id', 'DESC')
            ->get();
        $items = $items->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'dailyBillNo' => $item->dailyBillNo,
                'customerName' => $item->customerID ?? '-',
                'orderType' => $item->orderType,
                'totalwvat' => $item->totalwvat,
                'type' => $item->type,
                'userName' => $item->user->name,
                'status' => $item->status,
                'created_at' => $item->created_at->diffForHumans(),
            ];
        });

        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
            ]);
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
            $order = Order::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $order->nameAr = $request->nameAr;
            $order->nameEn = $request->nameEn;
            $order->quantity = $request->quantity;
            $order->orgID = auth()->user()->orgID;
            $order->userID = auth()->user()->id;
            $order->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('orders.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findorFail($id);
        $order->status = 5;
        $order->save();

        session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('orders.index'));
    }

    public function ordersTest()
    {
        return view('admin.orders.test');
    }

    public function Complete($id)
    {
        try {
            $Order = Order::findorFail($id);
            //then Delete Role
            if ($Order->status == 1) {
                $Order->status = 0;
                $Order->save();
                session()->flash('success', 'تم تاكيد الطلب');
            } else {
                $Order->status = 1;
                $Order->save();
                session()->flash('success', 'تم تاكيد الطلب');
            }
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في تاكيد فاتورة مبيعات ');
            return redirect()->back();
        }
        return redirect(route('orders.today'));
    }
}
