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
use App\Models\Custody;
use App\Models\Payroll;
use App\Models\Subs;
use App\Models\OrgSub;
use App\Models\Attendance;
use App\Models\Shift;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\Car;

class AssetsController extends Controller
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
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'assets');
        session()->put('sub-page', 'assets');

        try {
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $assets = Asset::where('Status', 1)
                ->where('isCar', 0)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        //dd($assets);
        return view('admin.employees.assetses.index')->with('assets', $assets);
    }
    public function create()
    {
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'assets');
        session()->put('sub-page', 'assets');
        try {
            $types = AssetType::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('admin.employees.assetses.create')->with('types', $types);
    }

    public function empIndex($id)
    {
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'assets');
        session()->put('sub-page', 'empAssets');
        try {
            $employee = Employee::where('id', $id)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        //$attendances =Attendance::where('orgID',auth()->user()->orgID)->get();

        // $status="-1";

        //return view('admin.employees.holydays.index')->with('attendances',$attendances)->with('status',$status);

        return view('admin.employees.assets.empIndex');
    }

    public function ByDate(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'assets');
        session()->put('sub-page', 'attendances');
        try {
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $attendances = Attendance::where('created_at', '>=', $request->dateFrom)
                ->where('created_at', '<=', $request->dateTo)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        $status = '-1';

        return view('admin.employees.attendance.index')->with('attendances', $attendances)->with('status', $status);

        // dd( $customers->all());
    }

    public function cars()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-second-page', 'assets');
            session()->put('sub-page', 'cars');
            $assets = Asset::where('Status', 1)
                ->where('isCar', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.cars.index')->with('assets', $assets)->with('employees', $employees)->with('employees_all', $employees_all);
    }
    // public function carsCastody()
    // {
    //     session()->put('page','HR');
    //     session()->put('sub-page','cars');
    //     $custodies = Custody::where('Status','>',0)->where('orgID',auth()->user()->orgID)->get();
    //     $employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->pluck('nameAr');
    //     $employees_all = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();

    //     return view('admin.employees.cars.carsCastody')->with('custodies',$custodies)->with('employees', $employees)->with('employees_all', $employees_all);

    // }

    public function types()
    {
        //Empallowan  Allowan
        session()->put('page', 'HR');
        session()->put('sub-second-page', 'HRSettings');
        session()->put('sub-page', 'assetsTypes');
        try {
            $types = AssetType::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        //dd($types);
        return view('admin.employees.assetses.types')->with('types', $types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createShift()
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'shifts');

        return view('admin.employees.shifts.create');
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
            $asset = new Asset();
            $asset->orgID = auth()->user()->orgID;
            $asset->branchID = $request->branchID;
            $asset->typeID = $request->typeID;
            $asset->nameAr = $request->nameAr;
            $asset->nameEn = $request->nameEn;
            $asset->details = $request->details;
            $asset->assetStatus = $request->assetStatus;
            $asset->addBy = auth()->user()->id;
            $asset->deviceNo = $request->deviceNo;

            $lastserialNo = Asset::where('orgID', auth()->user()->orgID)
                ->orderBy('id', 'desc')
                ->first();

            if (!empty($lastserialNo)) {
                $asset->serialNo = $lastserialNo->serialNo + 1;
            } else {
                $oid = auth()->user()->orgID;
                $asset->serialNo = $oid . '0001';
            }

            $asset->save();
            session()->flash('success', 'تمت اضافة الاًصل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('assetses.index'));
    }

    public function storeType(Request $request)
    {
        try {
            // dd($request);
            if ($request->flage == 'edit') {
                $asType = AssetType::findOrFail($request->id);
            } else {
                $asType = new AssetType();
            }

            $asType->orgID = auth()->user()->orgID;
            $asType->nameAr = $request->nameAr;
            $asType->nameEn = $request->nameEn;
            $asType->save();

            session()->flash('success', 'تمت اضافة نوع الأصل ');
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('assetses.types'));
    }

    public function storeCar(Request $request)
    {
        try {
            $asset = new Asset();
            $asset->orgID = auth()->user()->orgID;
            $asset->branchID = $request->branchID;
            $asset->typeID = 0;
            $asset->nameAr = $request->nameAr;
            $asset->nameEn = $request->nameAr;
            $asset->details = $request->details;
            $asset->assetStatus = $request->assetStatus;
            $asset->addBy = auth()->user()->id;
            $asset->isCar = 1;
            $lastserialNo = Asset::where('orgID', auth()->user()->orgID)
                ->orderBy('id', 'desc')
                ->first();

            if (!empty($lastserialNo)) {
                $asset->serialNo = $lastserialNo->serialNo + 1;
            } else {
                $oid = auth()->user()->orgID;
                $asset->serialNo = $oid . '0001';
            }
            $asset->save();

            $car = new Car();
            $car->assetID = $asset->id;
            $car->modelNo = $request->modelNo;
            $car->bodyNo = $request->bodyNo;
            $car->blatNo = $request->blatNo;
            $car->licence = $request->licence;
            $car->insurance = $request->insurance;
            $car->licenceExpDate = $request->licenceExpDate;
            $car->insuranceExpDate = $request->insuranceExpDate;
            $car->save();
            $asset->carID = $car->id;
            $asset->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        session()->flash('success', 'تمت اضافة المركبة ');

        return redirect(route('cars.index'));
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
            $asset = Asset::findorFail($id);

            return view('admin.employees.assetses.show')->with('asset', $asset);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function showPage($id)
    {
        try {
            //dd($id);
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
            $employee = Employee::findorFail($id);

            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('employees.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
    public function storeAttendance($lat, $long)
    {
        try {
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
                $unit = 'K';

                $branch = Branch::where('id', auth()->user()->branchID)->first();

                $disResult = self::distance($lat, $long, $branch->lat, $branch->long, $unit);
                $result = $disResult * 1000;
                $brDistance = $branch->distance;
                //dd($branch);
                $status = '1';
                if ($result <= $brDistance) {
                    // session()->flash('success', 'تم تسجيل الحضور');

                    $status = 1;
                    $d = $time->toArray();
                    $atime = $d['hour'] . ':' . $d['minute'] . ':' . $d['second'];

                    //$daat = date('Y-m-d');
                    $atten = new Attendance();

                    $atten->orgID = auth()->user()->orgID;
                    $atten->userID = auth()->user()->id;
                    $atten->empID = auth()->user()->empID;
                    $atten->checkTime = $currtime;
                    $atten->distance = $result;
                    $atten->lat = $lat;
                    $atten->lon = $long;
                    $atten->created_at = $daat;

                    $atten->save();
                } else {
                    // session()->flash('faild', 'تعذر تسجيل الحضور لعدم وصولك لموقع العمل'.$result);
                    $status = 0;
                }
                $attendances = Attendance::where('userID', auth()->user()->id)->get();
                return view('admin.employees.attendance.empIndex')->with('attendances', $attendances)->with('status', $status);
            } else {
                $status = 2;
                $attendances = Attendance::where('userID', auth()->user()->id)->get();
                return view('admin.employees.attendance.empIndex')->with('attendances', $attendances)->with('status', $status);
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
            session()->flash('success', 'تم حذف العميل');
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return redirect(route('customers.index'));
    }
}
