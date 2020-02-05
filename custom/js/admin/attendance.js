$(function(){

	//alert('Hi from the attendance js file...');

	let baseUrl 	= $('#base').val();
	let goBtn 		= $('#go');
	let listOfCls 	= [];

	//variable for class dropdown...

	let classSelector  = $('#className');
	let courseSelector = $('#courseName');

	//dafault behaviour of the course selector...

	let class_id = classSelector.val();

	//call ajax to fetch the list of courses for the class...

	var jqxhr = $.ajax({
		url: baseUrl+'Admins/getAllCoursesByClassId',   
		dataType:'json',
		type:'post',
		data: {class_id:class_id}           
	})          
	.done(function(response) {
		//console.log(courses);

		courseSelector
				.empty();

		$.each(response.allCourses, function(key,value){

			//console.log(value);

			courseSelector
				.append(
					'<option value="'+value.course_id+'">'+value.name+' ('+value.short+' )'+'</option>' 
				);
					
		})

	})	


	//feed dropdown box with the list of courses...

	classSelector
		.on('change', function(){

			let class_id = $(this).val();

			//call ajax to fetch the list of courses for the class...

			var jqxhr = $.ajax({
				url: baseUrl+'Admins/getAllCoursesByClassId',   
				dataType:'json',
				type:'post',
				data: {class_id:class_id}           
			})          
			.done(function(response) {
				//console.log(courses);

				courseSelector
						.empty();

				$.each(response.allCourses, function(key,value){

					//console.log(value);

					courseSelector
						.append(
							'<option value="'+value.course_id+'">'+value.name+' ('+value.short+' )'+'</option>' 
						);
					
				})

			})
	});

	////call ajax to get the list of students for the selected class...

	goBtn
		.on('click',function(){ //a left join will do... in order to get the attendance for the specific student...

			let class_id    = $('#className').val();
			let course_id   = $('#courseName').val();
			let fromDate    = $('#datepicker').val();
			let toDate      = $('#datepicker2').val();

			//get all students from the selected class...

			/*var jqxhr = $.ajax({
				url: baseUrl+'Admins/getAllStdsByClassId',   
				dataType:'json',
				type:'post',
				data: {class_id:class_id}           
			})          
			.done(function(response) {

				//console.log(courses);

				$.each(response.allStudents, function(key,value){

				})

				console.log(response);

			})*/

			return false;
	})

})