<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\Customer;
use App\Models\RoutAccount;
use App\Models\Employee;
use App\Models\Loginrecord;
use App\Models\Accounting_guide;

use App\Models\Custody;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\Car;
use App\Models\CustodyBack;
use App\Models\Salary;

class CastodiesController extends Controller
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
            session()->put('page', 'HR');
            session()->put('sub-second-page', 'custodies');
            session()->put('sub-page', 'custodies');

            $custodies = Custody::where('Status', '>', 0)
                ->orWhere('Status', -2)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $assets = Asset::where('Status', 1)
                ->where('isCar', 0)
                ->where('isTaked', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.castodies.index')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies)->with('assets', $assets);
    }
    public function movableCastodies()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-second-page', 'custodies');
            session()->put('sub-page', 'movableCastodies');

            $custodies = Custody::where('Status', '>', 0)
                ->orWhere('Status', -2)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $assets = Asset::where('Status', 1)
                ->where('isCar', 1)
                ->where('isTaked', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.castodies.moveableCustodies')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies)->with('assets', $assets);
    }

    public function getAssModels(Request $request, $id)
    {
        try {
            //->where('nameAr', 'LIKE', "%$search%")->where('orgID', auth()->user()->orgID)->get();
            if ($request->ajax()) {
                $movies = [];

                $search = $request->q;

                $movies = Asset::select('id', 'serialNo')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->get();

                return response()->json($movies);
            }
            if ($request->ajax()) {
                return response()->json([
                    'items' => Asset::where('id', $id)->get(),
                ]);
            }
        } catch (\Exception $e) {
             return response()->json();
        }
    }
    public function empIndex($id)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'empAssets');
            $employee = Employee::where('id', $id)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('admin.employees.assets.empIndex');
    }

    public function custodiesByID($id)
    {
        //Empallowan  Allowan
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'custodies');

            $custodies = Custody::where('empID', $id)
                ->where('Status', '>', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $assets = Asset::where('Status', 1)
                ->where('isCar', 0)
                ->where('isTaked', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            if (auth()->user()->empID != 0) {
                session()->put('sub-page', 'empCastody');

                return view('admin.employees.castodies.empIndex')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies);
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
        //    dd($assets);
        return view('admin.employees.castodies.index')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies)->with('assets', $assets);
    }
    public function moveableCustByID($id)
    {
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'custodies');
        session()->put('sub-page', 'empMoveableCust');

        try {
            $custodies = Custody::where('empID', $id)
                ->where('Status', '>', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.castodies.empMoveCustod')->with('custodies', $custodies);
    }

    public function custReturnReq()
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'custRequest');

        try {
            $backrequests = CustodyBack::where('Status', 0)
                ->where('toEmpID', -1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        //dd($backrequests);
        return view('admin.employees.castodies.returnRequests')->with('backrequests', $backrequests);
    }
    public function empcustRequests()
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'empCustRequest');

        try {
            $backrequests = CustodyBack::where('Status', 0)
                ->where('toEmpID', auth()->user()->empID)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.castodies.empcustRequests')->with('backrequests', $backrequests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'custodies');

            $custody = new Custody();
            $custody->empID = $request->empID;

            $custody->orgID = auth()->user()->orgID;
            $custody->assetID = $request->assetID;

            $custody->quantity = 0;
            $custody->details = $request->details;
            $custody->Status = -2;

            if ($request->hasFile('file')) {
                $docFile = $request->file;
                //get filename with extension
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('file')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $docFile->move(public_path('dist/empDocs/custodies/'), $fileNametoStore);
                //  $path = $imgFile->move(public_path('adminAssets/prodImages'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                $custody->file = $fileNametoStore;
            }

            $custody->save();

            $req = new CustodyBack();
            $req->orgID = auth()->user()->orgID;
            $req->empID = -1;
            $req->toEmpID = $custody->empID;
            $req->custID = $custody->id;
            $req->details = $custody->details;
            $req->save();

            $asset = Asset::findorFail($request->assetID);

            $asset->isTaked = 1;
            $asset->save();

            if ($request->isCar == 1) {
                return redirect(route('castodies.movableCastodies'));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return redirect(route('castodies.index'));
    }

    public function ToEmp(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'custodies');

        try {
            $req = new CustodyBack();
            $req->orgID = auth()->user()->orgID;
            $req->empID = auth()->user()->empID;
            $req->toEmpID = $request->empID;
            $req->custID = $request->custID;
            $req->details = $request->details;
            $req->save();

            $cust = Custody::findorFail($request->custID);
            //$cust->Status = -2;
            $cust->Status = 6;
            $cust->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        //return redirect(route('castodies.custodiesByID',auth()->user()->empID));
        return redirect(route('custodies.moveableCustodByID', auth()->user()->empID));
    }

    public function AssetToEmp(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'custodies');

        try {
            $custody = new Custody();
            $custody->empID = $request->empID;

            $custody->orgID = auth()->user()->orgID;
            $custody->assetID = $request->assetID;

            $custody->quantity = 0;
            $custody->details = $request->details;
            $custody->Status = 8;
            $custody->save();

            $asset = Asset::findorFail($request->assetID);

            $asset->isTaked = 1;
            $asset->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('cars.index'));
    }

    public function return(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'custodies');
        try {
            $req = new CustodyBack();
            $req->orgID = auth()->user()->orgID;
            $req->empID = auth()->user()->empID;
            $req->toEmpID = -1;
            $req->custID = $request->custID;
            $req->details = $request->details;

            //dd($request);
            $req->save();

            $cust = Custody::findorFail($request->custID);
            //$cust->Status = -2;
            $cust->Status = 6;
            $cust->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('castodies.custodiesByID', auth()->user()->empID));
    }
    public function acceptReturn(Request $request)
    {
        try {
            $time = Carbon::now('Asia/Riyadh');
            $dt = $time->toArray();

            $req = CustodyBack::findorFail($request->reqID);

            $req->receivedetails = $request->details;
            $req->approvedBy = auth()->user()->id;
            $req->approveDate = $dt['formatted'];
            $req->Status = 1;

            $req->save();

            $cust = Custody::findorFail($request->custID);
            $cust->Status = 0;

            $cust->save();

            $asset = Asset::findorFail($cust->assetID);

            $asset->isTaked = 0;
            $asset->save();

            session()->flash('success', 'تمت الموافقة');
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('castodies.custReturnReq'));
    }

    public function acceptRecive(Request $request)
    {
        try {
            $time = Carbon::now('Asia/Riyadh');
            $dt = $time->toArray();

            $req = CustodyBack::findorFail($request->reqID);

            $req->receivedetails = $request->details;

            $req->approveDate = $dt['formatted'];
            $req->Status = 1;

            $req->save();
            $cust = Custody::findorFail($request->custID);
            if ($request->ctype == 1) {
                $cust->toEmpDate = $dt['formatted'];
                $cust->Status = 1;
                $cust->save();
            } else {
                $cust->toEmpDate = $dt['formatted'];
                $cust->Status = 0;
                $cust->save();

                ///////////////////////////////
                $custody = new Custody();
                $custody->empID = auth()->user()->empID;
                $custody->orgID = auth()->user()->orgID;
                $custody->assetID = $cust->assetID;
                $custody->details = $request->details;
                $custody->toEmpDate = $dt['formatted'];
                $custody->save();
            }
            session()->flash('success', 'تمت الموافقة');
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('castodies.empcustRequests'));
    }

    public function toEmpAcceptRecive(Request $request)
    {
        try {
            $time = Carbon::now('Asia/Riyadh');
            $dt = $time->toArray();

            $req = CustodyBack::findorFail($request->reqID);

            $req->receivedetails = $request->details;

            $req->approveDate = $dt['formatted'];
            $req->Status = 1;
            $req->save();
            ////////////////////
            $cust = Custody::findorFail($request->custID);
            //$cust->toEmpDate = $dt['formatted'];
            $cust->Status = 0;
            $cust->save();

            ///////////////////////////////
            $custody = new Custody();
            $custody->empID = auth()->user()->empID;
            $custody->orgID = auth()->user()->orgID;
            $custody->assetID = $request->assetID;
            $custody->details = $request->details;
            $custody->toEmpDate = $dt['formatted'];
            $custody->save();

            session()->flash('success', 'تمت الموافقة');
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return redirect(route('castodies.empcustRequests'));
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
            $cast = Custody::findorFail($id);
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('admin.employees.castodies.show')->with('cast', $cast);
    }
    public function showPage($id)
    {
        try {
            //dd($id);
            $employee = Employee::findorFail($id);
            $salary = Salary::where('id', $employee->id);
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('admin.employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            $employee = Employee::findorFail($id);
        } catch (\Exception $e) {
            return redirect()->back();
        }

        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('employees.index'));
    }

    public function updateStatus($id, $status)
    {
        try {
            $custody = Custody::findorFail($id);

            $custody->status = $status;
            if ($status == 1) {
                $time = Carbon::now('Asia/Riyadh');
                $dt = $time->toArray();
                $custody->toEmpDate = $dt['formatted'];
            }

            $custody->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        session()->flash('success', 'تمت الموافقة');
        return redirect(route('custodies.moveableCustodByID', auth()->user()->empID));
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
        } catch (\Exception $e) {
            return redirect()->back();
        }
        session()->flash('success', 'تم حذف العميل');
        return redirect(route('customers.index'));
    }
}
