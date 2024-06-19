<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Page;
use App\Models\Loginrecord;
use App\Models\Pagecategory;

class PagesController extends Controller
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
        session()->put('page','pages');
        $pages = Page::where('status',1)->get();
        return view('admin.pages.index')->with('pages',$pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('page','pages');
        $pages = Pagecategory::where('status',1)->get();
        

        return view('admin.pages.create')->with('Pagecategory',$pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $this->validate($request, [
            'nameAr' => 'required',
            'code' => 'required'
        ]);

        $page->nameAr = $request->nameAr;
        $page->nameEn = $request->nameEn;
        $page->code = $request->code;
        $page->categoryID = $request->categoryID;
        $page->orgID = auth()->user()->orgID;
        $page->branchID = auth()->user()->branchID;
        $page->userID = auth()->user()->id;
        $page->save();
        session()->flash('success', 'تمت اضافة الصلاحيات بنجاح');

        return redirect(route('pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findorFail($id);
        return view('admin.pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findorFail($id);
        $pagecats = Pagecategory::all();
        
        return view('admin.pages.edit')->with('page', $page)->with('pagecats',  $pagecats);;
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
        $page = Page::findorFail($id);
        $this->validate($request, [
            'nameAr' => 'required',
            'code' => 'required'
        ]);

        $page->nameAr = $request->nameAr;
        $page->nameEn = $request->nameEn;
        $page->code = $request->code;
        $page->categoryID = $request->categoryID;
        $page->orgID = auth()->user()->orgID;
        $page->branchID = auth()->user()->branchID;
        $page->userID = auth()->user()->id;
        $page->save();
        session()->flash('success', 'تم تحديث البيانات');

        return redirect(route('pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findorFail($id);


        //then Delete Page
        $page->status = 5;
        $page->save();
        session()->flash('success', 'تم حذف الصلاحيات');
        return redirect(route('pages.index'));
    }




}
