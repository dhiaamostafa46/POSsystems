<?php

namespace App\Http\Controllers;
use App\Exports\KitchenExport;
use App\Imports\KitchenImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Kitchen;
use App\Models\Loginrecord;

class KitchensController extends Controller
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
            session()->put('sub-page', 'kitchens');
            $kitchens = Kitchen::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.kitchens.index')->with('kitchens', $kitchens);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function GetExportkitchens()
    {
        try {
            return Excel::download(new KitchenExport(), 'Kitchen.xlsx');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function GetImportkitchens(Request $request)
    {
        try {
            Excel::import(new KitchenImport(), request()->file('file'));
            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
            return redirect()->back();
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
        return view('admin.kitchens.create');
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
            $kitchen = new Kitchen();
            $this->validate($request, [
                'nameAr' => 'required',
                'nameEn' => 'required',
            ]);

            $kitchen->nameAr = $request->nameAr;
            $kitchen->nameEn = $request->nameEn;
            $kitchen->orgID = auth()->user()->orgID;
            $kitchen->branchID = auth()->user()->branchID;
            $kitchen->userID = auth()->user()->id;
            $kitchen->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('kitchens.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function saveKitchanProdect(Request $request)
    {
        try {
            $kitchen = new Kitchen();
            $kitchen->nameAr = $request->nameAr;
            $kitchen->nameEn = $request->nameEn;
            $kitchen->orgID = auth()->user()->orgID;
            $kitchen->branchID = auth()->user()->branchID;
            $kitchen->userID = auth()->user()->id;
            $kitchen->save();

            return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'data' => $kitchen]);
        } catch (\Exception $e) {
            return response()->json(['success' => true]);
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
            $kitchen = Kitchen::findorFail($id);
            return view('admin.kitchens.show')->with('kitchen', $kitchen);
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
            $kitchen = Kitchen::findorFail($id);
            return view('admin.kitchens.edit')->with('kitchen', $kitchen);
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
    public function update(Request $request)
    {
        try {
            $kitchen = Kitchen::findorFail($request->idkit);

            $kitchen->nameAr = $request->nameAr;
            $kitchen->nameEn = $request->nameEn;
            $kitchen->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('kitchens.index'));
        } catch (\Exception $e) {
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
            $kitchen = Kitchen::findorFail($id);
            $kitchen->status = 5;
            $kitchen->save();

            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('kitchens.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
