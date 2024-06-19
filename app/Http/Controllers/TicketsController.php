<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

use App\Models\Role;
use App\Models\Loginrecord;
use App\Models\Pagecategory;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Team;
use App\Models\User;
use App\Models\TickHistory;

class TicketsController extends Controller
{
    /* public function __construct()
      {
        $this->middleware('auth');
      }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Explanations()
    {
        try {

            return view('admin.tickets.Explan');
        } catch (\Exception $e) {
            return back();
        }
    }
    public function index()
    {
        try {
            session()->put('page', 'organizations');
            session()->put('page', 'roles');

            //CURLOPT_URL => 'https://admin.evix.com.sa/api/tickets/'.auth()->user()->orgID,
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/tickets/' . auth()->user()->orgID . '/' . auth()->user()->id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);

            // dd(json_decode($response));

            $tickets = [];
            $results = json_decode($response);
            // dd($results);
            foreach ($results as $item) {
                $ticket = new Ticket();
                $ticket->id = $item->id;
                $ticket->orgID = $item->orgID;
                $ticket->userID = $item->userID;
                $ticket->tickStatus = $item->tickStatus;
                $ticket->title = $item->title;

                $ticket->details = $item->details;
                $ticket->created_at = $item->created_at;
                array_push($tickets, $ticket);
            }
            // dd($arr);
            return view('admin.tickets.index')->with('tickets', $tickets); //->with('tickets',$tickets)
        } catch (\Exception $e) {
            return back();
        }
    }
    public function teams()
    {
        try {
            session()->put('page', 'organizations');
            $teams = User::where('roleID', 19)->get();
            //dd($teams);
            return view('admin.teams.index')->with('teams', $teams);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function getAll()
    {
        return view('admin.tickets.index');
    }

    public function create()
    {
        session()->put('page', 'organizations');
        //$teams = User::where('roleID',19)->get();
        //dd($teams);
        return view('admin.tickets.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            $tickImage = '';
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
                $path = $request->file('img')->move(public_path('/dist/img/tickets'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $tickImage = 'https://evix.com.sa/public/dist/img/tickets/' . $fileNametoStore;
            } else {
                $tickImage = null;
            }
            //dd($tickImage);
            $curl = curl_init();
            $req =
                '{
            "orgID":"' .
                auth()->user()->orgID .
                '",
            "userID":"' .
                auth()->user()->id .
                '",
            "title":"' .
                $request->title .
                '",
            "details":"' .
                $request->details .
                '",
            "image":"' .
                $tickImage .
                '"

        }';
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/newTicket',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $req,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ]);

            $response = curl_exec($curl);

            /*$res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = "checkLicense";
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();*/

            curl_close($curl);
            if ($response == 'done') {
                session()->flash('success', 'تم رفع التذكرة');
                return redirect(route('tickets.index'));
            }

            session()->flash('faild', 'خطأ في رفع التذكرة يرجة المحاولة لاحقا');
            return redirect(route('tickets.index'));
        } catch (\Exception $e) {
            return back();
        }
        /*try{
            $response_a = json_decode($response, true);
            session()->put('signature', $response_a['signature']);
            session()->put('sessionUuid', $response_a['sessionUuid']);
            session()->put('mobile', $mobileNumber);
        }catch(Exception $e){
        }*/
    }

    public function storeComment(Request $request)
    {
        try {
            $tickImage = '';
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
                $path = $request->file('img')->move(public_path('/dist/img/tickets'), $fileNametoStore);
                //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
            }
            if ($request->hasFile('img')) {
                $tickImage = 'https://evix.com.sa/public/dist/img/tickets/' . $fileNametoStore;
            } else {
                $tickImage = null;
            }

            //dd($tickImage);
            $curl = curl_init();
            $req =
                '{
            "tickID":"' .
                $request->tickID .
                '",
            "ownerID":"' .
                auth()->user()->id .
                '",
            "comment":"' .
                $request->details .
                '",
            "image":"' .
                $tickImage .
                '"

        }';
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/newComment',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $req,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ]);

            $response = curl_exec($curl);

            //dd($response);
            /*$res = new Respons();
        $res->request_ = $req;
        $res->response_ = $response;
        $res->action = "checkLicense";
        $res->userID = auth()->user()->id;
        $res->orgID = auth()->user()->orgID;
        $res->save();*/

            curl_close($curl);
            if ($response == 'done') {
                session()->flash('success', 'تم رفع التذكرة');
                return redirect(route('tickets.index'));
            }

            session()->flash('faild', 'خطأ في رفع التذكرة يرجة المحاولة لاحقا');
            return redirect(route('tickets.index'));
        } catch (\Exception $e) {
            return back();
        }
        /*try{
            $response_a = json_decode($response, true);
            session()->put('signature', $response_a['signature']);
            session()->put('sessionUuid', $response_a['sessionUuid']);
            session()->put('mobile', $mobileNumber);
        }catch(Exception $e){
        }*/
    }

    public function getStatus($id)
    {
        $status = Ticket::where('id', $id)->first();

        $result = '';

        if ($status->tickStatus == 1) {
            $result = 'في إنتظار الموافقة';
        } elseif ($status->tickStatus == 2) {
            $result = 'تحت المعالحة';
        } elseif ($status->tickStatus == 3) {
            $result = 'تمت المعالجة';
        } elseif ($status->tickStatus == 4) {
            $result = 'مغلقة';
        }

        return response($result, 200)->header('Content-Type', 'application/json');
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
            //$ticket = Ticket::findorFail($id);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/getTicket/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);

            // dd(json_decode($response));

            //$tickets = array();
            $results = json_decode($response);
            $ticket = new Ticket();
            $ticket->id = $results->id;
            $ticket->orgID = $results->orgID;
            $ticket->userID = $results->userID;
            $ticket->title = $results->title;

            $ticket->details = $results->details;
            $ticket->tickStatus = $results->tickStatus;
            $ticket->created_at = $results->created_at;

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://admin.evix.com.sa/api/getCommentsByID/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response2 = curl_exec($curl);

            $jsonResult = json_decode($response2);
            $comments = [];
            foreach ($jsonResult as $item) {
                $comment = new TickHistory();

                $comment->tickID = $item->tickID;
                $comment->comment = $item->comment;
                $comment->image = $item->image;
                $comment->owner = $item->owner;
                $comment->ownerID = $item->ownerID;
                $comment->created_at = $item->created_at;

                array_push($comments, $comment);
            }

            return view('admin.tickets.show')->with('ticket', $ticket)->with('comments', $comments);
        } catch (\Exception $e) {
            return back();
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
        $role = Role::findorFail($id);
        return view('admin.roles.edit')->with('role', $role);
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
            $ticket = Ticket::findorFail($id);

            $ticket->teamComment = $request->teamComment;
            $ticket->tickStatus = $request->tickStatus;
            $ticket->teamID = auth()->user()->id;
            if ($request->tickStatus == 3) {
                $ticket->solveDate = Carbon::now();
            }
            $ticket->save();

            session()->flash('success', trans('Dadhoard.Updatedsuccessfully'));

            return redirect(route('tickets.index'));
        } catch (\Exception $e) {
            return back();
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
            $role = Role::findorFail($id);

            //then Delete Role
            $role->status = 5;
            $role->save();
            session()->flash('success', trans('Dadhoard.Deletedsuccessfully'));
            return redirect(route('roles.index'));
        } catch (\Exception $e) {
            return back();
        }
    }
}
