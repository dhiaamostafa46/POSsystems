<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use App\Models\Organization;
use App\Models\Loginrecord;
use App\Models\Respons;
use App\Models\User;
use App\Models\Order;


use Illuminate\Support\Facades\Storage;


class OrgsController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->put('page','organizations');
        $org = Organization::findorFail(auth()->user()->orgID);
        return view('admin.organizations.index')->with('org',$org);
    }

    public function getall()
    {
        $org = Organization::all();
          
           return response($org)
                      ->header('Content-Type', 'application/json');
           
    }

    public function getOrg($id)
    {
        $org = Organization::where('id',$id)->get();
          
           return response($org)
                      ->header('Content-Type', 'application/json');
           
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organization = new Organization();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:organizations',
            'password' => 'required|min:6',
        ]);
        if ($request->hasFile('img')) {
            //get filename with extension
            $filenameWithExt = $request->file('img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('img')->getClientOriginalExtension();
            //create filename to store
            $fileNametoStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('img')->move(public_path('../dist/img/organizations'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $organization->img = $fileNametoStore;
        } else {
            $organization->img = "profile.jpg";
        }
        $organization->name = $request->name;
        $organization->email = $request->email;
        $organization->phone = $request->phone;
        $organization->password = Hash::make($request->password);
        $organization->save();
        session()->flash('success', 'تمت اضافة المستخدم بنجاح');

        return redirect(route('organizations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getActivity($id)
    {
        $prods = Product::where('orgID',$id)->get()->count();
        $users = User::where('orgID',$id)->get()->count();
        $orders = Order::where('orgID',$id)->get()->count();
          //dd($orders);
         $result = 
         [
            "prods"=> $prods,
            "users"=>  $users,
            "orders"=> $orders
         ];
            
           return response($result)
                      ->header('Content-Type', 'application/json');
           
    }
    public function show($id)
    {
        $organization = Organization::findorFail($id);
        return view('admin.organizations.show')->with('organization', $organization);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = Organization::findorFail($id);
        return view('admin.organizations.edit')->with('org', $org);
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
        $organization = Organization::findorFail($id);
        $this->validate($request, [
            'CR' => 'required',
        ]);
        if ($request->hasFile('img')) {
            //get filename with extension
            $filenameWithExt = $request->file('img')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('img')->getClientOriginalExtension();
            //create filename to store
            $fileNametoStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('img')->move(public_path('../dist/img/organizations'), $fileNametoStore);
            //Storage::disk('public')->storeAs('/', new File($request->hasFile('img')), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $organization->logo = $fileNametoStore;
        }

        if ($request->hasFile('signature')) {
            //get filename with extension
            $filenameWithExt = $request->file('signature')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('signature')->getClientOriginalExtension();
            //create filename to store
            $fileNametoStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('signature')->move(public_path('../dist/img/organizations'), $fileNametoStore);
            //$path = $request->file('signature')->storeAs('public/signature/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('signature')) {
            $organization->signature = $fileNametoStore;
        }

        $organization->vatNo = $request->vatNo;
        $organization->CR = $request->CR;
        $organization->save();
        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('organizations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::findorFail($id);

        
        //then Delete Organization
        $organization->email =  Hash::make($organization->created_at);
        $organization->password = Hash::make('xyz@zyx');
        $organization->status = 5;
        $organization->save();
        session()->flash('success', 'تم حذف المستخدم');
        return redirect(route('organizations.index'));
    }

    public function resetPassword($id)
    {
        $organization = Organization::find($id);
        $organization->password =  Hash::make('123456');
        $organization->save();

        session()->flash('success', 'تم اعادة تعيين كلمة المرور');
        return redirect(route('organizations.index'));
    }

  
}
