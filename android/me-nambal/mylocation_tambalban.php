<?php 
	include_once "koneksi.php";

	// perhitungan haversine formula pada sintak SQL
	$query = mysqli_query($con, "SELECT id, nama, lat, lng FROM tambalban ORDER BY nama ASC");
	$json = '{"tambalban": [';
	
?>