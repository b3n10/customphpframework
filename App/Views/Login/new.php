<?php require_once dirname(__DIR__) . "/header.php"; ?>
	<form action="/login/create" method="POST">
		<div>
			<label for="input_email">Email:</label>
			<input type="email" name="email" id="input_email" placeholder="name@company">
		</div>
		<div>
			<label for="input_password">Password:</label>
			<input type="password" name="password" id="input_password">
		</div>
		<div>
			<button type="submit">Log in</button>
		</div>
	</form>
<?php require_once dirname(__DIR__) . "/footer.php"; ?>
