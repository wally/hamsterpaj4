<form action="/login/login.php?action=login" method="post" id="login">
	<span>
		<label>Användarnamn</label>
		<input id="ui_login_username" type="text" name="username" />
	</span>
	<span>
		<label>Lösenord</label>
		<input id="ui_login_password" type="password" name="password" />
	</span>
	<span class="buttons">
		<input class="ui_login_submit" type="submit" value="Logga in" />
		<a href="/register.php" onclick="document.location = this.getAttribute('href'); return false;"><input class="ui_login_submit" type="submit" value="Registrera" /></a>
	</span>
</form>

