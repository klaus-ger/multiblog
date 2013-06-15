
  
$(".jqueryMenu").click(
 
    function(e)  {
         
        if ( !$('#mobilMenuListe').hasClass('hidden') ) {  
           $('#mobilMenuListe').addClass('hidden');
        }
        else {  
           $('#mobilMenuListe').removeClass('hidden');
        }
    });
     


