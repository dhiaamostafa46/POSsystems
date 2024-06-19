<?php

namespace App\Http\Controllers;

use App\Models\Costcenteer;
use Exception;
use Illuminate\Http\Request;

class CostCenterController extends Controller
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
            session()->put('sub-page', 'pagecostcenters');
            // $CostCenter =Costcenteer::where('MainCost' ,'0')->get();
            $CostCenter = Costcenteer::where('orgID', auth()->user()->orgID)->count();

            if ($CostCenter == 0) {
                $Costcenteer = new Costcenteer();
                $Costcenteer->CostName = ' التكلفة الرئيسية';
                $Costcenteer->CostCodeID = 1;
                $Costcenteer->CostNameEN = 'Main Cost';

                $Costcenteer->dataCost = date('Y-m-d');
                $Costcenteer->MainCost = 0;
                $Costcenteer->orgID = auth()->user()->orgID;
                $Costcenteer->branchID = auth()->user()->branchID;
                $Costcenteer->SourceID = 0;
                $Costcenteer->namefather = ' التكلفة الرئيسية';
                $Costcenteer->save();
            }

            $CostCenter = Costcenteer::where('orgID', auth()->user()->orgID)->get();
            return view('admin.Accounts.CostCenter.index')->with('CostCenter', $CostCenter);
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
        session()->put('sub-page', 'pagecostcenters');
        return view('admin.Accounts.CostCenter.create');
    }

    public function AccountFather(string $request)
    {
        try {
            $yu = Costcenteer::where('SourceID', '=', $request)
                ->where('orgID', auth()->user()->orgID)
                ->count();

            return response()->json(['count' => $yu + 1], 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd( $request->all());
        $this->validate($request, [
            'CostName' => 'required',
            'nameFather' => 'required',
        ]);
        try {
            $data = explode('::', $request->nameFather);
            $Costcenteer = new Costcenteer();
            $Costcenteer->CostName = $request->CostName;
            $Costcenteer->CostCodeID = $request->CostCodeID;
            $Costcenteer->CostNameEN = $request->CostNameEN;
            $Costcenteer->dataCost = date('Y-m-d');
            $Costcenteer->MainCost = 0;
            $Costcenteer->orgID = auth()->user()->orgID;
            $Costcenteer->branchID = auth()->user()->branchID;
            $Costcenteer->SourceID = $data[0];
            $Costcenteer->namefather = $data[2];
            $Costcenteer->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
        return redirect(route('costcenters.index'));
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
            $Costcenteer = Costcenteer::findorFail($id);
            return view('admin.Accounts.CostCenter.edit')->with('Costcenteer', $Costcenteer);
        } catch (Exception $e) {
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
            'CostName' => 'required',
            'nameFather' => 'required',
        ]);

        try {
            $data = explode('::', $request->nameFather);
            $Costcenteer = Costcenteer::findorFail($id);
            $Costcenteer->CostName = $request->CostName;
            $Costcenteer->CostCodeID = $request->CostCodeID;
            $Costcenteer->CostNameEN = $request->CostNameEN;
            $Costcenteer->SourceID = $data[0];
            $Costcenteer->namefather = $data[2];
            $Costcenteer->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('costcenters.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $Costcenteer = Costcenteer::findorFail($id);
            if ($Costcenteer->MainCost == 0) {
                $Costcenteer->MainCost = 1;
                $Costcenteer->save();
                session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            } else {
                $Costcenteer->MainCost = 0;
                $Costcenteer->save();
                session()->flash('success', 'تم فتح الدليل');
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }

        return redirect(route('costcenters.index'));
    }
}
