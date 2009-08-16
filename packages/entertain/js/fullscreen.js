$(document).ready(function() {
	$('#fullscreen_button').click(function() {
		$('#entertain_flash_object').addClass('entertain_flash_object_fullscreen');
		$('#entertain_flash_object').removeClass('entertain_flash_object');
		
		$('body').toggleClass('remove_scroll');
		
		var winWidth = $(window).width();
		var winHeight  = $(window).height() - 40;
		
		$('#entertain_flash_object').width(winWidth);
		$('#entertain_flash_object').height(winHeight);
		
		$('#entertain_close_fullscreen_bar').css('display', 'block');
	});
	
	// Close fullscreen
	$('#fullscreen_button_close').click(function() {

		$('#entertain_flash_object').removeClass('entertain_flash_object_fullscreen');
		$('#entertain_flash_object').addClass('entertain_flash_object');
		
		$('body').toggleClass('remove_scroll');
		$('#entertain_flash_object').removeAttr('style');
		$('#entertain_close_fullscreen_bar').css('display', 'none');
	});
});