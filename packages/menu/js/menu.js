hp.set('menu', {
    timers: {},
    visible: {},
    
    // "Stolen" from jQuery source
    withElement: function(event, callback) {
	// Check if mouse(over|out) are still within the same parent element
	var parent = event.relatedTarget;
	// Traverse up the tree
	while ( parent && parent != this )
	    try { parent = parent.parentNode; }
	    catch(e) { parent = this; }
	
	if( parent != this ){
	    // handle event if we actually just moused on to a non sub-element
	    callback.call( this, event );
	}
    },
    
    over: function(event, li) {
	hp.menu.withElement.call(li, event, hp.menu.on_over);
    },
    
    on_over: function() {
	var li = $(this), key = li.attr('id');
	// This element is hovered again, and should not disappear
	hp.menu.timers[key] = clearTimeout(hp.menu.timers[key]);
	// Hide all elements except this one
	hp.menu.clear_hover(this);
	// Add to visible
	hp.menu.visible[key] = this;
	// Simulate hover
        li.addClass('active_menu');
    },
    
    out: function(event, li) {
	hp.menu.withElement.call(li, event, hp.menu.on_out);
    },
    
    on_out: function() {
	var li = $(this), key = li.attr('id');
	hp.menu.timers[key] = setTimeout(function() {
	    li.removeClass('active_menu');
	    $('#main_menu .the_active').addClass('active_menu');
	}, 1000);
    },
    
    clear_hover: function(except) {
	jQuery.each(hp.menu.visible, function(key) {
	    var t = $(this), k = t.attr('id');
	    if ( this !== except ) {
		hp.menu.timers[k] = clearTimeout(hp.menu.timers[k]);
		t.removeClass('active_menu');
	    }
	});
    }
});
