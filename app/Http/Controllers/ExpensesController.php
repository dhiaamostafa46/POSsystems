<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\ExpensDetails;
use App\Models\Expenses;
use App\Models\Outcomecategory;
use Exception;
use Illuminate\Http\Request;

class ExpensesController extends Controller
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

        try {
            session()->put('page', 'outcomes');
            session()->put('sub-page', 'outcomesList');
            $outcomes = Expenses::where('status', 1)
                ->where('orgID', auth()->user()->organization->id)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            return view('admin.Expenses.index')->with('outcomes', $outcomes);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            session()->put('page', 'outcomes');
            session()->put('sub-page', 'outcomesCreate');

            $outcomes = Outcomecategory::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.Expenses.create')->with('outcome', $outcomes);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $data = explode('::', $request->paymentTypeitems);

        try {
            $exp = new Expenses();

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
                $path = $request->file('img')->move(public_path('dist/img/outcomes'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $exp->file = $fileNametoStore;
            } else {
            }

            $exp->orgID = auth()->user()->orgID;
            $exp->branchID = auth()->user()->branchID;
            $exp->userID = auth()->user()->id;
            $exp->total = $request->totalwvat;
            $exp->vat = $request->vat;
            $exp->invoce = $request->serial;
            $exp->type = $request->TypeFatorah;
            $exp->typepement = $request->type;
            $exp->account = $data[2];
            $exp->expaccount = $data[1];
            $exp->status = 1;
            $exp->date = $request->invoiceDate;

            $exp->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $ExpensDetails = new ExpensDetails();
                    $ExpensDetails->branchID = auth()->user()->branchID;
                    $ExpensDetails->orgID = auth()->user()->orgID;
                    $ExpensDetails->expensID = $exp->id;
                    $ExpensDetails->userID = auth()->user()->id;
                    $ExpensDetails->total = $request->input('rtotalwvat' . $i);
                    $ExpensDetails->vat = $request->input('rvat' . $i);
                    $ExpensDetails->price = $request->input('price' . $i);
                    $ExpensDetails->Quantity = $request->input('quantity' . $i);
                    $ExpensDetails->comment = $request->input('text' . $i);
                    $ExpensDetails->categoryID = $request->input('item' . $i);
                    $ExpensDetails->outAccount = $request->input('Account' . $i);
                    $ExpensDetails->AccountID = $data[0];
                    $ExpensDetails->nameAccount = $data[1];
                    $ExpensDetails->type = $request->type;
                    $ExpensDetails->status = 1;
                    $ExpensDetails->date = $request->invoiceDate;
                    $ExpensDetails->kind = $request->TypeFatorah;
                    $ExpensDetails->save();

                    if ($request->TypeFatorah == 2) {
                        $account = Accounting_guide::where('orgID', auth()->user()->orgID)
                            ->where('AccountID', $data[1])
                            ->first();
                        $dd = $account->ReportData;
                        $dd->creditSecond = $dd->creditSecond + $request->input('rtotalwvat' . $i);
                        $dd->save();

                        $account = Accounting_guide::where('orgID', auth()->user()->orgID)
                            ->where('AccountID', $request->input('Account' . $i))
                            ->first();
                        $dd = $account->ReportData;
                        $dd->debitSecond = $dd->debitSecond + $request->input('rtotalwvat' . $i);
                        $dd->save();
                    }
                    /***************** Stock ************ */
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));

            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
        return redirect(route('Expenses.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //\
        try {
            $outcome = Expenses::findorFail($id);
            return view('admin.Expenses.show')->with('outcome', $outcome);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $Outcomecategory = Outcomecategory::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Expenses = Expenses::findorFail($id);
            return view('admin.Expenses.edit')->with('Expenses', $Expenses)->with('outcome', $Outcomecategory);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = explode('::', $request->paymentTypeitems);
        try {
            $exp = Expenses::findorFail($id);

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
                $path = $request->file('img')->move(public_path('dist/img/outcomes'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $exp->file = $fileNametoStore;
            } else {
            }

            $exp->orgID = auth()->user()->orgID;
            $exp->branchID = auth()->user()->branchID;
            $exp->userID = auth()->user()->id;
            $exp->total = $request->totalwvat;
            $exp->vat = $request->vat;
            $exp->invoce = $request->serial;
            $exp->type = $request->TypeFatorah;
            $exp->typepement = $request->type;
            $exp->account = $data[2];
            $exp->expaccount = $data[1];
            $exp->status = 1;
            $exp->date = $request->invoiceDate;

            $exp->save();

            //*********** Insert Bill details ************** */
            $exp->ExpensDetails()->delete();
            $count = $request->count;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $ExpensDetails = new ExpensDetails();
                    $ExpensDetails->branchID = auth()->user()->branchID;
                    $ExpensDetails->orgID = auth()->user()->orgID;
                    $ExpensDetails->expensID = $exp->id;
                    $ExpensDetails->userID = auth()->user()->id;
                    $ExpensDetails->total = $request->input('rtotalwvat' . $i);
                    $ExpensDetails->vat = $request->input('rvat' . $i);
                    $ExpensDetails->price = $request->input('price' . $i);
                    $ExpensDetails->Quantity = $request->input('quantity' . $i);
                    $ExpensDetails->comment = $request->input('text' . $i);
                    $ExpensDetails->categoryID = $request->input('item' . $i);
                    $ExpensDetails->outAccount = $request->input('Account' . $i);
                    $ExpensDetails->AccountID = $data[0];
                    $ExpensDetails->nameAccount = $data[1];
                    $ExpensDetails->type = $request->type;
                    $ExpensDetails->status = 1;
                    $ExpensDetails->date = $request->invoiceDate;
                    $ExpensDetails->kind = $request->TypeFatorah;
                    $ExpensDetails->save();

                    if ($request->TypeFatorah == 2) {
                        $account = Accounting_guide::where('orgID', auth()->user()->orgID)
                            ->where('AccountID', $data[1])
                            ->first();

                        $dd = $account->ReportData;
                        $dd->creditSecond = $dd->creditSecond + $request->input('rtotalwvat' . $i);
                        $dd->save();

                        $account = Accounting_guide::where('orgID', auth()->user()->orgID)
                            ->where('AccountID', $request->input('Account' . $i))
                            ->first();
                        $dd = $account->ReportData;
                        $dd->debitSecond = $dd->debitSecond + $request->input('rtotalwvat' . $i);
                        $dd->save();
                    }
                    /***************** Stock ************ */
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));

            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));
        return redirect(route('Expenses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
