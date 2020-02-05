$(function(){
	//alert('hello from administrators js file');

	var delBtn = $('#example1');
	var editBtn = $('#example1');
	var baseUrl = $('#base').val();

	delBtn
		.on('click','[data-fnx="delete"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);
			let email = current_row.find('td:eq(0)').text();

			if(confirm('Are you sure you want to delete ['+email+'] from the Administrators list?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delAdminById",  
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					alert('Account was successfully deleted!')
					window.location.replace(baseUrl+'administrators'); 
					
				})
				
			}

		})

	editBtn
		.on('click','[data-fnx="update"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);
			let email = current_row.find('td:eq(0)').text();

			//console.log('Update: ' + email + '?');

			//call ajax to get admin data...

			var jqxhr = $.ajax({
				url: baseUrl+'Admins/getAdminById', 
				dataType:'json',
				type:'post',
				data: {id:row_id}						
			})					
			.done(function(response) {

				let upEmail = $('#upEmail');
				let upStatus = $('#upStatus');
				let upAccType = $('#upAccType');
				let updateAccount = $('#updateAccount');
				let adminId = $('#admin_id');

			    $.each(response.admin,function(key,value){

			    	adminId.val(value.id);		

			    	if(value.type == '1'){
			    		upEmail.attr('disabled','disabled');
			    		upStatus.attr('disabled','disabled');
			    		upAccType.attr('disabled','disabled');
			    		updateAccount.attr('disabled','disabled');
			    	}	
			    	else{
			    		upEmail.attr('disabled',false);
			    		upStatus.attr('disabled',false);
			    		upAccType.attr('disabled',false);
			    		updateAccount.attr('disabled',false);			    		
			    	}		    	

			    	upEmail.val(value.email);
			    	upStatus.empty();
			    	upAccType.empty();

			    	if(value.status == '1'){ 

			    		upStatus
			    			.append('<option value="1" selected="selected">Active</option><option value="0">Inactive</option>');
			    	}
			    	else
			    	if(value.status == '0'){
			    		upStatus
			    			.append('<option value="1">Active</option><option value="0" selected="selected">Inactive</option>');
			    	}

			    	switch(value.type){
			    		case "1":{
			    			upAccType
			    				.append('<option value="1" selected="selected">Full Admin</option>');
			    		}
			    		break;
			    		case "2":{
			    			upAccType
			    				.append('<option value="2" selected="selected">Office Personnel</option><option value="3">Accounting Department</option>');
			    		}
			    		break;
			    		case "3":{
			    			upAccType
			    				.append('<option value="2">Office Personnel</option><option value="3" selected="selected">Accounting Department</option>');
			    		}
			    		break;
			    		default:{

			    		}
			    	}


				})

				console.log(response);

			})
			.fail(function(jqXHR, textStatus) {
			    console.log( textStatus );
			})

		})
});