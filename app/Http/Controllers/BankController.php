<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\OpeningBalances;
use App\Models\ReportData;
use App\Models\RoutAccount;
use Exception;
use Illuminate\Http\Request;

class BankController extends Controller
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
        session()->put('sub-page','pageBank');
        $Bank = Bank::where('status',1)->where('orgID',auth()->user()->orgID)->get();

        return view('admin.Accounts.Bank.index')->with('Bank',$Bank);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        session()->put('page','AccountingGuide');
        session()->put('sub-page','pageBank');
      //  $Bank =Bank::all();
        return view('admin.Accounts.Bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd( $request->all());

        $this->validate($request, [
            'nameBank' => 'required',
            'status' => 'required',
            'currency' => 'required',
            'branchID'=> 'required',
        ]);


        try
        {
            $RoutAccount =RoutAccount::where('userID' ,'=',auth()->user()->id)->first();
            $Account=  Accounting_guide::where('AccountID', '=',$RoutAccount->Bank)->where('orgID',auth()->user()->orgID)->first();
            $yu=  Accounting_guide::where('SourceID','=', $RoutAccount->Bank)->where('orgID',auth()->user()->orgID)->count();

            $bank = new Bank();
            $bank->AccountID =$Account->AccountID."00". $yu+1 ;
            $bank->nameBank = $request->nameBank;
            $bank->Country = "SA";
            $bank->currency =$request->currency;
            $bank->NameAccountBank =$request->NameAccountBank;
            $bank->IBN =$request->IBN;
            $bank->NumAcounnt = $request->NumAcounnt;
            $bank->amount = $request->amount;
            $bank->status = $request->status;
            $bank->desc   = $request->desc;
            $bank->permissions =1;
            $bank->orgID = auth()->user()->orgID;
            $bank->branchID =  $request->branchID;
            $bank->save();



            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID =$Account->AccountID."00". $yu+1;
            $AccountingGuide->AccountName =  $request->nameBank;
            $AccountingGuide->AccountNameEn = "bank";
            $AccountingGuide->type =  $Account->AccountName;
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount =0;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->Account_status =1;
            $AccountingGuide->SourceID = $Account->AccountID;
            $AccountingGuide->typeProcsss = 0;
            $AccountingGuide->orgID = auth()->user()->orgID;
            $AccountingGuide->save();
            $ReportData = new ReportData();
            $ReportData->orgID         = auth()->user()->orgID;
            $ReportData->debitFrist    =  0;
            $ReportData->creditFrist   =  0;
            $ReportData->debitSecond   =  0;
            $ReportData->creditSecond  =  0;
            $ReportData->debitThird    =  0;
            $ReportData->creditThird   = 0;
            $ReportData->AccountID     =  $AccountingGuide->id;
            $ReportData->save();
        }
        catch(Exception $e)
        {
            session()->flash('faild',   trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }





         session()->flash('success',     trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('Bank.index'));
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
            session()->put('page','AccountingGuide');
            session()->put('sub-page','pageBank');
            $data = Bank::findorFail($id);

            return view('admin.Accounts.Bank.edit',['data'=>$data]);
        }
        catch(Exception $e)
        {

            session()->flash('faild',    trans('Dadhoard.Displayerror'));
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
            'nameBank' => 'required',
            'status' => 'required',
            'currency' => 'required',
            'branchID'=> 'required',
        ]);



        try
        {
            $bank =  Bank::findorFail($id);
            $bank->nameBank = $request->nameBank;
            $bank->currency =$request->currency;
            $bank->NameAccountBank =$request->NameAccountBank;
            $bank->IBN =$request->IBN;
            $bank->NumAcounnt = $request->NumAcounnt;
            $bank->amount = $request->amount;
            $bank->status = $request->status;
            $bank->desc   = $request->desc;
            $bank->save();
            $AccountingGuide = Accounting_guide::where('AccountID',$request->AccountID )->where('orgID',auth()->user()->orgID)->FirstorFail();
            $AccountingGuide->AccountName =  $request->nameBank;
            $AccountingGuide->save();
        }
        catch(Exception $e)
        {
            session()->flash('faild',   trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
         session()->flash('success',  trans('Dadhoard.Updatedsuccessfully'));
       
        return redirect(route('Bank.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
