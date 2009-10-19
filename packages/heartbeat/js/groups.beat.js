hp.set('hooks.heartbeat.groups', function(data) {
    var html = $('<div />').html(data).text();
    $('#notices_groups div').html(html);
});