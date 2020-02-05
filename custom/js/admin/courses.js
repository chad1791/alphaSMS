$(function(){
	//alert('hello from administrators js file');

	var delBtn = $('#example1');
	var editBtn = $('#example1');
	var viewBtn = $('#example1');
	var baseUrl = $('#base').val();

	let addCourseBtn = $('#addCourseBtn');

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

	$('#xAddCourseClose, #addCourseClose')
		.on('click', function(){

			location.reload('courses');

	})	

	addCourseBtn
		.on('click', function(){

			let short_name = $('#short_name');
			let course = $('#course');
			let type = $('#type');
			let des = $('#des');

			//test for empty data...

			if($.trim(short_name.val()).length > 0 && $.trim(course.val()).length > 0 && $.trim(des.val()).length > 0
			   && $.trim(type.val()).length > 0){

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addCourse',    
				    dataType:'json',
				    type:'post',
				    data: {
				    	short_name:short_name.val(), 
				    	course:course.val(),  
				    	type:type.val(),
				    	des:des.val(), 
				    }           
				})
				.done(function( response ){

					if(response){

						toastr.success('Course was successfully added!', 'Alpha SMS Says');

						//clean up fields for new entry...

						short_name.val("");
						des.val("");					
					}
					else{
						toastr.error('Course could not be added!', 'Alpha SMS Says');
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
			let short = current_row.find('td:eq(0)').text();
			let name = current_row.find('td:eq(1)').text();

			if(confirm('Are you sure you want to delete ['+short+' '+name+'] from the Course list?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delCourseById", 
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					//window.location.replace(baseUrl+'courses'); 
					toastr.success('Course data was successfully deleted!', 'Alpha SMS Says');

					$('#'+row_id).fadeOut('slow');						
					
				})
				
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
			  url: baseUrl+"Admins/getCourseById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  $.each(response.course,function(key,value){

				$('#courseDbId').val(value.id);
				$('#upShortName').val(value.short);
				$('#upCourseName').val(value.name);

				//let type = value.type;	

				if(value.type == 0){
					$('#upType')
							.append(
								'<option value="0" selected="selected">Support</option>'+
								'<option value="1">Trade</option>'
							);
				}
				else
				if(value.type == 1){
					$('#upType')
							.append(
								'<option value="0">Support</option>'+
								'<option value="1" selected="selected">Trade</option>'
							);
				}

				if(value.status == 1){
					$('#upStatus').empty().append('<option value="0">Inactive</option><option value="1" selected="selected">Active</option>');
				}
				else{
					$('#upStatus').empty().append('<option value="0" selected="selected">Inactive</option><option value="1">Active</option>');
				}

				$('#upDesc').val(value.description);

				//$('#upImage').val(value.image);

			  });
			});
		})

	viewBtn
		.on('click','[data-fnx="view"]',function(e){ 

			e.preventDefault();

			var row_id = $(this).data('view_id');
			let current_row = $('#'+row_id);

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getCourseById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  console.log(response.course);

			  $.each(response.course,function(key,value){
			  	
			  	//e.preventDefault();
			  	let type = 'Support';

			  	if(value.type == 1){
			  		type = 'Trade';
			  	}

			  	if(value.status == '1'){ 
			  		status = 'Active';
			  	}
			  	else
				if(value.status == '0')
			  	{
			  		status = 'Inactive';
			  	}

			  	$('#viewShort').text(value.short);
			  	$('#viewCourse').text(value.name);
			  	$('#viewType').text(type);
				$('#viewStatus').text(status);
			  	$('#viewDescription').text(value.description);
			  	$('#viewSettings').empty().append('<a href="' + 'class/' + value.id + '">Setup courses and teachers</a>');

			  	$('#viewAdmin').modal('show'); 

			  });
			});
		})
});