@extends('layouts.accounting')

@foreach($si as $s)

@section('title')
	Sales Invoice | Cebu Trip Tours
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
			top: 60px;
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
		.text-transform-reset{
			text-transform: unset !important;
		}
	</style>
	<form action="" method="post">
		{{ csrf_field() }}
		<div class="col-xs-12 form-div">
			<div class="col-xs-12 col-sm-12 col-md-4">
				@php
					$_created = Carbon\Carbon::parse($s->created_at);
	                $created = $_created->toDateString();
	                $dispCreated = $_created->format('F d Y');
	                $time = $_created->format('h:i:s A');
	                $_pTime = Carbon\Carbon::parse($s->time);
	                $pickup_time = $_pTime->format('h:i:s A');
	                $total = 0;
	                $net = 0;
				@endphp
				<div class="panel panel-default">
				  	<div class="panel-heading text-center bg-dark">
				  		<span class="text-bold white size-15 upper-case">Sales Invoice</span>
				  	</div>
				  	<div class="panel-body">
				  		<div class="text-center margin-bottom-p15">
						<span class="text-bold black size-25">{{$s->sales_invoice}}</span><br>
							<span class="label label-info text-bold">{{$s->reservation_officer}}</span>
							<span class="label label-primary text-bold">{{$s->booking_reference}}</span>
							<span class="label bg-si-contact text-bold">{{$dispCreated}}</span>
					  	</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="panel panel-default">
				  	<div class="panel-heading text-center bg-dark">
				  		<span class="text-bold white size-15 upper-case">Guest</span>
				  	</div>
				  	<div class="panel-body">
				  		<div class="text-center margin-bottom-p15">
						<span class="text-bold black size-25">{{$s->lead_guest}}</span><br>
							<span class="label bg-si-pickup-time text-bold">{{$s->email}}</span>
							<span class="label bg-si-email text-bold">{{$s->contact}}</span>
					  	</div>
					</div>
				</div>
			</div>
			@foreach($sia as $agent)
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="panel panel-default">
					  	<div class="panel-heading text-center bg-dark">
					  		<span class="text-bold white size-15 upper-case">Agent</span>
					  	</div>
					  	<div class="panel-body">
					  		<div class="text-center margin-bottom-p15">
							<span class="text-bold black size-25">{{$agent->name}}</span><br>
								<span class="label bg-si-pickup text-bold">{{$agent->tin}}</span>
								<span class="label label-success text-bold">{{$agent->address}}</span>
						  	</div>
						</div>
					</div>
				</div>
			@endforeach

			<div class="col-xs-12 content-lower"></div>
			<div class="col-xs-12">
				<table class="table table-striped table-hover table-condensed table-bordered table-responsive">
					<thead>
						<tr>
							<th><span class="text-bold black upper-case">Date</span></span></th>
							<th><span class="text-bold black upper-case">Particular</span></th>
							<th><span class="text-bold black upper-case">Rate</span></th>
							<th><span class="text-bold black upper-case">Pax</span></th>
							<th><span class="text-bold black upper-case">Total</span></th>
							<th><span class="text-bold black upper-case">Commission</span></th>
							<th><span class="text-bold black upper-case">Net</span></th>
							<th><span class="text-bold black upper-case">Instruction</span></th>
						</tr>
					</thead>
					<tbody>
						@foreach($sip as $sip)
							<tr>
								<td><span class="label-table label-inherit upper-case">{{$sip->tour_date}}</span></td>
								<td><span class="label-table label-inherit upper-case">{{$sip->particular}}</span></td>
								<td>
									<span class="label-table label-inherit">{{number_format($sip->rate, 2, '.', ',')}}</span>
									@if($sip->foreign_rate)
										<?php $foreign_rate = $sip->rate + $sip->foreign_rate; ?>
										<br>
										<span class="label-table label-inherit">{{number_format($foreign_rate, 2, '.', ',')}}</span>
									@endif
								</td>
								<td>
									@if($sip->pax)
										<span class="label-table label-inherit">{{$sip->pax}} <span class="red">LCL</span></span>
									@endif
									@if($sip->foreign_pax)
										<br>
										<span class="label-table label-inherit">{{$sip->foreign_pax}} <span class="red">FOR</span></span>
									@endif
								</td>
								<td><span class="label-table label-inherit">{{number_format($sip->total, 2, '.', ',')}}</span></td>
								<td>
									@if($sip->commission)
										<span class="label-table label-inherit">{{number_format($sip->commission, 2, '.', ',')}}</span>
									@endif
								</td>
								<?php $net_amount = $sip->total - $sip->commission; ?>
								<td><span class="label-table label-inherit">{{number_format($net_amount, 2, '.', ',')}}</span></td>
								<td></td>
							</tr>
							@php
								$total = $total + $net_amount;
							@endphp
						@endforeach
						@php
							$vat = ($total / 1.12) * .12;
						@endphp
						<tr>
							<td colspan="7"><span class="label-table label-inherit black upper-case">Total</span></td>
							<td colspan="7"><span class="label-table label-inherit black">{{number_format($total, 2, '.', ',')}}</span></td>
						</tr>
						<tr>
							<td colspan="7"><span class="label-table label-inherit black upper-case">Vatable Sales</span></td>
							<td colspan="7"><span class="label-table label-inherit black">{{number_format($total-$vat, 2, '.', ',')}}</span></td>
						</tr>
						<tr>
							<td colspan="7"><span class="label-table label-inherit black upper-case">12% Vat</span></td>
							<td colspan="7"><span class="label-table label-inherit black">{{number_format($vat, 2, '.', ',')}}</span></td>
						</tr>
					</tbody>
				</table>
				<div class="col-xs-12 content-lower"></div>
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					    <a href="{{url('accounting/print').'/'.$s->id}}" target="_blank" class="btn btn-dark-2 btn-lg"><i class="fa fa-window-restore"></i> Print</a>
					</div>
					<div class="btn-group" role="group">
						<button class="btn btn-green btn-lg" type="submit"><i class="fa fa-check-square"></i> Verify</button>
					</div>
				</div>
			</div>	
		</div>
	</form>
	@endforeach
@endsection

@section('js')

@endsection