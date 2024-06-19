<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Role;
use App\Models\Loginrecord;
use App\Models\Pagecategory;
use Exception;

class RolesController extends Controller
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
            session()->put('page', 'roles');
            $roles = Role::where('status', 1)
                ->where('orgID', auth()->user()->organization->id)
                ->get();
            return view('admin.roles.index')->with('roles', $roles);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            session()->put('page', 'roles');
            return view('admin.roles.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $role = new Role();
            $this->validate($request, [
                'nameAr' => 'required',
            ]);

            $role->nameAr = $request->nameAr;
            $role->nameEn = $request->nameEn;
            $role->orgID = auth()->user()->orgID;
            $role->branchID = auth()->user()->branchID;
            $role->userID = auth()->user()->id;
            $role->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $role = Role::findorFail($id);
            return view('admin.roles.show')->with('role', $role);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function rolesPages($id)
    {
        try {
            $role = Role::findorFail($id);
            $pagecategories = Pagecategory::where('status', 1)->get();
            return view('admin.roles.pages')->with('role', $role)->with('pagecategories', $pagecategories);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $role = Role::findorFail($id);
            return view('admin.roles.edit')->with('role', $role);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $role = Role::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required',
            ]);

            $role->nameAr = $request->nameAr;
            $role->nameEn = $request->nameEn;
            $role->orgID = auth()->user()->orgID;
            $role->branchID = auth()->user()->branchID;
            $role->userID = auth()->user()->id;
            $role->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            $role = Role::findorFail($id);

            //then Delete Role
            $role->status = 5;
            $role->save();

            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
