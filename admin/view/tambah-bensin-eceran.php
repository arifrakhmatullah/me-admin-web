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
                    <h2>Tambah Data Lokasi <code>Bensin Eceran</code></h2>
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
			
				$cek = mysqli_query($koneksi, "SELECT * FROM bensineceran WHERE nama_b='$nama_b'");
				
				
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($koneksi, "INSERT INTO bensineceran(id_b,nama_b, jenis_usaha_b, alamat_b, jam_operasional_b, harga_b, no_hp_b, gambar_b, deskripsi_b, lat_b, lng_b)
															VALUES(null,'$nama_b','$jenis_usaha_b', '$alamat_b', '$jam_operasional_b', '$harga_b', '$no_hp_b', '$ext', '$deskripsi_b', '$lat_b', '$lng_b')") or die(mysqli_error());
															
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

                    <form name="tambah-bensineceran" id="tambah-bensineceran" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="tambah-bensin-eceran.php" method="POST" >		
					<!--untuk menampilkan file gambar yang telah di upload-->
		        <center><img id="preview" src="" alt="" width="180px" height="200px"/></center>
				<br>
					
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file"  id="gambar_b" name="gambar_b" accept="image/*"  onchange="tampilkanPreview(this,'preview')" required="required">
                        </div>
                      </div>
					  
					  <div id="map" class="map"></div> 
					  <br>
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lat" name="lat_b"  class="form-control col-md-7 col-xs-12" placeholder="Latitude" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lng" name="lng_b" class="form-control col-md-7 col-xs-12" placeholder="Longitude" required="required">
						</div> 						
                      </div>
					  
					<center><button id="show" type="button" onclick="getLocation()" class="btn btn-success">Cek Lokasi</button>
					  <button type="button" onclick="resetLatLng()" class="btn btn-warning">Reset</center>
					  <br>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="nama_b" name="nama_b" placeholder="Nama" class="form-control col-md-7 col-xs-12"  required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Usaha</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="jenis_usaha_b" name="jenis_usaha_b" value="Bensin Eceran"class="form-control col-md-7 col-xs-12" readonly="readonly">
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="alamat_b" name="alamat_b" class="form-control col-md-7 col-xs-12" required="required">
						  </textarea>
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jam Operasional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="jam_operasional_b" name="jam_operasional_b" placeholder="Jam Operasional" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="harga_b" name="harga_b" placeholder="Harga" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No Handphone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" maxlength="12" onkeypress="return hanyaAngka(event)" id="no_hp_b" name="no_hp_b" placeholder="No Handphone" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="deskripsi_b" name="deskripsi_b" class="form-control col-md-7 col-xs-12" required="required" >
						  </textarea>
                        </div>
                      </div>
					  
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" id="input" name="input" class="btn btn-success">Simpan</button>
						  <a href="table-bensin-eceran.php"><button class="btn btn-danger" type="button">Kembali</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
				<script  src="../vendors/leaflet/bensineceran/index.js"></script>
			  <?php
			  include "footer.php";
			  ?>
			  