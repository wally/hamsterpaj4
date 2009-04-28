var alphabet_running = false;
var alphabet_time_started = 0;
var alphabet_finished = false;
var alphabet_next = 0;
var alphabet_chars = Array(65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87 ,88, 89, 90, 221, 222, 192);


$(document).ready(function() {
	if($('#alphabet_container').length > 0) {
		$('#alphabet_input').focus(function() {
			$('#alphabet_focus').hide();
			$('#alphabet_timer').fadeIn(250);
		});

		$('#alphabet_input').blur(function() {
			if(alphabet_finished == false)
			{
				$('#alphabet_focus').fadeIn(250);
				$('#alphabet_timer').hide();
			}
		});
		
		$('#alphabet_input').keydown(function(e) {
			var key = e.charCode || e.keyCode || 0;
			if(key == alphabet_chars[alphabet_next])
			{
				if(alphabet_next == 0)
				{
					var d = new Date();
					alphabet_time_started = d.getTime();
					alphabet_running = true;
					alphabet_timer();
				}
				if(alphabet_next == 28)
				{
					alphabet_running = false;
					alphabet_finished = true;
				}			
				alphabet_next++;
				return true;
			}
			return false;
		});
		
		$('#alphabet_reset').click(function() {
			debug('Clicked');
			alphabet_running = false;
			alphabet_time_started = 0;
			alphabet_time_ended = 0;
			alphabet_next = 0;
			alphabet_finished = false;
			$('#alphabet_timer_seconds').html('00.00');
			$('#alphabet_timer_kps').html('0');
			$('#alphabet_input').val('');
		});
	}
});

function alphabet_timer()
{
	if(alphabet_running == true)
	{
		var d = new Date();
		var elapsed = Math.round((d.getTime() - alphabet_time_started)/10) / 100;
		$('#alphabet_timer_seconds').html(elapsed);
		$('#alphabet_timer_kps').html(Math.round(($('#alphabet_input').val().length / elapsed) * 10) / 10);
		setTimeout(alphabet_timer, 10);
	}
}


