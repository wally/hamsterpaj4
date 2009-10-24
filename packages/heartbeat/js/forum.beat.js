hp.set('hooks.heartbeat.forum', function(data) {
    var html = $('<div />').html(data).text();
    $('#notices_forum .notices_information').html(html);
    
    var unread = parseInt($('#notices_forum h4 span').text(), 10);
    hp.packages.heartbeat.set_active('#ui_noticebar_forum', unread, 'Forum');
});