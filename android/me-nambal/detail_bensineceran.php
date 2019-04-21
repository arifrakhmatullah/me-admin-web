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
	$url = "http://ridhoillahi.000webhostapp.com/android/me-nambal/images/bensineceran/";
	$id = $_POST['id_b'];
	$query = mysqli_query($con, "SELECT * FROM bensineceran WHERE id_b='".$id."'");
	while ($row = mysqli_fetch_array($query)){
		$char = '"';
		$string = $row['deskripsi_b'];
		$json = '{
				"id_b": "'.str_replace($char,'`',strip_tags($row['id_b'])).'", 
				"nama_b": "'.str_replace($char,'`',strip_tags($row['nama_b'])).'",
				"jenis_usaha_b": "'.str_replace($char,'`',strip_tags($row['jenis_usaha_b'])).'",
				"alamat_b": "'.str_replace($char,'`',strip_tags($row['alamat_b'])).'",
				"jam_operasional_b": "'.str_replace($char,'`',strip_tags($row['jam_operasional_b'])).'",
				"harga_b": "'.str_replace($char,'`',strip_tags($row['harga_b'])).'",
				"no_hp_b": "'.str_replace($char,'`',strip_tags($row['no_hp_b'])).'",
				"lat_b": "'.str_replace($char,'`',strip_tags($row['lat_b'])).'",
				"lng_b": "'.str_replace($char,'`',strip_tags($row['lng_b'])).'",
				"deskripsi_b": "'.str_replace($char,'`',$string).'",
				"gambar_b": "'.$url.$row['gambar_b'].'"}';
	}
	echo $json;
	mysqli_close($con);
?>