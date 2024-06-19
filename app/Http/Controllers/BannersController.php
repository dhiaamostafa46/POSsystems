<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Banner;
use App\Models\Loginrecord;

class BannersController extends Controller
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
            session()->put('page', 'banners');
            $banners = Banner::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return view('admin.banners.index')->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
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
            $banner = new Banner();
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
                $path = $request->file('img')->move(public_path('../dist/img/banners'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $banner->img = $fileNametoStore;
            } else {
                $banner->img = 'default.jpg';
            }
            $banner->nameAr = $request->nameAr;
            $banner->nameEn = $request->nameEn;
            $banner->productID = $request->productID;
            $banner->orgID = auth()->user()->orgID;
            $banner->branchID = auth()->user()->branchID;
            $banner->userID = auth()->user()->id;
            $banner->save();
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('banners.index'));
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
            $prodcategory = Banner::findorFail($id);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return view('admin.banners.show')->with('prodcategory', $prodcategory);
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
            $prodcategory = Banner::findorFail($id);
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        return view('admin.banners.edit')->with('banner', $prodcategory);
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
            $banner = Banner::findorFail($id);
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
                $path = $request->file('img')->move(public_path('../dist/img/banners'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $banner->img = $fileNametoStore;
            } else {
                $banner->img = 'default.jpg';
            }
            $banner->nameAr = $request->nameAr;
            $banner->nameEn = $request->nameEn;
            $banner->productID = $request->productID;
            $banner->orgID = auth()->user()->orgID;
            $banner->branchID = auth()->user()->branchID;
            $banner->userID = auth()->user()->id;
            $banner->save();
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }

        session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('banners.index'));
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
            $banner = Banner::findorFail($id);
            $banner->status = 5;
            $banner->save();
        } catch (\Exception $e) {
            session()->flash('faild', trans('Dadhoard.Erroradding'));
            return redirect()->back();
        }
        session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('banners.index'));
    }
}
