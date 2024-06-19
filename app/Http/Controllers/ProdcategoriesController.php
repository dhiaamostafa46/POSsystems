<?php

namespace App\Http\Controllers;
use App\Exports\ProdcategoryExport;
use App\Imports\ProdcategoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Prodcategory;
use App\Models\Loginrecord;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class ProdcategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
     public function catprodect(Request $request)
    {
        try {
            if ($request->price != null) {
                $prodcategories = Prodcategory::findOrFail($request->id);

                if (count($prodcategories->products) > 0) {
                    foreach ($prodcategories->products as $items) {
                        if ($request->type == 1) {
                            $items->prodPrice = (float) $items->prodPrice + (float) $request->price;
                        } else {
                            $items->prodPrice = (float) $items->prodPrice - (float) $request->price;
                        }

                        $items->save();
                    }
                }
            }

            if ($request->percentage != null) {
                $prodcategories = Prodcategory::findOrFail($request->id);
                if (count($prodcategories->products) > 0) {
                    foreach ($prodcategories->products as $items) {
                        if ($request->type == 1) {
                            $items->prodPrice = (float) $items->prodPrice + (float) $items->prodPrice * ((float) $request->percentage / 100);
                        } else {
                            $items->prodPrice = (float) $items->prodPrice - (float) $items->prodPrice * ((float) $request->percentage / 100);
                        }

                        $items->save();
                    }
                }
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));
        return back();
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
            session()->put('sub-page', 'productsCategory');
            $prodcategories = Prodcategory::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.productcategories.index')->with('prodcategories', $prodcategories);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function GetExportprodcategories()
    {
        try {
            return Excel::download(new ProdcategoryExport(), 'Prodcategory.xlsx');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function GetImportprodcategories(Request $request)
    {
        try {
            Excel::import(new ProdcategoryImport(), request()->file('file'));

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));
            return redirect()->back();
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
            return view('admin.productcategories.create');
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
            $productcategory = new Prodcategory();
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
                'img' => ' max:500',
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
                $path = $request->file('img')->move(public_path('../dist/img/productcategories'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $productcategory->img = $fileNametoStore;
            } else {
                $productcategory->img = 'default.jpg';
            }
            $productcategory->nameAr = $request->nameAr;
            $productcategory->nameEn = $request->nameEn;

            $productcategory->sTo = $request->sTo;
            $productcategory->orgID = auth()->user()->orgID;
            $productcategory->sort = $request->Sort;
            $productcategory->userID = auth()->user()->id;

            if (auth()->user()->organization->activity == 2) {
                $productcategory->TypeCatagoury = $request->TypeProdect;
            }
            $productcategory->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('prodcategories.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function saveCatProdect(Request $request)
    {
        try {
            $productcategory = new Prodcategory();

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
                $path = $request->file('img')->move(public_path('../dist/img/productcategories'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $productcategory->img = $fileNametoStore;
            } else {
                $productcategory->img = 'default.jpg';
            }
            $productcategory->nameAr = $request->nameAr;
            $productcategory->nameEn = $request->nameEn;

            $productcategory->orgID = auth()->user()->orgID;
            $productcategory->sort = $request->sort;
            $productcategory->userID = auth()->user()->id;
            if ($request->flag == 1) {
                $productcategory->TypeCatagoury = $request->TypeProdect;
            }

            $productcategory->save();

            return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'data' => $productcategory]);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return response()->json(['success' => true]);
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
            $prodcategory = Prodcategory::findorFail($id);
            return view('admin.productcategories.show')->with('prodcategory', $prodcategory);
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
            $prodcategory = Prodcategory::findorFail($id);
            return view('admin.productcategories.edit')->with('prodcategory', $prodcategory);
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
            $productcategory = Prodcategory::findorFail($id);
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
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
                $path = $request->file('img')->move(public_path('../dist/img/productcategories'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $productcategory->img = $fileNametoStore;
            } else {
            }
            $productcategory->nameAr = $request->nameAr;
            $productcategory->nameEn = $request->nameEn;
            $productcategory->sFrom = $request->sFrom;
            $productcategory->sTo = $request->sTo;
            $productcategory->orgID = auth()->user()->orgID;
            $productcategory->userID = auth()->user()->id;
            $productcategory->sort = $request->Sort;
            if (auth()->user()->organization->activity == 2) {
                $productcategory->TypeCatagoury = $request->TypeProdect;
            }
            $productcategory->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('prodcategories.index'));
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
            $productcategory = Prodcategory::findorFail($id);
            $productcategory->status = 5;
            $productcategory->save();

            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('prodcategories.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
