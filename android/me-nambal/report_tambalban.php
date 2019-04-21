<?php
	include "koneksi.php";
	$id		= $_POST['id'];
	$nama 	= $_POST['nama'];
	$jenis_usaha	= $_POST['jenis_usaha'];
	$alamat = $_POST['alamat'];
	$gambar = $_POST['gambar'];
	$nama_pelapor_tmb = $_POST['nama_pelapor_tmb'];
	$isi_laporan = $_POST['isi_laporan'];
	
	class emp{}
	
	$query = mysqli_query($con,"INSERT INTO laporan_tambalban (id,nama,jenis_usaha,alamat,gambar,isi_laporan,nama_pelapor_tmb) VALUES('".$id."','".$nama."','".$jenis_usaha."','".$alamat."','".$gambar."','".$isi_laporan."','".$nama_pelapor_tmb."')");
		
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