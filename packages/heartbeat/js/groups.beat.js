hp.set('hooks.heartbeat.groups', function(data) {
    var html = $('<div />').html(data).text();
    $('#notices_groups div').html(html);
    
    var unread = parseInt($('#notices_groups div ul').attr('value'), 10);
    
    var link = $('#ui_noticebar_groups');
    if ( unread == 0 ) {
	link.parent().removeClass('active');
	link.text('Grupper');
    } else {
	link.parent().addClass('active');
	if ( unread == 1 ) {
	    link.text('1 ny');
	} else {
	    link.text(unread + ' nya');
	}
    }
});