$(function(){

	let baseUrl 	= $('#base_url').val();
	let student_id  = $('#student_id').val();
	let bellIcon 	= $('#bellIcon');
	let noteMsg		= $('#noteMsg');

	//start comet loop to check for notifications...

	let getNotifications = startTimer();

	function doComet(){

		//set default behaviour for noteMsg...

		noteMsg
			.text('')
			.text('You don\'t have any new notifications!');

		//get new notifications count...

		 var jqxhr = $.ajax({
			url: baseUrl+'Students/getNoteCount',   
			dataType:'json',
			type:'post',
			data: {id:student_id}           
		 })          
		 .done(function(notifications) {

		 	//debugger;

		 	if($.trim(notifications)){

			 	bellIcon
			 		.text('')
			 		.text(notifications);

			 	if(notifications > 1 || notifications == 0){

			 		noteMsg
			 			.text('')
			 			.text('You have ' + notifications + ' notifications');

			 	}
			 	else
			 	if(notifications == 1){

			 		noteMsg
			 			.text('')
			 			.text('You have ' + notifications + ' notification');

			 	}

		 	}
		 	else{

		 		console.log('No notificatoins found!');
		 		//debugger;

			 	noteMsg
			 		.text('')
			 		.text('You don\'t have any notifications');

		 	}

		 })		

		//load new notifications for the student...

       $("#newNoteBody").load(baseUrl + 'Students/getNewNotifications', {
           id: student_id
       }, function(){
       		addNoteClickListener();
       });	

	   //load five past notifications for the sudent...

	   $("#oldNoteBody").load(baseUrl + 'Students/getOldNotifications', {
	       id: student_id
	   });

	   $('.slimScrollDiv').css('height','auto');
	   $('#newNoteBody').css('height','auto');
	   $('#oldNoteBody').css('height','auto');

	   

	}

	function addNoteClickListener(){

		let newNotifications = $('[data-newnote="newNote"]');

		newNotifications
			.off()
			.on('click', function(e){

				//e.preventDefault();

				let id = $(this).data('noteid');

				//alert(id);

				//update the is_viewed field of the clicked notification...

				 var jqxhr = $.ajax({
					url: baseUrl+'Students/updateViewNotification',   
					dataType:'json',
					type:'post',
					data: {id:id}           
				 })          
				 .done(function( response ) {
				 	console.log('Notification was successfully updated!');
				 })

			})

	}

	function startTimer() {
	    
	    //call show_notifications
	    doComet();
	    
	    //then start interval
	    setInterval(doComet, 90000); //Refresh after 30 seconds 120000

	}

});


	
