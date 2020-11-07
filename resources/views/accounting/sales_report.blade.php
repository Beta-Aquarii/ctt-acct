@extends('layouts.accounting')

@section('title')
	Sales Report | Accounting
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
		.sr-total-div{
			background:#dddddd !important;
		}
		h3{
			margin-top:0 !important;
			margin-bottom:0 !important;
			color:black !important;
		}
	</style>
	<div class="header-title text-center">
		<h2>Sales Report</h2>
	</div>
	<div class="col-xs-12 form-div">
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-calendar-check-o"></i></span>
					<input type="text" class="form-control search-value sr-date sr-start" data-var="tours" placeholder="Start Date" value="{{$dispNow}}">
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-calendar-times-o"></i></span>
					<input type="text" class="form-control search-value sr-date sr-end" data-var="tours" placeholder="End Date" value="{{$dispNow}}">
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-4 text-right">
			<button type="button" class="btn btn-dark-2 btn-lg btn-block sr-generate">
		    	<i class="fa fa-retweet white"></i> Generate Report
		  	</button>
		</div>

		<input type="hidden" value="{{csrf_token()}}" name="deleteToken">	
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
						$sr_total = 0;
					@endphp
					@foreach($si as $s)
						@php
							$_created = Carbon\Carbon::parse($s->created_at);
		                    $created = $_created->toDateString();
		                    $dispCreated = $_created->format('F d Y');
		                    $time = $_created->format('h:i:s A');
		                    $_pTime = Carbon\Carbon::parse($s->time);
		                    $pickup_time = $_pTime->format('h:i:s A');
		                    $count++;
		                    $comm = 0;
						@endphp
						<tr>
							<td><span class="label-table label-inherit">{{$s->sales_invoice}}</span></td>
							<td><span class="label-table label-inherit">{{$s->lead_guest}}</span></td>
							<td>
								@foreach($sip as $particular)
									@if($particular->si_id == $s->id)
										<span class="label label-info">{{$particular->particular}}</span>
										@php
											$comm += $particular->commission;
										@endphp
									@endif
								@endforeach
							</td>
							@foreach($sia as $agent)
								@if($agent->si_id == $s->id)
									<td><span class="label-table label-inherit">{{$agent->name}}</span></td>
								@endif
							@endforeach
							@php
								$net = $s->total - $comm;
								$sr_total += $net;
							@endphp
							<td><span class="label-table label-inherit">{{$s->reservation_officer}}</span></td>
							<td><span class="label-table label-inherit">{{$dispCreated}}</span></td>
							<td><span class="label bg-si-pickup-time">{{number_format($net, 2, '.', ',')}}</span></td>
							<td class="text-center vertical-middle row-pad accounting-verify narture-border">
				  				<a href="{{url('accounting/check-soa').'/'.$s->id}}"><span class="white text-bold size-m"><i class="fa fa-search white"></i></span>
				  			</td>
						</tr>
					@endforeach
				</tbody>
					@php
						$vat = ($sr_total / 1.12) * .12;
						$sr_vatable = $sr_total - $vat;
					@endphp
				<tfoot>
					<tr>
						<td class="sr-total-div"></td>
						<td class="text-center sr-total-div" colspan="2">
							<span class="label-table label-inherit">Total Net Sales</span><br>
							<h3>{{number_format($sr_total, 2, '.', ',')}}</h3>
						</td>
						<td class="text-center sr-total-div" colspan="2">
							<span class="label-table label-inherit">VAT</span><br>
							<h3>{{number_format($vat, 2, '.', ',')}}</h3>
						</td>
						<td class="text-center sr-total-div" colspan="3">
							<span class="label-table label-inherit">Total Vatable Sales</span><br>
							<h3>{{number_format($sr_vatable, 2, '.', ',')}}</h3>
						</td>
					</tr>
				</tfoot>
			</table>
			<a href="{{url('accounting/print-sales-report').'/'.$dispNow.'/'.$dispNow}}" class="btn btn-green btn-block"><i class="fa fa-window-restore"></i> Print / Download</a>
		</div>	

@endsection

@section('js')

@endsection