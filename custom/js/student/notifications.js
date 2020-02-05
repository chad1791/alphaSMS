$(function(){

	let baseUrl    = $('#base_url').val();
	let student_id = $('#student_id').val();
	//let noteTable  = $('#noteTable'); 

	$("#noteTable").load(baseUrl + 'Students/getAllNotifications', {
	    id: student_id
	});	

})