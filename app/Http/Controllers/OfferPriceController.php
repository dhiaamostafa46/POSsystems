<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Branch;
use App\Models\Costcenteer;
use App\Models\Customer;
use App\Models\Inv;
use App\Models\OfferPrice;
use App\Models\OfferPricedetails;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\VirtualAccounts;
use App\Models\VirtualCustomer;
use Illuminate\Http\Request;

class OfferPriceController extends Controller
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
    }

    public function OfferPriceIndex()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');
            $orders = OfferPrice::where('status', 1)
                ->where('kind', '=', '3')
                ->where('orgID', auth()->user()->orgID)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            return view('admin.orders.offerPrice.index')->with('orders', $orders);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function serach(Request $request)
    {
        $data = Product::where('nameAr', 'LIKE', '%' . $request->data . '%')
            ->where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        $output = '';
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display: block; position: absolute; z-index: 1 ">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item  EntryItemsearch"  data-r="2" data-id="' . $row->id . '">' . $row->nameAr . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="list-group-item">' . 'No Data Found' . '</li>';
        }
        return $output;
    }

    public function OfferPriceCreate()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');

            $items_all = Product::where('status', '1')->get();
            $items = Product::where('status', '1')
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            return view('admin.orders.offerPrice.create')->with('items', $items)->with('items_all', $items_all);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceeStore(Request $request, $id)
    {
        //********* Insert Order ************************ */

        try {
            $br = Branch::findorFail(auth()->user()->branchID);
            $OfferPrice = OfferPrice::findorFail($id);
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
            $bill->type = $request->type;
            if ($OfferPrice->FlageCustumer == -1) {
                $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
                $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Customers)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $yu = Accounting_guide::where('SourceID', '=', $Account->AccountID)
                    ->where('orgID', auth()->user()->orgID)
                    ->count();
                $customer = new Customer();
                $customer->name = $request->customerName;
                $customer->vatNo = $request->customerVat;
                $customer->phone = $request->customerPhone;
                $customer->orgID = auth()->user()->orgID;
                $customer->branchID = auth()->user()->branchID;
                $customer->userID = auth()->user()->id;
                $customer->AccountID = '12400' . $yu + 1;
                $customer->save();
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = $Account->AccountID . '00' . $yu + 1;
                $AccountingGuide->AccountName = $request->customerName;
                $AccountingGuide->AccountNameEn = $request->customerName;
                $AccountingGuide->type = $Account->AccountName;
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 1;
                $AccountingGuide->Account_status = 1;
                $AccountingGuide->SourceID = $Account->AccountID;
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
                $customer = $OfferPrice->Customer;
            }
            // dd($customer->id);
            $bill->customerID = $customer->id;
            $bill->serial = $bill_num;
            $bill->type = $request->type;
            if ($request->type == 4) {
                $bill->cash = $request->cash;
                $bill->card = $request->card;
            } elseif ($request->type == 121) {
                $bill->cash = $request->totalwvat;
                $bill->card = 0;
            } elseif ($request->type == 122) {
                $bill->cash = 0;
                $bill->card = $request->totalwvat;
            }

            $bill->discount = $OfferPrice->discount;
            $bill->totalvat = $OfferPrice->totalvat;
            $bill->totalwvat = $OfferPrice->totalwvat;

            // $bill->durationID = auth()->user()->branch->durations->first()->id;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->kind;

            // Kind 1 نافذة مبيعات  ,2 فاتورة مبيعات ,3 عرض سعر , 4 مرتجع مبيعات
            $bill->CostCenter = $request->costcenter;
            $bill->salaseAccount = $RoutAccount->sales;
            if ($request->type != 3) {
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $RoutAccount->sales)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->totalwvat + $RPtData->creditSecond;
                $RPtData->save();

                $data = explode('::', $request->paymentTypeitems);
                $bill->NameAcount = $data[2];
                $bill->AccountID = $data[1];
                $acc = Accounting_guide::findorFail($data[0]);
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            } else {
                $bill->NameAcount = 'اجل ';
                $bill->AccountID = $customer->AccountID;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $customer->AccountID)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            }

            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            foreach ($OfferPrice->OfferPricedetails as $Items) {
                $billdetails = new Orderdetails();
                $billdetails->orderID = $bill->id;
                $billdetails->productID = $Items->productID;
                $billdetails->productName = $Items->productName;
                $billdetails->quantity = $Items->quantity;
                $billdetails->price = $Items->price * $Items->Profit;
                $billdetails->total = $Items->total;
                $billdetails->totalcost = $Items->totalcost;
                if ($Items->discount == null) {
                    $billdetails->discount = 0;
                } else {
                    $billdetails->discount = $Items->discount;
                }

                $billdetails->userID = auth()->user()->id;
                $billdetails->branchID = auth()->user()->branchID;
                $billdetails->orgID = auth()->user()->orgID;
                $billdetails->save();
                /***************** Stock ************ */

                UiteAllSeller($Items->productID, $Items->quantity, $br->DepotStore[0]->id);
                /***************** Stock ************ */
                $stock = new Stock();
                $stock->productID = $Items->productID;
                $stock->quantityOut = $Items->quantity;
                $stock->orderID = $bill->id;
                $stock->comment = 'فاتورة مبيعات';
                $stock->userID = auth()->user()->id;
                $stock->branchID = auth()->user()->branchID;
                $stock->orgID = auth()->user()->orgID;
                $stock->depotID = $br->DepotStore[0]->id;
                $stock->kind = 7;
                $stock->save();
            }

            return redirect(route('orders.show', $bill->id));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceShow($id)
    {
        try {
            $order = OfferPrice::findorFail($id);

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

            return view('admin.orders.offerPrice.show')->with('order', $order)->with('qr', $qr);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceedit($id)
    {
        try {
            $order = OfferPrice::findorFail($id);
            // dd(  $order->orderdetails);
            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')->get();
                $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.offerPrice.edit')->with('items', $items)->with('items_all', $items_all)->with('cost', $Cost)->with('order', $order);
            } else {
                return view('admin.orders.createForRestaurant');
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceeConvert($id)
    {
        try {
            $order = OfferPrice::findorFail($id);

            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')->get();
                $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.offerPrice.Convert')->with('items', $items)->with('items_all', $items_all)->with('cost', $Cost)->with('order', $order);
            } else {
                return view('admin.orders.createForRestaurant');
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPricedestroy($id)
    {
        try {
            $order = OfferPrice::findorFail($id);
            $order->status = 5;
            $order->save();
            session()->flash('success', 'تم حذف القسم بنجاح');
            return redirect(route('OfferPrice.index'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //********* Insert Order ************************ */

        try {
            $br = Branch::findorFail(auth()->user()->branchID);

            $year = date('Y');
            $last_bill = OfferPrice::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'desc')
                ->whereYear('created_at', $year)
                ->first();

            //dd($last_bill);
            if (!empty($last_bill->serial)) {
                $bill_num = (int) $last_bill->serial + 1;
            } else {
                $bill_num = 1;
            }

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

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();

            $bill = new OfferPrice();
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
                }
            } elseif ($request->customerID == -1) {
                $customer = new VirtualCustomer();
                $customer->name = $request->customerName;
                $customer->vatNo = $request->customerVat;
                $customer->phone = $request->customerPhone;
                $customer->userID = auth()->user()->id;
                $customer->branchID = auth()->user()->branchID;
                $customer->orgID = auth()->user()->orgID;

                $customer->save();
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

            $bill->FlageCustumer = $request->customerID;
            $bill->discount = $request->totaldiscount;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->durationID = auth()->user()->branch->durations->first()->id;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = $request->kind;

            $bill->salaseAccount = $RoutAccount->Salesreturns;
            $bill->Duration = $request->Duration;

            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new OfferPricedetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->total = $request->input('rtotalwvat' . $i);
                    $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i);
                    if ($request->input('deduct' . $i) == null) {
                        $billdetails->discount = 0;
                    } else {
                        $billdetails->discount = $request->input('deduct' . $i);
                    }

                    $billdetails->Profit = $request->input('Profit' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();

                    /***************** Stock ************ */
                }
            }

            return redirect(route('OfferPrice.show', $bill->id));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            //
            $bill = OfferPrice::findorFail($id);
            $bill->OfferPricedetails()->delete();
            return redirect()->back();
        } catch (\Exception $e) {
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

        try {
            $br = Branch::findorFail(auth()->user()->branchID);

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();

            $bill = OfferPrice::findorFail($id);
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
                }
            } elseif ($request->customerID == -1) {
                $customer = new VirtualCustomer();
                $customer->name = $request->customerName;
                $customer->vatNo = $request->customerVat;
                $customer->phone = $request->customerPhone;
                $customer->userID = auth()->user()->id;
                $customer->branchID = auth()->user()->branchID;
                $customer->orgID = auth()->user()->orgID;

                $customer->save();
            } else {
                $customer = Customer::findorFail($request->customerID);
            }
            // dd($customer->id);
            $bill->customerID = $customer->id;
            $bill->type = $request->type;
            $bill->FlageCustumer = $request->customerID;
            $bill->discount = $request->totaldiscount;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->kind = $request->kind;
            $bill->salaseAccount = $RoutAccount->Salesreturns;
            $bill->Duration = $request->Duration;
            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;
            $bill->OfferPricedetails()->delete();
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new OfferPricedetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->total = $request->input('rtotalwvat' . $i);
                    $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i);
                    if ($request->input('deduct' . $i) == null) {
                        $billdetails->discount = 0;
                    } else {
                        $billdetails->discount = $request->input('deduct' . $i);
                    }

                    $billdetails->Profit = $request->input('Profit' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();

                    /***************** Stock ************ */
                }
            }

            return redirect(route('OfferPrice.show', $bill->id));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
