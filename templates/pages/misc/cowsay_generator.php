<h1>Cowsay-generator</h1>
<?php
if (isset($cow))
{
	echo '<pre class="entertain_preformatted cowsay_preformatted">' . $cow->get('cow') . '</pre>';
}
?>
<!--

		private $eye_string; # -e
		private $tongue_string; # -T
		private $message_wrap; # -W default: 40;
		private $mode; # Valid modes are specified in this->modes.
		private $modes = array();
		private $cow;
		private $cows = array();
		private $message;
		
		'borg' => 'b',
		'dead' => 'd',
		'greedy' => 'g',
		'paranoid' => 'p',
		'stoned' => 's',
		'tired' => 't',
		'wired' => 'w',
		'youthful' => 'y'
	
		'apt', 
		'beavis.zen', 'bong', 'bud-frogs', 'bunny',
		'calvin', 'cheese', 'cock', 'cower',
		'daemon', 'default', 'dragon-and-cow', 'dragon', 'duck',
		'elephant', 'elephant-in-snake',
		'eyes',
		'flaming-sheep',
		'ghostbusters', 'gnu',
		'head-in', 'hellokitty',
		'kiss', 'kitty', 'koala', 'kosh',
		'luke-koala',
		'mech-and-cow', 'meow', 'milk', 'moofasa', 'moose', 'mutilated',
		'ren',
		'satanic', 'sheep', 'skeleton', 'small', 'sodomized', 'sodomized-sheep', 'stegosaurus', 'stimpy', 'supermilker', 'surgery', 'suse',
		'telebears', 'three-eyes', 'turkey', 'turtle', 'tux',
		'udder',
		'vader', 'vader-koala',
		'www',
		
-->
<form action="/cowsay" method="get" id="cowsay_form">
	<dl>
		<dt><label for="cowsay_message">Pratbubbla</label><dt>
		<dd><textarea name="message" id="cowsay_message"><?php
				if (!empty($_GET['message']))
				{
					echo $_GET['message'];
				}
			?></textarea><dd>
		<dt><label for="message_wrap">Meddelandebredd</label></dt>
		<dd><input type="text" name="message_wrap" id="cowsay_message_wrap"<?php echo !empty($_GET['message_wrap']) ? ' value="' . stripcslashes($_GET['message_wrap']) . '" ' : ' value="40" '; ?>/></dd>
		<dt><label for="eye_string">Ögon</label></dt>
		<dd><input type="text" name="eye_string" id="cowsay_eye_string"<?php echo !empty($_GET['eye_string']) ? ' value="' . stripcslashes($_GET['eye_string']) . '"' : NULL; ?>/></dd>
		<dt><label for="tongue_string">Tunga</label></dt>
		<dd><input type="text" name="tongue_string" id="cowsay_tongue_string"<?php echo !empty($_GET['tongue_string']) ? ' value="' . stripcslashes($_GET['tongue_string']) . '"' : NULL; ?>/></dd>
		<dt><label for="mode">Uttryck</label></dt>
		<dd>
		<?php 
			$mode_dropdown = new html_dropdown();
			$mode_dropdown->set_name('mode');
			$mode_dropdown->set_selected($_GET['mode']);
			$mode_dropdown->add_option(array('value' => 'nonsense', 'label' => 'Inget'));
			foreach ($GLOBALS['_COWSAY_MODE_ALIASES'] as $key => $value)
			{
				$mode_dropdown->add_option(array('value' => $key, 'label' => $value));
			}
			echo $mode_dropdown->render();
		?>
		</dd>
		<dt><label for="cow">Figur</label></dt>
		<dd>
		<?php 
			$cow_dropdown = new html_dropdown();
			$cow_dropdown->set_name('cow');
			$cow_dropdown->set_selected($_GET['cow']);
			$cow_dropdown->add_option(array('value' => 'nonsense', 'label' => 'Ingen (Standardko)'));
			foreach ($GLOBALS['_COWSAY_COW_ALIASES'] as $key => $value)
			{
				$cow_dropdown->add_option(array('value' => $key, 'label' => $value));
			}
			echo $cow_dropdown->render();
		?>
		</dd>
		<dd><input type="submit" id="cowsay_submit" value="MUUUU!" /></dd>
	</dl>
</form>