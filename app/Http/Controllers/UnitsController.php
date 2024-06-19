<?php

namespace App\Http\Controllers;
use App\Exports\UnitExport;
use App\Imports\UnitImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Unit;
use App\Models\Loginrecord;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class UnitsController extends Controller
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
            session()->put('sub-page', 'itemsUnit');
            $units = Unit::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.units.index')->with('units', $units);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function GetExportUnit()
    {
        try {
            return Excel::download(new UnitExport(), 'Unit.xlsx');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function GetImportUnit(Request $request)
    {
        try {
            Excel::import(new UnitImport(), request()->file('file'));
            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
        return view('admin.units.create');
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
            $unit = new Unit();
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $unit->nameAr = $request->nameAr;
            $unit->nameEn = $request->nameEn;

            $unit->orgID = auth()->user()->orgID;
            $unit->userID = auth()->user()->id;
            $unit->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('units.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $unit = Unit::findorFail($id);
            return view('admin.units.show')->with('unit', $unit);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $unit = Unit::findorFail($id);
            return view('admin.units.edit')->with('unit', $unit);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $unit = Unit::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $unit->nameAr = $request->nameAr;
            $unit->nameEn = $request->nameEn;

            $unit->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('units.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $unit = Unit::findorFail($id);
            $unit->status = 5;
            $unit->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('units.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }
}
