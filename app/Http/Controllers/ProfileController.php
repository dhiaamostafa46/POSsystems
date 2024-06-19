<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\ProfileInfCompany;
use App\Models\ProfileInfContact;
use App\Models\ProfileInfServices;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
            session()->put('page', 'Profile');
            session()->put('sub-page', 'ProfileInfCompany');

            $prof = ProfileInfCompany::where('orgID', auth()->user()->orgID)->first();

            if ($prof == null) {
                $prof = new ProfileInfCompany();
                $prof->orgID = auth()->user()->orgID;
                $prof->Logo = '';
                $prof->About = '';
                $prof->Vision = '';
                $prof->message = '';
                $prof->imgAbout = '';
                $prof->gools = '';
                $prof->Img = '';
                $prof->save();
            }
            $prof = ProfileInfCompany::where('orgID', auth()->user()->orgID)->first();

            return view('Profile.Admin.Inf.index')->with('prof', $prof);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ContactIndex()
    {
        //

        try {
            session()->put('page', 'Profile');
            session()->put('sub-page', 'ProfileInfContact');

            $prof = ProfileInfContact::where('orgID', auth()->user()->orgID)->first();

            return view('Profile.Admin.Contact.index')->with('prof', $prof);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ServicesIndex()
    {
        //

        try {
            session()->put('page', 'Profile');
            session()->put('sub-page', 'ProfileInfServices');
            $prof = ProfileInfServices::where('orgID', auth()->user()->orgID)->get();

            return view('Profile.Admin.Services.index')->with('prof', $prof);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ServicesCreate()
    {
        //
        try {
            session()->put('page', 'Profile');
            session()->put('sub-page', 'ProfileInfServices');
            return view('Profile.Admin.Services.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ServicesStore(Request $request)
    {
        //
        try {
            $this->validate($request, [
                'disc' => 'required|string',
                'name' => 'required|string',
            ]);
            // dd($request->all());
            $prof = new ProfileInfServices();
            $prof->orgID = auth()->user()->orgID;

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
                $path = $request->file('img')->move('dist/img/Profile', $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $prof->img = $fileNametoStore;
            } else {
                $prof->img = 'profile.jpg';
            }

            $prof->name = $request->name;
            $prof->disc = $request->disc;

            $prof->save();

            return redirect(route('ProfileInfCompany.ServicesIndex'));
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

    public function ContactEdit(string $id)
    {
        //
        try {
            session()->put('page', 'Profile');
            session()->put('sub-page', 'ProfileInfContact');
            if ($id == -1) {
                $prof = new ProfileInfContact();
                $prof->orgID = auth()->user()->orgID;
                $prof->Address = '';
                $prof->AddressMap = '';
                $prof->email = '';
                $prof->Phone = '';
                $prof->save();

                return view('Profile.Admin.Contact.edit')->with('prof', $prof);
            } else {
                $prof = ProfileInfContact::findorFail($id);
                return view('Profile.Admin.Contact.edit')->with('prof', $prof);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
    public function edit(string $id)
    {
        //
        try {
            if ($id == -1) {
                $prof = new ProfileInfCompany();
                $prof->orgID = auth()->user()->orgID;
                $prof->Logo = '';
                $prof->About = '';
                $prof->Vision = '';
                $prof->message = '';
                $prof->imgAbout = '';
                $prof->gools = '';
                $prof->Img = '';
                $prof->save();

                return view('Profile.Admin.Inf.edit')->with('prof', $prof);
            } else {
                $prof = ProfileInfCompany::findorFail($id);
                return view('Profile.Admin.Inf.edit')->with('prof', $prof);
            }
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function Contactupdate(Request $request, string $id)
    {
        // $this->validate($request, [
        //     'About' => 'required|string',
        //     'Vision' => 'required|string',
        //     'message' => 'required|string',
        // ]);

        try {
            $prof = ProfileInfContact::findorFail($id);
            $prof->Address = $request->Adress;
            $prof->AddressMap = $request->AddressMap;
            $prof->email = $request->email;
            $prof->Phone = $request->Phone;
            $prof->save();

            return redirect(route('ProfileInfCompany.ContactIndex'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function ServicesEdite($id)
    {
        try {
            $profCompany = ProfileInfServices::findorFail($id);

            return view('Profile.Admin.Services.edit')->with('profCompany', $profCompany);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function Profile($id)
    {
        try {
            $profCompany = ProfileInfCompany::where('orgID', $id)->first();
            $profContact = ProfileInfContact::where('orgID', $id)->first();
            $profServices = ProfileInfServices::where('orgID', auth()->user()->orgID)->get();
            return view('Profile.Profile.index')->with('profCompany', $profCompany)->with('profServices', $profServices)->with('profContact', $profContact);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function Servicesupdate(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'disc' => 'required|string',
                'name' => 'required|string',
            ]);
            // dd($request->all());
            $prof = ProfileInfServices::findorFail($id);

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
                $path = $request->file('img')->move('dist/img/Profile', $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $prof->img = $fileNametoStore;
            } else {
            }

            $prof->name = $request->name;
            $prof->disc = $request->disc;

            $prof->save();

            return redirect(route('ProfileInfCompany.ServicesIndex'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }

    public function update(Request $request, string $id)
    {
        //

        try {
            $this->validate($request, [
                'About' => 'required|string',
                'Vision' => 'required|string',
                'message' => 'required|string',
            ]);
            // dd($request->all());
            $prof = ProfileInfCompany::findorFail($id);
            // ------------------------------------------------------------------------------------------------------------------------------------
            if ($request->hasFile('logo')) {
                //get filename with extension
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('logo')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('logo')->move('dist/img/Profile', $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('logo')) {
                $prof->Logo = $fileNametoStore;
            } else {
            }

            // --------------------------------------------------------------------------------------------------------------------------------------
            if ($request->hasFile('imgAbout')) {
                //get filename with extension
                $filenameWithExt = $request->file('imgAbout')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('imgAbout')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('imgAbout')->move('dist/img/Profile', $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('imgAbout')) {
                $prof->imgAbout = $fileNametoStore;
            } else {
            }

            // -----------------------------------------------------------------------------------------------------------------------------------

            if ($request->hasFile('Img')) {
                //get filename with extension
                $filenameWithExt = $request->file('Img')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('Img')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('Img')->move('dist/img/Profile', $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('Img')) {
                $prof->Img = $fileNametoStore;
            } else {
            }
            // -------------------------------------------------------------------------------------------------------------------------------------------

            $prof->About = $request->About;
            $prof->Vision = $request->Vision;
            $prof->message = $request->message;
            $prof->gools = $request->gools;

            $prof->save();

            return redirect(route('ProfileInfCompany.index'));
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

    public function ServicesDelete(string $id)
    {
        //

        try {
            $prof = ProfileInfServices::findorFail($id);
            if ($prof) {
                $prof->delete();
            }
            session()->flash('success', 'تم حذف الخدمة');
            return redirect(route('ProfileInfCompany.ServicesIndex'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
