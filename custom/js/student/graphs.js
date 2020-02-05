$(function(){	

	 let baseUrl 	= $('#base_url').val();
	 let class_id   = $('#class_id').val();
	 let student_id = $('#student_id').val();
	 var listOfC 	= [];
	 let graphs     = $('#graphs');
	 let pies       = $('#pies');
	 let colors     = ["#3498DB","#E67E22","#9B59B6","#CCD1D1","#ABEBC6","#E74C3C","#1D8348","#196F3D","#1ABC9C","#76448A","#212F3C","#A04000","#16A085","#7DCEA0","#F5CBA7","#5499C7","#48C9B0","#FAD7A0","#E74C3C","#45B39D","#7DCEA0","#21618C","#B9770E","#616A6B","#A569BD","#F0B27A","#AEB6BF","#0E6655","#A04000","#979A9A","#1ABC9C","#F5CBA7","#D98880","#154360","#3498DB","#E67E22","#9B59B6","#CCD1D1","#ABEBC6","#E74C3C","#1D8348","#196F3D","#1ABC9C","#76448A","#212F3C","#A04000","#16A085","#7DCEA0","#F5CBA7","#5499C7","#48C9B0","#FAD7A0","#E74C3C","#45B39D","#7DCEA0","#21618C","#B9770E","#616A6B","#A569BD","#F0B27A","#AEB6BF","#0E6655","#A04000","#979A9A","#1ABC9C","#F5CBA7","#D98880","#154360"];
	 let preGrades  = []; 

	 //variables for grades and attendance view permissions...

	 let canViewGrades 		= $('#canViewGrades').val();
	 let canViewAttendance  = $('#canViewAttendance').val();

	 //get the department for the student....

	 let department = $('#department').val();

	 console.log(department);

	 //get all courses...

	 var jqxhr = $.ajax({
		url: baseUrl+'Students/getAllCourses',   
		dataType:'json',
		type:'post',
		//data: {id:class_id}           
	 })          
	 .done(function(courses) {
	 	//console.log(courses);

	 	$.each(courses.allCourses, function(key,value){

	 		let id    = value.id;
	 		let name  = value.name;
	 		let short = value.short;
	 		
	 		listOfC.push({id:id, name:name, short:short});
	 	})

	 	//console.log(listOfC);

	 })	

	 //let prevoc = drawPrevoc();

	 if(department == 0){

	 	if(canViewGrades!=0){
	 		let preVoc = drawPrevoc();
	 	}
	 	else{
	 		graphs
	 			.append(
					'<div class="col-md-12">'+
                      '<div class="box">'+
                        '<div class="box-header">'+
                          '<h3 class="box-title">You don\'t have permission to view your grades. Please contact your school administration!</h3>'+
                        '</div>'+
                      '</div>'+
                    '</div>'	 				
	 			);
	 	}

		//get all the courses for the student... draw student attendance...

		if(canViewAttendance!=0){	
			var jqxhr = $.ajax({
				url: baseUrl+'Students/getStudentCoursesById',   
				dataType:'json',
				type:'post',
				data: {id:class_id}           
			})          
			.done(function(response) {

				//console.log(response.courseList);

				if ( response.length != 0 ) {

					$.each(response.courseList, function(key,value){ 

						let attendance = getAttendance(value.course_id);
						
					})
					
				}
			})
		}
		else{
			pies
				.append(
					'<div class="col-md-12">'+
                      '<div class="box">'+
                        '<div class="box-header">'+
                          '<h3 class="box-title">You don\'t have permission to view your attendance. Please contact your school administration!</h3>'+
                        '</div>'+
                      '</div>'+
                    '</div>'
				)
		}		

	 }
	 else
	 if(department == 1){

	 	if(canViewGrades!=0){

			let trade = drawTrade();

		}
	 	else{
	 		graphs
	 			.append(
					'<div class="col-md-12">'+
                      '<div class="box">'+
                        '<div class="box-header">'+
                          '<h3 class="box-title">You don\'t have permission to view your grades. Please contact your school administration!</h3>'+
                        '</div>'+
                      '</div>'+
                    '</div>'	 				
	 			);
	 	}		

		//get all the courses for the student... draw student attendance...

		if(canViewAttendance!=0){

			var jqxhr = $.ajax({
				url: baseUrl+'Students/getStudentCoursesById',   
				dataType:'json',
				type:'post',
				data: {id:class_id}           
			})          
			.done(function(response) {

				//console.log(response.courseList);

				if ( response.length != 0 ) {

					$.each(response.courseList, function(key,value){ 

						let attendance = getAttendance(value.course_id);
						
					})
					
				}
			})
		}
		else{
			pies
				.append(
					'<div class="col-md-12">'+
                      '<div class="box">'+
                        '<div class="box-header">'+
                          '<h3 class="box-title">You don\'t have permission to view your attendance. Please contact your school administration!</h3>'+
                        '</div>'+
                      '</div>'+
                    '</div>'
				)
		}		

	 }

	 function drawPrevoc(){

		//get all the courses for the student...

		var jqxhr = $.ajax({
			url: baseUrl+'Students/getStdCoursesNGrades',   
			dataType:'json',
			type:'post',
			data: {id:class_id, student_id:student_id}           
		})          
		.done(function(response) {

			if ( response.length != 0 ) {				

				$.each(response.courseListNGrade, function(key,value){

					let courseName = '';
					let shortName = '';
					let courseKey = value.course_id;

					//get the name of the course...

					$.each(listOfC,function(key,val){

						if(val.id == courseKey){
							courseName = val.name;
							shortName = val.short;
						}
					})

					//push into array

					preGrades.push({id:courseKey, short:shortName, name:courseName, mark:value.mark});

				})			
				
				console.log(preGrades);

			}
		})
		.done(function(){

			//console.log('This happens after the .ajax call...');

			if(preGrades.length > 0){

				graphs
					.append(
						'<div class="col-lg-12">'+
							'<div class="box box-primary">'+
								'<div class="box-header with-border">'+
									'<i class="fa fa-bar-chart-o"></i>'+
									'<h3 class="box-title">Bar Chart showing all grades</h3>'+
								'</div>'+
								'<div class="box-body" id="prevBodyChart">'+
								'<div id="prevChart" style="width:100%; height:250px;"></div>'
					);					

				graphs
					.append(
								'</div>'+
							'</div>'+
						'</div>'	
					);					

				let chartData = '[';
				let arrayLenght = preGrades.length;
				let count = 1;		
				
				$.each(preGrades, function(key, value){

					console.log(value);

					let randNum = Math.ceil(Math.random() * (68 - 0) + 0);

					//prepare json data to feed the bar graph...
															
					chartData += '{';
					chartData += '"completeName": "';
					chartData += value.name;
					chartData += '"';
					chartData += ', "visits":';
					chartData += value.mark;
					chartData += ', "country": " ';
					chartData += value.short;
					chartData += '"';
					chartData += ', "color": "';
					chartData += colors[randNum];
					chartData += '"';
					chartData += '}';

					if(count < arrayLenght){
						chartData += ',';								
					}

					count++;
				})
				
				chartData+=']';

				chartDataJson = JSON.parse(chartData);

				console.log(chartDataJson);

				if(chartData != '[]'){

					var chart = AmCharts.makeChart("prevChart", {
						"type": "serial",
						"theme": "light",
						"marginRight": 70,
						"dataProvider": chartDataJson,
						"valueAxes": [{
							"axisAlpha": 0,
							"position": "left",
							"title": "Grade Per Course Frequency"
						}],
						"startDuration": 1,
						"graphs": [{
							"balloonText": "<b>[[completeName]]: [[visits]]</b>",
							"fillColorsField": "color",
							"fillAlphas": 0.9,
							"lineAlpha": 0.2,
							"type": "column",
							"valueField": "visits"
						}],
						"chartCursor": {
							"categoryBalloonEnabled": false,
							"cursorAlpha": 0,
							"zoomable": false
						},
						"categoryField": "country",
						"categoryAxis": {
							"gridPosition": "start",
							"labelRotation": 45
						},
						"export": {
							"enabled": false
						}
					})
				}

			}


		})		

	 }
	
	 function drawTrade(){

		//get all the courses for the student...

		var jqxhr = $.ajax({
			url: baseUrl+'Students/getStudentCoursesById',   
			dataType:'json',
			type:'post',
			data: {id:class_id}           
		})          
		.done(function(response) {

			//console.log(response.courseList);

			if ( response.length != 0 ) {

				//runs for all courses and get the grades...

				$.each(response.courseList, function(key,value){ 

						//get the grades for the student...

						var jqxhr = $.ajax({
						url: baseUrl+'Students/getGradesByStudentId', 
						dataType:'json',
						type:'post',
						data: {student_id:student_id, class_id:class_id, course_id:value.course_id}           
						})          
						.done(function(data) {	

							//console.log(data);				

							$.each(data,function(key,value){


								//console.log('Line 72:');
								//console.log(value);

								let courseName = '';
								let shortName = '';
								let courseKey = key;

								//get the name of the course...

								$.each(listOfC,function(key,value){

									//console.log(value.id + ' == ' + courseKey);

									if(value.id == courseKey){
										courseName = value.name;
										shortName = value.short;
									}
								})

								//draw the containers for the bar charts...

								graphs
									.append(
									'<div class="col-lg-6">'+
										'<div class="box box-primary">'+
											'<div class="box-header with-border">'+
												'<i class="fa fa-bar-chart-o"></i>'+
												'<h3 class="box-title">'+ courseName + '</h3>'+
											'</div>'+
											'<div class="box-body" id="body'+courseKey+'">'
									);

								let courseBody = $('#body'+courseKey);

								courseBody
									.append('<div id="bar'+ courseKey +'" style=" width:100%; height:250px;"></div>');	
								
								let chartData = '[';
								let arrayLenght = value.length;
								let count = 1;

								$.each(value,function(key,value){

									//prepare json data to feed the bar graph...
									let randomNum = Math.ceil(Math.random() * (68 - 0) + 0);
										
									chartData += '{';
									chartData += '"completeName": "M';
									chartData += value.module;
									chartData += '"';
									chartData += ', "visits":';
									chartData += value.mark;
									chartData += ', "country": "Module ';
									chartData += value.module;
									chartData += '"';
									chartData += ', "color": "';
									chartData += colors[randomNum];
									chartData += '"';
									chartData += '}';

									if(count < arrayLenght){
										chartData += ',';								
									}

									//console.log('Count: ' + count + ', arrayLenght: ' + arrayLenght);

									count++;
								})

								chartData+=']';

								chartDataJson = JSON.parse(chartData);

								if(chartData != '[]'){

									var chart = AmCharts.makeChart("bar"+courseKey, {
										"type": "serial",
										"theme": "light",
										"marginRight": 70,
										"dataProvider": chartDataJson,
										"valueAxes": [{
											"axisAlpha": 0,
											"position": "left",
											"title": "Grade Per Course Frequency"
										}],
										"startDuration": 1,
										"graphs": [{
											"balloonText": "<b>[[completeName]]: [[visits]]</b>",
											"fillColorsField": "color",
											"fillAlphas": 0.9,
											"lineAlpha": 0.2,
											"type": "column",
											"valueField": "visits"
										}],
										"chartCursor": {
											"categoryBalloonEnabled": false,
											"cursorAlpha": 0,
											"zoomable": false
										},
										"categoryField": "country",
										"categoryAxis": {
											"gridPosition": "start",
											"labelRotation": 45
										},
										"export": {
											"enabled": false
										}
									})
								}

								graphs
									.append(
										'</div>'+
									'</div>'+
									'</div>'	
									);							

							})


						})


						//call function to draw attendance
						//let attendance = getAttendance(value.course_id);

				})	
			}
		})

	 }

		
	function getAttendance(course_id){

					//get the attendance for the student...

					var jqxhr = $.ajax({
						url: baseUrl+'Students/getAttendanceByStudentId',   
						dataType:'json',
						type:'post',
						data: {student_id:student_id, class_id:class_id, course_id:course_id}           
						})          
						.done(function(data) {	
	
							//console.log(data);
	
							$.each(data,function(key,value){
	
								let courseName = '';
								let shortName = '';
								let courseKey = key;
	
								//get the name of the course...
	
								$.each(listOfC,function(key,value){
	
									//console.log(value.id + ' == ' + courseKey);
	
									if(value.id == courseKey){
										courseName = value.name;
										shortName = value.short;
									}
								})
	
								//draw the containers for the bar charts...
	
								pies
									.append(
									'<div class="col-lg-6">'+
										'<div class="box box-primary">'+
											'<div class="box-header with-border">'+
												'<i class="fa fa-pie-chart"></i>'+
												'<h3 class="box-title">'+ courseName + '</h3>'+
											'</div>'+
											'<div class="box-body" id="bodyPie'+courseKey+'">'
									);
	
								let courseBody = $('#bodyPie'+courseKey);
	
								courseBody
										.append('<div id="pie'+ courseKey +'" style=" width:100%; height:250px;"></div>');	
	
								
								//let chartDiv = $('#bar'+courseKey);	
								let pieData = '[';
								let arrayLenght = value.length;
								let count = 1;
	
								let presentCount = 0;
								let absentCount = 0;
								let lateCount = 0;
								let sickCount = 0;
								let dismissedCount = 0;
	
								//let attCount = [];
	
								//console.log('Array Lenght: ' + value.length);
	
								$.each(value,function(key,value){
	
									//console.log(value);
	
									let attendance = value.attendance;
	
									switch(attendance){
										case "1": 
											presentCount += 1;
										break;
										case "2":
											absentCount += 1;
										break;
										case "3":
											//presentCount += 1;
											lateCount += 1;
										break;
										case "4":
											sickCount += 1;
										break;
										case "5":
											dismissedCount += 1;
										break;
										default:{
	
										}
									}
	
								})
	
								//present
	
								pieData += '{';
								pieData += '"country":"Present",';
								pieData += '"litres":';
								pieData += presentCount;
								pieData += '},';
	
								//absent
	
								pieData += '{';
								pieData += '"country":"Absent",';
								pieData += '"litres":';
								pieData += absentCount;
								pieData += '},';
	
								//Late
	
								pieData += '{';
								pieData += '"country":"Late",';
								pieData += '"litres":';
								pieData += lateCount;
								pieData += '},';
	
								//Sick
	
								pieData += '{';
								pieData += '"country":"Sick",';
								pieData += '"litres":';
								pieData += sickCount; 
								pieData += '},';
	
								//Late
	
								pieData += '{';
								pieData += '"country":"Dismissed",';
								pieData += '"litres":';
								pieData += dismissedCount;
								pieData += '}';																								
	
								pieData+=']';
	
								//console.log(pieData);
	
								let pieDataJson = JSON.parse(pieData);
								//console.log($(pieDataJson));
	
								console.log('Pie Data:')
								console.log(pieDataJson);
	
								if(pieData != '[]'){
	
									var chart = AmCharts.makeChart("pie"+courseKey, {
									"type": "pie",
									"theme": "light",
									"outlineColor": "",
									"dataProvider": pieDataJson,
									"valueField": "litres",
									"titleField": "country",
									"balloon": {
										"fixedPosition": true
									}
									});						
	
								}
	
								pies
									.append(
											'</div>'+
										'</div>'+
									'</div>'	
									);
							})
						})


	}		

})