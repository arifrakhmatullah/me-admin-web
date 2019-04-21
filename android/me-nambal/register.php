<?php
	include_once "koneksi.php";
	
	class emp{}
	
	 $image = $_POST['foto_profil'];
	 $nik			   = $_POST["nik"];
	 $no_kk			   = $_POST["no_kk"];
	 $nama	   		   = $_POST["nama"];
	 $tempat_lahir	   = $_POST["nama"];
	 $tanggal_lahir	   = $_POST["nama"];
	 $jenis_kelamin	   = $_POST["nama"];
	 $alamat	  	   = $_POST["alamat"];
	 $username 		   = $_POST["username"];
	 $password 		   = $_POST["password"];
	 $confirm_password = $_POST["confirm_password"];
	 $email = $_POST["email"];
	 $no_hp = $_POST["no_hp"];
	 $kota = $_POST["kota"];
	 
	
	if (empty($name)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Please dont empty Name."; 
		die(json_encode($response));
		
	}  else if((empty($nik))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Nik Tidak Boleh Kosong";
	 	die(json_encode($response));
	 }
	 
	 else if((empty($no_kk))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Nomor KK Tidak Boleh Kosong";
	 	die(json_encode($response));
	 }
	 
	 else if((empty($tempat_lahir))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Tempat Lahir tidak boleh kosong";
	 	die(json_encode($response));
	 }

	  else if((empty($tanggal_lahir))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Tanggal Lahir tidak boleh kosong";
	 	die(json_encode($response));
	 }
	  else if((empty($jenis_kelamin))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Jenis Kelamin tidak boleh kosong";
	 	die(json_encode($response));
	 }
	 else if((empty($alamat))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Alamat tidak boleh kosong";
	 	die(json_encode($response));
	 }
	 else if((empty($email))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Email tidak boleh kosong";
	 	die(json_encode($response));
	 }
	  else if((empty($no_hp))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom No Handphone tidak boleh kosong";
	 	die(json_encode($response));
	 }
	  else if((empty($kota))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom Kota tidak boleh kosong";
	 	die(json_encode($response));
	 }
	 else if((empty($username))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom username tidak boleh kosong";
	 	die(json_encode($response));
	 }
	 else if ((empty($password))) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Kolom password tidak boleh kosong";
	 	die(json_encode($response));
	 } else if ((empty($confirm_password)) || $password != $confirm_password) {
	 	$response = new emp();
	 	$response->success = 0;
	 	$response->message = "Konfirmasi password tidak sama";
	 	die(json_encode($response));
	 }else {
		$random = random_word(20);
		$path = "images/pendaftaran/".$random.".png";
		// sesuiakan ip address laptop/pc atau URL server
		$actualpath = $random.".png";
		$query = mysqli_query($con, "INSERT INTO tambalban (id_daftar,nik,no_kk,nama,tempat_lahir,tanggal_lahir,jenis_kelamin,alamat,username,password,email,no_hp,kota,foto_profil,status) VALUES (null,'$nik','$no_kk','$name','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$alamat','$username','$password','$email','$no_hp','$kota','$actualpath','Belum Dikonfirmasi')");
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