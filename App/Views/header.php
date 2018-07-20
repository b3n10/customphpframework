<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
<?php require_once dirname(__DIR__) . "/Views/nav.php"; ?>
<?php echo '<div class="notification">'; ?>
<?php echo $notification ?? ''; ?>
<?php echo '</div>'; ?>
