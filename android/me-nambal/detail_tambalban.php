<?php
	// include "koneksi.php";

	// $id = $_POST['id'];
	// $query = mysql_query("SELECT * FROM news WHERE id='".$id."'");
	// while ($row = mysql_fetch_array($query)){
	// 	$char ='"';
	// 	$tgl	= date("d M Y", strtotime($row['date']));
	// 	$string = $row['value'];
	// 	$json = '{
	// 			"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
	// 			"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
	// 			"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
	// 			"isi": "'.str_replace($char,'`', $string).'",
	// 			"gambar": "'.$row['images'].'"}';
	// }
	// echo $json;
	// mysql_close($connect);
    
	
	
	include_once "koneksi.php";
	$url = "http://ridhoillahi.000webhostapp.com/android/me-nambal/images/tambalban/";
	$id = $_POST['id'];
	$query = mysqli_query($con, "SELECT * FROM tambalban WHERE id='".$id."'");
	while ($row = mysqli_fetch_array($query)){
		$char = '"';
		$string = $row['deskripsi'];
		$json = '{
				"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
				"nama": "'.str_replace($char,'`',strip_tags($row['nama'])).'",
				"jenis_usaha": "'.str_replace($char,'`',strip_tags($row['jenis_usaha'])).'",
				"alamat": "'.str_replace($char,'`',strip_tags($row['alamat'])).'",
				"jam_operasional": "'.str_replace($char,'`',strip_tags($row['jam_operasional'])).'",
				"harga": "'.str_replace($char,'`',strip_tags($row['harga'])).'",
				"no_hp": "'.str_replace($char,'`',strip_tags($row['no_hp'])).'",
				"deskripsi": "'.str_replace($char,'`',$string).'",
				"lat": "'.str_replace($char,'`',strip_tags($row['lat'])).'",
				"lng": "'.str_replace($char,'`',strip_tags($row['lng'])).'",
				"gambar": "'.$url.$row['gambar'].'"}';
	}
	echo $json;
	mysqli_close($con);
?>