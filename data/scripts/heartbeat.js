function heartbeat()
{
	setTimeout(heartbeat, 10000);
}

$(document).ready(heartbeat);
