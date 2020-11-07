@if(count($result)!=0)
	@foreach($result as $r)
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="panel panel-default">
			  	<div class="panel-heading text-center bg-red">
			  		<span class="text-bold white size-15">
			  			@if($r->isAdmin == 0)
			  				Admin
			  			@elseif($r->isAgent == 0)
			  				Agent
			  			@elseif($r->isAccounting == 0)
			  				Accounting
			  			@elseif($r->isReservation == 0)
			  				Reservation
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
			  	<div class="panel-body">
			  		<div class="col-xs-12 text-center">
			  			<label>
			  				<i class="fa fa-user-circle grey size-25"></i>
			  				<span class="size-15 black">{{$r->name}}</span>
			  			</label><br>
			  			<span class="label label-default bg-blue">{{$r->username}}</span><br>
			  			<span class="label label-danger bg-dark">{{$r->email}}</span>
				    </div>
			  	</div>
			</div>
		</div>
	@endforeach
@else
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="well text-center">
			<i class="fa fa-info-circle fa-spin size-25 orange size-90"></i>
			<h2>Sorry! We couldn't find what you are looking for...</h2>
			<label class="black text-bold size-s">Possible Causes:</label><br>
			<label class="blue text-bold">No user records found in the database</label><br>
			<label class="blue text-bold">The user has been removed</label><br>
			<label class="blue text-bold">Search input is misspelled</label>
		</div>
	</div>
@endif