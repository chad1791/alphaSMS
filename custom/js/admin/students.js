$(function(){
	//alert('hello from administrators js file');

	var delBtn = $('#example1');
	var editBtn = $('#example1');
	var viewBtn = $('#example1');
	var baseUrl = $('#base').val();

	let addStdBtn = $('#addStdBtn');
	let changeImage = $('#upImage');

	let importStds = $('#importCsvBtn');

	///functionality for the import csv file for student list....

	importStds
		.on('click', function(){

			let files = $('#imCsv')[0].files;
			let form_data = new FormData();	

			//validate if the file is a csv file...

			if ($('#imCsv').get(0).files.length !== 0) {

				for(var count = 0; count<files.length; count++){

					var tmp_name = files[count].name;
					var tmp_extension = tmp_name.split('.').pop().toLowerCase();
						

					if($.inArray(tmp_extension,['xls','xlsx']) == -1){
						toastr.error('Invalid File. Upload <b>[.xlsx]</b> Files!', 'Alpha SMS Says');
						return false;
					}
					else{
						form_data.append("files[]", files[count]);
						//form_data.append('id',response);
					}
													
				}
			}
			else{
				toastr.warning('Please select file for import!', 'Alpha SMS Says');
			}			

			//recreate form submit with ajax...

			var error = '';

			/*for (var pair of form_data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]); 
			}*/

			if(error == ''){

				$.ajax({
					url: baseUrl + 'Admins/importStdAcc',  
					method:'POST',
					data:form_data,
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){

						console.log(data);

						//show toast for successful student addition...										
										
						toastr.success('Student account was successfully added!', 'Alpha SMS Says');									

					}
				})
			}
			else{
				alert(error);
			}
		})

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

	//listen for changes when closing the modal... .. reload is done regardless of change or not... XD

	$('#xClose, #btnClose, #xImportClose, #importClose')
		.on('click', function(){

			location.reload('students');

	})

	addStdBtn
		.on('click',function(){

			//collect student data to add to the database...

			let studentId = $('#student_id');
			let stdSS	  = $('#ss');
			let first 	  = $('#first');
			let middle    = $('#middle');
			let last 	  = $('#last');
			let cellNo    = $('#cell');
			let email     = $('#email');
			let address   = $('#address');
			let gender    = $('#gender');
			let classId   = $('#class_id');
			let status    = $('#status');
			let father    = $('#father');
			let mother    = $('#mother');
			let emergency = $('#emergency');

			let files = $('#files')[0].files;
			let form_data = new FormData();	

			//test for empty data...

			if($.trim(studentId.val()).length > 0 && $.trim(stdSS.val()).length > 0 && $.trim(first.val()).length > 0 && $.trim(middle.val()).length > 0 &&
			   $.trim(last.val()).length > 0	&& $.trim(cellNo.val()).length > 0 && $.trim(email.val()).length > 0 && $.trim(address.val()).length > 0 &&
			   $.trim(gender.val()).length > 0 && $.trim(classId.val()).length > 0 && $.trim(status.val()).length > 0 && $.trim(father.val()).length > 0 &&
			   $.trim(mother.val()).length > 0 && $.trim(emergency.val()).length > 0
			  ){

				//check to see file extention to see for valid files!

				if ($('#files').get(0).files.length !== 0) {

					for(var count = 0; count<files.length; count++){

						var tmp_name = files[count].name;
						var tmp_extension = tmp_name.split('.').pop().toLowerCase();
						//attachments = 1;

						if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
							alert('Invalid file type! Only images, pdf files and Microsoft office types accepted!');
							//attachments = 0;
							return false;
						}								
					}
				}

				// call ajax to submit student info...

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addStudent',    
				    dataType:'json',
				    type:'post',
				    data: {

				    	ss:stdSS.val(), 
				    	student_id:studentId.val(), 
				    	first:first.val(), 
				    	middle:middle.val(), 
				    	last:last.val(), 
				    	cell:cellNo.val(), 
				    	email:email.val(), 
				    	address:address.val(), 
				    	gender:gender.val(), 
				    	class_id:classId.val(),
				    	father:father.val(),
				    	mother:mother.val(),
				    	emergency:emergency.val(),
				    	status:status.val() 
				    }           
				})
				.done(function( response ){

					console.log(response);

					if(response != ''){

						if ($('#files').get(0).files.length === 0) {
						    
							console.log('No attachments were uploaded!');

							/// show toast with successful student addition..

							toastr.success('Student account was successfully added!', 'Alpha SMS Says');

							//clean up fields for new entry...

							studentId.val("");
							stdSS.val("");
							first.val("");
							middle.val("");
							last.val("");
							cellNo.val("");
							email.val("");
							address.val("");
							gender.val("");
							father.val("");
							mother.val("");
							emergency.val("");	

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
									url: baseUrl + 'Admins/uploadStudentPic', 
									method:'POST',
									data:form_data,
									contentType:false,
									cache:false,
									processData:false,
									beforeSend:function(){
										//show uploading to the user...
									},
									success:function(data){

										console.log(data);

										//show toast for successful student addition...										
										
										toastr.success('Student account was successfully added!', 'Alpha SMS Says');

										//clean up fields for new entry...

										studentId.val("");
										stdSS.val("");
										first.val("");
										middle.val("");
										last.val("");
										cellNo.val("");
										email.val("");
										address.val("");
										gender.val("");
										father.val("");
										mother.val("");
										emergency.val("");									

									}
								})
							}
							else{
								alert(error);
							}

						}

					}
					else{
						toastr.error('Student account could not be added!', 'Alpha SMS Says');
					}

				}) 

			}
			else{

				toastr.error('Please fill in all fields!', 'Alpha SMS Says');
				return false;				

			}

		})

	delBtn
		.on('click','[data-fnx="delete"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);
			let studentId = current_row.find('td:eq(0)').text();
			let studentName = current_row.find('td:eq(1)').text();

			if(confirm('Are you sure you want to delete [ '+ studentName +' ( '+ studentId + ' ) ] from the Students list?')){

				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delStudentById",
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					if(response){

						//show toastr with delete successful...

						toastr.success('Student account was successfully deleted!', 'Alpha SMS Says');

						//fadeout deleted student record...

						$('#'+row_id).fadeOut('slow');
					}
					else{

						//show toastr with delete unsuccessful...

						toastr.error('Student account could not be deleted!', 'Alpha SMS Says');

					}

					console.log('Delete Student Response: ');
					console.log(response);
					
				})
			}

		})

	editBtn
		.on('click','[data-fnx="update"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);
			let showImage = ''

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getStudentById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  //list all classes

			  let classesOptions = [];

			  $('#class_id>option').each(function(i, option) {
				classesOptions.push([$(option).val(),$(option).text()]);
			  });

			  console.log('Options gathered from classes: ');
			  console.log(classesOptions);

			  $('#upClassId').empty();

			  /////////////////////////////


			  $.each(response.student,function(key,value){

				$('#studentDbId').val(value.id);
				$('#upStudentId').val(value.student_id);
				$('#upSS').val(value.ss);
				$('#upFirst').val(value.first);
				$('#upMiddle').val(value.middle);
				$('#upLast').val(value.last);
				$('#upCell').val(value.cell);
				$('#upEmail').val(value.email);
				$('#upAddress').val(value.address);

				
				for (var i = 0; i < classesOptions.length; i++) {
					if(value.class_id == classesOptions[i][0]){
						$('#upClassId').append('<option value="' + classesOptions[i][0] + '" selected="selected">' + classesOptions[i][1] + '</option>');
					}
					else{
						$('#upClassId').append('<option value="' + classesOptions[i][0] + '">' + classesOptions[i][1] + '</option>');
					}
				}

				if(value.status == 1){
					$('#upStatus').empty().append('<option value="0">Inactive</option><option value="1" selected="selected">Active</option>');
				}
				else{
					$('#upStatus').empty().append('<option value="0" selected="selected">Inactive</option><option value="1">Active</option>');
				}


				if(value.gender == 'Male'){
					$('#upGender').empty().append('<option value="Female">Female</option><option value="Male" selected="selected">Male</option>');
				}
				else{
					$('#upGender').empty().append('<option value="Female" selected="selected">Female</option><option value="Male">Male</option>');
				}

				$('#upFather').val(value.father);
				$('#upMother').val(value.mother);
				$('#upEmergency').val(value.emergency);

				if(value.image == ''){
					showImage = 'No image has been uploaded as yet!';
				}
				else{

					showImage = '<img style="height:100px; width:100px;" src="' + baseUrl + 'custom/uploads/students/images/' + value.image + '">';

				}

				$('#showImage')
					.empty()
					.append(showImage);

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
			  url: baseUrl+"Admins/getStudentById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  let labelvalues = [];
			  let className = '';
			  let status = '';
			  let stdImagePath = '';

			  $('#class_id>option').each(function(i, option) {
				labelvalues.push([$(option).val(),$(option).text()]);
			  });

			  console.log(response);

			  $.each(response.student,function(key,value){
			  	
			  	e.preventDefault();

			  	for (var i = 0; i < labelvalues.length; i++) {
			  		
			  		if(value.class_id == labelvalues[i][0]){
			  			className = labelvalues[i][1];
			  			break;
			  		}
			  		else{
			  			className = 'No class has been selected';
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

			  	if(value.image == ''){

			  		if(value.gender == 'Male'){
			  			stdImagePath = 'custom/uploads/default/images/male.jpg';
			  		}
			  		else
			  		if(value.gender == 'Female'){
			  			stdImagePath = 'custom/uploads/default/images/female.jpg';
			  		}
			  	}
			  	else{
			  		stdImagePath = 'custom/uploads/students/images/' + value.image;
			  	}



			  	$('#viewStudentTitle').text(value.first + ' ' + value.last);
			  	$('#studentImage').empty().append('<img id="imgDis" class="user_pic" src="' + baseUrl + stdImagePath + '" alt="Student Image"/>');
			  	$('#viewId').text(value.student_id);
			  	$('#viewSs').text(value.ss);
			  	$('#viewName').text(value.first);
			  	$('#viewMiddle').text(value.middle);
			  	$('#viewLast').text(value.last);
			  	$('#viewCell').text(value.cell);
			  	$('#viewEmail').text(value.email);
			  	$('#viewAddress').text(value.address);
			  	$('#viewGender').text(value.gender);
			  	$('#viewClass').text(className);
			  	$('#viewStatus').text(status);
			  	$('#viewFather').text(value.father);
			  	$('#viewMother').text(value.mother);
			  	$('#viewEmergency').text(value.emergency);
			  	$('#viewAdvanced').empty().append('<a href="' + 'student/' + value.student_id + '">Show more...</a>');

			  	$('#viewAdmin').modal('show'); 

			  });
			});
		})

		changeImage
			.on('change', function(){

				//alert('About to change image...');

				let files = $('#upImage')[0].files;
				let form_data = new FormData();	
				let student_id = $('#studentDbId').val();
				let showImage = $('#showImage');

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
						form_data.append('id',student_id);
					}
				}

				if(error == ''){
					$.ajax({
						url: baseUrl + 'Admins/uploadStudentPic', 
						method:'POST',
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){

							console.log(data);
							let picName = eval(data);

							//show toast for successful student addition...										
										
							toastr.success('Student account was successfully added!', 'Alpha SMS Says');

							//replace display image with new image...

							showImage
								.empty()
								.append('<img style="height:100px; width:100px;" src="' + baseUrl + 'custom/uploads/students/images/' + picName + '">');
						}
					})
				}
				else{
					alert(error);
				}
			})
});