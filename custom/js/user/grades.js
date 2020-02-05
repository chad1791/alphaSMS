$(function(){
	//alert('Hello from the grades.js page!');

	var grade = $('#tbody');
	var class_id = $('#class_id').val();
	var course_id = $('#course_id').val();
	var baseUrl = $('#base').val();

	grade
		.off()
		.on('keyup','[data-fnx="grade"]',function(e){

			var save = $('#saving');
			save.html('<small>saved!</small>');

			e.preventDefault();
			e.stopImmediatePropagation();

			var id = $(this).attr('id');
			var db_id = '';
			var code = e.keyCode || e.which;

			if(code != '9'){

				if(id === ''){ //add new grade column to the database

					var student_id = $(this).data('student_id');
					var module_num = $(this).data('module');
					var mark = $(this).val();

					if(mark !== ''){

						//call ajax to save new value

			            var jqxhr = $.ajax({
			                url: baseUrl+'Users/addGrade',  
			                dataType:'json',
			                async:false,
			                type:'post',
			                data: {course_id:course_id, class_id:class_id, student_id:student_id, module:module_num, mark:mark, year:'2018-2019'}          
			            })          
			            .done(function(response) {
			            	console.log('Grade was added successfully!');
			            	db_id = response;
			            })

					}

					//update textbox with new db grade id...

					$(this).attr('id',db_id);
				}
				else{ //update grade column on the database

					//event.stopPropagation();
					console.log('This textbox has an id value now: ' + id);
					console.log('New value is: ' + $(this).val()); 

					var mark = $(this).val();

					//call ajax to update the mark of the student...

					var jqxhr = $.ajax({
			            url: baseUrl+'Users/updateGrade',  
			            dataType:'json',
			            type:'post',
			            data: {id:id,mark:mark}           
			        })          
			        .done(function(response) {
			        	$('#saving').html('saving...');

			        	setInterval(function(){ $('#saving').html('saved!'); }, 2000);
			        })
				}

			} 
		})
})