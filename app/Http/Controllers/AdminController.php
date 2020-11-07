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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {   
       $this->middleware('auth');
    }

    public function index(){
        
        $activities =  Activity::where('user',Auth::user()->name)->orderBy('created_at','desc')->simplePaginate(10);

    	return view('home', compact('activities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUsers(){

        $users = User::where('status',0)->get();

        return view('users.users', compact('users'));

    }

    public function getAddUser(){

        return view('users.add_user');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddUser(Request $request){

        $input = $request->all();

        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
            
            if ($validator->fails()) {
                return redirect('register/create')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                
                $password = bcrypt($input['password']);
                
                $user = new User;

                $user->name = $input['name'];
                $user->username = $input['username'];
                $user->email = $input['email'];
                $user->password = $password;
                $user->isAdmin = 0;
                $user->status = 0;
                $user->save();

                $this->insertActivity('added', 'users', $input['name']);
                    
                return redirect('/admin');
            }
    }

    public function getAgents(){

        $agents = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
            ->select('agents.id','agents.name','agents.nature',DB::raw('count(agents_contact.agent) as aCount'))
            ->groupBy('agents.id')
            ->where('agents.status',0)->simplePaginate(16);
        $natures = Agent::where('status',0)->groupBy('nature')->pluck('nature');

        return view('tour_manager.agents.agents',compact('agents','natures'));

    }

    public function getTours(){

    	$tours = Tour::where('status',0)->get();
        $codes = Tour::where('status',0)->groupBy('code')->pluck('code');

    	return view('tour_manager.tour.tours',compact('tours','codes'));
    }

    public function getAddTour(){
    	return view('tour_manager.tour.add_tour');
    }

    public function postAddTour(Request $request){

    	$input = $request->all();

    	$tour = new Tour;

    	$tour->name = $input['name'];
    	$tour->type = $input['type'];
    	$tour->code = $input['code'];
    	$tour->duration = $input['duration'];
    	$tour->lead_time = $input['lead_time'];
    	$tour->min_pax = $input['min_pax'];
    	$tour->foreign_rate = $input['foreign_rate'];
    	$tour->description = $input['description'];
    	$tour->inclusions = $input['inclusions'];
    	$tour->highlights = $input['highlights'];
    	$tour->pick_up = $input['pickup'];
    	$tour->status = 0;
    	$tour->save();

    	$this->insertTourPax($tour->id, $input['w_pax'], $input['w_amount'], $input['wo_amount'],$input['pax_id']);
    	$this->insertTourPeak($tour->id, $input['peak_from'], $input['peak_to'], $input['peak_type'], $input['peak_amount'],$input['peak_id']);
        $this->insertActivity('added', 'tours', $input['name']);

        return redirect('admin/tours');


    }

    public function getEditTour($id){

        $tour = Tour::where('id',$id)->get();
        $tour_pax = TourPaxes::where('tour',$id)->get();
        $tour_peak = TourPeak::where('tour',$id)->get();

        return view('tour_manager.tour.edit_tour', compact('tour','tour_pax','tour_peak'));

    }

    public function postEditTour($id, Request $request){

        $tour = Tour::find($id);
        $input = $request->all();

        $tour->name = $input['name'];
        $tour->type = $input['type'];
        $tour->code = $input['code'];
        $tour->duration = $input['duration'];
        $tour->lead_time = $input['lead_time'];
        $tour->min_pax = $input['min_pax'];
        $tour->foreign_rate = $input['foreign_rate'];
        $tour->description = $input['description'];
        $tour->inclusions = $input['inclusions'];
        $tour->highlights = $input['highlights'];
        $tour->pick_up = $input['pickup'];
        $tour->save();

        $this->insertTourPax($tour->id, $input['w_pax'], $input['w_amount'], $input['wo_amount'],$input['pax_id']);
        $this->insertTourPeak($tour->id, $input['peak_from'], $input['peak_to'], $input['peak_type'], $input['peak_amount'],$input['peak_id']);
        $this->insertActivity('updated', 'tours', $input['name']);

        return redirect('admin/tours');

    }

    public function getAddAgent(){

        return view('tour_manager.agents.add_agent');
    }

    public function postAddAgent(Request $request){

        $input = $request->all();

        $agent = new Agent;
        $agent->name = $input['name'];
        $agent->nature = $input['nature'];
        $agent->address = $input['address'];
        $agent->tin = $input['tin'];
        $agent->contract_rate = $input['contract_rate'];
        $agent->payment_terms = $input['payment_terms'];
        $agent->status = 0;
        $agent->save();

        $this->insertActivity('added', 'agents', $input['name']);
        $this->insertAgentContact($agent->id, $input['contact_name'], $input['contact_designation'], $input['contact_email'], $input['contact_number'], $agent->name, $input['contact_id']);

        return redirect('admin/agents');

    }

    public function getEditAgent($id){

        $agent = Agent::where('id',$id)->get();
        $contacts = AgentContact::where('agent',$id)->where('status',0)->get();

        return view('tour_manager.agents.edit_agent',compact('agent','contacts'));

    }

    public function postEditAgent($id,Request $request){

        $agent = Agent::find($id);

        $input = $request->all();

        $agent = Agent::find($id);
        $agent->name = $input['name'];
        $agent->nature = $input['nature'];
        $agent->address = $input['address'];
        $agent->tin = $input['tin'];
        $agent->contract_rate = $input['contract_rate'];
        $agent->payment_terms = $input['payment_terms'];
        $agent->notes = $input['notes'];
        $agent->status = 0;
        $agent->save();

        $this->insertActivity('updated', 'agents', $input['name']);
        $this->insertAgentContact($agent->id, $input['contact_name'], $input['contact_designation'], $input['contact_email'], $input['contact_number'], $agent->name, $input['contact_id']);

        return redirect('admin/agents');

    }

    public function insertAgentContact($agent,$name,$designation,$email,$contact,$agent_name,$agent_id){


        foreach($name as $k => $v){

            if($name[$k] != NULL || $email[$k] != NULL){

                $content = 'Contact '.$name[$k].' to '.$agent_name;
                $a = AgentContact::firstOrNew(['id' => $agent_id[$k]]);

                $a->agent = $agent;
                $a->name = $name[$k];
                $a->designation = $designation[$k];
                $a->email = $email[$k];
                $a->contact_number = $contact[$k];
                $a->status = 0;
                $a->save();

                if($agent_id[$k] == 0){
                    $this->insertActivity('added', 'agent contacts', $content);
                }else{
                    $this->insertActivity('updated', 'agent contacts', $content);
                }
                
            }

        }


    }

	public function insertTourPax($tour,$pax,$with_guide,$without_guide,$pId)    {

		foreach($pax as $k => $v){

			$i = TourPaxes::firstOrNew(['id' => $pId[$k]],['pax' => $pax[$k]]);
			$i->tour = $tour;
    		$i->with_guide = $with_guide[$k];
    		$i->without_guide = $without_guide[$k];
    		$i->pax = $pax[$k];
    		$i->save();

		}

	}

	public function insertTourPeak($tour,$from,$to,$type,$amount,$pId){

		foreach($from as $k => $v){

			if($from[$k] != NULL || $to[$k] != NULL){
				$i = TourPeak::firstOrNew(['id' => $pId[$k]], ['from' => $from[$k]], ['to' => $to[$k]]);
				$i->tour = $tour;
				$i->from = $from[$k];
				$i->to = $to[$k];
				$i->type = $type[$k];
				$i->amount = $amount[$k];
				$i->save();
			}

		}

	}

    public function updateTourPeak($tour,$from,$to,$type,$amount){

        foreach($from as $k => $v){

            if($from[$k] != NULL || $to[$k] != NULL){
                $i = TourPeak::firstOrNew(['id' => $tour[$k]], ['from' => $from[$k]], ['to' => $to[$k]]);
                $i->from = $from[$k];
                $i->to = $to[$k];
                $i->type = $type[$k];
                $i->amount = $amount[$k];
                $i->save();
            }

        }

    }

    public function insertActivity($activity, $subject, $content){

        $act = New Activity;
        $act->user = Auth::user()->name;
        $act->activity = $activity;
        $act->content = $content;
        $act->subject = $subject;
        $act->save();

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

    public function delete(Request $request){

        $id = $request->input('id');
        $var = $request->input('var');
        $name = $request->input('name');

        if($var === "tours"){
            $table = Tour::find($id);
        }elseif($var === "agents"){
            $table = Agent::find($id);
        }elseif($var === "user"){
            $table = User::find($id);
        }

        $table->status = 1;
        $table->save();

        $this->insertActivity('deleted', $var, $name);

        return "success";

    }

    public function deleteconorpeak(Request $request){

        $id = $request->input('id');
        $check = $request->input('check');

        
        if($check === "contact"){
            $ac = AgentContact::find($id);
            $ac->status = 1;
            $ac->save();
        }else{
            $peak = TourPeak::where('id',$id)->delete();
        }

        return "success";


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
