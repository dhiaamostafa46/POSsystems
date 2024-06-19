<?php

namespace App\Http\Controllers;

use App\Models\Booktable;
use App\Models\Branch;
use App\Models\MessageNadel;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Temporderdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Carbon\Carbon;
use App\Models\Organization;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Prodcategory;
use App\Models\Tbl;
use App\Models\OrgSetting;
use App\Models\Temporder;
use App\Models\VirtualCustomer;
use Session;
class ClientsController extends Controller
{


    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //session()->put('page','customers');

        try {
            if (!empty(session('tableNo'))) {
                return redirect(route('tableOrder', [session('branch'), session('tableNo')]));
            } else {
                return redirect(route('public.products', $id));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function getmassagenade()
    {
        try {
            $book = MessageNadel::where('branchID', auth()->user()->branchID)->get();

            foreach ($book as $item) {
                $current_time = strtotime(date('Y-m-d H:i:s'));
                $item_time = strtotime($item->created_at);

                // Check if the difference between current time and item's created_at time is more than 1 minute (60 seconds)
                if ($current_time - $item_time > 30) {
                    $item->delete();
                }
            }
        } catch (\Exception $e) {
            return response()->json();
        }
        return response()->json(['code' => $book]);
    }
    public function storeTableClientPaylater($total)
    {
        try {
            if (!empty(session('tableNo'))) {
                $bill = new Order();

                $table = Tbl::findOrFail(session('tableNo'));
                $customers = VirtualCustomer::where('name', 'عميل افتراضي')
                    ->where('orgID', $table->orgID)
                    ->get();

                if (count($customers) == 0) {
                    $customer = new VirtualCustomer();
                    $customer->name = 'عميل افتراضي';
                    $customer->phone = '05000000000000';
                    $customer->userID = 1;
                    $customer->branchID = $table->branchID;
                    $customer->orgID = $table->orgID;
                    $customer->save();
                } else {
                    $customer = $customers->first();
                }

                $bill->customerID = $customer->id;
                $bill->type = 3;
                $bill->tblNo = $table->id;
                $bill->totalvat = $total - $total / 1.15;
                $bill->totalwvat = $total;
                $bill->branchID = $table->branchID;
                $bill->orgID = $table->orgID;
                $bill->status = 1;
                $bill->ispaied = 1;
                $bill->kind = 2;
                $bill->TypeInv = 2;

                $bill->save();

                $products = [];
                if (!empty(session('products'))) {
                    $count = 0;
                    foreach (session('products') as $product) {
                        $flage = 0;
                        $id = $product['id'];
                        foreach ($products as $index => $items) {
                            if ($id == $items['id']) {
                                $flage = 1;
                                $guan = $items['quantity'];
                                $sum = (int) $guan + 1;
                                $products[$index]['quantity'] = (string) $sum;
                            }
                        }
                        if ($flage == 0) {
                            $count = $count + 1;
                            $item = Product::where('id', $id)->first();
                            $products[] = ['id' => $item->id, 'nameAr' => $item->nameAr, 'nameEn' => $item->nameEn, 'price' => $item->prodPrice, 'quantity' => $product['qnty'], 'extra' => $product['extra'], 'extraSum' => $product['extraSum'], 'img' => $item->img];
                        }
                    }
                }

                foreach ($products as $product) {
                    $id = (int) $product['id'];
                    $item = Product::where('id', $id)->first();

                    $billdetails = new Orderdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $item->id;
                    $billdetails->productName = $item->nameAr;
                    $billdetails->kitchenID = $item->kitchenID;
                    $billdetails->quantity = $product['quantity'];
                    $billdetails->price = $item->prodPrice;
                    $billdetails->discount = 0;
                    $billdetails->total = (float) $product['quantity'] * (float) $product['price'];
                    $billdetails->totalcost = (float) $product['quantity'] * $item->costPrice;
                    $billdetails->userID = 0;
                    $billdetails->branchID = $table->branchID;
                    $billdetails->orgID = $table->orgID;
                    $billdetails->kind = 1;
                    $billdetails->save();
                }

                session::forget('products');

                return redirect()->route('tableOrder', [$table->branchID, $table->id]);
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function contact($id)
    {
        try {
            $shop = Organization::findorFail($id);
            $User = $shop->User;
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return view('customer.contact')->with('orgID', $id)->with('Online', $shop)->with('User', $User);
    }

    public function categories($id)
    {
        try {
            $shop = Organization::findorFail($id);
            $groups = Prodcategory::where('status', 1)
                ->where('orgID', $shop->id)
                ->get();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('customer.categories')->with('orgID', $id)->with('Online', $shop)->with('groups', $groups);
    }

    public function group($id)
    {
        dd('');
    }
    public function maintable($branch, $id)
    {
        try {
            session()->put('tableNo', $id);

            session()->put('branch', $branch);
            session()->put('orderType', 3);
            session()->put('ordBy', 3);

            //session()->put('page','customers');
            $branch = Branch::findorFail($branch);
            $shop = $branch->organization;
            $groups = Prodcategory::where('status', 1)
                ->where('orgID', $shop->id)
                ->where('TypeCatagoury', '1')
                ->get();
            $items = Product::where('status', 1)
                ->where('orgID', $shop->id)
                ->where('TypeProdect', '1')
                ->get();
            $org = OrgSetting::where('orgID', $branch->orgID)->first();
            session()->put('orgsetting', $org);
        } catch (\Exception $e) {
            return redirect()->back();
        }
        return view('customer.maintable')
            ->with('groups', $groups)
            ->with('items', $items)
            ->with('Online', $shop)
            ->with('orgID', $shop->id)
            ->with('storsetting', $org);
    }

    public function callnadel()
    {
        try {
            $Table = Tbl::findorFail(session('tableNo'));
            $branch = Branch::findorFail(session('branch'));

            $call = new MessageNadel();
            $call->orgID = $Table->orgID;
            $call->branchID = $branch->id;
            $call->msg = $Table->id;
            $call->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return back()->with('success', '   تم طلب النادل  ');
    }

    public function PayNow()
    {
        try {
            //session()->put('page','customers');
            $Table = Tbl::findorFail(session('tableNo'));
            $branch = Branch::findorFail(session('branch'));
            $Online = Organization::findorFail($Table->orgID);

            $currentDateTime = Carbon::now();

            $halfHourAgo = $currentDateTime->subMinutes(30);

            $order = Order::where('tblNo', $Table->id)
                ->where('orgID', $Table->orgID)
                ->whereTime('created_at', '>', $halfHourAgo->format('H:i:s')) // Filter orders created after half an hour ago (time only)
                // Filter orders created up to now (time only)
                ->get();
            // $order = Order::where('tblNo', $Table->id)
            //     ->where('orgID', $Table->orgID)
            //     ->whereDate('created_at', '>',   $halfHourAgo )
            //     ->whereDate('created_at', '<=', date('Y-m-d H:i:s'))->get();

            return view('customer.paynow')
                ->with('Online', $Online)
                ->with('orgID', $Online->id)
                ->with('Order', $order);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function tableOrder($branch, $id)
    {
        try {
            session()->put('tableNo', $id);

            session()->put('branch', $branch);
            session()->put('orderType', 3);
            session()->put('ordBy', 3);
            //session()->put('page','customers');
            $branch = Branch::findorFail($branch);
            $shop = $branch->organization;
            $groups = Prodcategory::where('status', 1)
                ->where('orgID', $shop->id)
                ->where('TypeCatagoury', '1')
                ->get();
            $items = Product::where('status', 1)
                ->where('orgID', $shop->id)
                ->where('TypeProdect', '1')
                ->get();
            $org = OrgSetting::where('orgID', $branch->orgID)->first();
            session()->put('orgsetting', $org);
            return view('customer.restproducts')
                ->with('groups', $groups)
                ->with('items', $items)
                ->with('Online', $shop)
                ->with('orgID', $shop->id);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function driverOrder($branch, $id)
    {
        try {
            session()->put('driverThruNo', $id);
            session()->put('branch', $branch);
            session()->put('orderType', 3);
            session()->put('ordBy', 5);
            //session()->put('page','customers');
            $branch = Branch::findorFail($branch);
            $shop = $branch->organization;
            $groups = Prodcategory::where('status', 1)
                ->where('orgID', $shop->id)
                ->get();
            $items = Product::where('status', 1)
                ->where('orgID', $shop->id)
                ->get();

            return view('customer.index')
                ->with('groups', $groups)
                ->with('items', $items)
                ->with('Online', $shop)
                ->with('orgID', $shop->id);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function itemDetails($id, $orgID)
    {
        try {
            $shop = Organization::findorFail($orgID);
            $item = Product::findorFail($id);
            return view('customer.itemdetails')->with('item', $item)->with('orgID', $orgID)->with('Online', $shop);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function categoryDetails($id, $orgID)
    {
        try {
            $category = Prodcategory::findorFail($id);
            $shop = Organization::findorFail($orgID);
            $items = $category->products;
            return view('customer.categorydetails')->with('category', $category)->with('orgID', $orgID)->with('Online', $shop)->with('items', $items);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function orderDetails($id)
    {
        session()->put('page', 'orderDetails');
        $order = Order::findorFail($id);
        return view('public.orderdetails')->with('order', $order);
    }

    // public function checkouts(){

    //     //session()->put('products', []);
    //     $products = array();
    //     if(!empty(session('products')))
    //     {
    //         foreach(session('products') as $product){
    //             $id = (int)$product['id'];
    //             $item = Product::where('id',$id)->first();
    //             $products[] = ["id"=>$item->id,"nameAr"=>$item->nameAr,"nameEn"=>$item->nameEn,"price"=>$item->prodPrice,"quantity"=>$product['qnty'],"extra"=>$product['extra'],"extraSum"=>$product['extraSum'],"img"=>$item->img];

    //         }
    //     }
    //     $payment_token = HttpClient::login();

    //     $branch = Branch::findorFail((int)session('branch'));
    //     $shop = $branch->organization;

    //     return view('customer.checkout')->with('products',$products)->with('shop',$shop)->with('payment_token',$payment_token);
    // }

    public function checkouts($orgID)
    {
        //session()->put('products', []);

        try {
            $products = [];
            if (!empty(session('products'))) {
                $count = 0;
                foreach (session('products') as $product) {
                    $flage = 0;
                    $id = $product['id'];
                    foreach ($products as $index => $items) {
                        if ($id == $items['id']) {
                            $flage = 1;
                            $guan = $items['quantity'];
                            $sum = (int) $guan + 1;
                            $products[$index]['quantity'] = (string) $sum;
                        }
                    }
                    if ($flage == 0) {
                        $count = $count + 1;
                        $item = Product::where('id', $id)->first();
                        $products[] = ['id' => $item->id, 'nameAr' => $item->nameAr, 'nameEn' => $item->nameEn, 'price' => $item->prodPrice, 'quantity' => $product['qnty'], 'extra' => $product['extra'], 'extraSum' => $product['extraSum'], 'img' => $item->img];
                    }
                }
            }

            $payment_token = HttpClient::login();

            $shop = Organization::findorFail($orgID);

            if (!empty(session('tableNo'))) {
                return view('customer.checkout')->with('products', $products)->with('Online', $shop)->with('payment_token', $payment_token)->with('orgID', $orgID);
            } else {
                return view('customer.Checkoutcompany')->with('products', $products)->with('Online', $shop)->with('payment_token', $payment_token)->with('orgID', $orgID);
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function addToBasket(Request $request, $qnty, $id, $name, $exSum)
    {
        try {
            $products = ['id' => $id, 'qnty' => $qnty, 'extra' => $name, 'extraSum' => $exSum];
            if (!empty(session('products'))) {
                session()->push('products', $products);
            } else {
                session()->put('products', [$products]);
            }
            $sum = 0;
            foreach (session('products') as $product) {
                $sum = $sum + $product['qnty'];
            }

            if ($request->ajax()) {
                return response()->json([
                    'sum' => $sum,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json();
        }
    }

    public function storeTableClient(Request $request)
    {
        //********* Insert Order ************************ */
        try {
            $orgnization = Organization::findorFail($request->orgID);
            if (!empty(session('branch'))) {
                $branch = Branch::findorFail((int) session('branch'));
            } else {
                $branch = $orgnization->branches()->first();
            }
            session()->put('orgnizationID', $branch->orgID);
            $year = date('Y');

            //get last bill to increase serial + 1
            $last_bill = Temporder::where('orgID', $request->orgID)
                ->orderBy('id', 'desc')
                ->whereYear('created_at', $year)
                ->first();

            if (!empty($last_bill->serial)) {
                $bill_num = (int) $last_bill->serial + 1;
            } else {
                $bill_num = 1;
            }

            if (strlen($bill_num) == 1) {
                $bill_num = '00000' . $bill_num;
            }
            if (strlen($bill_num) == 2) {
                $bill_num = '0000' . $bill_num;
            }
            if (strlen($bill_num) == 3) {
                $bill_num = '000' . $bill_num;
            }
            if (strlen($bill_num) == 4) {
                $bill_num = '00' . $bill_num;
            }
            if (strlen($bill_num) == 5) {
                $bill_num = '0' . $bill_num;
            }

            $bill = new Temporder();

            $customers = VirtualCustomer::where('name', 'عميل افتراضي')
                ->where('orgID', $request->orgID)
                ->get();

            if (count($customers) == 0) {
                $customer = new VirtualCustomer();
                $customer->name = 'عميل افتراضي';
                $customer->phone = '05000000000000';
                $customer->userID = 1;
                $customer->branchID = $branch->id;
                $customer->orgID = $request->orgID;
                $customer->save();
            } else {
                $customer = $customers->first();
            }

            $bill->customerID = $customer->id;
            $bill->serial = $bill_num;
            $bill->type = 2;
            $bill->orderType = session('orderType');
            $bill->ordBy = session('ordBy');
            $bill->tblNo = session('tblNo');
            $bill->discount = 0;
            $bill->totalvat = $request->total - $request->total / 1.15;
            $bill->totalwvat = $request->total;
            $bill->userID = 1;
            $bill->branchID = $branch->id;
            $bill->orgID = $request->orgID;
            $bill->status = 1;
            $bill->save();

            //*********** Insert Bill details ************** */

            foreach (session('products') as $product) {
                $id = (int) $product['id'];
                $item = Product::where('id', $id)->first();

                $billdetails = new Temporderdetails();
                $billdetails->orderID = $bill->id;
                $billdetails->productID = $item->id;
                $billdetails->productName = $item->nameAr;
                $billdetails->quantity = $product['qnty'];
                $billdetails->price = $item->prodPrice;
                $billdetails->discount = 0;
                $billdetails->total = ($item->prodPrice + $product['extraSum']) * $product['qnty'];
                $billdetails->totalcost = ($item->costPrice + $product['extraSum']) * $product['qnty'];
                $billdetails->userID = 1;
                $billdetails->branchID = $branch->id;
                $billdetails->orgID = $request->orgID;
                $billdetails->save();
            }

            return ['status' => 'success', 'msg' => 'added successfully', 'order_id' => $bill->id, 'total_amount' => $bill->totalwvat];
        } catch (\Exception $e) {
            return ['status' => 'success'];
        }
    }

    public function storeTableClientCompany(Request $request)
    {
        //********* Insert Order ************************ */

        try {
            $orgnization = Organization::findorFail($request->orgID);
            $branch = $orgnization->branches()->first();
            session()->put('orgnizationID', $branch->orgID);
            $year = date('Y');

            //get last bill to increase serial + 1
            $last_bill = Temporder::where('orgID', $request->orgID)
                ->orderBy('id', 'desc')
                ->whereYear('created_at', $year)
                ->first();

            if (!empty($last_bill->serial)) {
                $bill_num = (int) $last_bill->serial + 1;
            } else {
                $bill_num = 1;
            }

            if (strlen($bill_num) == 1) {
                $bill_num = '00000' . $bill_num;
            }
            if (strlen($bill_num) == 2) {
                $bill_num = '0000' . $bill_num;
            }
            if (strlen($bill_num) == 3) {
                $bill_num = '000' . $bill_num;
            }
            if (strlen($bill_num) == 4) {
                $bill_num = '00' . $bill_num;
            }
            if (strlen($bill_num) == 5) {
                $bill_num = '0' . $bill_num;
            }

            $bill = new Temporder();

            $customers = VirtualCustomer::findOrFail($request->id);
            // $customers = VirtualCustomer::where('phone',$request->phone)->where('orgID',$request->orgID)->get();

            // if(count($customers) == 0){
            // $customer = new VirtualCustomer();
            // $customer->name = $request->name;
            // $customer->phone = $request->phone;
            // $customer->userID = 1;
            // $customer->branchID =  $branch->id;;
            // $customer->orgID = $request->orgID;
            // $customer->save();
            // }else{
            //     $customer = $customers->first();
            // }

            $bill->customerID = $customers->id;
            $bill->serial = $bill_num;
            $bill->type = 2;
            $bill->orderType = session('orderType');
            $bill->ordBy = session('ordBy');
            $bill->tblNo = session('tblNo');
            $bill->discount = 0;
            $bill->totalvat = $request->total - $request->total / 1.15;
            $bill->totalwvat = $request->total;
            $bill->userID = 1;
            $bill->branchID = $branch->id;
            $bill->orgID = $request->orgID;
            $bill->status = 1;
            $bill->save();

            //*********** Insert Bill details ************** */

            foreach (session('products') as $product) {
                $id = (int) $product['id'];
                $item = Product::where('id', $id)->first();

                $billdetails = new Temporderdetails();
                $billdetails->orderID = $bill->id;
                $billdetails->productID = $item->id;
                $billdetails->productName = $item->nameAr;
                $billdetails->quantity = $product['qnty'];
                $billdetails->price = $item->prodPrice;
                $billdetails->discount = 0;
                $billdetails->total = ($item->prodPrice + $product['extraSum']) * $product['qnty'];
                $billdetails->totalcost = ($item->costPrice + $product['extraSum']) * $product['qnty'];
                $billdetails->userID = 1;
                $billdetails->branchID = $branch->id;
                $billdetails->orgID = $request->orgID;
                $billdetails->save();
            }

            return ['status' => 'success', 'msg' => 'added successfully', 'order_id' => $bill->id, 'total_amount' => $bill->totalwvat];
        } catch (\Exception $e) {
            return ['status' => 'success'];
        }
    }

    public function removeFromBasket($id, $Org)
    {
        try {
            $items = session('products');

            if ($items != '') {
                foreach ($items as $key => $values) {
                    if ($values['id'] == $id) {
                        unset($items[$key]);
                    }
                }

                session()->put('products', $items);
            }
            return redirect(route('checkouts', $Org));
        } catch (\Exception $e) {
            return redirect()->back();
        }
        //  return response()->json(['products' => $items ]);
    }

    // public function removeFromBasket($id)
    // {

    //      dd(session('products')->forget($id));
    //     session()->put('page_id','removeFromBasket');
    //     $products = session()->pull('products', []);
    //     // Second argument is a default value

    //     if(($key = array_search($id, $products)) !== false) {
    //         unset($products[$key]);
    //     }

    //     session()->put('products', $products);
    //     return back();
    //     // $deliveryfees = Deliveryfees::where('locality_id',auth()->user()->locality_id)->orderBy('id','DESC')->get()->first();
    //     // $products = Product::findMany(session('products'));
    //     // return view('public.myBasket')->with('products',$products)->with('deliveryfees',$deliveryfees);
    // }

    public function clearBasket()
    {
        session()->put('products', []);
        return redirect(route('public.index'));
    }
}
