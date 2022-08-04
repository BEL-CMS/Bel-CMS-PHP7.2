$(function(){
	
"use strict";
	
  var nb = $('#navbtn');
  var n = $('.header-section .main-menu');
  
  $(window).on('resize', function(){
    
    if($(this).width() < 570 && n.hasClass('keep-nav-closed')) {
      // if the nav menu and nav button are both visible,
      // then the responsive nav transitioned from open to non-responsive, then back again.
      // re-hide the nav menu and remove the hidden class
      $('.header-section .main-menu').hide().removeAttr('class');
    }
    if(nb.is(':hidden') && n.is(':hidden') && $(window).width() > 569) {
      // if the navigation menu and nav button are both hidden,
      // then the responsive nav is closed and the window resized larger than 560px.
      // just display the nav menu which will auto-hide at <560px width.
      $('.header-section .main-menu').show().addClass('keep-nav-closed');
    }
  }); 

  $('#navbtn').on('click', function(e){
    e.preventDefault();
    $(".header-section .main-menu").slideToggle(350);
  });
  
});