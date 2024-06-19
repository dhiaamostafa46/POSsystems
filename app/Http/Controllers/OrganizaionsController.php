<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use App\Models\Organization;
use App\Models\Loginrecord;
use App\Models\Respons;

use Illuminate\Support\Facades\Storage;

class OrganizaionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        try {
            session()->put('page', 'organizations');
            $org = Organization::findorFail(auth()->user()->orgID);
            return view('admin.organizations.index')->with('org', $org);
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
        try {
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
                $fileNametoStore = str_replace([' ', '.'], '_', $filename) . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('img')->move(public_path('dist/img/organizations'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $organization->img = $fileNametoStore;
            } else {
                $organization->img = 'profile.jpg';
            }

            // if ($request->hasFile('img')) {
            //     //get filename with extension
            //     $filenameWithExt = $request->file('img')->getClientOriginalName();
            //     //get just filename
            //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //     //get just extension
            //     $extension = $request->file('img')->getClientOriginalExtension();
            //     //create filename to store
            //     $fileNametoStore = $filename . '_' . time() . '.' . $extension;
            //     //upload image

            //     $path = $request->file('img')->move(public_path('dist/img/organizations'), $fileNametoStore);
            //     //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            // }
            // if ($request->hasFile('img')) {
            //     $organization->img = $fileNametoStore;
            // } else {
            //     $organization->img = "profile.jpg";
            // }
            $organization->name = $request->name;
            $organization->email = $request->email;
            $organization->phone = $request->phone;
            $organization->password = Hash::make($request->password);
            $organization->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('organizations.index'));
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
    public function linkPayment()
    {
        //******************************************************************* */
        //**************************** Test URL ***************************** */
        /******************************************************************** */
        session()->put('getTokenURL', 'https://restpilot.paylink.sa/api/partner/auth');
        session()->put('checkLicenseURL', 'https://restpilot.paylink.sa/api/partner/register/check-license');
        session()->put('validateMobileURL', 'https://restpilot.paylink.sa/api/partner/register/validate-otp');
        session()->put('addBankURL', 'https://restpilot.paylink.sa/api/partner/register/add-info');
        session()->put('confirmingAccountURL', 'https://restpilot.paylink.sa/api/partner/register/confirm-account');

        //******************************************************************** */
        //*************************** Production URL ************************* */
        /********************************************************************* */
        /*
        session()->put('getTokenURL', "https://restapi.paylink.sa/api/partner/auth");
        session()->put('checkLicenseURL', "https://restapi.paylink.sa/api/partner/register/check-license");
        session()->put('validateMobileURL', "https://restapi.paylink.sa/api/partner/register/validate-otp");
        session()->put('addBankURL', "https://restapi.paylink.sa/api/partner/register/add-info");
        session()->put('confirmingAccountURL', "https://restapi.paylink.sa/api/partner/register/confirm-account");
        */
        //******************************************************************** */
        //*************************** End URL ******************************** */
        //******************************************************************** */
        //dd(session("getTokenURL"));
        session()->put('profileNo', '27132731');
        session()->put('apiKey', 'a9b913b8-2e1e-36bb-be64-b24a9982f6e6');

        $token = $this->getToken();
        session()->put('tokenPayment', $token);
        return view('admin.organizations.merchentBasic');

        //$this->checkLicense();
        //$this->validateMobile();
    }

    public function storeBasic(Request $request)
    {
        $this->validate($request, [
            'registrationType' => 'required',
            'licenseNumber' => 'required',
            'mobileNumber' => 'required',
            'hijriYear' => 'required',
            'hijriMonth' => 'required',
            'hijriDay' => 'required',
        ]);

        $this->checkLicense($request->registrationType, $request->licenseNumber, $request->mobileNumber, $request->hijriYear, $request->hijriMonth, $request->hijriDay);

        session()->put('paymentError', 'فشلت العملية، تأكد من بيانات المنشأة المدخلة');

        if (empty(session('signature'))) {
            session()->flash('registrationType', $request->registrationType);
            session()->flash('licenseNumber', $request->licenseNumber);
            session()->flash('mobileNumber', $request->mobileNumber);
            session()->flash('hijriYear', $request->hijriYear);
            session()->flash('hijriMonth', $request->hijriMonth);
            session()->flash('hijriDay', $request->hijriDay);
            return view('admin.organizations.merchentBasic');
        } else {
            return view('admin.organizations.merchentOTP');
        }
    }

    public function storeOTP(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        $this->validateMobile($request->otp);
        //dd(session('banks'));
        if (empty(session('banks'))) {
            session()->flash('error', 'عذرا الرمز غير صحيح');
            session()->put('paymentError', 'فشلت العملية، رمز التحقق المدخل غير صحيح');
            return view('admin.organizations.merchentError');
        } else {
            return view('admin.organizations.merchentBank');
        }
    }

    public function storeBank(Request $request)
    {
        $this->validate($request, [
            'iban' => 'required',
            'bankName' => 'required',
            'categoryDescription' => 'required',
            'salesVolume' => 'required',
            'sellingScope' => 'required',
            'nationalId' => 'required',
            'Email' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
        ]);

        session()->put('iban', $request->iban);
        session()->put('bankName', $request->bankName);
        session()->put('categoryDescription', $request->categoryDescription);
        session()->put('salesVolume', $request->salesVolume);
        session()->put('sellingScope', $request->sellingScope);
        session()->put('nationalId', $request->nationalId);
        session()->put('Email', $request->Email);
        session()->put('firstName', $request->firstName);
        session()->put('lastName', $request->lastName);
        session()->put('password', $request->password);

        $this->addBank();
        if (empty(session('nafathRandomNumber'))) {
            session()->flash('error', 'فشلت العملية، تأكد من البيانات المدخلة');
            session()->put('paymentError', 'فشلت العملية، تأكد من بيانات المنشأة المدخلة');
            return view('admin.organizations.merchentError');
        } else {
            return view('admin.organizations.merchentPolicy');
        }
    }

    public function confirmNafath()
    {
        return view('admin.organizations.confirmNafath');
    }

    public function storeNafath()
    {
        try {
            if (empty(session('status'))) {
                session()->put('paymentError', 'خطأ في التحقق من الهوية عن طريق نفاذ');
                return view('admin.organizations.merchentError');
            } else {
                return view('admin.organizations.confirmAccount');
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function getToken()
    {
        $curl = curl_init();
        $req =
            '{
            "profileNo":"' .
            session('profileNo') .
            '",
            "apiKey":"' .
            session('apiKey') .
            '",
            "persistToken":"true"
            }';
        curl_setopt_array($curl, [
            CURLOPT_URL => session('getTokenURL'),
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

        $res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = 'getToken';
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();

        curl_close($curl);

        //dd($response);
        $response_a = json_decode($response, true);
        return $response_a['id_token'];
    }

    public function checkLicense($registrationType, $licenseNumber, $mobileNumber, $hijriYear, $hijriMonth, $hijriDay)
    {
        $curl = curl_init();
        $req =
            '{
            "registrationType":"' .
            $registrationType .
            '",
            "licenseNumber":"' .
            $licenseNumber .
            '",
            "mobileNumber":"' .
            $mobileNumber .
            '",
            "hijriYear":"' .
            $hijriYear .
            '",
            "hijriMonth":"' .
            $hijriMonth .
            '",
            "hijriDay":"' .
            $hijriDay .
            '",
            "partnerProfileNo":"' .
            session('profileNo') .
            '"
        }';
        curl_setopt_array($curl, [
            CURLOPT_URL => session('checkLicenseURL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Authorization: Bearer ' . session('tokenPayment')],
        ]);

        $response = curl_exec($curl);

        $res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = 'checkLicense';
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();

        curl_close($curl);
        //dd($response);
        try {
            $response_a = json_decode($response, true);
            session()->put('signature', $response_a['signature']);
            session()->put('sessionUuid', $response_a['sessionUuid']);
            session()->put('mobile', $mobileNumber);
        } catch (Exception $e) {
        }
    }

    public function validateMobile($otp)
    {
        $curl = curl_init();
        $req =
            '{
            "signature":"' .
            session('signature') .
            '",
            "sessionUuid":"' .
            session('sessionUuid') .
            '",
            "mobile":"' .
            session('mobile') .
            '",
            "otp":"' .
            $otp .
            '",
            "partnerProfileNo":"' .
            session('profileNo') .
            '"
            }';
        curl_setopt_array($curl, [
            CURLOPT_URL => session('validateMobileURL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Authorization: Bearer ' . session('tokenPayment')],
        ]);

        $response = curl_exec($curl);
        $res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = 'validateMobile';
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();
        curl_close($curl);
        try {
            $response_a = json_decode($response, true);
            session()->put('banks', $response_a['bankNames']);
            session()->put('monthlySalesVolumes', $response_a['monthlySalesVolumes']);
            session()->put('nationalIds', $response_a['nationalIds']);
            session()->put('licenseName', $response_a['licenseName']);
        } catch (Exception $e) {
        }
    }

    public function addBank()
    {
        $curl = curl_init();
        $req =
            '{
            "signature":"' .
            session('signature') .
            '",
            "sessionUuid":"' .
            session('sessionUuid') .
            '",
            "mobile":"' .
            session('mobile') .
            '",
            "partnerProfileNo":"' .
            session('profileNo') .
            '",
            "iban":"' .
            session('iban') .
            '",
            "bankName":"' .
            session('bankName') .
            '",
            "categoryDescription":"' .
            session('categoryDescription') .
            '",
            "salesVolume":"' .
            session('salesVolume') .
            '",
            "sellingScope":"' .
            session('sellingScope') .
            '",
            "nationalId":"' .
            session('nationalId') .
            '",
            "licenseName":"' .
            session('licenseName') .
            '",
            "email":"' .
            session('Email') .
            '",
            "firstName":"' .
            session('firstName') .
            '",
            "lastName":"' .
            session('lastName') .
            '",
            "password":"' .
            session('password') .
            '"
            }';
        curl_setopt_array($curl, [
            CURLOPT_URL => session('addBankURL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Authorization: Bearer ' . session('tokenPayment')],
        ]);

        $response = curl_exec($curl);
        $res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = 'addBank';
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();
        //dd($response);
        curl_close($curl);
        try {
            $response_a = json_decode($response, true);
            session()->put('terms', $response_a['terms']);
            session()->put('nafathRandomNumber', $response_a['nafathRandomNumber']);
        } catch (Exception $e) {
        }
    }

    public function confirmAccount()
    {
        $curl = curl_init();
        $req =
            '{
            "signature":"' .
            session('signature') .
            '",
            "sessionUuid":"' .
            session('sessionUuid') .
            '",
            "mobile":"' .
            session('mobile') .
            '",
            "partnerProfileNo":"' .
            session('profileNo') .
            '",
            }';
        curl_setopt_array($curl, [
            CURLOPT_URL => session('confirmingAccountURL'),
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

        $res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = 'confirmingAccount';
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();

        curl_close($curl);

        try {
            $response_a = json_decode($response, true);
            session()->put('status', $response_a['status']);
            session()->put('nafathNumber', $response_a['nafathNumber']);
        } catch (Exception $e) {
        }
    }

    public function reciveActivehook(Request $request)
    {
        $profileNo = $request->profileNo;
        // $email = $request->email;
        // $mobile = $request->mobile;
        // $civilId = $request->civilId;
        // $licenseType = $request->licenseType;
        //$licenseName = $request->licenseName;
        // $licenseNumber = $request->licenseNumber;
        $status = $request->status;
        //$errorMsg = $request->errorMsg;

        $res = new Respons();
        $res->request_ = 'none';
        $res->response_ = $request;
        $res->action = 'Activation Hook';
        $res->userID = 99; //auth()->user()->id;
        $res->orgID = 99; //auth()->user()->orgID;
        $res->save();

        if ($status == 'Approved' || $status == 'approved') {
            if ($request->licenseType == 'cr' || $request->licenseType == 'CR') {
                $org = Organization::where('CR', $request->licenseNumber);
            }

            $org->PayGateStatus = 1;
            $org->save();
        }
        return response($profileNo, 200)->header('Content-Type', 'application/json');
    }
    public function show($id)
    {
        try {
            $organization = Organization::findorFail($id);
            return view('admin.organizations.show')->with('organization', $organization);
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
            $org = Organization::findorFail($id);
            return view('admin.organizations.edit')->with('org', $org);
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
                $fileNametoStore = str_replace([' ', '.'], '_', $filename) . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('img')->move(public_path('dist/img/organizations'), $fileNametoStore);
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
                $fileNametoStore = str_replace([' ', '.'], '_', $filename) . '_' . time() . '.' . $extension;
                //upload image

                $path = $request->file('signature')->move(public_path('dist/img/organizations'), $fileNametoStore);
                //$path = $request->file('signature')->storeAs('public/signature/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('signature')) {
                $organization->signature = $fileNametoStore;
            }

            $organization->Chamber = $request->Chamber;
            $organization->Insbpnmbr = $request->Insbpnmbr;
            $organization->Nofacility = $request->Nofacility;
            $organization->Ntionladdress = $request->Ntionladdress;

            $organization->nameAr = $request->nameAr;
            $organization->nameEn = $request->nameEn;
            $organization->vatNo = $request->vatNo;
            $organization->CR = $request->CR;
            $organization->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('organizations.index'));
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
            $organization = Organization::findorFail($id);

            //then Delete Organization
            $organization->email = Hash::make($organization->created_at);
            $organization->password = Hash::make('xyz@zyx');
            $organization->status = 5;
            $organization->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('organizations.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function resetPassword($id)
    {
        try {
            $organization = Organization::find($id);
            $organization->password = Hash::make('123456');
            $organization->save();

            session()->flash('success', 'تم اعادة تعيين كلمة المرور');
            return redirect(route('organizations.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
