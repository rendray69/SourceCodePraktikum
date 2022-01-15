<?php
	include("config.php");

	$reset_quote = "UPDATE condi SET login_quotes = '0'";
	mysqli_query($con, $reset_quote);

	$reset_tracker = "UPDATE tracker SET tracker_check = '0'";
	mysqli_query($con, $reset_tracker);

?>