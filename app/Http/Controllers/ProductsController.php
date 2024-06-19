<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\Extra;
use App\Models\Inv;
use App\Models\OfferPricedetails;
use App\Models\Orderdetails;
use App\Models\OrderinvDetails;
use App\Models\ProdUnit;
use App\Models\Purchasedetails;
use App\Models\Stock;
use App\Models\Volume;
use App\Models\VolumeDetail;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function GetExportprodect()
    {
        try {
            return Excel::download(new ProductExport(), 'Product.xlsx');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function GetImportprodect(Request $request)
    {
        try {
            Excel::import(new ProductImport(), request()->file('file'));
            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function extrasStore(Request $request)
    {
        //    dd($request->all());
        try {
            $product = Product::findorFail($request->idpeodect);
            $count = $request->count;
            $sum = 0;
            $product->extras()->delete();
            for ($i = 1; $i <= $count; $i++) {
                if ($request->input('item' . $i)) {
                    $extra = new Extra();
                    $extra->nameAr = $request->input('nameitems' . $i);
                    $extra->nameEn = $request->input('nameitems' . $i);
                    $extra->price = $request->input('price' . $i);
                    $extra->nameUnit = $request->input('unit' . $i);
                    $extra->idUnit = $request->input('idunit' . $i);
                    $extra->items = $request->input('item' . $i);
                    $extra->productID = $product->id;
                    $extra->orgID = auth()->user()->orgID;
                    $extra->userID = auth()->user()->id;
                    $extra->save();
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        return redirect(route('products.index'));
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
            session()->put('sub-page', 'productsList');
            if (auth()->user()->organization->activity == 2) {
                $products = Product::where('status', '!=', 5)
                    ->where('orgID', auth()->user()->orgID)
                    ->Orderby('id', 'DESC')
                    ->get();
            } else {
                $products = Product::where('orgID', auth()->user()->orgID)
                    ->Orderby('id', 'DESC')
                    ->get();
            }
            return view('admin.products.index')->with('products', $products);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function productsCopy($id)
    {
        try {
            $products = Product::findOrFail($id);
            $copy = new Product();
            $copy->orgID = auth()->user()->orgID;
            $copy->userID = auth()->user()->id;
            $copy->categoryID = $products->categoryID;
            $copy->kitchenID = $products->kitchenID;
            $copy->unitID = $products->unitID;
            $copy->barcodeType = $products->barcodeType;
            $copy->nameAr = $products->nameAr;
            $copy->nameEn = $products->nameEn;
            $copy->detailsAr = $products->detailsAr;
            $copy->detailsEn = $products->detailsEn;
            $copy->calories = $products->calories;
            $copy->costPrice = $products->costPrice;
            $copy->prodPrice = $products->prodPrice;
            $copy->vat = $products->vat;
            $copy->isParent = $products->isParent;
            $copy->parentID = $products->parentID;
            $copy->sFrom = $products->sFrom;
            $copy->sTo = $products->sTo;
            $copy->img = $products->img;
            $copy->status = $products->status;

            $copy->TypeProdect = $products->TypeProdect;
            $copy->count = $products->count;
            $copy->costprodect = $products->costprodect;
            $copy->saleable = $products->saleable;
            $copy->saleCat = $products->saleCat;
            $copy->saleUnit = $products->saleUnit;
            $copy->purhaseUnit = $products->purhaseUnit;
            $copy->reportUnit = $products->reportUnit;
            $copy->componUnit = $products->componUnit;

            $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
            if ($Inv == null) {
                $Inv = new Inv();
                $Inv->Inv = '1';
                $Inv->proud = '1';
                $Inv->orgID = auth()->user()->orgID;
                $Inv->save();
            } else {
                $Inv->proud = $Inv->proud + 1;
                $Inv->save();
            }
            if (strlen($Inv->proud) == 1) {
                $bill_num = '5000' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 2) {
                $bill_num = '500' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 3) {
                $bill_num = '50' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 4) {
                $bill_num = '5' . $Inv->proud;
            }

            $copy->barcode = $bill_num;

            $copy->save();

            if (count($products->unitprodect) > 0) {
                foreach ($products->unitprodect as $itmes) {
                    $punit = new ProdUnit();
                    $punit->prodID = $copy->id;
                    $punit->unitID = $itmes->unitID;
                    $punit->quantity = $itmes->quantity;
                    $punit->price = $itmes->price;
                    $punit->sales = $itmes->sales;
                    $punit->purchase = $itmes->purchase;
                    $punit->report = $itmes->report;
                    $punit->compon = $itmes->compon;
                    $punit->compon = $itmes->compon;
                    $punit->costprodect = $itmes->price;
                    $punit->unitname = $itmes->unitname;
                    $punit->orgID = $itmes->orgID;
                    $punit->StoreId = $itmes->StoreId;
                    $punit->save();
                }
            }

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect()->route('products.index');
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
            if (auth()->user()->organization->activity == 2) {
                $products = Product::where('status', '!=', 5)
                    ->where('TypeProdect', 2)
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                return view('admin.products.newCreate')->with('purProducts', $products);
            } else {
                return view('admin.products.create');
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function getBarcode(Request $request, $id)
    {
        $items = Product::where('barcode', $id)
            ->where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->take(1)
            ->get();

        if ($items != null) {
            $br = Branch::findorFail(auth()->user()->branchID);
            $unit = ProdUnit::where('prodID', $items[0]->id)
                ->where('StoreId', $br->DepotStore[0]->id)
                ->orderBy('id', 'DESC')
                ->first();
        } else {
            return response()->json([
                'items' => 1,
                'quantity' => 1,
                'unit' => 1,
                'flage' => 0,
                'idunit' => 0,
            ]);
        }

        $quantity = 1;
        if (count($items) == 0) {
            ///to get mizan parcode
            $code = substr($id, 2, 5);
            $items = Product::where('barcode', $code)
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->take(1)
                ->get();
            if (count($items) > 0) {
                ///to get mizan quantity
                $quantity = number_format(substr($id, 7, 6) / 1000 / $items->first()->prodPrice, 2);
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'items' => $items,
                'quantity' => $quantity,
                'unit' => $unit->unitname,
                'idunit' => $unit->costprodect,
                'flage' => 1,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function extrasindex($id)
    {
        try {
            session()->put('page', 'products');
            session()->put('sub-page', 'Volume');
            try {
                $items_all = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                $items = Product::where('status', '1')
                    ->where('orgID', auth()->user()->orgID)
                    ->pluck('nameAr');
                $product = Product::findorFail($id);
            } catch (Exception $e) {
                session()->flash('faild', trans('Dadhoard.Displayerror'));
                return redirect()->back();
            }

            return view('admin.products.extras')->with('Products', $product)->with('items', $items)->with('items_all', $items_all);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function StoreProdect(Request $request)
    {
        try {
            // dd($request->all());
            $product = new Product();
            $this->validate($request, [
                'nameAr' => 'required',
                'costPrice' => 'required',
                'prodPrice' => 'required',
                'vat' => 'required',
                'categoryID' => 'required',
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
                $path = $request->file('img')->move(public_path('dist/img/products'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $product->img = $fileNametoStore;
            } else {
                $product->img = 'default.jpg';
            }
            $product->nameAr = $request->nameAr;
            $product->TypeProdect = $request->TypePrdectAll;
            $product->nameEn = $request->nameEn;
            $product->categoryID = $request->categoryID;
            $product->costPrice = $request->costPrice;
            $product->prodPrice = $request->prodPrice;
            $product->vat = $request->vat;
            $product->orgID = auth()->user()->orgID;
            $product->userID = auth()->user()->id;
            $data = explode('::', $request->unitID);
            $product->unitID = $data[0];
            $product->isParent = $request->vatQuest;

            if (!empty($request->barcode)) {
                // TypePrdectAll
                $product->barcode = $request->barcode;
            } else {
                $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
                if ($Inv == null) {
                    $Inv = new Inv();
                    $Inv->Inv = '1';
                    $Inv->proud = '1';
                    $Inv->orgID = auth()->user()->orgID;
                    $Inv->save();
                } else {
                    $Inv->proud = $Inv->proud + 1;
                    $Inv->save();
                }
                if (strlen($Inv->proud) == 1) {
                    $bill_num = '5000' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 2) {
                    $bill_num = '500' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 3) {
                    $bill_num = '50' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 4) {
                    $bill_num = '5' . $Inv->proud;
                }

                $product->barcode = $bill_num;
                $product->barcodeType = 2;
            }
            if (!$request->vatQuest == 1) {
                //  $product->costPrice =  $request->costPrice * 1.15;
                $product->prodPrice = $request->prodPrice;
            }

            $product->save();

            $br = Branch::findorFail(auth()->user()->branchID);
            for ($i = 0; $i < 3; $i++) {
                $prunit = 'prunit' . $i;
                $uitQuantity = 'uitQuantity' . $i;
                $prodprice = 'pprice' . $i;

                $sales = 'sales' . $i;
                $purchase = 'purchase' . $i;
                $report = 'report' . $i;
                $compon = 'compon' . $i;

                if ($request->$prunit != null && $request->$uitQuantity != null) {
                    $punit = new ProdUnit();
                    $data = explode('::', $request->$prunit);
                    $punit->prodID = $product->id;
                    $punit->unitID = $data[0];
                    $punit->unitname = $data[1];
                    $punit->quantity = $request->$uitQuantity;
                    $punit->price = $request->$prodprice;
                    if ($request->$sales) {
                        $punit->sales = 1;
                        $product->saleUnit = $request->$prunit;
                    }
                    if ($request->$purchase) {
                        $punit->purchase = 1;
                        $product->purhaseUnit = $request->$prunit;
                    }
                    if ($request->$report) {
                        $punit->report = 1;
                        $product->reportUnit = $request->$prunit;
                    }
                    if ($request->$compon) {
                        $punit->compon = 1;
                        $product->componUnit = $request->$prunit;
                    }

                    $product->save();
                    $punit->count = 0;
                    $punit->costprodect = $request->$prodprice;
                    $punit->saller = 0;
                    $punit->countSaller = 0;
                    $punit->orgID = auth()->user()->orgID;
                    $punit->StoreId = $br->DepotStore[0]->id;

                    $punit->save();
                }
            }
            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('products.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function UpdateProdect(Request $request, $id)
    {
        try {
            // dd($request->all());
            $product = Product::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required',
                'costPrice' => 'required',
                'prodPrice' => 'required',
                'vat' => 'required',
                'categoryID' => 'required',
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
                $path = $request->file('img')->move(public_path('dist/img/products'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $product->img = $fileNametoStore;
            } else {
                $product->img = 'default.jpg';
            }
            $product->nameAr = $request->nameAr;
            $product->nameEn = $request->nameEn;
            $product->categoryID = $request->categoryID;
            $product->costPrice = $request->costPrice;
            $product->TypeProdect = $request->TypePrdectAll;
            $product->prodPrice = $request->prodPrice;
            $product->vat = $request->vat;
            $product->isParent = $request->vatQuest;

            $data = explode('::', $request->unitID);
            $product->unitID = $data[0];

            if (!empty($request->barcode)) {
                // TypePrdectAll
                $product->barcode = $request->barcode;
            } else {
                $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
                if ($Inv == null) {
                    $Inv = new Inv();
                    $Inv->Inv = '1';
                    $Inv->proud = '1';
                    $Inv->orgID = auth()->user()->orgID;
                    $Inv->save();
                } else {
                    $Inv->proud = $Inv->proud + 1;
                    $Inv->save();
                }
                if (strlen($Inv->proud) == 1) {
                    $bill_num = '50000' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 2) {
                    $bill_num = '5000' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 3) {
                    $bill_num = '500' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 4) {
                    $bill_num = '50' . $Inv->proud;
                }
                if (strlen($Inv->proud) == 5) {
                    $bill_num = '5' . $Inv->proud;
                }
                $product->barcode = $bill_num;
                $product->barcodeType = 2;
            }
            if (!$request->vatQuest == 1) {
                //  $product->costPrice =  $request->costPrice * 1.15;
                $product->prodPrice = $request->prodPrice;
            }
            $product->save();

            $countAll = (int) $request->countUnit;
            $count = 0;
            foreach ($product->unitprodect as $items) {
                $prunit = 'prunit' . $count;
                $uitQuantity = 'uitQuantity' . $count;
                $prodprice = 'pprice' . $count;
                $data = explode('::', $request->$prunit);
                $items->unitID = $data[0];
                $items->unitname = $data[1];
                $items->quantity = $request->$uitQuantity;
                $items->price = $request->$prodprice;
                $count++;
                $items->save();
                if ($count == $countAll) {
                    $count = 0;
                }
            }

            for ($i = (int) $request->countunitOld; $i < 3; $i++) {
                $prunit = 'prunit' . $i;
                $uitQuantity = 'uitQuantity' . $i;
                $prodprice = 'pprice' . $i;
                $sales = 'sales' . $i;
                $purchase = 'purchase' . $i;
                $report = 'report' . $i;
                $compon = 'compon' . $i;

                if ($request->$prunit != null && $request->$uitQuantity != null) {
                    foreach (auth()->user()->organization->DepotStore as $items) {
                        $punit = new ProdUnit();
                        $data = explode('::', $request->$prunit);
                        $punit->prodID = $product->id;
                        $punit->unitID = $data[0];
                        $punit->unitname = $data[1];
                        $punit->quantity = $request->$uitQuantity;
                        $punit->price = $request->$prodprice;
                        $punit->count = 0;
                        $punit->costprodect = $request->$prodprice;
                        $punit->saller = 0;
                        $punit->countSaller = 0;
                        $punit->orgID = auth()->user()->orgID;
                        $punit->StoreId = $items->id;
                        $punit->save();
                    }
                }
            }

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('products.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    //  public function StoreProdect(Request $request)
    //  {

    //     // $validator = \Validator::make($request->all(), [
    //     //     'nameAr' => 'required|unique:App\Models\Product,nameAr',
    //     //     'nameEn' => 'required|unique:App\Models\Product,nameEn',
    //     //     'categoryID' => 'required',
    //     //     'prodPrice' => 'required',
    //     //     'unitID' => 'required',

    //     // ],$messages = [
    //     //     'required' => 'الرجاء عدم ترك الحقل فارغ',
    //     //     'nameAr.unique' => 'الإسم موجود مسبقا',
    //     //     'categoryID.required' => 'الرجاءإختيار القسم   ',
    //     //     'unitID.required' => 'الرجاءإختيار الوحدة',])->validate();

    //     dd($request->all());
    //     $product = new Product();
    //     $product->nameAr = $request->nameAr;
    //     $product->nameEn = $request->nameEn;
    //     if(!empty($request->barcode)){

    //         $product->barcode = $request->barcode;
    //      }else{
    //         $product->barcodeType = 2;
    //         $lastProduct = Product::where('status','==',1)->where('orgID',auth()->user()->orgID)->orderBy('id','desc')->first();
    //         if(!empty($lastProduct))  {
    //             $product->barcode = $lastProduct->barcode + 1;
    //         } else{
    //             $product->barcode = 50001;
    //         }
    //     }

    //  }

    public function store(Request $request)
    {
        try {
            //dd($request);
            // dd($request->all());
            $xx = 0;
            for ($i = 0; $i < 3; $i++) {
                $compon = 'compon' . $i;
                if ($request->$compon) {
                    $xx = 5;
                }
            }

            $product = new Product();
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
                $path = $request->file('img')->move(public_path('/dist/img/products'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $product->img = $fileNametoStore;
            } else {
                $product->img = 'default.jpg';
            }

            if (!empty($request->barcode) && $request->barcode != null) {
                $product->barcode = $request->barcode;
            } else {
                $product->barcodeType = 2;
                $lastProduct = Product::where('barcodeType', 2)
                    ->where('status', '!=', 5)
                    ->where('orgID', auth()->user()->orgID)
                    ->orderBy('id', 'desc')
                    ->first();
                if (!empty($lastProduct)) {
                    $product->barcode = $lastProduct->barcode + 1;
                } else {
                    $product->barcode = 50001;
                }
            }

            if ($request->TypeProdect == 1) {
                //dd($request);
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'nameAr' => 'required',
                        'nameEn' => 'required',
                        'categoryID' => 'required',
                        'kitchenID' => 'required',
                        'prodPrice' => 'required',
                        'unitID' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',
                        'nameAr.unique' => 'الإسم موجود مسبقا',
                        'categoryID.required' => 'الرجاءإختيار القسم   ',
                        'kitchenID.required' => 'الرجاءإختيار المطبخ',
                        'unitID.required' => 'الرجاءإختيار الوحدة',
                    ],
                )->validate();

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameAr', $request->nameAr)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameEn', $request->nameEn)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }
                //'compon1' => Rule::present_if($request->TypeProdect == 2),
                //'compon0' => 'present',
                $product->nameAr = $request->nameAr;
                $product->nameEn = $request->nameEn;
                $product->detailsAr = $request->detailsAr;
                $product->detailsEn = $request->detailsEn;
                $product->calories = $request->calories;

                $product->costPrice = $request->costPrice;
                $product->prodPrice = $request->prodPrice;
                if (!$request->vatQuest) {
                    //  $product->costPrice =  $request->costPrice * 1.15;
                    $product->prodPrice = $request->prodPrice * 1.15;
                }
                $product->vat = $request->vat;

                $product->categoryID = $request->categoryID;
                $product->kitchenID = $request->kitchenID;
                $product->sFrom = $request->sFrom;
                $product->sTo = $request->sTo;
                $product->orgID = auth()->user()->orgID;
                $product->userID = auth()->user()->id;
                //$product->unitID = $request->unitID;
                $product->TypeProdect = $request->TypeProdect;
            } elseif ($request->TypeProdect == 2) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'ppnameAr' => 'required',
                        'ppnameEn' => 'required',

                        'ppcategoryID' => 'required',
                        'ppunitID' => 'required',
                        'ppcostPrice' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',
                        'ppnameAr.unique' => 'الإسم موجود مسبقا',

                        'ppcategoryID.required' => 'الرجاءإختيار القسم   ',
                        'ppunitID.required' => 'الرجاءإختيار الوحدة',
                    ],
                )->validate();

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameAr', $request->ppnameAr)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameEn', $request->ppnameEn)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }

                $product->nameAr = $request->ppnameAr;
                $product->nameEn = $request->ppnameEn;

                $product->calories = $request->ppcalories;

                $product->costPrice = $request->ppcostPrice;
                $product->prodPrice = $request->ppprodPrice;
                if (!$request->ppvatQuest) {
                    $product->costPrice = $request->ppcostPrice * 1.15;
                    if ($request->saleable == 1) {
                        $product->prodPrice = $request->ppprodPrice * 1.15;
                    }
                }

                //dd($product);

                $product->vat = $request->ppvat;

                $product->categoryID = $request->ppcategoryID;
                $product->kitchenID = $request->ppkitchenID;

                $product->sFrom = $request->ppsFrom;
                $product->sTo = $request->ppsTo;

                $product->orgID = auth()->user()->orgID;
                $product->userID = auth()->user()->id;
                $product->unitID = $request->ppunitID;
                $product->TypeProdect = $request->TypeProdect;

                if ($request->saleable == 1) {
                    $product->saleCat = $request->ppscategoryID;
                    $product->saleable = $request->saleable;
                }

                if (!empty($request->barcode)) {
                    $product->barcode = $request->barcode;
                } else {
                    $product->barcodeType = 2;
                    $lastProduct = Product::where('barcodeType', 2)
                        ->where('status', '!=', 5)
                        ->where('orgID', auth()->user()->orgID)
                        ->orderBy('id', 'desc')
                        ->first();
                    if (!empty($lastProduct)) {
                        $product->barcode = $lastProduct->barcode + 1;
                    } else {
                        $product->barcode = 50001;
                    }
                }
            } elseif ($request->TypeProdect == 3) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'ttnameAr' => 'required',
                        'ttnameEn' => 'required',
                        'tttcategoryID' => 'required',
                        'tunitID' => 'required',
                        'ttcostPrice' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',
                        'ttnameAr.unique' => 'الإسم موجود مسبقا',
                        'tttcategoryID.required' => 'الرجاءإختيار القسم   ',
                    ],
                )->validate();

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameAr', $request->ttnameAr)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }

                if (
                    0 !=
                    Product::where('orgID', $product->orgID = auth()->user()->orgID)
                        ->where('nameEn', $request->ttnameEn)
                        ->count()
                ) {
                    session()->flash('faild', trans('Dadhoard.Theproductalreadyexists'));
                    return redirect(url()->previous());
                }

                $product->nameAr = $request->ttnameAr;
                $product->nameEn = $request->ttnameEn;
                $product->categoryID = $request->tttcategoryID;
                $product->costPrice = $request->ttcostPrice;

                // if(!$request->ttvatQuest)
                // {
                //     $product->costPrice =  $request->ttcostPrice * 1.15;

                // }

                $product->vat = $request->ttvat;

                $product->orgID = auth()->user()->orgID;
                $product->userID = auth()->user()->id;
                $product->unitID = $request->tunitID;
                $product->TypeProdect = $request->TypeProdect;

                if (!empty($request->barcode)) {
                    $product->barcode = $request->barcode;
                } else {
                    $product->barcodeType = 2;
                    $lastProduct = Product::where('barcodeType', 2)
                        ->where('status', '!=', 5)
                        ->where('orgID', auth()->user()->orgID)
                        ->orderBy('id', 'desc')
                        ->first();
                    if (!empty($lastProduct)) {
                        $product->barcode = $lastProduct->barcode + 1;
                    } else {
                        $product->barcode = 50001;
                    }
                }
            }

            ///////////////////////////////////////////////////////////////////////////
            if (auth()->user()->organization->activity == 1) {
                $product->isParent = $request->isParent;
                $product->parentID = $request->parentID;
                if (!empty($request->barcode)) {
                    $product->barcode = $request->barcode;
                } else {
                    $product->barcodeType = 2;
                    $lastProduct = Product::where('barcodeType', 2)
                        ->where('status', '!=', 5)
                        ->where('orgID', auth()->user()->orgID)
                        ->orderBy('id', 'desc')
                        ->first();
                    if (!empty($lastProduct)) {
                        $product->barcode = $lastProduct->barcode + 1;
                    } else {
                        $product->barcode = 50001;
                    }
                }
                $data = explode('::', $request->unitID);
                $product->unitID = $data[0];
            }

            $product->save();
            // prunit uitQuantity sales purchase report
            //dd($request);
            if (auth()->user()->organization->activity == 2) {
                $br = Branch::findorFail(auth()->user()->branchID);
                if ($request->TypeProdect == 2 || $request->TypeProdect == 3 || $request->TypeProdect == 1) {
                    for ($i = 0; $i < 3; $i++) {
                        $prunit = 'prunit' . $i;
                        $uitQuantity = 'uitQuantity' . $i;
                        $prodprice = 'pprice' . $i;

                        $sales = 'sales' . $i;
                        $purchase = 'purchase' . $i;
                        $report = 'report' . $i;
                        $compon = 'compon' . $i;

                        if ($request->$prunit != null && $request->$uitQuantity != null) {
                            $punit = new ProdUnit();
                            $data = explode('::', $request->$prunit);
                            $punit->prodID = $product->id;
                            $punit->unitID = $data[0];
                            $punit->unitname = $data[1];
                            $punit->quantity = $request->$uitQuantity;
                            $punit->price = $request->$prodprice;
                            if ($request->$sales) {
                                $punit->sales = 1;
                                $product->saleUnit = $request->$prunit;
                            }
                            if ($request->$purchase) {
                                $punit->purchase = 1;
                                $product->purhaseUnit = $request->$prunit;
                            }
                            if ($request->$report) {
                                $punit->report = 1;
                                $product->reportUnit = $request->$prunit;
                            }
                            if ($request->$compon) {
                                $punit->compon = 1;
                                $product->componUnit = $request->$prunit;
                            }

                            $product->save();
                            $punit->count = 0;
                            $punit->costprodect = $request->$prodprice;
                            $punit->saller = 0;
                            $punit->countSaller = 0;
                            $punit->orgID = auth()->user()->orgID;
                            $punit->StoreId = $br->DepotStore[0]->id;

                            $punit->save();
                        }
                    }
                }
            }

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('products.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    // public function store(Request $request)
    // {

    //   // vatQuest

    //       $xx= 0;
    //   for($i=0;$i<3;$i++)
    //   {

    //       $compon="compon".$i;
    //       if($request->$compon)
    //       {
    //         $xx =5;
    //       }

    //     }

    //     $product = new Product();

    //     if($request->TypeProdect == 1)
    //     {
    //     $validator = \Validator::make($request->all(), [
    //         'nameAr' => 'required|unique:App\Models\Product,nameAr',
    //         'categoryID' => 'required',
    //         'kitchenID' => 'required',
    //         'prodPrice' => 'required',
    //         'unitID' => 'required',

    //     ],$messages = [
    //         'required' => 'الرجاء عدم ترك الحقل فارغ',
    //         'nameAr.unique' => 'الإسم موجود مسبقا',
    //         'categoryID.required' => 'الرجاءإختيار القسم   ',
    //         'kitchenID.required' => 'الرجاءإختيار المطبخ',
    //         'unitID.required' => 'الرجاءإختيار الوحدة',])->validate();

    //         //'compon1' => Rule::present_if($request->TypeProdect == 2),
    //         //'compon0' => 'present',
    //     }elseif($request->TypeProdect == 2)
    //     {
    //         $validator = \Validator::make($request->all(), [
    //             'nameAr' => 'required|unique:App\Models\Product,nameAr',
    //             'categoryID' => 'required',
    //             'unitID' => 'required',
    //             'costPrice' => 'required',

    //         ],$messages = [
    //             'required' => 'الرجاء عدم ترك الحقل فارغ',
    //             'nameAr.unique' => 'الإسم موجود مسبقا',
    //             'categoryID.required' => 'الرجاءإختيار القسم   ',
    //             'unitID.required' => 'الرجاءإختيار الوحدة',])->validate();
    //     }elseif($request->TypeProdect == 3)
    //     {
    //         $validator = \Validator::make($request->all(), [
    //             'nameAr' => 'required|unique:App\Models\Product,nameAr',
    //             'tcategoryID' => 'required',
    //             'unitID' => 'required',

    //         ],$messages = [
    //             'required' => 'الرجاء عدم ترك الحقل فارغ',
    //             'nameAr.unique' => 'الإسم موجود مسبقا',
    //             'tcategoryID.required' => 'الرجاءإختيار القسم   ',
    //             'kitchenID.required' => 'الرجاءإختيار المطبخ',])->validate();
    //     }

    //     //dd($request);
    //     if ($request->hasFile('img')) {
    //         //get filename with extension
    //         $filenameWithExt = $request->file('img')->getClientOriginalName();
    //         //get just filename
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         //get just extension
    //         $extension = $request->file('img')->getClientOriginalExtension();
    //         //create filename to store
    //         $fileNametoStore = $filename . '_' . time() . '.' . $extension;
    //         //upload image
    //         $path = $request->file('img')->move(public_path('/dist/img/products'), $fileNametoStore);
    //         //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
    //     }
    //     if ($request->hasFile('img')) {
    //         $product->img = $fileNametoStore;
    //     } else {
    //         $product->img = "default.jpg";
    //     }
    //     $product->nameAr = $request->nameAr;
    //     $product->nameEn = $request->nameEn;
    //     $product->detailsAr = $request->detailsAr;
    //     $product->detailsEn = $request->detailsEn;
    //     $product->calories = $request->calories;

    //      $product->costPrice = $request->costPrice;
    //     $product->prodPrice = $request->prodPrice;
    //     if(!$request->vatQuest)
    //     {

    //         $product->costPrice =  $request->costPrice * 1.15;
    //         $product->prodPrice = $request->prodPrice * 1.15;

    //     }

    //      //dd($product);

    //     $product->vat = $request->vat;

    //     $product->categoryID = $request->categoryID;
    //     $product->kitchenID = $request->kitchenID;

    //     $product->sFrom = $request->sFrom;
    //     $product->sTo = $request->sTo;

    //     $product->orgID = auth()->user()->orgID;
    //     $product->userID = auth()->user()->id;

    //     if(auth()->user()->organization->activity == 1)
    //     {
    //         $product->isParent = $request->isParent;
    //         $product->parentID = $request->parentID;
    //         if(!empty($request->barcode)){
    //             $product->barcode = $request->barcode;
    //         }else{
    //             $product->barcodeType = 2;
    //             $lastProduct = Product::where('barcodeType',2)->where('status','!=',5)->where('orgID',auth()->user()->orgID)->orderBy('id','desc')->first();
    //             if(!empty($lastProduct))  {
    //                 $product->barcode = $lastProduct->barcode + 1;
    //             } else{
    //                 $product->barcode = 50001;
    //             }
    //         }
    //          $data=explode("::", $request->unitID);
    //         $product->unitID = $data[0];
    //     }
    //     if(auth()->user()->organization->activity == 2)
    //     {
    //         $product->unitID = $request->unitID;
    //         $product->TypeProdect = $request->TypeProdect;
    //         if(( $request->TypeProdect==2) && ($request->saleable == 1))
    //         {

    //             $product->saleCat = $request->scategoryID;
    //             $product->saleable = $request->saleable;

    //         }
    //         if( $request->TypeProdect==3)
    //         {
    //             $product->categoryID = $request->tcategoryID;

    //         }
    //         if(!empty($request->barcode)){
    //             $product->barcode = $request->barcode;
    //         }else{
    //             $product->barcodeType = 2;
    //             $lastProduct = Product::where('barcodeType',2)->where('status','!=',5)->where('orgID',auth()->user()->orgID)->orderBy('id','desc')->first();
    //             if(!empty($lastProduct))  {
    //                 $product->barcode = $lastProduct->barcode + 1;
    //             } else{
    //                 $product->barcode = 50001;
    //             }
    //         }
    //     }

    //     $product->save();
    //   // prunit uitQuantity sales purchase report
    //   //dd($request);
    //   if(auth()->user()->organization->activity == 2)
    //   {

    //     $br=Branch::findorFail(auth()->user()->branchID);
    //     if(( $request->TypeProdect==2) || ($request->TypeProdect==3)|| ($request->TypeProdect==1))
    //     {

    //       for($i=0;$i<3;$i++)
    //       {
    //           $prunit = "prunit".$i;
    //           $uitQuantity = "uitQuantity".$i;
    //           $prodprice = "pprice".$i;

    //           $sales = "sales".$i;
    //           $purchase ="purchase".$i;
    //           $report="report".$i;
    //           $compon="compon".$i;

    //      if(($request->$prunit != null) && ($request->$uitQuantity != null) )
    //       {

    //         $punit = new ProdUnit();
    //         $data=explode("::", $request->$prunit);
    //         $punit->prodID =$product->id;
    //         $punit->unitID= $data[0];
    //         $punit->unitname = $data[1];
    //         $punit->quantity =$request->$uitQuantity;
    //         $punit->price =$request->$prodprice;
    //          if(!$request->vatQuest)
    //          {

    //              $punit->price =$request->$prodprice * 1.15;

    //          }
    //         if($request->$sales)
    //         {
    //         $punit->sales=1;
    //         $product->saleUnit=$request->$prunit;
    //         }
    //         if($request->$purchase)
    //         {
    //             $punit->purchase=1;
    //           $product->purhaseUnit=$request->$prunit;
    //         }
    //         if($request->$report)
    //         {
    //         $punit->report=1;
    //         $product->reportUnit=$request->$prunit;
    //         }
    //         if($request->$compon)
    //         {
    //             $punit->compon=1;
    //           $product->componUnit=$request->$prunit;
    //         }

    //         $product->save();
    //         $punit->count = 0;
    //         $punit->costprodect = $request->$prodprice;

    //         if(!$request->vatQuest)
    //          {

    //               $punit->costprodect =$request->$prodprice * 1.15;

    //          }

    //         $punit->saller =0;
    //         $punit->countSaller = 0;
    //         $punit->orgID = auth()->user()->orgID;
    //         $punit->StoreId =  $br->DepotStore[0]->id;

    //       $punit->save();
    //     }

    //       }

    //     }
    // }

    //     session()->flash('success', 'تمت اضافة المنتج بنجاح');

    //     return redirect(route('products.index'));

    // }

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

            $br = Branch::findorFail(auth()->user()->branchID);
            $prdUnits = ProdUnit::Where('prodID', $id)
                ->where('StoreId', $br->DepotStore[0]->id)
                ->get();

            $copmon = Volume::Where('ProdectID', $id)->first();

            // dd($copmon);
            if (auth()->user()->organization->activity == 2) {
                return view('admin.products.show')->with('product', $product)->with('prdUnits', $prdUnits)->with('copmons', $copmon);
            } else {
                return view('admin.products.ProdShow')->with('product', $product)->with('prdUnits', $prdUnits)->with('copmons', $copmon);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function productsBarcode($id)
    {
        try {
            $product = Product::findorFail($id);
            return view('admin.products.barcode')->with('product', $product);
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
            $product = Product::findorFail($id);
            $br = Branch::findorFail(auth()->user()->branchID);
            $prdUnits = ProdUnit::Where('prodID', $id)
                ->where('StoreId', $br->DepotStore[0]->id)
                ->get();
            if (auth()->user()->organization->activity == 2) {
                return view('admin.products.edit')->with('product', $product)->with('prdUnits', $prdUnits);
            } else {
                return view('admin.products.ProdEdit')->with('product', $product)->with('prdUnits', $prdUnits)->with('countUnit', count($prdUnits));
            }
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
        //
        try {
            $product = Product::findorFail($id);

            if ($request->TypeProdect == 1) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'nameAr' => 'required',
                        'categoryID' => 'required',
                        'kitchenID' => 'required',
                        'prodPrice' => 'required',
                        'unitID' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',

                        'categoryID.required' => 'الرجاءإختيار القسم   ',
                        'kitchenID.required' => 'الرجاءإختيار المطبخ',
                        'unitID.required' => 'الرجاءإختيار الوحدة',
                    ],
                )->validate();

                //'compon1' => Rule::present_if($request->TypeProdect == 2),
                //'compon0' => 'present',
            } elseif ($request->TypeProdect == 2) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'nameAr' => 'required',
                        'categoryID' => 'required',
                        'unitID' => 'required',
                        'costPrice' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',
                        'scategoryID.required' => 'الرجاءإختيار القسم   ',
                        'unitID.required' => 'الرجاءإختيار الوحدة',
                    ],
                )->validate();
            } elseif ($request->TypeProdect == 3) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'nameAr' => 'required',
                        'tcategoryID' => 'required',
                        'unitID' => 'required',
                        'costPrice' => 'required',
                    ],
                    $messages = [
                        'required' => 'الرجاء عدم ترك الحقل فارغ',
                        'tcategoryID.required' => 'الرجاءإختيار القسم   ',
                        'kitchenID.required' => 'الرجاءإختيار المطبخ',
                    ],
                )->validate();
            }

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
                $path = $request->file('img')->move(public_path('/dist/img/products'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $product->img = $fileNametoStore;
            }
            $product->nameAr = $request->nameAr;
            $product->nameEn = $request->nameEn;
            $product->detailsAr = $request->detailsAr;
            $product->detailsEn = $request->detailsEn;
            $product->calories = $request->calories;
            $product->costPrice = $request->costPrice;
            $product->prodPrice = $request->prodPrice;
            $product->vat = $request->vat;
            $product->categoryID = $request->categoryID;
            $product->kitchenID = $request->kitchenID;
            $product->sFrom = $request->sFrom;
            $product->sTo = $request->sTo;
            $product->orgID = auth()->user()->orgID;
            $product->userID = auth()->user()->id;

            if (auth()->user()->organization->activity == 2) {
                $product->TypeProdect = $request->TypeProdect;
                if ($request->TypeProdect == 2 && $request->saleable == 1) {
                    $product->saleCat = $request->scategoryID;
                    $product->saleable = $request->saleable;
                }
                if ($request->TypeProdect == 3) {
                    $product->categoryID = $request->tcategoryID;
                }
            }
            $product->save();

            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */

            if ($request->TypeProdect == 2 || $request->TypeProdect == 3 || $request->TypeProdect == 1) {
                $punit = ProdUnit::where('prodID', $id)->get();
                for ($i = 0; $i < count($punit); $i++) {
                    $prunit = 'prunit' . $i;
                    $uitQuantity = 'uitQuantity' . $i;
                    $prodprice = 'pprice' . $i;
                    $sales = 'sales' . $i;
                    $purchase = 'purchase' . $i;
                    $report = 'report' . $i;
                    $compon = 'compon' . $i;
                    if ($request->$prunit != null && $request->$uitQuantity != null) {
                        //dd($request->$prodprice);
                        // $punit->prodID =$product->id;
                        $data = explode('::', $request->$prunit);
                        $punit[$i]->unitID = $data[0];
                        $punit[$i]->quantity = $request->$uitQuantity;
                        $punit[$i]->price = $request->$prodprice;
                        $punit[$i]->costprodect = $request->$prodprice;
                        //dd($punit[$i]);
                        if ($request->$sales) {
                            $punit[$i]->sales = 1;
                            $product->saleUnit = $request->$prunit;
                        } else {
                            $punit[$i]->sales = 0;
                        }

                        if ($request->$purchase) {
                            $punit[$i]->purchase = 1;
                            $product->purhaseUnit = $request->$prunit;
                        } else {
                            $punit[$i]->purchase = 0;
                        }
                        if ($request->$report) {
                            $punit[$i]->report = 1;
                            $product->reportUnit = $request->$prunit;
                        } else {
                            $punit[$i]->report = 0;
                        }
                        if ($request->$compon) {
                            $punit[$i]->compon = 1;
                            $product->componUnit = $request->$prunit;
                        } else {
                            $punit[$i]->compon = 0;
                        }

                        $product->save();
                        $punit[$i]->save();
                    }
                }
            }

            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            if ($request->TypeProdect == 2 || $request->TypeProdect == 3 || $request->TypeProdect == 1) {
                for ($i = (int) $request->countunitOld; $i < 3; $i++) {
                    $prunit = 'prunit' . $i;
                    $uitQuantity = 'uitQuantity' . $i;
                    $prodprice = 'pprice' . $i;
                    $sales = 'sales' . $i;
                    $purchase = 'purchase' . $i;
                    $report = 'report' . $i;
                    $compon = 'compon' . $i;

                    if ($request->$prunit != null && $request->$uitQuantity != null) {
                        foreach (auth()->user()->organization->DepotStore as $items) {
                            $punit = new ProdUnit();
                            $data = explode('::', $request->$prunit);
                            $punit->prodID = $product->id;
                            $punit->unitID = $data[0];
                            $punit->unitname = $data[1];
                            $punit->quantity = $request->$uitQuantity;
                            $punit->price = $request->$prodprice;

                            if ($request->$sales) {
                                $punit->sales = 1;
                                $product->saleUnit = $request->$prunit;
                            }
                            if ($request->$purchase) {
                                $punit->purchase = 1;
                                $product->purhaseUnit = $request->$prunit;
                            }
                            if ($request->$report) {
                                $punit->report = 1;
                                $product->reportUnit = $request->$prunit;
                            }
                            if ($request->$compon) {
                                $punit->compon = 1;
                                $product->componUnit = $request->$prunit;
                            }
                            $punit->count = 0;
                            $punit->costprodect = $request->$prodprice;
                            $punit->saller = 0;
                            $punit->countSaller = 0;
                            $punit->orgID = auth()->user()->orgID;
                            $punit->StoreId = $items->id;
                            $punit->save();
                        }
                    }
                }
            }

            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */
            /*     **************************************************************************************  */

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));
            return redirect(route('products.index'));
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
            $Volume = Volume::where('orgID', auth()->user()->orgID)
                ->where('ProdectID', $id)
                ->first();
            $VolumeDetails = VolumeDetail::where('orgID', auth()->user()->orgID)
                ->where('ProdectId', $id)
                ->first();
            $Stock = Stock::where('orgID', auth()->user()->orgID)
                ->where('productID', $id)
                ->first();
            $Puches = Purchasedetails::where('orgID', auth()->user()->orgID)
                ->where('productID', $id)
                ->first();
            $order = Orderdetails::where('orgID', auth()->user()->orgID)
                ->where('productID', $id)
                ->first();
            $OrderInv = OrderinvDetails::where('orgID', auth()->user()->orgID)
                ->where('productID', $id)
                ->first();
            $offices = OfferPricedetails::where('orgID', auth()->user()->orgID)
                ->where('productID', $id)
                ->first();

            if ($Volume == null && $VolumeDetails == null && $Stock == null && $Puches == null && $order == null && $OrderInv == null && $offices == null) {
                $product = Product::findorFail($id);
                $product->unitprodect()->delete();
                $product->delete();

                session()->flash('success', trans('Dadhoard.Deletionerror'));
            } else {
                session()->flash('faild', 'المنتج عليه حركات');
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }

        return redirect(route('products.index'));
    }

    public function hide($id)
    {
        try {
            $product = Product::findorFail($id);
            $product->status = 2;
            $product->save();
            session()->flash('success', 'تم اخفاء المنتج');
            return redirect(route('products.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function unhide($id)
    {
        try {
            $product = Product::findorFail($id);
            $product->status = 1;
            $product->save();
            session()->flash('success', 'تم اظهار المنتج');
            return redirect(route('products.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function getAllProds(Request $request)
    {
        //->where('nameAr', 'LIKE', "%$search%")->where('orgID', auth()->user()->orgID)->get();
        if ($request->ajax()) {
            echo '<script>
                alert("tst")
            </script>';
            $movies = [];

            // $search = $request->q;
            $search = 'هيل';
            $movies = Product::select('id', 'nameAr', 'barcode', 'prodPrice')
                ->where('nameAr', 'LIKE', "%$search%")
                ->get();
            dd($movies);
            return response()->json($movies);
        }
    }

    public function getProds(Request $request)
    {
        if ($request->ajax()) {
            $movies = [];

            $search = $request->q;

            if (auth()->user()->organization->activity == 2) {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where(function ($query) {
                        $query->where('TypeProdect', 2)->Where('saleable', 1)->orWhere('TypeProdect', 1);
                    })
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
                return response()->json($movies);
            } else {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where('orgID', auth()->user()->orgID)
                    ->get();

                return response()->json($movies);
            }

            // ->get();
        }
    }

    public function getCompProds(Request $request)
    {
        if ($request->ajax()) {
            $movies = [];

            $search = $request->q;

            // ->where('nameAr', 'LIKE', "%$search%")->where('componUnit',1)->where('orgID',auth()->user()->orgID)
            if (auth()->user()->organization->activity == 2) {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where(function ($query) {
                        $query->where('TypeProdect', 2)->Where('saleable', 0)->orWhere('TypeProdect', 3);
                    })
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
            } else {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
            }

            // where(function ($query) {$query->where('TypeProdect',2)->Where('saleable', 0)->orWhere('TypeProdect',3);})

            return response()->json($movies);
        }
    }

    public function getPurProds(Request $request)
    {
        if ($request->ajax()) {
            $movies = [];

            $search = $request->q;

            // ->where('nameAr', 'LIKE', "%$search%")->where('componUnit',1)->where('orgID',auth()->user()->orgID)
            if (auth()->user()->organization->activity == 2) {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where('TypeProdect', 2)
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
            } else {
                $movies = Product::select('id', 'nameAr', 'barcode')
                    ->where('nameAr', 'LIKE', "%$search%")
                    ->where('orgID', auth()->user()->orgID)
                    ->get();
            }

            // ->get();

            return response()->json($movies);
        }
    }
}
