<?php require_once dirname(__DIR__) . "/header.php"; ?>
	<h1>Sign Up</h1>
	<form action="/signup/create" method="POST">
		<div>
			<label for="input_name">Name:</label>
			<input type="text" id="input_name" name="name" placeholder="Name" autofocus />
		</div>
		<div>
			<label for="input_email">Email Address:</label>
			<input type="email" id="input_email" name="email" placeholder="name@company" />
		</div>
		<div>
			<label for="input_password">Password:</label>
			<input type="password" id="input_password" name="password" placeholder="Password" />
		</div>
		<div>
			<label for="input_confirm_password">Confirm Password:</label>
			<input type="password" id="input_confirm_password" name="confirm_password" placeholder="Repeat Password" />
		</div>
		<div>
			<button type="submit">Sign Up</button>
		</div>
	</form>
<?php require_once dirname(__DIR__) . "/footer.php"; ?>
