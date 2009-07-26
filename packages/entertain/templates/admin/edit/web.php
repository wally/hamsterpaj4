<h3>Datatyp: Web</h3>
<label for="url">Webbadressen till länken</label>
<input type="text" name="url" value="<?php echo (isset($data['url']) ? $data['url'] : 'http://'); ?>" />
<br />
<label for="link">Länkens namn ("Dagens Nyheter" istället för "http://www.dn.se")</label>
<input type="text" name="link" value="<?php echo (isset($data['link']) ? $data['link'] : ''); ?>" />