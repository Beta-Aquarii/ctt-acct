@extends('layouts.app')

@section('title')
	Users | Cebu Trip Tours
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
					<input type="text" class="form-control search-value" data-var="users" placeholder="Name">
					<span class="input-group-btn">
				        <button class="btn btn-lg btn-dark-2 search-button" data-act="search" type="button">Search</button>
				    </span>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
			  	<div class="btn-group" role="group">
			    	<a href="{{url('admin/add/user')}}" class="btn btn-lg btn-white"><i class="fa fa-plus"></i> User</a>
			  	</div>
			  	<div class="btn-group" role="group">
					<button type="button" class="btn btn-red btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Account <span class="caret"></span>
				  	</button>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="user-type filter" data-act="filter" data-filtval="admin">Admin</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="user-type filter" data-act="filter" data-filtval="reservation">Reservation</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="user-type filter" data-act="filter" data-filtval="accounting">Accounting</a></li>
				   		<li role="separator" class="divider"></li>
				   		<li class="text-center"><a href="#" class="user-type filter" data-act="filter" data-filtval="agent">Agent</a></li>
				   		<li role="separator" class="divider"></li>
					</ul>
			  	</div>
			</div>
		</div>
	
		<div class="col-xs-12 content-lower"></div>
		<div class="col-xs-12 details-div text-center">
			<!--<i class="fa fa-square blue size-s"></i> <span class="size-s text-bold">Username</span> 
			<i class="fa fa-square dark"></i> <span class="size-s text-bold">Email</span>-->
		</div>
		<div class="searchResult">
			@foreach($users as $u)
				<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="panel panel-default">
					  	<div class="panel-heading text-center bg-red">
					  		<span class="text-bold white size-15">
					  			@if($u->level == 0)
					  				Admin
					  			@elseif($u->level == 1)
					  				Reservation
					  			@elseif($u->level == 2)
					  				Accounting
					  			@endif
					  		</span>
					  		<div class="btn-group float-right gear-position">
								<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fa fa-gear white size-s"></i>
								</button>
								<ul class="dropdown-menu">
								    <li class="text-center"><a href="#" class="text-bold br-edit"><i class="fa fa-pencil-square-o blue"></i> Edit</a></li>
								    <li role="separator" class="divider"></li>
								    <li class="text-center"><a href="#" class="text-bold br-delete"><i class="fa fa-close red"></i> Deactivate</a></li>
								</ul>
							</div>
					  	</div>
					  	<div class="panel-body height-130">
					  		<div class="col-xs-12 text-center">
					  			<label>
					  				<i class="fa fa-user-circle grey size-15"></i>
					  				<span class="size-15 text-bold black">{{$u->name}}</span>
					  			</label><br>
					  			<span class="label label-default bg-blue">{{$u->username}}</span><br>
					  			<span class="label label-danger bg-dark">{{$u->email}}</span>
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