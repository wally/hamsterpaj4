$(document).ready(function() {
	$('.livesearch .searchquery').bind('keyup', function() {
		var inputString = $(this).attr('value');
		
		parent = $(this).parent().attr('id');

		if(inputString.length == 0)
		{
			$('.livesearch .suggestions').fadeOut(); // Hide the suggestions box
		}
		else
		{
			do_search(inputString, 500)
		}
	});
});

function do_search(inputString, timeout)
{
	if(timeout == 0 && inputString == $('.livesearch .searchquery').attr('value'))
	{		
		$.post('/livesearch/ajax', {queryString: ""+inputString+""}, function(data) {
				$('#' + parent + ' .suggestions').fadeIn(); // Show the suggestions box
				$('#' + parent + ' .suggestions').html(data); // Fill the suggestions box
		});
	}
	else
	{
		setTimeout('do_search("' + inputString + '", ' + (timeout-500) + ')', 500);
	}
}