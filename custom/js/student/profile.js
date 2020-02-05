$(function(){

	let updateBtn = $('#upBtn');
	let baseUrl = $('#base_url').val();

	updateBtn
		.on('click',function(e){

			e.preventDefault();

			//call ajax to save the student about me section...
			let myBio = $('#myBio').val();
			let id = $('#student_id').val();

			///alert(id);

			var jqxhr = $.ajax({
			    url: baseUrl+'Students/updateStudentBio',  
			    dataType:'json',
			    type:'post',
			    data: {id:id, myBio:myBio}           
			})          
			.done(function(response) {
				//console.log(response);

				let cardBio = $('#cardBio');

				cardBio.empty();

				alert('Bio was successfully added!');

				cardBio
					.text(myBio);

			})			

			return false;

		})

	//alert('This is the profile for the student!');

})