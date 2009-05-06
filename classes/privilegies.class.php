<?php
	class privilegies extends user
	{
		function auth($privilegie, $value = NULL)
		{
			$user = $this->user;
			
			if(isset($user->privilegies->igotgodmode))
			{
				return true;
			}
			
			if($value == NULL)
			{
				return isset($user->privilegies->$privilegie);
			}
			else
			{
				return (isset($user->privilegie->$privilegie->$value)  || $user->privilegie->$privilegie == 0);
			}
		}
		
		function load($userid)
		{
			global $_PDO;
			
    	$stmt = $_PDO->prepare('SELECT privilegie, value FROM privilegies WHERE user = :userid');
    	$stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    	$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
    	foreach($result as $row)
    	{
    		$data[$row['privilegie']] = $row['value'];
    	}
			return $data;
		}
	}
?>