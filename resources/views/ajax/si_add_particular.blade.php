<table class="table si-particular-table table-condensed table-hover table-bordered">
	<tbody>
		@foreach($tour as $t)
			<tr>
				<td class="td-side bg-blue-2 text-center vertical-middle row-pad-reset nature-border toggle-particular-details">
					<span class="white text-bold"><i class="fa fa-list size-m"></i></span>
				</td>
				<td class="td-center text-center vertical-middle row-pad toggle-particular-details bg-white">
					<span class="black text-bold size-s black"> {{$t->name}}</span><br>
					<span class="black text-bold size-13"><i class="fa fa-tags blue-2"></i> {{$t->type}}</span>
					<input type="hidden" name="particular_name[]" value="{{$t->name}}">
					<input type="hidden" class="particular_id" name="particular_id[]" value="{{$t->id}}">
					<input type="hidden" name="particular_type[]" value="{{$t->type}}">
					<input type="hidden" name="pId[]" value="0">
				</td>
				<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button particular-remove-button narture-border" data-toggle="tooltip" data-placement="top" title="Remove Particular" data-particular-id="{{$t->id}}" data-agent-var="records" data-val="agent">
					<span class="white text-bold size-m"><i class="fa fa-times-circle white"></i></span>
				</td>
			</tr>
			<tr class="particular-calc-div">
				<td colspan="3" class="vertical-middle bg-white">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group form-group-reset">
							<input type="text" class="form-40" placeholder="Booking Reference" name="particular_booking_ref[]">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group form-group-reset">
							<input type="text" class="form-40 si-date particular-calc" placeholder="Tour Date" name="particular_date[]" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group form-group-reset">
							<input type="number" min="0" class="form-40 particular-calc particular_com" placeholder="Commission" name="particular_com[]">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-8">
						<div class="form-group form-group-reset">
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
								<div class="btn-group" role="group">
								    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								      <span class="local-count">0</span> Local
								      <span class="caret"></span>
								    </button>
								    <input type="hidden" class="particular-local" name="particular_local[]">
								    <ul class="dropdown-menu">
								    	@for($x = 0; $x<=12; $x++)
									      	<li class="change-local text-center particular-calc" data-val="{{$x}}" data-tour="{{$t->id}}"><a class="guide-option">{{$x}} pax</a></li>
									    @endfor
								    </ul>
							  	</div>
							  	@if($t->foreign_rate != 0)
								  	<div class="btn-group" role="group">
									    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									      <span class="foreign-count">0</span> Foreign
									      <span class="caret"></span>
									    </button>
									    <input type="hidden" class="particular-foreign" name="particular_foreign[]">
									    <ul class="dropdown-menu">
									      	@for($x = 0; $x<=12; $x++)
										      	<li class="change-foreign text-center particular-calc" data-val="{{$x}}" data-tour="{{$t->id}}"><a class="guide-option">{{$x}} pax</a></li>
										    @endfor
									    </ul>
								  	</div>
								@else
									<input type="hidden" class="particular-foreign" name="particular_foreign[] value="0">
								@endif
								<div class="btn-group" role="group">
								    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								      <span class="dropdown-count">with</span> guide
								      <span class="caret"></span>
								    </button>
								    <input type="hidden" class="particular-dropdown particular-guide" name="particular_guide[]" value="with">
								    <ul class="dropdown-menu">							      	
								      	<li class="change-dropdown text-center particular-calc guide-option" data-val="with" data-tour="{{$t->id}}"><a class="text-bold guide-option">with Guide</a></li>
								      	<li class="change-dropdown text-center particular-calc guide-option" data-val="without" data-tour="{{$t->id}}"><a class="text-bold guide-option">without Guide</a></li>
								    </ul>
							  	</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group form-group-reset">
							<div class="input-group">
								<span class="input-group-addon bg-dark white text-bold"><small>Total</small></span>
								<input type="hidden" class="particular_rate" name="particular_rate[]">
								<input type="text" class="form-40 particular_total border-radius-0 read-only" placeholder="Total" name="particular_total[]" value="0.00" readonly>
							</div>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>