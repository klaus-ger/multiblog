jQuery(function($){
        $.datepicker.regional['de'] = {clearText: 'löschen', clearStatus: 'aktuelles Datum löschen',
                closeText: 'schließen', closeStatus: 'ohne Änderungen schließen',
                prevText: '<zurück', prevStatus: 'letzten Monat zeigen',
                nextText: 'Vor>', nextStatus: 'nächsten Monat zeigen',
                currentText: 'heute', currentStatus: '',
                monthNames: ['Januar','Februar','März','April','Mai','Juni',
                'Juli','August','September','Oktober','November','Dezember'],
                monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                'Jul','Aug','Sep','Okt','Nov','Dez'],
                monthStatus: 'anderen Monat anzeigen', yearStatus: 'anderes Jahr anzeigen',
                weekHeader: 'Wo', weekStatus: 'Woche des Monats',
                dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayStatus: 'Setze DD als ersten Wochentag', dateStatus: 'Wähle D, M d',
                dateFormat: 'dd.mm.yy', firstDay: 1, 
                initStatus: 'Wähle ein Datum', isRTL: false};
        $.datepicker.setDefaults($.datepicker.regional['de']);
});


$(function() {
    
    $( "#datepicker" ).datepicker(); 
			
    $( "input[type=submit],     .button" )
    .button()
    .click(function( event ) {
        //event.preventDefault();
        });
  
    $( ".button" ).button();
	
    $( "#tabs" ).tabs();
    

		
});      
        
jQuery("document").ready(function(){

    /*
 * Editor einstellungen
 */
    $("#editor").cleditor({
        width:  650, // width not including margins, borders or padding
        height: 300, // height not including margins, borders or padding
        controls:     // controls to add to the toolbar
        "bold italic underline strikethrough subscript superscript | " +
    " removeformat | bullets numbering | outdent " +
    "indent | alignleft center alignright justify " +
    "| link unlink | cut source"
                        
    });

    //Formvalidierung Comment Form
    $(".sendbutton").click( function(e)  {

        //Validierungsfelder
        name      = $("#name").val();
        email     = $("#email").val();
        title     = $("#title").val();
        comment   = $("#comment").val();
    
        if (name == '') {
            $('.error_name').html('Bitte Name eintragen!<br />');
            error1 = '1';
        } else {
            $('.error_name').html('');
            error1 = '0';
        }
        if (email  == '') {
            $('.error_email').html('Bitte e-mail ergänzen. <br />');
            error2 = '1';
        } else {
            $('.error_email').html('');
            error2 = '0';
        }
        if ( title == ''){
            $('.error_title').html('Bitte Kommentartitel ergänzen.<br />');
            error3 = '1';
        } else {
            $('.error_title').html('');
            error3 = '0';
        }
        if (comment== '') {
            $('.error_comment').html('Kein Kommentartext eingetragen.<br />');
            error4 = '1';
        } else {
            $('.error_comment').html('');
            error4 = '0';
        }
    
        error = error1 + error2 + error3 + error4;
        
        if (error == '0000') {
            //console.log('ok');
            //document.formdata.action = baseurl ;
            document.newComment.submit();
            return true;
        }
    
    
    });



}); /*jquery END */


