jQuery.fn.extend({
	/*
	    jQuery.fadeInOnAnother
	    
	    Will fade in <this> over <theOld>. Like <jQuery.fadeIn> combined with <jQuery.fadeOut>
	    but nicer.
	    
	    Parameters:
		theOld - The element to fade over, which will fadeOut and disappear
		callback - A callback that will be called upon completion
	    
	    Returns:
		this
	*/
	
	fadeInOnAnother: function(theOld, options) {
		var callback = options.callback,
		    appendType = options.appendType || 'appendTo';
		
		theOld = $(theOld);
		
		var parent = theOld.parent(),
		    self = $(this);
		
		// So <this> won't float to shootahejti
		var pType = parent.css('position');
		if ( pType != 'relative' && pType != 'absolute' ) {
		    parent.css('position', 'relative');
		}
		
		var pos = theOld.position();
		theOld.css({
			'position': 'absolute',
			'left': pos.left,
			'top': pos.top
		});
		
		theOld.fadeOut();
		
		self.css({
			'display': 'none'
		})[appendType](parent).fadeIn(function() {
			if ( typeof callback == 'function' )
				callback.call(self, theOld);
		});
		return this;
	}
});
