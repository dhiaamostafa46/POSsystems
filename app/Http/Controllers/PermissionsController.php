<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Permission;
use Exception;

class PermissionsController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $permissions = Permission::where('roleID', $id)->get();
            foreach ($permissions as $permission) {
                $permission->delete();
            }

            if ($request->pages) {
                if (is_array($request->pages)) {
                    foreach ($request->pages as $value) {
                        $permission = new Permission();
                        $permission->pageID = $value;
                        $permission->roleID = $id;
                        $permission->orgID = auth()->user()->orgID;
                        $permission->branchID = auth()->user()->branchID;
                        $permission->userID = auth()->user()->id;
                        $permission->save();
                    }
                } else {
                    $permission = new Permission();
                    $value = $request->pages;
                    $permission->pageID = $value;
                    $permission->roleID = $id;
                    $permission->orgID = auth()->user()->orgID;
                    $permission->branchID = auth()->user()->branchID;
                    $permission->userID = auth()->user()->id;
                    $permission->save();
                }
            }

            session()->flash('success', 'تمت اضافة الصلاحيات بنجاح');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
}
