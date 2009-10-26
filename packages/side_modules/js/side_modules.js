hp.set('packages.side_modules', {
    init: function() {
	$(document).ready(function() {
	    try {
		hp.packages.side_modules.sorter = new hp.classes.Sorter('#modules .module', '#modules', {
		    
		});
	    } catch (e) {
		debug(e);
	    }
	});
    }
});

hp.packages.side_modules.init();