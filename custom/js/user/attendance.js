$(function(){

	var attendance = $('#tbody');
	var remInput = $('#tbody');
	var class_id = $('#class_id').val();
	var course_id = $('#course_id').val();
	var baseUrl = $('#base').val();

	remInput
		.on('keyup','[data-fnx="remarks"]',function(e){

			let id = $(this).data('att_id');
			let remarks = $(this).val();
			console.log(id);

			var jqxhr = $.ajax({
				url: baseUrl+'Users/updateRemarks',  
				dataType:'json',
				type:'post',
				data: {id:id, remarks:remarks}           
			})          
			.done(function(response) {
				
				$('#saving').html('saving...');
				setInterval(function(){ $('#saving').html('saved!'); }, 2000);
			})			

		});

	attendance
		.on('click','[data-att="option"]',function(e){

			//get the adjecent [<td>] to draw the textbox on...

			let remContainer = $(this).closest('td').next('td');
			console.log(remContainer);

			var save = $('#saving');
			save.html('<small>saved!</small>');

			var id = $(this).data('db_id');
			var student_id = $(this).data('student_id');
			var date = $('#today').val();
			var att_status = $(this).val();
			//var remarks = '';
			var db_id = '';

			if(id == ''){ 				

				//call ajax to save new value

			     var jqxhr = $.ajax({
			        url: baseUrl+'Users/addAttendance',   
			        dataType:'json',
			        type:'post',
			        data: {class_id:class_id, course_id:course_id, student_id:student_id, date:date, attendance:att_status, year:'2018-2019'}          
			     })          
			     .done(function(response) {
			       	console.log('Attendance was added successfully!');
			       	db_id = response;
			       	console.log(db_id);

				    //draw textbox on empty [<td>] for remarks...

					remContainer
						.append('<input data-att_id="'+ db_id +'" data-fnx="remarks" style="width:99%; padding:0px;" />');

					//reload the page to resize the textbox sizes...

					location.reload();

					//add event listener for the textbox...

					remInput
						.off()
						.on('keyup','[data-fnx="remarks"]',function(e){

							let id = $(this).data('att_id');
							let remarks = $(this).val();
							console.log(id);

							var jqxhr = $.ajax({
					            url: baseUrl+'Users/updateRemarks',  
					            dataType:'json',
					            type:'post',
					            data: {id:id, remarks:remarks}           
					        })          
					        .done(function(response) {
					        	$('#saving').html('saving...');

					        	setInterval(function(){ $('#saving').html('saved!'); }, 2000);
					        })

						});

			     })
			}
			else{

				//call ajax to update record on the database...

					let remarks = '';

					$(this).closest('td').next('td').find("input").each(function() {
					    remarks = $(this).val();
					    console.log(remarks);
					});

					//console.log(td.find('input[type=text]'));

					var jqxhr = $.ajax({
			            url: baseUrl+'Users/updateAttendance',  
			            dataType:'json',
			            type:'post',
			            data: {id:id, attendance:att_status, remarks:remarks}           
			        })          
			        .done(function(response) {
			        	$('#saving').html('saving...');

			        	setInterval(function(){ $('#saving').html('saved!'); }, 2000);
			        })

			}
		})

	/*remarks
		.on('keyup','[data-fnx="remarks"]',function(e){
			
			var save = $('#saving');
			var currentObj = $(this);

			var id = $(this).attr('attendance_id');
			var student_id = $(this).attr('id');
			var date = $('#today').val();
			var att_status = $('input[name=optionsRadios'+ student_id +']:checked').val();
			var att_group = $('input[name=optionsRadios'+ student_id +']');
			var remarks = $(this).val();	
			var db_id = '';		

			console.log('Att Id:');
			console.log(id);

			//alert('This is my attendance id: ' + id + '. And this is my id: ' + $(this).attr('id'));

			if(id == ''){

				//call ajax to save new value

			     var jqxhr = $.ajax({
			        url: baseUrl+'Users/addAttendance',  
			        dataType:'json',
			        type:'post',
			        data: {class_id:class_id, course_id:course_id, student_id:student_id, date:date, attendance:att_status,  remarks:remarks, year:'2018-2019'}          
			     })          
			     .done(function(response) {
			       	console.log('Attendance was added successfully!');
			       	db_id = response;
			       	console.log(db_id);

				    //add db_id to the corresponding objects....

					 att_group.each(function(key,value){

					 	var input_ob = $(value);

					 	input_ob.attr('data-db_id',db_id);

					 	console.log(input_ob);
					 })

					 //.attr('attendance_id',db_id);
					 $.extend( currentObj[0].dataset, { attendance_id: db_id } );
					 console.log(currentObj);

			     })

			}
			else{
				//call ajax to update record on the database...

					var jqxhr = $.ajax({
			            url: baseUrl+'Users/updateAttendance',  
			            dataType:'json',
			            type:'post',
			            data: {id:id, attendance:att_status, remarks:remarks}           
			        })          
			        .done(function(response) {
			        	$('#saving').html('saving...');

			        	setInterval(function(){ $('#saving').html('saved!'); }, 2000);
			        })

			}

		})*/

})