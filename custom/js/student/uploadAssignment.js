$(function(){

	let uploadFileBtn = $('#files');
	let baseUrl = $('#base_url').val();

	//get already uploaded attachments

	$.ajax({
		url: baseUrl + 'Students/getMyUploadedFiles',  
		method:'POST',
		datatype:'json',
		success:function(data){

			//apend files to the view...

			console.log(data);

			if ( data.length != 0 ) {

				$.each(data.myUploadedFiles, function(key,value){

					//get assignment current id...

					let showAttFiles = $('#studentFiles'+value.assignment_id);

					//draw the files representation here, enable btn functionality for each file...

					showAttFiles
						.append('<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="border:1px dotted gray; height:28px;" data-elem_id="' + value.id + '">' + 
									value.name + 
									'<span class="pull-right">'+
										'<a target="_blank" href="../Users/downloadFile?file='+ value.name +'" class="btn"><i class="fa fa-download"></i></a>&nbsp;'+
										'<button data-fnx="delAssFile" data-ass_id="' + value.id + '"><i class="fa fa-times"></i></button>'+
									'</span>'+
								'</div><br/>');

				})

				//add event listener for delete... 	

				let delFile = $('[data-fnx="delAssFile"]');
								
				delFile
					.off()
					.on('click',function(e){

						e.preventDefault();

						let fileId = $(this).data('ass_id');

						if(confirm('Are you sure you want to delete this file attachment?')){
										

							//call ajax to delete the current file... working on this section...

							$.ajax({
							  method: "POST",
							  url: baseUrl+"Students/delFileById", 
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
					})

    		}												
											
		}
	})

	uploadFileBtn
		.on('change',function(){

			let id = $(this).data('ass_id');

			let upFiles = $('#files')[0].files;
			let form_data = new FormData();	

			if ($('#files').get(0).files.length !== 0) {

				for(var count = 0; count<upFiles.length; count++){

					var tmp_name = upFiles[count].name;
					var tmp_extension = tmp_name.split('.').pop().toLowerCase();

					if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){
						alert('Invalid file type! Only images, pdf files and Microsoft office types accepted!');
						return false;
					}								
				}
			}			

			//alert(id);

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
					form_data.append('id',id);
				}
			}

			for (var pair of form_data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]); 
			}

			if(error == ''){

				if(confirm('Are you sure you want to upload the selected files?')){ 

					$.ajax({
						url: baseUrl + 'Students/uploadFiles', 
						method:'POST',
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){

							alert('Files were successfully uploaded!');

							//apend new files to the view...

							let dataJson = JSON.parse(data);
							console.log(dataJson);

							//get assignment current id

							let showAttFiles = $('#studentFiles'+dataJson.id);							

							//draw the files representation here, enable btn functionality for each file...

							showAttFiles
								.append('<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="border:1px dotted gray; height:28px;" data-elem_id="' + dataJson.id + '">' + 
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
										  url: baseUrl+"Students/delFileById", 
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

							reset_form_element($('#files'));

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

	function reset_form_element (e) {
	    e.wrap('<form>').parent('form').trigger('reset');
	    e.unwrap();
	}


})