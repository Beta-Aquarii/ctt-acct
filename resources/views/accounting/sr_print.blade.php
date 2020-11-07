<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>Sales Report</title>

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css"></link>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/br.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
    	.upper-case{
    		text-transform: uppercase;
    	}
    	.table-condensed>tbody>tr>td,
		.table-condensed>tbody>tr>th, 
		.table-condensed>tfoot>tr>td,
		.table-condensed>tfoot>tr>th{
			
		}
		.table-condensed>tbody>tr>td,
		.table-condensed>tbody>tr>th{
			vertical-align: middle !important;
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
		.label-pax{
			font-size:9px;
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
		.text-transform-reset{
			text-transform: unset !important;
		}
		h3{
			margin-top:0 !important;
			margin-bottom:0 !important;
			color:black !important;
		}
		.vertical-align{
			vertical-align: middle;
		}
	</style>
</head>
<body>
<table class="table table-bordered table-condensed table-responsive">
	<thead>
		<tr>
			@if($start_date === $end_date)
				<th colspan="7" class="text-center"><h4 class="upper-case black">Sales Report ({{$start_date}})</h4></th>
			@else
				<th colspan="7" class="text-center"><h4 class="upper-case black">Sales Report ({{$start_date}} - {{$end_date}})</h4></th>
			@endif
		</tr>
		<tr>
			<th><span class="text-bold black">SI#</span></span></th>
			<th><span class="text-bold black">Guest</span></th>
			<th><span class="text-bold black">Particular</span></th>
			<th><span class="text-bold black">Agent</span></th>
			<th><span class="text-bold black">Reservation</span></th>
			<th><span class="text-bold black">Booking</span></th>
			<th><span class="text-bold black">Total</span></th>
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
                $break = 0;
			@endphp
			<tr>
				<td><span class="label-table label-inherit">{{$s->sales_invoice}}</span></td>
				<td><span class="label-table label-inherit">{{$s->lead_guest}}</span></td>
				<td">
					@foreach($sip as $particular)
						@if($particular->si_id == $s->id)
							@if($break != 0)
								<span>,</span>
							@endif
							<span class="label-table label-inherit">{{$particular->particular}}</span>
							@php
								$break++;
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
				<td><span class="label-table label-inherit">{{number_format($net, 2, '.', ',')}}</span></td>
			</tr>
		@endforeach
	</tbody>
		@php
			$vat = ($sr_total / 1.12) * .12;
			$sr_vatable = $sr_total - $vat;
		@endphp
	<tfoot>
		<tr>
			<td class="text-left sr-total-div" colspan="6">
				<span class="label-table label-inherit black f-11">Total Net Sales</span>
			</td>
			<td colspan="1">
				<span class="label-table label-inherit black f-11">{{number_format($sr_total, 2, '.', ',')}}</span>
			</td>
		</tr>
		<tr>
			<td class="text-left sr-total-div" colspan="6">
				<span class="label-table label-inherit black f-11">Total Vatable Sales</span>
			</td>
			<td colspan="1">
				<span class="label-table label-inherit black f-11">{{number_format($sr_vatable, 2, '.', ',')}}</span>
			</td>
		</tr>
		<tr>
			<td class="text-left sr-total-div" colspan="6">
				<span class="label-table label-inherit black f-11">12% VAT</span>
			</td>
			<td colspan="1">
				<span class="label-table label-inherit black f-11">{{number_format($vat, 2, '.', ',')}}</span>
			</td>
		</tr>
	</tfoot>
</table>
 <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/tinyplug.js') }}"></script>
    <script src="{{ asset('js/br.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

</body>
</html>