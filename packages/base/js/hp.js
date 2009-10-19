window.hp = {
    packages: {},
    
    set: function(namespace, value) {
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
    },
    
    login_checklogin: function() {
	return <?php echo (int)$page->user->exists(); ?>;
    }
};

function debug(msg) {
    var dt = $('<dt/>').html('JSdebug');
    var dd = $('<dd/>').html(typeof msg === 'undefined' ? 'undefined' : msg);

    $('#debug').append(dt)
	.append(dd)
	.animate({scrollTop: $('#debug').innerHeight() });
}