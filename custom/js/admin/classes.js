$(function(){
	//alert('hello from administrators js file');

	var delBtn = $('#example1');
	var editBtn = $('#example1');
	var viewBtn = $('#example1');
	var baseUrl = $('#base').val();

	let addClassBtn = $('#addClassBtn');
	let dept = $('#depList');
	let lvlLst = $('#levelsList');

	let upDept = $('#upDepList');
	let upLvl = $('#upLevel');
	//adding default departments...

	let departId = dept.val();

	if(departId == 0){

		lvlLst
			.empty()
			.append(
				'<option value="Year 1">Year 1</option>' +
				'<option value="Year 2">Year 2</option>'
			);
	}
	else
	if(departId == 1){

		lvlLst
			.empty()
			.append(
				'<option value="Level 1">Level 1</option>' +
				'<option value="Level 2">Level 2</option>' +
				'<option value="Level 3">Level 3</option>' +
				'<option value="Level 4">Level 4</option>'
			);
	}	
	
	//checking for change in departments...

	dept
		.on('change', function(){
			//alert('Department was changed!');

			let deptId = $(this).val();
			//alert(deptId);

			if(deptId == 0){

				lvlLst
					.empty()
					.append(
						'<option value="Year 1">Year 1</option>' +
						'<option value="Year 2">Year 2</option>'
					);
			}
			else
			if(deptId == 1){

				lvlLst
					.empty()
					.append(
						'<option value="Level 1">Level 1</option>' +
						'<option value="Level 2">Level 2</option>' +
						'<option value="Level 3">Level 3</option>' +
						'<option value="Level 4">Level 4</option>'
					);
			}
		})

	//checking for change in departments, update feature...

	upDept
		.on('change', function(){
			//alert('Department was changed!');

			let deptId = $(this).val();
			//alert(deptId);

			if(deptId == 0){

				upLvl
					.empty()
					.append(
						'<option value="Year 1">Year 1</option>' +
						'<option value="Year 2">Year 2</option>'
					);
			}
			else
			if(deptId == 1){

				upLvl
					.empty()
					.append(
						'<option value="Level 1">Level 1</option>' +
						'<option value="Level 2">Level 2</option>' +
						'<option value="Level 3">Level 3</option>' +
						'<option value="Level 4">Level 4</option>'
					);
			}
		})		

	//general options for toastr notifications...

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

	$('#xAddClassClose, #addClassClose')
		.on('click', function(){

			location.reload('classes');

	})		

	addClassBtn
		.on('click', function(){

			let classN = $('#class');
			let dept = $('#depList');
			let level = $('#levelsList');
			let des = $('#des');

			//test for empty data...

			if($.trim(classN.val()).length > 0 && $.trim(level.val()).length > 0 && $.trim(des.val()).length > 0){

				var jqxhr = $.ajax({
				    url: baseUrl + 'Admins/addClass',    
				    dataType:'json',
				    type:'post',
				    data: {
				    	class:classN.val(), 
				    	level:level.val(),  
				    	des:des.val(),
				    	dept:dept.val()  
				    }           
				})
				.done(function( response ){

					if(response){
						toastr.success('Class was successfully added!', 'Alpha SMS Says');

						//clean up fields for new entry...

						classN.val("");
						des.val("");					
					}
					else{
						toastr.error('Class could not be added!', 'Alpha SMS Says');
					}

				})
			}
			else{
				toastr.error('Please fill in all fields!', 'Alpha SMS Says');
			}						

		})

	delBtn
		.on('click','[data-fnx="delete"]',function(e){

			e.preventDefault();

			let row_id = $(this).data('rem_id');
			let current_row = $('#'+row_id);
			let className = current_row.find('td:eq(0)').text();
			let level = current_row.find('td:eq(1)').text();

			if(confirm('Are you sure you want to delete ['+className+' '+level+'] from the Classes list?')){
				
				$.ajax({
				  method: "POST",
				  url: baseUrl+"Admins/delClassById", 
				  //dataType: "json",
				  data: { id: row_id }
				})
				.done(function( response ) {

					//window.location.replace(baseUrl+'classes'); 
					toastr.success('Class data was successfully deleted!', 'Alpha SMS Says');

					$('#'+row_id).fadeOut('slow');						
					
				})
				
			} 

		})

	editBtn
		.on('click','[data-fnx="update"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('up_id');
			let current_row = $('#'+row_id);

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getClassById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  console.log(response.class);

			  //getting levels here...

			  	/*let labelvalues = [];

				$('#levelsList>option').each(function(i, option) {
				 labelvalues[i] = $(option).val();
				});

				console.log(labelvalues);

				$('#upLevel').empty();*/

			  $.each(response.class,function(key,value){
			  	
			  	//e.preventDefault();
			  	let upDepElem = $('#upDepList');
			  	let depart = value.department;
			  	let level = value.level;

			  	if(depart == 0){

			  		//append class department...

			  		upDepElem
			  			.empty()
			  			.append(
			  				'<option value="0" selected="selected">Pre - Vocational</option>'+
			  				'<option value="1" disabled="disabled">Trade</option>'
			  			);

			  		$('#upDepList').val(depart);

			  		switch(level){
			  			case 'Year 1':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="'+ level +'" selected="selected">Year 1</option>'+
			  						'<option value="Year 2" >Year 2</option>'
			  					);
			  			}
			  			break;
			  			case 'Year 2':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="Year 1" >Year 1</option>'+
			  						'<option value="'+ level +'" selected="selected">Year 2</option>'
			  						
			  					);
			  			}
			  			break;
			  			default:{

			  			}
			  		}

			  	}
			  	else
			  	if(depart == 1){

			  		//append class department...

			  		upDepElem
			  			.empty()
			  			.append(
			  				'<option value="0" disabled="disabled">Pre - Vocational</option>'+
			  				'<option value="1" selected="selected">Trade</option>'
			  			);			  		

			  		$('#upDepList').val(depart);

			  		switch(level){
			  			case 'Level 1':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="'+ level +'" selected="selected">Level 1</option>'+
			  						'<option value="Level 2" >Level 2</option>'+
			  						'<option value="Level 3" >Level 3</option>'+
			  						'<option value="Level 4" >Level 4</option>'
			  					);
			  			}
			  			break;
			  			case 'Level 2':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="Level 1" >Level 1</option>'+
			  						'<option value="'+ level +'" selected="selected">Level 2</option>'+
			  						'<option value="Level 3" >Level 3</option>'+
			  						'<option value="Level 4" >Level 4</option>'			  						
			  					);
			  			}
			  			break;
			  			case 'Level 3':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="Level 1" >Level 1</option>'+
			  						'<option value="Level 2" >Level 2</option>'+
			  						'<option value="'+ level +'" selected="selected">Level 3</option>'+			  						
			  						'<option value="Level 4" >Level 4</option>'			  						
			  					);
			  			}
			  			break;
			  			case 'Level 4':{
			  				$('#upLevel')
			  					.empty()
			  					.append(
			  						'<option value="Level 1" >Level 1</option>'+
			  						'<option value="Level 2" >Level 2</option>'+
			  						'<option value="Level 3" >Level 3</option>'+
			  						'<option value="'+ level +'" selected="selected">Level 4</option>'			  						
			  					);
			  			}
			  			break;
			  			default:{

			  			}
			  		}			  		

			  	}


			  	$('#classDbId').val(value.id);
			  	$('#upClassName').val(value.name); 

			  	/*for (var i = 0; i < labelvalues.length; i++) {
			  		//console.log(labelvalues[i]);
			  		if(value.level==labelvalues[i]){
			  			$('#upLevel').append('<option value="'+value.level+'" selected="selected">'+value.level+'</option>');
			  		}
			  		else{
			  			$('#upLevel').append('<option value="'+labelvalues[i]+'">'+labelvalues[i]+'</option>');
			  		}
			  	}*/
			  		
			  	$('#upDesc').val(value.description);
			  	$('#updateAdmin').modal('show'); 

			  });



			});

		})

	viewBtn
		.on('click','[data-fnx="view"]',function(e){

			e.preventDefault();

			var row_id = $(this).data('view_id');
			let current_row = $('#'+row_id);

			//call ajax to get admin data...

			$.ajax({
			  method: "POST",
			  url: baseUrl+"Admins/getClassById",
			  dataType: "json",
			  data: { id: row_id }
			})
			.done(function( response ) {

			  console.log(response.class);

			  $.each(response.class,function(key,value){
			  	
			  	//e.preventDefault();

			  	$('#viewClass').text(value.name);
			  	$('#viewLevel').text(value.level);
			  	$('#viewDescription').text(value.description);
			  	$('#viewSettings').empty().append('<a href="' + 'class/' + value.id + '">Setup courses and teachers</a>');

			  	$('#viewAdmin').modal('show'); 

			  });
			});
		})
});