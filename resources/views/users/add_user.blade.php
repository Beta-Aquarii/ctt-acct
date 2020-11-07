@extends('layouts.app')

@section('title')
	Cebu Trip Tours
@endsection

@section('content')
	<style>
		.logo-div{
			padding-bottom:30px;
		}
		.well{
			border-radius:initial;
			padding-top:50px;
			padding-left:50px;
			padding-right:50px;
			padding-bottom:80px;
		}
		.form-control{
			color:black !important;
			font-weight: bold !important;
			font-size:15px !important;
			height:50px !important;
			font-family:-webkit-pictograph !important;
		}
		
		.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: black !important;
		  font-weight:bold !important;
		  font-size:15px !important;
		  text-transform: uppercase !important;
		  border-radius:initial !important;
		}
		.form-control:focus{
			background: #00000033;
			color:white;
		}
		.form-control::-moz-placeholder { /* Firefox 19+ */
		  	background: #00000033;
			color:white;
		}
		.form-control:-ms-input-placeholder { /* IE 10+ */
		  	background: #00000033;
			color:white;
		}
		.form-control:-moz-placeholder { /* Firefox 18- */
		  	background: #00000033;
			color:white;
		}
		.form-control:-webkit-autofill {
		    background: #2023239c;
		}
		.form-div{
			top: 60px;
		}
		.btn-submit{
			border-radius: initial;
			color: white;
		    border-color: #29487d;
		    background: #29487d;
		    font-family: -webkit-pictograph;
		    font-weight: bold;
		}
		.btn-submit:hover{
			color: white;
		    border-color: #29487d;
		    background: #29487d;
		}
		.btn-submit:focus{
			color: white;
		    border-color: #29487d;
		    background: #29487d;
		}
		h2{
			color:black;
			font-weight:bold;
		}

	</style>
	<div class="col-xs-12 form-div">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 well">
				<form action="{{url('admin/add/user')}}" method="post">
					{{ csrf_field() }}
					<div class="col-xs-12 text-center logo-div">
						<h2><i class="fa fa-btn fa-user-plus green"></i> New User</h2>
					</div>
					<div class="form-group">
						
					</div>
					<div class="form-group">
						<input type="text" class="form-control login-form text-center" name="name" placeholder="Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control login-form text-center" name="email" placeholder="Email Address">
					</div>
					<div class="form-group">
						<input type="text" class="form-control login-form text-center" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control login-form text-center" name="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-default btn-lg btn-block btn-submit">Register</button>
				</form>
			</div>

		</div>
	</div>

@endsection

@section('js')

@endsection