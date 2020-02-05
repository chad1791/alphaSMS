$(function(){

	let profileBtn = $('#changeProfilePic');
	let oFD 	   = $('#files');
	//let picFrame   = $('#picFrame');
	let baseUrl    = $('#base').val();

	profileBtn
		.on('click',function(){

			oFD
			  .trigger('click');

		});

	oFD
	  .on('change',function(){
	  	
	  	let files 	  = $('#files')[0].files;
	  	let form_data = new FormData();	
	  	let error = '';

		if ($('#files').get(0).files.length !== 0) {

			for(var count = 0; count<files.length; count++){

				var tmp_name = files[count].name;
				var tmp_extension = tmp_name.split('.').pop().toLowerCase();

				if($.inArray(tmp_extension,['gif','png','jpg','jpeg']) == -1){ 
					error += "Invalid " + count + " File type";
				}
				else{
					form_data.append("files[]", files[count]);
					//form_data.append('id',response); 
				}								
			}

			if(error == ''){
				$.ajax({
					url: baseUrl + 'Admins/uploadFiles', 
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

						alert('Profile pic has been successfully updated!');
						console.log(data);
						location.reload();
					}
				})
			}
			else{
				alert(error);
			}

		}

	  })

})