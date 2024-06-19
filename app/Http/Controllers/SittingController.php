<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageList;
use App\Models\Inv;
use App\Models\Packagecatagury;
use App\Models\OrgSetting;
use Exception;
use App\Models\Organization;
use Illuminate\Http\Request;

class SittingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        try {
            $inv = Inv::where('orgID', auth()->user()->orgID)->first();
            $org = OrgSetting::where('orgID', auth()->user()->orgID)->first();

            if ($org == null) {
                $org = new OrgSetting();
                $org->orgID = auth()->user()->orgID;
                $org->save();
            }
            $org = OrgSetting::where('orgID', auth()->user()->orgID)->first();

            return view('admin.Sitting.create')->with('inv', $inv)->with('storsetting', $org);
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


  public function Orgstingall()
    {
        $org =  Organization::all();
        foreach( $org as $items)
        {
            $org = new OrgSetting();
            $org->orgID = $items->id;
            $org->save();
        }
        return back();

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try {
            $this->validate($request, [
                'Bill' => 'required',
                'product' => 'required',
            ]);
            $inv = Inv::findOrFail($id);
            $inv->Inv = $request->Bill;
            $inv->proud = $request->product;
            $inv->save();

            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function storeSettingUpdatelink(Request $request)
    {
        try {
            $org = OrgSetting::findOrFail($request->id);
            $org->Facebook = $request->Facebook;
            $org->Twitter = $request->Twitter;
            $org->Instagram = $request->Instagram;
            $org->Snapchat = $request->Snapchat;
            $org->LinkedIn = $request->LinkedIn;
            $org->YouTube = $request->YouTube;
            $org->TikTok = $request->TikTok;
            $org->WhatsApp = $request->WhatsApp;
            $org->Pinterest = $request->Pinterest;
            $org->Messenger = $request->Messenger;
            $org->Google = $request->Google;
            $org->save();
            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function storeUpdate(Request $request)
    {
        try {
            $org = OrgSetting::where('orgID', auth()->user()->orgID)->first();
            if ($org != null) {
                $org->storecolor = $request->color;
                $org->fontcolor = $request->fontcolor;
                $org->pricecolor = $request->pricecolor;
                $org->catcolor = $request->catcolor;
                /////////////////////////////////////////////////////////////////
                if ($request->hasFile('backPhoto')) {
                    //get filename with extension
                    $filenameWithExt = $request->file('backPhoto')->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just extension
                    $extension = $request->file('backPhoto')->getClientOriginalExtension();
                    //create filename to store
                    $fileNametoStore = str_replace([' ', '.'], '_', $filename) . '_' . time() . '.' . $extension;
                    //upload image
                    $path = $request->file('backPhoto')->move(public_path('dist/img/onlinestore'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                }
                if ($request->hasFile('backPhoto')) {
                    $org->backPhoto = $fileNametoStore;
                } else {
                    $org->backPhoto = 'default.jpg';
                }
                ///////////////////////////////////////////////////////////////////////

                $org->save();
            } else {
                $org = new OrgSetting();
                $org->orgID = auth()->user()->orgID;
                $org->storecolor = $request->color;
                $org->fontcolor = $request->fontcolor;
                $org->pricecolor = $request->pricecolor;
                $org->catcolor = $request->catcolor;
                /////////////////////////////////////////////////////////////////
                if ($request->hasFile('backPhoto')) {
                    //get filename with extension
                    $filenameWithExt = $request->file('backPhoto')->getClientOriginalName();
                    //get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just extension
                    $extension = $request->file('backPhoto')->getClientOriginalExtension();
                    //create filename to store
                    $fileNametoStore = str_replace([' ', '.'], '_', $filename) . '_' . time() . '.' . $extension;
                    //upload image
                    $path = $request->file('backPhoto')->move(public_path('dist/img/onlinestore'), $fileNametoStore);
                    //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                }
                if ($request->hasFile('backPhoto')) {
                    $org->backPhoto = $fileNametoStore;
                } else {
                    $org->backPhoto = 'default.jpg';
                }
                ///////////////////////////////////////////////////////////////////////

                $org->save();
            }

            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
