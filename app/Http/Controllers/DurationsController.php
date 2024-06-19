<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Duration;
use App\Models\Durationdetails;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Stock;
use Exception;

class DurationsController extends Controller
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
            session()->put('sub-page', 'billsDebit');
            $orders = Duration::all();
            return view('admin.debitorders.index')->with('orders', $orders);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function DurationUser($id)
    {
        try {
            $user = Duration::where('userID', auth()->user()->id)
                ->whereDate('created_at', date('Y-m-d'))
                ->where('endAt', null)
                ->count();
            return response()->json(['data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDuration($amount)
    {
        try {
            $Count = Duration::where('orgID', auth()->user()->orgID)
                ->whereDate('created_at', date('Y-m-d'))
                ->where('open', 0)
                ->count();

            if ($Count > 4) {
                session()->flash('faild', trans('Sale.Cannotopenshift'));
                return redirect()->back();
            }

            $duration = new Duration();
            $last_duration = Duration::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'desc')
                ->first();
            $durationNo = !empty($last_duration) ? $last_duration->durationNo + 1 : 1;
            $duration->durationNo = $durationNo;
            $duration->openBalance = $amount;
            $duration->userID = auth()->user()->id;
            $duration->branchID = auth()->user()->branchID;
            $duration->orgID = auth()->user()->orgID;
            $duration->open = 0;
            $duration->save();
            return redirect(route('orders.create'));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في فتح وردية ');
            return redirect()->back();
        }
    }

    public function createDurationNadel()
    {
        try {
            $duration = new Duration();
            $last_duration = Duration::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'desc')
                ->first();
            $durationNo = !empty($last_duration) ? $last_duration->durationNo + 1 : 1;
            $duration->durationNo = $durationNo;
            $duration->openBalance = 0;
            $duration->userID = auth()->user()->id;
            $duration->branchID = auth()->user()->branchID;
            $duration->orgID = auth()->user()->orgID;
            $duration->save();
            return redirect(route('Nadal.create'));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في فتح وردية  لنادل');
            return redirect()->back();
        }
    }

    public function endDuration($id)
    {
        try {
            $duration = Duration::findorFail($id);
            $data = Order::where('orgID', auth()->user()->orgID)
                ->where('durationID', $duration->durationNo)
                ->where('TypeInv', 2)
                ->sum('totalwvat');
            $duration->endAt = \Carbon\Carbon::now();
            $duration->endBy = auth()->user()->id;
            $duration->status = 0;
            $duration->Saller = $data;
            $duration->open = 1;
            $duration->save();
            return redirect(route('orders.today'));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في نهاية وردية  ');
            return redirect()->back();
        }
    }

    public function endDurationNadel($id)
    {
        try {
            $duration = Duration::findorFail($id);
            $data = Order::where('orgID', auth()->user()->orgID)
                ->where('durationID', $duration->durationNo)
                ->where('TypeInv', 2)
                ->sum('totalwvat');
            $duration->endAt = \Carbon\Carbon::now();
            $duration->endBy = auth()->user()->id;
            $duration->status = 0;
            $duration->Saller = $data;
            $duration->save();
            return redirect(route('Nadal.index'));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في نهاية وردية  لنادل');
            return redirect()->back();
        }
    }

    public function detailsDuration($id)
    {
        try {
            $duration = Duration::findorFail($id);
            return view('admin.duration.details')->with('duration', $duration);
        } catch (\Exception $e) {
            return back();
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
        //********* Insert Duration ************************ */
        try {
            $bill = new Duration();
            $bill->type = $request->type;
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
                    $customer->save();
                }
            } else {
                $customer = Customer::findorFail($request->customerID);
            }
            $bill->customerID = $customer->id;
            $bill->serial = $request->serial;
            $bill->type = $request->type;
            $bill->discount = $request->totaldiscount;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Durationdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->save();
                    /***************** Stock ************ */
                    $this->checkStore($request->input('item' . $i), $request->input('quantity' . $i));
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityOut = $request->input('quantity' . $i);
                    $stock->orderID = $bill->id;
                    $stock->comment = 'فاتورة مبيعات';
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->save();
                }
            }
        } catch (\Exception $e) {
            return back();
        }
        return redirect(route('debitorders.show', $bill->id));
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
        $FINAL = base64_encode($hexafinal);

        return $FINAL;
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
            $duration = Duration::findorFail($id);
            return view('admin.duration.show')->with('duration', $duration);
        } catch (\Exception $e) {
            return response()->json([], 200);
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
            $order = Duration::findorFail($id);
            return view('admin.debitorders.edit')->with('order', $order);
        } catch (\Exception $e) {
            return response()->json([], 200);
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
            $order = Duration::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $order->nameAr = $request->nameAr;
            $order->nameEn = $request->nameEn;
            $order->quantity = $request->quantity;
            $order->orgID = auth()->user()->orgID;
            $order->userID = auth()->user()->id;
            $order->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('debitorders.index'));
        } catch (\Exception $e) {
            return back();
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
        try {
            $order = Duration::findorFail($id);
            $order->status = 5;
            $order->save();
            session()->flash('success', 'تم حذف القسم بنجاح');
            return redirect(route('debitorders.index'));
        } catch (\Exception $e) {
            return back();
        }
    }
}
