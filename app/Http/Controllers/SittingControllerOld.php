<?php

namespace App\Http\Controllers;

use App\Models\Inv;
use Exception;
use Illuminate\Http\Request;

class SittingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $inv = Inv::where('orgID', auth()->user()->orgID)->first();

            return view('admin.Sitting.create')->with('inv', $inv);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $this->validate($request, [
                'Bill' => 'required',
                'product' => 'required',
            ]);
            $inv = Inv::findOrFail($id);
            $inv->Inv = $request->Bill;
            $inv->proud = $request->product;
            $inv->save();

            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
