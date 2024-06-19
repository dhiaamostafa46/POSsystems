<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\CostStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\Branch;
use App\Models\Debitorder;
use App\Models\Debitorderdetails;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\ProdUnit;
use App\Models\Purchase;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Treasury;
use Exception;

class DebitordersController extends Controller
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
            session()->put('page', 'purchases');
            session()->put('sub-page', 'billsDebit');
            $orders = Debitorder::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->orderBy('created_at', 'DESC')
                ->get();
            return view('admin.debitorders.index')->with('orders', $orders);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            // dd(        $Purchase->purchasedetails[0]->product->unitprodect);
            try {
                $Purchase = Purchase::where('invoicesID', $id)
                    ->where('orgID', auth()->user()->orgID)
                    ->where('kind', 2)
                    ->first();

                if (empty($Purchase)) {
                    session()->flash('faild', ' تأكد من رقم الفاتورة او ان الفاتورة لم يتم ترحيلها');
                    return redirect(url()->previous());
                }
                // dd($Purchase->where('kind',2)->get() );
                $Supplier = Supplier::where('orgID', auth()->user()->orgID)->count();

                if ($Supplier == 0) {
                    session()->flash('faild', 'لا يوجد موردين');
                    return redirect(url()->previous());
                }
                $items_all = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
            } catch (Exception $e) {
                session()->flash('faild', 'خطا   في  فاتورة مشتريات');
                return redirect()->back();
            }

            session()->put('page', 'purchases');
            if (auth()->user()->organization->activity == 2) {
                return view('admin.debitorders.create')->with('items', $items)->with('items_all', $items_all)->with('Purchase', $Purchase);
            } else {
                return view('admin.debitorders.createshop')->with('items', $items)->with('items_all', $items_all)->with('Purchase', $Purchase);
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function getBarcode(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'items' => Product::where('barcode', $id)->get(),
            ]);
        }
    }

    public function checkDebitorder(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'order' => Debitorder::where('serial', $id)->get(),
            ]);
        }
    }

    public function totaldept()
    {
        try {
            $order = Debitorder::all();
            foreach ($order as $items) {
                if ($items->discount != null || $items->discount != 0) {
                    $items->totaldis = $items->totalwvat - $items->totalwvat * ($items->discount / 100);
                    $items->save();
                } else {
                    $items->totaldis = $items->totalwvat;
                    $items->save();
                }
            }
            return back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    // public function checkStore($id,$quantity){
    //     $product = Product::findorFail($id);
    //     $quantityInStock = $product->stocks->sum('quantityIn') - $product->stocks->sum('quantityOut');
    //     if($quantityInStock <= $quantity){
    //         if($product->parentID != null){
    //             $productParent = Product::findorFail($product->parentID);
    //             $parentInStock = $productParent->stocks->sum('quantityIn') - $productParent->stocks->sum('quantityOut');
    //             if($parentInStock > 0){
    //                 /***************** Stock Out ************ */
    //                 $stock = new Stock();
    //                 $stock->productID = $productParent->id;
    //                 $stock->quantityOut = 1;
    //                 $stock->comment = "فك بغرض المبيعات لـ ".$product->nameAr;
    //                 $stock->userID = auth()->user()->id;
    //                 $stock->branchID = auth()->user()->branchID;
    //                 $stock->orgID = auth()->user()->orgID;
    //                 $stock->save();

    //                 /***************** Stock In ************ */
    //                 $stock = new Stock();
    //                 $stock->productID = $product->id;
    //                 $stock->quantityIn = $productParent->unit->quantity;
    //                 $stock->comment = "فك بغرض المبيعات من ".$productParent->nameAr;
    //                 $stock->userID = auth()->user()->id;
    //                 $stock->branchID = auth()->user()->branchID;
    //                 $stock->orgID = auth()->user()->orgID;
    //                 $stock->save();
    //             }else{
    //                 if($productParent->parentID != null){
    //                     $productPParent = Product::findorFail($productParent->parentID);
    //                     $pParentInStock = $productPParent->stocks->sum('quantityIn') - $productPParent->stocks->sum('quantityOut');
    //                     if($pParentInStock > 0){
    //                     /***************** Stock Out ************ */
    //                     $stock = new Stock();
    //                     $stock->productID = $productPParent->id;
    //                     $stock->quantityOut = 1;
    //                     $stock->comment = "فك بغرض المبيعات لـ ".$product->nameAr;
    //                     $stock->userID = auth()->user()->id;
    //                     $stock->branchID = auth()->user()->branchID;
    //                     $stock->orgID = auth()->user()->orgID;
    //                     $stock->save();

    //                     /***************** Stock In ************ */
    //                     $stock = new Stock();
    //                     $stock->productID = $product->id;
    //                     $stock->quantityIn = $productPParent->unit->quantity - 1;
    //                     $stock->comment = "فك بغرض المبيعات من ".$productPParent->nameAr;
    //                     $stock->userID = auth()->user()->id;
    //                     $stock->branchID = auth()->user()->branchID;
    //                     $stock->orgID = auth()->user()->orgID;
    //                     $stock->save();

    //                     /***************** Stock In ************ */
    //                     $stock = new Stock();
    //                     $stock->productID = $product->id;
    //                     $stock->quantityIn = $productParent->unit->quantity;
    //                     $stock->comment = "فك بغرض المبيعات من ".$productParent->nameAr;
    //                     $stock->userID = auth()->user()->id;
    //                     $stock->branchID = auth()->user()->branchID;
    //                     $stock->orgID = auth()->user()->orgID;
    //                     $stock->save();
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //********* Insert Debitorder ************************ */

        // dd( $request->all());

        $this->validate($request, [
            'customerID' => 'required',
        ]);
        try {
            $bill = new Debitorder();

            $bill->type = $request->type;

            if (empty($request->customerID)) {
            } else {
                $customer = Supplier::findorFail($request->customerID);
            }

            $bill->customerID = $customer->id;
            $bill->serial = $request->serial;
            $bill->type = $request->type;
            $bill->discount = $request->Decscontall;
            $totals = 0;
            if ($request->Decscontall != null || $request->Decscontall != 0) {
                $totals = $request->totalwvat - $request->totalwvat * ($request->Decscontall / 100);
                $bill->totaldis = $totals;
            } else {
                $bill->totaldis = $request->totalwvat;
                $totals = $request->totalwvat;
            }
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;

            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $bill->CostCenter = 0;
            $bill->purchreAccount = $RoutAccount->Purchreturns;

            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $RoutAccount->Purchreturns)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->creditSecond = (float) $totals + $RPtData->creditSecond;
            $RPtData->save();

            $data = explode('::', $request->paymentTypeitems);
            $bill->nameAccount = $data[2];
            $bill->AccountID = $data[1];
            $acc = Accounting_guide::findorFail($data[0]);
            $RPtData = $acc->ReportData;
            $RPtData->debitSecond = (float) $totals + $RPtData->debitSecond;
            $RPtData->save();
            $bill->save();

            //*********** Insert Bill details ************** */
            $br = Branch::findorFail(auth()->user()->branchID);
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Debitorderdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->desc = $request->input('desc' . $i);
                    $billdetails->save();
                    /***************** Stock ************ */
                    // $this->checkStore($request->input("item".$i),$request->input("quantity".$i));
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityOut = $request->input('quantity' . $i);
                    $stock->orderID = $bill->id;
                    $stock->comment = 'اشعار مدين - اضافة لفاتورة';
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $br->DepotStore[0]->id;
                    $stock->kind = 10;
                    $stock->save();

                    UiteAllReturned($request->input('unitindex' . $i), $request->input('item' . $i), $request->input('price' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return redirect(route('debitorders.index', $bill->id));
    }

    function getQr($seller, $tax, $tim, $total, $vat)
    {
        $result1 = bin2hex($seller);
        $result2 = bin2hex($tax);
        $result3 = bin2hex($tim);
        $result4 = bin2hex($total);
        $result5 = bin2hex($vat);

        // $result1 = bin2hex("Eyein Cafeee");
        // $result2 = bin2hex("310524172700003");
        // $result3 = bin2hex("2023-05-25T18:30:00Z");
        // $result4 = bin2hex("100.000");
        // $result5 = bin2hex("15.000");

        $hexafinal = '010c' . $result1 . '020F' . $result2 . '0314' . $result3 . '0407' . $result4 . '0506' . $result5;
        $FINAL = base64_encode($hexafinal);

        return $FINAL;
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
            $order = Debitorder::findorFail($id);
            $qr = $this->getQr(auth()->user()->organization->nameAr, auth()->user()->organization->vatNo, $order->created_at, $order->totalwvat, $order->totalvat);
            if (empty($order->customer->vatNo)) {
                $page = 'show-small';
            } else {
                $page = 'show';
            }
            return view('admin.debitorders.' . $page)
                ->with('order', $order)
                ->with('qr', $qr);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
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
            $order = Debitorder::findorFail($id);
            return view('admin.debitorders.edit')->with('order', $order);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
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
        $order = Debitorder::findorFail($id);
        $this->validate($request, [
            'nameAr' => 'required|string|max:191',
        ]);
        try {
            $order->nameAr = $request->nameAr;
            $order->nameEn = $request->nameEn;
            $order->quantity = $request->quantity;
            $order->orgID = auth()->user()->orgID;
            $order->userID = auth()->user()->id;
            $order->save();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        session()->flash('success', 'تم تحديث البيانات');
        return redirect(route('debitorders.index'));
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
            $order = Debitorder::findorFail($id);
            $order->status = 5;
            $order->save();
        } catch (Exception $e) {
            session()->flash('faild', 'خطا في تحديث  مرتجع مشتريات');
            return redirect()->back();
        }

        session()->flash('success', 'تم حذف القسم بنجاح');
        return redirect(route('debitorders.index'));
    }
}
