function heartbeat()
{
	debug('This is heartbeat');
	setTimeout(heartbeat, 10000);
}

$(document).ready(heartbeat);
