<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Costcenteer;
use App\Models\Order;
use App\Models\Product;
use App\Models\RoutAccount;
use Illuminate\Http\Request;

class OrderAllController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // /---------------------------------
    public function OfferPriceIndex()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');
            $orders = Order::where('status', 1)
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

    public function InvoicesCreate()
    {
        try {
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
                return view('admin.orders.createForRestaurant');
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceCreate()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'OfferPrice');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.offerPrice.create')->with('items', $items)->with('items_all', $items_all);
            } else {
                return view('admin.orders.createForRestaurant');
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function SalesReturnsIndex()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'SalesReturnsIndex');
            $orders = Order::where('status', 1)
                ->where('kind', '=', '4')
                ->where('orgID', auth()->user()->orgID)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            // foreach( $orders as $ssa)
            // {
            //     dd($ssa->Customer->name);
            // }

            return view('admin.orders.Return.index')->with('orders', $orders);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function SalesReturnsCreate()
    {
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'SalesReturnsIndex');
            if (auth()->user()->organization->activity == 1 || auth()->user()->organization->activity == 3) {
                $items_all = Product::where('status', '1')->get();
                $Cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                return view('admin.orders.Return.create')->with('items', $items)->with('items_all', $items_all)->with('cost', $Cost);
            } else {
                return view('admin.orders.createForRestaurant');
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceeStore(Request $request, $id)
    {
        try {
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();

            $bill = Order::findorFail($id);

            $bill->kind = 2;
            $bill->type = $request->type;
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

                $bill->AccountID = $bill->Customer->AccountID;
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $bill->Customer->AccountID)
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->totalwvat + $RPtData->debitSecond;
                $RPtData->save();
            }
            $bill->save();

            return redirect(route('orders.index'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function SalesReturnsShow($id)
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

            return view('admin.orders.Return.show')->with('order', $order)->with('qr', $qr);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceShow($id)
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

            return view('admin.orders.OfferPrice.show')->with('order', $order)->with('qr', $qr);
        } catch (\Exception $e) {
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

            return view('admin.orders.Invoices.show')->with('order', $order)->with('qr', $qr);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function OfferPriceedit($id)
    {
        try {
            $order = Order::findorFail($id);
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
            $order = Order::findorFail($id);

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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
