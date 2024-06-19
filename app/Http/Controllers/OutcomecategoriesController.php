<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Outcomecategory;
use App\Models\Loginrecord;
use App\Models\ReportData;
use Exception;

class OutcomecategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function outcomeitmes($id)
    {
        try {
            $outcome = Outcomecategory::findorFail($id);
            return response()->json($outcome);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return response()->json();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            session()->put('page', 'outcomes');
            session()->put('sub-page', 'outcomesType');
            $outcomecategories = Outcomecategory::where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.outcomecategories.index')->with('outcomecategories', $outcomecategories);
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
            $AccountingGuide = Accounting_guide::where('SourceID', '5')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            return view('admin.outcomecategories.create', ['AccountingGuide' => $AccountingGuide]);
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
            $this->validate($request, [
                'nameAr' => 'required|string|max:191',
            ]);
            $data = explode('::', $request->TypeAccount);
            $count = Accounting_guide::where('SourceID', $data[0])
                ->where('orgID', auth()->user()->orgID)
                ->count();

            $AccountingGuide = new Accounting_guide();
            $AccountingGuide->AccountID = $data[0] . '00' . $count + 1;
            $AccountingGuide->AccountName = $request->nameAr;
            $AccountingGuide->AccountNameEn = $request->nameAr;
            $AccountingGuide->type = $data[1];
            $AccountingGuide->maxAccount = 0;
            $AccountingGuide->minAccount = 0;
            $AccountingGuide->Account_Source = 0;
            $AccountingGuide->Account_status = 1;
            $AccountingGuide->SourceID = $data[0];
            $AccountingGuide->typeProcsss = 0;
            $AccountingGuide->orgID = auth()->user()->orgID;
            $AccountingGuide->save();

            $productcategory = new Outcomecategory();
            $productcategory->nameAr = $request->nameAr;
            $productcategory->nameEn = $request->nameEn;
            $productcategory->orgID = auth()->user()->orgID;
            $productcategory->userID = auth()->user()->id;

            $productcategory->TypeAccount = $data[1];
            $productcategory->AccountID = $data[0] . '00' . $count + 1;
            $productcategory->GuidesID = $AccountingGuide->id;
            $productcategory->save();

            $ReportData = new ReportData();
            $ReportData->orgID = auth()->user()->orgID;
            $ReportData->debitFrist = 0;
            $ReportData->creditFrist = 0;
            $ReportData->debitSecond = 0;
            $ReportData->creditSecond = 0;
            $ReportData->debitThird = 0;
            $ReportData->creditThird = 0;
            $ReportData->AccountID = $AccountingGuide->id;
            $ReportData->save();

            session()->flash('success', trans('Dadhoard.Addedsuccessfully'));

            return redirect(route('outcomeCategories.index'));
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
            $outcomecategory = Outcomecategory::findorFail($id);
            return view('admin.outcomecategories.show')->with('outcomecategory', $outcomecategory);
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
            $AccountingGuide = Accounting_guide::where('SourceID', '5')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $outcomecategory = Outcomecategory::findorFail($id);

            return view('admin.outcomecategories.edit', ['outcomecategory' => $outcomecategory, 'AccountingGuide' => $AccountingGuide]);
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
            $productcategory = Outcomecategory::findorFail($id);
            $data = explode('::', $request->TypeAccount);

            $count = Accounting_guide::where('SourceID', $data[0])
                ->where('orgID', auth()->user()->orgID)
                ->count();

            $productcategory->nameAr = $request->nameAr;
            $productcategory->nameEn = $request->nameEn;
            $productcategory->orgID = auth()->user()->orgID;
            $productcategory->userID = auth()->user()->id;

            if ($productcategory->AccountID == $request->AccountID) {
                $productcategory->TypeAccount = $data[1];
            } else {
                $productcategory->TypeAccount = $data[1];
                $productcategory->AccountID = $data[0] . '00' . $count + 1;
            }

            $productcategory->save();

            if ($productcategory->AccountID == $request->AccountID) {
                $AccountingGuide = Accounting_guide::where('AccountID', $request->AccountID)
                    ->where('orgID', auth()->user()->orgID)
                    ->FirstorFail();
                $AccountingGuide->AccountName = $request->nameAr;
                $AccountingGuide->type = $data[1];
                $AccountingGuide->save();
            } else {
                $AccountingGuide = Accounting_guide::where('AccountID', $request->AccountID)
                    ->where('orgID', auth()->user()->orgID)
                    ->FirstorFail();
                $AccountingGuide->AccountID = $data[0] . '00' . $count + 1;
                $AccountingGuide->AccountName = $request->nameAr;
                $AccountingGuide->AccountNameEn = $request->nameAr;
                $AccountingGuide->type = $data[1];
                $AccountingGuide->maxAccount = 0;
                $AccountingGuide->minAccount = 0;
                $AccountingGuide->Account_Source = 0;
                $AccountingGuide->Account_status = 1;
                $AccountingGuide->SourceID = $data[0];
                $AccountingGuide->typeProcsss = 0;
                $AccountingGuide->save();
            }

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('outcomeCategories.index'));
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
            $productcategory = Outcomecategory::findorFail($id);
            $productcategory->status = 5;
            $productcategory->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('outcomeCategories.index'));
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Displayerror'));
            return redirect()->back();
        }
    }
}
