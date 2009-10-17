<?php

	class PageDiggaClassification extends Page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 19) == '/digga/musikstilar/') ? 10 : 0;			
		}
			
		function execute($uri)
		{
			$this->menu_active = 'digga';
			global $_PDO;
			
			$handle = substr($uri, 19);
			$query = 'SELECT id, name, handle FROM digga_classifications WHERE handle LIKE "' . $handle . '" LIMIT 1';
			foreach($_PDO->query($query) AS $row)
			{
				
				$artists = Artist::fetch(array('limit' => 99999, 'order-by' => 'name', 'has_classification' => $row['id']), array('allow_multiple' => true));
				$this->content = template('digga', 'all_artists.php', array('artists' => $artists));
			}
		}	
	}	


	class PageDiggaAllArtists extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/digga/alla-artister') ? 10 : 0;			
		}

		function execute($uri)
		{
			$this->menu_active = 'digga';
			
			$artists = Artist::fetch(array('limit' => 99999, 'order-by' => 'name'), array('allow_multiple' => true));
			$this->content = template('digga', 'all_artists.php', array('artists' => $artists));
		}
	}

	class PageDiggaStart extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/digga') ? 10 : 0;
		}
		
		function execute()
		{
			$this->menu_active = 'digga';
			
			$passed = array();
			
			$passed['recent_artists'] = Artist::fetch(array('limit' => 8, 'order-by' => 'id', 'order-direction' => 'DESC'), array('allow_multiple' => true));

			$top_search['limit'] = 6;
			$top_search['order-by'] = 'fan_count';
			$top_search['order-direction'] = 'DESC';
			$passed['top_artists'] = Artist::fetch($top_search, array('allow_multiple' => true));
			$passed['user_idols'] = Artist::fetch(array('order-by' => 'name', 'order-direction' => 'ASC', 'has_fan' => $this->user), array('allow_multiple' => true));
			$passed['user'] = $this->user;
			
			foreach($passed['user_idols'] AS $idol)
			{
				foreach(Tools::ensure_array($idol->get('classifications')) AS $classification)
				{
					Tools::pick_inplace($music_taste[$classification['name']], 0);
					$music_taste[$classification['name']] += $classification['sum'] / $idol->get('fan_count');
				}
			}
			arsort($music_taste);
			$music_taste = array_slice($music_taste, 0, 8);
			
			$passed['music_taste_graph'] = '';
			foreach($music_taste AS $label => $value)
			{
				$passed['music_taste_graph'] .= '&' . urlencode($label) . '=' . urlencode($value);
			}
			
			$this->content = template('digga', 'start.php', $passed);
		}
	}
	
	
	class PageDiggaAdd extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/digga/ny-digga') ? 10 : 0;
		}
		
		function execute()
		{
			$this->menu_active = 'digga';
			
			if(!$this->user->exists())
			{
				$this->content = '<h1>Du måste vara inloggad!</h1>';
				return;
			}
			if($artist = Artist::fetch(array('name' => $_POST['artist'])))
			{
				if($artist->is_fan($this->user))
				{
					$this->content .= template('digga', 'already_fan.php');
				}
				else
				{
					$artist->add_fan($this->user);
					$this->content .= '<h1>Du diggar nu artisten</h1>';
					$this->content .= '<p>Hade Daniella haft ett routing-system så hade du kommit till artistens sida automatiskt nu.';
					$this->content .= '<a href="' . $artist->get('url') . '">Till artistens sida</a></p>' . "\n";
				}
			}
			elseif($_POST['create'] == 'true')
			{
				$artist = new Artist();
				$artist->set(array('name' => $_POST['artist']));
				$artist->save();
				$artist->add_fan($this->user);
				$this->content .= '<h1>Du diggar nu artisten</h1>';
				$this->content .= '<p>Hade Daniella haft ett routing-system så hade du kommit till artistens sida automatiskt nu.';
				$this->content .= '<a href="' . $artist->get('url') . '">Till artistens sida</a></p>' . "\n";
			}
			else
			{
				$this->content .= template('digga',  'add_notfound.php', array('name' => $_POST['artist']));
				if($artists = Artist::fetch(array('name_search' => $_POST['artist']), array('allow_multiple' => true)))
				{
					$this->content .= template('digga', 'related_matches.php', array('artists' => $artists));
				}
				$this->content .= template('digga', 'dig_form.php', array('create' => true, 'artist' => $_POST['artist']));
			}
		}
	}
	
	class PageDiggaGraph extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/digga/graph') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'digga';
			
			include(PATH_ROOT . 'external/pchart/pChart/pData.class');
			include(PATH_ROOT . 'external/pchart/pChart/pChart.class');
			
			foreach($_GET AS $key => $value)
			{
				if(is_numeric($value))
				{
					$data[] = $value;
					$titles[] = $key;
				}
			}
			
			// Dataset definition   
			$DataSet = new pData;
			$DataSet->AddPoint($titles,"Label");  
			$DataSet->AddPoint($data);
			$DataSet->AddSerie("Serie1");
			$DataSet->SetAbsciseLabelSerie("Label");  
			 			 
			// Initialise the graph  
			$Test = new pChart(400,400);
			$Test->setFontProperties('/storage/www/jhdev.hamsterpaj.net/external/pchart/Fonts/tahoma.ttf',8);  
			$Test->setGraphArea(25,0,400,350);
			 
			// Draw the radar graph  
			$Test->drawRadarAxis($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE, 10, 100, 100, 100, 150, 150, 	50, 1);
			$Test->drawFilledRadar($DataSet->GetData(),$DataSet->GetDataDescription(),50,20);
			 
			// Finish the graph  
			$Test->setFontProperties('/storage/www/jhdev.hamsterpaj.net/external/pchart/Fonts/tahoma.ttf',10);
			$Test->Stroke();
			$this->raw_output = true;
		}
	}
	
	class PageDiggaArtist extends Page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 14) == '/digga/artist/') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'digga';
			
			global $_PDO;
			if($artist = Artist::fetch(array('handle' => substr($uri, 14))))
			{
				if(isset($_POST['action']) && $_POST['action'] == 'classify' && $this->user->exists())
				{
					// Fetch all old classifications, remove those and decrease the sums in artist classifications
					// Insert new classifications and increase the sums
					Tools::debug('Got form submission');
					Tools::debug($_POST);
					
					$query = 'SELECT * FROM digga_user_classifications WHERE user = "' . $this->user->get('id') . '" AND artist = "' . $artist->get('id') . '"';
					foreach($_PDO->query($query) AS $row)
					{
						$update = 'UPDATE digga_artist_classifications SET sum = sum - "' . $row['value'] . '", votes = votes - 1, average = sum / votes';
						$update .= ' WHERE artist = "' . $row['artist'] . '" AND classification = "' . $row['classification'] . '"';
						$_PDO->query($update);
					}
					$query = 'DELETE FROM digga_user_classifications WHERE user = "' . $this->user->get('id') . '" AND artist = "' . $artist->get('id') . '"';
					$_PDO->query($query);
					
					$used = array();
					for($i = 0; $i < 5; $i++)
					{
						if($_POST['classification_' . $i] > 0 && !in_array($_POST['classification_' . $i], $used))
						{
							$_POST['value_' . $i] = ($_POST['value_' . $i] < 0) ? 0 : $_POST['value_' . $i];
							$_POST['value_' . $i] = ($_POST['value_' . $i] > 5) ? 5 : $_POST['value_' . $i];
							
							$used[] = $_POST['classification_' . $i];
							
							$query = 'INSERT INTO digga_user_classifications (user, artist, classification, value)';
							$query .= ' VALUES("' . $this->user->get('id') . '", "' . $artist->get('id') . '", "' . $_POST['classification_' . $i] . '", "' . $_POST['value_' . $i] . '")';
							$_PDO->query($query);

							$insert = 'INSERT INTO digga_artist_classifications (artist, classification, sum, votes)';
							$insert .= ' VALUES("' . $artist->get('id') . '", "' . $_POST['classification_' . $i] . '", "' . $_POST['value_' . $i] . '", 1, "' . $_POST['value_' . $i] . '")';

							$update = 'UPDATE digga_artist_classifications SET sum = sum + "' . $_POST['value_' . $i] . '", votes = votes + 1, average = sum / votes';
							$update .= ' WHERE artist = "' .  $artist->get('id') . '" AND classification = "' . $_POST['classification_' . $i] . '" LIMIT 1';

							if(!$_PDO->query($insert))
							{
								$_PDO->query($update);
							}
						}
					}
				}

				$fans = array();
				
				$query = 'SELECT l.id, l.username, u.image, u.gender, u.birthday FROM digga_fans AS df, login AS l, userinfo AS u';
				$query .= ' WHERE df.artist = "' . $artist->get('id') . '" AND l.id = df.user AND u.userid = l.id';
				$query .= ' ORDER BY l.lastaction DESC LIMIT 6';
				
				foreach($_PDO->query($query) AS $u)
				{
					$fan = new User();
					$fan->set(array('username' => $u['username'], 'id' => $u['id'], 'image' => $u['image'], 'gender' => $u['gender'], 'birthday' => $u['birthday']));
					
					$fans[] = $fan;
				}
				
				$user_classifications = ($this->user->exists()) ? $artist->user_classifications($this->user) : array();
				$this->content = template('digga', 'artist.php', array('artist' => $artist, 'user' => $this->user, 'fans' => $fans, 'user_classifications' => $user_classifications));
			}
			else
			{
				Tools::debug('Artist not found');
			}
		}
	}
	
	class Artist extends HP4
	{
		protected $url, $name, $handle, $classifications;
		protected $group = array();
		
		function is_fan($user)
		{
			global $_PDO;
			$query = 'SELECT user FROM digga_fans WHERE artist = "' . $this->id . '" AND user = "' . $user->get('id') . '" LIMIT 1';
			Tools::debug($query);
			foreach($_PDO->query($query) AS $row)
			{
				return true;
			}
			return false;
		}
		
		function fetch($search, $params = array())
		{
			global $_PDO;

			$search['limit'] = (isset($search['limit']) && is_numeric($search['limit'])) ? $search['limit'] : 30;

			if(array_key_exists('id', $search))
			{
				$search['id'] = (is_array($search['id'])) ? $search['id'] : array($search['id']);
			}
			if(array_key_exists('name', $search))
			{
				$search['name'] = (is_array($search['name'])) ? $search['name'] : array($search['name']);
			}
			if(array_key_exists('handle', $search))
			{
				$search['handle'] = (is_array($search['handle'])) ? $search['handle'] : array($search['handle']);
			}
			
			Tools::pick_inplace($params['allow_multiple'], false);
			
			$artists = array();
			$query = 'SELECT da.id, da.name, da.handle, da.fan_count, da.group_id';
			$query .= ' FROM digga_artists AS da';
			$query .= (isset($search['has_fan'])) ? ', digga_fans AS df' : '';
			$query .= (isset($search['has_classification'])) ? ', digga_artist_classifications AS dac' : '';
			$query .= ' WHERE 1';
			
			$query .= (isset($search['id']) && is_array($search['id'])) ? ' AND da.id IN ("' . implode('", "', $search['id']) . '")' : null;
			$query .= (isset($search['name']) && is_array($search['name'])) ? ' AND da.name IN ("' . implode('", "', $search['name']) . '")' : null;
			$query .= (isset($search['handle']) && is_array($search['handle'])) ? ' AND da.handle IN ("' . implode('", "', $search['handle']) . '")' : null;
			$query .= (isset($search['has_fan'])) ? ' AND df.user = "' . $search['has_fan']->get('id') . '" AND df.artist = da.id' : '';
			$query .= (isset($search['has_classification'])) ? ' AND dac.classification = "' . $search['has_classification'] . '" AND dac.artist = da.id' : '';
			
			$query .= (isset($search['order-by'])) ? ' ORDER BY `' . $search['order-by'] . '`' : null;		
			$query .= (isset($search['order-by']) && isset($search['order-direction'])) ? ' ' . $search['order-direction'] : null;
			$query .= ' LIMIT ' . $search['limit'];
			
			foreach($_PDO->query($query) AS $row)
			{
				$artist = new Artist();
				$artist->set(array('id' => $row['id']));
				$artist->set(array('name' => $row['name']));
				$artist->set(array('handle' => $row['handle']));
				$artist->set(array('fan_count' => $row['fan_count']));
				$artist->set(array('group_id' => $row['group_id']));
				
				if($params['allow_multiple'] == true)
				{
					$artists[] = $artist;
				}
				else
				{
					return $artist;
				}
			}

			return $artists;
		}
		
		function set_name($name)
		{
			$this->name = $name;
			$this->handle = Tools::handle($name);
		}
		
		function get_url()
		{
			return '/digga/artist/' . $this->handle;
		}
		
		function graph_url()
		{
			$this->get('classifications');
			if(count($this->classifications) > 0)
			{
				$url .= '/digga/graph?nonsense';
				foreach($this->classifications AS $class)
				{
					$url .= '&' . urlencode($class['name']) . '=' . $class['sum'];
				}
				return $url;
			}
			else
			{
				return false;
			}
		}
				
		function save()
		{
			global $_PDO;
			if($this->id > 0)
			{
				$query = 'UPDATE digga_artists SET name = "' . $this->name . '", handle = "' . $this->handle . '"';
				$query .= ', fan_count = "' . $this->fan_count . '" WHERE id = "' . $this->id . '"';
				$_PDO->query($query);
			}
			else
			{
				$query = 'INSERT INTO digga_artists(name, handle) VALUES("' . $this->name . '", "' . $this->handle . '")';
				if($_PDO->query($query))
				{
					$this->id = $_PDO->lastInsertId();
				}
				else
				{
					Tools::debug('Could not create artist!');
				}
			}
		}
		
		function add_fan($user, $options = array())
		{
			global $_PDO;
			$query = 'INSERT INTO digga_fans(artist, user) VALUES("' . $this->id . '", "' . $user->id . '")';
			$_PDO->query($query);
			$this->fan_count++;
			$this->save();
			
			if($option['disable_group_join'] !== true)
			{
				$this->get('group')->join($user);
			}
		}
		
		function user_classifications($user)
		{
			if($user->exists())
			{
				global $_PDO;
				$query = 'SELECT dc.name, duc.classification, duc.value';
				$query .= ' FROM digga_classifications AS dc, digga_user_classifications AS duc';
				$query .= ' WHERE dc.id = duc.classification';
				$query .= ' AND duc.artist = "' . $this->get('id') . '"';
				$query .= ' AND duc.user = "' . $user->get('id') . '"';
				$classifications = array();	
				foreach($_PDO->query($query) AS $row)
				{
					$classifications[$row['classification']] = array('id' => $row['classification'], 'name' => $row['name'], 'value' => $row['value']);
				}
				return $classifications;
			}
		}	
		
		function get_classifications()
		{
			if(count($this->classifications) < 1 || true)
			{
				global $_PDO;
				$query = 'SELECT dc.name, dc.handle, dac.average, dac.classification, dac.sum';
				$query .= ' FROM digga_classifications AS dc, digga_artist_classifications AS dac';
				$query .= ' WHERE dc.id = dac.classification';
				$query .= ' AND dac.artist = "' . $this->get('id') . '"';
				$query .= ' ORDER BY dac.average DESC LIMIT 8';
				foreach($_PDO->query($query) AS $row)
				{
					$this->classifications[$row['classification']] = array('name' => $row['name'], 'sum' => $row['sum'], 'handle' => $row['handle'], 'average' => $row['average']);
				}
			}
			return $this->classifications;
		}
		
		function all_classifications()
		{
			global $_PDO;
			$query = 'SELECT * FROM digga_classifications ORDER BY name ASC';
			foreach($_PDO->query($query) AS $row)
			{
				$classifications[$row['id']] = $row['name'];
			}
			return $classifications;
		}
		
		
		function get_group()
		{
			global $_PDO;
			if(is_object($this->group) && $this->group->exists())
			{
				return $this->group;
			}
			elseif($this->group_id > 0)
			{
				$this->group = Group::fetch(array('id' => $this->group_id));
				return $this->group;
			}
			else
			{
				$name = $this->name;
				$query = 'SELECT groupid FROM groups_list WHERE name LIKE "' . $name . '" LIMIT 1';
				$i = 0;
				foreach($_PDO->query($query) AS $row)
				{
					$i++;
					$name = $this->get('name') . ' ' . $i;
					$query = 'SELECT groupid FROM groups_list WHERE name LIKE "' . $name . '" LIMIT 1';
				}
	
				$query = 'INSERT INTO groups_list(owner, take_new_members, name, description, presentation, not_member_read_presentation, not_member_read_messages)';
				$query .= ' VALUES(3, 1, "' . $name . '", "En Digga-grupp för musikgruppen/artisten ' . $name . '", "En Digga-grupp för musikgruppen/artisten ' . $name . '", 1, 1)';
				
				if($_PDO->query($query))
				{
					echo $_PDO->lastInsertId();
					$this->group = Group::fetch(array('id' => $_PDO->lastInsertId()));
					$query = 'UPDATE digga_artists SET group_id = "' . $this->group->get('id') . '" WHERE id = "' . $this->id . '" LIMIT 1';
					$_PDO->query($query);
					return $this->group;
				}	
			}
		}
	}
	
	class PageDiggaExternalBattle extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/digga/external/battle') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$artists = Artist::fetch(array('handle' => $_GET['artists']), array('allow_multiple' => true));
			
			$this->content = template('digga', 'artist_battle.php', array('artists' => $artists));
			$this->content .= '<style type="text/css">@import url("/css/misc/digga.css");</style>';
			
			$this->content = str_replace('<a href=', '<a target="_top" href=', $this->content);
			
			$this->raw_output = true;
		}
	}
?>