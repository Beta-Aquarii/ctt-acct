@extends('layouts.reservation')

@section('title')
	Add Sales Invoice | Cebu Trip Tours
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
		.td-side{
			width:10% !important;
		}
		.td-center{
			width:80% !important;
		}
		table{
			margin-bottom:10px !important;
		}
	</style>
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 form-div">
	
		<input type="hidden" value="{{csrf_token()}}" name="_variable">
		<form method="POST" action="">
			{{ csrf_field() }}
			<div class="searchResult">
				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="lead_guest" placeholder="Lead Guest">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-qrcode"></i></span>
					  	<input type="text" class="form-control agent-booking-ref" aria-describedby="agent-name" placeholder="Booking Reference Number" name="agent_booking_ref">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-at"></i></span>
					  	<input type="email" class="form-control" aria-describedby="email" placeholder="Email" name="email">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-phone-square"></i></span>
					  	<input type="text" class="form-control" aria-describedby="contact" placeholder="Contact Number" name="contact">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-map-marker"></i></span>
					  	<input type="text" class="form-control" aria-describedby="pick-up" placeholder="Pick Up" name="pick_up">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-clock-o"></i></span>
					  	<input type="time" class="form-control" aria-describedby="time" placeholder="Time" name="time">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<textarea class="form-textarea" name="note" rows="6" placeholder="Note"></textarea>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12">
				<div class="si-agent-add-div">
					<div class="form-group text-center">
						<div class="insert-agent">
							<button type="button" class="btn btn-lg btn-block bg-green white text-bold si-agent"><i class="fa fa-plus-circle"></i> Agent</button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="agent-modal" tabindex="-1" role="dialog" aria-labelledby="agent-modal">
				  	<div class="modal-dialog" role="document">
					    <div class="modal-content">
						    <div class="modal-header bg-dark">
						        <button type="button" class="close white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h3 class="modal-title modal-header-title text-center white" id="myModalLabel"><i class="fa fa-user-secret"></i> AGENTS</h3>
						    </div>
					     	<div class="modal-body">
					     		<div class="row">
						     		<div class="col-xs-4 col-sm-4 col-md-4 text-center">
						     			<div class="si-agent">
							     			<i class="fa fa-globe size-80 dark-blue agent-add-others" data-val="Web" data-agent-id="0" data-toggle="tooltip" data-placement="top" title="Websites"></i><br>
							     			<label class="si-agent-label si-agent-add">Web</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-4 col-sm-4 col-md-4 text-center">
						     			<div class="si-agent">
							     			<i class="fa fa-universal-access size-80 blue-2 agent-add-others" data-val="Walk-in" data-toggle="tooltip" data-placement="top" title="Walk-in"></i><br>
							     			<label class="si-agent-label si-agent-add">Walk-in</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-4 col-sm-4 col-md-4 text-center">
						     			<div class="si-agent" data-toggle="tooltip" data-placement="top" title="Search Database">
							     			<i class="fa fa-search size-80 dark si-agent-search" data-toggle="collapse" data-target="#search-form" aria-expanded="false" aria-controls="search-form"></i><br>
							     			<label class="si-agent-label">Search</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-12 details-div-dark"></div>
						     		<div class="col-xs-12">
						     			<div class="collapse" id="search-form">
									  		<div class="input-group">
												<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-search"></i></span>
												<input type="text" class="form-control si-agent-search-value" data-var="tours" placeholder="Agent Name">
												<span class="input-group-btn">
											        <button class="btn btn-lg btn-dark-2 si-agent-search-button" type="button">Search</button>
											    </span>
											</div>
										</div>
						     		</div>
						     		<div class=" col-xs-12 content-lower"></div>
							     	<div class="si-agent-search-results">
							     		<div class="col-xs-12">
								     		<table class="table table-hover">
											  	<tbody>
											  		@foreach($agents as $a)
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
												  			<td class="text-center vertical-middle row-pad agent-add-button narture-border" data-toggle="tooltip" data-placement="top" title="Select this agent" data-agent-id="{{$a->id}}" data-agent-var="records>
												  				<span class="white text-bold size-m"><i class="fa fa-chevron-right white"></i></span>
												  			</td>
												  		</tr>
											  		@endforeach
											  	</tbody>
											</table>
										</div>
							     	</div>
					     		</div>
					      	</div>
						    <div class="modal-footer bg-dark">
						        
						    </div>
					    </div>
				 	</div>
				</div>
				<div class="modal fade" id="agent-details-modal" tabindex="-2" role="dialog" aria-labelledby="agent-details-modal">
				  	<div class="modal-dialog modal-sm" role="document">
					    <div class="modal-content">
						    <div class="modal-header bg-dark">
						        <h3 class="modal-title modal-header-title text-center white" id="myModalLabel"><i class="fa fa-info-circle"></i> <span class="agent-details-title"></span> </h3>
						    </div>
					     	<div class="modal-body">
					     		<div class="row">
					     			<div class="col-xs-12 col-sm-12 text-center">
					     				<i class="fa fa-id-card-o"></i> <b>TIN:</b> <span class="agent-details-tin text-bold black"></span>
					     			</div>
					     			<div class="visible-xs visible-sm hidden-md hidden-lg content-lower-5"></div>
					     			<div class="col-xs-12 col-sm-12 text-center">
					     				<i class="fa fa-phone-square"></i> <b>Contacts:</b> <span class="agent-details-contacts text-bold black"></span> <b class="black">contacts</b>
					     			</div>
					     			<div class="visible-xs visible-sm hidden-md hidden-lg content-lower-5"></div>
					     			<div class="col-xs-12 col-sm-12 text-center">
					     				<i class="fa fa-money"></i> <b>Payment Terms:</b> <span class="agent-details-payment text-bold black"></span>
					     			</div>
					     			<div class="col-xs-12 details-div-4"></div>
					     			<div class="col-xs-12 text-center">
							     		<span class="agent-details-note text-bold black"></span>
							     	</div>
					     		</div>
					      	</div>
						    <div class="modal-footer bg-dark">
						        <button type="button" class="btn bg-red btn-lg btn-block white text-bold" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						    </div>
					    </div>
				 	</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 text-center">
				<div class="si-particular-add-div">
				</div>					
				<div class="form-group text-center">
					<div class="insert-tour">
						<button type="button" class="btn btn-lg btn-block bg-blue-2 white si-particular text-bold"><i class="fa fa-plus-circle"></i> Particular</button>
					</div>
				</div>
				<div class="modal fade" id="particular-modal" tabindex="-1" role="dialog" aria-labelledby="particular-modal">
				  	<div class="modal-dialog" role="document">
					    <div class="modal-content">
						    <div class="modal-header bg-dark">
						        <button type="button" class="close white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h3 class="modal-title modal-header-title text-center white" id="myModalLabel"><i class="fa fa-compass"></i> Particular</h3>
						    </div>
					     	<div class="modal-body">
					     		<div class="row">
						     		<div class="col-xs-6 col-sm-6 col-md-6 text-center">
						     			<div class="si-particular">
							     			<i class="fa fa-pencil-square size-80 dark-blue particular-add-custom" data-toggle="tooltip" data-placement="top" title="Custom"></i><br>
							     			<label class="si-agent-label si-particular-add" data-val="web">Custom</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-6 col-sm-6 col-md-6 text-center">
						     			<div class="si-particular" data-toggle="tooltip" data-placement="top" title="Search Database">
							     			<i class="fa fa-search size-80 dark si-particular-search" data-toggle="collapse" data-target="#search-particular" aria-expanded="false" aria-controls="search-particular"></i><br>
							     			<label class="si-agent-label">Search</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-12 details-div-dark"></div>
						     		<div class="col-xs-12">
						     			<div class="collapse" id="search-particular">
									  		<div class="input-group">
												<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-search"></i></span>
												<input type="text" class="form-control si-particular-search-value" data-var="tours" placeholder="Tour Name">
												<span class="input-group-btn">
											        <button class="btn btn-lg btn-dark-2 si-particular-search-button" type="button">Search</button>
											    </span>
											</div>
										</div>
						     		</div>
						     		<div class=" col-xs-12 content-lower"></div>
							     	<div class="si-particular-search-results">
							     		<div class="col-xs-12">
								     		<table class="table table-hover">
											  	<tbody>
											  		@foreach($tours as $t)
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
							     	</div>
					     		</div>
					      	</div>
						    <div class="modal-footer bg-dark">
						    	<div class="col-xs-12 text-center">
						        	<!--<label class="white"><i class="fa fa-exclamation-circle"></i> Press "Esc" to close.</label>-->
						        </div>
						    </div>
					    </div>
				 	</div>
				</div>
			</div>

			<div class="hidden-div hidden">
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="col-xs-12 text-center overall-total-div">
							<span class="overall-total size-25 text-bold"></span>
							<input type="hidden" class="overall-total-value" name="overall">
						</div>
					</div>
					<div class="col-xs-12 content-lower visible-xs visible-sm hidden-md hidden-lg"></div>
					<div class="col-xs-12 col-sm-12 col-md-6 content-lower">
						<button type="submit" class="btn btn-leg btn-red text-bold white size-m btn-block btn-radius-initial"><i class="fa fa-send"></i> Submit</button>
					</div>
				</div>

			<div class="col-xs-12 text-center">
				<ju>
			</div>

		</form>

		<div id="custom-particular-div" class="hidden">
			<table class="table si-particular-table table-condensed table-hover table-bordered">
				<tbody>
					<tr>
						<td class="td-side bg-blue-2 text-center vertical-middle row-pad-reset nature-border toggle-particular-custom-details" data-particular-price="0" data-particular-pax="0" data-particular-com="0" data-particular-name="">
							<span class="white text-bold"><i class="fa fa-list size-m"></i></span>
						</td>
						<td class="td-center text-center vertical-middle row-pad toggle-particular-details bg-white">
							<span class="black text-bold size-s black"> Custom Particular</span><br>
							<span class="black text-bold size-13"><i class="fa fa-tags blue-2"></i> Custom</span>
						</td>
						<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button particular-remove-button narture-border" data-toggle="tooltip" data-placement="top" title="Remove Particular" data-agent-var="records" data-val="agent">
							<span class="white text-bold size-m"><i class="fa fa-times-circle white"></i></span>
						</td>
					</tr>
					<tr class="custom-calc-div">
						<td colspan="3" class="vertical-middle bg-white">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group form-group-reset">
									<input type="text" class="form-40" placeholder="Booking Reference" name="particular_booking_ref[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group form-group-reset">
									<input type="text" class="form-40 particular-name for-particular-details" placeholder="Particular Name" name="particular_name[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group form-group-reset">
									<input type="text" class="form-40 si-date particular-date for-particular-details" placeholder="Particular Date" name="particular_date[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
								<div class="form-group form-group-reset">
									<input type="number" min="0" class="form-40 particular-rate for-particular-details custom-calc" placeholder="Rate" name="particular_rate[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
								<div class="form-group form-group-reset">
									<input type="number" min="0" class="form-40 particular-com for-particular-details custom-calc" placeholder="Com/Pax" name="particular_com[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
								<div class="form-group form-group-reset">
									<input type="number" min="0" class="form-40 particular-pax for-particular-details custom-calc" placeholder="Pax" name="particular_local[]">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
						<div class="form-group form-group-reset">
							<div class="input-group">
								<span class="input-group-addon bg-dark white text-bold"><small>Total</small></span>
								<input type="text" class="form-40 particular_total border-radius-0 read-only" placeholder="Total" name="particular_total[]" value="0.00" readonly>
								<input type="hidden" name="particular_type[]" value="Custom">
								<input type="hidden" name="particular_guide[]" value="">
								<input type="hidden" name="particular_id[]" value="0">
								<input type="hidden" name="particular_foreign[]" value="0">
							</div>
						</div>
					</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="modal fade" id="particular-details-modal" tabindex="-2" role="dialog" aria-labelledby="particular-details-modal">
		  	<div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
				    <div class="modal-header bg-dark">
				        <h3 class="modal-title modal-header-title text-center white" id="myModalLabel"><i class="fa fa-info-circle"></i> <span class="particular-details-title"></span> </h3>
				    </div>
			     	<div class="modal-body">
			     		<div class="row">
			     			<div class="col-xs-12 col-sm-12 text-center">
			     				<i class="fa fa-id-card-o"></i> <b>Total Price:</b> <span class="particular-details-total text-bold black"></span>
			     			</div>
			     			<div class="visible-xs visible-sm hidden-md hidden-lg content-lower-5"></div>
			     			<div class="col-xs-12 col-sm-12 text-center">
			     				<i class="fa fa-phone-square"></i> <b>Total Commission:</b> <span class="particular-details-com text-bold black"></span>
			     			</div>
			     			<div class="col-xs-12 details-div-4"></div>
			     			<div class="col-xs-12 text-center">
					     		<i class="fa fa-money"></i> <b>Net Amount:</b> <span class="particular-details-net text-bold black"></span>
					     	</div>
			     		</div>
			      	</div>
				    <div class="modal-footer bg-dark">
				        <button type="button" class="btn bg-red btn-lg btn-block white text-bold" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				    </div>
			    </div>
		 	</div>
		</div>

		<div id="agent-div" class="hidden">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group">
					<input type="text" class="form-control" name="agent_name" placeholder="Agent Name">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group">
					<input type="text" class="form-control" name="agent_name" placeholder="Agent Name">
				</div>
			</div>
		</div>
	
	</div>
@endsection

@section('js')

@endsection