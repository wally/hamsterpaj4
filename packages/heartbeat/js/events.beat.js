hp.set('hooks.heartbeat.events', function(data) {
    var html = $('<div />').html(data).text();
    $('#notices_events .notices_information').html(html);
    
    var unread = parseInt($('#notices_events h4').attr('value'), 10);
    hp.packages.heartbeat.set_active('#ui_noticebar_events', unread, 'Händelser');
});