$(document).ready(function () {
    
    
    //send comment via ajax ====================================================
    //$('.multiblog').on("click", ".jq-send", function() {
        $('.jq-send').click(function(e) {
        var blogid = $('#jq-multiblog-blogid').val();
        var postid = $('#jq-multiblog-postid').val();
        var name   = $('#jq-multiblog-commentname').val();
        var email  = $('#jq-multiblog-commentmail').val();
        var text   = $('#jq-multiblog-commenttext').val();
        console.log('klick');
        //TODO Add formvalidation
        $.ajax({
            async: 'true',
            url: 'index.php',       
            type: 'POST',  
          
            data: {
                eID: "ajaxDispatcher",   
                request: {
                    extensionName:  'Multiblog',
                    pluginName:     'singleblog',
                    controller: 'Blog', 
                    action:     'ajaxNewComment',
                    arguments: {
                        'blogid': blogid,
                        'postid': postid,
                        'name': name,
                        'email': email,
                        'text': text
                    }
                } 
            },
            dataType: "json",  
            	
            success: function(result) {
                $('.comment-form .col-main').html('Thank you for dropping a note.')
            },
            error: function(error) {
                console.log(error);
            }
 
        });
        
    });
    
    
    var url = $(location).attr('href');
    var fblink = '';
    fblink += '<a onClick=\"window.open(\'https://www.facebook.com/sharer/sharer.php?u=';
    fblink += url;
    fblink += '\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');\" href=\"javascript: void(0)\">';
    fblink += '<img width="48" height="48" src="typo3conf/ext/multiblog/Resources/Public/Icons/facebook_grey.png" alt="share on Facebook">';
    fblink += '</a>'
        
    $('.facebook').html(fblink);
});

