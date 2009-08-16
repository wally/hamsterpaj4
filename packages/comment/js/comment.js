$(document).ready(function(){
	// Document is loaded, allow some return false javascripts
	$('.comment_form .submit').removeAttr('disabled', 'disabled');
	$('.comment_list .remove').css('display', 'inline');
	
	// Empty input field
	$('.comment_form .text').click(function() 
	{
		var pointer = $(this).parent().attr('id').split('&')[1];
		debug(pointer);
		$('#comment_form\\&' + pointer + ' .text').attr("value", "");
	});
	
	// Post
	$('.comment_form .submit').click(function() 
	{
		var pointer = $(this).parent().attr('id').split('&')[1];
		var item_id = pointer.split('-')[0];
		var type = pointer.split('-')[1];
		var text = $('#comment_form\\&' + pointer + ' .text').val();
		
		if(text == 'Din kommentar här...' || jQuery.trim(text).length < 2)
		{
			$('#comment_form\\&' + pointer + ' .error').css("display", "none");
			$('#comment_form\\&' + pointer + ' .error').text('Du kanske vill skriva in något innan du postar?');
			$('#comment_form\\&' + pointer + ' .error').fadeIn(500);
			return false;
		}
		
		comment_timeout(pointer, 5000);
		
		$.ajax(
		{
			url: '/kommentar/skicka',
			type: 'POST',
			data: 'text=' + text + '&item_id=' + item_id + '&type=' + type,
			success: function(result)
			{
				$('#comment_form\\&' + pointer + ' .error').css("display", "none");
				$('#comment_list\\&' + pointer + '').append(result);
				$('#comment_form\\&' + pointer + ' .text').attr("value", "Din kommentar här...");
			}
		});
		return false;
	});
	
	// Remove comment
	$('.comment_list .remove').click(function() 
	{
		var element_id = $(this).parent().parent().attr('id');
		var type = element_id.split('-')[0];
		var item_id = element_id.split('-')[1];
		var id = element_id.split('-')[2];
		
		$.ajax(
		{
			url: '/kommentar/radera',
			type: 'GET',
			data: 'item_id=' + item_id + '&type=' + type + '&id=' + id,
			success: function(result)
			{
				$('.comment_list #' + element_id).fadeOut(300);
			}
		});
		return false;
	});
});

// Comment_timeout - Spam protection
function comment_timeout(pointer, timeout)
{
	if(timeout == 0)
	{		
		$('#comment_form\\&' + pointer + ' .submit').removeAttr('disabled', 'disabled');
		$('#comment_form\\&' + pointer + ' .submit').val('Kommentera');
	}
	else
	{
		$('#comment_form\\&' + pointer + ' .submit').attr('disabled', 'disabled');		
		setTimeout('comment_timeout("' + pointer + '", ' + (timeout-1000) + ')', 1000);
		$('#comment_form\\&' + pointer + ' .submit').val(timeout/1000);
	}
}