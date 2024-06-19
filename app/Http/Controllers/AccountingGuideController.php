<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\OpeningBalances;
use App\Models\ReportData;
use Exception;
use Illuminate\Http\Request;

class AccountingGuideController extends Controller
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
        //  dd(AccountAllData());

        try {
            $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)->count();

            if ($AccountingGuide == 0) {
                $data = AccountAllData();
                foreach ($data as $row) {
                    $AccountingGuide = new Accounting_guide();
                    $AccountingGuide->AccountID = $row['id'];
                    $AccountingGuide->AccountName = $row['name'];
                    $AccountingGuide->AccountNameEn = $row['val0'];
                    $AccountingGuide->type = $row['main'];
                    $AccountingGuide->maxAccount = 0;
                    $AccountingGuide->minAccount = 0;
                    $AccountingGuide->Account_Source = 0;
                    $AccountingGuide->Account_status = $row['status'];
                    $AccountingGuide->SourceID = $row['father'];
                    $AccountingGuide->typeProcsss = $row['type'];
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
                }
            }
        } catch (\Exception $e) {
            return back();
        }

        session()->put('page', 'AccountingGuide');
        session()->put('sub-page', 'pageAccountingGuide');
        $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)
            ->where('SourceID', '0')
            ->get();
        //dd($AccountingGuide);
        return view('admin.AccountingGuide.index')->with('Guide', $AccountingGuide);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'pageAccountingGuide');
            $AccountingGuide = Accounting_guide::where('Account_status', '=', '0')
                ->where('orgID', auth()->user()->orgID)
                ->orderBy('AccountID')
                ->get();
        } catch (\Exception $e) {
            return back();
        }

        return view('admin.AccountingGuide.create')->with('AccountingGuide', $AccountingGuide);
    }

    public function getPurProds(Request $request)
    {
        if ($request->ajax()) {
            $movies = [];

            $search = $request->q;

            $movies = Accounting_guide::select('id', 'AccountID', 'AccountName')
                ->where('AccountName', 'LIKE', "%$search%")
                ->where('orgID', auth()->user()->orgID)
                ->get();

            // ->get();

            return response()->json($movies);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd($request->all());

        $this->validate($request, [
            'nameAcc' => 'required',
            'CodeID' => 'required',
            'nameFather' => 'required',
        ]);

        try {
            $AccountingGuide = new Accounting_guide();
            $data = explode('::', $request->nameFather);

            $AccountingGuide->AccountID = $request->CodeID;
            $AccountingGuide->AccountName = $request->nameAcc;
            $AccountingGuide->AccountNameEn = $request->nameEn;
            $AccountingGuide->type = $data[1];
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount = 0;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->Account_status = $request->SourceAccount;
            $AccountingGuide->SourceID = $data[0];
            $AccountingGuide->typeProcsss = $data[2];
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
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('AccountingGuide.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        return view('admin.AccountingGuide.show');
    }

    public function AccountFather(string $request)
    {
        $yu = Accounting_guide::where('SourceID', '=', $request)
            ->where('orgID', auth()->user()->orgID)
            ->count();

        return response()->json(['count' => $yu + 1], 200);
    }
    public function Account(string $request)
    {
        $yu = Accounting_guide::where('SourceID', '=', $request)
            ->where('orgID', auth()->user()->orgID)
            ->get();

        return response()->json(['data' => $yu], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $data = Accounting_guide::findorFail($id);
            $type = Accounting_guide::where('Account_status', '=', '0')
                ->where('orgID', auth()->user()->orgID)
                ->orderBy('AccountID')
                ->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.AccountingGuide.edit', ['AccountingGuide' => $type, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'nameAcc' => 'required',
            'CodeID' => 'required',
            'nameFather' => 'required',
        ]);

        // ---------- ************************************** ---------------- //
        try {
            $AccountingGuide = Accounting_guide::findorFail($id);
            $data = explode('::', $request->nameFather);
            $AccountingGuide->AccountID = $request->CodeID;
            $AccountingGuide->AccountName = $request->nameAcc;
            $AccountingGuide->AccountNameEn = $request->nameEn;
            $AccountingGuide->Account_status = $request->SourceAccount;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->SourceID = $data[0];
            $AccountingGuide->typeProcsss = 1;
            $AccountingGuide->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Updatedsuccessfully'));
            return redirect()->back();
        }

        // ---------- ************************************** ---------------- //
        session()->flash('success', trans('Dadhoard.Errorupdating'));

        return redirect(route('AccountingGuide.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $AccountingGuide = Accounting_guide::findorFail($id);
            if ($AccountingGuide->Account_Source == 0) {
                $AccountingGuide->Account_Source = 22;
                $AccountingGuide->save();
                session()->flash('success', 'تم ايقاف الدليل');
            } else {
                $AccountingGuide->Account_Source = 0;
                $AccountingGuide->save();
                session()->flash('success', 'تم فتح الدليل');
            }
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في حذف دليل محاسبي');
            return redirect()->back();
        }

        return redirect(route('AccountingGuide.index'));
    }
}
