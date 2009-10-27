hp.set('packages.status', {
    init: function() {
	$(document).ready(function() {
	    hp.packages.status.init_status($('#ui_statusbar_forumstatus'));
	});
    },
    
    init_status: function(element) {
	this.span = element.find('span');
	element.click(function() {
	    var span = hp.packages.status.span.hide();
	    
	    if ( ! element.find('input').length ) {
		var input = $('<input type="text" />')
		    .css('width', 140)
		    .attr('value', span.attr('title'))
		    .appendTo(element)
		    .focus();
		
		input.keydown(function(e) {
		    if ( e.keyCode == 13 ) {
			hp.packages.status.save();
		    }
		});
		
		hp.packages.status.input = input;
		
		$(document).bind('click.statusbar', function(e) {
		    var target = $(e.target);
		    if ( ! target.parents('#ui_statusbar_forumstatus').length ) {
			$(document).unbind('click.statusbar');
			hp.packages.status.save();
		    }
		});
	    }
	});
    },
    
    save: function() {
	var value = this.input.val();
	$.get('/forumstatus/' + value);
	hp.packages.status.span.show().text(value.substring(0, 19) + '...');
	this.input.remove();
    }
});

hp.packages.status.init();