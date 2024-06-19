<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;


use App\Models\Subscribtion;
use App\Models\Loginrecord;

class SubsController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribtions = Subscribtion::all();
          
        return response($subscribtions);
    }
    
    public function getSub($id)
    {
        $sub= Subscribtion::where('orgID',$id)->get();
          
           return response($sub)
                      ->header('Content-Type', 'application/json');
           
    }
    public function renew(Request $request)
    {
        $subscribtion = Subscribtion::where('orgID', $request->orgID)->first();
       
        $subscribtion->endDate = $request->endDate;
        //$subscribtion->userID = $request->userID;
      
       
        $subscribtion->save();
         $res = "done";

       return response($res)
                      ->header('Content-Type', 'application/json');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('page','subscribtions');
        return view('admin.subscribtions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscribtion = new Subscribtion();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $subscribtion->name = $request->name;
        $subscribtion->area = $request->area;
        $subscribtion->city = $request->city;
        $subscribtion->district = $request->district;
        $subscribtion->address = $request->address;
        $subscribtion->vatNo = $request->vatNo;
        $subscribtion->phone = $request->phone;
        $subscribtion->email = $request->email;
        $subscribtion->orgID = auth()->user()->orgID;
        $subscribtion->branchID = auth()->user()->branchID;
        $subscribtion->userID = auth()->user()->id;
        $subscribtion->save();
        session()->flash('success', 'تمت اضافة العميل بنجاح');

        return redirect(route('subscribtions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscribtion = Subscribtion::findorFail($id);
        return view('admin.subscribtions.show')->with('subscribtion', $subscribtion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscribtion = Subscribtion::findorFail($id);
        return view('admin.subscribtions.edit')->with('subscribtion', $subscribtion);
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
        $subscribtion = Subscribtion::findorFail($id);
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);
        $subscribtion->name = $request->name;
        $subscribtion->area = $request->area;
        $subscribtion->city = $request->city;
        $subscribtion->district = $request->district;
        $subscribtion->address = $request->address;
        $subscribtion->vatNo = $request->vatNo;
        $subscribtion->phone = $request->phone;
        $subscribtion->email = $request->email;
        $subscribtion->orgID = auth()->user()->orgID;
        $subscribtion->branchID = auth()->user()->branchID;
        $subscribtion->userID = auth()->user()->id;
        $subscribtion->save();
        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('subscribtions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscribtion = Subscribtion::findorFail($id);


        //then Delete Subscribtion
        $subscribtion->status = 5;
        $subscribtion->save();
        session()->flash('success', 'تم حذف العميل');
        return redirect(route('subscribtions.index'));
    }




}
