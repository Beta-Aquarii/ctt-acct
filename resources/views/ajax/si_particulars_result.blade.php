<div class="col-xs-12">
	<table class="table table-hover">
		<tbody>
			@foreach($result as $t)
	  		<tr>
	  			<td class="bg-blue-2 text-center vertical-middle row-pad nature-border toggle-particular-details">
	  				<span class="white text-bold">{{$t->code}}</span>
	  			</td>
	  			<td class="text-center vertical-middle row-pad toggle-particular-details">
	  				<span class="black text-bold size-s black"> {{$t->name}}</span><br>
	  				<span class="black text-bold size-13"><i class="fa fa-tags blue-2"></i> {{$t->type}}</span>
	  			</td>
	  			<td class="text-center vertical-middle row-pad particular-add-button narture-border" data-toggle="tooltip" data-placement="top" title="Select this tour" data-particular-id="{{$t->id}}" data-agent-var="records" data-val="agent">
	  				<span class="white text-bold size-m"><i class="fa fa-chevron-right white"></i></span>
	  			</td>
	  		</tr>
			@endforeach
		</tbody>
	</table>

</div>