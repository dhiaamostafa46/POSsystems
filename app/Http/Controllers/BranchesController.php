<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Branch;
use App\Models\DepotStore;
use App\Models\Loginrecord;
use App\Models\ReportData;
use App\Models\RoutAccount;
use Exception;

class BranchesController extends Controller
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
            session()->put('page', 'branches');
            $branches = Branch::where('status', 1)->get();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا تحديث الفرع ');
            return redirect()->back();
        }
        return view('admin.branches.index')->with('branches', $branches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nameAr' => 'required',
            'phone' => 'required',
        ]);

        try {
            $branch = new Branch();
            $branch->nameAr = $request->nameAr;
            $branch->nameEn = $request->nameEn;
            $branch->area = $request->area;
            $branch->city = $request->city;
            $branch->district = $request->district;
            $branch->addressAr = $request->address;
            $branch->addressEn = $request->address;
            $branch->phone = $request->phone;
            $branch->orgID = auth()->user()->orgID;
            $branch->userID = auth()->user()->id;
            $branch->save();

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $Account = Accounting_guide::where('AccountID', '=', $RoutAccount->Store)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $yu = Accounting_guide::where('SourceID', '=', $RoutAccount->Store)
                ->where('orgID', auth()->user()->orgID)
                ->count();

            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID = $Account->AccountID . '00' . $yu + 1;
            $AccountingGuide->AccountName = 'مستودع ' . $request->nameAr;
            $AccountingGuide->AccountNameEn = 'مستودع ' . $request->nameAr;
            $AccountingGuide->type = $Account->AccountName;
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount = 0;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->Account_status = 1;
            $AccountingGuide->SourceID = $Account->AccountID;
            $AccountingGuide->typeProcsss = 0;
            $AccountingGuide->orgID = auth()->user()->orgID;
            $AccountingGuide->save();

            $bank = new DepotStore();
            $bank->AccountID = $Account->AccountID . '00' . $yu + 1;
            $bank->name = 'مستودع ' . $request->nameAr;
            $bank->status = 1;
            $bank->branchID = $branch->id;
            $bank->orgID = auth()->user()->orgID;
            $bank->GuidesID = $AccountingGuide->id;
            $bank->date = date('Y-m-d');
            $bank->save();

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

            if ($request->tablesCount >= 1) {
                for ($i = 1; $i <= $request->tablesCount; $i++) {
                    $tbl = new Tbl();

                    $tbl->tableNo = $i;
                    $tbl->orgID = auth()->user()->orgID;
                    $tbl->branchID = $branch->id;
                    $tbl->userID = auth()->user()->id;
                    $tbl->save();
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', 'خطا اضافة الفرع ');
            return redirect()->back();
        }
        session()->flash('success', 'تمت اضافة الفرع بنجاح');

        return redirect(route('organizations.index'));
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
            $branch = Branch::findorFail($id);
        } catch (Exception $e) {
            session()->flash('faild', 'خطا تحديث الفرع ');
            return redirect()->back();
        }
        return view('admin.branches.show')->with('branch', $branch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::findorFail($id);
        return view('admin.branches.edit')->with('branch', $branch);
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
        // $branch = Branch::findorFail($id);
        // $this->validate($request, [
        //     'nameAr' => 'required',
        //     'phone' => 'required',
        // ]);

        // try
        // {
        //     $branch->nameAr = $request->nameAr;
        //     $branch->nameEn = $request->nameEn;
        //     $branch->area = $request->area;
        //     $branch->city = $request->city;
        //     $branch->district = $request->district;
        //     $branch->addressAr = $request->address;
        //     $branch->addressEn = $request->address;
        //     $branch->phone = $request->phone;
        //     $branch->orgID = auth()->user()->orgID;
        //     $branch->userID = auth()->user()->id;
        //     $branch->save();
        // }
        // catch(Exception $e)
        // {
        //     session()->flash('faild', 'خطا تحديث الفرع ');
        //     return redirect()->back();
        // }
        // session()->flash('success', 'تمت تحديث الفرع بنجاح');

        // return redirect(route('organizations.index'));

        try {
            $branch = Branch::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required',
                'phone' => 'required',
                'lat' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'long' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            ]);
            // dd($request);
            $branch->nameAr = $request->nameAr;
            $branch->nameEn = $request->nameEn;
            $branch->area = $request->area;
            $branch->city = $request->city;
            $branch->district = $request->district;
            $branch->addressAr = $request->address;
            $branch->addressEn = $request->address;

            $branch->long = $request->long;
            $branch->lat = $request->lat;
            $branch->distance = $request->distance;

            $branch->phone = $request->phone;
            $branch->orgID = auth()->user()->orgID;
            $branch->userID = auth()->user()->id;
            $branch->save();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا تحديث الفرع ');
            return redirect()->back();
        }
        session()->flash('success', 'تمت تحديث الفرع بنجاح');

        return redirect(route('organizations.index'));
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
            $branch = Branch::findorFail($id);
            $branch->status = 5;
            $branch->save();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا حذف الفرع ');
            return redirect()->back();
        }

        session()->flash('success', 'تم حذف الفرع');
        return redirect(route('branches.index'));
    }
}
