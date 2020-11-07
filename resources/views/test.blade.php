<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

     <title>Statement of Account {{$siNum}}</title>

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css"></link>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/br.css') }}" rel="stylesheet">
    <!-- Styles -->
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
			
		}
		.table-condensed>tbody>tr>td,
		.table-condensed>tbody>tr>th{
			vertical-align: middle;
		}
		.table>thead>tr>th {
		    vertical-align: bottom;
		    border-bottom: 2px solid #525252;
		}
		.table{
			    background-color: #fff !important;
			    border:1px solid black !important;
		}
		body{
			background:white !important;
		}
		.label-table{
			font-size:10px !important;
		}
		.f-11{
			font-size:11px !important;
		}
		.table-no-border, .table-no-border>thead>tr>th, .table-no-border>tbody>tr>td{
			border:none !important;
			padding-top:8px;
			padding-bottom:8px;
		}
		.lower-case{
			text-transform: lowercase !important;
		}
		.padding-bottom-unset{
			padding-bottom:unset !important;
		}
		.soa-div{
			border:1px solid black;
			padding: 5px;
		}
	</style>
</head>
<body>
	@foreach($si as $s)
    <div class="container-fluid">
        <div class="col-xs-12 form-div">
        	<div class="soa-div">
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
				@foreach($sia as $agent)
					@php
						$agent_name = $agent->name;
						$agent_tin = $agent->tin;
						$agent_address = $agent->address;
					@endphp
				@endforeach
				
				<table class="table table-condensed table-responsive table-no-border">
					<tbody>
						<tr>
							<td><span class="f-11 label-table black label-inherit upper-case">SI #: {{$s->sales_invoice}}</span></td>
							<td><span class="f-11 label-table black label-inherit upper-case">BOOKING REFERENCE: {{$s->booking_reference}}</span></td>
							<td><span class="f-11 label-table black label-inherit upper-case">DATE: {{$dispCreated}}</span></td>
						</tr>
						<tr>
							<td><span class="f-11 label-table black label-inherit upper-case">AGENT: {{$agent_name}}</span></td>
							<td><span class="f-11 label-table black label-inherit upper-case">LEAD GUEST: {{$s->lead_guest}}</span></td>
						</tr>
						<tr>
							<td><span class="f-11 label-table black label-inherit upper-case">TIN: {{$agent_tin}}</span></td>
							<td><span class="f-11 label-table black label-inherit upper-case">EMAIL: {{$s->email}}</span></td>
						</tr>
						<tr>
							<td><span class="f-11 label-table black label-inherit upper-case padding-bottom-unset">ADDRESS: {{$agent_address}}</span></td>
							<td><span class="f-11 label-table black label-inherit upper-case padding-bottom-unset">CONTACT: <span class="lower-case">{{$s->contact}}</span></span></td>
						</tr>
					</tbody>
				</table>
			
				<table class="table table-condensed table-bordered">
					<thead>
						<tr>
							<th><span class="f-11 black upper-case">Date</span></span></th>
							<th><span class="f-11 black upper-case">Particular</span></th>
							<th><span class="f-11 black upper-case">Rate</span></th>
							<th><span class="f-11 black upper-case">Pax</span></th>
							<th><span class="f-11 black upper-case">Total</span></th>
							<th><span class="f-11 black upper-case">Commission</span></th>
							<th><span class="f-11 black upper-case">Net</span></th>
							<th class="border-right"><span class="f-13 black upper-case">Instruction</span></th>
						</tr>
					</thead>
					<tbody>
						@foreach($sip as $sip)
							<tr>
								<td><span class="label-table black label-inherit upper-case">{{$sip->tour_date}}</span></td>
								<td><span class="label-table black label-inherit upper-case">{{$sip->particular}}</span></td>
								<td>
									<span class="label-table black label-inherit">{{number_format($sip->rate, 2, '.', ',')}}</span>
									@if($sip->foreign_rate)
										<?php $foreign_rate = $sip->rate + $sip->foreign_rate; ?>
										<br>
										<span class="label-table black label-inherit">{{number_format($foreign_rate, 2, '.', ',')}}</span>
									@endif
								</td>
								<td>
									@if($sip->pax)
										<span class="label-table black label-inherit">{{$sip->pax}} <span class="red">L</span></span>
									@endif
									@if($sip->foreign_pax)
										<br>
										<span class="label-table black label-inherit">{{$sip->foreign_pax}} <span class="red">F</span></span>
									@endif
								</td>
								<td><span class="label-table black label-inherit">{{number_format($sip->total, 2, '.', ',')}}</span></td>
								<td>
									@if($sip->commission)
										<span class="label-table black label-inherit">{{number_format($sip->commission, 2, '.', ',')}}</span>
									@endif
								</td>
								<?php $net_amount = $sip->total - $sip->commission; ?>
								<td><span class="label-table black label-inherit">{{number_format($net_amount, 2, '.', ',')}}</span></td>
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
							<td colspan="1"><span class="label-table label-inherit black">{{number_format($total, 2, '.', ',')}}</span></td>
						</tr>
						<tr>
							<td colspan="7"><span class="label-table label-inherit black upper-case">Vatable Sales</span></td>
							<td colspan="1"><span class="label-table label-inherit black">{{number_format($total-$vat, 2, '.', ',')}}</span></td>
						</tr>
						<tr>
							<td colspan="7"><span class="label-table label-inherit black upper-case">12% Vat</span></td>
							<td colspan="1"><span class="label-table label-inherit black">{{number_format($vat, 2, '.', ',')}}</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/tinyplug.js') }}"></script>
    <script src="{{ asset('js/br.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

</body>
</html>
