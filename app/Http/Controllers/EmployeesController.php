<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Role;
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
use App\Models\Penaltie;
use App\Models\Advance;
use App\Models\Terms;

use League\CommonMark\Node\Block\Document;

class EmployeesController extends Controller
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
            session()->put('sub-page', 'employees');
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd( $customers->all());
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('admin.employees.index')->with('employees', $employees);
    }

    public function departments()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-second-page', 'notics');
            session()->put('sub-page', 'departments');
            $departs = Department::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        // dd( $customers->all());
        return view('admin.employees.departments')->with('departs', $departs);
    }
    public function jobs()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-second-page', 'notics');
            session()->put('sub-page', 'jobs');
            $jobs = Job::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        // dd( $customers->all());
        return view('admin.employees.jobs')->with('jobs', $jobs);
    }

    public function allowances()
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'allowances');
            $allowances = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        // dd( $customers->all());
        return view('admin.employees.allowances')->with('allowances', $allowances);
    }

    public function salaries()
    {
        //Empallowan  Allowan
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'salaries');
            $salaries = Salary::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            // dd($employees_all[0]->Salary);
            return view('admin.employees.Salaries')->with('salaries', $salaries)->with('employees', $employees)->with('employees_all', $employees_all);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function payrolls()
    {
        //->where('month',$daat)
        //Empallowan  Allowan
        try {
            $daat = date('Y-m');
            //dd($daat);
            session()->put('page', 'HR');
            session()->put('sub-page', 'salaries');
            $allowns = Allowan::where('Status', 1)
                ->where('type', 'allown')
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $deducts = Allowan::where('Status', 1)
                ->where('type', 'deducts')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            //$allowns=Allowan::where('Status',1)->where('orgID',auth()->user()->orgID)->where('type','deducts')->get();

            $salaries = Salary::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            //$employees_all = Employee::where('status',1)->where('orgID',auth()->user()->orgID)->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            //$payrolls = Payroll::where('Status',1)->where('orgID',auth()->user()->orgID)->get();
            $payrolls = Payroll::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            //dd($salaries[0]);
            //dd(  $allaw[0]->Empallowan->where('empID','=','1'));
            return view('admin.employees.payrolls')->with('payrolls', $payrolls)->with('employees', $employees)->with('allowns', $allowns)->with('deducts', $deducts)->with('month', $daat);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function payrollsbymonth($month)
    {
        try {
            //Empallowan  Allowan
            $daat = $month;
            //dd($daat);
            session()->put('page', 'HR');
            session()->put('sub-page', 'salaries');
            $allowns = Allowan::where('Status', 1)
                ->where('type', 'allown')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $deducts = Allowan::where('Status', 1)
                ->where('type', 'deducts')
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $payrolls = Payroll::where('Status', 1)
                ->where('month', $daat)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.employees.payrolls')->with('payrolls', $payrolls)->with('employees', $employees)->with('allowns', $allowns)->with('deducts', $deducts)->with('month', $daat);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function showPage2($month)
    {
        try {
            $daat = date('Y-m');

            $daat = $month;

            session()->put('page', 'HR');
            session()->put('sub-page', 'salaries');
            $allowns = Allowan::where('Status', 1)
                ->where('type', 'allown')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $deducts = Allowan::where('Status', 1)
                ->where('type', 'deducts')
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $payrolls = Payroll::where('Status', 1)
                ->where('month', $daat)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.showPage')->with('payrolls', $payrolls)->with('employees', $employees)->with('month', $month)->with('allowns', $allowns)->with('deducts', $deducts);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function showSalary($id)
    {
        try {
            //Empallowan  Allowan
            //$daat = date('Y-m');
            //dd($daat);
            session()->put('page', 'HR');
            session()->put('sub-page', 'salaries');

            $salaries = Salary::where('Status', 1)
                ->where('empID', $id)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $allowans = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();

            $deducts = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();
            $empalown = Empallowan::where('Status', 1)->where('empID', $id)->get();

            //   dd(  $salaries->Empallowan);
            return view('admin.employees.showSalary')->with('salaries', $salaries)->with('allowans', $allowans)->with('deducts', $deducts)->with('empalown', $empalown);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function documents()
    {
        try {
            //Empallowan  Allowan

            session()->put('page', 'HR');
            session()->put('sub-page', 'documents');

            $docs = Doc::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $doctypes = DocType::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd($employees_all);

            return view('admin.employees.documents')->with('employees', $employees)->with('employees_all', $employees_all)->with('docs', $docs)->with('doctypes', $doctypes);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function documentsByID($id)
    {
        //Empallowan  Allowan
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'documents');

            $docs = Doc::where('empID', $id)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $doctypes = DocType::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd($employees_all);

            return view('admin.employees.documents')->with('employees', $employees)->with('employees_all', $employees_all)->with('docs', $docs)->with('doctypes', $doctypes);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function getByID($id)
    {
        try {
            $employee = Employee::findorFail($id);

            //dd($employee->contract($id)->contractNo);
            //dd($employee );
            // $jobs = Job::where('Status',1)->where('orgID',auth()->user()->orgID)->get();
            // $departs = Department::where('Status',1)->where('orgID',auth()->user()->orgID)->get();
            //return view('admin.employees.edit')->with('employee', $employee)->with('jobs', $jobs)->with('departs', $departs);
            return view('admin.employees.empDetails')->with('employee', $employee);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function contracts()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'contracts');
            //$docs = Doc::where('Status',1)->where('orgID',auth()->user()->orgID)->get();
            $contracts = Contract::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd($employees_all);
            return view('admin.employees.contracts.index')->with('employees', $employees)->with('employees_all', $employees_all)->with('contracts', $contracts);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    
    
       public function contractsdelete($id)
    {
        try {
            $contracts = Contract::findOrFail($id);
            $contracts->Status = 5;
            $contracts->save();
            return back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function electroniccontracts($id)
    {
        try {
            $contracts = Contract::findOrFail($id);

            $count = Contract::where('orgID', auth()->user()->orgID)->count();
            // dd(  $contracts );
            $emp = Employee::findOrFail($contracts->empID);
            //
            return view('admin.employees.contracts.show')->with('emp', $emp)->with('contracts', $contracts)->with('count', $count);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function savecontractElronpdf($id)
    {
        try {
            $contracts = Contract::findOrFail($id);

            $count = Contract::where('orgID', auth()->user()->orgID)->count();
            // dd(  $contracts );
            $emp = Employee::findOrFail($contracts->empID);
            //
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
            $mpdf->autoArabic = true;

            $mpdf->baseScript = 1;
            $mpdf->autoVietnamese = true;

            $mpdf->shrink_tables_to_fit = 1;
            $mpdf->keep_table_proportions = true;

            $mpdf->SetDisplayMode('fullpage');

            $mpdf->list_indent_first_level = 0;
            $mpdf->SetDirectionality('rtl');
            $mpdf->WriteHTML(view('pdf.contant')->with('emp', $emp)->with('contracts', $contracts)->with('count', $count));
            $mpdf->Output();
        } catch (\Exception $e) {
            return back();
        }
    }

    public function RemovecontractElron($id)
    {
        try {
            $term = Terms::findOrFail($id);
            $term->delete();
            return back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function custodies()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'custodies');

            $custodies = Custody::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.custodies')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function custodiesByID($id)
    {
        //Empallowan  Allowan
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'custodies');
            //$docs = Doc::where('Status',1)->where('orgID',auth()->user()->orgID)->get();
            $custodies = Custody::where('empID', $id)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            // dd($employees_all);
            if (auth()->user()->empID != 0) {
                session()->put('sub-page', 'empCastody');
                return view('admin.employees.castodies.empIndex')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies);
            }
            return view('admin.employees.custodies')->with('employees', $employees)->with('employees_all', $employees_all)->with('custodies', $custodies);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function subs()
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'subs');
            $subs = Subs::where('Status', 1)->get();
            $orgSub = OrgSub::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.subs')->with('subs', $subs)->with('orgSub', $orgSub);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function shifts()
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'shifts');
            $shifts = Shift::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.shifts.index')->with('shifts', $shifts);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function addSubs($id)
    {
        try {
            //Empallowan  Allowan
            session()->put('page', 'HR');
            session()->put('sub-page', 'subs');
            try {
                $orgSub = new OrgSub();
                $orgSub->orgID = auth()->user()->orgID;
                $orgSub->subID = $id;
                $orgSub->save();
            } catch (\Exception $e) {
                return back();
            }

            session()->flash('success', 'تمت التفعيل  بنجاح');

            return redirect(route('employees.subs'));
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
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'jobs');
            $jobs = Job::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $departs = Department::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $allowans = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();
            $deducts = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();
            //dd( $allowans);
            return view('admin.employees.create')->with('departs', $departs)->with('jobs', $jobs)->with('allowans', $allowans)->with('deducts', $deducts);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function createSalary($id)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'addSalary');

            $emp = Employee::where('id', $id)->first();
            $empSal = Salary::where('empID', $id)->first();
            $allowans = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();
            $deducts = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();
            //dd( $empSal);
            if ($empSal != null) {
                session()->flash('faild', 'عفوا تم إدخال تفاصيل الراتب لهذا الموظف مسبقا');
                return redirect(route('employees.salaries'));
            }
            return view('admin.employees.addSalary')->with('allowans', $allowans)->with('deducts', $deducts)->with('emp', $emp);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function createCustody($id)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'addSalary');

            $employee = Employee::where('id', $id)->first();

            return view('admin.employees.addCustody')->with('employee', $employee);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function createShift()
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'shifts');

            return view('admin.employees.shifts.create');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function newCustody($id)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'newCustody');

            $employee = Employee::where('id', $id)->first();
            $employees = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->pluck('nameAr');
            $employees_all = Employee::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.newCustody')->with('employee', $employee)->with('employees', $employees)->with('employees_all', $employees_all);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function newPayroll($id)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'payrolls');
        //`orgID``empID``salID``allowns``deducts``fullAllowns``fullDeducts``netSalary``month`
        //Allowan , Salary

        try {
            $daat = date('Y-m');
            $payrolls = Payroll::where('Status', 1)
                ->where('month', $daat)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            //if(($payrolls != null) || (!empty($payrolls)))
            if (count($payrolls) > 0) {
                // dd($payrolls);
                session()->put('PayrollError', 'عفوا تم إدخال الراتب لهذا الشهر مسبقا');
                return redirect(route('employees.payrolls'));
            }
            $employees = Employee::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            if (count($employees) > 0) {
                foreach ($employees as $index => $emp) {
                    $payroll = new Payroll();
                    $salID = Salary::where('empID', $emp->id)->first();
                    if ($salID != null) {
                        //dd( $salID);

                        $alowns = Empallowan::where('empID', $emp->id)
                            ->where('type', 'allown')
                            ->get();
                        $fullAlowns = Empallowan::where('empID', $emp->id)
                            ->where('type', 'allown')
                            ->sum('value');
                        $deducts = Empallowan::where('empID', $emp->id)
                            ->where('type', 'deducts')
                            ->get();

                        //dd($deducts);
                        $fullDeducts = Empallowan::where('empID', $emp->id)
                            ->where('type', 'deducts')
                            ->sum('value');
                        $penalts = Penaltie::where('empID', $emp->id)
                            ->where('dueDate', $daat)
                            ->where('Status', 1)
                            ->sum('amount');
                        $advances = Advance::where('empID', $emp->id)
                            ->where('dueDate', $daat)
                            ->where('Status', 2)
                            ->sum('amount');
                        //dd($fullDeducts);
                        $alnArray = [];
                        foreach ($alowns as $index => $item) {
                            array_push($alnArray, $item->value);
                        }
                        $dedArray = [];
                        foreach ($deducts as $index => $item) {
                            array_push($dedArray, $item->value);
                        }

                        //dd($dedArray);

                        $payroll->orgID = auth()->user()->orgID;
                        $payroll->salID = $salID->id;
                        $payroll->empID = $emp->id;
                        $payroll->allowns = json_encode($alnArray);
                        $payroll->deducts = json_encode($dedArray);
                        $payroll->fullAllowns = $fullAlowns;
                        $payroll->fullDeducts = $fullDeducts;
                        $payroll->netSalary = $salID->basicSalary + $fullAlowns - $fullDeducts - $penalts - $advances;
                        $payroll->month = $daat;
                        $payroll->penalties = $penalts;
                        $payroll->advances = $advances;

                        //dd($payroll);

                        $payroll->save();
                    }
                    //   else
                    //   {
                    //       session()->flash('faild', 'يرجى إدخال بيانات الرواتب اولا');
                    //   }
                }
            } else {
                session()->flash('faild', 'يرجى إدخال بيانات الموظفين والرواتب لتتمكن من إصدار كشف الرواتب');
            }
        } catch (\Exception $e) {
            return back();
        }

        //return view('admin.employees.payrolls')->with('employees', $employees)->with('employees_all', $employees_all);
        return redirect(route('employees.payrolls'));
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
            $yu = Accounting_guide::where('SourceID', '=', '124')->count();
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
            $AccountingGuide->save();
        } catch (\Exception $e) {
            return response()->json([]);
        }

        return response()->json([
            'customers' => Customer::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        // 'orgID','branchID','depID','subDepID','jobID','salaryID','nameAr','nameEn','nationality','area','city','addressAr','addressEn','phone','email','jobClass','idNo','marriedStatus','sonCount','idEndDate','hireDate'
        // $RoutAccount =RoutAccount::where('userID' ,'=',auth()->user()->id)->first();
        //$Account=  Accounting_guide::where('AccountID', '=',$RoutAccount->Customers)->first();
        //$yu=  Accounting_guide::where('SourceID', '=',  $Account->AccountID)->count();
        try {
            $Employee = new Employee();

            $this->validate($request, [
                'nameAr' => 'required',
                'phone' => 'required',
            ]);

            $Employee->orgID = auth()->user()->orgID;
            $Employee->branchID = auth()->user()->branchID;
            $Employee->userID = 0;
            $Employee->depID = $request->depID;
            $Employee->shiftID = $request->shiftID;
            // $Employee->subDepID = $request->subDepID;
            $Employee->jobID = $request->jobID;
            //$Employee->salaryID = $request->salaryID;
            $Employee->nameAr = $request->nameAr;
            $Employee->nameEn = $request->nameEn;
            $Employee->nationality = $request->nationality;

            $Employee->area = $request->area;
            $Employee->city = $request->city;

            $Employee->addressAr = $request->addressAr;
            $Employee->addressEn = $request->addressEn;
            $Employee->phone = $request->phone;
            $Employee->email = $request->email;
            $Employee->jobClass = $request->jobClass;
            $Employee->idNo = $request->idNo;
            $Employee->marriedStatus = $request->marriedStatus;
            $Employee->sonCount = $request->sonCount;

            $Employee->idEndDate = $request->idEndDate;
            $Employee->hireDate = $request->hireDate;
            $Employee->holiday = $request->holiday;
            $Employee->urgeholiday = $request->urgeholiday;
            $Employee->advance = $request->advance;

            $Employee->birthday = $request->birthday;
            $Employee->Religion = $request->Religion;
            $Employee->Gender = $request->Gender;
            $Employee->typeiqama = $request->typeiqama;
            $Employee->Special = $request->Special;
            $Employee->IBN = $request->IBN;

            //$Employee->AccountID="12400".$yu+1;
            $Employee->save();
        } catch (\Exception $e) {
            return back();
        }

        //    $empUser = new User();

        //   $empUser->name = $request->name;
        //   $empUser->email = $request->email;
        //   if($request->email == null)
        //   {
        //     $empUser->email = "emp".$Employee."@evixsys.com.sa";

        //   }

        //   $empUser->phone = $request->phone;
        //   $empass= "Evix@012024";
        //   $empUser->password = Hash::make($empass);
        //   $empUser->orgID = auth()->user()->orgID;
        //   $empUser->branchID =0;
        //   //$emprole =Role::where('orgID',auth()->user()->orgID)->where('nameEn',auth()->user()->orgID);
        //   $empUser->roleID =    $request->roleID;
        //   $empUser->ismanager = $request->isManager;
        //   $empUser->userID = auth()->user()->id;
        //   $empUser->type = 1;
        //   $empUser->save();

        session()->flash('success', 'تمت اضافة الموظف بنجاح');

        return redirect(route('employees.index'));
    }

    public function storeDep(Request $request)
    {
        // dd($request);
        try {
            $department = new Department();
            $department->orgID = auth()->user()->orgID;
            $department->nameAr = $request->nameAr;
            $department->nameEn = $request->nameEn;

            $department->save();
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.departments'));
    }

    public function storeJob(Request $request)
    {
        // dd($request);
        try {
            $job = new Job();
            $job->orgID = auth()->user()->orgID;
            $job->nameAr = $request->nameAr;
            $job->nameEn = $request->nameEn;

            $job->save();
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.jobs'));
    }

    public function storeAllow(Request $request)
    {
        try {
            // dd($request);
            $allowan = new Allowan();
            $allowan->orgID = auth()->user()->orgID;
            $allowan->nameAr = $request->nameAr;
            $allowan->nameEn = $request->nameEn;
            $allowan->type = $request->type;

            $allowan->save();
            $employees = Empallowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->distinct()
                ->get(['empID', 'orgID', 'salID']);
            //dd($employees);
            foreach ($employees as $item) {
                $empalown = new Empallowan();
                $empalown->orgID = $item->orgID;
                $empalown->empID = $item->empID;
                $empalown->allowID = $allowan->id;
                $empalown->value = 0;
                $empalown->type = $request->type;
                $empalown->salID = $item->salID;
                $empalown->save();
            }
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.allowances'));
    }
    public function storeSalary(Request $request)
    {
        $this->validate($request, [
            'basicSalary' => 'required',
            'fullSalary' => 'required',
        ]);
        try {
            $salary = new Salary();
            $salary->orgID = auth()->user()->orgID;
            $salary->empID = $request->empID;
            $salary->basicSalary = $request->basicSalary;

            $salary->fullSalary = $request->fullSalary;
            //dd($salary->fullSalary);
            $salary->save();

            $allowans = Allowan::where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();
            $deducts = Allowan::where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();
            if (count($allowans) > 0) {
                foreach ($allowans as $index => $sitem) {
                    $m = 'allow' . $index;
                    $empl = new Empallowan();

                    $empl->orgID = auth()->user()->orgID;
                    $empl->empID = $request->empID;
                    $empl->salID = $salary->id;
                    $empl->allowID = $sitem->id;
                    $empl->type = $sitem->type;
                    if ($request->$m != null) {
                        $empl->value = $request->$m;
                    }

                    $empl->save();
                }
            }
            if (count($deducts) > 0) {
                foreach ($deducts as $index => $sitem) {
                    $d = 'ded' . $index;
                    $empl = new Empallowan();

                    $empl->orgID = auth()->user()->orgID;
                    $empl->empID = $request->empID;
                    $empl->salID = $salary->id;
                    $empl->allowID = $sitem->id;
                    $empl->type = $sitem->type;

                    if ($request->$d != null) {
                        $empl->value = $request->$d;
                    }

                    $empl->save();
                }
            }
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.salaries'));
    }

    public function storeDoc(Request $request)
    {
        //Empallowan  Allowan

        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'documents');

            $docs = new Doc();
            $docs->empID = $request->empID;

            $docs->orgID = auth()->user()->orgID;
            $docs->typeID = $request->typeID;

            if ($request->hasFile('doc')) {
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
            }

            $docs->doc = $fileNametoStore;
            $docs->save();
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.documents'));
    }

    public function storeContract(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'contracts');
        try {
            $contract = new Contract();
            $contract->empID = $request->empID;

            $contract->orgID = auth()->user()->orgID;
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
            }
            if ($request->hasFile('file')) {
                $contract->file = $fileNametoStore;
            }

            $contract->save();
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.contracts'));
    }

    public function savecontractElron(Request $request)
    {
        try {
            $trem = new Terms();
            $trem->orgID = auth()->user()->orgID;
            $trem->text = $request->AddBand;
            $trem->contract = $request->contracts;
            $trem->save();
        } catch (\Exception $e) {
            return response()->json();
        }

        return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'data' => $trem]);
    }

    public function storeCustody(Request $request)
    {
        session()->put('page', 'HR');
        session()->put('sub-page', 'custodies');
        try {
            $custody = new Custody();
            $custody->empID = $request->empID;

            $custody->orgID = auth()->user()->orgID;
            $custody->itemAr = $request->itemAr;
            $custody->typeID = $request->typeID;
            $custody->quantity = $request->quantity;
            $custody->details = $request->details;

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
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.custodies'));
    }
    public function storeShift(Request $request)
    {
        try {
            session()->put('page', 'HR');
            session()->put('sub-page', 'shifts');

            $shift = new Shift();

            $shift->orgID = auth()->user()->orgID;
            $shift->nameAr = $request->nameAr;
            $shift->nameEn = $request->nameEn;
            $shift->type = $request->type;
            $shift->hours = $request->hours;
            if ($request->type == 1) {
                $shift->stTime = $request->stTime;
                $shift->enTime = $request->enTime;
            } else {
                $shift->stTime = '00:00:00';
                $shift->enTime = '00:00:00';
            }

            $shift->save();

            if ($request->ajax()) {
                $movies = Shift::where('Status', 1)->get();
                //      $shift= new Shift();

                //  $shift->orgID=1;
                //  $shift->nameAr ="testA";
                //  $shift->nameEn ="testE";
                //  $shift->type =2;
                //  $shift->hours =5;

                //  $shift->save();

                // return response()->json($movies);
            }
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('attendance.shifts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        try {
            $employee = Employee::findorFail($id);
            $salary = Salary::where('id', $employee->id);
            return view('admin.employees.show')->with('employee', $employee)->with('salary', $salary);
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
        try {
            $employee = Employee::findorFail($id);
            //dd($employee );
            $jobs = Job::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $departs = Department::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.employees.edit')->with('employee', $employee)->with('jobs', $jobs)->with('departs', $departs);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function editSalary($id)
    {
        try {
            $empSal = Salary::findorFail($id);
            //dd($empSal );
            $jobs = Job::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $departs = Department::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            $emp = Employee::where('id', $empSal->empID)->first();
            $allowans = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();
            $deducts = Allowan::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();

            //$empSal = Salary::where('empID',$id)->first();
            // $empalown = Empallowan::where('Status',1)->where('orgID',auth()->user()->orgID)->where('type','allown')->where('empID', $empSal->empID)->get();
            // $empdeduct =Empallowan::where('Status',1)->where('orgID',auth()->user()->orgID)->where('type','deducts')->where('empID', $empSal->empID)->get();

            return view('admin.employees.editSalary')->with('empSal', $empSal)->with('allowans', $allowans)->with('deducts', $deducts);
        } catch (\Exception $e) {
            return redirect()->back();
        }

        // return view('admin.employees.edit')->with('employee', $employee)->with('jobs', $jobs)->with('departs', $departs);
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
            $Employee = Employee::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required',
                'phone' => 'required',
            ]);

            // $employee->orgID = auth()->user()->orgID;
            // $employee->branchID = auth()->user()->branchID;
            // $employee->userID = auth()->user()->id;
            // $employee->nameAr = $request->nameAr;
            // $employee->area = $request->area;
            // $employee->city = $request->city;
            // $employee->addressAr = $request->addressAr;
            // $employee->phone = $request->phone;
            // $employee->email = $request->email;

            // $employee->depID = $request->depID;

            // $employee-> shiftID = $request-> shiftID;

            // $employee->jobClass = $request->jobClass;
            // $employee->idNo = $request->idNo;
            // $employee->nationality = $request->nationality;
            // $employee->marriedStatus = $request->marriedStatus;
            // $employee->sonCount = $request->sonCount;
            // $employee->idEndDate = $request->idEndDate;
            // $employee->hireDate = $request->hireDate;

            $Employee->depID = $request->depID;
            $Employee->shiftID = $request->shiftID;
            // $Employee->subDepID = $request->subDepID;
            $Employee->jobID = $request->jobID;
            //$Employee->salaryID = $request->salaryID;
            $Employee->nameAr = $request->nameAr;
            $Employee->nameEn = $request->nameEn;
            $Employee->nationality = $request->nationality;

            $Employee->area = $request->area;
            $Employee->city = $request->city;

            $Employee->addressAr = $request->addressAr;
            $Employee->addressEn = $request->addressEn;
            $Employee->phone = $request->phone;
            $Employee->email = $request->email;

            $Employee->jobClass = $request->jobClass;
            $Employee->idNo = $request->idNo;
            $Employee->marriedStatus = $request->marriedStatus;
            $Employee->sonCount = $request->sonCount;

            $Employee->idEndDate = $request->idEndDate;
            $Employee->hireDate = $request->hireDate;

            $Employee->birthday = $request->birthday;
            $Employee->Religion = $request->Religion;
            $Employee->Gender = $request->Gender;
            $Employee->typeiqama = $request->typeiqama;
            $Employee->Special = $request->Special;
            $Employee->IBN = $request->IBN;

            $Employee->save();
        } catch (\Exception $e) {
            return back();
        }

        /*$AccountingGuide = Accounting_guide::where('AccountID',$request->AccountID )->FirstorFail();
        $AccountingGuide->AccountName =  $request->name;
        $AccountingGuide->save();*/
        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('employees.index'));
    }
    public function updateInfo(Request $request, $id, $type)
    {
        //dd($request);

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
            } elseif ($type == 'shift') {
                $job = Shift::findorFail($id);
                // $this->validate(;, [
                // 'nameAr' => 'required|string|max:191',

                // ]);

                //   dd($request->all());

                $job->nameAr = $request->nameAr;
                $job->nameEn = $request->nameEn;
                $job->type = $request->type;
                $job->hours = $request->stTime;

                $job->save();

                session()->flash('success', 'تم تحديث البيانات');

                return redirect(route('attendance.shifts'));
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
                    $atten->checkTime = $atime;
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
            return back();
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        try {
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
        } catch (\Exception $e) {
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getEmployee(Request $request)
    {
        try {
            if ($request->ajax()) {
                $movies = [];

                $search = $request->q;

                $movies = Employee::select('id', 'nameAr')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where('orgID', auth()->user()->orgID)
                    ->get();

                // ->get();

                return response()->json($movies);
            }
        } catch (\Exception $e) {
            return response()->json();
        }
    }
    public function destroy($id, $type)
    {
        try {
            if ($type == 'employee') {
                $item = Employee::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.index'));
            } elseif ($type == 'allowance') {
                $item = Allowan::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.allowances'));
            } elseif ($type == 'depart') {
                $item = Department::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.departments'));
            } elseif ($type == 'doc') {
                $item = Doc::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.documents'));
            } elseif ($type == 'contract') {
                $item = Contract::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.contracts'));
            } elseif ($type == 'job') {
                $item = Job::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('employees.jobs'));
            } elseif ($type == 'shift') {
                $item = Shift::findorFail($id);

                $item->status = 0;
                $item->save();
                session()->flash('success', 'تم الحذف ');
                return redirect(route('attendance.shifts'));
            }
        } catch (\Exception $e) {
            return back();
        }
    }

    public function updatesalaryAll(Request $request, $id)
    {
        $this->validate($request, [
            'basicSalary' => 'required',
            'fullSalary' => 'required',
        ]);

        try {
            $salary = Salary::findOrFail($id);

            $salary->basicSalary = $request->basicSalary;
            $salary->fullSalary = $request->fullSalary;
            //dd($salary->fullSalary);
            $salary->save();

            $salary->Empallowan()->delete();
            $allowans = Allowan::where('orgID', auth()->user()->orgID)
                ->where('type', 'allown')
                ->get();
            $deducts = Allowan::where('orgID', auth()->user()->orgID)
                ->where('type', 'deducts')
                ->get();
            if (count($allowans) > 0) {
                foreach ($allowans as $index => $sitem) {
                    $m = 'allow' . $index;
                    $empl = new Empallowan();

                    $empl->orgID = auth()->user()->orgID;
                    $empl->empID = $request->empID;
                    $empl->salID = $salary->id;
                    $empl->allowID = $sitem->id;
                    $empl->type = $sitem->type;
                    if ($request->$m != null) {
                        $empl->value = $request->$m;
                    }

                    $empl->save();
                }
            }
            if (count($deducts) > 0) {
                foreach ($deducts as $index => $sitem) {
                    $d = 'ded' . $index;
                    $empl = new Empallowan();

                    $empl->orgID = auth()->user()->orgID;
                    $empl->empID = $request->empID;
                    $empl->salID = $salary->id;
                    $empl->allowID = $sitem->id;
                    $empl->type = $sitem->type;
                    if ($request->$d != null) {
                        $empl->value = $request->$d;
                    }

                    $empl->save();
                }
            }
        } catch (\Exception $e) {
            return back();
        }

        return redirect(route('employees.salaries'));
    }
}
