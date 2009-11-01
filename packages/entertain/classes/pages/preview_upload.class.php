<?php
	class PageEntertainPreviewUpload extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/entertain-admin/preview_upload') ? 10 : 0;
		}
		
		function execute($uri)
		{
			switch($_POST['action'])
			{
				case 'save':
					$out_medium = ENTERTAIN_PREVIEWS_PATH . 'items/' . escapeshellcmd($_POST['handle']) . '/medium.png';
					
					shell_exec('mkdir ' . ENTERTAIN_PREVIEWS_PATH . 'items/' . escapeshellcmd($_POST['handle']));
					
					$this->content .= Tools::preint_r($_POST);
					
					if($src_medium = imagecreatefromjpeg(PATH_WEBTEMP . '1-hour/' . $_POST['filename']))
					{
						$this->content .= 'imagecreatefromjpeg<br />';
					}
					if($tmp_medium = imagecreatetruecolor(307, 72))
					{
						$this->content .= 'imagecreatetruecolor<br />';
					}
					if(imagecopyresampled($tmp_medium, $src_medium, 0,0,$_POST['307x72_x1'],$_POST['307x72_y1'],307,72,$_POST['307x72_x2'],$_POST['307x72_y2']))
					{
						$this->content .= 'imagecopyresampled<br />';
					}
					$this->content .= $tmp_medium;
					$this->content .= $out_medium;
					if(imagejpeg($tmp_medium, $out_medium, 100))
					{
						$this->content .= 'imagejpeg<br />';
					}
					imagedestroy($tmp_medium);
					imagedestroy($src_medium);
					
					$out_full = ENTERTAIN_PREVIEWS_PATH . 'items/' . escapeshellcmd($_POST['handle']) . '/full.png';
					$src_full = imagecreatefromjpeg(PATH_WEBTEMP . '1-hour/' . $_POST['filename']);
					$tmp_full = imagecreatetruecolor(634, 150);
					imagecopyresampled($tmp_full, $src_full, 0,0,$_POST['307x72_x1'],$_POST['307x72_y1'],634,150,$_POST['307x72_x2'],$_POST['307x72_y2']);
					imagejpeg($tmp_full, $out_full,100);
					imagedestroy($tmp_full);
					imagedestroy($src_full);
					

					$this->content .= template('base', 'notifications/success.php');
					$this->content .= '<img src="http://static.hamsterpaj.net/images/entertain/items/' . escapeshellcmd($_POST['handle']) . '/medium.png" />';
					$this->content .= '<img src="http://static.hamsterpaj.net/images/entertain/items/' . escapeshellcmd($_POST['handle']) . '/full.png" />';
					$this->content .= '<script type="text/javascript">window.close();</script>';
					break;
				case 'scale':
					$filename = rand(0, 99999999) . '.jpg';
					
					switch($_POST['upload_action'])
					{
						case 'wget':
							$cmd = 'wget ' . escapeshellarg($_POST['url']) . ' -O ' . PATH_WEBTEMP . '1-hour/' . $filename;
							shell_exec($cmd);
							$cmd = 'convert ' . PATH_WEBTEMP . '1-hour/' . $filename . ' -resize "1024x1024>" ' . PATH_WEBTEMP . '1-hour/' . $filename;
						system($cmd);
						break;
						case 'upload':
							if(is_uploaded_file($_FILES['preview']['tmp_name']))
							{
								$cmd = 'convert ' . $_FILES['preview']['tmp_name'] . ' -resize "1024x1024>" ' . PATH_WEBTEMP . '1-hour/' . $filename;
								system($cmd);
							}
						break;
					}
					
					$this->content = template('entertain', 'admin/preview_upload_scale.php', array('filename' => $filename, 'handle' => $_POST['handle']));
					break;
				case 'upload':
				default:
					$this->content = template('entertain', 'admin/preview_upload_form.php', array('handle' => $_GET['handle']));
					break;
			}
			
			$this->template = 'layouts/amanda/layout_blank.php';
		}
	}
?>