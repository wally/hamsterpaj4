$(document).ready(function(){
	$('#bdb-download-form h2').click(function() 
	{
		$('#bdb-download-form h2 + form').hide('slow');
		var isVisible = $(this).next().is(':visible');
		if (isVisible == false)
		{
			$(this).next().slideToggle('slow');
		}
		
	});
	
	var ajax_url = $('#ajax_url').attr('value');
	debug(ajax_url);

	if(typeof(ajax_url) != 'undefined')
	{
		$.ajax(
		{
			url: ajax_url,
			success: function(result)
			{
				$('#ajax_loader').hide();
				$('#content').append(result);
			}
		});
	}
});