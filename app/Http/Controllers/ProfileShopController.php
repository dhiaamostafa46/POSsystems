<?php

namespace App\Http\Controllers;
use App\Models\Booktable;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\Temporder;
use App\Models\VirtualCustomer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //

        try {
            $shop = Organization::findorFail($id);

            $table = Booktable::where('orgID', $id)
                ->where('customersID', auth()->guard('Shop')->user()->id)
                ->orderBy('id', 'DESC')
                ->get();

            $Order = Temporder::where('customerID', auth()->guard('Shop')->user()->id)
                ->orderBy('id', 'DESC')
                ->get();
            return view('customer.profile')->with('orgID', $id)->with('Online', $shop)->with('Order', $Order)->with('table', $table);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function logout($id)
    {
        try {
            Auth::guard('Shop')->logout();
            return redirect()->route('public.index', $id);
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

        try {
            $this->validate($request, [
                'email' => 'required|email',
                'phone' => 'required',
            ]);
            $custumer = VirtualCustomer::findOrFail(auth()->guard('Shop')->user()->id);
            $custumer->name = $request->name;
            $custumer->phone = $request->phone;
            $custumer->email = $request->email;
            $custumer->area = $request->country;
            $custumer->city = $request->city;
            $custumer->addressAr = $request->address;
            $custumer->addressEn = $request->addresslink;
            $custumer->save();

            return redirect()->route('ProfileShop', auth()->guard('Shop')->user()->orgID);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function SavePasswordShop(Request $request)
    {
        //

        try {
            $this->validate($request, [
                'passwordold' => 'required',
                'passwordnew' => 'required|string|min:8|confirmed',
            ]);
            $custumer = VirtualCustomer::findOrFail(auth()->guard('Shop')->user()->id);

            if (!Hash::check($request->current_password, $custumer->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $custumer->password = Hash::make($request->new_password);
            $custumer->save();

            return redirect()->route('ProfileShop', auth()->guard('Shop')->user()->orgID);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function savebooktable(Request $request)
    {
        //

        try {
            $this->validate($request, [
                'branch' => 'required',
                'table' => 'required',
                'time' => 'required',
            ]);

            $book = new Booktable();
            $book->orgID = auth()->guard('Shop')->user()->orgID;
            $book->branchID = $request->branch;
            $book->time = $request->time;
            $book->count = $request->countperson;
            $book->table = $request->table;
            $book->day = $request->day;
            $book->name = auth()->guard('Shop')->user()->name;
            $book->phone = auth()->guard('Shop')->user()->phone;
            $book->customersID = auth()->guard('Shop')->user()->id;
            $book->save();

            return redirect()
                ->route('ProfileShop', auth()->guard('Shop')->user()->orgID)
                ->with('success', ' تم حجز طاولة ');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //\
        try {
            $order = Temporder::findOrFail($id);
            $shop = Organization::findOrFail(auth()->guard('Shop')->user()->orgID);
            return view('customer.showshop')
                ->with('order', $order)
                ->with('orgID', auth()->guard('Shop')->user()->orgID)
                ->with('Online', $shop);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
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
