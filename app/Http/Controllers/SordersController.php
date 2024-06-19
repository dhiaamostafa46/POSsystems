<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Sorder;
use App\Models\Sorderdetails;
use Exception;

class SordersController extends Controller
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
            session()->put('page', 'reports');
            session()->put('sub-page', 'receiveItemsReport');
            $sorders = Sorder::where('orgID', auth()->user()->orgID)
                ->where('created_at', '>=', session('dateFrom'))
                ->where('created_at', '<', session('dateTo'))
                ->get();
            return view('admin.sorders.index')->with('sorders', $sorders);
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
        try {
            session()->put('page', 'sorders');
            return view('admin.sorders.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
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
            //********* Insert Sorder ************************ */
            $sorder = new Sorder();
            $sorder->comment = $request->comment;
            $sorder->reciever = $request->reciever;
            $sorder->deliver = $request->deliver;
            $sorder->recieverPhone = $request->recieverPhone;
            $sorder->type = $request->type;
            $sorder->userID = auth()->user()->id;
            $sorder->branchID = auth()->user()->branchID;
            $sorder->orgID = auth()->user()->orgID;
            $sorder->status = 1;
            $sorder->save();

            $purchase = Purchase::findorFail($request->purchaseID);
            $purchase->status = 2;
            $purchase->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $sorderdetails = new Sorderdetails();
                    $sorderdetails->sorderID = $sorder->id;
                    $sorderdetails->productID = $request->input('item' . $i);
                    $sorderdetails->quantity = $request->input('quantity' . $i);
                    $sorderdetails->userID = auth()->user()->id;
                    $sorderdetails->branchID = auth()->user()->branchID;
                    $sorderdetails->orgID = auth()->user()->orgID;
                    $sorderdetails->save();

                    /************************* Stock ******************** */

                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    $stock->quantityIn = $request->input('quantity' . $i);
                    $stock->purchaseID = $request->purchaseID;
                    $stock->comment = 'فاتورة مشتريات رقم ' . $request->serial;
                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->save();
                }
            }
            session()->flash('success', 'تم تحديث البيانات');
            return redirect(route('purchases.index'));
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
    public function show($id)
    {
        try {
            $sorder = Sorder::findorFail($id);
            return view('admin.sorders.show')->with('sorder', $sorder);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function confirm($id)
    {
        try {
            $sorder = Sorder::findorFail($id);
            $sorder->status = 2;
            $sorder->approveID = auth()->user()->id;
            $sorder->save();
            return redirect(route('sorders.show', $sorder->id));
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
            $sorder = Sorder::findorFail($id);
            $sorder->status = 1;
            return view('admin.sorders.edit')->with('sorder', $sorder);
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
            $sorder = Sorder::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required',
                'costPrice' => 'required',
                'prodPrice' => 'required',
                'vat' => 'required',
                'isParent' => 'required',
                'categoryID' => 'required',
                'barcode' => 'required',
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
                $path = $request->file('img')->move(public_path('../dist/img/sorders'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $sorder->img = $fileNametoStore;
            } else {
                $sorder->img = 'default.jpg';
            }
            $sorder->nameAr = $request->nameAr;
            $sorder->nameEn = $request->nameEn;
            $sorder->costPrice = $request->costPrice;
            $sorder->prodPrice = $request->prodPrice;
            $sorder->vat = $request->vat;
            $sorder->isParent = $request->isParent;
            $sorder->parentID = $request->parentID;
            $sorder->categoryID = $request->categoryID;
            $sorder->barcode = $request->barcode;
            $sorder->sFrom = $request->sFrom;
            $sorder->sTo = $request->sTo;
            $sorder->unitID = $request->unitID;
            $sorder->orgID = auth()->user()->orgID;
            $sorder->userID = auth()->user()->id;
            $sorder->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('sorders.index'));
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
            $sorder = Sorder::findorFail($id);

            //then Delete Sorder
            $sorder->status = 5;
            $sorder->save();
            session()->flash('success', 'تم حذف المستخدم');
            return redirect(route('sorders.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
