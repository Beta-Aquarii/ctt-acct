@if(count($si)!=0)	
	<table class="table table-striped table-hover table-condensed table-responsive">
		<thead>
			<tr>
				<th><span class="text-bold black">SI#</span></span></th>
				<th><span class="text-bold black">Guest</span></th>
				<th><span class="text-bold black">Particular</span></th>
				<th><span class="text-bold black">Agent</span></th>
				<th><span class="text-bold black">Reservation</span></th>
				<th><span class="text-bold black">Date</span></th>
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
					<td class="text-center vertical-middle row-pad accounting-verify narture-border" data-toggle="tooltip" data-placement="top" title="Update SI">
		  				<span class="white text-bold size-m"><i class="fa fa-pencil white"></i></span>
		  			</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="well text-center">
			<i class="fa fa-circle-o-notch fa-spin size-25 orange size-90"></i>
			<h2>Sorry! We couldn't find what you are looking for...</h2>
			<label class="blue text-bold">There is no results that match your search in {{$data}}</label><br>
			<label class="blue text-bold">Month and day is required to search through date</label><br>
			<label class="blue text-bold">No SI #/Guest/Date found in the database</label><br>
			<label class="blue text-bold">Search input is misspelled</label>
		</div>
	</div>
@endif