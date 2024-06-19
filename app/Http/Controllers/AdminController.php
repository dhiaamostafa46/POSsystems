<?php

namespace App\Http\Controllers;
use App\Models\Inv;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Outcome;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Support\Facades\URL;
use App\Models\Subscribtion;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        try {
            session()->put('page', 'index');
            if (empty(session('dateFrom'))) {
                session()->put('dateFrom', Carbon::now()->subDays(30)->format('Y-m-d'));
                session()->put('dateTo', Carbon::now()->addDays(1)->format('Y-m-d'));
            }

            if (Auth::check()) {
                $subscribtion = Subscribtion::where('orgID', auth()->user()->orgID)
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->first();
                if (!empty($subscribtion)) {
                    if ($subscribtion->endDate < Carbon::now()) {
                        session()->put('subscribtionStatus', 3);
                        session()->put('subscribtionMsg', 'عزيزي العميل لقد انتهى اشتراكك');
                        return redirect('login')->with(Auth::logout());
                    } elseif ($subscribtion->endDate < Carbon::now()->addDays(5)) {
                        //to alert befor  5 days from enddate
                        session()->put('subscribtionStatus', 2);
                        session()->put('subscribtionMsg', 'عزيزي العميل لقد اوشك اشتراكك على الانتهاء');
                    } else {
                        session()->put('subscribtionStatus', 1);
                    }
                } else {
                    session()->put('subscribtionStatus', 3);
                    session()->put('subscribtionMsg', 'عفوا لا يوجد لديك اشتراك ساري');
                    return redirect('login')->with(Auth::logout());
                }
            } else {
                return redirect('login')->with(Auth::logout());
            }

            ////to get sumary statisctic for orgnization depend on sdate and end date
            $orders = Order::where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('kind', '=', '2')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $ordersdetails = Orderdetails::where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $outcomes = Outcome::where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $stocks = Stock::where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $products = Product::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            /////to get orders of current month
            $month_orders = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $month_outcomes = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $s1 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '1')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s2 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '2')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s3 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '3')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s4 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '4')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s5 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '5')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s6 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '6')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s7 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '7')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s8 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '8')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s9 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '9')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s10 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '10')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s11 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '11')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');
            $s12 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '12')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalwvat');

            /////to get outcome  of month
            $o1 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '1')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o2 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '2')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o3 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '3')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o4 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '4')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o5 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '5')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o6 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '6')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o7 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '7')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o8 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '8')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o9 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '9')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o10 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '10')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o11 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '11')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');
            $o12 = Outcome::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '12')
                ->where('orgID', auth()->user()->orgID)
                ->sum('total');

            /////to get vats of month
            $v1 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '1')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v2 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '2')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v3 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '3')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v4 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '4')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v5 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '5')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v6 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '6')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v7 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '7')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v8 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '8')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v9 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '9')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v10 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '10')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v11 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '11')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');
            $v12 = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', '12')
                ->where('orgID', auth()->user()->orgID)
                ->sum('totalvat');

            $totalStock = 0;
            foreach ($products as $product) {
                $totalStock = $totalStock + $product->prodPrice * ($product->stocks->sum('quantityIn') - $product->stocks->sum('quantityOut'));
            }

            //  if(auth()->user()->id == 6)
            // {

            //     return view('admin.index2');
            // }

            $inv = Inv::where('orgID', auth()->user()->orgID)->first();

            $Orgflagcomplate = 0;
            if (empty(auth()->user()->organization->CR) || empty(auth()->user()->organization->vatNo)) {
                $Orgflagcomplate = 1;
            } else {
                $Orgflagcomplate = 0;
            }

            if (auth()->user()->empID != 0) {
                return redirect(route('employees.getByID', auth()->user()->empID));
            }
        } catch (\Exception $e) {
            return back();
        }

        return view('admin.index')->with('orders', $orders)->with('ordersdetails', $ordersdetails)->with('outcomes', $outcomes)->with('stocks', $stocks)->with('totalStock', $totalStock)->with('month_orders', $month_orders)->with('month_outcomes', $month_outcomes)->with('s1', $s1)->with('s2', $s2)->with('s3', $s3)->with('s4', $s4)->with('s5', $s5)->with('s6', $s6)->with('s7', $s7)->with('s8', $s8)->with('s9', $s9)->with('s10', $s10)->with('s11', $s11)->with('s12', $s12)->with('o1', $o1)->with('o2', $o2)->with('o3', $o3)->with('o4', $o4)->with('o5', $o5)->with('o6', $o6)->with('o7', $o7)->with('o8', $o8)->with('o9', $o9)->with('o10', $o10)->with('o11', $o11)->with('o12', $o12)->with('v1', $v1)->with('v2', $v2)->with('v3', $v3)->with('v4', $v4)->with('v5', $v5)->with('v6', $v6)->with('v7', $v7)->with('v8', $v8)->with('v9', $v9)->with('v10', $v10)->with('v11', $v11)->with('v12', $v12)->with('Orgflagcomplate', $Orgflagcomplate)->with('Inv', $inv);
    }

    function setPeriod(Request $request)
    {
        session()->put('dateFrom', $request->dateFrom);
        session()->put('dateTo', $request->dateTo);

        return redirect(url(URL::previous()));
    }

    function merchents()
    {
    }
}
