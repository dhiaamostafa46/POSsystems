<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Costcenteer;
use App\Models\User;
use App\Models\VirtualAccounts;
use Exception;
use Illuminate\Http\Request;

class VirtualAccountsController extends Controller
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
        try {
            //
            session()->put('page', 'AccountingGuide');
            session()->put('sub-page', 'VirtualAccount');
            $users = User::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.Accounts.VirtualAccounts.User')->with('users', $users);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
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

        try {
            $virt = VirtualAccounts::findorFail($request->RoutID);
            $virt->bank = $request->Bank;
            $virt->treasury = $request->treasury;
            $virt->sale = $request->sales;
            $virt->returnsale = $request->Salesreturns;
            $virt->purch = $request->purchases;
            $virt->returnpuch = $request->Purchreturns;
            $virt->costcenter = $request->CostCenter;
            $virt->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return redirect(route('VirtualAccounts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $user = User::findorFail($id);
            $ِAcount = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->orderby('AccountID')
                ->get();
            $cost = Costcenteer::where('orgID', auth()->user()->orgID)->get();
            $Virtual = VirtualAccounts::where('userID', $user->id)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            if ($Virtual == null) {
                $virt = new VirtualAccounts();
                $virt->bank = 122001;
                $virt->treasury = 121001;
                $virt->sale = 411;
                $virt->returnsale = 412;
                $virt->purch = 511;
                $virt->returnpuch = 512;
                $virt->costcenter = 1;
                $virt->orgID = auth()->user()->orgID;
                $virt->userID = $user->id;
                $virt->save();
            }
            $Virtual = VirtualAccounts::where('userID', $user->id)
                ->where('orgID', auth()->user()->orgID)
                ->first();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.Accounts.VirtualAccounts.index', ['Virtual' => $Virtual, 'Account' => $ِAcount, 'cost' => $cost]);
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
