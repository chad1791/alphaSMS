$(function(){
	//alert('hello from administrators js file');

	var delBtn = $('#example1');
	var editBtn = $('#example1');
	var viewBtn = $('#example1');
	var baseUrl = $('#base').val();

	let addTeacherBtn = $('#addTeacherBtn');

	//general options for toastr notifications...

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

	$('#xAddTeacherClose, #addTeacherClose')
		.on('click', function(){

			location.reload('teachers');

	})		

	addTeacherBtn
		.on('click', function(){

			let email = $('#email');
			let first = $('#first');
			let last = $('#last');
			let status = $('#status');

			//test for empty data...

			if($.trim(email.val()).length > 0 && $.trim(first.val()).length > 0 && $.trim(last.val()).length > 0 
				&& $.trim(status.val()).length > 0){

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addTeacher',    
				    dataType:'json',
				    type:'post',
				    data: {
				    	email:email.val(), 
				    	first:first.val(),  
				    	last:last.val(), 
				    	status:status.val(), 
				    }           
				})
				.done(function( response ){

					if(response){
						toastr.success('Teacher account was successfully added!', 'Alpha SMS Says');

						//clean up fields for new entry...

						email.val("");
						first.val("");
						last.val("");					
					}
					else{
						toastr.error('Teacher account could not be added!', 'Alpha SMS Says');
					}

				})
			}
			else{
				toastr.error('Please fill in all fields!', 'Alpha SMS Says');
			}			

		})

	delBtn
		.on('click','[data-fnx="delete"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);
			let teacherEmail = current_row.find('td:eq(0)').text();

			if(confirm('Are you sure you want to delete [ '+teacherEmail+' ] from the teachers list?')){

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delTeacherById", 
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					//window.location.replace(baseUrl+'teachers');
					toastr.success('Teacher account was successfully deleted!', 'Alpha SMS Says');

					$('#'+row_id).fadeOut('slow');					
					
				})

				//alert(row_id);
			}

		})

	editBtn
		.on('click','[data-fnx="update"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getTeacherById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  $.each(response.teacher,function(key,value){

				$('#teacherDbId').val(value.id);
				$('#upEmail').val(value.email);				

				if(value.status == 1){
					$('#upStatus').empty().append('<option value="0">Inactive</option><option value="1" selected="selected">Active</option>');
				}
				else{
					$('#upStatus').empty().append('<option value="0" selected="selected">Inactive</option><option value="1">Active</option>');
				}

				//$('#upImage').val(value.image);

			  });
			});
		})

	viewBtn
		.on('click','[data-fnx="view"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('view_id');
			let current_row = $('#'+row_id);
			let email = current_row.find('td:eq(0)').text();

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getTeacherById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {
			 
			  let status = '';
			  console.log(response);

			  $.each(response.teacher,function(key,value){
			  	
			  	e.preventDefault();

			  	if(value.status == '1'){
			  		status = 'Active';
			  	}
			  	else
				if(value.status == '0')
			  	{
			  		status = 'Inactive';
			  	}

			  	$('#viewName').text(value.first);
			  	$('#viewLast').text(value.last);
			  	$('#viewEmail').text(value.email);
			  	$('#viewStatus').text(status);			  

			  	$('#viewAdmin').modal('show'); 

			  });
			});
		})
});