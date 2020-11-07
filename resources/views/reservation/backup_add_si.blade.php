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
	</style>
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 form-div">
	
		<input type="hidden" value="{{csrf_token()}}" name="_variable">
		<form metho="POST" action="">
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
						<span class="input-group-addon bg-red white"><i class="fa fa-hashtag"></i></span>
					  	<input type="text" class="form-control agent-booking-ref" aria-describedby="agent-name" placeholder="Booking Reference Number" name="agent_booking_ref">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12">
				<div class="si-agent-add-div">
					<div class="form-group text-center">
						<div class="insert-agent">
							<button type="button" class="btn btn-lg btn-block bg-green white text-bold si-agent"><i class="fa fa-plus"></i> Agent</button>
							<i class="fa fa-plus-square size-200 si-agent green-2"></i><br>
							<span class="text-bold size-25">Agent</span>
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
				<div class="si-tour-add-div">
					<div class="form-group text-center">
						<div class="insert-tour">
							<button type="button" class="btn btn-lg btn-block bg-blue-2 white si-particular"><i class="fa fa-plus"></i> Particular</button>
							<i class="fa fa-plus-square size-200 si-particular blue-2"></i><br>
							<span class="text-bold size-25">Particular</span>
						</div>
					</div>
				</div>
				<div class="modal fade" id="tour-modal" tabindex="-1" role="dialog" aria-labelledby="tour-modal">
				  	<div class="modal-dialog" role="document">
					    <div class="modal-content">
						    <div class="modal-header bg-dark">
						        <button type="button" class="close white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h3 class="modal-title modal-header-title text-center white" id="myModalLabel"><i class="fa fa-compass"></i> Particular</h3>
						    </div>
					     	<div class="modal-body">
					     		<div class="row">
						     		<div class="col-xs-4 col-sm-4 col-md-4 text-center">
						     			<div class="si-agent">
							     			<i class="fa fa-globe size-80 dark-blue agent-add-button" data-toggle="tooltip" data-placement="top" title="Websites"></i><br>
							     			<label class="si-agent-label si-agent-add" data-val="web">Web</label>
							     		</div>
						     		</div>
						     		<div class="col-xs-4 col-sm-4 col-md-4 text-center">
						     			<div class="si-agent">
							     			<i class="fa fa-universal-access size-80 blue-2 agent-add-button" data-toggle="tooltip" data-placement="top" title="Walk-in"></i><br>
							     			<label class="si-agent-label si-agent-add" data-val="walk-in">Walk-in</label>
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
												  			<td class="text-center vertical-middle row-pad agent-add-button narture-border" data-toggle="tooltip" data-placement="top" title="Select this agent" data-agent-id="{{$a->id}}" data-agent-var="records" data-val="agent">
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
			</div>

		</form>

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