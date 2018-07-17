<?php require_once dirname(__DIR__) . "/header.php"; ?>
	<h1>
		Welcome, <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']->name) : ''; ?>
	</h1>
	<a href="/signup/new">Sign up</a> or <a href="/login/">log in</a>
<?php require_once dirname(__DIR__) . "/footer.php"; ?>
