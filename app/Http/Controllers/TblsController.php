<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Tbl;
use App\Models\Loginrecord;
use Exception;

class TblsController extends Controller
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
            session()->put('page', 'products');
            session()->put('sub-page', 'tbls');
            $tbls = Tbl::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.tbls.index')->with('tbls', $tbls);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tbls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tbl = new Tbl();
            $this->validate($request, [
                'tableNo' => 'required',
            ]);

            $tbl->tableNo = $request->tableNo;
            $tbl->orgID = auth()->user()->orgID;
            $tbl->branchID = $request->branch;
            $tbl->userID = auth()->user()->id;
            $tbl->amount = $request->amount;
            $tbl->discount = $request->discount;
            $tbl->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('tbls.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function tblsGroup(Request $request)
    {
        try {
            $this->validate($request, [
                'quantity' => 'required',
            ]);
            $lastTable = Tbl::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'DESC')
                ->first();
            if (!empty($lastTable)) {
                $lastTableID = $lastTable->id;
            } else {
                $lastTableID = 0;
            }

            if ($request->quantity >= 1) {
                for ($i = 1; $i <= $request->quantity; $i++) {
                    $lastTableID++;
                    $tbl = new Tbl();
                    $tbl->tableNo = $lastTableID;
                    $tbl->orgID = auth()->user()->orgID;
                    $tbl->branchID = $request->branch;
                    $tbl->userID = auth()->user()->id;
                    $tbl->amount = $request->amount;
                    $tbl->discount = $request->discount;
                    $tbl->save();
                }
            }

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('tbls.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
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
            $tbl = Tbl::findorFail($id);
            return view('admin.tbls.show')->with('tbl', $tbl);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tbl = Tbl::findorFail($id);
            return view('admin.tbls.edit')->with('tbl', $tbl);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
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
        try {
            $tbl = Tbl::findorFail($id);
            $this->validate($request, [
                'tableNo' => 'required',
            ]);

            $tbl->tableNo = $request->tableNo;
            $tbl->branchID = $request->branch;
            $tbl->amount = $request->amount;
            $tbl->discount = $request->discount;

            $tbl->save();
            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('tbls.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
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
            $tbl = Tbl::findorFail($id);
            $tbl->status = 5;
            $tbl->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));

            return redirect(route('tbls.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function tableorder($id)
    {
    }
}
