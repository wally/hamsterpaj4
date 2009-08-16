$(document).ready(function() {
	$('.livesearch').bind('keyup', function() {
		var inputString = $(this).attr('value');

		if(inputString.length == 0)
		{
			$('#livesearch_suggestions').fadeOut(); // Hide the suggestions box
		}
		else
		{
			$.post('/livesearch/ajax', {queryString: ""+inputString+""}, function(data) {
				$('#livesearch_suggestions').fadeIn(); // Show the suggestions box
				$('#livesearch_suggestions').html(data); // Fill the suggestions box
			});
		}
	});
});