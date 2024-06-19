<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Role;
use App\Models\Loginrecord;
use App\Models\Pagecategory;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Subscribtion;
use App\Models\User;
use Exception;

//use App\Models\Package;

class SubsPacksController extends Controller
{
    /* public function __construct()
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
        try {
            session()->put('page', 'organizations');
            session()->put('page', 'roles');
            $organization = Organization::where('id', auth()->user()->orgID)->first();

            $url = 'https://admin.evix.com.sa/api/getPackByID/' . $organization->packageID;
            $response = json_decode(self::getRequest($url));
            $packName = $response->nameAr;

            $url2 = 'https://admin.evix.com.sa/api/getSubsByOrgID/' . auth()->user()->orgID;
            $response2 = json_decode(self::getRequest($url2));

            $orgsubs = $response2;

            $endDate = Subscribtion::where('orgID', auth()->user()->orgID)->first();

            //dd($endDate);

            return view('admin.subsPakages.index')->with('packName', $packName)->with('organization', $organization)->with('endDate', $endDate)->with('orgsubs', $orgsubs); //->with('tickets',$tickets);//->with('tickets',$tickets)
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function packagesitems($id)
    {
        $url = 'https://admin.evix.com.sa/api/getPackID/' . $id;
        $response = json_decode(self::getRequest($url));
        $packages = $response;

        return response()->json(['package' => $packages]);
    }
    public function teams()
    {
        try {
            session()->put('page', 'organizations');
            $teams = User::where('roleID', 19)->get();
            //dd($teams);
            return view('admin.subsPakages.index')->with('teams', $teams);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function packages()
    {
        try {
            // getPackages
            //getItemsByPackID
            //getSpecifsByPackID

            //Package
            $url = 'https://admin.evix.com.sa/api/getPackages';
            $response = json_decode(self::getRequest($url));

            $packages = $response;
            $url2 = 'https://admin.evix.com.sa/api/getSubs';
            $response2 = json_decode(self::getRequest($url2));

            $subs = $response2;
            //dd($response);
            return view('admin.subsPakages.packages')->with('packages', $packages)->with('subs', $subs);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function packDetails($id)
    {
        try {
            // getPackages
            //getItemsByPackID
            //getSpecifsByPackID

            //Package
            $url = 'https://admin.evix.com.sa/api/getItemsByPackID/' . $id;
            $response = json_decode(self::getRequest($url));

            $packitems = $response;
            $url2 = 'https://admin.evix.com.sa/api/getSpecifsByPackID/' . $id;
            $response2 = json_decode(self::getRequest($url2));

            $speifcs = $response2;
            //dd($response);
            return view('admin.subsPakages.packageDetails')->with('packitems', $packitems)->with('speifcs', $speifcs);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function create()
    {
        session()->put('page', 'organizations');
        //$teams = User::where('roleID',19)->get();
        //dd($teams);
        return view('admin.subsPakages.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $curl = curl_init();
        $req =
            '{
            "orgID":"' .
            auth()->user()->orgID .
            '",
            "userID":"' .
            auth()->user()->id .
            '",
            "title":"' .
            $request->title .
            '",
            "details":"' .
            $request->details .
            '"

        }';
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://admin.evix.com.sa/api/newTicket',
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

        /*$res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = "checkLicense";
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();*/

        curl_close($curl);
        if ($response == 'done') {
            session()->flash('success', 'تم رفع التذكرة');
            return redirect(route('subsPakages.index'));
        }

        session()->flash('faild', 'خطأ في رفع التذكرة يرجة المحاولة لاحقا');
        return redirect(route('subsPakages.index'));

        /*try{
            $response_a = json_decode($response, true);
            session()->put('signature', $response_a['signature']);
            session()->put('sessionUuid', $response_a['sessionUuid']);
            session()->put('mobile', $mobileNumber);
        }catch(Exception $e){
        }*/
    }

    public function getStatus($id)
    {
        $status = Ticket::where('id', $id)->first();

        $result = '';

        if ($status->tickStatus == 1) {
            $result = 'في إنتظار الموافقة';
        } elseif ($status->tickStatus == 2) {
            $result = 'تحت المعالحة';
        } elseif ($status->tickStatus == 3) {
            $result = 'تمت المعالجة';
        } elseif ($status->tickStatus == 4) {
            $result = 'مغلقة';
        }

        return response($result, 200)->header('Content-Type', 'application/json');
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
            //$ticket = Ticket::findorFail($id);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/getTicket/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);

            // dd(json_decode($response));

            //$tickets = array();
            $results = json_decode($response);
            $ticket = new Ticket();
            $ticket->id = $results->id;
            $ticket->orgID = $results->orgID;
            $ticket->userID = $results->userID;
            $ticket->tickStatus = $results->tickStatus;
            $ticket->created_at = $results->created_at;

            return view('admin.tickets.show')->with('ticket', $ticket);
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
            $role = Role::findorFail($id);
            return view('admin.roles.edit')->with('role', $role);
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
            $ticket = Ticket::findorFail($id);

            $ticket->teamComment = $request->teamComment;
            $ticket->tickStatus = $request->tickStatus;
            $ticket->teamID = auth()->user()->id;
            if ($request->tickStatus == 3) {
                $ticket->solveDate = Carbon::now();
            }
            $ticket->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('tickets.index'));
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
            $role = Role::findorFail($id);

            //then Delete Role
            $role->status = 5;
            $role->save();
            session()->flash('success', 'تم حذف الصلاحيات');
            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function paynow()
    {
        try {
            $orderno = Carbon::now()->timestamp;
            //dd($time);
            $payment_token = HttpClient::login();

            //$url = 'https://admin.evix.com.sa/api/getPackByID/'.auth()->user()->orgID;
            //$response = json_decode(self::getRequest($url));
            $url = 'https://admin.evix.com.sa/api/getPackages';
            $response = json_decode(self::getRequest($url));

            return view('admin.subsPakages.payNow')->with('payment_token', $payment_token)->with('orderno', $orderno)->with('packages', $response);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function getRequest($fullurl)
    {
        //CURLOPT_URL => 'https://admin.evix.com.sa/api/tickets/'.auth()->user()->orgID,
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $fullurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        return $response;
    }
}
