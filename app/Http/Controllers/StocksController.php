<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Stockinout;
use App\Models\Stockinoutdetails;
use Exception;

class StocksController extends Controller
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
            session()->put('page', 'products');
            session()->put('sub-page', 'itemsStock');
            $products = Product::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.stocks.index')->with('products', $products);
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
            return view('admin.stocks.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function drop()
    {
        try {
            return view('admin.stocks.drop');
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
            //********* Insert Stockinout ************************ */
            $stockinout = new Stockinout();
            $stockinout->comment = $request->comment;
            $stockinout->type = $request->type;
            $stockinout->userID = auth()->user()->id;
            $stockinout->branchID = auth()->user()->branchID;
            $stockinout->orgID = auth()->user()->orgID;
            $stockinout->status = 1;
            $stockinout->save();

            //*********** Insert Bill details ************** */
            $count = $request->count;

            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $stockinoutdetails = new Stockinoutdetails();
                    $stockinoutdetails->stockinoutID = $stockinout->id;
                    $stockinoutdetails->productID = $request->input('item' . $i);
                    $stockinoutdetails->quantity = $request->input('quantity' . $i);
                    $stockinoutdetails->userID = auth()->user()->id;
                    $stockinoutdetails->branchID = auth()->user()->branchID;
                    $stockinoutdetails->orgID = auth()->user()->orgID;
                    $stockinoutdetails->save();
                    /***************** Stock ************ */
                    $stock = new Stock();
                    $stock->productID = $request->input('item' . $i);
                    if ($request->type == 1) {
                        $stock->quantityIn = $request->input('quantity' . $i);
                        $stock->comment = 'اضافة للمخزون - ' . $request->comment;
                    } else {
                        $stock->quantityOut = $request->input('quantity' . $i);
                        $stock->comment = 'سحب من المخزون - ' . $request->comment;
                    }
                    $stock->stockinoutID = $stockinout->id;

                    $stock->userID = auth()->user()->id;
                    $stock->branchID = auth()->user()->branchID;
                    $stock->orgID = auth()->user()->orgID;
                    $stock->save();
                }
            }
            return redirect(route('stocks.index'));
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
            $product = Product::findorFail($id);
            return view('admin.stocks.show')->with('product', $product);
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
            $stock = Stock::findorFail($id);
            return view('admin.stocks.edit')->with('stock', $stock);
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
            $stock = Stock::findorFail($id);
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
                $path = $request->file('img')->move(public_path('../dist/img/stocks'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $stock->img = $fileNametoStore;
            } else {
                $stock->img = 'default.jpg';
            }
            $stock->nameAr = $request->nameAr;
            $stock->nameEn = $request->nameEn;
            $stock->costPrice = $request->costPrice;
            $stock->prodPrice = $request->prodPrice;
            $stock->vat = $request->vat;
            $stock->isParent = $request->isParent;
            $stock->parentID = $request->parentID;
            $stock->categoryID = $request->categoryID;
            $stock->barcode = $request->barcode;
            $stock->sFrom = $request->sFrom;
            $stock->sTo = $request->sTo;
            $stock->unitID = $request->unitID;
            $stock->orgID = auth()->user()->orgID;
            $stock->userID = auth()->user()->id;
            $stock->save();
            session()->flash('success', 'تم تحديث البيانات');

            return redirect(route('stocks.index'));
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
            $stock = Stock::findorFail($id);

            //then Delete Stock
            $stock->status = 5;
            $stock->save();
            session()->flash('success', 'تم حذف المستخدم');
            return redirect(route('stocks.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
