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
		                    $count++;
		                    $total = 0;
		                    $comm = 0;
						@endphp
						@foreach($sip as $particular)
							@if($particular->si_id == $s->id)
								@php
									$total = $total + $particular->total;
									$comm = $comm + $particular->commission;
								@endphp
							@endif
						@endforeach
						@php
							$net_amount = $total - $comm;
							$vat = ($net_amount / 1.12) * .12;
						@endphp

						<div class="panel">
						  	<div class="panel-heading bg-dark text-center">
						    	<span class="panel-title white text-bold size-20 text-upper">{{$s->sales_invoice}}</span>
						    	<div class="btn-group float-right gear-position">
									<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <i class="fa fa-cog fa-hover-spin white size-s"></i>
									</button>
									<ul class="dropdown-menu">
									    <li class="text-center"><a href="{{url('accounting/check-soa').'/'.$s->id}}" class="text-bold si-options"><i class="fa fa-mail-forward fa-rotate-90 dark-blue"></i> View</a></li>
									    <li role="separator" class="divider"></li>
									    @if($s->status === "Pending")
										    <li class="text-center"><a href="#" class="text-bold si-options verifySoa" data-soaname="{{$s->sales_invoice}}" data-soaid="{{$s->id}}"><i class="fa fa-check-square-o blue"></i> Verify</a></li>
										    <li role="separator" class="divider"></li>
										@endif
									    <li class="text-center"><a href="{{url('accounting/print').'/'.$s->id}}" target="_blank" class="text-bold si-options" data-act="" data-var="tours" data-name=""><i class="fa fa-print red"></i> Print</a></li>
									    <li role="separator" class="divider"></li>
									    <li class="text-center"><a href="#" class="text-bold deleteThisSI si-options" data-act="" data-var="tours" data-name=""><i class="fa fa-download green"></i> Download</a></li>
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
													<span class="text-bold black size-s">Total: {{number_format($s->total, 2, '.', ',')}}</span><br>
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
									<div class="col-xs-12 content-lower"></div>
									<table class="table table-striped table-hover table-condensed table-bordered table-responsive">
										<thead>
											<tr>
												<th class="text-center"><span class="label-table text-bold upper-case">Net</span></span></th>
												<th class="text-center"><span class="label-table text-bold upper-case">Vat</span></th>
												<th class="text-center"><span class="label-table text-bold upper-case">Sale</span></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center"><span class="label-table black text-bold size-100p">{{number_format($net_amount, 2, '.', ',')}}</span></td>
												<td class="text-center"><span class="label-table black text-bold size-100p">{{number_format($vat, 2, '.', ',')}}</span></td>
												<td class="text-center"><span class="label-table black text-bold size-100p">{{number_format($net_amount-$vat, 2, '.', ',')}}</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="panel-footer bg-dark text-center">
								<div class="line-height-1">
									<span class="text-bold size-12 si-created">{{$s->reservation_officer}}</span><br>
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