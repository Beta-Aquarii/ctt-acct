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
<a href="{{url('accounting/print-sales-report').'/'.$start_date.'/'.$end_date}}" class="btn btn-green btn-block"><i class="fa fa-window-restore"></i> Print / Download</a>