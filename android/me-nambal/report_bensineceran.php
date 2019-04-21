<?php
	include "koneksi.php";
	$id_b		= $_POST['id_b'];
	$nama_b 	= $_POST['nama_b'];
	$jenis_usaha_b	= $_POST['jenis_usaha_b'];
	$alamat_b = $_POST['alamat_b'];
	$gambar_b = $_POST['gambar_b'];
	$nama_pelapor_bns = $_POST['nama_pelapor_bns'];
	$isi_laporan_b = $_POST['isi_laporan_b'];
	
	class emp{}
	
	$query = mysqli_query($con,"INSERT INTO laporan_bensineceran (id_b,nama_b,jenis_usaha_b,alamat_b,gambar_b,isi_laporan_b,nama_pelapor_bns) VALUES('".$id_b."','".$nama_b."','".$jenis_usaha_b."','".$alamat_b."','".$gambar_b."','".$isi_laporan_b."','".$nama_pelapor_bns."')");
		
		if ($query) {
			$response = new emp();
			$response->success = 1;
			$response->message = "Laporan telah dikirim, Laporan anda akan dicek oleh Admin. Terimakasih :)";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error simpan Data";
			die(json_encode($response)); 
		}	
	
?>