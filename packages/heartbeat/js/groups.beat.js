hp.set('hooks.heartbeat.groups', function(data) {
    var html = $('<div />').html(data).text();
    $('#notices_groups .notices_information').html(html);
    
    var unread = parseInt($('#notices_groups div ul').attr('value'), 10) || 0;
    if ( unread == NaN )
	unread = 0;
    hp.packages.heartbeat.set_active('#ui_noticebar_groups', unread, 'Grupper');
});