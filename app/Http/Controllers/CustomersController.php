<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Customer;
use App\Models\Loginrecord;
use App\Models\ReportData;
use App\Models\RoutAccount;

class CustomersController extends Controller
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
            session()->put('page', 'customers');
            session()->put('sub-page', 'customersList');
            $customers = Customer::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd( $customers->all());
            return view('admin.customers.index')->with('customers', $customers);
        } catch (\Exception $e) {
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
        session()->put('page', 'customers');
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try {
            $yu = Accounting_guide::where('SourceID', '=', '124')
                ->where('orgID', auth()->user()->orgID)
                ->count();
            $sum = $yu + 1;

            $customer = new Customer();

            $customer->name = $request->name;
            $customer->area = $request->area;
            $customer->city = $request->city;
            $customer->district = $request->district;
            $customer->addressAr = $request->address;
            $customer->addressEn = $request->address;
            $customer->vatNo = $request->vatNo;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->orgID = auth()->user()->orgID;
            $customer->branchID = auth()->user()->branchID;
            $customer->userID = auth()->user()->id;
            $customer->AccountID = '12400' . $sum;
            $customer->save();

            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID = '12400' . $sum;
            $AccountingGuide->AccountName = $request->name;
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

            return response()->json([
                'customers' => Customer::where('status', 1)
                    ->where('orgID', auth()->user()->orgID)
                    ->get(),
            ]);
        } catch (\Exception $e) {
           return  response()->json([]);
        }
    }

    public function store(Request $request)
    {
        try {
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Customers)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $yu = Accounting_guide::where('SourceID', '=', $Account->AccountID)
                ->where('orgID', auth()->user()->orgID)
                ->count();

            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
            ]);
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->area = $request->area;
            $customer->city = $request->city;
            $customer->district = $request->district;
            $customer->addressAr = $request->address;
            $customer->addressEn = $request->address;
            $customer->vatNo = $request->vatNo;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->orgID = auth()->user()->orgID;
            $customer->branchID = auth()->user()->branchID;
            $customer->userID = auth()->user()->id;
            $customer->AccountID = '12400' . $yu + 1;
            $customer->save();

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

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('customers.index'));
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
            $customer = Customer::findorFail($id);
            return view('admin.customers.show')->with('customer', $customer);
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
            $customer = Customer::findorFail($id);
            return view('admin.customers.edit')->with('customer', $customer);
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
            $customer = Customer::findorFail($id);
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
            ]);

            if ($customer->AccountID == null) {
                $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
                $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Customers)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $yu = Accounting_guide::where('SourceID', '=', $Account->AccountID)
                    ->where('orgID', auth()->user()->orgID)
                    ->count();
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

                $customer->AccountID = $Account->AccountID . '00' . $yu + 1;
            }

            $customer->name = $request->name;
            $customer->area = $request->area;
            $customer->city = $request->city;
            $customer->district = $request->district;
            $customer->addressAr = $request->address;
            $customer->addressEn = $request->address;
            $customer->vatNo = $request->vatNo;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->orgID = auth()->user()->orgID;
            $customer->branchID = auth()->user()->branchID;
            $customer->userID = auth()->user()->id;
            $customer->save();

            $AccountingGuide = Accounting_guide::where('AccountID', $request->AccountID)
                ->where('orgID', auth()->user()->orgID)
                ->FirstorFail();
            $AccountingGuide->AccountName = $request->name;
            $AccountingGuide->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('customers.index'));
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
            $customer = Customer::findorFail($id);

            //then Delete Customer
            $customer->status = 5;
            $customer->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('customers.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
