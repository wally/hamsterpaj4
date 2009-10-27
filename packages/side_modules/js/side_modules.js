hp.set('packages.side_modules', {
    sortables: '#modules .sortable_module',
    sortHandle: '.move',
    sortContainer: '#modules',
    
    init: function() {
	var self = this;
	
	$(document).ready(function() {
	    self.elements = $(self.sortables);
	    
	    hp.packages.side_modules.sorter = new hp.classes.Sorter(self.sortables, self.sortContainer, {
		handle: self.sortHandle,
		container: self.sortContainer,
		
		ghostPrimer: function(ghost, ref) {
		    ghost.addClass('module');
		    ghost.css({
			'width': ref.width(),
			'height': ref.height()
		    });
		},
		
		onRelease: function() {
		    hp.packages.side_modules.save();
		}
	    });
	    
	    $('.module .minimize').click(function() {
		hp.packages.side_modules.minimize($(this).parents('.module'));
		return false;
	    });
	});
    },
    
    minimize: function(module) {
	$(module).toggleClass('minimized');
	this.saveState($(module).attr('id').replace('side_module_', ''), $(module).hasClass('minimized') ? 'close' : 'open');
    },
    
    saveState: function(module, state) {
	$.get('/sidmodul/minimera/' + module + '/' + state);
    },
    
    save: function() {
	var order = this.serialize();
	$.get('/sidmodul/sortera/' + order);
    },
    
    serialize: function() {
	var result = '';
	$(this.sortables).each(function() {
	    result += $(this).attr('id') + '|';
	});
	return result.substr(0, result.length - 1);
    }
});

hp.packages.side_modules.init();