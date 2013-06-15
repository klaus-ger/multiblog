

if(!window.console){
    window.console={
        log:function(){}
    }
    }

jQuery(document).ready(function(){

var height;
var imgwidth = $('.imgwidth').html();
var imgheight = $('.imgheight').html();
var ratio =  imgheight / imgwidth ;

var width = $('.t3devslider').outerWidth()
var height = width * ratio;
$('.t3devslider').css('height', height);

$(window).resize(function() {
    var width = $('.t3devslider').outerWidth()
    var height = width * ratio;
    $('.t3devslider').css('height', height);
});


$(function(){
    $('.t3devslider img:gt(0)').hide();
       
    setInterval(function(){

      $('.t3devslider :first-child').fadeOut('slow')
         .next('img').fadeIn('slow')
         .end().appendTo('.t3devslider');}, 
      5000);
    });

});
 


