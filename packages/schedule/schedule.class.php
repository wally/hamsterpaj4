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
		
		function suggest()
		{
			# This function is seldomly called, so we can safely iterate forward in order
			# to find the next free slot
			
			$day = date('w');
			foreach($this->slots[$day] AS $key => $slot)
			{
				
			}
			
			tools::debug($this);
			
			return time() + 5000;
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