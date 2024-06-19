<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Pagecategory;

class PagecategoriesController extends Controller
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
        session()->put('page','pagecategories');
        $pagecategories = Pagecategory::where('status',1)->get();
        return view('admin.pagecategories.index')->with('pagecategories',$pagecategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pagecategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagecategory = new Pagecategory();
        $this->validate($request, [
            'nameAr' => 'required|string|max:191',
            'categoryID' => 'required'
        ]);
       
        $pagecategory->nameAr = $request->nameAr;
        $pagecategory->nameEn = $request->nameEn;
        $pagecategory->orgID = auth()->user()->orgID;
        $pagecategory->userID = auth()->user()->id;
        $pagecategory->save();
        session()->flash('success', 'تمت اضافة المستخدم بنجاح');

        return redirect(route('pagecategories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodcategory = Pagecategory::findorFail($id);
        return view('admin.pagecategories.show')->with('prodcategory', $prodcategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prodcategory = Pagecategory::findorFail($id);
        return view('admin.pagecategories.edit')->with('prodcategory', $prodcategory);
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
        $pagecategory = Pagecategory::findorFail($id);
        $this->validate($request, [
            'nameAr' => 'required|string|max:191',
            'categoryID' => 'required'
        ]);
       
        $pagecategory->nameAr = $request->nameAr;
        $pagecategory->nameEn = $request->nameEn;
        $pagecategory->orgID = auth()->user()->orgID;
        $pagecategory->userID = auth()->user()->id;
        $pagecategory->save();
        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('pagecategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pagecategory = Pagecategory::findorFail($id);
        $pagecategory->status = 5;
        $pagecategory->save();
        session()->flash('success', 'تم حذف القسم بنجاح');
        return redirect(route('pagecategories.index'));
    }

  
}
