<?php 
	include_once "koneksi.php";
	
	$lat = $_GET['lat_b'];
	$lng = $_GET['lng_b'];	
	
	/* 10.0.2.2 adalah IP Address localhost EMULATOR ANDROID STUDIO,
        Ganti IP Address tersebut dengan IP Laptop Apabila di RUN di HP. HP dan Laptop harus 1 jaringan */
	$url = "http://ridhoillahi.000webhostapp.com/android/me-nambal/images/bensineceran/";
	
	// perhitungan haversine formula pada sintak SQL
	$query = mysqli_query($con, "SELECT id_b, nama_b, gambar_b, alamat_b, jam_operasional_b, (6371 * ACOS(SIN(RADIANS(lat_b)) * SIN(RADIANS($lat)) + COS(RADIANS(lng_b - $lng)) * COS(RADIANS(lat_b)) * COS(RADIANS($lat)))) AS jarak_b FROM bensineceran HAVING jarak_b < 6371 ORDER BY jarak_b ASC");
	
	$json = array();
	
	$no = 0;
	
	while($row = mysqli_fetch_assoc($query)){
		$json[$no]['id_b'] = $row['id_b'];
		$json[$no]['nama_b'] = $row['nama_b'];
		$json[$no]['gambar_b'] = $url.$row['gambar_b'];
		$json[$no]['alamat_b'] = $row['alamat_b'];
		$json[$no]['jam_operasional_b'] = $row['jam_operasional_b'];
		$json[$no]['jarak_b'] = $row['jarak_b'];
		
		$no++;
	}
	
	echo json_encode($json);
	
	mysqli_close($con);
	
?>