$(function(){

	let baseUrl 	= $('#base').val();
	let stdId   	= $('#student_id').val();
	let admin_id    = $('#admin_id').val();
	let class_id	= $('#class_id').val();
	let department  = $('#department').val();
	let colors     = ["#3498DB","#E67E22","#9B59B6","#CCD1D1","#ABEBC6","#E74C3C","#1D8348","#196F3D","#1ABC9C","#76448A","#212F3C","#A04000","#16A085","#7DCEA0","#F5CBA7","#5499C7","#48C9B0","#FAD7A0","#E74C3C","#45B39D","#7DCEA0","#21618C","#B9770E","#616A6B","#A569BD","#F0B27A","#AEB6BF","#0E6655","#A04000","#979A9A","#1ABC9C","#F5CBA7","#D98880","#154360","#3498DB","#E67E22","#9B59B6","#CCD1D1","#ABEBC6","#E74C3C","#1D8348","#196F3D","#1ABC9C","#76448A","#212F3C","#A04000","#16A085","#7DCEA0","#F5CBA7","#5499C7","#48C9B0","#FAD7A0","#E74C3C","#45B39D","#7DCEA0","#21618C","#B9770E","#616A6B","#A569BD","#F0B27A","#AEB6BF","#0E6655","#A04000","#979A9A","#1ABC9C","#F5CBA7","#D98880","#154360"];
	let listOfC     = [];
	let numOfM      = [];
	let preGrades  = []; 

	//variables for general setting tab...

	let accStatus 			= $('#accStatus');
	let canLogin 			= $('#canLogin');
	let canViewGrades		= $('#canViewGrades');
	let canViewAttendance	= $('#canViewAttendance');

	//variables for behaviour tab - demerits ...

	let addDemeritBtn   = $('#addDemeritBtn'); 
	let toggleUpDemBtn  = $('#example1');
	let updateDemBtn    = $('#updateDemeritBtn');
	let delDemBtn 		= $('#example1');

	//variables for behaviour tab - jugs

	let addJugBtn 		= $('#addJugBtn');
	let toggleUpJugBtn  = $('#example2');
	let updateJugBtn    = $('#updateJugBtn');
	let delJugBtn 		= $('#example2');

	//variables for behaviour tab - suspensions

	let addSuspensionBtn 	   = $('#addSuspensionBtn');
	let toggleUpSuspensionBtn  = $('#example3');
	let updateSuspensionBtn    = $('#updateSuspensionBtn');
	let delSuspensionBtn       = $('#example3'); 

	//variables for behaviour tab - expulsions

	let addExpulsionBtn   	   = $('#addExpulsionBtn');
	let toggleUpExpulsionBtn   = $('#example4');
	let updateExpulsionBtn     = $('#updateExpulsionBtn');
	let delExpulsionBtn        = $('#example4'); 

	//variables for the tabs...

	let graphs 		= $('#graphs_tab');
	let grades 		= $('#grades_tab');
	let attendance	= $('#attendance_tab');
	let behaviour	= $('#behaviour_tab');
	let general		= $('#general_tab');

	//variable for attendance tab content...

	let attendanceCont = $('#attendanceCont');
	let gradeCont      = $('#gradesCont');

	//variable for graphs tab content

	let graphsCont     = $('#graphsCont');
	let piesCont       = $('#piesCont');

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

	$('#xAddDemeritClose, #addDemeritClose')
		.on('click', function(){

			location.reload();

	})	

	graphs
	.add(grades)
	.add(attendance)
	.add(behaviour)
	.add(general)
		.off()
		.on('click', function(){

			let tab   = $(this).text().toLowerCase();
			let db_id = $(this).data('db_id');

			console.log(db_id);

			if(db_id != ''){ 

				graphs.data('db_id', db_id); 
				grades.data('db_id', db_id); 
				attendance.data('db_id', db_id); 
				behaviour.data('db_id', db_id); 
				general.data('db_id', db_id); 				

				$.ajax({
					url: baseUrl+'Admins/updateLastTab',
					type: 'post', 
					dataType: 'json',
					data: {
						db_id: db_id,
						page: 'student',
						name: 'lastTab',
						value: tab
					}
				})
				.done(function(response){
					if(response){
						console.log(response);
					}
					else{
						console.log(response);
					}
				})

			}
			else{

				$.ajax({
					url: baseUrl+'Admins/addLastTab',
					type: 'post', 
					dataType: 'json',
					data: {
						owner_id: admin_id,
						owner_type: 'admin_log',
						page: 'student',
						name: 'lastTab',
						value: tab
					}
				})
				.done(function(response){

					//console.log(response);

					if(response.result){

						//console.log(response);

						graphs.attr('data-db_id', response.db_id); 
						grades.attr('data-db_id', response.db_id); 
						attendance.attr('data-db_id', response.db_id); 
						behaviour.attr('data-db_id', response.db_id); 
						general.attr('data-db_id', response.db_id);  
					}
					else{
						console.log(response);
					}
				})

			}

		})	

	accStatus
		.on('click', function(){

			if(!$(this).is(':checked')){
				//alert('Unchecking can login!');

				$.ajax({
					url: baseUrl+'Admins/toggleAccStatus',
					type: 'post',
					dataType: 'json',
					data: {
						id: stdId,
						status: 0
					}
				})
				.done(function(response){ 
					if(response){
						toastr.success('Student Account settings were successfully changed. Student account status has been changed to inactive' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			else{

				$.ajax({ 
					url: baseUrl+'Admins/toggleAccStatus',
					type: 'post', 
					dataType: 'json',
					data: {
						id: stdId,
						status: 1
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student account status has been changed to active' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			
		})		

	canLogin
		.on('click', function(){

			if(!$(this).is(':checked')){
				//alert('Unchecking can login!');

				$.ajax({
					url: baseUrl+'Admins/toggleCanLogin',
					type: 'post',
					dataType: 'json',
					data: {
						id: stdId,
						status: 0
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student won\'t be able to login into his account' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			else{

				$.ajax({
					url: baseUrl+'Admins/toggleCanLogin',
					type: 'post', 
					dataType: 'json',
					data: {
						id: stdId,
						status: 1
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student is allowed to login into his account' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			
		})

	canViewGrades
		.on('click', function(){

			if(!$(this).is(':checked')){
				//alert('Unchecking can login!');

				$.ajax({
					url: baseUrl+'Admins/toggleCanViewGrades',
					type: 'post',
					dataType: 'json',
					data: {
						id: stdId,
						status: 0
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student won\'t be able to view his grades' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			else{

				$.ajax({
					url: baseUrl+'Admins/toggleCanViewGrades',
					type: 'post', 
					dataType: 'json',
					data: {
						id: stdId,
						status: 1
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student is allowed to view his grades' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			
		})

	canViewAttendance
		.on('click', function(){

			if(!$(this).is(':checked')){
				//alert('Unchecking can login!');

				$.ajax({
					url: baseUrl+'Admins/toggleCanViewAttendance',
					type: 'post',
					dataType: 'json',
					data: {
						id: stdId,
						status: 0
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student won\'t be able to view his attendance' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			else{

				$.ajax({
					url: baseUrl+'Admins/toggleCanViewAttendance',
					type: 'post', 
					dataType: 'json',
					data: {
						id: stdId,
						status: 1
					}
				})
				.done(function(response){
					if(response){
						toastr.success('Student Account settings were successfully changed. Student is allowed to view his attendance' ,'Alpha SMS Says');
					}
					else{
						toastr.error('Student Account settings couldn\'t be changed! Please try again later.','Alpha SMS Says');
					}
				})

			}
			
		})	

		addDemeritBtn
			.on('click', function(){

				//collect data for the demerit record...

				let teacher_id  = $('#teacher_id');
				let description = $('#desc');
				let date1       = $('#datepicker');

			//test for empty data...

			if($.trim(teacher_id.val()).length > 0 && $.trim(description.val()).length > 0){

				// call ajax to submit demerit info...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addDemerit',     
				    dataType:'json',
				    type:'post',
				    data: {
				    	student_id: stdId,
				    	teacher_id:teacher_id.val(),
				    	date1: date1.val(),  
				    	desc:description.val()
				    }           
				})
				.done(function( response ){ 
					if(response){
						toastr.success('Demerit record was successfully added!','Alpha SMS Says');
						description.val('');
					}
					else{
						toastr.error('Demerit record could not be added! Try again later.','Alpha SMS Says');
					}
				})
			}
			else{
				toastr.error('Please fill in all fields to proceed!','Alpha SMS Says');
			}
		});

		toggleUpDemBtn
			.on('click','[data-fnx="update"]',function(e){
				
				e.preventDefault();	

				var row_id = $(this).data('up_id');
				let current_row = $('#'+row_id);

				//alert(row_id);	

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/getDemeritById",
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response.length != ''){
						
						let demerit = response.demerit[0];

						$('#demeritDbId').val(demerit.id);
						$('#upTeacherId').val(demerit.teacher_id);
						$('#datepicker2').datepicker("setDate", demerit.date);   
						$('#upDesc').val(demerit.des);
					}

				})

		});

		updateDemBtn
			.on('click',function(){

				let db_id 		= $('#demeritDbId').val();
				let upTeacherId = $('#upTeacherId').val();
				let date2        = $('#datepicker2').val();
				let upDesc	    = $('#upDesc').val();

				//call ajax to update demerit record...

				$.ajax({
					url: baseUrl + "Admins/updateDemeritRecord", 
					method: "POST",
					dataType: "json",
					data: {
						id: db_id, 
						teacher_id: upTeacherId,
						date2: date2,
						desc: upDesc
					}
				})
				.done(function( response ){

					if(response){
						toastr.success('Demerit record was successfully updated!','Alpha SMS Says');
					}
					else{
						toastr.error('Demerit record could not be updated! Try again later.','Alpha SMS Says');
					}

				})
		});

	delDemBtn
		.on('click','[data-fnx="delete"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);

			if(confirm('Are you sure you want to delete this demerit record?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delDemeritById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){
						toastr.success('Demerit record successfully deleted!', 'Alpha SMS Says');
						$('[data-Dem_id="'+row_id+'"]').fadeOut('slow');
					}
					else{
						toastr.error('Demerit record could not be deleted! Try again later.','Alpha SMS Says');
					}											
					
				})
				
			} 

	});	

	addJugBtn	
		.on('click', function(){

				//collect data for the jug record...

				let description = $('#jugDesc');
				let date3       = $('#datepicker3');

			//test for empty data...

			if($.trim(description.val()).length > 0 && $.trim(date3.val()).length > 0){

				// call ajax to submit jug info...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addJug',     
				    dataType:'json',
				    type:'post',
				    data: {
				    	student_id: stdId,
				    	date3: date3.val(),  
				    	desc:description.val()
				    }           
				})
				.done(function( response ){ 
					if(response){
						toastr.success('Jug record was successfully added!','Alpha SMS Says');
						description.val('');
					}
					else{
						toastr.error('Jug record could not be added! Try again later.','Alpha SMS Says');
					}
				})
			}
			else{
				toastr.error('Please fill in all fields to proceed!','Alpha SMS Says');
			}
	});	

	toggleUpJugBtn	
		.on('click','[data-fnx="upJug"]',function(e){
				
			e.preventDefault();	

			let row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getJugById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

				if(response.length != ''){
						
					let jug = response.jug[0];

					$('#jugDbId').val(jug.id);
					$('#datepicker4').datepicker("setDate", jug.date);  
					$('#upJugStatus').val(jug.status);
					$('#upJugDesc').val(jug.des);
				}
			})
	});

	updateJugBtn	
		.on('click',function(){

			let db_id 		= $('#jugDbId').val();
			let date4       = $('#datepicker4').val();
			let upStatus    = $('#upJugStatus').val();
			let upDesc	    = $('#upJugDesc').val();

			//call ajax to update jug record...

			$.ajax({
				url: baseUrl + "Admins/updateJugRecord", 
				method: "POST",
				dataType: "json",
				data: {
					id: db_id, 
					status: upStatus,
					date4: date4,
					desc: upDesc
				}
			})
			.done(function( response ){

				if(response){
					toastr.success('Jug record was successfully updated!','Alpha SMS Says');
				}
				else{
					toastr.error('Jug record could not be updated! Try again later.','Alpha SMS Says');
				}

			})
	});

	delJugBtn
		.on('click','[data-fnx="delJug"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);

			if(confirm('Are you sure you want to delete this jug record?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delJugById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){
						toastr.success('Jug record successfully deleted!', 'Alpha SMS Says');
						$('[data-Jug_id="'+row_id+'"]').fadeOut('slow');
					}
					else{
						toastr.error('Jug record could not be deleted! Try again later.','Alpha SMS Says');
					}											
					
				})
				
			} 

	});

	addSuspensionBtn
		.on('click', function(){

				//collect data for the suspension record...

				let description = $('#susDesc');
				let from        = $('#datepicker5');
				let to_date     = $('#datepicker6');

			//test for empty data...

			if($.trim(description.val()).length > 0 && $.trim(from.val()).length > 0 && $.trim(to_date.val()).length > 0){

				// call ajax to submit suspension info...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addSuspension',     
				    dataType:'json',
				    type:'post',
				    data: {
				    	student_id: stdId,
				    	from: from.val(),
				    	to: to_date.val(),  
				    	desc:description.val()
				    }           
				})
				.done(function( response ){ 
					if(response){
						toastr.success('Suspension record was successfully added!','Alpha SMS Says');
						description.val('');
					}
					else{
						toastr.error('Suspension record could not be added! Try again later.','Alpha SMS Says');
					}
				})
			}
			else{
				toastr.error('Please fill in all fields to proceed!','Alpha SMS Says');
			}
	});

	toggleUpSuspensionBtn
		.on('click','[data-fnx="upSuspension"]',function(e){
				
			e.preventDefault();	

			let row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getSuspensionById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

				if(response.length != ''){
						
					let suspension = response.suspension[0];

					console.log(suspension);

					$('#suspensionDbId').val(suspension.id);
					$('#datepicker7').datepicker("setDate", suspension.start); 
					$('#datepicker8').datepicker("setDate", suspension.end);
					$('#upSuspensionDesc').val(suspension.des);
				}
			})
	});	

	updateSuspensionBtn
		.on('click',function(){

			let db_id 		= $('#suspensionDbId').val();
			let from        = $('#datepicker7').val();
			let to_date     = $('#datepicker8').val();
			let upDesc	    = $('#upSuspensionDesc').val();

			//call ajax to update suspension record...

			$.ajax({
				url: baseUrl + "Admins/updateSuspensionRecord", 
				method: "POST",
				dataType: "json",
				data: {
					id: db_id, 
					from: from,
					to: to_date,
					desc: upDesc
				}
			})
			.done(function( response ){

				if(response){
					toastr.success('Suspension record was successfully updated!','Alpha SMS Says');
				}
				else{
					toastr.error('Suspension record could not be updated! Try again later.','Alpha SMS Says');
				}

			})
	});

	delSuspensionBtn	
		.on('click','[data-fnx="delSuspension"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);

			if(confirm('Are you sure you want to delete this Suspension record?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delSuspensionById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){
						toastr.success('Suspension record successfully deleted!', 'Alpha SMS Says');
						$('[data-Sus_id="'+row_id+'"]').fadeOut('slow');
					}
					else{
						toastr.error('Suspension record could not be deleted! Try again later.','Alpha SMS Says');
					}											
					
				})
				
			} 

	});

	addExpulsionBtn		
		.on('click', function(){

				//collect data for the expulsion record...

				let description = $('#expDesc');
				let date1       = $('#datepicker9');

			//test for empty data...

			if($.trim(description.val()).length > 0 && $.trim(date1.val()).length > 0){

				// call ajax to submit expulsion info...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addExpulsion',     
				    dataType:'json',
				    type:'post',
				    data: {
				    	student_id: stdId,
				    	date: date1.val(),  
				    	desc:description.val()
				    }           
				})
				.done(function( response ){ 
					if(response){
						toastr.success('Expulsion record was successfully added!','Alpha SMS Says');
						description.val('');
					}
					else{
						toastr.error('Expulsion record could not be added! Try again later.','Alpha SMS Says');
					}
				})
			}
			else{
				toastr.error('Please fill in all fields to proceed!','Alpha SMS Says');
			}
	});

	toggleUpExpulsionBtn
		.on('click','[data-fnx="upExpulsion"]',function(e){
				
			e.preventDefault();	

			let row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getExpulsionById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

				if(response.length != ''){
						
					let expulsion = response.expulsion[0];

					console.log(expulsion);

					$('#expulsionDbId').val(expulsion.id);
					$('#datepicker10').datepicker("setDate", expulsion.date); 
					$('#upExpulsionDesc').val(expulsion.des);
				}
			})
	});

	updateExpulsionBtn
		.on('click',function(){

			let db_id 		= $('#expulsionDbId').val();
			let date1       = $('#datepicker10').val();
			let upDesc	    = $('#upExpulsionDesc').val();

			//call ajax to update suspension record...

			$.ajax({
				url: baseUrl + "Admins/updateExpulsionRecord", 
				method: "POST",
				dataType: "json",
				data: {
					id: db_id, 
					date: date1,
					desc: upDesc
				}
			})
			.done(function( response ){

				if(response){
					toastr.success('Expulsion record was successfully updated!','Alpha SMS Says');
				}
				else{
					toastr.error('Expulsion record could not be updated! Try again later.','Alpha SMS Says');
				}

			})
	});	

	delExpulsionBtn
		.on('click','[data-fnx="delExpulsion"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);

			if(confirm('Are you sure you want to delete this Expulsion record?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delExpulsionById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){
						toastr.success('Expulsion record successfully deleted!', 'Alpha SMS Says');
						$('[data-Exp_id="'+row_id+'"]').fadeOut('slow');
					}
					else{
						toastr.error('Expulsion record could not be deleted! Try again later.','Alpha SMS Says');
					}											
					
				})
				
			} 

	});

	//get all courses...

	var jqxhr = $.ajax({
		url: baseUrl+'Admins/getAllCourses',   
		dataType:'json',
		type:'post',
		//data: {id:class_id}           
	})          
	.done(function(courses) {
	 	//console.log(courses);

	 	$.each(courses.allCourses, function(key,value){

	 		let id    = value.id;
	 		let name  = value.name;
	 		let short = value.short;
	 		
	 		listOfC.push({id:id, name:name, short:short});
	 	})

	 	//console.log(listOfC);

	})	

	//get and draw all the attendance of the student for all courses...

	$.ajax({
		method: "POST",
		url: baseUrl+"Admins/getMyCoursesByClassId",
		dataType: "json",
		data: { class_id: class_id }
	})
	.done(function( response ) {

		if(response.length != ''){

			//console.log(response);

			$.each(response.courseList, function(key, value){

				let course_id = value.course_id;

				//console.log(student_id, class_id, course_id);

				let AttData = ["Present", "Absent", "Late", "Sick", "Dismissed"]; 				

				$.ajax({
					method: "POST",
					url: baseUrl+"Admins/getCourseAttByStudentId",
					dataType: "json",
					data: { 
						student_id: stdId,
						class_id: class_id,
						course_id: course_id
					}
				})
				.done(function( data ) {
					//console.log(data);
          			
          			let presentCount = 0;
          			let absentCount = 0;
          			let lateCount = 0;
          			let sickCount = 0;
          			let dismissedCount = 0;        			

					$.each(data, function(key, value){ 

						let courseName = '';

						$.each(listOfC, function(k, v){

							if(key == v.id){
								courseName = '<b>' + v.name + ' ( ' + v.short + ' )</b>';
							}
						})

              			attendanceCont
              				.append(
              			    	'<div class="col-md-12">'+
                        			'<div class="box">'+
                          				'<div class="box-header">'+
                            				'<h3 class="box-title">'+
                            					courseName +
                            				'</h3>'+
											//'<div class="pull-right box-tools"></div>'+
                                        '</div>'+
                                        '<div class="box-body outer" style="position: relative"><div style="position: relative" class="scrolling outer"><div class="inner" style="overflow-x: auto; overflow-y: visible; margin-left: 120px;">'+
                                            '<table id="att'+ key +'" class="table table-bordered table-striped" style="table-layout: inherit;">'
                                                
                            )

              			$('#att'+key) 
              				.append(
              					'<thead>'+
                                    '<tr id="att_head' + key + '"><th style="vertical-align: top; padding: 10px; min-width: 100px; position: absolute; left: 0; width: 120px; *position: relative;" class="hard_left">Date</th>'
              				)	

              			$.each(value, function(key2, value2){

              				let word_date = moment(value2.date).format('ll');

              				$('#att_head'+key)
              						.append(
              							'<th style="vertical-align: top; padding: 10px; min-width: 100px;">'+ word_date +'</th>'
              						)
              			})

              			$('#att'+key)
              				.append(
              						'</tr>'+
              					'</thead>'
              				)

              			$('#att'+key)
              				.append(
                                '<tbody><tr id="att_body'+key+'"><th style="font-weight:bold; vertical-align: top; padding: 10px; min-width: 100px; position: absolute; left: 0; width: 120px; *position: relative;" class="hard_left">Status</th>'
              				)

              			$.each(value, function(key2, value2){
              				$('#att_body'+key)
              						.append(
              							'<td style="vertical-align: top; padding: 10px; min-width: 100px;">'+ AttData[value2.attendance-1] +'</td>'
              						)
              			})

              			$('#att'+key)
              				.append(
              							'</tr>'+
									'</tbody>'
              				)              				              			

              			attendanceCont
                            .append(
                                            '</table>'+
                                        '</div>'+
                                    '</div>'+
								'</div>'
                        		//'</div>'+
                     			//'</div>'
                            )
					});

				});

			});

		}
	});


	//get and draw all the grades of the student for all courses...

	if(department == 1){		

		$.ajax({
			method: "POST",
			url: baseUrl+"Admins/getMyCoursesByClassId",
			dataType: "json",
			data: { class_id: class_id }
		})
		.done(function( response ) {

			if(response.length != ''){

				//console.log(response);			

				$.each(response.courseList, function(key, value){

					let course_id = value.course_id;
					let modules   = value.modules;	

					//call the attendance for the student....
					getAttendance(course_id);		
		 		
		 			numOfM.push({id:course_id, modules:modules});

					$.ajax({
						method: "POST",
						url: baseUrl+"Admins/getCourseGradesByStudentId",
						dataType: "json",
						data: { 
							student_id: stdId,
							class_id: class_id,
							course_id: course_id
						}
					})
					.done(function( data ) {       								

						$.each(data, function(key, value){

							let courseName = '';
							let modNumb = 0;

							$.each(listOfC, function(k, v){

								if(key == v.id){
									courseName = '<b>' + v.name + ' ( ' + v.short + ' )</b>';
								}
							});

							$.each(numOfM, function(k2, v2){

								if(key == v2.id){
									modNumb = v2.modules;
								}
							});

							//console.log(modNumb);								

		                  	gradeCont
		                  		.append('<div class="col-md-12">'+
		                        			'<div class="box">'+
		                        				'<div class="box-header">'+
		                           					'<h3 class="box-title">'+
		                           						courseName +
													'</h3>'+
		                           					'<div class="pull-right box-tools"></div>'+
		                        				'</div>'+
		                        				'<div class="box-body">'+
		                           					'<table id="grade'+ key +'" class="table table-bordered table-striped">'+
		                           						'<thead>'+
	                               							'<tr id="grade_head'+key+'">'                                					
		                    );


		              		$('#grade'+key)
		              			.append(
		              					'</tr>'+
									'</thead>'+
									'<tbody>'+
										'<tr id="grade_body'+key+'">'+
										'</tr>'+
									'</tbody>'+
	                            	'<tfoot>'+
	                               		'<tr id="grade_foot'+ key +'">'+
										'</tr>'+                              
	                            	'</tfoot>'
		              		)

		              		//draw header for table...
		              					
	                        for (i=1; i <= modNumb; i++) { 
	                            $('#grade_head'+key).append('<th>M'+i+'</th>');
	                        }


	                        //draw content for the table body...

	                        for(m=1; m <= modNumb; m++){

	                            let modFound = false;

	                            $.each(value, function(key2, value2){

	                            	if(value2.module == m){
	                                	$('#grade_body'+key).append('<td>'+value2.mark+'</td>');
	                                	modFound = true;
	                                }

	                            })

	                            if(modFound == false){
	                                $('#grade_body'+key).append('<td></td>');
	                            }
	                        }

		              		//draw footer for table...
		              					
	                        for (i=1; i <= modNumb; i++) { 
	                            $('#grade_foot'+key).append('<th>M'+i+'</th>');
	                        }

		              		$('#grade'+key)
		                       	.append(
		                                    '</table>'+
		                                '</div>'+
		                            '</div>'+
								'</div>'
		                    )                  				

	                    })

					});

				});

			}
		})
	}
	else
	if(department == 0){  

		gradeCont
			.append(
				'<div class="col-md-12">'+
                    '<div class="box">'+
                        '<div class="box-header">'+
                          '<h3 class="box-title">'+
                          	'<b>Student grades by subject name</b>'+
                       	  '</h3>'+
                          //'<div class="pull-right box-tools"></div>'.
                        '</div>'+
                        '<div class="box-body">'+
                          '<table id="" class="table table-bordered table-striped">'+
                             '<thead>'+
                               '<tr id="grade_head">'+
							   '</tr>'+
                             '</thead>'+
                             '<tbody>'+
                               '<tr id="grade_body">'+
							   '</tr>'+
							 '</tbody>'+
                             '<tfoot>'+
                               '<tr id="grade_foot">'+
							   '</tr>'+                              
                             '</tfoot>'+
                          '</table>'+
						'</div>'+
                    '</div>'+
                '</div>'
            );
		

		$.ajax({
			method: "POST",
			url: baseUrl+"Admins/getMyCoursesByClassId",
			dataType: "json",
			data: { class_id: class_id }
		})
		.done(function( response ) {

			if(response.length != ''){

				$.each(response.courseList, function(key, value){

					let course_id = value.course_id;

					//call the attendance for the student....
					getAttendance(course_id);	

					$.ajax({
						method: "POST",
						url: baseUrl+"Admins/getCourseGradesByStudentId",
						dataType: "json",
						data: { 
							student_id: stdId,
							class_id: class_id,
							course_id: course_id
						}
					})
					.done(function( data ) { 

						$.each(data, function(key, value){

							let courseName = '';
							
							$.each(listOfC, function(k, v){

								if(key == v.id){
									courseName = '<b>' + v.name + '</b>';
								}
							});

		              		//draw header for table...              					
	                        
	                        $('#grade_head').append('<th>'+courseName+'</th>');

	                        //draw content for the table body...

	                        $('#grade_body').append('<td>'+value[0].mark+'</td>');

	                        //draw footer for table... 

	                        $('#grade_foot').append('<th>'+courseName+'</th>');

						})

					})
				})
			}

		})

	}

	if(department == 0){
		drawPrevoc();
	}	
	else
	if(department == 1){ 
		drawTrade();
	}

	//will draw graphs for prvoc student...

	 function drawPrevoc(){

		//get all the courses for the student...

		var jqxhr = $.ajax({
			url: baseUrl+'Admins/getStdCoursesNGrades',   
			dataType:'json',
			type:'post',
			data: {id:class_id, student_id:stdId}           
		})          
		.done(function(response) {

			if ( response.length != 0 ) {				

				$.each(response.courseListNGrade, function(key,value){

					let courseName = '';
					let shortName = '';
					let courseKey = value.course_id;

					//get the name of the course...

					console.log(listOfC);

					$.each(listOfC,function(key,val){

						if(val.id == courseKey){
							courseName = val.name;
							shortName = val.short;
						}
					})

					//push into array

					preGrades.push({id:courseKey, short:shortName, name:courseName, mark:value.mark});

				})			
				
				console.log(preGrades);

			}
		})
		.done(function(){

			//console.log('This happens after the .ajax call...');

			if(preGrades.length > 0){

				graphsCont
					.append(
						'<div class="col-lg-12">'+
							'<div class="box box-info">'+
								'<div class="box-header with-border">'+
									'<i class="fa fa-bar-chart-o"></i>'+
									'<h3 class="box-title">Bar Chart showing all grades</h3>'+
								'</div>'+
								'<div class="box-body" id="prevBodyChart">'+
								'<div id="prevChart" style="width:100%; height:250px;"></div>'
					);					

				graphsCont
					.append(
								'</div>'+
							'</div>'+
						'</div>'	
					);					

				let chartData = '[';
				let arrayLenght = preGrades.length;
				let count = 1;		
				
				$.each(preGrades, function(key, value){

					console.log(value);

					let randNum = Math.ceil(Math.random() * (68 - 0) + 0);

					//prepare json data to feed the bar graph...
															
					chartData += '{';
					chartData += '"completeName": "';
					chartData += value.name;
					chartData += '"';
					chartData += ', "visits":';
					chartData += value.mark;
					chartData += ', "country": " ';
					chartData += value.short;
					chartData += '"';
					chartData += ', "color": "';
					chartData += colors[randNum];
					chartData += '"';
					chartData += '}';

					if(count < arrayLenght){
						chartData += ',';								
					}

					count++;
				})
				
				chartData+=']';

				chartDataJson = JSON.parse(chartData);

				console.log(chartDataJson);

				if(chartData != '[]'){

					var chart = AmCharts.makeChart("prevChart", {
						"type": "serial",
						"theme": "light",
						"marginRight": 70,
						"dataProvider": chartDataJson,
						"valueAxes": [{
							"axisAlpha": 0,
							"position": "left",
							"title": "Grade Per Course Frequency"
						}],
						"startDuration": 1,
						"graphs": [{
							"balloonText": "<b>[[completeName]]: [[visits]]</b>",
							"fillColorsField": "color",
							"fillAlphas": 0.9,
							"lineAlpha": 0.2,
							"type": "column",
							"valueField": "visits"
						}],
						"chartCursor": {
							"categoryBalloonEnabled": false,
							"cursorAlpha": 0,
							"zoomable": false
						},
						"categoryField": "country",
						"categoryAxis": {
							"gridPosition": "start",
							"labelRotation": 45
						},
						"export": {
							"enabled": false
						}
					})
				}

			}


		})		

	 }

	 function drawTrade(){

		//get all the courses for the student...

		var jqxhr = $.ajax({
			url: baseUrl+'Admins/getStudentCoursesById',    
			dataType:'json',
			type:'post',
			data: {id:class_id}           
		})          
		.done(function(response) {

			//console.log(response.courseList);

			if ( response.length != 0 ) {

				//runs for all courses and get the grades...

				$.each(response.courseList, function(key,value){ 

						//get the grades for the student...

						var jqxhr = $.ajax({
						url: baseUrl+'Admins/getGradesByStudentId', 
						dataType:'json',
						type:'post',
						data: {student_id:stdId, class_id:class_id, course_id:value.course_id}           
						})          
						.done(function(data) {	

							//console.log(data);				

							$.each(data,function(key,value){

								let courseName = '';
								let shortName = '';
								let courseKey = key;

								//get the name of the course...

								$.each(listOfC,function(key,value){

									//console.log(value.id + ' == ' + courseKey);

									if(value.id == courseKey){
										courseName = value.name;
										shortName = value.short;
									}
								})

								//draw the containers for the bar charts...

								graphsCont
									.append(
									'<div class="col-lg-6">'+
										'<div class="box box-primary">'+
											'<div class="box-header with-border">'+
												'<i class="fa fa-bar-chart-o"></i>'+
												'<h3 class="box-title">'+ courseName + '</h3>'+
											'</div>'+
											'<div class="box-body" id="body'+courseKey+'">'
									);

								let courseBody = $('#body'+courseKey);

								courseBody
									.append('<div id="bar'+ courseKey +'" style=" width:100%; height:250px;"></div>');	
								
								let chartData = '[';
								let arrayLenght = value.length;
								let count = 1;

								$.each(value,function(key,value){

									//prepare json data to feed the bar graph...
									let randomNum = Math.ceil(Math.random() * (68 - 0) + 0);
										
									chartData += '{';
									chartData += '"completeName": "M';
									chartData += value.module;
									chartData += '"';
									chartData += ', "visits":';
									chartData += value.mark;
									chartData += ', "country": "Module ';
									chartData += value.module;
									chartData += '"';
									chartData += ', "color": "';
									chartData += colors[randomNum];
									chartData += '"';
									chartData += '}';

									if(count < arrayLenght){
										chartData += ',';								
									}

									//console.log('Count: ' + count + ', arrayLenght: ' + arrayLenght);

									count++;
								})

								chartData+=']';

								chartDataJson = JSON.parse(chartData);

								if(chartData != '[]'){

									var chart = AmCharts.makeChart("bar"+courseKey, {
										"type": "serial",
										"theme": "light",
										"marginRight": 70,
										"dataProvider": chartDataJson,
										"valueAxes": [{
											"axisAlpha": 0,
											"position": "left",
											"title": "Grade Per Course Frequency"
										}],
										"startDuration": 1,
										"graphs": [{
											"balloonText": "<b>[[completeName]]: [[visits]]</b>",
											"fillColorsField": "color",
											"fillAlphas": 0.9,
											"lineAlpha": 0.2,
											"type": "column",
											"valueField": "visits"
										}],
										"chartCursor": {
											"categoryBalloonEnabled": false,
											"cursorAlpha": 0,
											"zoomable": false
										},
										"categoryField": "country",
										"categoryAxis": {
											"gridPosition": "start",
											"labelRotation": 45
										},
										"export": {
											"enabled": false
										}
									})
								}

								graphsCont
									.append(
										'</div>'+
									'</div>'+
									'</div>'	
									);							

							})

						})

				})	
			}
		})

	 }	

	function getAttendance(course_id){

		//get the attendance for the student...

		var jqxhr = $.ajax({
			url: baseUrl+'Admins/getCourseAttByStudentId',   
			dataType:'json',
			type:'post',
			data: {
				student_id:stdId, 
				class_id:class_id, 
				course_id:course_id
			}           
		})          
		.done(function(data) {	
	
			//console.log(data);
	
			$.each(data,function(key,value){
	
				let courseName = '';
				let shortName = '';
				let courseKey = key;
	
				//get the name of the course...
	
				$.each(listOfC,function(key,value){
	
					//console.log(value.id + ' == ' + courseKey);
	
					if(value.id == courseKey){
						courseName = value.name;
						shortName = value.short;
					}
				})
	
				//draw the containers for the bar charts...
	
				piesCont
					.append(
						'<div class="col-lg-6">'+
							'<div class="box box-primary">'+
								'<div class="box-header with-border">'+
									'<i class="fa fa-pie-chart"></i>'+
									'<h3 class="box-title">'+ courseName + '</h3>'+
								'</div>'+
								'<div class="box-body" id="bodyPie'+courseKey+'">'
				);
	
				let courseBody = $('#bodyPie'+courseKey);
	
				courseBody
					.append('<div id="pie'+ courseKey +'" style=" width:100%; height:250px;"></div>');	
	
								
				//let chartDiv = $('#bar'+courseKey);	
				let pieData = '[';
				let arrayLenght = value.length;
				let count = 1;
	
				let presentCount = 0;
				let absentCount = 0;
				let lateCount = 0;
				let sickCount = 0;
				let dismissedCount = 0;
	
				//let attCount = [];
	
				//console.log('Array Lenght: ' + value.length);
	
				$.each(value,function(key,value){
	
					//console.log(value);
	
					let attendance = value.attendance;
	
					switch(attendance){
						case "1": 
							presentCount += 1;
						break;
						case "2":
							absentCount += 1;
						break;
						case "3":
							//presentCount += 1;
							lateCount += 1;
						break;
						case "4":
							sickCount += 1;
						break;
						case "5":
							dismissedCount += 1;
						break;
						default:{
	
						}
					}	
				})
	
				//present
	
				pieData += '{';
				pieData += '"country":"Present",';
				pieData += '"litres":';
				pieData += presentCount;
				pieData += '},';
	
				//absent
	
				pieData += '{';
				pieData += '"country":"Absent",';
				pieData += '"litres":';
				pieData += absentCount;
				pieData += '},';
	
				//Late
	
				pieData += '{';
				pieData += '"country":"Late",';
				pieData += '"litres":';
				pieData += lateCount;
				pieData += '},';
	
				//Sick
	
				pieData += '{';
				pieData += '"country":"Sick",';
				pieData += '"litres":';
				pieData += sickCount; 
				pieData += '},';
	
				//Late
	
				pieData += '{';
				pieData += '"country":"Dismissed",';
				pieData += '"litres":';
				pieData += dismissedCount;
				pieData += '}';																								
	
				pieData+=']';
	
				//console.log(pieData);
	
				let pieDataJson = JSON.parse(pieData);
				//console.log($(pieDataJson));
	
				console.log('Pie Data:')
				console.log(pieDataJson);
	
				if(pieData != '[]'){
	
					var chart = AmCharts.makeChart("pie"+courseKey, {
						"type": "pie",
						"theme": "light",
						"outlineColor": "",
						"dataProvider": pieDataJson,
						"valueField": "litres",
						"titleField": "country",
						"balloon": {
							"fixedPosition": true
						}
					});						
	
				}
	
				piesCont
					.append(
								'</div>'+
							'</div>'+
						'</div>'	
				);
			})
		})
	}

	//function getAttendance($student_id, $school_year, $class_id){}		
			 
});