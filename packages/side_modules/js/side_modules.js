hp.set('packages.side_modules', {
    init: function() {
	$(document).ready(function() {
	    try {
		hp.packages.side_modules.sorter = new hp.classes.Sorter('#modules .sortable_module', '#modules', {
		    handle: '.move',
		    container: '#modules',
		    ghostPrimer: function(ghost, ref) {
			ghost.addClass('module');
			ghost.css({
			    'width': ref.width(),
			    'height': ref.height()
			});
		    }
		});
	    } catch (e) {
		debug(e);
	    }
	});
    }
});

hp.packages.side_modules.init();