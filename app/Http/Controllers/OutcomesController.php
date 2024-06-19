<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Organization;
use App\Services\MovementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Outcome;
use App\Models\Loginrecord;
use App\Models\Outcomecategory;

class OutcomesController extends Controller
{
    private MovementService $movementService;

    public function __construct(MovementService $movementService)
    {
        $this->middleware('auth');
        $this->movementService =$movementService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->put('page','outcomes');
        session()->put('sub-page','outcomesList');
        $outcomes = Outcome::where('status',1)->where('orgID', auth()->user()->organization->id)->where('created_at','>=',session('dateFrom'))->where('created_at','<',session('dateTo'))->get();
        return view('admin.outcomes.index')->with('outcomes',$outcomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('page','outcomes');
        session()->put('sub-page','outcomesCreate');
        return view('admin.outcomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        $this->validate($request, [
            'total' => 'required',
            'categoryID' => 'required',
            'paymentTypeitems' => 'required',
            'img' => ' max:500',
        ]);
        $outcome = new Outcome();

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
            $path = $request->file('img')->move(public_path('dist/img/outcomes'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $outcome->img = $fileNametoStore;
        } else {
            $outcome->img = "default.jpg";
        }
        $cat=Outcomecategory::findorFail($request->categoryID);
        $data=explode("::",  $request->paymentTypeitems);
        $outcome->outAccount=$data[0];
        $outcome->nameAccount= $data[1];

        $outcome->AccountID= $cat->AccountID;
        $outcome->type= $request->type;
        $outcome->comment = $request->comment;
        $outcome->total = $request->total;
        $outcome->categoryID = $request->categoryID;
        $outcome->branchID = auth()->user()->branchID;
        $outcome->orgID = auth()->user()->orgID;
        $outcome->userID = auth()->user()->id;
        $outcome->save();



        $dee=$outcome->category->Accounting_guide->ReportData;
        $dee->creditSecond= $dee->creditSecond+$request->total;
        $dee->save();
        $account=Accounting_guide::where('orgID',auth()->user()->orgID)->where('AccountID' ,$data[0])->first();
        $dd=$account->ReportData;
        $dd->debitSecond= $dd->debitSecond+$request->total;
        $dd->save();

        if(auth()->user()->organization->activity  === 3){
            $update_opening_balance = auth()->user()->organization->available_balance - $request->total;

            Organization::where('id', auth()->user()->organization->id)
            ->update(['available_balance' => $update_opening_balance]);

            $this->movementService->MovementStore('مصروفات',auth()->user()->branchID,1, $request->total,  auth()->user()->organization->available_balance,auth()->user()->orgID);


        }

        session()->flash('success',    trans('Dadhoard.Addedsuccessfully'));

        return redirect(route('outcomes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outcome = Outcome::findorFail($id);

        return view('admin.outcomes.show')->with('outcome', $outcome);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outcome = Outcome::findorFail($id);

        return view('admin.outcomes.edit')->with('outcome', $outcome);
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




        $this->validate($request, [
            'total' => 'required',
            'categoryID' => 'required',
            'paymentTypeitems' => 'required',
            'img' => ' max:500',
        ]);
        $outcome = Outcome::findorFail($id);

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
            $path = $request->file('img')->move(public_path('dist/img/outcomes'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $outcome->img = $fileNametoStore;
        } else {
            $outcome->img = "default.jpg";
        }
        $cat=Outcomecategory::findorFail($request->categoryID);
        $data=explode("::",  $request->paymentTypeitems);
        $outcome->outAccount=$data[0];
        $outcome->nameAccount= $data[1];

        $outcome->AccountID= $cat->AccountID;
        $outcome->type= $request->type;
        $outcome->comment = $request->comment;
        $outcome->total = $request->total;
        $outcome->categoryID = $request->categoryID;
        $outcome->branchID = auth()->user()->branchID;
        $outcome->orgID = auth()->user()->orgID;
        $outcome->userID = auth()->user()->id;
        $outcome->save();


        if($request->categoryID != $request->oldCat)
        {
            $cat=Outcomecategory::findorFail($request->oldCat);
            $dee=$cat->Accounting_guide->ReportData;
            $dee->debitSecond= $dee->debitSecond+$request->Oldtotal;
            $dee->save();

            $dee=$outcome->category->Accounting_guide->ReportData;
            $dee->creditSecond= $dee->creditSecond+$request->total;
            $dee->save();

        }

        if($data[0] !=$request->Oldpayment)
        {
            $account=Accounting_guide::where('orgID',auth()->user()->orgID)->where('AccountID' ,$request->Oldpayment)->first();
            $dd=$account->ReportData;
            $dd->creditSecond= $dd->creditSecond+$request->total;
            $dd->save();

            $account=Accounting_guide::where('orgID',auth()->user()->orgID)->where('AccountID' ,$data[0])->first();
            $dd=$account->ReportData;
            $dd->debitSecond= $dd->debitSecond+$request->total;
            $dd->save();

        }


        if(auth()->user()->organization->activity  === 3){
            $update_opening_balance = auth()->user()->organization->available_balance - $request->total;

            Organization::where('id', auth()->user()->organization->id)
            ->update(['available_balance' => $update_opening_balance]);

            $this->movementService->MovementStore('مصروفات',auth()->user()->branchID,1, $request->total,  auth()->user()->organization->available_balance,auth()->user()->orgID);


        }

        session()->flash('success',     trans('Dadhoard.Updatedsuccessfully'));

        return redirect(route('outcomes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outcome = Outcome::findorFail($id);


        //then Delete Outcome
        $outcome->status = 5;
        $outcome->save();
        session()->flash('success',    trans('Dadhoard.Deletedsuccessfully'));
        return redirect(route('outcomes.index'));
    }

  


}
