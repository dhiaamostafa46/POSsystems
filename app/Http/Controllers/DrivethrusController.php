<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Drivethru;
use App\Models\Loginrecord;

class DrivethrusController extends Controller
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
            session()->put('sub-page', 'drivethrus');
            $drivethrus = Drivethru::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.drivethrus.index')->with('drivethrus', $drivethrus);
        } catch (\Exception $e) {
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
        return view('admin.drivethrus.create');
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
            $drivethru = new Drivethru();
            $this->validate($request, [
                'windowName' => 'required',
            ]);

            $drivethru->qrNo = $request->windowName;
            $drivethru->orgID = auth()->user()->orgID;
            $drivethru->branchID = $request->branchID;
            $drivethru->userID = auth()->user()->id;
            $drivethru->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('drivethrus.index'));
    }

    public function drivethrusGroup(Request $request)
    {
        try {
            $this->validate($request, [
                'quantity' => 'required',
            ]);
            $lastTable = Drivethru::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'DESC')
                ->first();
            $lastTableID = $lastTable->id;
            if ($request->quantity >= 1) {
                for ($i = 1; $i <= $request->quantity; $i++) {
                    $lastTableID++;
                    $drivethru = new Drivethru();
                    $drivethru->qrNo = $lastTableID;
                    $drivethru->orgID = auth()->user()->orgID;
                    $drivethru->branchID = auth()->user()->branchID;
                    $drivethru->userID = auth()->user()->id;
                    $drivethru->save();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('drivethrus.index'));
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
            $drivethru = Drivethru::findorFail($id);
            return view('admin.drivethrus.show')->with('drivethru', $drivethru);
        } catch (\Exception $e) {
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
            $drivethru = Drivethru::findorFail($id);
            return view('admin.drivethrus.edit')->with('drivethru', $drivethru);
        } catch (\Exception $e) {
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
            $drivethru = Drivethru::findorFail($id);
            $this->validate($request, [
                'windowName' => 'required',
            ]);

            $drivethru->qrNo = $request->windowName;
            $drivethru->orgID = auth()->user()->orgID;
            $drivethru->branchID = $request->branchID;
            $drivethru->userID = auth()->user()->id;
            $drivethru->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect(route('drivethrus.index'));
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
            $drivethru = Drivethru::findorFail($id);
            $drivethru->status = 5;
            $drivethru->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('drivethrus.index'));
    }
}
