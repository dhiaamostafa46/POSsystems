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
use App\Models\Doc;
use App\Models\DocType;
use App\Models\Contract;
use App\Models\Attendance;
use App\Models\Shift;
use App\Models\Notic;
use App\Models\NoticDetails;
use App\Models\NoticType;

class NoticsController extends Controller
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
            session()->put('sub-second-page', 'notics');
            session()->put('sub-page', 'notics');
            //$employees = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $notics = Notic::where('orgID', auth()->user()->orgID)->get();
            return view('admin.employees.notices.index')->with('notics', $notics);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function empIndex()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'empNotic');
            $notics = Notic::where('empID', auth()->user()->empID)
                ->where('Status', '>', 0)
                ->get();
            return view('admin.employees.notices.empIndex')->with('notics', $notics);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ByDate(Request $request)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'attendances');

            session()->put('dateFrom', $request->dateFrom);
            session()->put('dateTo', $request->dateTo);
            $notics = Notic::where('created_at', '>=', $request->dateFrom)
                ->where('created_at', '<=', $request->dateTo)
                ->where('empID', auth()->user()->empID)
                ->where('Status', 1)
                ->get();

            return view('admin.employees.notices.empIndex')->with('notics', $notics);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function types()
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'noticTypes');

            $NoticType = NoticType::where('orgID', auth()->user()->orgID)->get();

            return view('admin.employees.notices.types')->with('notes', $NoticType);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $notic = new Notic();
            $notic->orgID = auth()->user()->orgID;
            $notic->empID = auth()->user()->empID;
            $notic->typeID = $request->typeID;
            $notic->details = $request->details;
            $notic->noticDate = $request->noticDate;
            $notic->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $imgFile) {
                    $pdImage = new NoticDetails();
                    //get filename with extension
                    $filenameWithExt = $imgFile->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just extension
                    $extension = $imgFile->getClientOriginalExtension();
                    //create filename to store
                    $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                    //upload image
                    $path = $imgFile->move(public_path('Notics'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    $pdImage->noticID = $notic->id;
                    $pdImage->fileURL = $fileNametoStore;
                    $pdImage->save();
                }
            }

            session()->flash('success', 'تم رفع البلاغ');

            return redirect(route('notics.empIndex'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function storeType(Request $request)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'noticTyps');

            $type = new NoticType();

            $type->orgID = auth()->user()->orgID;
            $type->nameAr = $request->nameAr;
            $type->nameEn = $request->nameEn;

            $type->save();

            return redirect(route('notics.types'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function notTypeupdate(Request $request, $id)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'noticTyps');

            $type = NoticType::findOrFail($id);

            $type->orgID = auth()->user()->orgID;
            $type->nameAr = $request->nameAr;
            $type->nameEn = $request->nameEn;

            $type->save();

            return redirect(route('notics.types'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $notic = Notic::where('id', $id)->first();
            $files = NoticDetails::where('noticID', $id)->get();

            return view('admin.employees.notices.show')->with('notic', $notic)->with('files', $files);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $notic = Notic::findorFail($id);

            $notic->typeID = $request->typeID;
            $notic->details = $request->details;
            $notic->noticDate = $request->noticDate;
            $notic->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $imgFile) {
                    $pdImage = new NoticDetails();
                    //get filename with extension
                    $filenameWithExt = $imgFile->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just extension
                    $extension = $imgFile->getClientOriginalExtension();
                    //create filename to store
                    $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                    //upload image
                    $path = $imgFile->move(public_path('Notics'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    $pdImage->noticID = $notic->id;
                    $pdImage->fileURL = $fileNametoStore;
                    $pdImage->save();
                }
            }

            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('notics.empIndex'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function updateStatus($id, $status)
    {
        try {
            $notic = Notic::findorFail($id);
            $notic->Status = $status;
            $notic->save();

            return redirect(route('notices.index'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            return redirect(route('customers.index'));
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
