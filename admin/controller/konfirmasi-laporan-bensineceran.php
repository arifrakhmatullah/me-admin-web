<?php
include "../../config/koneksi.php";
?>
					<?php
				if(isset($_POST['konfirmasi'])){
				$id	     			= $_POST['id_laporan_bns'];
				$id_bensin			= $_POST['id_b'];
			
				$cek = mysqli_query($koneksi, "SELECT * FROM laporan_bensineceran WHERE id_laporan_bns='$id'");
				$data = mysqli_fetch_array($cek);
			
				$konfirmasi = mysqli_query($koneksi, "DELETE FROM laporan_bensineceran WHERE id_laporan_bns='$id' OR id_b LIKE '%$id_bensin%'") or die(mysqli_error());
				$konfirmasi2 = mysqli_query($koneksi, "DELETE FROM bensineceran WHERE id_b='$id_bensin'") or die(mysqli_error());
			   $gambar = $data['gambar_b'];
			   unlink("../../android/me-nambal/images/bensineceran/".$gambar);
				if($konfirmasi && $konfirmasi2){
					echo "<script>alert('Data Berhasil di Konfirmasi!'); window.location = '../view/table-laporan-bensin-eceran.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Konfirmasi!'); window.location = '../view/table-laporan-bensin-eceran.php'</script>";
				}
				}
				
				if(isset($_POST['tolak'])){
				$id	     			= $_POST['id_laporan_bns'];
				$id_bensin		    = $_POST['id_b'];
				$cek = mysqli_query($koneksi, "SELECT * FROM laporan_bensineceran WHERE id_laporan_bns='$id'");
				$data = mysqli_fetch_array($cek);
			
			   $tolak = mysqli_query($koneksi, "DELETE FROM laporan_bensineceran WHERE id_laporan_bns='$id' OR id_b LIKE '%$id_bensin%'") or die(mysqli_error());
				if($tolak){
					echo "<script>alert('Data Berhasil di Hapus!'); window.location = '../view/table-laporan-bensin-eceran.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Hapus!'); window.location = '../view/table-laporan-bensin-eceran.php'</script>";
				}
				}
			?> 
