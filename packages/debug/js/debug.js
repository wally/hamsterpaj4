function debug(msg)
{
	var dt = $('<dt/>').html('JSdebug');
	var dd = $('<dd/>').html(msg);

	$('#debug').append(dt);
	$('#debug').append(dd);
	$('#debug').animate({scrollTop: $('#debug').attr('scrollHeight') });
}