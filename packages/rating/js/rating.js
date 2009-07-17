$(document).ready(function(){
	// Post
	$('.star').click(function() 
	{
		var grade = $(this).attr('id').split('-')[1];
		
		$.ajax(
		{
			url: '/rating/skicka',
			type: 'GET',
			data: 'grade=' + grade,
			success: function(result)
			{
			}
		});
		return false;
	});
});