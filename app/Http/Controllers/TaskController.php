<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Taskdetails;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
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
            $task = Task::where('orgID', auth()->user()->orgID)->get();
            $dep = Department::where('orgID', auth()->user()->orgID)->get();

            return view('admin.employees.task.index')->with('task', $task)->with('dep', $dep);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    public function empindex()
    {
        try {
            $task = Task::where('orgID', auth()->user()->orgID)
                ->where(function ($query) {
                    $query->where('emp', auth()->user()->employee->id)->orWhere('group', auth()->user()->employee->depID);
                })
                ->get();
            // $task = Task::where('orgID',auth()->user()->orgID)->where('emp',auth()->user()->employee->id)->get();
            $dep = Department::where('orgID', auth()->user()->orgID)->get();
            return view('admin.employees.task.empindex')->with('task', $task)->with('dep', $dep);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            return view('admin.employees.task.create');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $task = new Task();
            if ($request->hasFile('File')) {
                //get filename with extension
                $filenameWithExt = $request->file('File')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('File')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('File')->move(public_path('dist/File'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('File')) {
                $task->file = $fileNametoStore;
            } else {
            }

            $task->orgID = auth()->user()->orgID;
            $task->title = $request->tital;
            $task->desc = $request->desc;
            $task->status = 0;
            $task->flage = $request->typetask;
            if ($request->typetask == 0) {
                $task->emp = $request->empcreate;
            } else {
                $task->group = $request->departments;
            }

            $task->save();

            return redirect()->route('Task.index');
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $task = Task::findOrFail($id);
            return view('admin.employees.task.show')->with('task', $task);
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function changetask(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($request->taskidstate);
            $task->status = $request->statuschnge;
            if ($request->statuschnge == 3 || $request->statuschnge) {
                $task->done = date('Y-m-d H:i:s');
            }
            $task->save();

            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
            return redirect()->back();
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try {
            $task = new Taskdetails();
            if ($request->hasFile('File')) {
                //get filename with extension
                $filenameWithExt = $request->file('File')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('File')->getClientOriginalExtension();
                //create filename to store
                $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                //upload image
                $path = $request->file('File')->move(public_path('dist/File'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('File')) {
                $task->file = $fileNametoStore;
            } else {
            }
            $task->orgID = auth()->user()->orgID;
            $task->taskid = $request->taskid;
            $task->desc = $request->desc;
            $task->emp = auth()->user()->id;
            $task->save();
            return back();
        } catch (Exception $e) {
            session()->flash('faild', trans('Dadhoard.Deletionerror'));
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
