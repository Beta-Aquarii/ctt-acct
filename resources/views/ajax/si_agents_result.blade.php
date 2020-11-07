
<div class="col-xs-12">
@if(count($result)!=0)
	<table class="table table-hover">
	  	<tbody>
	  		@foreach($result as $a)
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
		  			<td class="bg-green text-center vertical-middle row-pad nature-border toggle-agent-details" data-agent-title="{{$a->name}}" data-agent-payment="{{$a->payment_terms}}" data-agent-tin="{{$a->tin}}" data-agent-note="{{$notes}}" data-agent-contacts="{{$a->aCount}}">
		  				<span class="white text-bold">{{$a->nature}}</span>
		  			</td>
		  			<td class="text-center vertical-middle row-pad toggle-agent-details" data-agent-title="{{$a->name}}" data-agent-payment="{{$a->payment_terms}}" data-agent-tin="{{$a->tin}}" data-agent-note="{{$notes}}" data-agent-contacts="{{$a->aCount}}">
		  				<span class="black text-bold size-m black"> {{$a->name}}</span><br>
		  				<span class="black text-bold size-13"><i class="fa fa-map-marker blue-2"></i> {{$a->address}}</span>
		  			</td>
		  			<td class="text-center vertical-middle row-pad agent-add-button narture-border" data-toggle="tooltip" data-placement="top" title="Select this agent" data-agent-id="{{$a->id}}" data-agent-var="records">
		  				<span class="white text-bold size-m"><i class="fa fa-chevron-right white"></i></span>
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
			<label class="black text-bold size-s">Possible Causes:</label><br>
			<label class="blue text-bold">No agent records found in the database</label><br>
			<label class="blue text-bold">The user has been removed</label><br>
			<label class="blue text-bold">Search input is misspelled</label>
		</div>
	</div>
@endif
</div>