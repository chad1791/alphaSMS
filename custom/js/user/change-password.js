$(function(){
	//alert('Hi from the change password js page!');

	let changeBtn = $('#change');
	let id 		  = $('#id').val();
	let baseUrl   = $('#base').val();

	let currentPassBtn 	= $('#currentPass');
	let newPassBtn  	= $('#newPass');
	let confirmPassBtn  = $('#confirmPass');

	let showCurrent = false;
	let showNewPass = false;
	let showConfirmPass = false;

	currentPassBtn
		.on('click',function(){

			let currentTxt = $(this).parent().find('input');

			if(!showCurrent){

				currentTxt.attr('type','text');
				$(this).empty().append('<i class="fa fa-eye-slash"></i>');
				showCurrent = true;
			}
			else
			if(showCurrent){

				currentTxt.attr('type','password');
				$(this).empty().append('<i class="fa fa-eye"></i>');
				showCurrent = false;
			}

		});

	newPassBtn
		.on('click',function(){

			let newPassTxt = $(this).parent().find('input');

			if(!showNewPass){

				newPassTxt.attr('type','text');
				$(this).empty().append('<i class="fa fa-eye-slash"></i>');
				showNewPass = true;
			}
			else
			if(showNewPass){

				newPassTxt.attr('type','password');
				$(this).empty().append('<i class="fa fa-eye"></i>');
				showNewPass = false;
			}

		});

	confirmPassBtn
		.on('click',function(){

			let confirmPassTxt = $(this).parent().find('input');

			if(!showConfirmPass){

				confirmPassTxt.attr('type','text');
				$(this).empty().append('<i class="fa fa-eye-slash"></i>');
				showConfirmPass = true;
			}
			else
			if(showConfirmPass){

				confirmPassTxt.attr('type','password');
				$(this).empty().append('<i class="fa fa-eye"></i>');
				showConfirmPass = false;
			}

		});

	changeBtn
		.on('click',function(ev){

			ev.preventDefault();

			let current   = $('#current').val();
			let newPass   = $('#new').val();
			let confirm   = $('#confirm').val();

			//check to see if the passwords match...

			if(current == "" || newPass == "" || confirm == ""){
				alert('Fill in all fields to proceed!');
				return false;
			}

			if(newPass != confirm){
				alert('Password mismatch! Make sure that [New Password] and [Confirm New Password] are the same!');
				return false;
			}
			
			//call ajax to get password for the admin user...

			$.ajax({
				method: "POST",
				url: baseUrl+"Users/getUserPassById",  
				dataType: "json",
				data: { id: id, current:current } 
			})
			.done(function( response ){
				
				//console.log(response);

				if(response == '1'){
					
					//call ajax to change the password...

					$.ajax({
						url: baseUrl + "Users/updatePassword",  
						method: "POST",
						dataType: "json",
						data: {id:id, new:newPass}
					})
					.done(function( response ){
						if(response){

							alert('Congratulations, your password was successfully changed!');

							$('#current').val('');
							$('#new').val('');
							$('#confirm').val('');

							//logout user and ask him to login back to his account...

							
						}
						else{
							alert('Error! Your password could not be changed!');
						}

						console.log(response);
					})
				}
				else{
					alert('Incorrect password! Please try again.');
				}

				//console.log(response.auth);

			});

			return false; 

		});

})