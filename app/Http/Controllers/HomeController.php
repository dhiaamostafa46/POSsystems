<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Prodcategory;
use App\Models\Temporder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Organization;
use App\Models\Branch;
use App\Models\User;
use App\Models\Subscribtion;
use App\Models\Role;
use App\Models\Page;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Costcenteer;
use App\Models\DepotStore;
use App\Models\Inv;
use App\Models\Kitchen;
use App\Models\Orderdetails;
use App\Models\Product;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\VirtualAccounts;
use URL;
use Session;
use Carbon\Carbon;
use App\Models\Respons;
use App\Models\Stock;
use App\Models\Treasury;
use App\Models\Unit;
use App\Models\Volume;
use App\Models\SubsPayment;
use App\Models\OrgSetting;
use App\Models\Packagecatagury;
use App\Models\PackageList;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            if (empty(session('lang'))) {
                session()->put('lang', 'ar');
            }
            return view('public.home');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function restaurant()
    {
        try {
            if (empty(session('lang'))) {
                session()->put('lang', 'ar');
            }

            $organizations = Organization::where('status', 1)->where('activity', 2)->get();
            return view('customer.restaurants')->with('organizations', $organizations);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function Condition()
    {
        try {
            if (empty(session('lang'))) {
                session()->put('lang', 'ar');
            }
            return view('public.conditions');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function products($id)
    {
        try {
            session()->put('tableNo', null);
            session()->put('branch', null);
            session()->put('orderType', 3);
            session()->put('ordBy', 3);
            session()->put('products', []);

            $shop = Organization::findorFail($id);

            session()->put('branch', null);
            if ($shop->activity == 2) {
                $groups = Prodcategory::where('status', 1)
                    ->where('orgID', $shop->id)
                    ->where('TypeCatagoury', '1')
                    ->get();
                $items = Product::where('status', 1)
                    ->where('orgID', $shop->id)
                    ->where('TypeProdect', '1')
                    ->get();

                return view('customer.restproducts')
                    ->with('groups', $groups)
                    ->with('items', $items)
                    ->with('Online', $shop)
                    ->with('orgID', $shop->id);
            } else {
                $groups = Prodcategory::where('status', 1)
                    ->where('orgID', $shop->id)
                    ->orderBy('sort')
                    ->get();
                $items = Product::where('status', 1)
                    ->where('orgID', $shop->id)
                    ->get();
                $org = OrgSetting::where('orgID', $id)->first();
                session()->put('orgsetting', $org);
                //dd($org);
                return view('customer.Online')
                    ->with('groups', $groups)
                    ->with('items', $items)
                    ->with('Online', $shop)
                    ->with('orgID', $shop->id);
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function branch($id)
    {
        try {
            if (empty(session('lang'))) {
                session()->put('lang', 'ar');
            }
            $branches = Branch::where('status', 1)->where('orgID', $id)->get();
            return view('customer.branches')->with('branches', $branches);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function paymentResponse()
    {
        try {
            $transactionNo = $_GET['transactionNo'];
            $orderNumber = $_GET['orderNumber'];

            $token = HttpClient::login();
            $server_response = HttpClient::getRequest('/api/getInvoice/' . $transactionNo, $token);
            $result = [];
            array_push($result, ['qrUrl' => $server_response->qrUrl, 'orderStatus' => $server_response->orderStatus, 'amount' => $server_response->amount, 'transactionNo' => $server_response->transactionNo, 'paymentErrors' => $server_response->paymentErrors, 'url' => $server_response->url, 'checkUrl' => $server_response->checkUrl, 'success' => $server_response->success, 'digitalOrder' => $server_response->digitalOrder, 'paymentReceipt' => $server_response->paymentReceipt]);
            $res = new Respons();
            $res->request_ = 'none';
            $res->response_ = json_encode($result, true);
            $res->action = 'Get Invoice after pay';
            $res->userID = 99; //auth()->user()->id;
            $res->orgID = 1;
            $res->save();
            //dd($server_response);
            if ($server_response->orderStatus === 'Paid') {
                $temporder = Temporder::findorFail($orderNumber);
                if (!empty($temporder)) {
                    //********* Insert Order ************************ */
                    $year = date('Y');
                    $last_order = Order::where('branchID', $temporder->branchID)
                        ->orderBy('id', 'desc')
                        ->whereYear('created_at', $year)
                        ->first();

                    //dd($last_order);
                    $Inv = Inv::where('orgID', $temporder->orgID)->first();
                    if ($Inv == null) {
                        $Inv = new Inv();
                        $Inv->Inv = '1';
                        $Inv->orgID = $temporder->orgID;
                        $Inv->save();
                    } else {
                        $Inv->Inv = $Inv->Inv + 1;
                        $Inv->save();
                    }

                    if (strlen($Inv->Inv) == 1) {
                        $bill_num = '00000' . $Inv->Inv;
                    }
                    if (strlen($Inv->Inv) == 2) {
                        $bill_num = '0000' . $Inv->Inv;
                    }
                    if (strlen($Inv->Inv) == 3) {
                        $bill_num = '000' . $Inv->Inv;
                    }
                    if (strlen($Inv->Inv) == 4) {
                        $bill_num = '00' . $Inv->Inv;
                    }
                    if (strlen($Inv->Inv) == 5) {
                        $bill_num = '0' . $Inv->Inv;
                    }

                    $branch = Branch::findorFail($temporder->branchID);
                    //dd($branch->durations->first());

                    $last_order_no = Order::where('branchID', $temporder->branchID)
                        ->where('durationID', $branch->durations->first()->durationNo)
                        ->orderBy('id', 'desc')
                        ->first();

                    $order = new Order();
                    $order->customerID = $temporder->customerID;
                    $order->serial = $bill_num;
                    $order->type = 2;
                    $order->orderType = $temporder->orderType;
                    $order->tblNo = $temporder->tblNo;
                    $order->discount = $temporder->totaldiscount ?? 0;
                    $order->totalvat = $temporder->totalvat;
                    $order->totalwvat = $temporder->totalwvat;
                    $order->durationID = $branch->durations->first()->durationNo;
                    $order->userID = $temporder->userID;
                    $order->ordBy = $temporder->ordBy;
                    if ($last_order_no == null) {
                        $order->dailyBillNo = 1;
                    } else {
                        $order->dailyBillNo = $last_order_no->dailyBillNo + 1;
                    }

                    //-----------------------------------------------------------------------------------------------------------------

                    $Vir = VirtualAccounts::where('orgID', $temporder->orgID)->first();
                    $order->salaseAccount = $Vir->sale;
                    $order->CostCenter = $Vir->costcenter;
                    $acc = Accounting_guide::where('orgID', $temporder->orgID)
                        ->where('AccountID', '=', $Vir->sale)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->creditSecond = $temporder->totalwvat + $RPtData->creditSecond;
                    $RPtData->save();

                    $order->NameAcount = 'نافذة بيع';
                    $order->AccountID = $Vir->treasury;
                    $acc = Accounting_guide::where('orgID', $temporder->orgID)
                        ->where('AccountID', '=', $Vir->treasury)
                        ->first();
                    $RPtData = $acc->ReportData;
                    $RPtData->debitSecond = $temporder->totalwvat + $RPtData->debitSecond;
                    $RPtData->save();

                    //-------------------------------------------------------------------------------------------------------------------

                    $order->branchID = $temporder->branchID;
                    $order->orgID = $temporder->orgID;
                    $order->status = 1;
                    $order->ispaied = 1;
                    $order->kind = 2;
                    $order->save();

                    foreach ($temporder->orderdetails as $item) {
                        $billdetails = new Orderdetails();
                        $billdetails->orderID = $order->id;
                        $billdetails->productID = $item->productID;
                        $billdetails->kitchenID = $item->kitchenID;
                        $billdetails->productName = $item->productName;
                        $billdetails->quantity = $item->quantity;
                        $billdetails->price = $item->price;
                        $billdetails->discount = $item->discount;
                        $billdetails->total = $item->total;
                        $billdetails->totalcost = $item->totalcost;
                        $billdetails->userID = $item->userID;
                        $billdetails->branchID = $item->branchID;
                        $billdetails->orgID = $item->orgID;
                        $billdetails->kind = 2;
                        $billdetails->save();

                        $vol = Volume::where('ProdectID', $item->productID)->first();
                        //    $vol = $billdetails->product->Volume->VolumeDetail;
                        if ($vol != null) {
                            foreach ($vol->VolumeDetail as $Itemsss) {
                                $stock = new Stock();
                                $stock->productID = $Itemsss->ProdectId;
                                $stock->quantityOut = $Itemsss->Quantity * (float) $item->quantity;
                                $stock->orderID = $order->id;
                                $stock->comment = 'نافذة مبيعات';

                                $stock->branchID = $temporder->branchID;
                                $stock->orgID = $temporder->orgID;
                                $stock->depotID = $branch->DepotStore[0]->id;
                                $stock->kind = 7;
                                $stock->save();

                                UiteAllSeller($Itemsss->ProdectId, $Itemsss->Quantity * (float) $item->quantity, $branch->DepotStore[0]->id);
                            }
                        } else {
                            $stock = new Stock();
                            $stock->productID = $item->productID;
                            $stock->quantityOut = $item->quantity;
                            $stock->orderID = $order->id;
                            $stock->comment = 'نافذة مبيعات';

                            $stock->branchID = $temporder->branchID;
                            $stock->orgID = $temporder->orgID;
                            $stock->depotID = $branch->DepotStore[0]->id;
                            $stock->kind = 7;
                            $stock->save();

                            UiteAllSeller($item->productID, $item->quantity, $branch->DepotStore[0]->id);
                        }
                        $vol = null;
                    }
                }
                Session::forget('products');

                $shop = Organization::findOrFail($temporder->orgID);
                return view('customer.payment')
                    ->with('order', $order)
                    ->with('Online', $shop)
                    ->with('orgID', $shop->id);
            }
            return view('customer.paymentError');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function PackagePaymentResponse($id)
    {
        try {
            $transactionNo = $_GET['transactionNo'];
            $orderNumber = $_GET['orderNumber'];

            $urlPath = $_SERVER['REQUEST_URI'];
            $token = HttpClient::login();

            $parts = explode('/', strtok($urlPath, '?')); // strtok() is used to split only up to the first '?'

            // dd($parts[3]);

            $server_response = HttpClient::getRequest('/api/getInvoice/' . $transactionNo, $token);
            // dd($server_response);

            $result = [];
            array_push($result, ['qrUrl' => $server_response->qrUrl, 'orderStatus' => $server_response->orderStatus, 'amount' => $server_response->amount, 'transactionNo' => $server_response->transactionNo, 'paymentErrors' => $server_response->paymentErrors, 'url' => $server_response->url, 'checkUrl' => $server_response->checkUrl, 'success' => $server_response->success, 'digitalOrder' => $server_response->digitalOrder, 'paymentReceipt' => $server_response->paymentReceipt]);

            $res = new Respons();
            $res->request_ = 'none';
            $res->response_ = json_encode($result, true);
            $res->action = 'Get Package Invoice After Pay';
            $res->userID = 99; //auth()->user()->id;
            $res->orgID = 1;
            $res->save();

            if ($server_response->orderStatus == 'Paid') {
                $sup = new SubsPayment();
                $sup->orgID = auth()->user()->orgID;
                $sup->userID = auth()->user()->id;
                $sup->orderNo = $orderNumber;
                $sup->amount = $server_response->amount;
                //$sup->paymentMethod=;
                $sup->details = 'تجديد الباقة';
                $sup->pckID = $parts[3];
                $sup->save();

                $url = 'https://admin.evix.com.sa/api/getPackID/' . $parts[3];
                $response = json_decode(self::getRequest($url));
                $packages = $response;

                $pay = Subscribtion::where('orgID', auth()->user()->orgID)->first();
                $pay->endDate = Carbon::now()->addYears(1);
                $pay->save();

                foreach ($packages as $lst) {
                    $list = PackageList::where('orgID', auth()->user()->orgID)
                        ->where('code', $lst[2])
                        ->first();
                    $list->end = Carbon::now()->addYears(1);
                    $list->save();
                }

                //dd($server_response);
                session()->flash('success', 'تم عملية الدفع بنجاح.. شكرا لإختيارك إيفكس');
                return redirect(route('admin.index'));
            }
        } catch (\Exception $e) {
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

    public function kitchen($id)
    {
        try {
            $kitchen = Kitchen::findorFail($id);

            $items = Orderdetails::where('status', 1)->where('kitchenID', $id)->get();
            // dd( $items);
            $doneitems = Orderdetails::where('status', 2)->where('kitchenID', $id)->get();
            return view('kitchens.index')->with('items', $items)->with('doneitems', $doneitems)->with('kitchen', $kitchen);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function kitchenItems(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'items' => Orderdetails::where('status', 1)->where('kitchenID', $id)->get(),
                'items2' => Orderdetails::where('status', 2)->where('kitchenID', $id)->get(),
            ]);
        }
    }

    public function itemDone(Request $request, $id)
    {
        try {
            $item = Orderdetails::findorFail($id);
            $item->status == 1 ? ($item->status = 2) : ($item->status = 1);
            $item->save();

            $done = true;

            $order = $item->Order;
            foreach ($order->orderdetails as $det) {
                if ($det->status == 1) {
                    $done = false;
                    break;
                }
            }
            if ($done) {
                $order->status = 2;
                $order->save();
            }

            if ($request->ajax()) {
                return response()->json([
                    'items' => Orderdetails::where('status', 1)
                        ->where('kitchenID', $item->kitchenID)
                        ->get(),
                    'items2' => Orderdetails::where('status', 2)
                        ->where('kitchenID', $item->kitchenID)
                        ->get(),
                ]);
            }
        } catch (\Exception $e) {
            return  response()->json();
        }
    }

    public function organizationStore(Request $request)
    {
        try {
            $promcode = 'none';
            if ($request->inviteCode == 'yes') {
                $test = self::checkPromoCode($request->incode);

                if ($test == 'done') {
                    $promcode = $request->incode;
                } else {
                    return back();
                }
            }

            $user = new User();
            $org = new Organization();
            $branch = new Branch();

            $this->validate(
                $request,
                [
                    'nameAr' => 'required|string|max:191',
                    'phone' => 'required',
                    'type' => 'required',
                    'email' => 'required|string|email|max:191|unique:users',
                    'password' => 'required|confirmed|min:6',
                ],
                $messages = [
                    'required' => 'الرجاء عدم ترك حقل  فارغ',
                    'nameAr.required' => 'الرجاء عدم ترك حقل الاسم فارغ',
                    'type.required' => ' يجب اختيار نوع النشاط',
                    'phone.required' => 'الرجاء عدم ترك حقل  الجوال فارغ',
                    'email.required' => 'الرجاء عدم ترك حقل  البريد الالكتروني فارغ',
                    'email.unique' => 'البريد الالكتروني  موجود مسبقا',
                    'password.confirmed' => ' كلمة المرور غير متطابقة',
                ],
            );

            $data = explode('@', $request->email);

            $org->nameAr = $request->nameAr;
            $org->opening_balance = $request->opening_balance ?? null;
            $org->available_balance = $request->opening_balance ?? null;
            $org->userID = 1;
            $org->logo = 'default.png';
            $org->sectionID = $request->type;
            $org->activity = $request->type;
            $org->packageID = 1;
            $org->save();

            $branch->orgID = $org->id;
            $branch->userID = 1;
            $branch->nameAr = 'الفرع الرئيسي';
            $branch->nameEn = 'Main Branch';
            $branch->save();

            $user->name = $data[0];
            $user->orgID = $org->id;
            $user->branchID = $branch->id;
            $user->userID = 1;
            $user->roleID = 1;
            $user->type = 1;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->img = 'default.jpg';
            $user->ismanager = 1;
            $user->save();

            $test = self::storeOrgOnAdminPanel($org->id, $user->id, $request->email, $request->phone, $org->nameAr, $org->sectionID, $org->activity, $org->packageID, $promcode);

            $org->userID = $user->id;
            $org->save();

            $role = new Role();
            $role->nameAr = 'مدير';
            $role->nameEn = 'Manager';
            $role->orgID = $user->orgID;
            $role->branchID = $user->branchID;
            $role->userID = $user->id;
            $role->save();

            $user->roleID = $role->id;
            $user->save();

            if ($request->type == 2) {
                $rolecashier = new Role();
                $rolecashier->nameAr = 'كاشر';
                $rolecashier->nameEn = 'cashier';
                $rolecashier->orgID = $user->orgID;
                $rolecashier->branchID = $user->branchID;
                $rolecashier->userID = $user->id;
                $rolecashier->save();

                $rolenadal = new Role();
                $rolenadal->nameAr = 'نادل';
                $rolenadal->nameEn = 'nadal';
                $rolenadal->orgID = $user->orgID;
                $rolenadal->branchID = $user->branchID;
                $rolenadal->userID = $user->id;
                $rolenadal->save();

                $permission = new Permission();
                $permission->pageID = 64;
                $permission->roleID = $rolecashier->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
                $permission = new Permission();
                $permission->pageID = 65;
                $permission->roleID = $rolecashier->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
                $permission = new Permission();
                $permission->pageID = 66;
                $permission->roleID = $rolecashier->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
                $permission = new Permission();
                $permission->pageID = 15;
                $permission->roleID = $rolecashier->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();

                $permission = new Permission();
                $permission->pageID = 67;
                $permission->roleID = $rolenadal->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();

                $permission = new Permission();
                $permission->pageID = 68;
                $permission->roleID = $rolenadal->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
            }

            $roleemployee = new Role();
            $roleemployee->nameAr = 'موظف';
            $roleemployee->nameEn = 'employee';
            $roleemployee->orgID = $user->orgID;
            $roleemployee->branchID = $user->branchID;
            $roleemployee->userID = $user->id;
            $roleemployee->deleteable = 0;
            $roleemployee->save();

            $pages = Page::where('id', 63)->orWhere('id', 78)->get();
            foreach ($pages as $page) {
                $permission = new Permission();
                $permission->pageID = $page->id;
                $permission->roleID = $roleemployee->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
            }

            //********************************************************* */
            ////*********** */ link deafult role (manager) with all pages
            //********************************************************* */
            $pages = Page::where('status', 1)->get();
            foreach ($pages as $page) {
                $permission = new Permission();
                $permission->pageID = $page->id;
                $permission->roleID = $role->id;
                $permission->orgID = $user->orgID;
                $permission->branchID = $user->branchID;
                $permission->userID = $user->id;
                $permission->save();
            }
            
            
            $org = new OrgSetting();
            $org->orgID =  $org->id;
            $org->save();

            //****************************************************************** */
            /*************** Create subscribtion for new org ******************* */
            /******************************************************************* */

            $subscribtion = new Subscribtion();
            $subscribtion->orgID = $org->id;
            $subscribtion->userID = $user->id;
            $subscribtion->startDate = Carbon::now(); ///carbon function to get today datetime
            $subscribtion->endDate = Carbon::now()->addDays(14);
            $subscribtion->total = 0;
            $subscribtion->approveID = 1;
            $subscribtion->comment = 'اشتراك مجاني لأول مرة';
            $subscribtion->status = 1;
            $subscribtion->save();

            $Package = Packagecatagury::all();
            foreach ($Package as $pck) {
                $list = new PackageList();
                $list->orgID = $org->id;
                $list->name = $pck->nameAr;
                $list->code = $pck->nameEn;
                $list->end = Carbon::now()->addDays(14);
                $list->start = Carbon::now();
                $list->status = 1;
                $list->active = 1;
                $list->save();
            }

            $virt = new VirtualAccounts();
            $virt->bank = 122001;
            $virt->treasury = 121001;
            $virt->sale = 411;
            $virt->returnsale = 412;
            $virt->purch = 511;
            $virt->returnpuch = 512;
            $virt->costcenter = 1;
            $virt->orgID = $org->id;
            $virt->userID = $user->id;
            $virt->save();

            $data = AccountAllData();
            foreach ($data as $row) {
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = $row['id'];
                $AccountingGuide->AccountName = $row['name'];
                $AccountingGuide->AccountNameEn = $row['val0'];
                $AccountingGuide->type = $row['main'];
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 0;
                $AccountingGuide->Account_status = $row['status'];
                $AccountingGuide->SourceID = $row['father'];
                $AccountingGuide->typeProcsss = $row['type'];
                $AccountingGuide->orgID = $org->id;
                $AccountingGuide->save();

                $ReportData = new ReportData();
                $ReportData->orgID = $org->id;
                $ReportData->debitFrist = 0;
                $ReportData->creditFrist = 0;
                $ReportData->debitSecond = 0;
                $ReportData->creditSecond = 0;
                $ReportData->debitThird = 0;
                $ReportData->creditThird = 0;
                $ReportData->AccountID = $AccountingGuide->id;
                $ReportData->save();

                if ($row['id'] == '125001') {
                    $bank = new DepotStore();
                    $bank->AccountID = $row['id'];
                    $bank->name = $row['name'];
                    $bank->status = 1;
                    $bank->main = $row['father'];
                    $bank->branchID = $branch->id;
                    $bank->orgID = $user->orgID;
                    $bank->GuidesID = $AccountingGuide->id;
                    $bank->date = date('Y-m-d');
                    $bank->save();
                }

                if ($row['id'] == '122001') {
                    $bank = new Bank();
                    $bank->AccountID = $row['id'];
                    $bank->nameBank = $row['name'];
                    $bank->Country = 'SA';
                    $bank->currency = 'ريال سعودي';
                    $bank->NameAccountBank = $row['name'];
                    $bank->status = 1;
                    $bank->permissions = 1;
                    $bank->orgID = $user->orgID;
                    $bank->branchID = $branch->id;
                    $bank->save();
                }

                if ($row['id'] == '121001') {
                    $bank = new Treasury();
                    $bank->AccountCode = $row['id'];
                    $bank->name = $row['name'];
                    $bank->branchID = $branch->id;
                    $bank->orgID = $user->orgID;
                    $bank->save();
                }
            }

            $Inv = new Inv();
            $Inv->Inv = '00000';
            $Inv->orgID = $org->id;
            $Inv->save();

            $Costcenteer = new Costcenteer();
            $Costcenteer->CostName = ' التكلفة الرئيسية';
            $Costcenteer->CostCodeID = 1;
            $Costcenteer->CostNameEN = ' التكلفة الرئيسية';
            $Costcenteer->dataCost = date('Y-m-d');
            $Costcenteer->MainCost = 0;
            $Costcenteer->orgID = $org->id;
            $Costcenteer->branchID = $branch->id;
            $Costcenteer->SourceID = 0;
            $Costcenteer->namefather = ' التكلفة الرئيسية';
            $Costcenteer->save();

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
            $routAcount->orgID = $org->id;

            $routAcount->save();

            $unit = new Unit();
            $unit->nameAr = 'كيلو جرام';
            $unit->nameEn = 'Kg';

            $unit->orgID = $org->id;
            $unit->userID = $user->id;
            $unit->save();
            $unit = new Unit();
            $unit->nameAr = ' جرام';
            $unit->nameEn = 'gram';
            $unit->orgID = $org->id;
            $unit->userID = $user->id;
            $unit->save();

            $unit = new Unit();
            $unit->nameAr = ' قطعة';
            $unit->nameEn = 'piece';
            $unit->orgID = $org->id;
            $unit->userID = $user->id;
            $unit->save();

            // $bank = new DepotStore();
            // $bank->AccountID = '125001';
            // $bank->name      = "مستودع افتراضي";
            // $bank->status    = 1;
            // $bank->main      = 0;
            // $bank->branchID  =   $branch->id;
            // $bank->orgID     =   $org->id;
            // $bank->GuidesID  =    $branch->id;
            // $bank->date      = date("Y-m-d");
            // $bank->save();

            //********** to login autmaticly after registration *********** */
            Auth::login($user);
            return redirect(route('admin.index'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function storeOrgOnAdminPanel($orgID, $user, $email, $phone, $nameAr, $sectionID, $activity, $packageID, $promocode)
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
            "nameAr":"' .
            $nameAr .
            '",
            "email":"' .
            $email .
            '",
            "phone":"' .
            $phone .
            '",
            "sectionID":"' .
            $sectionID .
            '",
            "activity":"' .
            $activity .
            '",
             "packageID":"' .
            $packageID .
            '",
              "promocode":"' .
            $promocode .
            '"

        }';

        // http://127.0.0.1:8000/organizations
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://admin.evix.com.sa/api/newOrg',
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

    public function checkPromoCode($code)
    {
        //CURLOPT_URL => 'https://admin.evix.com.sa/api/tickets/'.auth()->user()->orgID,
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://admin.evix.com.sa/api/checkCode/' . $code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        if ($response == 'done') {
            return true;
        } else {
            $response;
        }
    }
    public function arabic()
    {
        App::setlocale('ar');
        Session::put('lang', 'ar');
        return redirect(url(URL::previous()));
    }
    public function english()
    {
        App::setlocale('en');
        Session::put('lang', 'en');
        return redirect(url(URL::previous()));
    }
}
