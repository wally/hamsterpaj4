<?php
class page_cellphone_lookup extends page
{
	function url_hook($uri)
	{
		return preg_match('#^/mobilnummer(/)?(.*?)?$#', $uri) ? 10 : 0;
	}
	
	function execute($uri) 
	{
		$this->menu_active = 'mobilnummer';
		global $_CELLPHONE_LOOKUP_OPERATOR_ALIASES, $_CELLPHONE_LOOKUP_OPERATOR_ALIASES_SHORT;
		
		$uri_explode = explode('/', $uri);
		
		$data = array();
		
		if ( count($uri_explode) >= 3 )
		{
		    $uri_explode[2] = str_replace(array('-', ' '), NULL, $uri_explode[2]);
		    
		    if (preg_match('#^(46|0046|\+46)?07(0|3|6)([0-9]{7})$#', $uri_explode[2], $matches))
		    {
			    $phone_number['country_code'] = $matches[1];
			    $phone_number['offset_3'] = $matches[2];
			    $phone_number['offset_4'] = $matches[3];
			    $phone_number_formatted = '467' . $phone_number['offset_3'] . $phone_number['offset_4'];
			    $data['phone_number_readable'] = '07' . $phone_number['offset_3'] . $phone_number['offset_4'];
			    
			    $phone_number_cache = cache::load('cellphone_lookup_numbers');
			    $data_cached = tools::pick($phone_number_cache[$phone_number_formatted], false);
			    
			    if (! $data_cached || $data_cached['timestamp'] < time() - 60 * 60 * 24 * 7)
			    {
				    tools::debug('Laddade inte från cache');
				    $data['raw'] = utf8_encode(exec('/home/joar/mob.sh ' . escapeshellarg($phone_number_formatted)));
				    $data['raw'] = str_replace(array('å', 'ä', 'ö'), NULL, $data['raw']);
				    preg_match('#\sr\s(.*?)\s\[#', $data['raw'], $matches);
				    $data['operator'] = $matches[1];
				    
				    $data['operator_alias'] = $_CELLPHONE_LOOKUP_OPERATOR_ALIASES[$data['operator']] == NULL ? $data['operator'] : $_CELLPHONE_LOOKUP_OPERATOR_ALIASES[trim($data['operator'])];
				    $data['operator_short'] = $_CELLPHONE_LOOKUP_OPERATOR_ALIASES_SHORT[$data['operator']] == NULL ? NULL : $_CELLPHONE_LOOKUP_OPERATOR_ALIASES_SHORT[$data['operator']];
				    $phone_number_cache[$phone_number_formatted] = $data;
				    cache::save('cellphone_lookup_numbers', $phone_number_cache);
			    }
			    else
			    {
				    tools::debug('Laddade från cache');
				    
				    $data = $data_cached;
			    }
		    }
		}
		
		$this->content = template('cellphone_lookup', 'pages/cellphone_lookup.php', array('data' => $data));
	}
}
?>