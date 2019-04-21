<?php
include "../../config/koneksi.php";
?>
					<?php
				if(isset($_POST['konfirmasi'])){
				$id	     			= $_POST['id_laporan_tmb'];
				$id_tambalban		= $_POST['id'];
			
				$cek = mysqli_query($koneksi, "SELECT * FROM laporan_tambalban WHERE id_laporan_tmb='$id'");
				$data = mysqli_fetch_array($cek);
			
				$konfirmasi = mysqli_query($koneksi, "DELETE FROM laporan_tambalban WHERE id_laporan_tmb='$id' OR id LIKE '%$id_tambalban%'") or die(mysqli_error());
				$konfirmasi2 = mysqli_query($koneksi, "DELETE FROM tambalban WHERE id='$id_tambalban'") or die(mysqli_error());
			   $gambar = $data['gambar'];
			   unlink("../../android/me-nambal/images/tambalban/".$gambar);
				if($konfirmasi && $konfirmasi2){
					echo "<script>alert('Data Berhasil di Konfirmasi!'); window.location = '../view/table-laporan-tambalban.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Konfirmasi!'); window.location = '../view/table-laporan-tambalban.php'</script>";
				}
				}
				
				if(isset($_POST['tolak'])){
				$id	     			= $_POST['id_laporan_tmb'];
				$id_tambalban		= $_POST['id'];
				$cek = mysqli_query($koneksi, "SELECT * FROM laporan_tambalban WHERE id_laporan_tmb='$id'");
				$data = mysqli_fetch_array($cek);
			
			   $tolak = mysqli_query($koneksi, "DELETE FROM laporan_tambalban WHERE id_laporan_tmb='$id' OR id LIKE '%$id_tambalban%'") or die(mysqli_error());
				if($tolak){
					echo "<script>alert('Data Berhasil di Hapus!'); window.location = '../view/table-laporan-tambalban.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Hapus!'); window.location = '../view/table-laporan-tambalban.php'</script>";
				}
				}
			?> 
