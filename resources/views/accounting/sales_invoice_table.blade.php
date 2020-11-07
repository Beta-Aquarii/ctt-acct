@extends('layouts.accounting')

@section('title')
	Statement of Account | {{$soa_status}}
@endsection

@section('content')
	<style>
		.logo-div{
			padding-bottom:30px;
		}
		.form-control{
			color:black !important;
			font-weight: bold !important;
			font-size:15px !important;
			height:50px !important;
			font-family:-webkit-pictograph !important;
		}
		
		.field-form::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: black !important;
		  font-weight:bold !important;
		  font-size:15px;
		  text-transform: uppercase !important;
		}
		.form-control-price::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: black !important;
		  font-weight:bold !important;
		  font-size:10px !important;
		  text-transform: uppercase !important;
		}
		.field-form::-moz-placeholder { /* Firefox 19+ */
		  	 color: black !important;
			  font-weight:bold !important;
			  font-size:15px;
			  text-transform: uppercase !important;
		}
		.field-form:-ms-input-placeholder { /* IE 10+ */
		  	 color: black !important;
			  font-weight:bold !important;
			  font-size:15px;
			  text-transform: uppercase !important;
		}
		.field-form:-moz-placeholder { /* Firefox 18- */
		  	 color: black !important;
			  font-weight:bold !important;
			  font-size:15px;
			  text-transform: uppercase !important;
		}
		
		.form-div{
			top: 20px;
		}
		h2{
			color:black;
			font-weight:bold;
		}
		.table-condensed>tbody>tr>td,
		.table-condensed>tbody>tr>th, 
		.table-condensed>tfoot>tr>td,
		.table-condensed>tfoot>tr>th{
			padding:20px !important;
		}
		.table-condensed>tbody>tr>td,
		.table-condensed>tbody>tr>th{
			vertical-align: middle;
		}
		.table-condensed>thead>tr>td, 
		.table-condensed>thead>tr>th{
			padding-left:20px;
			padding-right: 20px;
			padding-top:10px;
		}
		.table>thead>tr>th {
		    vertical-align: bottom;
		    border-bottom: 2px solid #525252;
		}
		.table{
			    background-color: #00000008 !important;
		}
		.table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{
			border-color: #52525266 !important;
		}
		.header-title{
		    padding-top: 15px;
    		padding-bottom: 2px;
    		background: #dddddd;
		}
	</style>
	<div class="header-title text-center">
		<h2>{{$soa_status}} SOA</h2>
		<input type="hidden" value="{{$soa_status}}" name="search_filter_status" class="search-filter-status">
	</div>
	<div class="col-xs-12 form-div">
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="form-group">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					@if($soa_status === "Pending")
				  		<div class="btn-group" role="group">
				  			<a href="{{url('accounting/statement-of-account')}}" class="btn btn-dark-2-yellow btn-lg"><i class="fa fa-th-large"></i> Grid</a>
					  	</div>
					  	<a href="{{url('accounting/statement-of-account/table')}}" class="btn btn-dark-2-yellow btn-lg"><i class="fa fa-table"></i> Table</a>
					@else
						<div class="btn-group" role="group">
				  			<a href="{{url('accounting/statement-of-account/verified')}}" class="btn btn-dark-2-yellow btn-lg"><i class="fa fa-th-large"></i> Grid</a>
					  	</div>
					  	<a href="{{url('accounting/statement-of-account/table/verified')}}" class="btn btn-dark-2-yellow btn-lg"><i class="fa fa-table"></i> Table</a>
					@endif
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control search-value" data-var="tours" placeholder="Search">
					<span class="input-group-btn">
					    <div class="btn-group" role="group">
							<button type="button" class="btn btn-dark-2 btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    	Search <span class="caret"></span>
						  	</button>
							<ul class="dropdown-menu bg-dark">
								<li role="separator" class="divider"></li>
						   		<li class="text-center"><a href="#" class="tour-code-black white filter-si-table-acc text-bold" data-filtval="si"><i class="fa fa-star orange"></i> SI #</a></li>
						   		<li role="separator" class="divider"></li>  
						   		<li class="text-center"><a href="#" class="tour-code-black white filter-si-table-acc text-bold" data-filtval="date"><i class="fa fa-calendar blue"></i> Date</a></li>
						   		<li role="separator" class="divider"></li>
								<li class="text-center"><a href="#" class="tour-code-black white filter-si-table-acc text-bold" data-filtval="guest"><i class="fa fa-user green"></i> Guest</a></li>
						   		<li role="separator" class="divider"></li>
							</ul>
					  	</div>
				    </span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-3 text-right">
		
		  <div class="btn-group btn-group-justified" role="group" aria-label="...">
			  	<div class="btn-group" role="group">
					<button type="button" class="btn btn-dark-2 btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Rows <span class="caret"></span>
				  	</button>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="text-bold filter-si-table-row-acc si-options" data-act="filter" data-filtval="15">Default</a></li>
						<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="text-bold filter-si-table-row-acc si-options" data-act="filter" data-filtval="30">30</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="text-bold filter-si-table-row-acc si-options" data-act="filter" data-filtval="45">45</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="text-bold filter-si-table-row-acc si-options" data-act="filter" data-filtval="60">60</a></li>
				   		<li role="separator" class="divider"></li>
					</ul>
			  	</div>
			</div>

		</div>
		<input type="hidden" value="{{csrf_token()}}" name="deleteToken">
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 text-center">
			<span class="label label-info text-bold size-15">Pending</span>
			<span class="label label-primary text-bold size-15">Verified</span>
			<span class="label bg-si-contact text-bold size-15">Complete</span>
		</div>
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 searchResult">
			<table class="table table-striped table-hover table-condensed table-responsive">
				<thead>
					<tr>
						<th><span class="text-bold black">SI#</span></span></th>
						<th><span class="text-bold black">Guest</span></th>
						<th><span class="text-bold black">Particular</span></th>
						<th><span class="text-bold black">Agent</span></th>
						<th><span class="text-bold black">Reservation</span></th>
						<th><span class="text-bold black">Booking</span></th>
						<th><span class="text-bold black">Total</span></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@php
						$count = 0;
					@endphp
					@foreach($si as $s)
						@php
							$_created = Carbon\Carbon::parse($s->created_at);
		                    $created = $_created->toDateString();
		                    $dispCreated = $_created->format('F d Y');
		                    $time = $_created->format('h:i:s A');
		                    $_pTime = Carbon\Carbon::parse($s->time);
		                    $pickup_time = $_pTime->format('h:i:s A');
		                    $count++
						@endphp
						<tr>
							<td><span class="label-table label-inherit">{{$s->sales_invoice}}</span></td>
							<td><span class="label-table label-inherit">{{$s->lead_guest}}</span></td>
							<td>
								@foreach($sip as $particular)
									@if($particular->si_id == $s->id)
										<span class="label label-info">{{$particular->particular}}</span>
									@endif
								@endforeach
							</td>
							@foreach($sia as $agent)
								@if($agent->si_id == $s->id)
									<td><span class="label-table label-inherit">{{$agent->name}}</span></td>
								@endif
							@endforeach
							<td><span class="label-table label-inherit">{{$s->reservation_officer}}</span></td>
							<td><span class="label-table label-inherit">{{$dispCreated}}</span></td>
							<td><span class="label bg-si-pickup-time">{{number_format($s->total, 2, '.', ',')}}</span></td>
							<td class="text-center vertical-middle row-pad accounting-verify narture-border" data-toggle="tooltip" data-placement="top" title="Update {{$s->sales_invoice}}">
				  				<a href="{{url('accounting/check-soa').'/'.$s->id}}"><span class="white text-bold size-m"><i class="fa fa-pencil white"></i></span>
				  			</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
		<div class="col-xs-12 text-center">
			{{	$si->links()	}}
		</div>

@endsection

@section('js')

@endsection