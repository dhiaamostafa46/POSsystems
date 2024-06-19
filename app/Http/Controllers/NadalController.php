<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\DepotStore;
use App\Models\extrasdetials;
use App\Models\Inv;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use App\Models\ReportData;
use App\Models\RoutAccount;
use App\Models\Stock;
use App\Models\Tbl;
use App\Models\Temporder;
use App\Models\Temporderdetails;
use App\Models\Treasury;
use App\Models\VirtualAccounts;
use App\Models\Volume;
use Exception;
use Illuminate\Http\Request;

class NadalController extends Controller
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
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'Nadalbllls');
            $bill = Order::where('userID', auth()->user()->id)
                ->where('nadel', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->get();

            return view('admin.nadal.index')->with('orders', $bill);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'NadalCreate');
            $tbls = Tbl::where('status', 1)
                ->where('branchID', auth()->user()->branchID)
                ->get();
            return view('admin.nadal.create')->with('table', $tbls);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function today()
    {
        //
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'Nadaltoday');
            $bill = Order::where('branchID', auth()->user()->branchID)
                ->where('type', 3)
                ->orderBy('id', 'desc')
                ->get();
            return view('admin.nadal.today')->with('orders', $bill);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //********* Insert Order ************************ */
        try {
            $RoutAccount = RoutAccount::where('userID', '=', auth()->user()->id)->first();
            $count = Customer::all()->count();
            $customer = Customer::where('name', 'عميل افتراضي')
                ->where('branchID', auth()->user()->branchID)
                ->get();
            $customer = $customer->first();
            if (empty($customer)) {
                $yu = Accounting_guide::where('SourceID', '=', '124')
                    ->where('orgID', auth()->user()->orgID)
                    ->count();
                $customer = new Customer();
                $customer->name = 'عميل افتراضي ';
                $customer->status = 1;
                $customer->userID = auth()->user()->id;
                $customer->branchID = auth()->user()->branchID;
                $customer->orgID = auth()->user()->orgID;
                $customer->AccountID = $RoutAccount->Customers . '00' . $yu + 1;
                $customer->save();

                $sum = $yu + 1;
                $AccountingGuide = new Accounting_guide();
                $AccountingGuide->AccountID = '12400' . $sum;
                $AccountingGuide->AccountName = 'عميل افتراضي ';
                $AccountingGuide->AccountNameEn = 'العملاء';
                $AccountingGuide->type = 'العملاء';
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 1;
                $AccountingGuide->Account_status = 1;
                $AccountingGuide->SourceID = '124';
                $AccountingGuide->typeProcsss = 0;
                $AccountingGuide->orgID = auth()->user()->orgID;
                $AccountingGuide->save();
                $ReportData = new ReportData();
                $ReportData->orgID = auth()->user()->orgID;
                $ReportData->debitFrist = 0;
                $ReportData->creditFrist = 0;
                $ReportData->debitSecond = 0;
                $ReportData->creditSecond = 0;
                $ReportData->debitThird = 0;
                $ReportData->creditThird = 0;
                $ReportData->AccountID = $AccountingGuide->id;
                $ReportData->save();
            }

            $bill = new order();
            $bill->customerID = $customer->id;
            $bill->type = $request->type;
            $bill->orderType = $request->orderType;
            $bill->ordBy = $request->orderType;
            $bill->tblNo = $request->tblNo;
            $bill->discount = 0;
            $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->totaldis = $request->totalwvat;
            $bill->userID = auth()->user()->id;
            $bill->branchID = auth()->user()->branchID;
            $bill->orgID = auth()->user()->orgID;
            $bill->status = 1;
            $bill->kind = 1;
            $bill->nadel = auth()->user()->id;
            if ($request->type == 3) {
                $bill->TypeInv = 1;
            } else {
                $bill->TypeInv = 2;
            }
            $bill->save();

            //*********** Insert Bill details ************** */

            $count = $request->count;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $billdetails = new Orderdetails();
                    $billdetails->orderID = $bill->id;
                    $billdetails->productID = $request->input('item' . $i);
                    $billdetails->kitchenID = $request->input('kitchenID' . $i);
                    $billdetails->productName = $request->input('itemName' . $i);
                    $billdetails->quantity = $request->input('quantity' . $i);
                    $billdetails->price = $request->input('price' . $i);
                    $billdetails->discount = $request->input('discount' . $i);
                    $billdetails->total = $request->input('price' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                    $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                    $billdetails->userID = auth()->user()->id;
                    $billdetails->branchID = auth()->user()->branchID;
                    $billdetails->orgID = auth()->user()->orgID;
                    $billdetails->Extracount = $request->input('Exitetcount' . $i);
                    $billdetails->Extratotal = $request->input('Exitetprice' . $i);
                    $billdetails->kind = 1;
                    $billdetails->save();

                    if ($request->input('Exitetcount' . $i) != 0) {
                        $countExtra = (int) $request->input('Exitetcount' . $i);
                        for ($im = 1; $im <= $countExtra; $im++) {
                            $extra = new extrasdetials();
                            $extra->userID = auth()->user()->id;
                            $extra->orgID = auth()->user()->orgID;
                            $extra->productID = $request->input('extraitem' . $i . '-' . $im);
                            $extra->nameAr = $request->input('extraname' . $i . '-' . $im);
                            $extra->price = $request->input('extrapriceItems' . $i . '-' . $im);
                            $extra->IDorder = $billdetails->id;
                            $extra->quantity = $request->input('quantity' . $i . '-' . $im);
                            $extra->save();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return redirect(route('Nadal.create'));
    }

    public function updatenadel(Request $request, string $id)
    {
         try{

        if ($request->totalwvat != $request->totalwvatold) {
            // dd( $request->all());
            $bill = Order::findorFail($id);
            $bill->totalvat = $request->vat;
            $bill->totalwvat = $request->totalwvat;
            $bill->totaldis = $request->totalwvat;
            $bill->status = 1;
            $bill->save();

            $count = $request->count;
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('flagcode' . $i) == 1) {
                    foreach ($bill->orderdetails as $index => $items) {
                        if ($request->input('itemcode' . $i) == $items->productID && $items->quantity != $request->input('quantity' . $i)) {
                            $items->nadel = $items->quantity - $request->input('quantity' . $i);
                            $items->quantity = $request->input('quantity' . $i);
                            $items->total = $request->input('price' . $i) * $request->input('quantity' . $i);
                            $items->save();
                        }
                    }
                } else {
                    if ($request->input('item' . $i)) {
                        $billdetails = new Orderdetails();
                        $billdetails->orderID = $bill->id;
                        $billdetails->productID = $request->input('item' . $i);
                        $billdetails->kitchenID = $request->input('kitchenID' . $i);
                        $billdetails->productName = $request->input('itemName' . $i);
                        $billdetails->quantity = $request->input('quantity' . $i);
                        $billdetails->price = $request->input('price' . $i);
                        $billdetails->discount = $request->input('discount' . $i);
                        $billdetails->total = $request->input('price' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                        $billdetails->totalcost = $request->input('cprice' . $i) * $request->input('quantity' . $i) - $request->input('discount' . $i);
                        $billdetails->userID = auth()->user()->id;
                        $billdetails->branchID = auth()->user()->branchID;
                        $billdetails->orgID = auth()->user()->orgID;
                        $billdetails->Extracount = $request->input('Exitetcount' . $i);
                        $billdetails->Extratotal = $request->input('Exitetprice' . $i);
                        $billdetails->kind = 1;
                        $billdetails->save();
                    }
                }
            }
        }

        }
        catch(Exception $e)
        {

            session()->flash('faild',    trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }

        return redirect(route('Nadal.index'));
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            session()->put('page', 'orders');
            session()->put('sub-page', 'Nadalbllls');
            $bill = Order::findorFail($id);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.nadal.show')->with('orders', $bill);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $tbls = Tbl::where('status', 1)
                ->where('branchID', auth()->user()->branchID)
                ->get();
            session()->put('page', 'orders');
            session()->put('sub-page', 'Nadalbllls');
            $bill = Order::findorFail($id);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
        return view('admin.nadal.edit')->with('orders', $bill)->with('table', $tbls);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update($id, string $type)
    {
        //********* Insert Order ************************ */
        try {
            $year = date('Y');

            $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
            if ($Inv == null) {
                $Inv = new Inv();
                $Inv->Inv = '1';
                $Inv->orgID = auth()->user()->orgID;
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

            $bill = Order::findorFail($id);

            //-----------------------------------------------------------------------------------------------------------------
            $Vir = VirtualAccounts::where('userID', '=', auth()->user()->id)
                ->where('orgID', auth()->user()->orgID)
                ->first();
            $bill->salaseAccount = $Vir->sale;
            $bill->CostCenter = $Vir->costcenter;
            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $Vir->sale)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->creditSecond = $bill->totalwvat + $RPtData->creditSecond;
            $RPtData->save();

            $bill->NameAcount = 'نافذة بيع';
            $bill->AccountID = $Vir->treasury;
            $acc = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('AccountID', '=', $Vir->treasury)
                ->first();
            $RPtData = $acc->ReportData;
            $RPtData->debitSecond = $bill->totalwvat + $RPtData->debitSecond;
            $RPtData->save();
            //-------------------------------------------------------------------------------------------------------------------
            $bill->serial = $bill_num;
            $bill->type = $type;
            $bill->durationID = auth()->user()->branch->durations->first()->durationNo;
            $bill->ordBy = auth()->user()->id;
            $bill->status = 2;
            $bill->kind = 2;
            $bill->nadel = null;
            if ($type == 3) {
                $bill->TypeInv = 1;
            } else {
                $bill->TypeInv = 2;
            }
            $bill->save();

            //*********** Insert Bill details ************** */
            //*********** Insert Bill details ************** */
            //*********** Insert Bill details ************** */
            //*********** Insert Bill details ************** */

            $br = Branch::findorFail(auth()->user()->branchID);
            foreach ($bill->orderdetails as $itmes) {
                $itmes->kind = 2;
                $itmes->save();

                if (count($itmes->extrasdetials) > 0) {
                    foreach ($itmes->extrasdetials as $extra) {
                        $stock = new Stock();
                        $stock->productID = $extra->productID;
                        $stock->quantityOut = $extra->quantity;
                        $stock->orderID = $bill->id;
                        $stock->comment = 'نافذة مبيعات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 7;
                        $stock->save();
                        UiteAllSeller($extra->productID, $extra->quantity, $br->DepotStore[0]->id);
                    }
                }

                $vol = Volume::where('ProdectID', $itmes->productID)->first();
                //    $vol = $billdetails->product->Volume->VolumeDetail;
                if ($vol != null) {
                    foreach ($vol->VolumeDetail as $Items) {
                        $stock = new Stock();
                        $stock->productID = $Items->ProdectId;
                        $stock->quantityOut = $Items->Quantity * (float) $itmes->quantity;
                        $stock->orderID = $bill->id;
                        $stock->comment = 'نافذة مبيعات';
                        $stock->userID = auth()->user()->id;
                        $stock->branchID = auth()->user()->branchID;
                        $stock->orgID = auth()->user()->orgID;
                        $stock->depotID = $br->DepotStore[0]->id;
                        $stock->kind = 7;
                        $stock->save();
                        UiteAllSeller($Items->ProdectId, $Items->Quantity * (float) $itmes->quantity, $br->DepotStore[0]->id);
                    }
                } else {
                    $stock = new Stock();
                    $stock->productID = $itmes->productID;
                    $stock->quantityOut = $itmes->quantity;
                    $stock->orderID = $bill->id;
                    $stock->comment = 'نافذة مبيعات';
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->depotID = $br->DepotStore[0]->id;
                    $stock->kind = 7;
                    $stock->save();
                    UiteAllSeller($itmes->productID, $itmes->quantity, $br->DepotStore[0]->id);
                }
                $vol = null;
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        return redirect(route('orders.show', $bill->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $Temporder = Order::findorFail($id);
            $Temporder->kind = 3;
            $Temporder->save();
            foreach ($Temporder->orderdetails as $itens) {
                $itens->nadel = 12;
                $itens->save();
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Errorupdating'));
            return redirect()->back();
        }
        return back();
    }
}
