$(function(){

	var submitAssig = $('#addAssignment');
	var baseUrl = $('#base').val();
	var teacherId = $('#teacher_id').val();

	var updateBtn = $('[data-fnx="update"]');
	var delBtn 	  = $('[data-fnx="delete"]');
	var updateLPBtn = $('#updateLPBtn');

	var files = $('#upFiles')[0].files;
	var form_data = new FormData();	

	//working on update and delete functionalities...

	updateLPBtn
		.on('click',function(e){

			e.preventDefault();

			//alert('updating lesson plan record!');

			let lessPlanDbId = $('#lessonPlanDbId').val();
			let upName 		 = $('#upName').val();
			let teacher_id = teacherId;
			let upCourseName = $('#upCourseName').val();
			let upSchoolYear = $('#upSchoolYear').val();
			let upDesc 		 = $('#upDesc').val();
			let upDatepicker = $('#upDatepicker').val();
			let file_name 	 = $('#file_name').val(); 
			let replaceFile  = 0;

			var files = $('#upFiles')[0].files;
			var form_data = new FormData();	

			//add the assignment to the database....

			if(lessPlanDbId !== '' && upName !== '' && upCourseName !== '' && upSchoolYear !== '' && upDesc !== '' && upDatepicker !== ''){

				//check to see file extention to see for valid files!

				if ($('#upFiles').get(0).files.length !== 0) {

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

					replaceFile = 1;
				}				

				var jqxhr = $.ajax({
				    url: baseUrl + 'Users/updateLessonPlan',    
				    dataType:'json',
				    type:'post',
				    data: {id:lessPlanDbId, teacher_id:teacher_id , name:upName, course:upCourseName , schoolYear:upSchoolYear , des:upDesc , uploadedOn:upDatepicker, replaceFile:replaceFile, file_name:file_name}           
				})          
				.done(function(response) {

				   	console.log(response);

				   	if($('#upFiles').get(0).files.length === 0){

						alert('Lesson Plan has been successfully uploaded!');
						location.reload();				   		
				   		return false;
				   	}
				   	else{

					   	if(response != ''){
							
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
										url: baseUrl + 'Users/uploadLessonPlan', 
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

											alert('Lesson Plan has been successfully uploaded!');
											//console.log(data);
											location.reload();

										}
									})
								}
								else{
									alert(error);
								}

							

					   	}
					   	else{
					   		alert('Error uploading lesson plan, please try again later!')
					   	}


				   	}

				});

			}
			else{
				alert('Fill in all fields to upload the lesson plan!');
			}			


			

			return false;

		})

	updateBtn
		.on('click',function(){


			let ass_id = $(this).data('up_id');
			let updateAssTitle = $('#assTitleUpdate');

			//call ajax to get assignment details...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Users/getLessonPlanById",
			  dataType: "json",
			  data: { id: ass_id }
			})
			.done(function( response ) {

				console.log(response.lessonPlan);

				$.each(response.lessonPlan, function(key,value){

					updateAssTitle.empty().append(value.name + ' - Update');
					$('#lessonPlanDbId').val(value.id);
					$('#upName').val(value.name);
					$('#upCourseName').val(value.course);
					$('#upSchoolYear').val(value.school_year);
					$('#upDesc').val(value.des);

					$('#upDatepicker').datepicker("setDate", null);
					$('#upDatepicker').datepicker("setDate", moment(value.uploaded_on).format('YYYY-MM-DD'));
					$('#file_name').val(value.file_name);

					//console.log(moment(value.uploaded_on).format('YYYY-MM-DD'));  
				});

			});

			$('#updateAdmin').modal('show');

		})

	delBtn
		.on('click',function(){

			let row_id = $(this).data('rem_id');
			let conDelete = confirm('Are you sure you want to delete this lesson plan entry?');

			if(conDelete){

				//call ajax to delete lesson plan entry...

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Users/delLessonPlanById", 
				  dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){

						//console.log(response); 
						alert('Lesson Plan was successfully deleted!');
						location.reload();

					}
					else{

						alert('Lesson Plan could not be deleted. Try again later!')

					}

					
				})				
			}

		})

	submitAssig
		.on('click',function(){

			//if empty, proceed to submit assignment as is...
			//gather all variables to submit assignment...

			let teacher_id = teacherId;

			let name = $('#name').val();
			let course = $('#courseName').val();
			//let schoolYear = $('#schoolYear').val();
			let schoolYear = '2019-2020';
			let des = $('#desc').val();
			let uploadedOn = $('#datepicker').val();

			var files = $('#files')[0].files;
			var form_data = new FormData();				

			//add the assignment to the database....

			if(teacher_id !== '' && course !== '' && schoolYear !== '' && des !== '' && uploadedOn !== ''){

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
				else{

					alert('Please select a file to upload!');
					return false;
				}				

				var jqxhr = $.ajax({
				    url: baseUrl + 'Users/addLessonPlan',    
				    dataType:'json',
				    type:'post',
				    data: {teacher_id:teacher_id , name:name, course:course , schoolYear:schoolYear , des:des , uploadedOn:uploadedOn}           
				})          
				.done(function(response) {

				   	console.log('Last inserted assignment id: ');
				   	console.log(response);

				   	if(response != ''){

						
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
									url: baseUrl + 'Users/uploadLessonPlan', 
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

										alert('Lesson Plan has been successfully uploaded!');
										console.log(data);
										location.reload();

									}
								})
							}
							else{
								alert(error);
							}

						

				   	}
				   	else{
				   		alert('Error uploading lesson plan, please try again later!')
				   	}

				});

			}
			else{
				alert('Fill in all fields to upload the lesson plan!');
			}
			
		});

})