$(function(){
	//alert('Hi from the search page...');

	//fix error with student url....

	let searchBtn = $('#search-btn');
	let searchTxt = $('#query');
	let baseUrl = $('#base').val();
	var myUrl = 'general';
	
	searchBtn
		.on('click',function(){

			let searchQuery = searchTxt.val();

			if(searchQuery == ''){
				alert('Please type a student name to search!');
			}
			else{
				
				//call ajax to get the search results...

				$.ajax({
					url: baseUrl + 'Admins/search',   
					method:'POST',
					datatype:'json',
					data:{ query : searchQuery },
					success:function(data){

						myUrl = $('#Special').val();

						if($.trim(data)){

							//console.log('Something went wrong: ');
							//console.log(data);

							if(myUrl === 'Special'){
								//document.location.replace();
								$(location).attr('href',baseUrl+'./search/');
							}
							else{
								window.location.href = baseUrl+'student/'+data;
							}

						}
						else{

							if(myUrl === 'Special'){
								$(location).attr('href',baseUrl+'./search/');
							}
							else{
								window.location.replace('search');
							}
						}
						

					}
				})

			}

			return false;
		})

});