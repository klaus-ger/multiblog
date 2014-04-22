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
    fblink += '</a>';
        
    $('.facebook').html(fblink);
    
    var googlelink = '';
    googlelink += '<a href=\"https://plus.google.com/share?url=';
    googlelink += url;
    googlelink += '\" onclick=\"javascript:window.open(this.href,\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;\">';
    googlelink += '<img width="48" height="48" src="typo3conf/ext/multiblog/Resources/Public/Icons/google.png" alt="share on Facebook">';
    googlelink += '</a>';
 
    $('.google').html(googlelink);
    
    var twitterlink = '';
    twitterlink += '<a onClick=\"window.open(\'http://twitter.com/share?url=';
    twitterlink += url;
    twitterlink += '\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');\" href=\"javascript: void(0)\">';
    twitterlink += '<img width="48" height="48" src="typo3conf/ext/multiblog/Resources/Public/Icons/twitter_grey.png" alt="share on Twitter">';
    twitterlink += '</a>';
    
    $('.twitter').html(twitterlink);
    
    
    //Edit Pages **************************************************************
    //Datepicker
       // $.datepicker.setDefaults( $.datepicker.regional[ "de" ] );
        $.datepicker.formatDate( "dd.mm.yy");
       // $.datepicker.parseDate( "yy-mm-dd", "2007-01-26" );
        $( ".datepicker" ).datepicker({ dateFormat: 'dd.mm.yy' });
   
    
    //Toggle Teaser and Content
    $('.multiblog-form-postcontent-header').click(function(e) {
    
        if($(this).hasClass('multiblog-arrow-down')){
            $(this).removeClass('multiblog-arrow-down');
            $(this).addClass('multiblog-arrow-right');
        
            $(this).closest('.multiblog-form-postcontent').find('.multiblog-form-postcontent-content').hide();
        } else {
            $(this).removeClass('multiblog-arrow-right');
            $(this).addClass('multiblog-arrow-down');
            $(this).closest('.multiblog-form-postcontent').find('.multiblog-form-postcontent-content').show();
        }
    
    });
    
    //category select
    var choosenCats = [];
    
    //existing cats
    $(".cat-active").each(function(index, value) { 
        
        var catid = $(value).data("id");
        choosenCats.push(catid);
    });
    $('.jqCatselect').val(choosenCats);
    
    
    $('.multiblog-edit-catrow').click(function(e) {
        var cattext = $(this).html();
        var catid = $(this).data("id");
        
        var catrow = '<div class="cat-active" data-id="' + catid + '">' + cattext + '</div>';
        $('.multiblog-cat-select').append(catrow);
        
        choosenCats.push(catid);
        $('.jqCatselect').val(choosenCats);
        
        $('.jqCatselectList').toggle();
  
    });
    
    //remove cat
     $('#multiblog').on("click", ".cat-active", function() {
    
        var catid = $(this).data("id");
        choosenCats.splice($.inArray(catid, choosenCats),1);
        $('.jqCatselect').val(choosenCats);
        $(this).remove();
    });
    
    //toggle cat list
    $('.multiblog-cat-add').click(function(e) {
        $('.jqCatselectList').toggle();
    });
    
    //Textarea to editor
    CKEDITOR.replace( 'editor1' );
    
    var numItems = $('div.multiblog-form-postcontent').length;
    var count = 1;
    while (count <= numItems){
        CKEDITOR.replace( 'content' + count );
        count++;
    }
    
    
    
    
    
});

