<?php

	class schedule extends hp4
	{
		protected $action;
		protected $slots;
		protected $data;
		
		function __construct($action)
		{
			global $_PDO;

			$this->action = $action;
			
			$query = 'SELECT * FROM schedule_slots WHERE action = :action ORDER BY day, slot_start';
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':action', $this->action);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($rows AS $row)
			{
				$this->slots[$row['day']][] = array('start' => $row['slot_start'], 'end' => $row['slot_end']);
			}
		}
		
		function next_slot($day, $slot_id, $day_offset = 0)
		{
			$slot_id++;
			if(!isset($this->slots[$day][$slot_id]))
			{
				$slot_id = 0;
				for($i = 0; $i <= 7; $i++)
				{
					$day = ($day == 6) ? 0 : $day += 1;
					$day_offset++;
					if(count($this->slots[$day]) > 0)
					{
						break;
					}
					if($i == 7)
					{
						tools::debug('FATAL: schedule::suggest() could not find a valid slot!');
						return false;							
					}
				}
			}

			return array('day' => $day, 'slot_id' => $slot_id, 'day_offset' => $day_offset);
		}
		
		function suggest()
		{
			global $_PDO;

			$day_offset = 0;
			$slot_id = -1;
			$day = date('N');
			$since_midnight = time() - strtotime(date('Y-m-d 00:00:00'));

			foreach($this->slots[$day] AS $key => $slot)
			{
				if($slot['end'] > $since_midnight)
				{
					$slot_id = $key;
				}
			}
			if($slot_id = -1)
			{
				tools::debug('No valid slot found today');
				$next = $this->next_slot($day, 0);
				$slot_id = $next['slot_id'];
				$day = $next['day'];
				$day_offset = $next['day_offset'];
			}
			
			
			# We have found the current slot, now iterate forward
			$query = 'SELECT COUNT(*) AS occupied FROM scheduled WHERE timestamp > :start AND timestamp < :end';
			$query .= ' AND action = :action';
			
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':action', $this->action);

			for($i = 0; $i < 500; $i++)
			{
				$start = strtotime('+' . $day_offset . ' days 00:00:00') + $this->slots[$day][$slot_id]['start'];
				$end = strtotime('+' . $day_offset . ' days 00:00:00') + $this->slots[$day][$slot_id]['end'];

				$stmt->bindValue(':start', $start);
				$stmt->bindValue(':end', $end);

				if(isset($this->slots[$day][$slot_id]))
				{
					$stmt->execute();
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if($rows[0]['occupied'] == 0)
					{
						return strtotime('+' . $day_offset . ' days 00:00:00') + rand($this->slots[$day][$slot_id]['start'], $this->slots[$day][$slot_id]['end']);
					}
				}
				
				$next = $this->next_slot($day, $slot_id, $day_offset);
				$slot_id = $next['slot_id'];
				$day = $next['day'];
				$day_offset = $next['day_offset'];
				tools::debug('Got slot #' . $slot_id . ', day #' . $day . ' (offset ' . $day_offset . ')');
			}
			tools::debug('Failed to find free slot, giving up after 500 tries');
		}
		
		function book($params)
		{
			global $_PDO;

			$params['timestamp'] = (!isset($params['timestamp'])) ? $this->suggest() : $params['timestamp'];

			$query = 'INSERT INTO scheduled (timestamp, action, data)';
			$query .= ' VALUES(:timestamp, :action, :data)';

			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':timestamp', $params['timestamp']);
			$stmt->bindValue(':action', $this->action);
			$stmt->bindValue(':data', serialize($this->data));
			
			$stmt->execute();
		}
		
		function release()
		{
			
		}
		
	}

?>