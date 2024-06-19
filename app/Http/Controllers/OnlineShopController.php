<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\VirtualCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OnlineShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function Login($id)
    {
        //
        try {
            return view('customer.login')->with('orgID', $id);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function Register($id)
    {
        //
        try {
            return view('customer.register')->with('orgID', $id);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function storeLogin(Request $request)
    {
        //\\
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::guard('Shop')->attempt(['email' => $request->email, 'password' => $request->password, 'orgID' => $request->orgID], $request->get('remember'))) {
                return redirect()->route('ProfileShop', $request->orgID);
            } else {
                session()->flash('error', 'Either Email/Password is incorrect');
                return back()->withInput($request->only('email'));
            }
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function storeRegister(Request $request)
    {
        //\\
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $custumer = new VirtualCustomer();
            $custumer->orgID = $request->orgID;
            $custumer->name = $request->nameAr;
            $custumer->phone = $request->phone;
            $custumer->email = $request->email;
            $custumer->password = Hash::make($request->password);

            $custumer->save();

            Auth::guard('Shop')->login($custumer);
            return redirect()->route('ProfileShop', $request->orgID);
        } catch (\Exception $e) {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
