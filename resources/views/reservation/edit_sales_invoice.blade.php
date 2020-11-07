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
	@foreach($si as $s)
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
						<input type="text" class="form-control" name="lead_guest" placeholder="Lead Guest" value="{{$s->lead_guest}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-qrcode"></i></span>
					  	<input type="text" class="form-control agent-booking-ref" aria-describedby="agent-name" placeholder="Booking Reference Number" name="agent_booking_ref" value="{{$s->booking_reference}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-at"></i></span>
					  	<input type="email" class="form-control" aria-describedby="email" placeholder="Email" name="email" value="{{$s->email}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-phone-square"></i></span>
					  	<input type="text" class="form-control" aria-describedby="contact" placeholder="Contact Number" name="contact" value="{{$s->contact}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-map-marker"></i></span>
					  	<input type="text" class="form-control" aria-describedby="pick-up" placeholder="Pick Up" name="pick_up" value="{{$s->pickup}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon bg-dark white"><i class="fa fa-clock-o"></i></span>
					  	<input type="time" class="form-control" aria-describedby="time" placeholder="Time" name="time" value="{{$s->time}}">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<textarea class="form-textarea" name="note" rows="6" placeholder="Note">{{$s->note}}</textarea>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12">
				<div class="si-agent-add-div">
					<div class="form-group text-center">
						<div class="insert-agent">
							@foreach($sia as $sa)
								<div class="row">
									@if($sa->agent_id != 0)
									<div class="content-lower"></div>
									<div class="col-xs-12">
										<table class="table table-condensed table-hover table-bordered">
											<tbody>
												<tr>
													<td class="td-side bg-green text-center vertical-middle row-pad-reset nature-border toggle-agent-details" data-agent-title="{{$sa->name}}" data-agent-payment="{{$sa->payment_terms}}" data-agent-tin="{{$sa->tin}}" data-agent-note="{{$sa->notes}}" data-agent-contacts="{{$sia_count}}">
											  				<span class="white text-bold size-m"><i class="fa fa-user-secret white"></i></span>
											  			</td>
													<td class="td-center bg-white text-center vertical-middle row-pad toggle-agent-details" data-agent-title="{{$sa->name}}" data-agent-payment="{{$sa->payment_terms}}" data-agent-tin="{{$sa->tin}}" data-agent-note="{{$sa->notes}}" data-agent-contacts="{{$sia_count}}">
														<span class="black text-bold size-m black"> {{$sa->name}}</span><br>
														<span class="black text-bold size-13"><i class="fa fa-map-marker blue-2"></i> {{$sa->address}}</span><br>
													</td>
													<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button si-agent narture-border" data-toggle="tooltip" data-placement="top" title="Change Agent" data-agent-id="{{$sa->id}}" data-agent-var="records" data-val="agent">
														<span class="white text-bold size-m"><i class="fa fa-exchange white"></i></span>
													</td>
												</tr>
												<input type="hidden" name="agent_id" value="{{$sa->agent_id}}">
												<input type="hidden" name="agent_name" value="{{$sa->name}}">
												<input type="hidden" name="agent_address" value="{{$sa->address}}">
												<input type="hidden" name="agent_tin" value="{{$sa->tin}}">
												<input type="hidden" name="agent_payment" value="{{$sa->payment_terms}}">
												<input type="hidden" name="agent_nature" value="{{$sa->nature}}">
											</tbody>
										</table>
									</div>
									@else
									<input type="hidden" name="agent_id" value="{{$sa->id}}">
									<input type="hidden" class="agent-others" name="agent_nature" value="">
									<div class="col-xs-12 text-center">
										<label class=" black text-bold size-25"><span class="agent-ajax-nature"></span> Agent</label>
										<div class="content-lower"></div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<div class="input-group">
											  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-user-secret"></i></span>
											  	<input type="text" class="form-control agent-others" aria-describedby="agent-name" placeholder="Agent Name" name="agent_name" value="{{$sa->name}}">
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<div class="input-group">
											  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-address-book"></i></span>
											  	<input type="text" class="form-control agent-others" aria-describedby="agent-address" placeholder="Agent Address" name="agent_address" value="{{$sa->address}}">
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<div class="input-group">
											  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-id-card-o"></i></span>
											  	<input type="text" class="form-control agent-others" aria-describedby="agent-tin" placeholder="Agent TIN" name="agent_tin" value="{{$sa->tin}}">
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<div class="input-group">
											  	<span class="input-group-addon bg-dark white text-bold"><i class="fa fa-credit-card"></i></span>
											  	<input type="text" class="form-control agent-others" aria-describedby="agent-payment"  placeholder="Payment Terms" name="agent_payment" value="{{$sa->payment_terms}}">
											</div>
										</div>
									</div>
									<div class="col-xs-12 text-center">
										<button type="button" class="btn bg-red btn-block si-agent white text-bold btn-lg"><i class="fa fa-exchange"></i> Change Agent</button>
									</div>
									@endif
								</div>
								<div class="col-xs-12 content-lower"></div>
							@endforeach
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
					@foreach($sip as $sp)
							@if($sp->particular_id != 0)
								<table class="table si-particular-table table-condensed table-hover table-bordered">
									<tbody>
										<tr>
											<td class="td-side bg-blue-2 text-center vertical-middle row-pad-reset nature-border toggle-particular-details">
												<span class="white text-bold"><i class="fa fa-list size-m"></i></span>
											</td>
											<td class="td-center text-center vertical-middle row-pad toggle-particular-details bg-white">
												<span class="black text-bold size-s black"> {{$sp->particular}}</span><br>
												<span class="black text-bold size-13"><i class="fa fa-tags blue-2"></i> {{$sp->particular_type}}</span>
												<input type="hidden" name="particular_name[]" value="{{$sp->particular}}">
												<input type="hidden" class="particular_id" name="particular_id[]" value="{{$sp->particular_id}}">
												<input type="hidden" name="particular_type[]" value="{{$sp->particular_type}}">
												<input type="hidden" name="pId[]" value="{{$sp->id}}">
											</td>
											<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button particular-remove-button-edit narture-border" data-toggle="tooltip" data-placement="top" title="Remove Particular" data-particular-id="{{$sp->id}}" data-particular-name="{{$sp->particular}}" data-si="{{$s->sales_invoice}}" data-agent-var="records" data-val="agent">
												<span class="white text-bold size-m"><i class="fa fa-times-circle white"></i></span>
											</td>
										</tr>
										<tr class="particular-calc-div">
											<td colspan="3" class="vertical-middle bg-white">
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
													<div class="form-group form-group-reset">
														<input type="text" class="form-40" placeholder="Booking Reference" name="particular_booking_ref[]" value="{{$sp->booking_reference}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
													<div class="form-group form-group-reset">
														<input type="text" class="form-40 si-date particular-calc" placeholder="Tour Date" name="particular_date[]" value="{{$sp->tour_date}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<div class="form-group form-group-reset">
														<input type="number" min="0" class="form-40 particular-calc particular_com" placeholder="Commission" name="particular_com[]" value="{{$sp->commission}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-8">
													<div class="form-group form-group-reset">
														<div class="btn-group btn-group-justified" role="group" aria-label="...">
															<div class="btn-group" role="group">
															    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															      <span class="local-count">{{$sp->pax}}</span> Local
															      <span class="caret"></span>
															    </button>
															    <input type="hidden" class="particular-local" name="particular_local[]" value="{{$sp->pax}}">
															    <ul class="dropdown-menu">
															    	@for($x = 0; $x<=12; $x++)
																      	<li class="change-local text-center particular-calc" data-val="{{$x}}" data-tour="{{$sp->particular_id}}"><a class="guide-option">{{$x}} pax</a></li>
																    @endfor
															    </ul>
														  	</div>
														  	@if($sp->foreign_rate)
															  	<div class="btn-group" role="group">
																    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																      <span class="foreign-count">{{$sp->foreign_pax}}</span> Foreign
																      <span class="caret"></span>
																    </button>
																    <input type="hidden" class="particular-foreign" name="particular_foreign[]" value="{{$sp->foreign_pax}}">
																    <ul class="dropdown-menu">
																      	@for($x = 0; $x<=12; $x++)
																	      	<li class="change-foreign text-center particular-calc" data-val="{{$x}}" data-tour="{{$sp->particular_id}}"><a class="guide-option">{{$x}} pax</a></li>
																	    @endfor
																    </ul>
															  	</div>
															@else
																<input type="hidden" class="particular-foreign" name="particular_foreign[] value="0">
															@endif
															<div class="btn-group" role="group">
															    <button type="button" class="btn btn-blue-2-si btn-height-40 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															      <span class="dropdown-count">{{$sp->guide}}</span> guide
															      <span class="caret"></span>
															    </button>
															    <input type="hidden" class="particular-dropdown particular-guide" name="particular_guide[]" value="{{$sp->guide}}">
															    <ul class="dropdown-menu">							      	
															      	<li class="change-dropdown text-center particular-calc guide-option" data-val="with" data-tour="{{$sp->particular_id}}"><a class="text-bold guide-option">with Guide</a></li>
															      	<li class="change-dropdown text-center particular-calc guide-option" data-val="without" data-tour="{{$sp->particular_id}}"><a class="text-bold guide-option">without Guide</a></li>
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
															<input type="text" class="form-40 particular_total border-radius-0 read-only" placeholder="Total" name="particular_total[]" value="{{number_format($sp->total,2,'.','')}}" readonly>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							@else
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
											<td class="td-side text-center vertical-middle row-pad-reset agent-exchange-button particular-remove-button-edit narture-border" data-toggle="tooltip" data-placement="top" title="Remove Particular" data-particular-id="{{$sp->id}}" data-particular-name="{{$sp->particular}}" data-si="{{$s->sales_invoice}}" data-agent-var="records" data-val="agent">
												<span class="white text-bold size-m"><i class="fa fa-times-circle white"></i></span>
											</td>
										</tr>
										<tr class="custom-calc-div">
											<td colspan="3" class="vertical-middle bg-white">
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
													<div class="form-group form-group-reset">
														<input type="text" class="form-40" placeholder="Booking Reference" name="particular_booking_ref[]" value="{{$sp->booking_reference}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
													<div class="form-group form-group-reset">
														<input type="text" class="form-40 particular-name for-particular-details" placeholder="Particular Name" name="particular_name[]" value="{{$sp->particular}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
													<div class="form-group form-group-reset">
														<input type="text" class="form-40 si-date particular-date for-particular-details" placeholder="Particular Date" name="particular_date[]" value="{{$sp->tour_date}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
													<div class="form-group form-group-reset">
														<input type="number" min="0" class="form-40 particular-rate for-particular-details custom-calc" placeholder="Rate" name="particular_rate[]" value="{{$sp->rate}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
													<div class="form-group form-group-reset">
														<input type="number" min="0" class="form-40 particular-com for-particular-details custom-calc" placeholder="Com/Pax" name="particular_com[]" value="{{$sp->commission}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
													<div class="form-group form-group-reset">
														<input type="number" min="0" class="form-40 particular-pax for-particular-details custom-calc" placeholder="Pax" name="particular_local[]" value="{{$sp->pax}}">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-3">
													<div class="form-group form-group-reset">
														<div class="input-group">
															<span class="input-group-addon bg-dark white text-bold"><small>Total</small></span>
															<input type="text" class="form-40 particular_total border-radius-0 read-only" placeholder="Total" name="particular_total[]" value="{{number_format($sp->total,2,'.','')}}" readonly>
															<input type="hidden" name="particular_type[]" value="Custom">
															<input type="hidden" name="particular_guide[]" value="">
															<input type="hidden" name="particular_id[]" value="0">
															<input type="hidden" name="particular_foreign[]" value="0">
															<input type="hidden" name="pId[]" value="{{$sp->id}}">
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							@endif
						@endforeach
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
		
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="col-xs-12 text-center overall-total-div">
					<span class="overall-total size-25 text-bold">{{number_format($s->total,2,'.','')}}</span>
					<input type="hidden" class="overall-total-value" name="overall" value="{{number_format($s->total,2,'.','')}}">
				</div>
			</div>
			<div class="col-xs-12 content-lower visible-xs visible-sm hidden-md hidden-lg"></div>
			<div class="col-xs-12 col-sm-12 col-md-6 content-lower">
				<button type="submit" class="btn btn-leg btn-red text-bold white size-m btn-block btn-radius-initial"><i class="fa fa-send"></i> Update</button>
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
									<input type="text" class="form-40 particular-name for-particular-details" placeholder="Particular Name" name="particular_name[]" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group form-group-reset">
									<input type="text" class="form-40 si-date particular-date for-particular-details" placeholder="Particular Date" name="particular_date[]" required>
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
								<input type="hidden" name="pId[]" value="0">
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
	@endforeach
@endsection

@section('js')

@endsection