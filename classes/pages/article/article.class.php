<?php
	class PageArticle extends page
	{
		function url_hook($uri)
		{
			return ( $uri == '/artiklar' ) ? 10 : 0;
		}
		
		function execute()
		{
			global $_PDO;
			
			$qry  = 'SELECT id, title, summary, author, date, category_id FROM articles ';
			$qry .= 'WHERE ( published = 1 ) ';
			$qry .= 'ORDER BY date DESC LIMIT 4';
			
			$stmt = $_PDO->prepare($qry);
			$stmt->execute();
			
			$articles = $stmt->fetchAll();
			
			$this->content = template('pages/article/article.php', array( 'articles' => $articles ));
		}
	}
?>