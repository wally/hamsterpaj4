<h2>Datatyp: Text</h2>
<label>Text</label>
<textarea name="text" class="textarea_full"><?php $data = $item->get('data'); echo $data['text']; ?></textarea>
<input type="checkbox" name="allow_html" /><label>Tillåt HTML</label>