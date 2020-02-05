$(function(){
	//alert('This is the student dashboard js file!');

  let countDownItem = $('[data-fnx="count_down"]');
  //let downloadBtn = $('[data-download="downloadFile"]');
  let baseUrl = $('#base_url').val();
  
  /*downloadBtn
  	.on('click',function(){

  		let fileName = $(this).data('filename');

  		alert(fileName);

		$.ajax({
			method: "POST",
			url: baseUrl+"Students/downloadFile", 
			data: { fileName: fileName }
		})
		.done(function( response ) {

			//window.location.replace(baseUrl+'courses'); 
			//console.log(response);
					
		})  		 

  	})*/

  $.each(countDownItem,function(key,val){

    //console.log(val);

    if($(val).attr('id') != ' '){

      // Set the date we're counting down to

      let myDate = $(val).attr('id');
      let countDownDate = new Date(myDate).getTime();    

      console.log(countDownDate);

      // Update the count down every 1 second
      var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();
          
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
          
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
        // Output the result in an element with id="demo"
        $(val).text(days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ");
          
        // If the count down is over, write some text 
        if (distance < 0) {
          clearInterval(x);
          $(val).text("EXPIRED");
          $('#files').prop('readonly',true);
          $('#files').on('click',function(){ alert('Assignment has reached it\'s expiry date! You cannot upload files to this assignment.'); return false; })
        }
      }, 1000);       

    }
    else{
      $(val).text(' Open');
      $('#uploadSection').css('display','none');
      $('#footer').css({'margin-top':'85px'});
      //console.log(val);
    }

  });


});