<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Supplier;
use App\Models\Loginrecord;
use App\Models\ReportData;
use App\Models\RoutAccount;
use Exception;

class SuppliersController extends Controller
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
            session()->put('page', 'suppliers');
            session()->put('sub-page', 'suppliersList');
            $suppliers = Supplier::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.suppliers.index')->with('suppliers', $suppliers);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            session()->put('page', 'suppliers');
            return view('admin.suppliers.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Suppliers)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $yu = Accounting_guide::where('SourceID', '=', $Account->AccountID)
                ->where('orgID', auth()->user()->orgID)
                ->count();
            $supplier = new Supplier();
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
            ]);

            $supplier->name = $request->name;
            $supplier->area = $request->area;
            $supplier->city = $request->city;
            $supplier->district = $request->district;
            $supplier->address = $request->address;
            $supplier->vatNo = $request->vatNo;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->orgID = auth()->user()->orgID;
            $supplier->branchID = auth()->user()->branchID;
            $supplier->userID = auth()->user()->id;
            $supplier->AccountID = '22100' . $yu + 1;
            $supplier->save();

            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID = $Account->AccountID . '00' . $yu + 1;
            $AccountingGuide->AccountName = $request->name;
            $AccountingGuide->AccountNameEn = $request->name;
            $AccountingGuide->type = $Account->AccountName;
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount = 0;
            $AccountingGuide->Account_Source = 1;
            $AccountingGuide->Account_status = 1;
            $AccountingGuide->SourceID = $Account->AccountID;
            $AccountingGuide->typeProcsss = 1;
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

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('suppliers.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
            $supplier = Supplier::findorFail($id);
            return view('admin.suppliers.show')->with('supplier', $supplier);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
            $supplier = Supplier::findorFail($id);
            return view('admin.suppliers.edit')->with('supplier', $supplier);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
            $supplier = Supplier::findorFail($id);
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
            ]);
            $supplier->name = $request->name;
            $supplier->area = $request->area;
            $supplier->city = $request->city;
            $supplier->district = $request->district;
            $supplier->address = $request->address;
            $supplier->vatNo = $request->vatNo;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->orgID = auth()->user()->orgID;
            $supplier->branchID = auth()->user()->branchID;
            $supplier->userID = auth()->user()->id;
            $supplier->save();
            $AccountingGuide = Accounting_guide::where('AccountID', $request->AccountID)
                ->where('orgID', auth()->user()->orgID)
                ->FirstorFail();

            $AccountingGuide->AccountName = $request->name;
            $AccountingGuide->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('suppliers.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
            $supplier = Supplier::findorFail($id);
            //then Delete Supplier
            $supplier->status = 5;
            $supplier->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('suppliers.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }
}
