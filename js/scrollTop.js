$(document).ready(function(){

	// for selection window scrollTop
	$(window).scroll(function(){
	// 	// for margin when greater than 40px
		if ($(this).scrollTop() > 10) { 
			$('#btnScrollToTop').fadeIn();
			// $('#btnScrollToTop').css('display','block');
		}else{
			$('#btnScrollToTop').fadeOut();
			// $('#btnScrollToTop').css('display','none');
		}
	});

	$('#btnScrollToTop').click(function(){
		$('html, body').animate({
			scrollTop: 0
		});
	});
});