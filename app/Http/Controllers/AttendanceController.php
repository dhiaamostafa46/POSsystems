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
use App\Models\Department;
use App\Models\Job;
use App\Models\Allowan;
use App\Models\Empallowan;
use App\Models\Salary;
use App\Models\Doc;
use App\Models\DocType;
use App\Models\Contract;
use App\Models\Absence;
use App\Models\Payroll;
use App\Models\Subs;
use App\Models\OrgSub;
use App\Models\Attendance;
use App\Models\Shift;
use App\Models\AttendanceHour;

class AttendanceController extends Controller
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
            session()->put('sub-second-page', '');
            session()->put('sub-page', 'attendances');
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $attendances = Attendance::where('orgID', auth()->user()->orgID)->get();
        } catch (\Exception $e) {
            return back();
        }

        $status = '-1';

        return view('admin.employees.attendance.index')->with('attendances', $attendances)->with('status', $status);
    }

    public function ByDate(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-second-page', '');
        session()->put('sub-page', 'attendances');
        try {
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $attendances = Attendance::where('attendance.created_at', '>=', $request->dateFrom)
                ->where('attendance.created_at', '<=', $request->dateTo)
                ->where('orgID', auth()->user()->orgID)
                ->join('employees', 'employees.id', '=', 'attendance.empID')
                ->get();
            // Attendance::select('employees.id','employees.nameAr','organizations.nameAr','organizations.activity','subscribtions.endDate')
            // ->join('subscribtions', 'subscribtions.orgID', '=', 'organizations.id')
            $status = '-1';
        } catch (\Exception $e) {
            return back();
        }

        return view('admin.employees.attendance.index')->with('attendances', $attendances)->with('status', $status);

        // dd( $customers->all());
    }

    public function absenceRequests()
    {
        //Empallowan  Allowan
        session()->put('page', 'Requests');
        session()->put('sub-second-page', '');
        session()->put('sub-page', 'absenceRequests');
        try {
            $absences = Absence::where('orgID', auth()->user()->orgID)
                ->where('Status', '>', 0)
                ->get();
        } catch (\Exception $e) {
            return back();
        }

        return view('admin.employees.absence.index')->with('absences', $absences);
    }

    public function empAbsence()
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'absenceRequests');
        try {
            $absences = Absence::where('empID', auth()->user()->empID)
                ->where('Status', '>', 0)
                ->get();
        } catch (\Exception $e) {
            return back();
        }
        return view('admin.employees.absence.empIndex')->with('absences', $absences);
    }

    public function AbsByDate(Request $request, $type)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'absenceRequests');
        session()->put('dateFrom', $request->dateFrom);
        session()->put('dateTo', $request->dateTo);
        try {
            $absences = Absence::where('created_at', '>=', $request->dateFrom)
                ->where('created_at', '<=', $request->dateTo)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            if ($type == 2) {
                $absences = Absence::where('created_at', '>=', $request->dateFrom)
                    ->where('created_at', '<=', $request->dateTo)
                    ->where('empID', auth()->user()->empID)
                    ->get();
                return view('admin.employees.absence.empIndex')->with('absences', $absences);
            }
        } catch (\Exception $e) {
            return back();
        }
        return view('admin.employees.absence.index')->with('absences', $absences);
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
        session()->flash('success', 'تمت اضافة الموظف بنجاح');

        return redirect(route('employees.index'));
    }
    public function storeAbsence(Request $request)
    {
        try {
            $abs = new Absence();
            $abs->orgID = auth()->user()->orgID;
            $abs->empID = auth()->user()->empID;
            $abs->from = $request->timeFrom;
            $abs->to = $request->timeTo;
            $abs->hours = $request->hours;
            $abs->details = $request->details;
            $abs->absDate = $request->reqdate;
            $abs->save();
            session()->flash('success', 'تمت الإضافة  ');
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('absenceRequests.empAbsence'));
    }

    public function updateAbsStatus($id, $status)
    {
        try {
            $absence = Absence::findorFail($id);

            $absence->status = $status;

            $absence->save();
        } catch (\Exception $e) {
            return back();
        }

        session()->flash('success', 'تمت العملية');
        return redirect(route('absenceRequests.index'));
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
        } catch (\Exception $e) {
            return back();
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
        $employee = Employee::findorFail($id);

        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('employees.index'));
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
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function empHourAttendance()
    {
        try {
            $attendances = AttendanceHour::where('userID', auth()->user()->id)->get();
            $status = '-1';
        } catch (\Exception $e) {
            return back();
        }
        // dd($attendances);
        return view('admin.employees.attendance.empHourIndex')->with('attendances', $attendances)->with('status', $status);
    }
    public function empAttendance()
    {
        try {
            //$attendances = Attendance::where('userID',auth()->user()->id)->where('created_at','>=',Carbon::now())->get();
            $attendances = Attendance::where('userID', auth()->user()->id)->get();
            // $status="-1";
            // session()->put('atstatus',-1);

            $dates = self::getDays();
        } catch (\Exception $e) {
            return back();
        }

        return view('admin.employees.attendance.empIndex')->with('attendances', $attendances)->with('dates', $dates);
    }
    public function storeAttendance($lat, $long, $type)
    {
        try {
            //dd($lat);
            $time = Carbon::now('Asia/Riyadh');
            $dt = $time->toArray();
            $currtime = $dt['hour'] . ':' . $dt['minute'] . ':' . $dt['second'];
            //dd($atime);
            $daat = date('Y-m-d');
            //->where('Status',1)
            $check = Attendance::where('userID', auth()->user()->id)
                ->where('created_at', '>=', $daat)
                ->first();
            //dd($check);
            if ($check == null) {
                if ($type == 2) {
                    $status = 33;
                    session()->put('atstatus', 33);
                    $attendances = Attendance::where('userID', auth()->user()->id)->get();
                    $dates = self::getDays();
                    return redirect(route('attendance.empAttendance'));
                    //return view('admin.employees.attendance.empIndex')->with('attendances',$attendances)->with('status',$status)->with('dates', $dates);
                }
                $unit = 'K';

                $branch = Branch::where('id', auth()->user()->branchID)->first();

                $disResult = self::distance($lat, $long, $branch->lat, $branch->long, $unit);
                $result = $disResult * 1000;
                $brDistance = $branch->distance;
                //dd($branch);
                // $status="1";
                session()->put('atstatus', 1);
                if ($result <= $brDistance) {
                    // session()->flash('success', 'تم تسجيل الحضور');

                    $status = 1;
                    session()->put('atstatus', 1);
                    $d = $time->toArray();
                    $atime = $d['hour'] . ':' . $d['minute'] . ':' . $d['second'];

                    //$daat = date('Y-m-d');
                    $atten = new Attendance();

                    $atten->orgID = auth()->user()->orgID;
                    $atten->userID = auth()->user()->id;
                    $atten->empID = auth()->user()->empID;
                    $atten->type = $type;

                    $atten->checkTime = $currtime;
                    $atten->distance = $result;
                    $atten->lat = $lat;
                    $atten->lon = $long;
                    $atten->created_at = $daat;

                    $atten->save();
                } else {
                    $status = 0;
                    session()->put('atstatus', 5);
                }
                $dates = self::getDays();
                $attendances = Attendance::where('userID', auth()->user()->id)->get();

                return redirect(route('attendance.empAttendance'));
                // return view('admin.employees.attendance.empIndex')->with('attendances',$attendances)->with('status',$status)->with('dates', $dates);
            } else {
                // dd($check);
                if ($type == 2 && $check->checkoutTime == null) {
                    $check->checkoutTime = $currtime;
                    $check->save();
                    $status = 11;
                    session()->put('atstatus', 11);
                } else {
                    $status = 2;
                    session()->put('atstatus', 2);
                }
                $attendances = Attendance::where('userID', auth()->user()->id)->get();
                return redirect(route('attendance.empAttendance'));
                //return view('admin.employees.attendance.empIndex')->with('attendances',$attendances)->with('status',$status);
            }
        } catch (\Exception $e) {
            return back();
        }
    }
    public function storeHourAttendance($lat, $long)
    {
        try {
            $time = Carbon::now('Asia/Riyadh');
            $dt = $time->toArray();
            $currtime = $dt['hour'] . ':' . $dt['minute'] . ':' . $dt['second'];
            //dd($currtime);
            $daat = date('Y-m-d');
            //->where('Status',1)
            $check = Attendance::where('userID', auth()->user()->id)
                ->where('created_at', '>=', $daat)
                ->first();

            $unit = 'K';

            $branch = Branch::where('id', auth()->user()->branchID)->first();

            $disResult = self::distance($lat, $long, $branch->lat, $branch->long, $unit);
            $result = $disResult * 1000;
            $brDistance = $branch->distance;
            //dd($branch);
            $status = '1';
            //dd($result.$lat.$long);
            if ($result <= $brDistance) {
                //dd($result);
                session()->put('atstatus', 1);
                $status = 1;
                $d = $time->toArray();
                $atime = $d['hour'] . ':' . $d['minute'] . ':' . $d['second'];

                //$daat = date('Y-m-d');
                $atten = new AttendanceHour();

                $atten->orgID = auth()->user()->orgID;
                $atten->userID = auth()->user()->id;
                $atten->empID = auth()->user()->empID;
                $atten->checkTime = $currtime;

                $atten->created_at = $daat;
                //dd($atten);
                $atten->save();
                //dd($atten);
            } else {
                $status = 0;
                session()->put('atstatus', 5);
            }
            $dates = self::getDays();
            $attendances = Attendance::where('userID', auth()->user()->id)->get();
        } catch (\Exception $e) {
            return back();
        }
        return redirect(route('attendance.empHourAttendance'));
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == 'K') {
            return $miles * 1.609344;
        } elseif ($unit == 'N') {
            return $miles * 0.8684;
        } else {
            return $miles;
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
        } catch (\Exception $e) {
            return back();
        }
        session()->flash('success', 'تم حذف العميل');
        return redirect(route('customers.index'));
    }

    public function getDays()
    {
        try {
            $start = Carbon::now()->startOfMonth();
            $months_to_render = Carbon::now()->diffInDays($start);

            $dates = [];

            for ($i = 0; $i <= $months_to_render; $i++) {
                $dates[] = $start->toDateTimeString();
                $start->addDay();
            }

            return $dates;
        } catch (\Exception $e) {
            return back();
        }
    }
}
