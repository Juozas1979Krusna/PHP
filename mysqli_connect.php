<?php
	DEFINE('DB_USER','root');
	DEFINE('DB_PASSWORD','');
	DEFINE('DB_HOST','localhost');
	DEFINE('DB_NAME','simpleIdb');
	$dbcon = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connet to MySQL: '. mysqli_connect_error());
	mysqli_set_charset($dbcon, 'utf8');
?>
