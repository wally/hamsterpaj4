<h1>Artiklar</h1>

<p>
	Dang, :o NKL ist kinky!
	<hr />
	<?php
		foreach ( $articles as $row ){
			echo '<h1>' . $row['title'] . '</h1>';
			echo ucfirst( $row['author'] ) . ', ' . $row['date'];
			echo '<h3>' . $row['summary'] . '</h3>';
			echo '<hr />';
		}
		
		echo '<pre>';
		
		print_r( $articles );
		
		echo '</pre>';
	?>
</p>