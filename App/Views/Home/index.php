<?php require_once dirname(__DIR__) . "/header.php"; ?>
	<h1>
		Welcome
	</h1>
	<?php if (isset($_SESSION['user_id'])): ?>
		<p>User ID <?php echo $_SESSION['user_id']; ?> is logged in.</p>
		<a href="/logout">Log out</a>
	<?php else: ?>
		<a href="/signup/new">Sign up</a> or <a href="/login/">log in</a>
	<?php endif ?>
<?php require_once dirname(__DIR__) . "/footer.php"; ?>
