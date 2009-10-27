<?php
	class SideModuleForumThreads extends Module
	{
		public $template = 'forum_threads';
		public $id = 'forum_threads';
		
		function __construct()
		{
			$this->threads = Cache::load('latest_forum_threads');
		}
		
		function recurse_forum_category($categories, $depth)
		{
			$output = '';
			
			if ( ! is_array($categories) )
			{
			    return '';
			}
			
			foreach($categories AS $category)
			{
				if($category['handle'] == 'hamsterpajs_artiklar' || $category['handle'] == 'forum_error')
				{
					continue;
				}
				$indent = '';
				for($i = 0; $i < $depth; $i++)
				{
					$indent .= str_repeat('&nbsp;', 4);
				}
				$category['title'] = (strlen($category['title']) > 21) ? substr($category['title'], 0, 19) . '...' : $category['title'];
				$style = ($depth == 0) ? ' style="font-weight: bold;"' : '';
				$output .= '<option value="' . $category['handle'] . '"' . $style . '>' . $indent . $category['title'] . '</option>' . "\n";
	
				$output .= $this->recurse_forum_category(Tools::pick($category['children'], null), $depth+1);
			}				
			return $output;
		}
	}

?>