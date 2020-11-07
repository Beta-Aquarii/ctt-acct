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
use PDF;
use App;

class AccountingController extends Controller
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
        $users = User::whereIn('level',[1,2])->pluck('name');
        $activities =  Activity::whereIn('user',$users)->whereIn('activity',['verified','added'])->orderBy('created_at','desc')->simplePaginate(20);

        return view('accounting.dashboard', compact('activities'));
    }

    public function getSalesInvoice(){


        $si = SalesInvoice::where('status','Pending')->orderBy('id','desc')->simplePaginate(6);
        $sia = SalesInvoiceAgent::where('status','Pending')->get();
        $sip = SalesInvoiceParticular::where('status','Pending')->orderBy('tour_date','asc')->get();
        $soa_status = "Pending";

        return view('accounting.sales_invoice',compact('si','sia','sip','soa_status'));

    }

    public function getSalesInvoiceVerified(){

        $si = SalesInvoice::where('status','Verified')->orderBy('id','desc')->simplePaginate(6);
        $sia = SalesInvoiceAgent::where('status','Verified')->get();
        $sip = SalesInvoiceParticular::where('status','Verified')->orderBy('tour_date','asc')->get();
        $soa_status = "Verified";

        return view('accounting.sales_invoice',compact('si','sia','sip','soa_status'));

    }

    public function getSalesInvoiceTable(){

        $si = SalesInvoice::where('status','Pending')->orderBy('id','desc')->simplePaginate(15);
        $sia = SalesInvoiceAgent::where('status','Pending')->get();
        $sip = SalesInvoiceParticular::where('status','Pending')->orderBy('tour_date','asc')->get();
        $soa_status = "Pending";

        return view('accounting.sales_invoice_table',compact('si','sia','sip','soa_status'));

    }

    public function getSalesInvoiceTableVerified(){

        $si = SalesInvoice::where('status','Verified')->orderBy('id','desc')->simplePaginate(15);
        $sia = SalesInvoiceAgent::where('status','Verified')->get();
        $sip = SalesInvoiceParticular::where('status','Verified')->orderBy('tour_date','asc')->get();
        $soa_status = "Verified";

        return view('accounting.sales_invoice_table',compact('si','sia','sip','soa_status'));

    }

    public function getCheckSi($id){

        $si = SalesInvoice::where('id',$id)->get();
        $sia = SalesInvoiceAgent::where('si_id',$id)->get();
        $sip = SalesInvoiceParticular::where('si_id',$id)->whereIn('status',['Pending','Verified'])->get();

        return view('accounting.check_sales_invoice',compact('si','sia','sip'));

    }

    public function postCheckSi($id, Request $request){

        $si = SalesInvoice::find($id);
        $si->status = "Verified";
        $si->save();

        $sia = SalesInvoiceAgent::where('si_id',$id)->get();
        $sip = SalesInvoiceParticular::where('si_id',$id)->whereIn('status',['Pending','Verified'])->get();

        foreach($sia as $sa){

            $sia_change = SalesInvoiceAgent::find($sa->id);
            $sia_change->status = "Verified";
            $sia_change->save();

        }

        foreach($sip as $sp){

            $sip_change = SalesInvoiceParticular::find($sp->id);
            $sip_change->status = "Verified";
            $sip_change->save();

        }

        return redirect('accounting/statement-of-account');

    }

    public function getSiSearch(Request $request){

        $search = $request->input('val');
        $fs = $request->input('fs');
        $stat = $request->input('stat');

        if($fs === "si"){
            $si = SalesInvoice::orderBy('id','desc')->where('sales_invoice','like','%'.$search.'%')->where('status',$stat)->get();
            $data = "Sales Invoice #";
        }elseif($fs === "date"){
            $_date = Carbon\Carbon::parse($search);
            $date = $_date->toDateString();    
            $si = SalesInvoice::orderBy('id','desc')->where('created_at','like','%'.$date.'%')->where('status',$stat)->get();
            $data = "Sales Invoice Date Created";
        }else{
            $si = SalesInvoice::orderBy('id','desc')->where('lead_guest','like','%'.$search.'%')->where('status',$stat)->get();
            $data="Guest";
        }

        $sia = SalesInvoiceAgent::get();
        $sip = SalesInvoiceParticular::orderBy('tour_date','asc')->where('status',$stat)->get();

        return view('ajax.si_search_results',compact('si','sip','sia','search','data'));

    }

    public function getSiSearchTable(Request $request){

        $search = $request->input('val');
        $fs = $request->input('fs');
        $stat = $request->input('stat');

        if($fs === "si"){
            $si = SalesInvoice::orderBy('id','desc')->where('sales_invoice','like','%'.$search.'%')->where('status',$stat)->get();
            $data = "Sales Invoice #";
        }elseif($fs === "date"){
            $_date = Carbon\Carbon::parse($search);
            $date = $_date->toDateString();    
            $si = SalesInvoice::orderBy('id','desc')->where('created_at','like','%'.$date.'%')->where('status',$stat)->get();
            $data = "Sales Invoice Date Created";
        }else{
            $si = SalesInvoice::orderBy('id','desc')->where('lead_guest','like','%'.$search.'%')->where('status',$stat)->get();
            $data="Guest";
        }

        $sia = SalesInvoiceAgent::get();
        $sip = SalesInvoiceParticular::orderBy('tour_date','asc')->where('status',$stat)->get();

        return view('ajax.si_filter_table_row',compact('si','sip','sia','search','data'));

    }

    public function getVerifySoa(Request $request){

        $id = $request->input('id');


        $si = SalesInvoice::find($id);
        $_si = $si->sales_invoice;
        $si->status = "Verified";
        $si->save();

        $sia = SalesInvoiceAgent::where('si_id',$id)->get();
        $sip = SalesInvoiceParticular::where('si_id',$id)->whereIn('status',['Pending','Verified'])->get();

        foreach($sia as $sa){

            $sia_change = SalesInvoiceAgent::find($sa->id);
            $sia_change->status = "Verified";
            $sia_change->save();

        }

        foreach($sip as $sp){

            $sip_change = SalesInvoiceParticular::find($sp->id);
            $sip_change->status = "Verified";
            $sip_change->save();

        }

        $this->insertActivity('verified','SOA',$_si);
        
        return "success";

    }

    public function getSalesReport(){

        $_now = Carbon\Carbon::today();
        $now = $_now->toDateString();
        $dispNow = $_now->format('M d Y');

        $si = SalesInvoice::where('created_at','like',$now.'%')->get();
        $si_ids = SalesInvoice::where('created_at','like',$now.'%')->pluck('id');
        $sia = SalesInvoiceAgent::whereIn('si_id',$si_ids)->get();
        $sip = SalesInvoiceParticular::whereIn('si_id',$si_ids)->whereIn('status',['Pending','Verified'])->get();

        return view('accounting.sales_report',compact('si','sia','sip','dispNow'));

    }

    public function getSalesReportDate(Request $request){
        
        $s = $request->input('s_date');
        $e = $request->input('e_date');

        $_start = Carbon\Carbon::parse($s);
        $_end = Carbon\Carbon::parse($e);

        $start = $_start->toDateString();
        $end = $_end->toDateString();

        $start_date = $_start->format('M d Y');
        $end_date = $_end->format('M d Y');

        $si = SalesInvoice::whereBetween('created_at',[$start." 00:00:00",$end." 23:59:59"])->get();
        $si_ids = SalesInvoice::whereBetween('created_at',[$start." 00:00:00",$end." 23:59:59"])->pluck('id');
        $sia = SalesInvoiceAgent::whereIn('si_id',$si_ids)->get();
        $sip = SalesInvoiceParticular::whereIn('si_id',$si_ids)->whereIn('status',['Pending','Verified'])->get();

        return view('ajax.sales_report',compact('si','sia','sip','start_date','end_date'));

    }

    public function getFilterSiRow(Request $request){

        $row = $request->input('fs');
        $stat = $request->input('stat');
        $si = SalesInvoice::orderBy('id','desc')->where('status',$stat)->simplePaginate($row);
        $sia = SalesInvoiceAgent::where('status',$stat)->get();
        $sip = SalesInvoiceParticular::where('status',$stat)->orderBy('tour_date','asc')->get();

        return view('ajax.si_filter_row_acc',compact('si','sia','sip'));

    }

    public function getFilterSiTableRow(Request $request){

        $row = $request->input('fs');
        $stat = $request->input('stat');
        $si = SalesInvoice::orderBy('id','desc')->where('status',$stat)->simplePaginate($row);
        $sia = SalesInvoiceAgent::where('status',$stat)->get();
        $sip = SalesInvoiceParticular::where('status',$stat)->orderBy('tour_date','asc')->get();

        return view('ajax.si_filter_table_row',compact('si','sia','sip'));

    }

    public function getViewParticular($id){

        $tour = Tour::where('id',$id)->get();
        $tour_pax = TourPaxes::where('tour',$id)->get();
        $tour_peak = TourPeak::where('tour',$id)->get();

        return view('accounting.view_tour',compact('tour','tour_pax','tour_peak'));

    }

    public function getViewAgent($id){

        $agent = Agent::where('id',$id)->get();
        $contacts = AgentContact::where('agent',$id)->where('status',0)->get();

        return view('accounting.view_agent',compact('agent','contacts'));

    }

    public function getTours(){

        $tours = Tour::where('status',0)->get();
        $codes = Tour::where('status',0)->groupBy('code')->pluck('code');

        return view('accounting.tours',compact('tours','codes'));
    }

    public function getAgents(){

        $agents = Agent::join('agents_contact','agents.id','=','agents_contact.agent')
            ->select('agents.id','agents.name','agents.nature',DB::raw('count(agents_contact.agent) as aCount'))
            ->groupBy('agents.id')
            ->where('agents.status',0)->simplePaginate(16);
        $natures = Agent::where('status',0)->groupBy('nature')->pluck('nature');

        return view('accounting.agents',compact('agents','natures'));

    }

    public function getPrint($id){

        $si = SalesInvoice::where('id',$id)->get();
        $sia = SalesInvoiceAgent::where('si_id',$id)->get();
        $sip = SalesInvoiceParticular::where('si_id',$id)->whereIn('status',['Pending','Verified'])->get();
        $_siNum = SalesInvoice::where('id',$id)->first();
        $siNum = $_siNum->sales_invoice;

        $data = array(
            'si' => $si,
            'sia' => $sia,
            'sip' => $sip,
            'siNum' => $siNum
            );

        $pdf = PDF::loadView('accounting.print_soa', $data)->setPaper('a4', 'landscape')->stream($siNum.'.pdf',$data);

        return $pdf;

    }

     public function getPrintSalesReport($s,$e){

        $_start = Carbon\Carbon::parse($s);
        $_end = Carbon\Carbon::parse($e);

        $start = $_start->toDateString();
        $end = $_end->toDateString();

        $start_date = $_start->toFormattedDateString();
        $end_date = $_end->toFormattedDateString();

        $si = SalesInvoice::whereBetween('created_at',[$start." 00:00:00",$end." 23:59:59"])->get();
        $si_ids = SalesInvoice::whereBetween('created_at',[$start." 00:00:00",$end." 23:59:59"])->pluck('id');
        $sia = SalesInvoiceAgent::whereIn('si_id',$si_ids)->get();
        $sip = SalesInvoiceParticular::whereIn('si_id',$si_ids)->whereIn('status',['Pending','Verified'])->get();

        $data = array(
            'si' => $si,
            'sia' => $sia,
            'sip' => $sip,
            'start_date' => $start_date,
            'end_date' => $end_date
            );

        $pdf = PDF::loadView('accounting.sr_print', $data)->setPaper('a4', 'landscape')->stream('Sales Report '.$start_date.'-'.$end_date.'.pdf',$data);

        return $pdf;

    }

    public function insertActivity($activity, $subject, $content){

        $act = New Activity;
        $act->user = Auth::user()->name;
        $act->activity = $activity;
        $act->content = $content;
        $act->subject = $subject;
        $act->save();

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
