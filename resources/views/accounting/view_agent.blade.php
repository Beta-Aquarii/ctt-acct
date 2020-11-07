@extends('layouts.accounting')

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
	<input type="hidden" value="{{csrf_token()}}" name="deleteToken">
	@foreach($agent as $a)
		<div class="col-xs-12 form-div">
			<div class="row">

				<div class="col-xs-12 col-sm-12 well">
					<form action="" method="post">
						{{ csrf_field() }}
						<div class="col-xs-12 text-center header-div">
							<h2><i class="fa fa-btn fa-edit orange"></i> {{$a->name}}</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<input type="text" class="form-control field-form" name="name" placeholder="Name" required value="{{$a->name}}" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<input type="text" class="form-control field-form" name="address" placeholder="Address" required value="{{$a->address}}" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<select class="form-control" name="nature" required readonly>
									<option class="option-style" value="">Nature of Business</option>
									<option class="option-style" <?php if($a->nature === "Travel Agency"){echo "selected";} ?> value="Travel Agency">Travel Agency</option>
									<option class="option-style" <?php if($a->nature === "OTA"){echo "selected";} ?> value="OTA">OTA</option>
									<option class="option-style" <?php if($a->nature === "Hotel"){echo "selected";} ?> value="Hotel">Hotel</option>
									<option class="option-style" <?php if($a->nature === "Corporate"){echo "selected";} ?> value="Corporate">Corporate</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<input type="text" class="form-control field-form" min="1" name="tin" placeholder="TIN" required value="{{$a->tin}}" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<input type="number" class="form-control field-form" min="0" name="contract_rate" placeholder="Contract Rate" value="{{$a->contract_rate}}" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="form-group">
								<input type="text" class="form-control field-form" name="payment_terms" placeholder="Payment Terms" value="{{$a->payment_terms}}" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<textarea class="textarea" placeholder="Notes" name="notes" rows="10">
									{!!$a->notes!!}
								</textarea>
							</div>
						</div>
						
						<div class="col-xs-12 content-lower"></div>
						<div class="col-xs-12 details-div text-center">
							<label class="size-25 black"><i class="fa fa-address-book green"></i> Contact</label>
						</div>

						<div class="row">
							@foreach($contacts as $c)
								<div class="co-xs-12 col-sm-12 col-md-12 text-right form-group">
									<div class="col-xs-12 col-sm-12 col-md-12 text-center">
										<div class="form-group">
											<label class="size-m"><i class="fa fa-user"></i> {{$c->name}}</label>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<div class="form-group">
											<div class="input-group">
                        						<span class="input-group-addon text-bold white bg-dark">Designation</span>
												<input type="text" name="contact_designation[]" class="form-control field-form" placeholder="Designation" value="{{$c->designation}}" readonly>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<div class="form-group">
											<div class="input-group">
                        						<span class="input-group-addon text-bold white bg-dark">Email</span>
												<input type="email" name="contact_email[]" class="form-control field-form" placeholder="Email Address" value="{{$c->email}}" readonly>
											</div>
										</div>
									</div>
									<input type="hidden" name="contact_id[]" value="{{$c->id}}">
									<div class="col-xs-12 col-sm-12 col-md-4">
										<div class="form-group">
											<div class="input-group">
                        						<span class="input-group-addon text-bold white bg-dark">Contact</span>
												<input type="text" name="contact_number[]" class="form-control field-form" placeholder="Contact Number" value="{{$c->contact_number}}" readonly>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>

						<div class="col-xs-12 content-lower"></div>
						<div class="col-xs-12 details-div"></div>
						
					</form>
				</div>

			</div>
		</div>
	@endforeach

@endsection

@section('js')

@endsection