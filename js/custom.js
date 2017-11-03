
jQuery(document).ready(function () {
	
	 jQuery('.send').click(function(){
		  var validflag = true;
		//Name 
				
				if(jQuery('.input-sm').val().trim()=="" ){
					$('.input-sm').css({'border':'1px solid #ff0000'});
					$("#error").show();
                              alert('Plz Enter Zipcode');
					validflag = false;
				}
				else{
					$('.input-sm').css({'color':'#333333'});
					$("#error").hide();
				}
				
		
		
	});
			 
			 // Focus and blure 
				jQuery('.input-sm').focus(function(){
						$(this).css({'border-color':'#000000'});
						$("#error").hide();
                              
				});
				
				jQuery('.input-sm').blur(function(){
					
						$(this).css({'border-color':'#e2e2e2'});

				});
				
			
			 
				
						
});

