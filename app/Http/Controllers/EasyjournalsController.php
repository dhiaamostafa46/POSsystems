<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Journal;
use App\Models\JournalSub;
use Exception;
use Illuminate\Http\Request;

class EasyjournalsController extends Controller
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
        session()->put('page','AccountingGuide');
        session()->put('sub-page','pageEasyjournals');
        try
        {
        $Journal =Journal::where('Type' ,'!=','0')->where('orgID',auth()->user()->orgID)->get();
        }
        catch(Exception $e)
        {

            session()->flash('faild',   trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Accounts.Easyjournals.index')->with('Journal',$Journal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        // dd($id);
        try
        {
            if($id==1)
            {
                $from =Accounting_guide::where('SourceID', 'LIKE', '12%')->where('SourceID', 'not LIKE', '125%')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', 'LIKE', '12%')->where('SourceID', 'not LIKE', '125%')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
            elseif($id==2)
            {
                $from =Accounting_guide::where('SourceID', '=', '3')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', 'LIKE', '1%')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
            elseif($id==3)
            {
                $from =Accounting_guide::where('SourceID', '=', '11')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', 'LIKE', '5%')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
            elseif($id==4)
            {
                $from =Accounting_guide::where('SourceID', 'LIKE', '1%')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', '=', '3')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
            elseif($id==5)
            {
                $from =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
            elseif($id==6)
            {
                $from =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                $to =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->orderBy('AccountID','DESC')->get();
                return view('admin.Accounts.Easyjournals.create',['from'=>  $from ,'To' =>$to,"id"=>$id]);
            }
        }
        catch(Exception $e)
        {
            session()->flash('faild', 'خطا في   القيود ');
            return redirect()->back();
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'FromEntries' => 'required',
            'ToEntries' => 'required',
            'amount' => 'required',
            'desc' => 'required',
        ]);
        try
        {
            $Journal = new Journal();
            $Journal->Debit = "0";
            $Journal->Credit = "0";
            $Journal->dec = $request->desc;
            $Journal->Total = $request->amount;
            $Journal->Ref =  "حركة مال";
            $Journal->Type =  $request->idProcessor;
            $Journal->userID =  auth()->user()->id;
            $Journal->date = $request->DateEntries;
            $Journal->kind =  1;
            $Journal->Items = 2;
            $Journal->orgID = auth()->user()->orgID;
            $Journal->save();

            $lastJournal =Journal::all()->last();

            $data1=explode("::",  $request->FromEntries);
            $data2=explode("::",  $request->ToEntries);

            $Journalsub = new JournalSub();
            $Journalsub->nameAccount     =  $data1[2];
            $Journalsub->CodeAccount	 =  $data1[1];
            $Journalsub->Debit           =  $request->amount;
            $Journalsub->Credit          =  "0";
            $Journalsub->dec             =  $request->desc;
            $Journalsub->CostCenter      =  "000";
            $Journalsub->journalID       =  $lastJournal->id;
            $Journalsub->AccountID          =  $data1[0];
            $Journalsub->save();

            $rop=  $Journalsub->Accounting_guide->ReportData;
            $rop->debitSecond=$request->amount + $rop->debitSecond;
            $rop->save();

            $Journalsub = new JournalSub();
            $Journalsub->nameAccount     =  $data2[2];
            $Journalsub->CodeAccount	 =  $data2[1];
            $Journalsub->Debit           =  "0";
            $Journalsub->Credit          =  $request->amount;
            $Journalsub->dec             =  $request->desc;
            $Journalsub->CostCenter      =  "000";
            $Journalsub->journalID       =  $lastJournal->id;
            $Journalsub->AccountID          =  $data2[0];
            $Journalsub->save();
            $rop=  $Journalsub->Accounting_guide->ReportData;
            $rop->creditSecond=$request->amount + $rop->creditSecond;
            $rop->save();
    }
    catch(Exception $e)
    {
        session()->flash('faild',    trans('Dadhoard.Erroradding'));
        return redirect()->back();
    }


        session()->flash('success',    trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('Easyjournals.index'));
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
        try
        {
            $data = Journal::findorFail($id);


            // dd(  $data->JournalChild[0]->nameAccount);
            if($data->Type==1)
            {
                $from =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
            elseif($data->Type==2)
            {
                $from =Accounting_guide::where('SourceID', '=', '3')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', 'LIKE', '1%')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
            elseif($data->Type==3)
            {
                $from =Accounting_guide::where('SourceID', '=', '11')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', 'LIKE', '5%')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
            elseif($data->Type==4)
            {
                $from =Accounting_guide::where('SourceID', 'LIKE', '1%')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', '=', '3')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
            elseif($data->Type==5)
            {
                $from =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
            elseif($data->Type==6)
            {
                $from =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                $to =Accounting_guide::where('SourceID', '=', '12')->where('orgID',auth()->user()->orgID)->get();
                return view('admin.Accounts.Easyjournals.edit',['from'=>  $from ,'To' =>$to,"data"=>$data]);
            }
    }
    catch(Exception $e)
    {
        session()->flash('faild', 'خطا في   القيود ');
        return redirect()->back();
    }

       // return view('admin.Accounts.Easyjournals.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //



        $this->validate($request, [
            'FromEntries' => 'required',
            'ToEntries' => 'required',
            'amount' => 'required',
            'desc' => 'required',
        ]);

        try
        {
            $Journal = Journal::findorFail($id);
            $Journal->dec = $request->desc;
            $Journal->Total = $request->amount;
            $Journal->date = $request->DateEntries;
            $Journal->save();


            $Journal = JournalSub::where('journalID','=',$id)->get();
            $data1=explode("::",  $request->FromEntries);
            $data2=explode("::",  $request->ToEntries);


            $Journal[0]->nameAccount= $data1[1];
            $Journal[0]->CodeAccount= $data1[0];
            $Journal[0]->dec        = $request->desc;
            $Journal[0]->Debit      = $request->amount;
            $Journal[0]->save();

            $rop=  $Journal[0]->Accounting_guide->ReportData;
            $rop->debitSecond= ($rop->debitSecond- $request->Oldamount)+ $request->amount;
            $rop->save();




            $Journal[1]->nameAccount= $data2[1];
            $Journal[1]->CodeAccount= $data2[0];
            $Journal[1]->dec        = $request->desc;
            $Journal[1]->Credit      = $request->amount;
            $Journal[1]->save();

            $rop=  $Journal[1]->Accounting_guide->ReportData;
            $rop->creditSecond= ($rop->creditSecond - $request->Oldamount)+$request->amount;
            $rop->save();
    }
    catch(Exception $e)
    {
        session()->flash('faild',  trans('Dadhoard.Errorupdating'));
        return redirect()->back();
    }


 


        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('Easyjournals.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
