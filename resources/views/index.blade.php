@extends('layouts.cebutriptours')

@section('title')
	Cebu Trip Tours
@endsection

@section('content')
	<style>
		.logo-div{
			padding-bottom:30px;
		}
		.container-fluid{
			height: 100%;
		    width: 100%;
		    background: #0c0c0c69;
		}
		.well{
			background: #212020ba !important;
			border:1px solid #2023239c !important;
			border-radius:initial;
			padding:80px 50px;
		}
		.form-control{
			color:white;
			font-weight: bold;
			font-size:15px;
			background: #00000033;
			height:50px;
			border:1px solid #2023239c !important;
			font-family:-webkit-pictograph;
		}
		body{
			background:black url(/images/homepage-bg.jpg) no-repeat center;
			background-size:100% 100%;
		}
		.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: white;
		  font-weight:bold;
		  font-size:15px;
		  text-transform: uppercase;
		  border-radius:initial;
		}
		.form-control:focus{
			background: #00000033;
			color:white;
		}
		.form-control::-moz-placeholder { /* Firefox 19+ */
		  color: pink;
		}
		.form-control:-ms-input-placeholder { /* IE 10+ */
		  color: pink;
		}
		.form-control:-moz-placeholder { /* Firefox 18- */
		  color: pink;
		}
		.form-control:-webkit-autofill {
		    background: #2023239c;
		}
		.form-div{
			top: 20%;
		}
		.btn-submit{
			border-radius: initial;
			color: white;
		    border-color: #4fbbff;
		    background: #4fbbff;
		    font-family: -webkit-pictograph;
		    font-weight: bold;
		}
		.btn-submit:hover{
			color: white;
		    border-color: black;
		    background: #4fbbff;
		}
		.btn-submit:focus{
			color: white;
		    border-color: black;
		    background: #4fbbff;
		}
	</style>
	<div class="col-xs-12 form-div">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 well">
				<form action="{{ route('login') }}" method="POST">
					{{ csrf_field() }}
					<div class="col-xs-12 text-center logo-div">
						<img src="{{ url('images/img-logo.png') }}">
					</div>
					<div class="form-group">
						<input type="text" class="form-control login-form text-center" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control login-form text-center" name="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-default btn-lg btn-block btn-submit">LOGIN</button>
				</form>
			</div>

		</div>
	</div>

@endsection

@section('js')

@endsection