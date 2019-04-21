<?php
include "../../config/koneksi.php";
?>
 <?php
  function UploadCompress($new_name,$file,$dir){
  //direktori gambar
  $vdir_upload = $dir;
  $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];
 
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);
  $source_url=$dir.$_FILES[''.$file.'']["name"];
  $info = getimagesize($source_url);
 
    if ($info['mime'] == 'image/jpeg'){ 
        $image = imagecreatefromjpeg($source_url); 
        $ext='.jpg';
    }
    elseif($info['mime'] == 'image/gif'){ 
        $image = imagecreatefromgif($source_url); 
        $ext='.gif';
    }elseif($info['mime'] == 'image/png'){ 
        $image = imagecreatefrompng($source_url); 
        $ext='.png';
    }
   
    if(imagejpeg($image, $dir.$new_name.$ext)){
        unlink($source_url);
        return true;
    }else{
        unlink($source_url);
        return false;
    }
   
}
?>
					<?php
				if(isset($_POST['update'])){
				$id      				= $_POST['id_b'];
				$nama_b					= $_POST['nama_b'];
				$jenis_usaha_b			= $_POST['jenis_usaha_b'];
				$alamat_b				= $_POST['alamat_b'];
				$jam_operasional_b		= $_POST['jam_operasional_b'];
				$harga_b				= $_POST['harga_b'];
				$no_hp_b				= $_POST['no_hp_b'];
				$deskripsi_b			= $_POST['deskripsi_b'];
				$lat_b					= $_POST['lat_b'];
				$lng_b					= $_POST['lng_b'];
				
				//upload gambar dan resize
				$file=$_FILES['gambar_b']['name'];
				if(!empty($file)){
				$direktori="../../android/me-nambal/images/bensineceran/"; //tempat upload foto
				$name='gambar_b'; //name pada input type file
				$namaBaru='bensineceran'.date('Y-m-d-H-i-s'); //name pada input type file
				
				$info=$_FILES['gambar_b']["type"];
 
				if ($info == 'image/jpeg'){ 
					$ext=$namaBaru.'.jpg';
				}
				elseif($info == 'image/gif'){  
					$ext=$namaBaru.'.gif';
		
				}elseif($info == 'image/png'){ 
					$ext=$namaBaru.'.png';
				}
		
			}
			
			$cek = mysqli_query($koneksi, "SELECT * FROM bensineceran WHERE id_b='$id'");
			$data = mysqli_fetch_array($cek);
				
				
				if(empty($file)){
				$update = mysqli_query($koneksi, "UPDATE bensineceran SET nama_b='$nama_b', jenis_usaha_b='$jenis_usaha_b', alamat_b='$alamat_b', jam_operasional_b='$jam_operasional_b',harga_b='$harga_b',no_hp_b='$no_hp_b',deskripsi_b='$deskripsi_b',lat_b='$lat_b',lng_b='$lng_b' WHERE id_b='$id'") or die(mysqli_error());
				
				if($update){
					echo "<script>alert('Data Berhasil di Update!'); window.location = '../view/table-bensin-eceran.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Update!'); window.location = '../view/table-bensin-eceran.php'</script>";
				}
			}
			if(!empty($file)){
				$gambar = $data['gambar_b'];
				unlink("../../android/me-nambal/images/bensineceran/".$gambar);
				
				$update = mysqli_query($koneksi, "UPDATE bensineceran SET nama_b='$nama_b', jenis_usaha_b='$jenis_usaha_b', alamat_b='$alamat_b', jam_operasional_b='$jam_operasional_b',harga_b='$harga_b',no_hp_b='$no_hp_b',deskripsi_b='$deskripsi_b',lat_b='$lat_b',lng_b='$lng_b', gambar_b='$ext' WHERE id_b='$id'") or die(mysqli_error());
				if($update && UploadCompress($namaBaru,$name,$direktori)){
					echo "<script>alert('Data Berhasil di Update!'); window.location = '../view/table-bensin-eceran.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Update!'); window.location = '../view/table-bensin-eceran.php'</script>";
				}
			}
			
			
				}
			?> 
