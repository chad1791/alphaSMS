$(function(){

	let subBtn = $('#addUpdateSettings');
	let setting_id = $('#setting_id').val();
	let startBtn = $('#datepicker1');
	let endBtn = $('#datepicker2');
	let baseUrl = $('#baseUrl').val();

	startBtn
		.on('change', function(e){
			e.stopPropagation();

			let date1 = $(this).val();
			let parts1 = date1.split('/');

			let date2 = $('#datepicker2').val()
			let parts2 = date2.split('/');

			$('#shortYear').val(parts1[2] + ' - ' + parts2[2]);
			//alert($('#shortYear').val());
		});

	endBtn
		.on('change', function(e){
			e.stopPropagation();

			let date1 = $('#datepicker1').val()
			let parts1 = date1.split('/');

			let date2 = $(this).val();
			let parts2 = date2.split('/');

			$('#shortYear').val(parts1[2] + ' - ' + parts2[2]);
			//alert($('#shortYear').val());
		});

	subBtn
		.on('click',function(e){

			e.preventDefault();

			let schoolName = $('#name').val();
			let address = $('#address').val();
			let phone = $('#phone').val();
			let cell = $('#cell').val();
			let email = $('#email').val();
			let schoolSystem = $('#schooling').val();
			let gradingSystem = $('#grading').val();
			let start = $('#datepicker1').val();
			let end = $('#datepicker2').val();
			let schoolYear = $('#shortYear').val();
			let terms = $('#terms').val(); 

			let files = $('#files')[0].files;
			let form_data = new FormData();	

			//console.log('Examining files content: ');
			//console.log($('#files')[0].files);
			//alert('Name: ' + schoolName + ' ,Address: ' + address + ' ,Phone: ' + phone + ' ,Cell: ' + cell + ' ,Email: ' + email + ' ,School System: ' + schoolSystem + ' ,Grading System: ' + gradingSystem + ' ,Start: ' + start + ' ,End: ' + end + ' ,School year: ' + schoolYear + ', Terms: ' + terms);

			if(setting_id == ''){

				//check to see file extention to see for valid files!

				if ($('#files').get(0).files.length !== 0) {

					for(var count = 0; count<files.length; count++){

						var tmp_name = files[count].name;
						var tmp_extension = tmp_name.split('.').pop().toLowerCase();

						if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
							alert('Invalid file type! Only images are accepted!')
							return false;
						}								
					}
				}

				//call ajax to add the settings to the system...

			     var jqxhr = $.ajax({
			        url: baseUrl+'Admins/addSettings',  
			        dataType:'json',
			        type:'post',
			        data: {name:schoolName, address:address, phone:phone, cell:cell, email:email, schooling:schoolSystem, grading:gradingSystem, terms:terms, start: start, end:end, short:schoolYear}          
			     })          
			     .done(function(response) {

			     	console.log(response);

			     	if(response != ''){

			     		//disable the schooling and grading...

			     		$('#schooling').attr('disabled','disabled');
			     		$('#grading').attr('disabled','disabled');

			     		//do the image upload here...

						if ($('#files').get(0).files.length === 0) {
						    
						    alert('School Settings has been successfully updated!');
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

							/*for (var pair of form_data.entries()) {
			    				console.log(pair[0]+ ', ' + pair[1]); 
							}*/

							if(error == ''){
								$.ajax({
									url: baseUrl + 'Admins/uploadImage',  
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

										alert('School Settings has been successfully updated!');
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

			     })
			}
			else{

				let prevImage = $('#prevImage').val();
				let willUpdateImage = 0;

				//check to see file extention to see for valid files!

				if ($('#files').get(0).files.length !== 0) {

					willUpdateImage = 1;

					for(var count = 0; count<files.length; count++){

						var tmp_name = files[count].name;
						var tmp_extension = tmp_name.split('.').pop().toLowerCase();

						if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
							alert('Invalid file type! Only images are accepted!')
							return false;
						}								
					}
				}				

				//call ajax to update the setting to the system...

			     var jqxhr = $.ajax({
			        url: baseUrl+'Admins/updateSettings',  
			        dataType:'json',
			        type:'post',
			        data: {setting_id:setting_id, name:schoolName, address:address, phone:phone, cell:cell, email:email, schooling:schoolSystem, grading:gradingSystem, terms:terms, start: start, end:end, short:schoolYear, prevImage:prevImage, willUpdateImage:willUpdateImage}          
			     })
			     .done(function(response){

			     	console.log(response);

			     	if(response != ''){

			     		//disable the schooling and grading...

			     		$('#schooling').attr('disabled','disabled');
			     		$('#grading').attr('disabled','disabled');

			     		//do the image upload here...

						if ($('#files').get(0).files.length === 0) {
						    
						    alert('School Settings has been successfully updated!');
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

							/*for (var pair of form_data.entries()) {
			    				console.log(pair[0]+ ', ' + pair[1]); 
							}*/

							if(error == ''){
								$.ajax({
									url: baseUrl + 'Admins/uploadImage',  
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

										alert('School Settings has been successfully updated!');
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

			     //alert('Updating the school logo...');
			}

		})

})