window.hp.packages = {};

window.hp.set = function(namespace, value) {
    var spaces = namespace.split('.'),
	current = hp;
    
    for ( var i = 0, last = spaces.length - 1, space; space = spaces[i]; i++ ) {
	if ( ! current[space] )
	    current[space] = {};
	
	if ( i !== last )
	    current = current[space];
	else
	    current[space] = value;
    }
};

function debug(msg) {
    $(document).ready(function() {
	if ( typeof msg == 'object' ) {
	    var message = '{';
	    for ( var key in msg ) if ( msg.hasOwnProperty(key) ) {
		message += key + ': ' + msg[key] + ',<br />';
	    }
	    msg = message.substr(0, message.length - 7) + '}';
	}
	var dt = $('<dt/>').html('JSdebug');
	var dd = $('<dd/>').html(typeof msg === 'undefined' ? 'undefined' : msg);
    
	$('#debug').append(dt)
	    .append(dd)
	    .attr('scrollTop', 100000000);
    });
}