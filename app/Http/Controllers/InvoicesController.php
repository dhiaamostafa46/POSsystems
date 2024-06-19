<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Supplierpayment;
use App\Models\Customerpayment;

class InvoicesController extends Controller
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
    public function indexReceive()
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'receivePaymentsReport');
            if (auth()->user()->organization->activity === 3) {
                $invoices = Invoice::where('status', 1)->where('type', 4)->where('created_at', '>=', session('dateFrom'))->where('created_at', '<', session('dateTo'))->get();
            } else {
                $invoices = Invoice::where('status', 1)->where('type', 1)->where('created_at', '>=', session('dateFrom'))->where('created_at', '<', session('dateTo'))->get();
            }
            return view('admin.invoices.indexReceive')->with('invoices', $invoices);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function indexDeliver()
    {
        try {
            session()->put('page', 'reports');
            session()->put('sub-page', 'deliverPaymentsReport');
            if (auth()->user()->organization->activity === 3) {
                $invoices = Invoice::where('status', 1)->where('type', 3)->where('created_at', '>=', session('dateFrom'))->where('created_at', '<', session('dateTo'))->get();
            } else {
                $invoices = Invoice::where('status', 1)->where('type', 2)->where('created_at', '>=', session('dateFrom'))->where('created_at', '<', session('dateTo'))->get();
            }
            return view('admin.invoices.indexDeliver')->with('invoices', $invoices);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReceive($id = null)
    {
        try {
            session()->put('page', 'invoices');
            session()->put('sub-page', 'createReceivePayments');
            if (is_null($id)) {
                return view('admin.invoices.createReceiverNon-profit');
            } else {
                $order = Order::where('serial', $id)->first();
                if (empty($order)) {
                    session()->flash('faild', 'تأكد من رقم الفاتورة');
                    return redirect(route('invoices.indexReceive'));
                }
            }
            return view('admin.invoices.createReceive')->with('order', $order);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function createDeliver($id = null)
    {
        try {
            session()->put('page', 'invoices');
            if (is_null($id)) {
                return view('admin.invoices.createDeliverNon-profit');
            } else {
                $purchase = Purchase::where('serial', $id)->first();
                if (empty($purchase)) {
                    session()->flash('faild', 'تأكد من رقم فاتورة المشتريات');
                    return redirect(route('invoices.indexDeliver'));
                }
            }
            return view('admin.invoices.createDeliver')->with('purchase', $purchase);
        } catch (\Exception $e) {
            return redirect()->back();
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
        try {
            $this->validate($request, [
                'img' => ' max:500',
            ]);
            $bill = new Invoice();
            if ($request->hasFile('img')) {
                //get filename with extension
                $filenameWithExt = $request->file('img')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('img')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('img')->move(public_path('../dist/img/invoices'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $bill->img = $fileNametoStore;
            } else {
                $bill->img = 'default.jpg';
            }
            if ($request->type == 1) {
                $order = Order::findorFail($request->orderID);
                $bill->customerID = $order->customerID;
                $bill->orderID = $order->id;
            } elseif ($request->type == 2) {
                $purchase = Purchase::findorFail($request->purchaseID);
                $bill->supplierID = $purchase->supplierID;
                $bill->purchaseID = $purchase->id;
            } elseif ($request->type == 3) {
                $bill->supplierID = $request->supplierId;
                $bill->purchaseID = null;
            } else {
                $bill->customerID = $request->customerID;
                $bill->orderID = null;
            }

            $bill->type = $request->type;
            $bill->paymentType = $request->paymentType;
            $bill->comment = $request->comment;
            $bill->total = $request->total;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->save();

            if ($request->type == 1 || $request->type == 4) {
                $payment = new Customerpayment();
                $payment->customerID = $bill->customerID;
                $payment->invoiceID = $bill->id;
                $payment->comment = $request->comment;
                $payment->cred = $request->total;
                $payment->userID = auth()->user()->id;
                $payment->branchID = auth()->user()->branchID;
                $payment->orgID = auth()->user()->orgID;
                $payment->status = 1;
                $payment->save();
            } else {
                $payment = new Supplierpayment();
                $payment->supplierID = $bill->supplierID;
                $payment->invoiceID = $bill->id;
                $payment->comment = $request->comment;
                $payment->debit = $request->total;
                $payment->userID = auth()->user()->id;
                $payment->branchID = auth()->user()->branchID;
                $payment->orgID = auth()->user()->orgID;
                $payment->status = 1;
                $payment->save();
            }

            return redirect(route('invoices.show', $bill->id));
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
            $invoice = Invoice::findorFail($id);
            if ($invoice->type == 1) {
                return view('admin.invoices.showReceive')->with('invoice', $invoice);
            } else {
                return view('admin.invoices.showDeliver')->with('invoice', $invoice);
            }
        } catch (\Exception $e) {
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
            $invoice = Invoice::findorFail($id);
            return view('admin.invoices.edit')->with('invoice', $invoice);
        } catch (\Exception $e) {
            return redirect()->back();
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
            $invoice = Invoice::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $invoice->nameAr = $request->nameAr;
            $invoice->nameEn = $request->nameEn;
            $invoice->quantity = $request->quantity;
            $invoice->orgID = auth()->user()->orgID;
            $invoice->userID = auth()->user()->id;
            $invoice->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('invoices.index'));
        } catch (\Exception $e) {
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
        try {
            $invoice = Invoice::findorFail($id);
            $invoice->status = 5;
            $invoice->save();
            session()->flash('success', 'تم حذف القسم بنجاح');
            return redirect(route('invoices.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
