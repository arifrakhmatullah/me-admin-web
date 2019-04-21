<?php
session_start();
 
if( !isset($_SESSION['saya_admin']) )
{
    header('location:./../'.$_SESSION['akses']);
    exit();
}
 
$nama = ( isset($_SESSION['nama_user']) ) ? $_SESSION['nama_user'] : '';
?>
<?php
include "../../config/koneksi.php";
include "header.php";
?>
 <!-- Leaflet  Style -->
<link rel="stylesheet" href="../vendors/leaflet/style.css">
<link rel="stylesheet" href="../vendors/leaflet/leaflet.css">
<script src="../vendors/leaflet/leaflet.js"></script> 
<script src="../vendors/leaflet/leaflet-src.js"></script>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Data Lokasi <code>Tambal Ban</code></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
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
				if(isset($_POST['input'])){
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
		
				$cek = mysqli_query($koneksi, "SELECT * FROM tambalban WHERE nama='$nama'");
				
				
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($koneksi, "INSERT INTO tambalban(id,nama, jenis_usaha, alamat, jam_operasional, harga, no_hp, gambar, deskripsi, lat, lng)
															VALUES(null,'$nama','$jenis_usaha', '$alamat', '$jam_operasional', '$harga', '$no_hp', '$ext', '$deskripsi', '$lat', '$lng')") or die(mysqli_error());
															
						if($insert && UploadCompress($namaBaru,$name,$direktori)){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Berhasil Di Simpan.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Gagal Di simpan !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Upss Nama  Sudah Ada..!</div>';
				}
			}
			?> 

                    <form name="tambah-tambalban" id="tambah-tambalban" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="tambah-tambalban.php" method="POST" >		
					<!--untuk menampilkan file gambar yang telah di upload-->
		        <center><img id="preview" src="" alt="" width="180px" height="200px"/></center>
				<br>
					
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file"  id="gambar" name="gambar" accept="image/*"  onchange="tampilkanPreview(this,'preview')" required="required">
                        </div>
                      </div>
					  
					  <div id="map" class="map"></div> 
					  <br>
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lat" name="lat"  class="form-control col-md-7 col-xs-12" placeholder="Latitude" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lng" name="lng" class="form-control col-md-7 col-xs-12" placeholder="Longitude" required="required">
						</div> 						
                      </div>
					  
					<center><button id="show" type="button" onclick="getLocation()" class="btn btn-success">Cek Lokasi</button>
					  <button type="button" onclick="resetLatLng()" class="btn btn-warning">Reset</center>
					  <br>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="nama" name="nama" placeholder="Nama" class="form-control col-md-7 col-xs-12"  required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Usaha</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="jenis_usaha" name="jenis_usaha" value="Tambal Ban"class="form-control col-md-7 col-xs-12" readonly="readonly">
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="alamat" name="alamat" class="form-control col-md-7 col-xs-12" required="required">
						  </textarea>
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jam Operasional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="jam_operasional" name="jam_operasional" placeholder="Jam Operasional" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="harga" name="harga" placeholder="Harga" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No Handphone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" maxlength="12" onkeypress="return hanyaAngka(event)" id="no_hp" name="no_hp" placeholder="No Handphone" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="deskripsi" name="deskripsi" class="form-control col-md-7 col-xs-12" required="required">
						  </textarea>
                        </div>
                      </div>
	  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" id="input" name="input" class="btn btn-success">Simpan</button>
						  <a href="table-tambalban.php"><button class="btn btn-danger" type="button">Kembali</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
				<script  src="../vendors/leaflet/tambalban/index.js"></script>
			  <?php
			  include "footer.php";
			  ?>
			  