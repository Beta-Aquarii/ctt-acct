@if(count($result)!=0)
	@foreach($result as $r)
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="panel panel-default">
			  	<div class="panel-heading text-center bg-green">
			  		<span class="text-bold white size-15">{{$r->nature}}</span>
			  		<div class="btn-group float-right gear-position">
						<button type="button" class="dropdown-toggle gear-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-gear white size-s"></i>
						</button>
						<ul class="dropdown-menu">
							<li class="text-center"><a href="#" class="text-bold br-edit"><i class="fa fa-pencil-square-o blue"></i> Edit</a></li>
						    <li role="separator" class="divider"></li>
						    <li class="text-center"><a href="#" class="text-bold br-edit"><i class="fa fa-plus green"></i> Contact</a></li>
						    <li role="separator" class="divider"></li>
						    <li class="text-center"><a href="#" class="text-bold br-delete deleteThisAgent" data-act="{{$r->id}}" data-var="agents" data-name="{{$r->name}}"><i class="fa fa-close red"></i> Delete</a></li>
						</ul>
					</div>
			  	</div>
			  	<div class="panel-body">
			  		<div class="col-xs-12 text-center">
				    	<h4 class="black text-bold">{{$r->name}}</h4>
				    	<span class="label label-default"><i class="fa fa-phone-square blue"></i> {{$r->aCount}} Available contacts</span>
				    </div>
			  	</div>
			</div>
		</div>
	@endforeach
@else
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="well text-center">
			<i class="fa fa-circle-o-notch fa-spin size-25 orange size-90"></i>
			<h2>Sorry! We couldn't find what you are looking for...</h2>
			<label class="black text-bold size-s">Possible Causes:</label><br>
			<label class="blue text-bold">No agent records found in the database</label><br>
			<label class="blue text-bold">The user has been removed</label><br>
			<label class="blue text-bold">Search input is misspelled</label>
		</div>
	</div>
@endif