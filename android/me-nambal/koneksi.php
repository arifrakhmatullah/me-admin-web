<?php
	
	$server		= "localhost";
	$user		= "id7059939_menambal";
	$password	= "arif091710";
	$database	= "id7059939_menambal";
	
	$con = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Gagal terhubung MySQL: " . mysqli_connect_error();
	}
	
?>