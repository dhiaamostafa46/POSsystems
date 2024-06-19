<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Temporderdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\Organization;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Prodcategory;
use App\Models\Temporder;
use App\Models\VirtualCustomer;

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



        if(!empty(session('tableNo'))){
            return redirect(route('tableOrder',[session('branch'),session('tableNo')]));
        }else{

            return redirect(route('public.products',$id));
        }

    }


      public function contact($id)
    {

         $shop = Organization::findorFail($id);
         $User=  $shop->User;

        return view('customer.contact')->with('orgID',$id)->with('Online',$shop)->with('User',$User);

    }

     public function categories($id)
    {

        $shop = Organization::findorFail($id);
        $groups = Prodcategory::where('status',1)->where('orgID',$shop->id)->get();
        return view('customer.categories')->with('orgID',$id)->with('Online',$shop)->with('groups',$groups);
    }

    public function group($id)
    {

        dd("");
    }
    public function tableOrder($branch,$id)
    {
        session()->put('tableNo',$id);
        session()->put('branch',$branch);
        session()->put('orderType',3);
        session()->put('ordBy',3);
        //session()->put('page','customers');
        $branch = Branch::findorFail($branch);
        $shop = $branch->organization;
        $groups = Prodcategory::where('status',1)->where('orgID',$shop->id)->where('TypeCatagoury' ,'1')->get();
        $items = Product::where('status',1)->where('orgID',$shop->id)->where('TypeProdect' ,'1')->get();



       return view('customer.restproducts')->with('groups',$groups)->with('items',$items)->with('Online',$shop)->with('orgID',$id);
    }

    public function driverOrder($branch,$id)
    {
        session()->put('driverThruNo',$id);
        session()->put('branch',$branch);
        session()->put('orderType',3);
        session()->put('ordBy',5);
        //session()->put('page','customers');
        $branch = Branch::findorFail($branch);
        $shop = $branch->organization;
        $groups = Prodcategory::where('status',1)->where('orgID',$shop->id)->get();
        $items = Product::where('status',1)->where('orgID',$shop->id)->get();



        return view('customer.index')->with('groups',$groups)->with('items',$items)->with('Online',$shop)->with('orgID',$shop->id);;
    }

     public function itemDetails($id,$orgID)
    {  $shop = Organization::findorFail($orgID);
        $item = Product::findorFail($id);
        return view('customer.itemdetails')->with('item',$item)->with('orgID',$orgID)->with('Online',$shop);
    }

    public function categoryDetails($id,$orgID)
    {
        $category = Prodcategory::findorFail($id);
        $shop = Organization::findorFail($orgID);
        $items = $category->products;
         return view('customer.categorydetails')->with('category',$category)->with('orgID',$orgID)->with('Online',$shop)->with('items',$items);
    }

    public function orderDetails($id)
    {
        session()->put('page','orderDetails');
        $order = Order::findorFail($id);
        return view('public.orderdetails')->with('order',$order);
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

   public function checkouts($orgID){

        //session()->put('products', []);

        $products = array();
        if(!empty(session('products')))
        {
            $count=0;
            foreach(session('products') as $product){
                $flage=0;
                $id = $product['id'];
                foreach( $products as $index=> $items)
                {
                    if($id ==$items['id']){
                      $flage=1;
                      $guan= $items['quantity'];
                      $sum =(int)$guan+1;
                      $products[$index]['quantity']= (string) $sum;
                    }
                }
                if($flage ==0)
                {
                    $count=$count+1;
                    $item = Product::where('id',$id)->first();
                    $products[] = ["id"=>$item->id,"nameAr"=>$item->nameAr,"nameEn"=>$item->nameEn,"price"=>$item->prodPrice,"quantity"=>$product['qnty'],"extra"=>$product['extra'],"extraSum"=>$product['extraSum'],"img"=>$item->img];
                }

            }
        }


        $payment_token = HttpClient::login();

        $shop = Organization::findorFail($orgID);


        if(!empty(session('tableNo'))){
            return view('customer.checkout')->with('products',$products)->with('Online',$shop)->with('payment_token',$payment_token)->with('orgID',$orgID);;
        }else{
            return view('customer.Checkoutcompany')->with('products',$products)->with('Online',$shop)->with('payment_token',$payment_token)->with('orgID',$orgID);;
        }
    }

    public function addToBasket(Request $request,$qnty,$id,$name,$exSum)
    {
        $products = ['id'=>$id,'qnty'=>$qnty,'extra'=>$name, 'extraSum'=>$exSum];
        if(!empty(session('products'))){
            session()->push('products', $products);
        }else{
            session()->put('products', [$products]);
        }
        $sum = 0;
        foreach(session('products') as $product){
            $sum = $sum + $product['qnty'];
        }

        if ($request->ajax()) {
            return response()->json([
                'sum' => $sum
            ]);
        }

    }

    public function storeTableClient(Request $request)
    {

        //********* Insert Order ************************ */

         $orgnization = Organization::findorFail($request->orgID);
        if(!empty(session('branch'))){

            $branch = Branch::findorFail((int)session('branch'));
        }else{

         $branch=  $orgnization->branches()->first();

        }
            session()->put('orgnizationID', $branch->orgID);
        $year = date("Y");

        //get last bill to increase serial + 1
        $last_bill = Temporder::where('orgID',$request->orgID)->orderBy('id','desc')->whereYear('created_at',$year)->first();


        if(!empty($last_bill->serial))
        $bill_num = (int)$last_bill->serial + 1;
        else
        $bill_num = 1;

        if(strlen($bill_num) == 1)
        $bill_num = '00000'.$bill_num;
        if(strlen($bill_num) == 2)
        $bill_num = '0000'.$bill_num;
        if(strlen($bill_num) == 3)
        $bill_num = '000'.$bill_num;
        if(strlen($bill_num) == 4)
        $bill_num = '00'.$bill_num;
        if(strlen($bill_num) == 5)
        $bill_num = '0'.$bill_num;


        $bill = new Temporder();

        $customers = VirtualCustomer::where('phone',$request->phone)->where('orgID',$request->orgID)->get();

        if(count($customers) == 0){
        $customer = new VirtualCustomer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->userID = 1;
        $customer->branchID =  $branch->id;;
        $customer->orgID = $request->orgID;
        $customer->save();
        }else{
            $customer = $customers->first();
        }


        $bill->customerID = $customer->id;
        $bill->serial = $bill_num;
        $bill->type = 2;
        $bill->orderType = session('orderType');
        $bill->ordBy = session('ordBy');
        $bill->tblNo = session('tblNo');
        $bill->discount = 0;
        $bill->totalvat = $request->total - $request->total/1.15;
        $bill->totalwvat = $request->total;
        $bill->userID = 1;
        $bill->branchID = $branch->id;
        $bill->orgID =$request->orgID;
        $bill->status = 1;
        $bill->save();

        //*********** Insert Bill details ************** */


        foreach(session('products') as $product){
            $id = (int)$product['id'];
            $item = Product::where('id',$id)->first();

            $billdetails = new Temporderdetails();
            $billdetails->orderID = $bill->id;
            $billdetails->productID = $item->id;
            $billdetails->productName = $item->nameAr;
            $billdetails->quantity = $product['qnty'];
            $billdetails->price = $item->prodPrice;
            $billdetails->discount = 0;
            $billdetails->total = ($item->prodPrice+$product['extraSum']) * $product['qnty'];
            $billdetails->totalcost = ($item->costPrice+$product['extraSum']) * $product['qnty'];
            $billdetails->userID = 1;
            $billdetails->branchID = $branch->id;
            $billdetails->orgID =$request->orgID;
            $billdetails->save();
        }

        return ["status"=>"success","msg"=>"added successfully","order_id"=>$bill->id,"total_amount"=>$bill->totalwvat];
    }




       public function storeTableClientCompany(Request $request)
    {

        //********* Insert Order ************************ */

         $orgnization = Organization::findorFail($request->orgID);
         $branch=  $orgnization->branches()->first();
         session()->put('orgnizationID', $branch->orgID);
        $year = date("Y");

        //get last bill to increase serial + 1
        $last_bill = Temporder::where('orgID',$request->orgID)->orderBy('id','desc')->whereYear('created_at',$year)->first();


        if(!empty($last_bill->serial))
        $bill_num = (int)$last_bill->serial + 1;
        else
        $bill_num = 1;

        if(strlen($bill_num) == 1)
        $bill_num = '00000'.$bill_num;
        if(strlen($bill_num) == 2)
        $bill_num = '0000'.$bill_num;
        if(strlen($bill_num) == 3)
        $bill_num = '000'.$bill_num;
        if(strlen($bill_num) == 4)
        $bill_num = '00'.$bill_num;
        if(strlen($bill_num) == 5)
        $bill_num = '0'.$bill_num;


        $bill = new Temporder();

        $customers = VirtualCustomer::where('phone',$request->phone)->where('orgID',$request->orgID)->get();

        if(count($customers) == 0){
        $customer = new VirtualCustomer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->userID = 1;
        $customer->branchID =  $branch->id;;
        $customer->orgID = $request->orgID;
        $customer->save();
        }else{
            $customer = $customers->first();
        }


        $bill->customerID = $customer->id;
        $bill->serial = $bill_num;
        $bill->type = 2;
        $bill->orderType = session('orderType');
        $bill->ordBy = session('ordBy');
        $bill->tblNo = session('tblNo');
        $bill->discount = 0;
        $bill->totalvat = $request->total - $request->total/1.15;
        $bill->totalwvat = $request->total;
        $bill->userID = 1;
        $bill->branchID = $branch->id;
        $bill->orgID =$request->orgID;
        $bill->status = 1;
        $bill->save();

        //*********** Insert Bill details ************** */


        foreach(session('products') as $product){
            $id = (int)$product['id'];
            $item = Product::where('id',$id)->first();

            $billdetails = new Temporderdetails();
            $billdetails->orderID = $bill->id;
            $billdetails->productID = $item->id;
            $billdetails->productName = $item->nameAr;
            $billdetails->quantity = $product['qnty'];
            $billdetails->price = $item->prodPrice;
            $billdetails->discount = 0;
            $billdetails->total = ($item->prodPrice+$product['extraSum']) * $product['qnty'];
            $billdetails->totalcost = ($item->costPrice+$product['extraSum']) * $product['qnty'];
            $billdetails->userID = 1;
            $billdetails->branchID = $branch->id;
            $billdetails->orgID =$request->orgID;
            $billdetails->save();
        }

        return ["status"=>"success","msg"=>"added successfully","order_id"=>$bill->id,"total_amount"=>$bill->totalwvat];
    }







    public function removeFromBasket($id ,$Org)
    {
        $items = session('products');

            if($items != ""){
                foreach ($items as $key => $values){
                    if($values['id'] == $id ){
                        unset($items[$key]);
                    }

                }

              session()->put('products', $items);
            }
         return redirect(route('checkouts',$Org));

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
