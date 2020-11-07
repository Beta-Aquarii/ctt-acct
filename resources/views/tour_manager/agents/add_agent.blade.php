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

	</style>
	<div class="col-xs-12 form-div">
		<div class="row">

			<div class="col-xs-12 col-sm-12 well">
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="col-xs-12 text-center header-div">
						<h2><i class="fa fa-btn fa-plus orange"></i> New Agent</h2>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<input type="text" class="form-control field-form" name="name" placeholder="Name" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<input type="text" class="form-control field-form" name="address" placeholder="Address" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<select class="form-control" name="nature" required>
								<option class="option-style" value="">Nature of Business</option>
								<option class="option-style" value="Travel Agency">Travel Agency</option>
								<option class="option-style" value="OTA">OTA</option>
								<option class="option-style" value="Hotel">Hotel</option>
								<option class="option-style" value="Corporate">Corporate</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<input type="text" class="form-control field-form" min="1" name="tin" placeholder="TIN" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<input type="number" class="form-control field-form" min="0" name="contract_rate" placeholder="Contract Rate">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<input type="text" class="form-control field-form" name="payment_terms" placeholder="Payment Terms">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea class="textarea" placeholder="Notes" name="notes">

							</textarea>
						</div>
					</div>
					
					<div class="col-xs-12 content-lower"></div>
					<div class="col-xs-12 details-div"></div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="co-xs-12 col-sm-12 col-md-12 text-right">
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_name[]" class="form-control field-form" placeholder="Name">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_designation[]" class="form-control field-form" placeholder="Designation">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="email" name="contact_email[]" class="form-control field-form" placeholder="Email Address">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_number[]" class="form-control field-form" placeholder="Contact Number">
								</div>
							</div>
						</div>
						<div class="agentContact">

						</div>
						<div class="col-xs-12 content-lower"></div>
						
						<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
							<div class="row text-center">
								<button type="button" class="btn btn-dark btn-md btn-add add-contact btn-block"><i class="fa fa-plus"></i> Add Contact</button>
							</div>
						</div>
					</div>

					<div class="col-xs-12 content-lower"></div>
					<div class="col-xs-12 details-div"></div>
					
					<div class="col-xs-12">
						<button type="submit" class="btn btn-default btn-lg btn-block btn-submit"><i class="fa fa-save"></i> Commit</button>
					</div>
					<div id="contact-div" class="hidden">
						<div class="co-xs-12 col-sm-12 col-md-12 text-right">
							<button class="btn btn-danger removeItem" type="button"><i class="fa fa-times"></i></button>
							<div class="col-xs-12 text-right content-lower">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_name[]" class="form-control field-form" placeholder="Name">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_designation[]" class="form-control field-form" placeholder="Designation">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="email" name="contact_email[]" class="form-control field-form" placeholder="Email Address">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<div class="form-group">
									<input type="text" name="contact_number[]" class="form-control field-form" placeholder="Contact Number">
									<input type="hidden" name="contact_id[]" value="0">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>

@endsection

@section('js')

@endsection