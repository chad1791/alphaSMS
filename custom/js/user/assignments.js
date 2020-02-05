$(function(){

	var showDateTime = $('[data-radio="close"]');
	var hideDateTime = $('[data-radio="open"]');
	var classToggle = $('#className');
	var submitAssig = $('#addAssignment');
	var courseDropDown = $('#courseList');
	var upCourseName  = $('#upCourseList');

	var baseUrl = $('#base').val();
	var teacherId = $('#teacher_id').val();

	var viewBtn = $('[data-fnx="view"]');
	var updateBtn = $('[data-fnx="update"]');
	var delBtn = $('[data-fnx="delete"]');

	var addExtraImage = $('#upFiles');
	var execUpdate = $('#execUpdate');

	var showStdUpAss = $('#studentUploads'); //canvas to draw the student upload DOM elements...

	//default id for the class name:

	var setDef = getCoursesListByClassId($('#className').find(":selected").val(),teacherId);

	//////////////////////////////////////////

	addExtraImage
		.on('change',function(){

			let assDbId 	 = $('#assignmentDbId').val();

			let upFiles = $('#upFiles')[0].files;
			let form_data = new FormData();	

			if ($('#upFiles').get(0).files.length !== 0) {

				for(var count = 0; count<upFiles.length; count++){

					var tmp_name = upFiles[count].name;
					var tmp_extension = tmp_name.split('.').pop().toLowerCase();

					if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
						alert('Invalid file type! Only images, pdf files and Microsoft office types accepted!');
						return false;
					}								
				}
			}

			//call ajax to submit files to the server....

			var error = '';

			for(var count = 0; count<upFiles.length; count++){

				var name = upFiles[count].name;
				var extension = name.split('.').pop().toLowerCase();

				if($.inArray(extension,['gif','png','jpg','jpeg']) == -1){
					error += "Invalid " + count + " File type";
				}
				else{
					form_data.append("files[]", upFiles[count]);
					form_data.append('id',assDbId);
				}
			}

			for (var pair of form_data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]); 
			}

			if(error == ''){

				if(confirm('Are you sure you want to upload the selected files?')){

					$.ajax({
						url: baseUrl + 'Users/uploadFiles', 
						method:'POST',
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){

							alert('Files were successfully uploaded!');

							//apend new files to the view...

							let dataJson = JSON.parse(data);
							let showAttFiles = $('#alreadyAttached');

							//draw the files representation here, enable btn functionality for each file...

							showAttFiles
								.append('<div style="border:1px dotted gray; height:28px;" data-elem_id="' + dataJson.id + '">' + 
											dataJson.file + 
											'<span class="pull-right">'+
												'<a target="_blank" href="../Users/downloadFile?file='+ dataJson.file +'" class="btn"><i class="fa fa-download"></i></a>&nbsp;'+
												'<button data-fnx="delAssFile" data-ass_id="' + dataJson.id + '"><i class="fa fa-times"></i></button>'+
											'</span>'+
										'</div><br/>');

							//add event listener for delete... 	

							let delFile = $('[data-fnx="delAssFile"]');
								
							delFile
								.off()
								.on('click',function(e){

									e.preventDefault();

									let fileId = $(this).data('ass_id');

									if(confirm('Are you sure you want to delete this file attachment?')){
										//alert(fileId);

										//call ajax to delete the current file... working on this section...

										$.ajax({
										  method: "POST",
										  url: baseUrl+"Users/delFileById", 
										  dataType: "json",
										  data: { id: fileId }
										})
										.done(function( response ) {

											//window.location.replace(baseUrl+'classes'); 
											alert('File was successfully deleted from the database...');

											//remove element from DOM...

											let remElem = $('[data-elem_id="'+fileId+'"]');

											remElem
												.fadeOut('slow');
											
										})
																				
									}

									return false;
								});

							reset_form_element($('#upFiles'));

							console.log(dataJson);							
											
						}
					})
				}

			}
			else{
				alert(error);
			}

			return false;

		})


	execUpdate
		.on('click',function(){

			let assDbId 	 = $('#assignmentDbId').val();
			let upClassId    = $('#upClassName').find(":selected").val();
			let upCourseId   = $('#upCourseList').find(":selected").val();
			let upTitle 	 = $('#upTitle').val();
			let upDesc  	 = $('#upDesc').val();

			let teacher_id = teacherId;
			let upExpiry_date = '';
			let upExpiry_time = '';
			let upEx_disable = 1;
			let upAllow_upload = 1;

			if(teacher_id !== '' && upClassId !== '' && upCourseId !== '' && upTitle !== '' && upDesc !== ''){

				//check for ex_disable value...

				if($('#upBehaviour').prop("checked") == false){
					upEx_disable = 0;	
				}

				if($('#upAllow_upload').prop("checked") == false){
					upAllow_upload = 0;	
				}

				//check if the assignment is open or have expiry date....

				var upExpiry = $('input[name=upOptionsRadios1]:checked', '#updateAdminForm').val();
					
				if(upExpiry == 1){ //if teacher has set expiry date...

					//upExpiry_date = moment($('#datepicker').val()).format('ll');
					upExpiry_date = $('#upDatepicker').val();
					upExpiry_time = moment($('#upTimepicker1').val(), 'hh:mm A').format('HH:mm:ss');

					if(upExpiry_time == '00:00:00'){
						upExpiry_time = '24:00:00';
					}					

					console.log(upExpiry_date + ', ' + upExpiry_time);

					if(upExpiry_date == '' || upExpiry_time == ''){						
						alert("Please select a date and time for your assignment or change it to type [Open].");
						return false;
					}

				}

				//call ajax to perform update...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Users/updateAssignment',   
				    dataType:'json',
				    type:'post',
				    data: {ass_id:assDbId , teacher_id:teacher_id , class_id:upClassId , course_id:upCourseId , title:upTitle , des:upDesc , expiry_date:upExpiry_date , time:upExpiry_time , allow_upload:upAllow_upload, ex_disable:upEx_disable }           
				})          
				.done(function(response) {

					if(response){
						alert('Assignment has been successfully updated!');
					}
					else{
						alert('There was an error updating assignment, please contact your system Administrator!');
					}

				})				

			}

		});

	viewBtn
		.on('click',function(){

			let ass_id = $(this).data('view_id');
			let assTitle = $('#assTitleView');
			let assBody = $('#assBody');
			
			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Users/getAssignmentById",
			  dataType: "json",
			  data: { id: ass_id }
			})
			.done(function( response ) {

			  $.each(response.assignment,function(key,value){
			  	
			  	//e.preventDefault();

			  	assTitle.empty().append(value.title + ' - View');
			  	assBody.empty().append(value.des);
			  	//$('#viewDescription').text(value.des);

			  	//get the files attached to this assignment, if none was attached: show none instead...

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Users/getStudentsAssUploads",  
				  dataType: "json",
				  data: { id: ass_id }
				})
				.done(function( response ) {

					console.log('This is the response from the server: ');
					console.log(response);

				}) 	

			  	//get submitted files for the assignment... check if file upload is allowed for this assignment...

			  	if(value.allow_upload == 1){

			  		//call ajax to get the list of students that have uploaded their assignments...

			  		
			  		
			  	}
			  	else{
			  		$('#viewPartStudents').text("This assignment don't allow students to upload files!");
			  	}

			  });
			});

			$('#viewAdmin').modal('show');
		});

	updateBtn
		.on('click',function(){

			let ass_id = $(this).data('up_id');
			let updateAssTitle = $('#assTitleUpdate');

			//call ajax to get assignment details...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Users/getAssignmentById",
			  dataType: "json",
			  data: { id: ass_id }
			})
			.done(function( response ) {

				//console.log(response.assignment);

				$.each(response.assignment, function(key,value){

					updateAssTitle.empty().append(value.title + ' - Update');
					$('#assignmentDbId').val(value.id);	
					
					//get the list of classes for this teacher...

					let classesValues = [];

					$('#className>option').each(function(i, option) {
					 	classesValues.push([$(option).val(),$(option).text()]);
					});					

					$('#upClassName')
								.empty();

					for (var i = 0; i < classesValues.length; i++) {

						if(value.class_id == classesValues[i][0]){
							$('#upClassName').append('<option value="' + classesValues[i][0] + '" selected="selected">' + classesValues[i][1] + '</option>');
						}
						else{
							$('#upClassName').append('<option value="' + classesValues[i][0] + '">' + classesValues[i][1] + '</option>');
						}

					}

					//selected id for the class name:

					var setSel = getCoursesListByClassIdUPdate($('#upClassName').find(":selected").val(),teacherId);									

					$('#upTitle').val(value.title);
					$('#upDesc').val(value.des);

					if(value.expiry_date !== ''){

						$('[data-radio="close"]').attr('checked','checked'); 
						$('[data-set_date="set"]').show();
						$('#upDatepicker').val(value.expiry_date); //pass moment parsed date...
						$('#upTimepicker1').val(value.time);

					}
					else{

						$('[data-set_date="set"]').hide();
						$('[data-radio="open"]').attr('checked','checked');
					}

					if(value.allow_upload == '1'){

						$('#upAllow_upload').attr('checked','checked'); //check true or false;

					}

					if(value.ex_disable == '1'){

						$('#upBehaviour').attr('checked','checked'); //check true or false;

					}

					//load the files that were originally uploaded!

					let showAttFiles = $('#alreadyAttached');

					$.ajax({
					  method: "POST",
					  url: baseUrl+"Users/getUploadedFilesByAssId", //get the previously uploaded files... 
					  dataType: "json",
					  data: { id: ass_id }
					})
					.done(function( response ) { 

						//console.log('Files uploaded with this assignment: ');

						if(!$.trim(response)){

							showAttFiles
									.text('No file attachements were found!');

						}
						else{							

							showAttFiles
										.empty()

							$.each(response.files,function(key,value){
								
								//console.log(value.name);

								//draw the files representation here, enable btn functionality for each file...

								showAttFiles
										.append('<div style="border:1px dotted gray; height:28px;" data-elem_id="' + value.id + '">' + 
													value.name + 
													'<span class="pull-right">'+
														'<a target="_blank" href="../Users/downloadFile?file='+ value.new_name +'" class="btn"><i class="fa fa-download"></i></a>&nbsp;'+
														'<button data-fnx="delAssFile" data-ass_id="' + value.id + '"><i class="fa fa-times"></i></button>'+
													'</span>'+
												'</div><br/>');  
								

							})	

							let delFile = $('[data-fnx="delAssFile"]');
								
							delFile
								.off()
								.on('click',function(e){

									e.preventDefault();

									let fileId = $(this).data('ass_id');

									if(confirm('Are you sure you want to delete this file attachment?')){
										//alert(fileId);

										//call ajax to delete the current file... working on this section...

										$.ajax({
										  method: "POST",
										  url: baseUrl+"Users/delFileById", 
										  dataType: "json",
										  data: { id: fileId }
										})
										.done(function( response ) {

											//window.location.replace(baseUrl+'classes'); 
											alert('File was successfully deleted from the database...');

											//remove element from DOM...

											let remElem = $('[data-elem_id="'+fileId+'"]');

											remElem
												.fadeOut('slow');
											
										})
																				
									}

									return false;
								});						

						}
					})
				});

			});

			$('#updateAdmin').modal('show');

			$('#upClassName')
				.off()
				.on('change',function(){

					let class_id = $(this).val();
					getCoursesListByClassIdUPdate(class_id,teacherId);								

				});	
		});

	delBtn
		.on('click',function(e){

			e.preventDefault();

			//let ass_id = $(this).data('rem_id');
			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);
			let assName = current_row.find('td:eq(2)').text();

			if(confirm('Are you sure you want to delete [ ' + assName + ' ] from the Assignments list?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Users/delAssignmentById", 
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					//window.location.replace(baseUrl+'classes'); 
					alert('Assignment was successfully deleted from the database...');
					location.reload();
					
				})
				
			}		
		})	

	showDateTime
		.on('click',function(){

			//expiry_time = moment($('#timepicker1').val(), 'hh:mm A').format('HH:mm:ss');
			//console.log(expiry_time);
			$('[data-set_date="set"]').fadeIn(1000);

		});

	hideDateTime
		.on('click',function(){

			$('[data-set_date="set"]').fadeOut(1000);

		}); 

	classToggle
		.on('change',function(){
			
			var class_id = $(this).find(":selected").val();
			getCoursesListByClassId(class_id,teacherId);

		});

	submitAssig
		.on('click',function(){

			//if empty, proceed to submit assignment as is...
			//gather all variables to submit assignment...

			let teacher_id = teacherId;
			let class_id = $('#className').find(":selected").val();
			let course_id = $('#courseList').find(":selected").val();
			let title = $('#title').val();
			let des = $('#desc').val();
			let expiry_date = '';
			let expiry_time = '';
			let ex_disable = 1;
			let allow_upload = 1;
			let attachments = 0;

			var files = $('#files')[0].files;
			var form_data = new FormData();				

			//add the assignment to the database....

			if(teacher_id !== '' && class_id !== '' && course_id !== '' && title !== '' && des !== ''){

				//check to see file extention to see for valid files!

				if ($('#files').get(0).files.length !== 0) {

					for(var count = 0; count<files.length; count++){

						var tmp_name = files[count].name;
						var tmp_extension = tmp_name.split('.').pop().toLowerCase();
						attachments = 1;

						if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
							alert('Invalid file type! Only images, pdf files and Microsoft office types accepted!');
							attachments = 0;
							return false;
						}								
					}
				}				

				//check for ex_disable value...

				if($('#behaviour').prop("checked") == false){
					ex_disable = 0;	
				}

				if($('#allow_upload').prop("checked") == false){
					allow_upload = 0;	
				}

				//check if the assignment is open or have expiry date....

				var expiry = $('input[name=optionsRadios1]:checked', '#assignmentsForm').val();
				
				if(expiry == 1){ //if teacher has set expiry date...

					//expiry_date = moment($('#datepicker').val()).format('ll');
					expiry_date = $('#datepicker').val();
					expiry_time = moment($('#timepicker1').val(), 'hh:mm A').format('HH:mm:ss');

					if(expiry_time == '00:00:00'){
						expiry_time = '24:00:00';
					}					

					console.log(expiry_date + ', ' + expiry_time);

					if(expiry_date == '' || expiry_time == ''){						
						alert("Please select a date and time for your assignment or change it to type [Open].");
						return false;
					}

				}

				var jqxhr = $.ajax({
				    url: baseUrl + 'Users/addAssignment',   
				    dataType:'json',
				    type:'post',
				    data: {teacher_id:teacher_id , class_id:class_id , course_id:course_id , title:title , des:des , expiry_date:expiry_date , time:expiry_time , allow_upload:allow_upload, ex_disable:ex_disable, attachments:attachments }           
				})          
				.done(function(response) {

				   	console.log('Last inserted assignment id: ');
				   	console.log(response);

				   	if(response != ''){

						if ($('#files').get(0).files.length === 0) {
						    
						    alert('Assignment has been successfully posted!');
							console.log('No attachments were uploaded!');
							location.reload();
						}
						else{

							//call ajax to submit files to the server....

							var error = '';

							for(var count = 0; count<files.length; count++){

								var name = files[count].name;
								var extension = name.split('.').pop().toLowerCase();

								if($.inArray(extension,['gif','png','jpg','jpeg']) == -1){
									error += "Invalid " + count + " File type";
								}
								else{
									form_data.append("files[]", files[count]);
									form_data.append('id',response);
								}
							}

							for (var pair of form_data.entries()) {
			    				console.log(pair[0]+ ', ' + pair[1]); 
							}

							if(error == ''){
								$.ajax({
									url: baseUrl + 'Users/uploadFiles', 
									method:'POST',
									data:form_data,
									contentType:false,
									cache:false,
									processData:false,
									beforeSend:function(){
										//show uploading to the user...
									},
									success:function(data){
										//refresh the page after the images have been uploaded...

										alert('Assignment has been successfully posted!');
										console.log(data);
										location.reload();

									}
								})
							}
							else{
								alert(error);
							}

						}

				   	}

				});

			}
			else{
				alert('Fill in all fields to submit assignment to student portal!');
			}
			
		});


	function getCoursesListByClassId(class_id,teacherId){

		courseDropDown
				.empty();

		$.ajax({
		  method: "POST",
		  url: baseUrl+"Users/getCoursesByClassId",
		  dataType: "json",
		  data: { class_id: class_id, teacher_id:teacherId }
		})
		.done(function( response ) {

			$.each(response.coursesByClassId,function(key,value){

				var course_id = value.course_id;
				
				//call ajax to get course name.

					$.ajax({
					  method: "POST",
					  url: baseUrl+"Users/getCourseNameById",
					  dataType: "json",
					  data: { course_id: course_id }
					})
					.done(function( response ) {

						//append course to dropdown course list...
						
						var courseName = response.courseDetails[0].name;
						var courseShort = response.courseDetails[0].short;

						courseDropDown
							.append(
								'<option value="'+ course_id +'">'+
								courseName + ' ( ' + courseShort + ' )'+
								'</option>'
							);
					})
			})
		})

	}

	function getCoursesListByClassIdUPdate(class_id,teacherId){

		upCourseName
				.empty();

		$.ajax({
		  method: "POST",
		  url: baseUrl+"Users/getCoursesByClassId",
		  dataType: "json",
		  data: { class_id: class_id, teacher_id:teacherId }
		})
		.done(function( response ) {

			$.each(response.coursesByClassId,function(key,value){

				var course_id = value.course_id;
				
				//call ajax to get course name.

					$.ajax({
					  method: "POST",
					  url: baseUrl+"Users/getCourseNameById",
					  dataType: "json",
					  data: { course_id: course_id }
					})
					.done(function( response ) {

						//append course to dropdown course list...
						
						var courseName = response.courseDetails[0].name;
						var courseShort = response.courseDetails[0].short;

						upCourseName
							.append(
								'<option value="'+ course_id +'">'+
								courseName + ' ( ' + courseShort + ' )'+
								'</option>'
							);
					})
			})
		})

	}

	function reset_form_element (e) {
	    e.wrap('<form>').parent('form').trigger('reset');
	    e.unwrap();
	}


});