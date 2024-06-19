<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Credorder;
use App\Models\Credorderdetails;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\Order;
use App\Models\OrderInv;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Treasury;
use App\Models\VirtualAccounts;
use App\Models\Volume;
use Exception;

class CredordersController extends Controller
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
            session()->put('page', 'orders');
            session()->put('sub-page', 'billsCred');

            $orders = Credorder::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
        return view('admin.credorders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            try {
                $flage = 0;
                $Purchase = OrderInv::where('serial', $id)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                if ($Purchase == null) {
                    $flage = 1;
                    $Purchase = Order::where('serial', $id)
                        ->where('orgID', auth()->user()->orgID)
                        ->first();
                }
                if (empty($Purchase)) {
                    session()->flash('faild', 'تأكد من رقم الفاتورة ');
                    return redirect(url()->previous());
                }
            } catch (Exception $e) {
                session()->flash('faild', trans('Dadhoard.Displayerror'));
                return redirect()->back();
            }
            session()->put('page', 'orders');
            session()->put('sub-page', 'billsCred');
            if (auth()->user()->organization->activity == 2) {
                return view('admin.credorders.create')->with('Purchase', $Purchase)->with('flage', $flage);
            } else {
                return view('admin.credorders.createshop')->with('Purchase', $Purchase)->with('flage', $flage);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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

    public function checkCredorder(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json([
                'order' => Credorder::where('serial', $id)->get(),
                'status' => 200,
            ]);
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

    /**totalcredor
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //********* Insert Credorder ************************ */

        //  dd($request->all());
        try {
            $this->validate($request, [
                'customerID' => 'required',
                'serial' => 'required',
            ]);

            $year = date('Y');

            $bill = new Credorder();
            $bill->type = $request->type;
            if (empty($request->customerID)) {
                $customer = Customer::where('name', 'لا يوجد')
                    ->where('branchID', auth()->user()->branchID)
                    ->get();
                $customer = $customer->first();
                if (empty($customer)) {
                    $customer = new Customer();
                    $customer->name = 'لا يوجد';
                    $customer->status = 1;
                    $customer->userID = auth()->user()->id;
                    $customer->branchID = auth()->user()->branchID;
                    $customer->orgID = auth()->user()->orgID;
                    $customer->save();
                }
            } else {
                $customer = Customer::findorFail($request->customerID);
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

            $RoutAccount = VirtualAccounts::where('userID', '=', auth()->user()->id)->first();
            $bill->CostCenter = 0;
            $bill->salaseAccount = $RoutAccount->returnsale;

            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $RoutAccount->returnsale)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->debitSecond = $totals + $RPtData->debitSecond;
            $RPtData->save();

            $data = explode('::', $request->paymentTypeitems);
            $bill->nameAccount = $data[2];
            $bill->AccountID = $data[1];
            $acc = Accounting_guide::findorFail($data[0]);
            $RPtData = $acc->ReportData;
            $RPtData->creditSecond = $totals + $RPtData->creditSecond;
            $RPtData->save();
            $bill->save();

            //*********** Insert Bill details ************** */
            $br = Branch::findorFail(auth()->user()->branchID);
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Credorderdetails();
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
                    /*  **************** Stock ************ */

                    $vol = Volume::where('ProdectID', $request->input('item' . $i))->first();
                    if ($vol != null) {
                        foreach ($vol->VolumeDetail as $Items) {
                            $stock = new Stock();
                            $stock->productID = $request->input('item' . $i);
                            $stock->quantityIn = $request->input('quantity' . $i);
                            $stock->orderID = $bill->id;
                            $stock->comment = 'اشعار دائن - حذف من فاتورة';
                            $stock->userID = auth()->user()->id;
                            $stock->branchID = auth()->user()->branchID;
                            $stock->orgID = auth()->user()->orgID;
                            $stock->depotID = $br->DepotStore[0]->id;
                            $stock->kind = 8;
                            $stock->save();
                            UiteAllSellersub($request->input('item' . $i), $Items->Quantity * (float) $request->input('quantity' . $i), $br->DepotStore[0]->id);
                        }
                    } else {
                        $stock = new Stock();
                        $stock->productID = $request->input('item' . $i);
                        $stock->quantityIn = $request->input('quantity' . $i);
                        $stock->orderID = $bill->id;
                        $stock->comment = 'اشعار دائن - حذف من فاتورة';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 8;
                        $stock->save();
                        UiteAllSellersub($request->input('item' . $i), $request->input('quantity' . $i), $br->DepotStore[0]->id);
                    }
                    $vol = null;
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return redirect(route('credorders.show', $bill->id));
    }

    public function totalcredor()
    {
        try {
            $order = Credorder::all();
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
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
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
            $order = Credorder::findorFail($id);

            $qr = $this->getQr(auth()->user()->organization->nameAr, auth()->user()->organization->vatNo, $order->created_at, $order->totalwvat, $order->totalvat);
            // if(empty($order->customer->vatNo)){

            //     $page = "show-small";
            // }else{
            //     $page = "show";
            // }
            if (auth()->user()->organization->activity == 2) {
                return view('admin.credorders.show-small')->with('order', $order)->with('qr', $qr);
            } else {
                return view('admin.credorders.show-smallshop')->with('order', $order)->with('qr', $qr);
            }
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
            $order = Credorder::findorFail($id);
            return view('admin.credorders.edit')->with('order', $order);
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
            $order = Credorder::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);

            $order->nameAr = $request->nameAr;
            $order->nameEn = $request->nameEn;
            $order->quantity = $request->quantity;
            $order->orgID = auth()->user()->orgID;
            $order->userID = auth()->user()->id;
            $order->save();
            session()->flash('success', 'تم تحديث البيانات');
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في   اضافة مرتجع مبيعات');
            return redirect()->back();
        }

        return redirect(route('credorders.index'));
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
            $order = Credorder::findorFail($id);
            $order->status = 5;
            $order->save();
            session()->flash('success', 'تم حذف القسم بنجاح');
            return redirect(route('credorders.index'));
        } catch (Exception $e) {
            session()->flash('faild', 'خطا   في   اضافة مرتجع مبيعات');
            return redirect()->back();
        }
    }
}
