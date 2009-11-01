<?php
	function template($package, $template_handle, $params = null)
	{
		if ( is_array($params) )
		{
		    extract($params);
		}
		else
		{
		    foreach((array)$params as $key => $value)
		    {
			    if($key != 'template_handle')
			    {
				    $$key = $value;
			    }
		    }
		}
		
		ob_start();
		if($package == null)
		{
			Tools::Debug('<span style="color:red">Template ' . $template_handle . ' is not in a package. Move it there BIATCH.</span>');
			include(PATH_TEMPLATES . $template_handle);
		}
		else
		{
			if ( ! file_exists(PATH_PACKAGES . $package . '/templates/' . $template_handle) )
			{
			    die('no such template: ' . PATH_PACKAGES . $package . '/templates/' . $template_handle);
			}
			include(PATH_PACKAGES . $package . '/templates/' . $template_handle);
		}
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
?>
