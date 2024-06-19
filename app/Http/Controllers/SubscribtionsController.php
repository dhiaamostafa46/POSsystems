<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Subscribtion;
use App\Models\Loginrecord;
use Exception;

class SubscribtionsController extends Controller
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
            session()->put('page', 'subscribtions');
            $subscribtions = Subscribtion::where('status', 1)->get();
            return view('admin.subscribtions.index')->with('subscribtions', $subscribtions);
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
        try {
            session()->put('page', 'subscribtions');
            return view('admin.subscribtions.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
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
            $subscribtion = Subscribtion::findorFail($id);
            return view('admin.subscribtions.show')->with('subscribtion', $subscribtion);
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
            $subscribtion = Subscribtion::findorFail($id);
            return view('admin.subscribtions.edit')->with('subscribtion', $subscribtion);
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
            $subscribtion = Subscribtion::findorFail($id);

            //then Delete Subscribtion
            $subscribtion->status = 5;
            $subscribtion->save();
            session()->flash('success', 'تم حذف العميل');
            return redirect(route('subscribtions.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }
}
