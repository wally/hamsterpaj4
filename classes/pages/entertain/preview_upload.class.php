<?php

	class page_entertain_preview_upload extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/entertain/preview_upload') ? 10 : 0;
		}
		
		function execute($uri)
		{
			switch($_POST['action'])
			{
				case 'save':
					$in = PATH_WEBTEMP . '1-hour/' . escapeshellcmd($_POST['filename']);
					$width = escapeshellcmd($_POST['307x72_x2'] - $_POST['307x72_x1']);
					$height = escapeshellcmd($_POST['307x72_y2'] - $_POST['307x72_y1']);
					$x = escapeshellcmd($_POST['307x72_x1']);
					$y = escapeshellcmd($_POST['307x72_y1']);
					$format = '307x72';
					mkdir(ENTERTAIN_PREVIEWS_PATH . 'items/' . $_POST['handle']);
					$out = ENTERTAIN_PREVIEWS_PATH . 'items/' . $_POST['handle'] . '/medium.png';
					$cmd = 'convert ' . $in . ' -crop ' . $width . 'x' . $height . '+' . $x . '+' . $y . ' -scale ' . $format . '! ' . $out;
					
					system($cmd);
					$this->content .= template('framework/notifications/success.php');
					$this->content .= '<img src="http://static.hamsterpaj.net/images/entertain/items/' . $_POST['handle'] . '/medium.png" />';
					break;
				case 'scale':
					$filename = rand(0, 99999999) . '.jpg';
					$cmd = 'convert ' . $_FILES['preview']['tmp_name'] . ' -resize "1024x1024>" ' . PATH_WEBTEMP . '1-hour/' . $filename;
					system($cmd);
					
					$this->content = template('entertain/admin/preview_upload_scale.php', array('filename' => $filename, 'handle' => $_POST['handle']));
					break;
				case 'upload':
				default:
					$this->content = template('entertain/admin/preview_upload_form.php', array('handle' => $_GET['handle']));
					break;
			}
			
			$this->template = 'layouts/amanda/layout_blank.php';
			$this->content .= 'Daft punk!';
		}
	}

?>