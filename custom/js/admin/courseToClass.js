$(function(){

	//alert('hello from courseToClass js file');

	var delBtn   = $('#example1');
	var editBtn  = $('#example1');
	var viewBtn  = $('#example1');
	var baseUrl  = $('#base').val();
	var hRoomBtn = $('#addHomeRoomBtn');

	let courseToClassBtn = $('#addCourseToClassBtn');
	let class_id = $('#class');

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

	$('#xAddCourseToClassClose, #addCourseToClassClose')
		.on('click', function(){

			location.reload('class/'+class_id.val());

	})	

	hRoomBtn
		.on('click', function(){

			let teacher_id = $('#teacher_id').val();

			if(teacher_id != 0){

				$.ajax({
					url: baseUrl+'Admins/assignHomeRoom', 
					type: 'post',
					dataType: 'json',
					data: {
						id: class_id.val(),
						teacher_id: teacher_id
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Homeroom teacher was successfully assigned!' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Homeroom teacher could not be assigned. Check that the teacher you\'re assigning to this class has not been already assinged to homeroom of another class.','Alpha SMS Says');
					}
				})

			}
			else
			if(teacher_id == 0){
				toastr.error('Please select a teacher to assign as homeroom!','Alpha SMS Says')
			}

		})		

	courseToClassBtn
		.on('click', function(){

			//alert('adding course to class!');

			let courseList = $('#courseList');
			let teacherList = $('#teacherList');
			let moduleList = $('#moduleList');

			//test for empty data...

			if($.trim(class_id.val()).length > 0 && $.trim(courseList.val()).length > 0 && $.trim(teacherList.val()).length > 0
			   && $.trim(moduleList.val()).length > 0){

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addCourseToClass',    
				    dataType:'json',
				    type:'post',
				    data: {
				    	class:class_id.val(), 
				    	course:courseList.val(),  
				    	teacher:teacherList.val(),
				    	module:moduleList.val() 
				    }           
				})
				.done(function( response ){

					if(response){

						toastr.success('Course was successfully assigned!', 'Alpha SMS Says');

						//clean up fields for new entry...

						//short_name.val("");
						//des.val("");					
					}
					else{
						toastr.error('Course could not be assigned!', 'Alpha SMS Says');
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
			let studentId = current_row.find('td:eq(0)').text();
			//let studentName = current_row.find('td:eq(1)').text();

			if(confirm('Are you sure you want to delete [ '+ studentId + ' ] from the course list?')){

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delCourseToClassById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {
					//window.location.replace(baseUrl+'class/'+row_id);	

					if(response){
						$('#'+row_id).fadeOut('slow');
						toastr.success('[ ' + studentId + ' ] was successfully removed from the course list for this class', 'Alpha SMS Says')
					}
					else{
						toastr.error('[ ' + studentId + ' ] could not be removed from the course list for this class!', 'Alpha SMS Says')
					}					

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
			  url: baseUrl+"Admins/getCourseToClassById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  //list all courses and teachers

			  	let coursesValues = [];
			  	let teachersValues = [];

				$('#courseList>option').each(function(i, option) {
				 coursesValues.push([$(option).val(),$(option).text()]);
				});

				$('#teacherList>option').each(function(i, option) {
				 teachersValues.push([$(option).val(),$(option).text()]);
				});

			  $('#upCourseName').empty();
			  $('#upTeacherName').empty();

			  /////////////////////////////


			  $.each(response.cTC,function(key,value){

			  	$("#courseToClassDbId").val(value.id);
				$("#classId").val(value.class_id);

				for (var i = 0; i < coursesValues.length; i++) {
					if(value.course_id == coursesValues[i][0]){
						$('#upCourseName').append('<option value="' + coursesValues[i][0] + '" selected="selected">' + coursesValues[i][1] + '</option>');
					}
					else{
						$('#upCourseName').append('<option value="' + coursesValues[i][0] + '">' + coursesValues[i][1] + '</option>');
					}
				}

				for (var c = 0; c < teachersValues.length; c++) {
					if(value.teacher_id == teachersValues[c][0]){
						$('#upTeacherName').append('<option value="' + teachersValues[c][0] + '" selected="selected">' + teachersValues[c][1] + '</option>');
					}
					else{
						$('#upTeacherName').append('<option value="' + teachersValues[c][0] + '">' + teachersValues[c][1] + '</option>');
					}
				}

				if(value.status == 1){
					$('#upStatus').empty().append('<option value="0">Inactive</option><option value="1" selected="selected">Active</option>');
				}
				else{
					$('#upStatus').empty().append('<option value="0" selected="selected">Inactive</option><option value="1">Active</option>');
				}


				//$('#upImage').val(value.image);
				$("#upNumOfModules").val(value.modules);
				$('#updateAdmin').modal('show'); 

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
			  url: baseUrl+"Admins/getCourseToClassById", 
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  let className = '';
			  let status = '';

			  console.log(response);

			  //getting courses and teachers here...

			  	let coursesValues = [];
			  	let teachersValues = [];

				$('#courseList>option').each(function(i, option) {
				 coursesValues.push([$(option).val(),$(option).text()]);
				});

				$('#teacherList>option').each(function(i, option) {
				 teachersValues.push([$(option).val(),$(option).text()]);
				});

				console.log(coursesValues);
				console.log(teachersValues);

			  $.each(response.cTC,function(key,value){
			  	
			  	e.preventDefault();

			  	for (var i = 0; i < coursesValues.length; i++) {
			  		
			  		if(value.course_id == coursesValues[i][0]){
			  			courseName = coursesValues[i][1];
			  			break;
			  		}
			  		else{
			  			courseName = 'Unknown Course';
			  		}
			  	}

			  	for (var i = 0; i < teachersValues.length; i++) {
			  		
			  		if(value.teacher_id == teachersValues[i][0]){
			  			teacherName = teachersValues[i][1];
			  			break;
			  		}
			  		else{
			  			teacherName = 'Unknown Teacher';
			  		}
			  	}

			  	if(value.status == '1'){
			  		status = 'Active';
			  	}
			  	else
				if(value.status == '0')
			  	{
			  		status = 'Inactive';
			  	}
			  	
			  	$('#viewCourse').text(courseName);
			  	$('#viewTeacher').text(teacherName);
			  	$('#viewModules').text(value.modules);
			  	$('#viewStatus').text(status);

			  	$('#viewAdmin').modal('show'); 

			  });
			});
		})
});