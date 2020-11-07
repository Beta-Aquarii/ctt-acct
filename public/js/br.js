$(document).ready(function(){

	$(document).on('click', '.removeItem', function() {

		$(this).parent().remove();

	});

	$('.add-peak').on('click',function(){
							
		$('.peakDate').append($('#peak-div').html());

	});

	$('.add-contact').on('click',function(){
							
		$('.agentContact').append($('#contact-div').html());

	});

	jQuery('body').on('focus', '[class*=si-date]' ,function(){
		
		jQuery(this).datepicker({			

			dateFormat			: 'M d yy',

			numberOfMonths : 2,

			minDate	: 0		

			

		});
	
	}); 

	jQuery('body').on('focus', '[class*=sr-date]' ,function(){
		
		jQuery(this).datepicker({			

			dateFormat			: 'M d yy',

			numberOfMonths : 2	

		});
	
	}); 

	jQuery('body').on('focus', '[class*=date-from]' ,function(){
		
		jQuery(this).datepicker({			

			dateFormat			: 'd M',

			numberOfMonths : 2,

			minDate	: 0		

			

		});
	
	}); 

	jQuery('body').on('focus', '[class*=date-to]', function(){
		
		jQuery(this).datepicker({

			dateFormat		: 'd M',

			numberOfMonths : 2,

			minDate	: 1	

			//startDate	: '+3d'		

		});
	});

	jQuery('body').on('focus', '[class*=tour-date]' ,function(){
		
		jQuery(this).datepicker({			

			dateFormat			: 'M d yy',

			numberOfMonths : 1,

			minDate	: $(this).data('lead')

			

		});
	
	}); 

	$('.guide-with-1').on('blur', function(){
		$('.guide-with').val($(this).val());
	});

	$('.guide-without-1').on('blur', function(){
		$('.guide-without').val($(this).val());
	});

	$('.fa-gear').on('focus', function(){
		$(this).addClass('fa-spin');
	});
	$('.fa-gear').on('blur', function(){
		$(this).removeClass('fa-spin');
	});

	$('.deleteThisTour').on('click', function(e){
		e.preventDefault();
			
		btn = $(this);
		swal({   
			title: "Delete this tour?",
			text: "Once deleted, you will not be able to recover this tour!",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function(){
			$.ajax({
				url: '/admin/delete',
				headers: {'X-CSRF-TOKEN': $('input[name=deleteToken]').val()},
				data: {
					'id':btn.data('act'),
					'var':btn.data('var'),
					'name':btn.data('name')
				},
				type:'POST',
				datatype:'text',
				success:function(d){
					if(d == 'success'){
						swal("Success!", "Tour has been deleted from the database!", "success");
						$('.confirm').on('click', function(){
							$(location).attr('href','/admin/tours');
						});
					}else{
						swal("Failed!", "Unable to delete the tour", "error");
					}
				}
			});
		});
	});

	$('.verifySoa').on('click', function(e){
		e.preventDefault();
			
		btn = $(this);
		soaName = btn.data('soaname');

		swal({   
			title: "Verify SOA "+soaName+"?",
			text: "Once verified, SOA status is unchangeable",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function(){
			$.ajax({
				url: '/accounting/verify',
				headers: {'X-CSRF-TOKEN': $('input[name=verifyToken]').val()},
				data: {
					'id':btn.data('soaid'),
					'name':btn.data('soaname')
				},
				type:'POST',
				datatype:'text',
				success:function(d){
					if(d == 'success'){
						swal("Success!", "Statement of Account has been verified", "success");
						$('.confirm').on('click', function(){
							$(location).attr('href','/accounting/statement-of-account');
						});
					}else{
						swal("Failed!", "Unable to verify Statement of Account", "error");
					}
				}
			});
		});
	});

	$('.deleteThisAgent').on('click', function(e){
		e.preventDefault();
			
			btn = $(this);
			if(btn.data('var') === "tours"){
				redir = '/admin/tours';
				warni = ""
			}else if(btn.data('var') === "agents"){
				redir = '/admin/agents';
			}else if(btn.data('var') === "users"){
				redir = '/admin/users';
			}
			swal({   
				title: "Delete "+btn.data('name')+"?",
				text: "Once deleted, you will not be able to recover its contents!",
				type: "info",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
			}, function(){
				$.ajax({
					url: '/admin/delete',
					headers: {'X-CSRF-TOKEN': $('input[name=deleteToken]').val()},
					data: {
						'id':btn.data('act'),
						'var':btn.data('var'),
						'name':btn.data('name')
					},
					type:'POST',
					datatype:'text',
					success:function(d){
						if(d == 'success'){
							swal("Success!", btn.data('name')+" deleted from the database!", "success");
							$('.confirm').on('click', function(){
								$(location).attr('href',redir);
							});
						}else{
							swal("Failed!", "Unable to delete the agent", "error");
						}
					}
				});
			});
		});

	$('.search-button').on('click', function(){
		
		type = $('.search-value').data('var');
		fs = $('.search-value').val();
		act = $(this).data('act');

		$.get("tour-fs",{'fs':fs,'type':type, 'act':act},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter').on('click', function(){
		type = $('.search-value').data('var');
		fs = $(this).data('filtval');
		act = $(this).data('act');

		$.get("tour-fs",{'type':type,'fs':fs,'act':act},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si').on('click', function(){
		val = $('.search-value').val();
		fs = $(this).data('filtval');

		$.get("/reservation/si-search",{'val':val,'fs':fs},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si-acc').on('click', function(){
		val = $('.search-value').val();
		fs = $(this).data('filtval');
		stat = $('.search-filter-status').val();

		$.get("/accounting/si-search",{'val':val,'fs':fs,'stat':stat},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si-table-acc').on('click', function(){
		val = $('.search-value').val();
		fs = $(this).data('filtval');
		stat = $('.search-filter-status').val();

		$.get("/accounting/si-search-table",{'val':val,'fs':fs,'stat':stat},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si-row').on('click', function(){

		fs = $(this).data('filtval');

		$.get("/reservation/si-filter-row",{'fs':fs},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si-table-row-acc').on('click', function(){

		fs = $(this).data('filtval');
		stat = $('.search-filter-status').val();

		$.get("/accounting/si-filter-table-row",{'fs':fs,'stat':stat},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.filter-si-row-acc').on('click', function(){

		fs = $(this).data('filtval');
		stat = $('.search-filter-status').val();

		$.get("/accounting/si-filter-row",{'fs':fs,'stat':stat},function(data){
			$(".searchResult" ).html(data );
		});

	});

	$('.br-add-contact').on('click', function(){

		x = $(this);

		$('.agent-title').html(x.data('title'));
		$('#addContact').modal('show');

	})

	$('.close-modal').on('click', function(){
		$('.field-form').val('');
	});

	$(document).on('click', '.removeItemEdit', function(e) {

		
		e.preventDefault();
		btn = $(this);
		remove = $(this).parent();
		check = btn.data('check');
		id = btn.data('id');
		
		swal({   
			title: "Remove this "+check+"?",
			text: "Once deleted, you will not be able to recover its contents!",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function(){
			$.ajax({
				url: '/admin/deleteconorpeak',
				headers: {'X-CSRF-TOKEN': $('input[name=deleteToken]').val()},
				data: {
					'check':check,
					'id':id
				},
				type:'POST',
				datatype:'text',
				success:function(d){
					if(d == 'success'){
						swal("Success!", btn.data('name')+" deleted from the database!", "success");
						$('.confirm').on('click', function(){
							remove.remove();
						});
					}else{
						swal("Failed!", "Unable to delete the agent", "error");
					}
				}
			});
		});
	});

	$('body').on('click', '.si-agent' ,function(){

		$('#agent-modal').modal('show');

	});

	$('body').on('click', '.si-agent-search-button' ,function(){

		$('.si-agent-search-results').empty();
		search = $('.si-agent-search-value').val();

		$.get("/reservation/si-agent-search",{'search':search},function(data){
			$(".si-agent-search-results" ).html(data);
		});

	});

	$('body').on('click', '.si-particular-search-button' ,function(){

		$('.si-particular-search-results').empty();
		search = $('.si-particular-search-value').val();

		$.get("/reservation/si-particular-search",{'search':search},function(data){
			$(".si-particular-search-results" ).html(data);
		});

	});
	
	$('body').on('click', '.toggle-agent-details' ,function(){	

		x = $(this);
		$('.agent-details-title').html(x.data('agent-title'));
		$('.agent-details-note').html(x.data('agent-note'));
		$('.agent-details-tin').html(x.data('agent-tin'));
		$('.agent-details-contacts').html(x.data('agent-contacts'));
		$('.agent-details-payment').html(x.data('agent-payment'));

		$('#agent-details-modal').modal('show');

	});

	$('body').on('click', '.agent-add-button' ,function(){	

		aId = $(this).data('agent-id');

		$.get("/reservation/si-agent-add",{'aId':aId},function(data){
			$(".si-agent-add-div" ).html(data);
			$('.modal').modal('hide');
		});

	});

	$('body').on('click', '.agent-add-others' ,function(){	

		aId = $(this).data('agent-id');
		nature = $(this).data('val');

		$.get("/reservation/si-agent-add",{'aId':aId},function(data){
			$('.modal').modal('hide');
			$('.si-agent-add-div').html(data);
			$('.agent-ajax-nature').html(nature);
			
			if(nature === "Web"){
				$('.agent-others').val(nature);
			}
			
		});

	});

	$('body').on('click', '.si-particular' ,function(){

		$('#particular-modal').modal('show');

	});
	$('body').on('click', '.toggle-particular-custom-details' ,function(){

		x = $(this);
		price = x.data('particular-price');
		pax = x.data('particular-pax');
		comi = x.data('particular-com');
		total = price * pax;
		com = comi * pax
		net = total-com;

		$('.particular-details-title').html(x.data('particular-name'))
		$('.particular-details-total').html(total);
		$('.particular-details-com').html(com);
		$('.particular-details-net').html(net);

		$('#particular-details-modal').modal('show');		

	});

	$('body').on('click', '.particular-add-button' ,function(){

		pId = $(this).data('particular-id');

		$.get("/reservation/si-particular-add",{'pId':pId},function(data){
			$('.si-particular-add-div').append(data);
			$('.modal').modal('hide');
		});

	});

	$('.particular-add-custom').on('click' ,function(){

		$('.si-particular-add-div').append($('#custom-particular-div').html());

	});

	$('body').on('click', '.particular-remove-button' ,function(){

		btn = $(this);
		swal({   
			title: "Remove this particular?",
			text: "Once removed, data won't be recovered!",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function(){
			$.ajax({
				url: '',
				success:function(){
					swal("Success!", "Particular has been removed!", "success");
					btn.parents('.si-particular-table').remove();
					total = btn.closest('.si-particular-table').find('.particular_total').val();
					toSub = $('.overall-total').html();
					overall = parseFloat(toSub-total).toFixed(2);
					$('.overall-total').html(overall);
				}
			});
		});

	});

	$('body').on('click', '.particular-remove-button-edit' ,function(){

		btn = $(this);
		swal({   
			title: "Remove this particular?",
			text: "Once removed, data won't be recovered!",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,

		}, function(){
			$.ajax({
				url: '/reservation/remove/particular-edit',
				headers: {'X-CSRF-TOKEN': $('input[name=_variable]').val()},
				data: {
					'id':btn.data('particular-id'),
					'name':btn.data('particular-name'),
					'si':btn.data('si'),
					'total':btn.closest('.si-particular-table').find('.particular_total').val()
				},
				success:function(d){

					if(d === 'success'){
						btn.parents('.si-particular-table').remove();
						swal("Success!", "Particular "+btn.data('particular-name')+" has been removed!", "success");
						total = btn.closest('.si-particular-table').find('.particular_total').val();
						toSub = $('.overall-total').html();
						overall = parseFloat(toSub-total).toFixed(2);
						$('.overall-total').html(overall);
					}else{
						swal("Failed!", "Unable to delete the particular", "error");
					}
				}
			});
		});

	});

	$('body').on('click', '.change-local' ,function(){

		
		$(this).closest('.btn-group').find('.particular-local').val($(this).data('val'));
		$(this).closest('.btn-group').find('.local-count').html($(this).data('val'));


	});

	$('body').on('click', '.change-foreign' ,function(){

		
		$(this).closest('.btn-group').find('.particular-foreign').val($(this).data('val'));
		$(this).closest('.btn-group').find('.foreign-count').html($(this).data('val'));

	});

	$('body').on('click', '.change-dropdown' ,function(){

		
		$(this).closest('.btn-group').find('.particular-dropdown').val($(this).data('val'));
		$(this).closest('.btn-group').find('.dropdown-count').html($(this).data('val'));

	});

	$('body').on('change', '.for-particular-details' ,function(){

		price = $(this).closest('.si-particular-table').find('.particular-price').val();
		pax = $(this).closest('.si-particular-table').find('.particular-pax').val();
		com = $(this).closest('.si-particular-table').find('.particular-com').val();
		name = $(this).closest('.si-particular-table').find('.particular-name').val();
		
		$(this).closest('.si-particular-table').find('.toggle-particular-custom-details').data('particular-price', price);
		$(this).closest('.si-particular-table').find('.toggle-particular-custom-details').data('particular-pax', pax);
		$(this).closest('.si-particular-table').find('.toggle-particular-custom-details').data('particular-com', com);
		$(this).closest('.si-particular-table').find('.toggle-particular-custom-details').data('particular-name', name);

	});

	$('body').on('change', '.particular-calc-date' ,function(){

		x = $(this);
		pId = $('.particular_id').val();
		date = $(this).closest('.particular-calc-div').find('.particular-calc-date').val();
		com = $(this).closest('.particular-calc-div').find('.particular_com').val();
		local = $(this).closest('.particular-calc-div').find('.particular-local').val();
		foreign = $(this).closest('.particular-calc-div').find('.particular-foreign').val();
		guide = $(this).closest('.particular-calc-div').find('.particular-guide').val();

		$.get("/reservation/si-particular-calc",{'pId':pId, 'date':date, 'com':com, 'local':local, 'foreign':foreign, 'guide':guide},function(data){
			total = parseFloat(data).toFixed(2);
			x.closest('.particular-calc-div').find('.particular_total').val(total);
			x.closest('.particular-calc-div').find('.particular_rate').val(data.rate);

			$('.particular_total').each(function() {
				overall += +$(this).val();
			});

			overall = parseFloat(overall).toFixed(2).toLocaleString('en');
			$('.overall-total').html(overall);
			$('.overall-total-value').val(overall);
			$('.hidden-div').removeClass('hidden');

		}, 'json');

	});

	$('body').on('click', '.particular-calc' ,function(){
		
		x = $(this);
		pId = $('.particular_id').val();
		date = $(this).closest('.particular-calc-div').find('.si-date').val();
		com = $(this).closest('.particular-calc-div').find('.particular_com').val();
		local = $(this).closest('.particular-calc-div').find('.particular-local').val();
		foreign = $(this).closest('.particular-calc-div').find('.particular-foreign').val();
		guide = $(this).closest('.particular-calc-div').find('.particular-guide').val();
		overall = 0;

		$.get("/reservation/si-particular-calc",{'pId':pId, 'date':date, 'com':com, 'local':local, 'foreign':foreign, 'guide':guide},function(data){
			total = parseFloat(data.total).toFixed(2);
			x.closest('.particular-calc-div').find('.particular_total').val(total);
			x.closest('.particular-calc-div').find('.particular_rate').val(data.rate);

			$('.particular_total').each(function() {
				overall += +$(this).val();
			});

			overall = parseFloat(overall).toFixed(2).toLocaleString('en');
			$('.overall-total').html(overall);
			$('.overall-total-value').val(overall);
			$('.hidden-div').removeClass('hidden');
		}, 'json');

	});

	$('body').on('change', '.custom-calc' ,function(){

		x = $(this);
		rate = $(this).closest('.custom-calc-div').find('.particular-rate').val();
		pax = $(this).closest('.custom-calc-div').find('.particular-pax').val();
		overall = 0;

		if(pax == 0 || pax == null){
			total = parseFloat(rate).toFixed(2);
		}else{
			total = parseFloat(rate*pax).toFixed(2);
		}

		x.closest('.custom-calc-div').find('.particular_total').val(total);

		$('.particular_total').each(function() {
			overall += +$(this).val();
		});

		overall = parseFloat(overall).toFixed(2).toLocaleString('en');
		$('.overall-total').html(overall);
		$('.overall-total-value').val(overall);
		$('.hidden-div').removeClass('hidden');
	

	});

	$('.sr-generate').on('click', function(){

		s_date = $('.sr-start').val();
		e_date = $('.sr-end').val();

		$.get("sr-get-date",{'s_date':s_date,'e_date':e_date},function(data){
			$(".searchResult" ).html(data );
		});

	});


	$(function () {
	  	$('[data-toggle="popover"]').popover();
	})

});
