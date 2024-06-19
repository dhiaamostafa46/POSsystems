<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{

            return  view('public.Account');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }



    public function HRdescription()
    {
        try{

            return  view('public.HR');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }
    
    
       public function menudescription()
    {
        try{
            return  view('public.menu');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }


    public function posdescription()
    {
        try{

            return  view('public.pos');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function restaurantdescription()
    {
        try{
            return  view('public.Resturn');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function journalsdescription()
    {
        try{
            return  view('public.Jourles');
        }catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function Warehousesdescription()
    {
        try{
            return  view('public.Warehouses');
        }catch (\Exception $e) {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
