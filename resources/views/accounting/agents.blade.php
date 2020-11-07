@extends('layouts.accounting')

@section('title')
	Tours | Cebu Trip Tours
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
					<input type="text" class="form-control search-value" data-var="agents" placeholder="Search Agents">
					<span class="input-group-btn">
				        <button class="btn btn-lg btn-dark-2 search-button" data-act="search" type="button">Search</button>
				    </span>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 text-right">
			  	
		  	<div class="btn-group" role="group">
				<button type="button" class="btn btn-green btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Nature <span class="caret"></span>
			  	</button>
				<ul class="dropdown-menu">
					<li role="separator" class="divider"></li>
					@foreach($natures as $nature)
				   		<li class="text-center"><a href="#" class="tour-code-green filter" data-act="filter" data-filtval="{{$nature}}">{{$nature}}</a></li>
				   		<li role="separator" class="divider"></li>
				   	@endforeach
				</ul>
		  	</div>
			
		</div>
		<input type="hidden" value="{{csrf_token()}}" name="deleteToken">
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 details-div"></div>
		<div class="searchResult">
			@foreach($agents as $a)
				<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="panel panel-default">
					  	<div class="panel-heading text-center bg-green">
					  		<span class="text-bold white size-15">{{$a->nature}}</span>
					  		<div class="btn-group float-right gear-position">
								<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fa fa-gear white size-s"></i>
								</button>
								<ul class="dropdown-menu">
									<li role="separator" class="divider"></li>
									<li class="text-center"><a href="{{url('reservation/view/agent').'/'.$a->id}}" class="text-bold br-edit"><i class="fa fa-television blue"></i> View</a></li>
								    <li role="separator" class="divider"></li>
								</ul>
							</div>
					  	</div>
					  	<div class="panel-body">
					  		<div class="col-xs-12 text-center">
						    	<h4 class="black text-bold">{{$a->name}}</h4>
						    	<span class="label label-default"><i class="fa fa-phone-square blue"></i> {{$a->aCount}} Available contacts</span>
						    </div>
					  	</div>
					</div>
				</div>
			@endforeach
		</div>
	
	</div>
	<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="addContact">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header text-center bg-green">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="white" aria-hidden="true">&times;</span></button>
			        <h3 class="modal-title text-bold white" id="myModalLabel"><i class="fa fa-plus white"> </i> <span class="agent-title"></span> Contact</h3>
		     	 </div>
		     	<div class="modal-body">
			      	<form action="" method="">
			        	<div class="row">
			        		<div class="col-xs-12 text-right content-lower">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<input type="text" name="contact_name" class="form-control field-form text-center" placeholder="Name">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<input type="text" name="contact_designation" class="form-control field-form text-center" placeholder="Designation">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<input type="email" name="contact_email" class="form-control field-form text-center" placeholder="Email Address">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<input type="text" name="contact_number" class="form-control field-form text-center" placeholder="Contact Number">
								</div>
							</div>
			        	</div>
			        </form>
		   		</div>
			    <div class="modal-footer bg-green">
			        
					    <button type="button" class="btn btn-lg btn-red close-modal btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					
			    </div>
		    </div>
	  	</div>
	</div>
@endsection

@section('js')

@endsection