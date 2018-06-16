var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.top').outerHeight();

$(window).scroll(function(event){
	didScroll = true;
});
setInterval(function() {
	"use strict" ;
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);
function hasScrolled() {
    var st = $(this).scrollTop();
	
    if(Math.abs(lastScrollTop - st) <= delta)
        return;   
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.top').addClass('minimize')
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
			   $('.top').removeClass('minimize');;
        }
    }    
    lastScrollTop = st;
}