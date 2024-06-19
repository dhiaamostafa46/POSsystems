<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\RoutAccount;
use Exception;
use Illuminate\Http\Request;

class RoutAccountController extends Controller
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
        session()->put('sub-page','pageRoutAccount');

        try
        {
            $count =RoutAccount::where('orgID' ,'=',auth()->user()->orgID)->count();
            if( $count ==0){

                $routAcount =new RoutAccount();
                $routAcount->Customers         = 124;
                $routAcount->Suppliers         = 221;
                $routAcount->Store             = 125;
                $routAcount->Bank              = 122;
                $routAcount->treasury          = 121;
                $routAcount->sales             = 411;
                $routAcount->purchases         = 511;
                $routAcount->Profitloss        = 43;
                $routAcount->Salesreturns      = 412;
                $routAcount->Purchreturns      = 512;
                $routAcount->Discountearned    = 21;
                $routAcount->Discountpermitted = 22;
                $routAcount->userID            =   auth()->user()->id;
                $routAcount->orgID             = auth()->user()->orgID;

                $routAcount->save();

            }
            $RoutAccount =RoutAccount::where('orgID' ,'=',auth()->user()->orgID)->first();
            $ِAcount =Accounting_guide::where('Account_status',"=","0")->where('orgID',auth()->user()->orgID)->get();
        }
        catch(Exception $e)
        {
            session()->flash('faild',   trans('Dadhoard.Displayerror'));
            return redirect()->back();

        }

        return view('admin.Accounts.RoutAccount.index',['RoutAccount'=>$RoutAccount ,'Account' =>  $ِAcount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try
        {
            $routAcount =RoutAccount::findorFail( $request->RoutID);

            $routAcount->Customers    = $request->Customers;
            $routAcount->Suppliers    =$request->Suppliers;
            $routAcount->Store        = $request->Store;
            $routAcount->Bank         = $request->Bank;
            $routAcount->treasury     = $request->treasury;
            $routAcount->sales        = $request->sales;
            $routAcount->purchases    = $request->purchases;
            $routAcount->Profitloss   =$request->Profitloss;
            $routAcount->Salesreturns = $request->Salesreturns;
            $routAcount->Purchreturns = $request->Purchreturns;
            $routAcount->Discountearned =$request->Discountearned;
            $routAcount->Discountpermitted =$request->Discountpermitted;
            $routAcount->save();
        }
        catch(Exception $e)
        {
          
            session()->flash('faild',     trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return redirect(route('RoutAccount.index'));
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
