$(document).ready(function () {
	$(".list li").addClass('start');
	var selectTarget = $('.selectbox select');
	selectTarget.change(function () {
		var select_name = $(this).children('option:selected').text();
		$(this).siblings('label').text(select_name);
	});
	$('.back').click(function () {
		event.preventDefault();
		window.history.back();
	});
	$('.filter').click(function () {
		event.preventDefault();
		$('.filterWindow').addClass('b2t');
		$('body').css('overflow', 'hidden');
	});
	$('.switch').click(function () {
		$(this).toggleClass('on');
	});
	$('.viewmore').click(function () {
		event.preventDefault();
		$(this).parent().parent().find('.desc').toggleClass('expand');
		$(this).toggleClass('exped');
		if ($(this).parent().parent().find('.desc').hasClass('expand')) {
			$(this).parent().parent().find('.viewmore').text('닫기');
		} else {
			$(this).parent().parent().find('.viewmore').text('더보기');
		}
	});
	$('.close, .apply').click(function () {
		event.preventDefault();
		$('.filterWindow').removeClass('b2t');
		$('body').css('overflow', 'auto');
		if ($('.filterWindow input[type=checkbox]').is(":checked")) {
			$('.filter').addClass('ed');
		} else {
			$('.filter').removeClass('ed');
		}
	});
	$('.like').click(function () {
		event.preventDefault();
		$(this).toggleClass('liked');
	});
	$('.faq li, .qna li').click(function () {
		$(this).find('.a').slideToggle(200);
		$(this).siblings().find('.a').slideUp(200);
	});
	$('.share').click(function () {
		$('.sharepop').slideToggle(200);
	});
	$('.sharepop .shareclose').click(function () {
		$('.sharepop').slideUp(200);
	});
	$('.accept').click(function () {
		$('.agree_ok').css('bottom','0');
	});
	$('.agree_ok a').click(function () {
		$('.agree_ok').css('bottom','-100%');
		$('.agree').css('display','none');
	});
	$('.price').click(function () {
		event.preventDefault();
		$('.idPrice').css('right','0');
		$('body').css('overflow', 'hidden');
	});
	$('.bxslider li').click(function () {
		event.preventDefault();
		$('.idImg').css('right','0');
		$('body').css('overflow', 'hidden');
	});
	$('.mapintro').click(function () {
		event.preventDefault();
		$('.idMap').css('right','0');
		$('body').css('overflow', 'hidden');
	});
	$('.next .close').click(function () {
		event.preventDefault();
		$('.next').css('right','-100%');
		$('body').css('overflow', 'auto');
	});
	//
	$('.bxslider').bxSlider({
		auto: true,
		autoControls: true,
		stopAutoOnClick: true,
		pager: true,
		pagerType: 'short'
	});
/*	$('.listSlider').bxSlider({
		auto: false,
		autoControls: false,
		stopAutoOnClick: true,
		pager: true,
		pagerCustom: '#bx-pager',
		controls: false
	});*/
});


