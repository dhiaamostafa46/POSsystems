<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\OpeningBalances;
use App\Models\Organization;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Treasury;
use Exception;
use Illuminate\Http\Request;

class TreasuryController extends Controller
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
        session()->put('sub-page','pageTreasury');
        $Treasury = Treasury::where('orgID',auth()->user()->orgID)->get();
        return view('admin.Accounts.treasury.index')->with('Treasury',$Treasury);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        session()->put('page','AccountingGuide');
        session()->put('sub-page','pageTreasury');
        $branch = Organization::findorFail(auth()->user()->orgID);
        return view('admin.Accounts.treasury.create',['branch'=>$branch]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'nameTreasury' => 'required',
            'branchID' => 'required',
        ]);

        try
        {
            $RoutAccount =RoutAccount::where('userID' ,'=',auth()->user()->id)->first();
            $Account=  Accounting_guide::where('AccountID', '=',$RoutAccount->treasury)->where('orgID',auth()->user()->orgID)->first();
            $yu=  Accounting_guide::where('SourceID', '=',$RoutAccount->treasury)->where('orgID',auth()->user()->orgID)->count();
            $bank = new Treasury();
            $bank->AccountCode =$Account->AccountID."00". $yu+1 ;
            $bank->name = $request->nameTreasury;
            $bank->status = $request->status;
            $bank->desc =$request->desc;
            $bank->branchID =$request->branchID;
            $bank->orgID = auth()->user()->orgID;
            $bank->save();


            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID =$Account->AccountID."00". $yu+1;
            $AccountingGuide->AccountName =  $request->nameTreasury;
            $AccountingGuide->AccountNameEn = $request->nameTreasury;
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



         session()->flash('success',   trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('Treasury.index'));


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
        session()->put('page','AccountingGuide');
        session()->put('sub-page','pageTreasury');
        try
        {
            $Treasury =Treasury::findorFail($id);
            $branch = Organization::findorFail(auth()->user()->orgID);

        }
        catch(Exception $e)
        {
            session()->flash('faild',  trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }


        return view('admin.Accounts.treasury.edit',['Treasury'=>$Treasury ,'branch'=>$branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'nameTreasury' => 'required',
            'branchID' => 'required',

        ]);

        try
        {


            $bank =  Treasury::findorFail($id);
            $bank->name = $request->nameTreasury;
            $bank->status = $request->status;
            $bank->desc =$request->desc;
            $bank->branchID =$request->branchID;
            $bank->save();
            $AccountingGuide = Accounting_guide::where('AccountID',$request->AccountID )->where('orgID',auth()->user()->orgID)->FirstorFail();
            $AccountingGuide->AccountName =  $request->nameTreasury;
            $AccountingGuide->save();
        }
        catch(Exception $e)
        {
            session()->flash('faild',    trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

    

         session()->flash('success',    trans('Dadhoard.Updatedsuccessfully'));
        return redirect(route('Treasury.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
