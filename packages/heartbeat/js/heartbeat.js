hp.set('packages.heartbeat', {
    current_time: 20000,
    
    init: function() {
	$(document).ready(function() {
	    setTimeout(hp.packages.heartbeat.update, hp.packages.heartbeat.get_time());
	});
    },
    
    update: function() {
	$.getJSON('/heartbeat', function(data) {
	    var hooks = hp.hooks.heartbeat;
	    for ( var hook in data )
		if ( hooks[hook] )
		    hooks[hook].call(hooks[hook], data[hook]);
	    
	    setTimeout(hp.packages.heartbeat.update, hp.packages.heartbeat.get_time());
	});
    },
    
    get_time: function() {
	this.current_time += this.current_time * 0.10;
	return this.current_time;
    }
});

hp.packages.heartbeat.init();