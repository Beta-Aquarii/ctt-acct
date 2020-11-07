@extends('layouts.reservation')

@section('title')
	Sales Invoice | Cebu Trip Tours
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
		.
	</style>

	<div class="col-xs-12 form-div">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon text-bold white bg-dark"><i class="fa fa-search"></i></span>
					<input type="text" class="form-control search-value" data-var="tours" placeholder="Search">
					<span class="input-group-btn">
					    <div class="btn-group" role="group">
							<button type="button" class="btn btn-dark-2 btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    	Search <span class="caret"></span>
						  	</button>
							<ul class="dropdown-menu bg-dark">
								<li role="separator" class="divider"></li>
						   		<li class="text-center"><a href="#" class="tour-code-black white filter-si text-bold" data-filtval="si"><i class="fa fa-star orange"></i> SI #</a></li>
						   		<li role="separator" class="divider"></li>  
						   		<li class="text-center"><a href="#" class="tour-code-black white filter-si text-bold" data-filtval="date"><i class="fa fa-calendar blue"></i> Date</a></li>
						   		<li role="separator" class="divider"></li>
								<li class="text-center"><a href="#" class="tour-code-black white filter-si text-bold" data-filtval="guest"><i class="fa fa-user green"></i> Guest</a></li>
						   		<li role="separator" class="divider"></li>
							</ul>
					  	</div>
				    </span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-3 text-right">
		
		  <div class="btn-group btn-group-justified" role="group" aria-label="...">
		  		<div class="btn-group" role="group">
			    	<a href="{{url('reservation/add/salesinvoice')}}" class="btn btn-yellow btn-lg"><i class="fa fa-plus"></i> SI</a>
			  	</div>
			  	<div class="btn-group" role="group">
					<button type="button" class="btn btn-dark-2 btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Rows <span class="caret"></span>
				  	</button>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="tour-code filter-si-row" data-act="filter" data-filtval="6">Default</a></li>
						<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="tour-code filter-si-row" data-act="filter" data-filtval="15">15</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="tour-code filter-si-row" data-act="filter" data-filtval="30">30</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="tour-code filter-si-row" data-act="filter" data-filtval="45">45</a></li>
				   		<li role="separator" class="divider"></li>
					   
					</ul>
			  	</div>
			</div>

		</div>
		<input type="hidden" value="{{csrf_token()}}" name="deleteToken">
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 text-center">
			<span class="label bg-si-email text-bold size-15">Email</span>
			<span class="label bg-si-contact text-bold size-15">Contact</span>
			<span class="label bg-si-pickup text-bold size-15">Pick Up</span>
			<span class="label bg-si-pickup-time text-bold size-15">Pick Up Time</span>
		</div>
		<div class="col-xs-12 details-div text-center">
		</div>
		<div class="searchResult">
			@php
				$count = 0;
			@endphp
			@if(!$si->isEmpty())
				@foreach($si as $s)
					<div class="col-xs-12 col-sm-12 col-md-4">
						@php
							$_created = Carbon\Carbon::parse($s->created_at);
		                    $created = $_created->toDateString();
		                    $dispCreated = $_created->format('l, F d Y');
		                    $time = $_created->format('h:i:s A');
		                    $_pTime = Carbon\Carbon::parse($s->time);
		                    $pickup_time = $_pTime->format('h:i:s A');
		                    $count++
						@endphp

						<div class="panel">
						  	<div class="panel-heading bg-dark text-center">
						    	<span class="panel-title white text-bold size-20 text-upper">{{$s->sales_invoice}}</span>
						    	<div class="btn-group float-right gear-position">
									<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <i class="fa fa-cog fa-hover-spin white size-s"></i>
									</button>
									<ul class="dropdown-menu">
									    <li class="text-center"><a href="{{url('/reservation/edit/salesinvoice').'/'.$s->id}}" class="text-bold si-options"><i class="fa fa-pencil-square-o blue"></i> Update</a></li>
									    <li role="separator" class="divider"></li>
									    <li class="text-center"><a href="#" class="text-bold deleteThisSI si-options" data-act="" data-var="tours" data-name=""><i class="fa fa-download green"></i> Download</a></li>
									    <li role="separator" class="divider"></li>
									    <li class="text-center"><a href="#" class="text-bold deleteThisSI si-options" data-act="" data-var="tours" data-name=""><i class="fa fa-print red"></i> Print</a></li>
									</ul>
								</div>
						  	</div>
							<div class="panel-body">
								<div class="text-center margin-bottom-p15">
									<span class="text-bold black size-25">{{$s->lead_guest}}</span><br>
									<span class="label bg-si-email text-bold">{{$s->email}}</span>
									<span class="label bg-si-contact text-bold">{{$s->contact}}</span>
									<span class="label bg-si-pickup text-bold">{{$s->pickup}}</span>
									<span class="label bg-si-pickup-time text-bold">{{$pickup_time}}</span>
									<br><i class="fa fa-long-arrow-right red size-29 sis-details-total-pointer"></i><span class="black text-bold size-18">{{number_format($s->total, 2, '.', ',')}}</span>
								</div>
								<div class="row">
									@foreach($sia as $agent)
										@if($agent->si_id == $s->id)
											<div class="panel margin-bottom-reset">
												<a class="text-bold si-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#agent-{{$s->id}}" aria-expanded="true" aria-controls="agent-{{$s->id}}">
												    <div class="panel-heading text-center text-bold bg-green-initial white" role="tab">
												      	<h4 class="panel-title text-bold">								        
												        	{{$agent->name}} <span class="float-right"><i class="fa fa-toggle-down"></i></span>
												      	</h4>
												    </div>
												</a>
											    <div id="agent-{{$s->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="agent-{{$s->id}}">
											      	<div class="panel-body text-center">
									        			<small><span class="label label-info">{{$agent->nature}}</span></small><br>
									        			<span class="text-bold black">{{$agent->tin}}</span><br>
									        			@if($agent->address === "Web")
									        				<span class="text-bold"><i class="fa fa-map-marker red"></i> World Wide Web</span><br>
									        			@else
									        				<span class="text-bold"><i class="fa fa-map-marker red"></i> {{$agent->address}}</span><br>
									        			@endif
											      	</div>
											    </div>
											</div>
										@endif
									@endforeach
								    <div class="panel margin-bottom-15">
								    	<a class="text-bold si-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#particular-{{$s->id}}" aria-expanded="true" aria-controls="particular-{{$s->id}}">
										    <div class="panel-heading text-center text-bold bg-si white" role="tab">
										      	<h4 class="panel-title text-bold">
											       Particular <span class="float-right"><i class="fa fa-toggle-down"></i></span>
										      	</h4>
										    </div>
									    </a>
									    <div id="particular-{{$s->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="particular-{{$s->id}}">
									      	<div class="panel-body">
									      		<div class="text-center">
									      			<div class="row si-details-div"></div>
													@foreach($sip as $particular)
														@if($particular->si_id == $s->id)

															<span class="text-bold black size-s">{{$particular->particular}}</span><br>
															<span class="label bg-purple">{{$particular->particular_type}}</span>
															<span class="label bg-si-particular-date text-bold">{{$particular->tour_date}}</span>
															@if($particular->guide)
																<span class="label label-danger text-bold">{{$particular->guide}} guide</span>
															@endif
															@if($particular->pax != 0)
																<span class="label bg-si-particular-pax text-bold">{{$particular->pax + $particular->foreign_pax}} pax</span>
															@endif
															@php
																$total = ($particular->pax * $particular->rate) + ($particular->foreign_pax * ($particular->rate + $particular->foreign_rate))
															@endphp
																<br><i class="fa fa-long-arrow-right red size-29 sis-details-total-pointer"></i><span class="black text-bold size-s">{{number_format($particular->total, 2, '.', ',')}}</span>
															<div class="row si-details-div"></div>
														@endif
													@endforeach
												</div>						        	
									      	</div>
									    </div>
									</div>
									<!--<div class="panel margin-bottom-15">
								    	<a class="text-bold si-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#notes-{{$s->id}}" aria-expanded="true" aria-controls="notes-{{$s->id}}">
										    <div class="panel-heading text-center text-bold bg-notes white" role="tab">
										      	<h4 class="panel-title text-bold">
											       Notes <span class="float-right"><i class="fa fa-toggle-down"></i></span>
										      	</h4>
										    </div>
									    </a>
									    <div id="notes-{{$s->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="notes-{{$s->id}}">
									      	<div class="panel-body">
									      		<div class="text-center">
													@if($s->note)
														{{$s->note}}
													@else

													@endif
												</div>						        	
									      	</div>
									    </div>
									</div>-->
								</div>
							</div>
							<div class="panel-footer bg-dark text-center">
								<div class="line-height-1">
									<span class="text-bold size-12 si-created">{{$dispCreated}}</span><br>
									<small><span class="text-bold size-12 si-created"><i class="fa fa-clock-o"></i> {{$time}}</span></small>
								</div>
							</div>
						</div>
					</div>
					@if(($count % 3) == 0)
						<div class="row"></div>
					@endif
				@endforeach
			@else
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="well text-center">
						<i class="fa fa-exclamation-circle size-25 orange size-90"></i>
						<h2>Your sales invoice records is empty</h2>
						<label class="blue text-bold">No sales invoice records under the user <span class="red">{{Auth::user()->name}}</span></label><br>
						<label class="blue text-bold">User <span class="red">{{Auth::user()->name}}</span> has not added a sales invoice yet</label><br>
						<label class="blue text-bold">Your sales invoice records was deleted</label><br>
					</div>
				</div>
			@endif
			<div class="col-xs-12 text-center">
				{{	$si->links()	}}
			</div>
		</div>	
	</div>


@endsection

@section('js')

@endsection