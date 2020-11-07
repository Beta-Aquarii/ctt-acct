<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\User;
use App\Helpers\Tour;
use App\Helpers\TourPaxes;
use App\Helpers\TourPeak;
use App\Helpers\Activity;
use App\Helpers\Agent;
use App\Helpers\AgentContact;
use Carbon;
use Auth;
use DB;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){   
       $this->middleware('auth');

    }

    public function index()
    {
        
    }

   public function getFilterSearch(Request $request){

        $act = $request->input('act');
        $var = $request->input('type');
        $fs = $request->input('fs');

        if($var === "tours"){

            if($act === "search"){
                $result = Tour::where('name','like','%'.$fs.'%')->where('status',0)->get();
            }else{
                $result = Tour::where('code',$fs)->where('status',0)->get();
            }

            return view('ajax.tours_result', compact('result'));

        }elseif($var === "agents"){

            if($act === "search"){
                //$result = Agent::where('name','like','%'.$fs.'%')->where('status',0)->get();
                $result = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
                    ->select('agents.id','agents.name','agents.nature',DB::raw('count(agents_contact.agent) as aCount'))
                    ->groupBy('agents.id')
                    ->where('agents.name','like','%'.$fs.'%')
                    ->where('agents.status',0)
                    ->get();
            }else{
                $result = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
                    ->select('agents.id','agents.name','agents.nature',DB::raw('count(agents_contact.agent) as aCount'))
                    ->groupBy('agents.id')
                    ->where('agents.nature',$fs)
                    ->where('agents.status',0)
                    ->get();
            }

            return view('ajax.agents_result', compact('result'));

        }elseif($var === "users"){

            if($act === "search"){
                $result = User::where('name','like','%'.$fs.'%')->where('status',0)->get();
            }else{
                if($fs === "admin"){
                    $level = "isAdmin";
                }elseif($fs === "reservation"){
                    $level = "isReservation";
                }elseif($fs === "accounting"){
                    $level = "isAccounting";
                }else{
                    $level = "isAgent";
                }

                $result = User::where($level,$fs)->where('status',0)->get();
            }

            $count = count($result);

            return view('ajax.users_result', compact('result','count'));

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
