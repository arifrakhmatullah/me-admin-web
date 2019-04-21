<?php
	include_once "koneksi.php";
	
	class emp{}
	
	$image = $_POST['gambar'];
	$name = $_POST['nama'];
	$jenis_usaha = $_POST['jenis_usaha'];
	$alamat = $_POST['alamat'];
	$jam_operasional = $_POST['jam_operasional'];
	$harga = $_POST['harga'];
	$no_hp = $_POST['no_hp'];
	$deskripsi = $_POST['deskripsi'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	
	$image_b = $_POST['gambar_b'];
	$name_b = $_POST['nama_b'];
	$jenis_usaha_b = $_POST['jenis_usaha_b'];
	$alamat_b = $_POST['alamat_b'];
	$jam_operasional_b = $_POST['jam_operasional_b'];
	$harga_b = $_POST['harga_b'];
	$no_hp_b = $_POST['no_hp_b'];
	$deskripsi_b = $_POST['deskripsi_b'];
	$lat_b = $_POST['lat_b'];
	$lng_b = $_POST['lng_b'];
	
	if (empty($name)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Please dont empty Name."; 
		die(json_encode($response));
	} else {
		$random = random_word(20);
		
		if($jenis_usaha=="Tambal Ban"){
		$path = "images/tambalban/".$random.".png";
		
		// sesuiakan ip address laptop/pc atau URL server
		$actualpath = $random.".png";
		
		$query = mysqli_query($con, "INSERT INTO tambalban (id,nama,jenis_usaha,alamat,jam_operasional,harga,no_hp,deskripsi,lat,lng,gambar) VALUES (null,'$name','$jenis_usaha','$alamat','$jam_operasional','$harga','$no_hp','$deskripsi','$lat','$lng','$actualpath')");
		} else{
			$path = "images/bensineceran/".$random.".png";
			// sesuiakan ip address laptop/pc atau URL server
		$actualpath = $random.".png";
		$query = mysqli_query($con, "INSERT INTO bensineceran (id_b,nama_b,jenis_usaha_b,alamat_b,jam_operasional_b,harga_b,no_hp_b,deskripsi_b,lat_b,lng_b,gambar_b) VALUES (null,'$name_b','$jenis_usaha_b','$alamat_b','$jam_operasional_b','$harga_b','$no_hp_b','$deskripsi_b','$lat_b','$lng_b','$actualpath')");
		}
		if ($query){
			file_put_contents($path,base64_decode($image));
			
			$response = new emp();
			$response->success = 1;
			$response->message = "Successfully Uploaded";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error Upload image";
			die(json_encode($response)); 
		}
	}	
	
	// fungsi random string pada gambar untuk menghindari nama file yang sama
	function random_word($id = 20){
		$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
		
		$word = '';
		for ($i = 0; $i < $id; $i++){
			$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $word; 
	}

	mysqli_close($con);
	
?>	