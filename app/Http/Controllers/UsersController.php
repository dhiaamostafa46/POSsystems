<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Role;
use App\Models\VirtualAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\User;
use App\Models\Loginrecord;
use App\Models\Page;
use App\Models\Permission;
use App\Models\RoutAccount;
use URL;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderInv;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
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
            session()->put('page', 'users');
            if (auth()->user()->isadmin == 1) {
                $users = User::where('status', 1)->get();
            } elseif (auth()->user()->ismanager == 1) {
                $users = User::where('status', 1)
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
            } else {
                $users = User::where('status', 1)
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
            }

            //dd($users);
            return view('admin.users.index')->with('users', $users);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function usersexport()
    {
        try {
            return Excel::download(new UsersExport(), 'users.xlsx');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
        return view('admin.users.create');
    }

    public function createEmpUser($id)
    {
        try {
            $emp = Employee::findorFail($id);
            $role = Role::where('nameEn', 'Employee')
                ->where('orgID', auth()->user()->orgID)
                ->first();

            return view('admin.users.createEmpUser')->with('emp', $emp)->with('emprole', $role);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $user = new User();
            $this->validate($request, [
                'name' => 'required|string|max:191',
                'email' => 'required|string|email|max:191|unique:users',
                'password' => 'required|min:6',
                'img' => ' max:500',
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
                $user->img = 'default.jpg';
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

            $routAcount = new RoutAccount();
            $routAcount->Customers = 124;
            $routAcount->Suppliers = 221;
            $routAcount->Store = 125;
            $routAcount->Bank = 122;
            $routAcount->treasury = 121;
            $routAcount->sales = 411;
            $routAcount->purchases = 511;
            $routAcount->Profitloss = 43;
            $routAcount->Salesreturns = 412;
            $routAcount->Purchreturns = 512;
            $routAcount->Discountearned = 21;
            $routAcount->Discountpermitted = 22;
            $routAcount->userID = $user->id;
            $routAcount->orgID = auth()->user()->orgID;
            $routAcount->save();

            $virt = new VirtualAccounts();
            $virt->bank = 122;
            $virt->treasury = 121;
            $virt->sale = 411;
            $virt->returnsale = 412;
            $virt->purch = 511;
            $virt->returnpuch = 512;
            $virt->costcenter = 1;
            $virt->orgID = auth()->user()->orgID;
            $virt->userID = $user->id;
            $virt->save();
            $test = self::storeOrgOnAdminPanel($user->id, auth()->user()->orgID, $request->email, $request->phone, $request->name);
            session()->flash('success', 'تمت اضافة المستخدم بنجاح');

            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }
    public function storeEmp(Request $request)
    {
        try {
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
                $user->img = 'default.jpg';
            }
            $user->empID = $request->empID;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->orgID = auth()->user()->orgID;
            $user->branchID = $request->branchID;
            $user->roleID = $request->roleID;

            $user->userID = auth()->user()->id;
            $user->type = 1;
            $user->save();

            $emp = Employee::findorFail($request->empID);
            $emp->userID = $user->id;
            $emp->save();

            session()->flash('success', 'تمت اضافة المستخدم بنجاح');

            return redirect(route('employees.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function storeOrgOnAdminPanel($user, $orgID, $email, $phone, $nameAr)
    {
        $curl = curl_init();
        $req =
            '{
            "orgID":"' .
            $orgID .
            '",
            "user":"' .
            $user .
            '",
            "name":"' .
            $nameAr .
            '",
            "email":"' .
            $email .
            '",
            "phone":"' .
            $phone .
            '"

        }';

        // http://127.0.0.1:8000/organizations
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://admin.evix.com.sa/api/UserOrg',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response == 'done') {
            return true;
        } else {
            $response;
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
            $user = User::findorFail($id);

            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('userID', $user->id)
                ->where('TypeInv', 2)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('userID', $user->id)
                ->where('TypeInv', 2)
                ->get();
            $Order = $Order1->merge($Order2);

            return view('admin.users.show')->with('user', $user)->with('order', $Order);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $user = User::findorFail($id);
            return view('admin.users.edit')->with('user', $user);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
    public function passwordUpdate(Request $request)
    {
        try {
            $user = User::findorFail(auth()->user()->id);
            if ($request->password) {
                $this->validate($request, [
                    'password' => 'required',
                ]);
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect(url(URL::previous()));
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        try {
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
            if ($request->email && $request->email != $user->email) {
                $this->validate($request, [
                    'email' => 'required|string|email|max:191|unique:users',
                ]);

                $user->email = $request->email;
            }

            if ($request->password) {
                $this->validate($request, [
                    'password' => 'required|min:6',
                ]);

                $user->password = Hash::make($request->password);
            }
            $user->name = $request->name;

            $user->roleID = $request->roleID;
            $user->branchID = $request->branchID;
            $user->ismanager = $request->isManager;
            $user->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
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
            $user = User::findorFail($id);

            //then Delete User
            //$user->email =  Hash::make($user->created_at);
            //$user->password = Hash::make('xyz@zyx');
            $user->status = 5;
            $user->save();
            session()->flash('success', 'تم حذف المستخدم');
            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }

    public function resetPassword($id)
    {
        try {
            $user = User::find($id);
            $user->password = Hash::make('123456');
            $user->save();

            session()->flash('success', 'تم اعادة تعيين كلمة المرور');
            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
    }
}
