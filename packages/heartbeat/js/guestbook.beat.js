hp.set('hooks.heartbeat.guestbook', function(unread) {
    unread = parseInt(unread, 10);
    hp.packages.heartbeat.set_active('#notices_guestbook a', unread, 'Gästbok');
});