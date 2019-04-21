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
				$id	      				= $_POST['id'];
				$nama					= $_POST['nama'];
				$jenis_usaha			= $_POST['jenis_usaha'];
				$alamat					= $_POST['alamat'];
				$jam_operasional		= $_POST['jam_operasional'];
				$harga					= $_POST['harga'];
				$no_hp					= $_POST['no_hp'];
				$deskripsi				= $_POST['deskripsi'];
				$lat					= $_POST['lat'];
				$lng					= $_POST['lng'];
				
				//upload gambar dan resize
				$file=$_FILES['gambar']['name'];
				if(!empty($file)){
				$direktori="../../android/me-nambal/images/tambalban/"; //tempat upload foto
				$name='gambar'; //name pada input type file
				$namaBaru='tambalban'.date('Y-m-d-H-i-s'); //name pada input type file
				
				$info=$_FILES['gambar']["type"];
 
				if ($info == 'image/jpeg'){ 
					$ext=$namaBaru.'.jpg';
				}
				elseif($info == 'image/gif'){  
					$ext=$namaBaru.'.gif';
		
				}elseif($info == 'image/png'){ 
					$ext=$namaBaru.'.png';
				}
		
			}
			
			$cek = mysqli_query($koneksi, "SELECT * FROM tambalban WHERE id='$id'");
			$data = mysqli_fetch_array($cek);
				
				
				if(empty($file)){
				$update = mysqli_query($koneksi, "UPDATE tambalban SET nama='$nama', jenis_usaha='$jenis_usaha', alamat='$alamat', jam_operasional='$jam_operasional',harga='$harga',no_hp='$no_hp',deskripsi='$deskripsi',lat='$lat',lng='$lng' WHERE id='$id'") or die(mysqli_error());
				
				if($update){
					echo "<script>alert('Data Berhasil di Update!'); window.location = '../view/table-tambalban.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Update!'); window.location = '../view/table-tambalban.php'</script>";
				}
			}
			if(!empty($file)){
				$gambar = $data['gambar'];
				unlink("../../android/me-nambal/images/tambalban/".$gambar);
				
				$update = mysqli_query($koneksi, "UPDATE tambalban SET nama='$nama', jenis_usaha='$jenis_usaha', alamat='$alamat', jam_operasional='$jam_operasional',harga='$harga',no_hp='$no_hp',deskripsi='$deskripsi',lat='$lat',lng='$lng', gambar='$ext' WHERE id='$id'") or die(mysqli_error());
				if($update && UploadCompress($namaBaru,$name,$direktori)){
					echo "<script>alert('Data Berhasil di Update!'); window.location = '../view/table-tambalban.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di Update!'); window.location = '../view/table-tambalban.php'</script>";
				}
			}
			
			
				}
			?> 
