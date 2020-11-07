<div class="row">
	@if($agent)
	<div class="content-lower"></div>
	<div class="col-xs-12">
		<table class="table table-condensed table-hover table-bordered">
			<tbody>
				@foreach($agent as $a)
					@if($a->notes)
						@php
							$notes = $a->notes;
						@endphp
					@else
						@php
							$notes = "No notes for this agent";
						@endphp
					@endif
					<tr>
						<td class="td-side bg-green text-center vertical-middle row-pad-reset nature-border toggle-agent-details" data-agent-title="{{$a->name}}" data-agent-payment="{{$a->payment_terms}}" data-agent-tin="{{$a->tin}}" data-agent-note="{{$notes}}" data-agent-contacts="{{$a->aCount}}">
				  				<!--<span class="white text-bold">{{$a->nature}}</span>-->
				  				<span class="white text-bold size-m"><i class="fa fa-user-secret white"></i></span>
				  			</td>
						<td class="td-center bg-white text-center vertical-middle row-pad toggle-agent-details" data-agent-title="{{$a->name}}" data-agent-payment="{{$a->payment_terms}}" data-agent-tin="{{$a->tin}}" data-agent-note="{{$notes}}" data-agent-contacts="{{$a->aCount}}">
							<span class="black text-bold size-m black"> {{$a->name}}</span><br>
							<span class="black text-bold size-13"><i class="fa fa-map-marker blue-2"></i> {{$a->address}}</span><br>
						</td>
						<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button si-agent narture-border" data-toggle="tooltip" data-placement="top" title="Change Agent" data-agent-id="{{$a->id}}" data-agent-var="records" data-val="agent">
							<span class="white text-bold size-m"><i class="fa fa-exchange white"></i></span>
						</td>
					</tr>
					<input type="hidden" name="agent_id" value="{{$a->id}}">
					<input type="hidden" name="agent_name" value="{{$a->name}}">
					<input type="hidden" name="agent_address" value="{{$a->address}}">
					<input type="hidden" name="agent_tin" value="{{$a->tin}}">
					<input type="hidden" name="agent_payment" value="{{$a->payment_terms}}">
					<input type="hidden" name="agent_nature" value="{{$a->nature}}">
				@endforeach
			</tbody>
		</table>
	</div>
	@else
	<input type="hidden" name="agent_id" value="0">
	<input type="hidden" class="agent-others" name="agent_nature" value="">
	<div class="col-xs-12 text-center">
		<label class=" black text-bold size-25"><span class="agent-ajax-nature"></span> Agent</label>
		<div class="content-lower"></div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="form-group">
			<div class="input-group">
			  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-user-secret"></i></span>
			  	<input type="text" class="form-control agent-others" aria-describedby="agent-name" placeholder="Agent Name" name="agent_name">
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="form-group">
			<div class="input-group">
			  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-address-book"></i></span>
			  	<input type="text" class="form-control agent-others" aria-describedby="agent-address" placeholder="Agent Address" name="agent_address">
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="form-group">
			<div class="input-group">
			  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-id-card-o"></i></span>
			  	<input type="text" class="form-control agent-others" aria-describedby="agent-tin" placeholder="Agent TIN" name="agent_tin">
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="form-group">
			<div class="input-group">
			  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-credit-card"></i></span>
			  	<input type="text" class="form-control agent-others" aria-describedby="agent-payment"  placeholder="Payment Terms" name="agent_payment">
			</div>
		</div>
	</div>
	<div class="col-xs-12 text-center">
		<button type="button" class="btn bg-red btn-block si-agent white text-bold btn-lg"><i class="fa fa-exchange"></i> Change Agent</button>
	</div>
	@endif
</div>
<div class="col-xs-12 content-lower"></div>
