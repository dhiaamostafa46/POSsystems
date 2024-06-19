<?php

namespace App\Http\Controllers;

use App\Models\Duration;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Exception;

class ReportsController extends Controller
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

    /**
     * Show the form for creating a new resource.
     */
    public function sales()
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'salesReport');
            $sales = Order::where('status', 1)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.reports.sales')->with('sales', $sales);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function durations()
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'durationsReport');
            $durations = Duration::where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.reports.durations')->with('durations', $durations);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function products()
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'itemsReport');
            $products = Product::where('status', 1)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.reports.products')->with('products', $products);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function productdetails($id)
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'itemsReport');
            $stocks = Stock::where('productID', $id)->where('created_at', '>=', session('dateFrom'))->where('created_at', '<', session('dateTo'))->get();

            return view('admin.reports.productdetails')->with('stocks', $stocks);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
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
