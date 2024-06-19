<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;

class SinadatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexReceive()
    {
        try {
            session()->put('page', 'invoices');
            session()->put('sub-page', 'createReceivePayments');
            $invoices = Invoice::where('status', 1)
                ->where('orgID', auth()->user()->organization->id)
                ->where('type', 1)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            // dd(  $invoices[0]->customer->name );
            return view('admin.invoices.Receive.indexReceive')->with('invoices', $invoices);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function createReceive()
    {
        try {
            session()->put('page', 'invoices');
            session()->put('sub-page', 'createReceivePayments');

            return view('admin.invoices.Receive.createReceive');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function indexDeliver()
    {
        try {
            session()->put('page', 'invoices');
            session()->put('sub-page', 'createDeliverPayments');
            $invoices = Invoice::where('status', 1)
                ->where('orgID', auth()->user()->organization->id)
                ->where('type', 2)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            // dd(  $invoices[0]->customer->name );
            return view('admin.invoices.Deliver.indexDeliver')->with('invoices', $invoices);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function createDeliver()
    {
        try {
            session()->put('page', 'invoices');
            session()->put('sub-page', 'createDeliverPayments');
            return view('admin.invoices.Deliver.createDeliver');
        } catch (Exception $e) {
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

        try {
            $this->validate($request, [
                'customerID' => 'required',
                'total' => 'required',
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

            $bill->type = $request->type;
            $bill->paymentType = $request->paymentType;
            $bill->comment = $request->comment;
            $bill->total = $request->total;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->date = $request->date;
            $bill->CostCenter = $request->CostCenter;
            if ($request->Ref == null) {
                $bill->invoicesID = '';
            } else {
                $bill->invoicesID = $request->Ref;
            }

            $dataType = explode('::', $request->paymentTypeitems);
            if ($request->type == 1) {
                //  العميل دائن  والحساب مدين
                $data = explode('::', $request->customerID);
                $bill->customerID = $data[0];
                $bill->Accountinv = $data[1];
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $data[1])
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->total + $RPtData->creditSecond;
                $RPtData->save();

                $acc = Accounting_guide::findorFail($dataType[0]);
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->total + $RPtData->debitSecond;
                $RPtData->save();
            } else {
                // المورد هو المدين والحساب هو الدائن
                $data = explode('::', $request->customerID);
                $bill->supplierID = $data[0];
                $bill->Accountinv = $data[1];
                $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', '=', $data[1])
                    ->first();
                $RPtData = $acc->ReportData;
                $RPtData->debitSecond = $request->total + $RPtData->debitSecond;
                $RPtData->save();

                $acc = Accounting_guide::findorFail($dataType[0]);
                $RPtData = $acc->ReportData;
                $RPtData->creditSecond = $request->total + $RPtData->creditSecond;
                $RPtData->save();
            }

            $bill->nameAccount = $dataType[2];
            $bill->AccountID = $dataType[1];
            $bill->save();

            if ($request->type == 1) {
                return redirect(route('Sinadat.indexReceive'));
            } else {
                return redirect(route('Sinadat.indexDeliver'));
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //
            $invoice = Invoice::findorFail($id);
            if ($invoice->type == 1) {
                return view('admin.invoices.Receive.showReceive')->with('invoice', $invoice);
            } else {
                return view('admin.invoices.Deliver.showDeliver')->with('invoice', $invoice);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            //
            $invoice = Invoice::findorFail($id);
            if ($invoice->type == 1) {
                return view('admin.invoices.Receive.edit')->with('invoice', $invoice);
            } else {
                return view('admin.invoices.Deliver.edit')->with('invoice', $invoice);
            }
        } catch (Exception $e) {
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
            $this->validate($request, [
                'customerID' => 'required',
                'total' => 'required',
            ]);
            $bill = Invoice::findorFail($id);
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

            $bill->type = $request->type;
            $bill->paymentType = $request->paymentType;
            $bill->comment = $request->comment;
            $bill->total = $request->total;
            $bill->date = $request->date;
            $bill->CostCenter = $request->CostCenter;

            if ($request->Ref == null) {
                $bill->invoicesID = '';
            } else {
                $bill->invoicesID = $request->Ref;
            }

            if ($request->type == 1) {
                $bill->customerID = $request->customerID;
            } else {
                $bill->supplierID = $request->supplierId;
            }

            if ($request->paymentType == 121 || $request->paymentType == 122) {
                $data = explode('::', $request->paymentTypeitems);
                $bill->nameAccount = $data[1];
                $bill->AccountID = $data[0];
            }
            $bill->save();

            if ($request->type == 1) {
                return redirect(route('Sinadat.indexReceive'));
            } else {
                return redirect(route('Sinadat.indexDeliver'));
            }
        } catch (Exception $e) {
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
