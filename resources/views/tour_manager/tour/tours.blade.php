@extends('layouts.app')

@section('title')
	Cebu Trip Tours
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
					<input type="text" class="form-control search-value" data-var="tours" placeholder="Search Tours">
					<span class="input-group-btn">
				        <button class="btn btn-lg btn-dark-2 search-button" data-act="search" type="button">Search</button>
				    </span>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
			  	<div class="btn-group" role="group">
			    	<a href="{{url('admin/add/tour')}}" class="btn btn-lg btn-blue-3"><i class="fa fa-plus"></i> Tour</a>
			  	</div>
			  	<div class="btn-group" role="group">
					<button type="button" class="btn btn-blue-2 btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Code <span class="caret"></span>
				  	</button>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
						@foreach($codes as $code)
					   		<li class="text-center"><a href="#" class="tour-code filter" data-act="filter" data-filtval="{{$code}}">{{$code}}</a></li>
					   		<li role="separator" class="divider"></li>
					   	@endforeach
					</ul>
			  	</div>
			</div>
		</div>
		<input type="hidden" value="{{csrf_token()}}" name="deleteToken">
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 details-div"></div>
		<div class="searchResult">
			@foreach($tours as $t)
				<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="panel panel-default">
					  	<div class="panel-heading text-center bg-blue-2">
					  		<span class="text-bold white size-15">{{$t->code}}</span>
					  		<div class="btn-group float-right gear-position">
								<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fa fa-gear white size-s"></i>
								</button>
								<ul class="dropdown-menu">
								    <li class="text-center"><a href="{{url('admin/edit/tour').'/'.$t->id}}" class="text-bold"><i class="fa fa-pencil-square-o blue"></i> Edit</a></li>
								    <li role="separator" class="divider"></li>
								    <li class="text-center"><a href="#" class="text-bold deleteThisAgent" data-act="{{$t->id}}" data-var="tours" data-name="{{$t->name}}"><i class="fa fa-trash red"></i> Delete</a></li>
								</ul>
							</div>
					  	</div>
					  	<div class="panel-body">
					  		<div class="col-xs-12 text-center">
					  			<span class="label label-danger">{{$t->type}} Tour</span>
						    	<h4 class="black text-bold size-15">{{$t->name}}</h4>
						    </div>
					  	</div>
					</div>
				</div>
			@endforeach
		</div>
	
	</div>
@endsection

@section('js')

@endsection