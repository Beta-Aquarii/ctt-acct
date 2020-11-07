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
use App\Helpers\SalesInvoice;
use App\Helpers\SalesInvoiceAgent;
use App\Helpers\SalesInvoiceParticular;
use Carbon;
use Auth;
use DB;

class ReservationController extends Controller
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
        $activities =  Activity::where('user',Auth::user()->name)->orderBy('created_at','desc')->simplePaginate(20);

        return view('reservation.dashboard', compact('activities'));
    }

    public function getSalesInvoice(){


        $si = SalesInvoice::orderBy('id','desc')->where('reservation_officer',Auth::user()->name)->simplePaginate(6);
        $sia = SalesInvoiceAgent::whereIn('status',['Pending','Verified'])->get();
        $sip = SalesInvoiceParticular::whereIn('status',['Pending','Verified'])->orderBy('tour_date','asc')->get();

        return view('reservation.sales_invoice',compact('si','sia','sip'));

    }

    public function getAddSalesInvoice(){

        
        $agents = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
            ->select('agents.id','agents.name','agents.nature','agents.payment_terms','agents.notes','agents.address','agents.tin',DB::raw('count(agents_contact.agent) as aCount'))
            ->groupBy('agents.id')
            ->inRandomOrder()
            ->take(5)
            ->where('agents.status',0)
            ->get();

        $tours = Tour::where('status',0)->inRandomOrder()->take(5)->get();

        return view('reservation.add_sales_invoice',compact('agents','tours'));

    }

    public function postAddSalesInvoice(Request $request){

        $_si = $request->all();

        $si = new SalesInvoice;
        $sia = new SalesInvoiceAgent;

        if(isset($_si['agent_booking_ref'])){
            $agent_booking_ref = $_si['agent_booking_ref'];
        }else{
            $agent_booking_ref = $this->createSI();
        }

        $si->reservation_officer = Auth::user()->name;
        $si->sales_invoice = $this->createSI();
        $si->booking_reference = $agent_booking_ref;
        $si->contact = $_si['contact'];
        $si->email = $_si['email'];
        $si->lead_guest = $_si['lead_guest'];
        $si->pickup = $_si['pick_up'];
        $si->time = $_si['time'];
        $si->note = $_si['note'];
        $si->total = $_si['overall'];
        $si->vat = 12;
        $si->status = "Pending";
        $si->save();

        $sia->si_id = $si->id;
        $sia->agent_id = $_si['agent_id'];
        $sia->name = $_si['agent_name'];
        $sia->address = $_si['agent_address'];
        $sia->tin = $_si['agent_tin'];
        //$sia->contract_rate = $_si['agent_contract'];
        $sia->payment_terms = $_si['agent_payment'];
        //$sia->notes = $_si['agent_note'];
        $sia->nature = $_si['agent_nature'];
        $sia->status = "Pending";
        $sia->save();

        $particular_name = $_si['particular_name'];
        $particular_id = $_si['particular_id'];
        $particular_type = $_si['particular_type'];
        $particular_booking_ref = $_si['particular_booking_ref'];
        $particular_date = $_si['particular_date'];
        $particular_com = $_si['particular_com'];
        $particular_local = $_si['particular_local'];
        $particular_foreign = $_si['particular_foreign'];
        $particular_guide = $_si['particular_guide'];
        $particular_total = $_si['particular_total'];
        $particular_rate = $_si['particular_rate'];
        $particular_total = $_si['particular_total'];
        $particular_guide = $_si['particular_guide'];

        foreach($particular_id as $k => $v){

            $sip = new SalesInvoiceParticular;
            $particular_foreign_rate = Tour::where('id',$particular_id[$k])->value('foreign_rate');

            if(isset($particular_booking_ref[$k])){
                $booking_reference = $particular_booking_ref[$k];
            }else{
                $booking_reference = $si->sales_invoice;
            }

            $sip->si_id = $si->id;
            $sip->lead_guest = $_si['lead_guest'];
            $sip->tour_date = $particular_date[$k];
            $sip->particular = $particular_name[$k];
            $sip->particular_id = $particular_id[$k];
            $sip->particular_type = $particular_type[$k];
            $sip->guide = $particular_guide[$k];
            $sip->pax = $particular_local[$k];
            $sip->foreign_pax = $particular_foreign[$k];
            $sip->rate = $particular_rate[$k];
            $sip->foreign_rate = $particular_foreign_rate;
            $sip->commission = $particular_com[$k];
            $sip->total = $particular_total[$k];
            $sip->booking_reference = $booking_reference;
            $sip->status = "Pending";
            $sip->save();

        }

        $this->insertActivity('added',"Sales Invoice",$si->sales_invoice);

        return redirect('/reservation/salesinvoice');

    }

    public function getEditSalesInvoice($id){

        $si = SalesInvoice::where('id',$id)->get();
        $sia = SalesInvoiceAgent::where('si_id',$id)->get();
        $sip = SalesInvoiceParticular::where('si_id',$id)->whereIn('status',['Pending','Verified'])->get();
        $sia_id = SalesInvoiceAgent::where('si_id',$id)->value('agent_id');
        $sia_count = AgentContact::where('agent',$sia_id)->where('status',0)->count();

        $agents = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
            ->select('agents.id','agents.name','agents.nature','agents.payment_terms','agents.notes','agents.address','agents.tin',DB::raw('count(agents_contact.agent) as aCount'))
            ->groupBy('agents.id')
            ->inRandomOrder()
            ->take(5)
            ->where('agents.status',0)
            ->get();

        $tours = Tour::where('status',0)->inRandomOrder()->take(5)->get();

        return view('reservation.edit_sales_invoice',compact('si','sia','sip','tours','agents','sia_count'));

    }

    public function postEditSalesInvoice(Request $request, $id){

        $_si = $request->all();

        $si = SalesInvoice::find($id);
        $si->contact = $_si['contact'];
        $si->email = $_si['email'];
        $si->lead_guest = $_si['lead_guest'];
        $si->pickup = $_si['pick_up'];
        $si->time = $_si['time'];
        $si->note = $_si['note'];
        $si->total = $_si['overall'];
        $si->vat = 12;
        $si->status = "Pending";
        $si->save();

        $sia = SalesInvoiceAgent::where('si_id', $si->id)->first();
        $sia->si_id = $si->id;
        $sia->agent_id = $_si['agent_id'];
        $sia->name = $_si['agent_name'];
        $sia->address = $_si['agent_address'];
        $sia->tin = $_si['agent_tin'];
        //$sia->contract_rate = $_si['agent_contract'];
        $sia->payment_terms = $_si['agent_payment'];
        $sia->nature = $_si['agent_nature'];
        //$sia->notes = $_si['agent_note'];
        $sia->save();

        $particular_name = $_si['particular_name'];
        $particular_id = $_si['particular_id'];
        $particular_type = $_si['particular_type'];
        $particular_booking_ref = $_si['particular_booking_ref'];
        $particular_date = $_si['particular_date'];
        $particular_com = $_si['particular_com'];
        $particular_local = $_si['particular_local'];
        $particular_foreign = $_si['particular_foreign'];
        $particular_guide = $_si['particular_guide'];
        $particular_total = $_si['particular_total'];
        $particular_rate = $_si['particular_rate'];
        $particular_total = $_si['particular_total'];
        $particular_guide = $_si['particular_guide'];
        $pId = $_si['pId'];

        foreach($particular_id as $k => $v){

            $sip = SalesInvoiceParticular::firstOrNew(['id' => $pId[$k]]);
            $particular_foreign_rate = Tour::where('id',$particular_id[$k])->value('foreign_rate');

            $sip->si_id = $si->id;
            $sip->lead_guest = $_si['lead_guest'];
            $sip->tour_date = $particular_date[$k];
            $sip->particular = $particular_name[$k];
            $sip->particular_id = $particular_id[$k];
            $sip->particular_type = $particular_type[$k];
            $sip->guide = $particular_guide[$k];
            $sip->pax = $particular_local[$k];
            $sip->foreign_pax = $particular_foreign[$k];
            $sip->rate = $particular_rate[$k];
            $sip->foreign_rate = $particular_foreign_rate;
            $sip->commission = $particular_com[$k];
            $sip->total = $particular_total[$k];
            $sip->booking_reference = $particular_booking_ref[$k];
            $sip->status = "Pending";
            $sip->save();

        }

        $this->insertActivity('updated',"Sales Invoice",$si->sales_invoice);

        return redirect('/reservation/salesinvoice');
 
    }

    public function getViewParticular($id){

        $tour = Tour::where('id',$id)->get();
        $tour_pax = TourPaxes::where('tour',$id)->get();
        $tour_peak = TourPeak::where('tour',$id)->get();

        return view('reservation.view_tour',compact('tour','tour_pax','tour_peak'));

    }

    public function getViewAgent($id){

        $agent = Agent::where('id',$id)->get();
        $contacts = AgentContact::where('agent',$id)->where('status',0)->get();

        return view('reservation.view_agent',compact('agent','contacts'));

    }

    public function getTours(){

        $tours = Tour::where('status',0)->get();
        $codes = Tour::where('status',0)->groupBy('code')->pluck('code');

        return view('reservation.tours',compact('tours','codes'));
    }

    public function getAgents(){

        $agents = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
            ->select('agents.id','agents.name','agents.nature',DB::raw('count(agents_contact.agent) as aCount'))
            ->groupBy('agents.id')
            ->where('agents.status',0)->simplePaginate(16);
        $natures = Agent::where('status',0)->groupBy('nature')->pluck('nature');

        return view('reservation.agents',compact('agents','natures'));

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

    public function getSiAgentSearch(Request $request){

        $search = $request->input('search');

        $result = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
                ->select('agents.id','agents.name','agents.nature','agents.payment_terms','agents.notes','agents.address','agents.tin',DB::raw('count(agents_contact.agent) as aCount'))
                ->groupBy('agents.id')
                ->where('agents.name','like','%'.$search.'%')
                ->where('agents.status',0)
                ->get();

        return view('ajax.si_agents_result',compact('result'));

    }

    public function getSiParticularSearch(Request $request){

        $search = $request->input('search');

        $result = Tour::where('name','like','%'.$search.'%')->where('status',0)->get();

        return view('ajax.si_particulars_result',compact('result'));

    }

    public function getSiAgentAdd(Request $request){


        $aId = $request->input('aId');

        if($aId != 0){
            $agent = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
                ->select('agents.id','agents.name','agents.nature','agents.payment_terms','agents.notes','agents.address','agents.tin',DB::raw('count(agents_contact.agent) as aCount'))
                ->groupBy('agents.id')
                ->where('agents.id',$aId)
                ->get();
        }else{
            $agent = "";
        }


        return view('ajax.si_add_agent',compact('agent'));
    }

   public function getSiParticularAdd(Request $request){

        $pId = $request->input('pId');
        $tour = Tour::where('id', $pId)->get();

        return view('ajax.si_add_particular',compact('tour'));

   }

   public function getSiParticularCalc(Request $request){

        $i = $request->all();
        $foreign = $request->input('foreign');
        $pax = $request->input('local') + $request->input('foreign');
        $guide = $request->input('guide');
        $pId = $request->input('pId');
        $_foreign = Tour::find($pId);
        $_date = Carbon\Carbon::parse($request->input('date'));
        $date = strtotime($_date->format('F d'));
        $peakToAdd = 0;

        $tour_peak = TourPeak::where('tour',$pId)->get();

        if($tour_peak){

            foreach($tour_peak as $tp){

                $_from = strtotime($tp->from);
                $_to = strtotime(($tp->to));

                if($date >= $_from && $date <= $_to){

                    $peakToAdd = $tp->amount;

                }

            }

        }

        if($guide === "with"){
            $rate = TourPaxes::where('tour',$pId)->where('pax',$pax)->value('with_guide');
        }else{
            $rate = TourPaxes::where('tour',$pId)->where('pax',$pax)->value('without_guide');    
        }
        
        $total = ($rate * $pax) + ($_foreign->foreign_rate * $foreign) + ($peakToAdd * $pax);
        $return = $rate + $peakToAdd;
        //$total = number_format($_total, 2, '.', ',');
        //$return = number_format($_return, 2, '.', ',');

        return json_encode(array('total' => $total, 'rate' => $return));

    }

    public function getFilterSiRow(Request $request){

        $row = $request->input('fs');
        $si = SalesInvoice::orderBy('id','desc')->where('reservation_officer',Auth::user()->name)->simplePaginate($row);
        $sia = SalesInvoiceAgent::whereIn('status',['Pending','Verified'])->get();
        $sip = SalesInvoiceParticular::whereIn('status',['Pending','Verified'])->orderBy('tour_date','asc')->get();

        return view('ajax.si_filter_row',compact('si','sia','sip'));

    }

    public function getSiSearch(Request $request){

        $search = $request->input('val');
        $fs = $request->input('fs');

        if($fs === "si"){
            $si = SalesInvoice::orderBy('id','desc')->where('sales_invoice','like','%'.$search.'%')->get();
            $data = "Sales Invoice #";
        }elseif($fs === "date"){
            $_date = Carbon\Carbon::parse($search);
            $date = $_date->toDateString();    
            $si = SalesInvoice::orderBy('id','desc')->where('created_at','like','%'.$date.'%')->get();
            $data = "Sales Invoice Date Created";
        }else{
            $si = SalesInvoice::orderBy('id','desc')->where('lead_guest','like','%'.$search.'%')->get();
            $data="Guest";
        }

        $sia = SalesInvoiceAgent::get();
        $sip = SalesInvoiceParticular::orderBy('tour_date','asc')->get();

        return view('ajax.si_search_results',compact('si','sip','sia','search','data'));

    }

    public function deleteParticularEdit(Request $request){

        $particular = SalesInvoiceParticular::find($request->input('id'));
        $particular_total = $particular->total;
        $particular->status = "Delete";
        $particular->save();

        $sales_invoice = SalesInvoice::find($particular->si_id);
        $sales_invoice->total = number_format($sales_invoice->total - $particular->total,2,'.','');
        $sales_invoice->save();

        $si = "SI # ". $request->input('name');

        $this->insertActivity('deleted',$request->input('si'),$si);

        return "success";

    }

    public function insertActivity($activity, $subject, $content){

        $act = New Activity;
        $act->user = Auth::user()->name;
        $act->activity = $activity;
        $act->content = $content;
        $act->subject = $subject;
        $act->save();

    }

    public function createSI(){

        $year = Carbon\Carbon::now()->year;
        $si_count = SalesInvoice::where('sales_invoice','like',$year.'%')->count();
        $number = $si_count+1;

        if($si_count < 10000){
            $si_number = str_pad($number, 4, "0", STR_PAD_LEFT);
            $sales_invoice = $year.'-'.$si_number;
        }else{
            $sales_invoice = $year.'-'.$number;
        }

        return $sales_invoice;

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
