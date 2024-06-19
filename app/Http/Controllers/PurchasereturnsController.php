<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Branch;
use App\Models\Costcenteer;
use App\Models\Purchase;
use App\Models\Purchasedetails;
use App\Models\RoutAccount;
use App\Models\Stock;
use Illuminate\Http\Request;

class PurchasereturnsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        session()->put('page','purchases');
        session()->put('sub-page','purchasereturn');
        $RoutAccount =RoutAccount::where('userID' ,'=',auth()->user()->id)->first();
        $purchases = Purchase::where('status','!=',5)->where('kind','=','2')->where('orgID',auth()->user()->orgID)->where('created_at','>=',session('dateFrom'))->where('created_at','<',session('dateTo'))->get();
        return view('admin.purchases.indexReturns',['purchases'=>$purchases ,'RoutAccount'=>$RoutAccount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        session()->put('page','purchases');
        session()->put('sub-page','purchasereturn');
        $Cost= Costcenteer::where('orgID',auth()->user()->orgID)->get();
        if(auth()->user()->organization->activity ===3){
            return view('admin.purchases.Purchasereturns')->with('cost', $Cost);;
        }else{
            return view('admin.purchases.Purchasereturns')->with('cost', $Cost);;;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



        // 1 - فاتورة مشتريات
        // 2- مرتجع مشتريات
        $br=Branch::findorFail(auth()->user()->branchID);
        $RoutAccount =RoutAccount::where('userID' ,'=',auth()->user()->id)->first();
        //********* Insert Purchase ************************ */
        $supplier=explode("::",  $request->supplierID);
        $bill = new Purchase();
        $bill->supplierID =  $supplier[0];
        $bill->serial = $request->serial;
        $bill->invoiceDate = $request->invoiceDate;
        $bill->payDate = $request->payDate;
        $bill->type = $request->type;
        $bill->discount = $request->totaldiscount;
        $bill->totalvat = $request->vat;
        $bill->totalwvat = $request->totalwvat;
        $bill->userID = auth()->user()->id;
        $bill->branchID = auth()->user()->branchID;
        $bill->orgID = auth()->user()->orgID;
        $bill->status = 1;
        $bill->kind = 2;
        $bill->AccountPurch =   $RoutAccount->Purchreturns;
        $bill->CostCenter = $request->costcenter;

        if($request->type !=3)
        {
            $acc=Accounting_guide::where('orgID',auth()->user()->orgID)->where('AccountID' ,'=',$RoutAccount->Purchreturns)->first();
            $RPtData=$acc->ReportData;
            $RPtData->creditSecond=$request->totalwvat+ $RPtData->creditSecond;
            $RPtData->save();

            $data=explode("::",  $request->paymentTypeitems);
            $bill->NameAcount =  $data[2];
            $bill->AccountID =  $data[1];
            $acc=Accounting_guide::findorFail($data[0]);
            $RPtData=$acc->ReportData;
            $RPtData->debitSecond=$request->totalwvat+$RPtData->debitSecond;
            $RPtData->save();

        }else{

            $bill->NameAcount =  "اجل ";
            $bill->AccountID =  $supplier[1];
            $acc=Accounting_guide::where('orgID',auth()->user()->orgID)->where('AccountID' ,'=', $supplier[1])->first();
            $RPtData=$acc->ReportData;
            $RPtData->debitSecond=$request->totalwvat+$RPtData->debitSecond;
            $RPtData->save();
        }


        $bill->save();

        //*********** Insert Bill details ************** */
        $count = $request->count;

        for($i = 1;$i <= $count;$i++)
        {

        if($request->input("item".$i))
        {
                $billdetails = new Purchasedetails();
                $billdetails->purchaseID = $bill->id;
                $billdetails->productID = $request->input("item".$i);
                $billdetails->quantity = $request->input("quantity".$i);
                $billdetails->price = $request->input("price".$i);
                $billdetails->discount = $request->input("discount".$i);
                $billdetails->userID = auth()->user()->id;
                $billdetails->branchID = auth()->user()->branchID;
                $billdetails->orgID = auth()->user()->orgID;
                $billdetails->save();
                /***************** Stock ************ */

                $stock = new Stock();
                $stock->productID = $request->input("item".$i);
                $stock->quantityOut = $request->input("quantity".$i);
                $stock->purchaseID = $bill->id;
                $stock->comment = "فاتورة مشتريات";
                $stock->userID = auth()->user()->id;
                $stock->branchID = auth()->user()->branchID;
                $stock->orgID = auth()->user()->orgID;
                $stock->depotID =   $br->DepotStore[0]->id;
                $stock->save();

        }
        }
        return redirect(route('Purchasereturns.show',$bill->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        session()->put('page','purchases');
        session()->put('sub-page','purchasereturn');
        $purchase = Purchase::findorFail($id);
        return view('admin.purchases.showReturn')->with('purchase', $purchase);
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
