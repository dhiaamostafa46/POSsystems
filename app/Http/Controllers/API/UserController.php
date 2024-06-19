<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\User;
use App\Models\Loginrecord;
use URL;

class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->put('page','users');
        if(auth()->user()->isadmin == 1){
            $users = User::where('status',1)->get();
        }elseif(auth()->user()->ismanager == 1){
            $users = User::where('status',1)->where('orgID',auth()->user()->orgID)->get();
        }else{
            $users = User::where('status',1)->where('branchID',auth()->user()->branchID)->get();
        }
        
        return view('admin.users.index')->with('users',$users);
    }
    
    public function login (Request $request)
    {
          $use = User::where('email',$request->usermail)->first();
        
        $result = "not";
        if (Hash::check($request->userpass,  $use->password))
        {
            $userData = new User();
            $userData->id = $use->id;
            $userData->orgID = $use->orgID;
            $userData->name = $use->name;
            $userData->orgNameAr =$use->organization->nameAr;
            $userData->orgNameEn =$use->organization->nameEn;
            $userData->brNameAr =$use->branch->nameAr;
            $userData->brNameEn=$use->branch->nameEn;
             
            
            
               
        }
         return response($userData)
                      ->header('Content-Type', 'application/json');
    }

    public function getall()
    {
        $use= User::all();
          
           return response($use)
                      ->header('Content-Type', 'application/json');
           
    }

    public function getUser($id)
    {
        $use = User::where('id',$id)->get();
          
           return response($use)
                      ->header('Content-Type', 'application/json');
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
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
            $path = $request->file('img')->move(public_path('../dist/img/users'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $user->img = $fileNametoStore;
        } else {
            $user->img = "default.jpg";
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->orgID = auth()->user()->orgID;
        $user->branchID = $request->branchID;
        $user->roleID = $request->roleID;
        $user->ismanager = $request->isManager;
        $user->userID = auth()->user()->id;
        $user->type = 1;
        $user->save();
        session()->flash('success', 'تمت اضافة المستخدم بنجاح');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request)
    {
        $user = User::findorFail(auth()->user()->id);
        if ($request->password) {
            $this->validate($request, [
                'password' => 'required',
            ]);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect(url(URL::previous()));
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
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
            $path = $request->file('img')->move(public_path('../dist/img/users'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $user->img = $fileNametoStore;
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
            $path = $request->file('signature')->move(public_path('../dist/img/signatures'), $fileNametoStore);
            //$path = $request->file('signature')->storeAs('public/signature/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('signature')) {
            $user->signature = $fileNametoStore;
        }

        if ($request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->roleID = $request->roleID;
        $user->branchID = $request->branchID;
        $user->ismanager = $request->isManager;
        $user->save();
        $request->session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);

        
        //then Delete User
        //$user->email =  Hash::make($user->created_at);
        //$user->password = Hash::make('xyz@zyx');
        $user->status = 5;
        $user->save();
        session()->flash('success', 'تم حذف المستخدم');
        return redirect(route('users.index'));
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password =  Hash::make('123456');
        $user->save();

        session()->flash('success', 'تم اعادة تعيين كلمة المرور');
        return redirect(route('users.index'));
    }

  
}
