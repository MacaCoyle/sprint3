<?php
	include_once("loader.php");

	$auth->logout();

	header("Location: index.php");
	exit;
	
?>