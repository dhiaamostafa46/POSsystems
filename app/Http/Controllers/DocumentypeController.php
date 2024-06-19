<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use Illuminate\Http\Request;

class DocumentypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $doctypes = DocType::where('Status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();

            return view('admin.employees.decoment.index')->with('doc', $doctypes);
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            $doctypes = new DocType();
            $doctypes->orgID = auth()->user()->orgID;
            $doctypes->nameAr = $request->nameAr;
            $doctypes->nameEn = $request->nameEn;
            $doctypes->save();

            return back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
        try {
            $doctypes = DocType::findOrFail($id);
            $doctypes->orgID = auth()->user()->orgID;
            $doctypes->nameAr = $request->nameAr;
            $doctypes->nameEn = $request->nameEn;
            $doctypes->save();

            return back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
