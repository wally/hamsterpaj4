<?php
	class event_log extends hp4
	{
		function log($event)
		{
			global $_PDO;
			$update = 'UPDATE event_log SET count = count + 1 WHERE date = :date AND event = :event AND hour = :hour LIMIT 1';
			$stmt = $_PDO->prepare($update);
			$stmt->bindValue(':date', date('Y-m-d')); 
			$stmt->bindValue(':event', $event);
			$stmt->bindValue(':hour', date('H'));
			$stmt->execute();
			if($stmt->rowCount() == 0)
			{
				$insert = 'INSERT INTO event_log (`date`, event, count, hour) VALUES(:date, :event, 1, :hour)';	
				$stmt = $_PDO->prepare($insert);
				$stmt->bindValue(':date', date('Y-m-d')); 
				$stmt->bindValue(':event', $event);
				$stmt->bindValue(':hour', date('H'));
				$stmt->execute();
			}
			
		}
	}
?>