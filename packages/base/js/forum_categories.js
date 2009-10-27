hp.set('module.forum_threads', {
    init: function() {
	$(document).ready(function() {
	    $('#forum_thread_by_category').change(function() {
		window.location.href = "/diskussionsforum/" + $(this).val() + '/';
	    });
	});
    }
});

hp.module.forum_threads.init();