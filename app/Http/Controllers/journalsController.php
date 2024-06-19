<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Journal;
use App\Models\JournalSub;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class journalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */

    public function pdf($id)
    {
        try {
            $Journal = Journal::findorFail($id);
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
            $mpdf->WriteHTML(view('pdf.journals', ['Journal' => $Journal]));
            $mpdf->Output();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في   تحميل pdf ');
            return redirect()->back();
        }
    }
    public function index()
    {
        //
        try {
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'pageJournal');

            $Journal = Journal::where('orgID', auth()->user()->orgID)->get();

            return view('admin.Accounts.journals.index')->with('Journal', $Journal);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        session()->put('page', 'AccountingGuide');
        session()->put('sub-page', 'pageJournal');
        try {
            $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)->get();
            $Journal = Journal::all()->last();
            if ($Journal == null) {
                $count = $Journal = 1;
            } else {
                $count = $Journal->id + 1;
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

        return view('admin.Accounts.journals.create', ['AccountingGuide' => $AccountingGuide, 'Journal' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'Refjournals' => 'required',
            'datejournals' => 'required',
            'dec' => 'required',
        ]);

        try {
            $Journal = new Journal();
            $Journal->Debit = '0';
            $Journal->Credit = '0';
            $Journal->dec = $request->dec;
            $Journal->Total = $request->journalsTotal;
            $Journal->Ref = $request->Refjournals;
            $Journal->Type = 0;
            $Journal->userID = auth()->user()->id;
            $Journal->date = $request->datejournals;
            $Journal->kind = 1;
            $Journal->Items = $request->flagCounter;
            $Journal->orgID = auth()->user()->orgID;
            $Journal->save();

            // $JournalID =Journal::all()->last();

            for ($x = 0; $x < $request->flagCounter; $x++) {
                $data1 = explode('::', $request->selectAcount[$x]);

                $Journalsub = new JournalSub();
                $Journalsub->nameAccount = $data1[2];
                $Journalsub->CodeAccount = $data1[1];
                $Journalsub->Debit = $request->DebitSub[$x];
                $Journalsub->Credit = $request->CreditSub[$x];
                $Journalsub->AccountID = $data1[0];
                if ($request->decSub[$x] == null) {
                    $Journalsub->dec = ' ';
                } else {
                    $Journalsub->dec = $request->decSub[$x];
                }

                $Journalsub->CostCenter = '000';
                $Journalsub->journalID = $Journal->id;
                $Journalsub->orgID = auth()->user()->orgID;
                $Journalsub->branchID = auth()->user()->branchID;
                $Journalsub->userID = auth()->user()->id;
                $Journalsub->date = $request->datejournals;

                $Journalsub->save();

                $rop = $Journalsub->Accounting_guide->ReportData;
                if ($request->DebitSub[$x] != null) {
                    $rop->debitSecond = $request->DebitSub[$x] + $rop->debitSecond;
                }
                if ($request->CreditSub[$x] != null) {
                    $rop->creditSecond = $request->CreditSub[$x] + $rop->creditSecond;
                }
                $rop->save();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('journals.index'));
    }

    public function SearchAccount(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $data = Accounting_guide::where('AccountName', 'LIKE', "%$request->q%")
                ->where('orgID', auth()->user()->orgID)
                ->get();
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $Journal = Journal::findorFail($id);
            $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));

            return redirect()->back();
        }

        return view('admin.Accounts.journals.show', ['AccountingGuide' => $AccountingGuide, 'Journal' => $Journal]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $Journal = Journal::findorFail($id);
            $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }

        return view('admin.Accounts.journals.edit', ['AccountingGuide' => $AccountingGuide, 'Journal' => $Journal]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        //    dd($request->all());
        try {
            $Journal = Journal::findorFail($id);

            $Journal->dec = $request->dec;
            $Journal->Total = $request->journalsTotal;
            $Journal->Ref = $request->Refjournals;
            $Journal->userID = auth()->user()->id;
            $Journal->date = $request->datejournals;
            $Journal->Items = $request->flagCounter;
            $Journal->save();

            foreach ($Journal->JournalChild as $items) {
                $rop = $items->Accounting_guide->ReportData;
                if ($items->Debit != 0) {
                    $rop->creditSecond = $items->Debit + $rop->creditSecond;
                }
                if ($items->Credit != 0) {
                    $rop->debitSecond = $items->Credit + $rop->debitSecond;
                }
                $rop->save();
            }

            // $Journal = JournalSub::where('journalID','=',$id)->get();
            $Journal->JournalChild()->delete();
            for ($x = 0; $x < $request->flagCounter; $x++) {
                $data1 = explode('::', $request->selectAcount[$x]);

                // dd(   $data1);
                $Journalsub = new JournalSub();
                $Journalsub->nameAccount = $data1[2];
                $Journalsub->CodeAccount = $data1[1];
                $Journalsub->Debit = $request->DebitSub[$x];
                $Journalsub->Credit = $request->CreditSub[$x];
                $Journalsub->AccountID = $data1[0];
                if ($request->decSub[$x] == null) {
                    $Journalsub->dec = ' ';
                } else {
                    $Journalsub->dec = $request->decSub[$x];
                }

                $Journalsub->CostCenter = '000';
                $Journalsub->journalID = $Journal->id;
                $Journalsub->orgID = auth()->user()->orgID;
                $Journalsub->branchID = auth()->user()->branchID;
                $Journalsub->userID = auth()->user()->id;
                $Journalsub->date = $request->datejournals;

                $Journalsub->save();

                $rop = $Journalsub->Accounting_guide->ReportData;
                if ($request->DebitSub[$x] != null) {
                    $rop->debitSecond = $request->DebitSub[$x] + $rop->debitSecond;
                }
                if ($request->CreditSub[$x] != null) {
                    $rop->creditSecond = $request->CreditSub[$x] + $rop->creditSecond;
                }
                $rop->save();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('journals.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
