<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\Customer;
use App\Models\RoutAccount;
use App\Models\Employee;
use App\Models\Loginrecord;

use App\Models\Department;
use App\Models\Job;
use App\Models\Allowan;
use App\Models\Empallowan;
use App\Models\Salary;
use App\Models\Doc;
use App\Models\DocType;
use App\Models\Contract;

use App\Models\Attendance;
use App\Models\HolidayType;

class HolidaysController extends Controller
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
            session()->put('sub-page', 'attendances');
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $holidays = Holiday::where('orgID', auth()->user()->orgID)
                ->where('Status', '>', 0)
                ->get();

            return view('admin.employees.holydays.index')->with('holidays', $holidays);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function empIndex()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'empHoliday');

            $holidays = Holiday::where('empID', auth()->user()->empID)
                ->where('Status', '>', 0)
                ->get();

            return view('admin.employees.holydays.empIndex')->with('holidays', $holidays);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function ByDate(Request $request, $type)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'Holidays');
            session()->put('dateFrom', $request->dateFrom);
            session()->put('dateTo', $request->dateTo);
            $holidays = Holiday::where('created_at', '>=', $request->dateFrom)
                ->where('created_at', '<=', $request->dateTo)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            if ($type == 2) {
                $holidays = Holiday::where('created_at', '>=', $request->dateFrom)
                    ->where('created_at', '<=', $request->dateTo)
                    ->where('empID', auth()->user()->empID)
                    ->get();
                return view('admin.employees.holydays.empIndex')->with('holidays', $holidays);
            }

            return view('admin.employees.holydays.index')->with('holidays', $holidays);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function types()
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'holidayTypes');
            $types = HolidayType::where('orgID', auth()->user()->orgID)
                ->where('Status', 1)
                ->get();

            return view('admin.employees.holydays.types')->with('types', $types);
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
            $balance = Employee::where('id', auth()->user()->empID)->first();

            $holiday = new Holiday();
            $diff = $holiday->created_at_difference($request->from, $request->to);

            if ($diff == 0) {
                session()->flash('faild', 'الرجاء إدخال التاريخ بشكل صحيح');

                return redirect(route('holydays.empIndex'));
            }
            if ($diff != $request->days - 1) {
                session()->flash('faild', 'الفترة المحددة غير مطابفة لعدد الأيام');

                return redirect(route('holydays.empIndex'));
            }
            if ($request->typeID == 1) {
                if ($diff > $balance->holiday) {
                    session()->flash('faild', 'عفوا رصيد الإجازة لا يكفي');

                    return redirect(route('holydays.empIndex'));
                }
            } else {
                if ($diff > $balance->urgeholiday) {
                    session()->flash('faild', 'عفوا رصيد الإجازة لا يكفي');

                    return redirect(route('holydays.empIndex'));
                }
            }

            $holiday->orgID = auth()->user()->orgID;
            $holiday->empID = auth()->user()->empID;
            $holiday->typeID = $request->typeID;
            $holiday->days = $request->days;
            $holiday->from = $request->from;
            $holiday->to = $request->to;
            $holiday->details = $request->details;
            $holiday->save();
            session()->flash('success', 'تم تقديم الطلب');
        } catch (\Exception $e) {
            // Handle the exception gracefully
            // You can log the error, return a specific error response, or perform any other actions
            return redirect()->back();
        }

        return redirect(route('holydays.empIndex'));
    }

    public function storeType(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'holidayTypes');
        // dd( $request->all());
        try {
            if ($request->flage == 'edit') {
                $type = HolidayType::findOrFail($request->id);
            } else {
                $type = new HolidayType();
            }

            $type->orgID = auth()->user()->orgID;
            $type->nameAr = $request->nameAr;
            $type->nameEn = $request->nameEn;
            $type->days = $request->days;
            $type->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('holydays.types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    public function showPage($id)
    {
        //dd($id);
        try {
            $employee = Employee::findorFail($id);
            $salary = Salary::where('id', $employee->id);

            return view('admin.employees.show')->with('employee', $employee);
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
            $holiday = Holiday::findorFail($id);

            $diff = $holiday->created_at_difference($request->from, $request->to);
            if ($diff == 0) {
                session()->flash('faild', 'الرجاء إدخال التاريخ بشكل صحيح');

                return redirect(route('holydays.empIndex'));
            }
            if ($request->typeID == 1) {
                if ($diff > $holiday->employees->holiday) {
                    session()->flash('faild', 'عفوا رصيد الإجازة لا يكفي');

                    return redirect(route('holydays.empIndex'));
                }
            } else {
                if ($diff > $holiday->employees->urgeholiday) {
                    session()->flash('faild', 'عفوا رصيد الإجازة لا يكفي');

                    return redirect(route('holydays.empIndex'));
                }
            }
            if ($diff != $request->days - 1) {
                session()->flash('faild', 'الفترة المحددة غير مطابفة لعدد الأيام');

                return redirect(route('holydays.empIndex'));
            }

            $holiday->typeID = $request->typeID;
            $holiday->days = $request->days;
            $holiday->from = $request->from;
            $holiday->to = $request->to;
            $holiday->details = $request->details;
            $holiday->save();

            session()->flash('success', 'تم تحديث البيانات');
        } catch (\Exception $e) {
            // Handle the exception gracefully
            // You can log the error, return a specific error response, or perform any other actions
            return redirect()->back();
        }

        return redirect(route('holydays.empIndex'));
    }
    public function updateInfo(Request $request, $id, $type)
    {
        try {
            if ($type == 'depart') {
                $depart = Department::findorFail($id);
                // $this->validate($request, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                $depart->nameAr = $request->nameAr;
                $depart->nameEn = $request->nameEn;

                $depart->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.departments'));
            } elseif ($type == 'allown') {
                $allown = Allowan::findorFail($id);
                // $this->validate($request, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                $allown->nameAr = $request->nameAr;
                $allown->nameEn = $request->nameEn;
                $allown->type = $request->type;

                $allown->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.allowances'));
            } elseif ($type == 'job') {
                $job = Job::findorFail($id);
                // $this->validate($request, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                $job->nameAr = $request->nameAr;
                $job->nameEn = $request->nameEn;

                $job->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.jobs'));
            } elseif ($type == 'doc') {
                $doc = Doc::findorFail($id);
                // $this->validate($request, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                $doc->typeID = $request->typeID;

                if ($request->hasFile('doc')) {
                    $oldfile = 'dist/empDocs' . $doc->doc;
                    if (File::exists(public_path($oldfile))) {
                        dd($oldfile);
                        File::delete($oldfile);
                    }
                    $docFile = $request->doc;
                    //get filename with extension
                    $filenameWithExt = $request->file('doc')->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just extension
                    $extension = $request->file('doc')->getClientOriginalExtension();
                    //create filename to store
                    $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                    //upload image
                    $path = $docFile->move(public_path('dist/empDocs'), $fileNametoStore);
                    //  $path = $imgFile->move(public_path('adminAssets/prodImages'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    $doc->doc = $fileNametoStore;
                }

                $doc->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.documents'));
            } elseif ($type == 'contract') {
                $contract = Contract::findorFail($id);
                // $this->validate($request, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                $contract->contractNo = $request->contractNo;
                $contract->stDate = $request->stDate;
                $contract->enDate = $request->enDate;

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
                    $path = $docFile->move(public_path('dist/empDocs/contracts'), $fileNametoStore);
                    //  $path = $imgFile->move(public_path('adminAssets/prodImages'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    $contract->file = $fileNametoStore;
                }

                $contract->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.contracts'));
            } elseif ($type == 'salary') {
                $salary = Salary::findorFail($id);
                // dd($salary);

                $salary->basicSalary = $request->basicSalary;

                $salary->fullSalary = $request->fullSalary;

                $allowans = Empallowan::where('orgID', auth()->user()->orgID)
                    ->where('type', 'allown')
                    ->where('empID', $salary->employee->id)
                    ->get();
                $deducts = Empallowan::where('orgID', auth()->user()->orgID)
                    ->where('type', 'deducts')
                    ->where('empID', $salary->employee->id)
                    ->get();
                if (count($allowans) > 0) {
                    foreach ($allowans as $index => $sitem) {
                        $m = 'allow' . $index;
                        $empl = Empallowan::where('id', $sitem->id)->first();

                        $empl->value = $request->$m;

                        $empl->save();
                    }
                }

                if (count($deducts) > 0) {
                    foreach ($deducts as $index => $sitem) {
                        $d = 'ded' . $index;
                        $empl = Empallowan::where('id', $sitem->id)->first();

                        $empl->value = $request->$d;

                        $empl->save();
                    }
                }

                $salary->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('employees.salaries'));
            }
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function updateHoliStatus($id, $status)
    {
        try {
            $holiday = Holiday::findorFail($id);

            $holiday->status = $status;
            if ($status == 2) {
                $emp = Employee::where('id', $holiday->empID)->first();
                $emp->holiday -= $holiday->days;
                $emp->save();
            }
            $holiday->save();

            session()->flash('success', 'تمت العملية');
        } catch (\Exception $e) {

            return redirect()->back();
        }
        return redirect(route('holydays.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function empAttendance()
    {
        try {
            $attendances = Attendance::where('userID', auth()->user()->id)->get();

            $status = '-1';

            return view('admin.employees.attendance.empIndex')->with('attendances', $attendances)->with('status', $status);
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
            $holiday = Holiday::findorFail($id);

            $holiday->status = 0;
            $holiday->save();
            session()->flash('success', 'تم حذف الطلب');
        } catch (\Exception $e) {
            // Handle the exception gracefully
            // You can log the error, return a specific error response, or perform any other actions
            return redirect()->back();
        }
        return redirect(route('holydays.empIndex'));
    }
}
