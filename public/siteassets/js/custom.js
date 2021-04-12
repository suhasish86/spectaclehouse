//HeaderFix
$(document).ready(function(){
    $(window).scroll(function(){
        var scrollTop = 60
        if($(window).scrollTop() >= scrollTop){
            $('header').addClass('headerFix');
        }
        if($(window).scrollTop() < scrollTop){
            $('header').removeClass('headerFix');
        }
    })
});
//HeaderFix End

//product mobile filter
$(function(){
    $('.filterMenu').click(function(){
        $('.leftPanel').toggleClass('leftPanelOpen');
    });
});
//product mobile filter end



//product  filter expend collaps
$(function (){
   
   $('.leftBox h5').click(function(){
       $('.leftBoxContent').slideUp(); 
        $('.leftBox h5').removeClass('hOpen'); 
       if($(this).next('.leftBoxContent').is(':hidden')){
           jQuery(this).next('.leftBoxContent').slideDown();
           $(this).select('.leftBox h5').addClass('hOpen');
           }
       else {
           jQuery(this).next('.leftBoxContent').slideUp(
           function(){
               $('.leftBox h5').removeClass('hOpen');
               });
           }
       }); 
    
    });
//product  filter expend collaps end

//checkout expend collaps
$(function (){
   
    $('.checkoutBox h4').click(function(){
        $('.checkoutBoxContent').slideUp(); 
         $('.checkoutBox h4').removeClass('hOpen'); 
        if($(this).next('.checkoutBoxContent').is(':hidden')){
            jQuery(this).next('.checkoutBoxContent').slideDown();
            $(this).select('.checkoutBox h4').addClass('hOpen');
            }
        else {
            jQuery(this).next('.checkoutBoxContent').slideUp(
            function(){
                $('.checkoutBox h4').removeClass('hOpen');
                });
            }
        }); 
     
     });
 //checkout expend collaps end

