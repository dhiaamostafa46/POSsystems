<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\OpeningBalances;
use Exception;
use Illuminate\Http\Request;

class OpeningBalancesController extends Controller
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
        try {
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'pageOpeningBalances');

            // $OpeningBalances =OpeningBalances::all();
            $OpeningBalances = OpeningBalances::where('orgID', auth()->user()->orgID)->get();

            return view('admin.Accounts.OpeningBalances.index')->with('OpeningBalances', $OpeningBalances);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'pageOpeningBalances');
            try {
                $account = Accounting_guide::where('Account_status', '=', '1')
                    ->where('AccountID', 'LIKE', '1%')
                    ->where('orgID', auth()->user()->orgID)
                    ->orderBy('AccountID')
                    ->get();
            } catch (Exception $e) {
                session()->flash('faild', trans('Dadhoard.Displayerror'));
                return redirect()->back();
            }
            return view('admin.Accounts.OpeningBalances.create')->with('account', $account);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function serach()
    {
        $data = Accounting_guide::where('orgID', auth()->user()->orgID)->get();
        $output = '';
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display: block; position: absolute; z-index: 1 ">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item  EntryItemsearch"  data-r="2" data-id="' . $row->id . '">' . $row->AccountID . '-' . $row->AccountName . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="list-group-item">' . 'No Data Found' . '</li>';
        }
        return $output;
    }

    public function AccountFather(string $request)
    {
        $yu = Accounting_guide::findorFail($request);
        return response()->json(['count' => $yu], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            for ($x = 0; $x < $request->flagCounter; $x++) {
                $Journalsub = new OpeningBalances();
                $Journalsub->nameAccount = $request->NameAccount[$x];
                $Journalsub->CodeAccount = $request->CodeAccount[$x];
                $Journalsub->Debit = $request->DebitSub[$x];
                $Journalsub->Credit = 0;
                $Journalsub->date = $request->datatime;
                $Journalsub->desc = $request->decSub[$x];
                $Journalsub->UserID = auth()->user()->id;
                $Journalsub->AccountID = $request->AcountID[$x];
                $Journalsub->orgID = auth()->user()->orgID;
                $Journalsub->save();

                $Open = $Journalsub->Accounting_guide->ReportData;
                $Open->debitFrist = $Open->debitFrist + $request->DebitSub[$x];
                $Open->save();
            }
            $open = OpeningBalances::sum('Debit');
            $account = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '31')
                ->get();
            $Repot = $account[0]->ReportData;
            $Repot->creditFrist = $open;
            $Repot->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('OpeningBalances.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'pageOpeningBalances');
            $data = OpeningBalances::findorFail($id);
            return view('admin.Accounts.OpeningBalances.edit', ['data' => $data]);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'nameAccount' => 'required',

            'Debit' => 'required',
        ]);

        try {
            $bank = OpeningBalances::findorFail($id);
            $bank->nameAccount = $request->nameAccount;
            $bank->date = $request->date;
            $bank->Debit = $request->Debit;
            $bank->desc = $request->desc;
            $bank->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Updatedsuccessfully'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Errorupdating'));

        return redirect(route('OpeningBalances.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
