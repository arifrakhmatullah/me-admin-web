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
                    <h2>Edit Data Lokasi <code>Bensin Eceran</code></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<?php
            $id = $_GET['id'];
			$sql = mysqli_query($koneksi, "SELECT * FROM bensineceran WHERE id_b='".$_GET['id']."'");
			if(mysqli_num_rows($sql) == 0){
			header("Location: index.php");
			
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
 
                    <form name="edit-bensin-eceran" id="edit-bensin-eceran" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="../controller/update-bensin-eceran.php" method="POST" >		
					<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="id_b" name="id_b" value="<?php echo $row['id_b'];?>">
                        </div>
                      </div>
					<!--untuk menampilkan file gambar yang telah di upload-->
		        <center><img id="preview" src="../../android/me-nambal/images/bensineceran/<?php echo $row['gambar_b'];?>" alt="" width="180px" height="200px"/></center>
				<br>
					
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file"  id="gambar_b" name="gambar_b" accept="image/*"  onchange="tampilkanPreview(this,'preview')">
                        </div>
                      </div>
					  
					  <div id="map" class="map"></div> 
					  <br>
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lat" name="lat_b"  value="<?php echo $row['lat_b'];?>"  class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lng" name="lng_b" value="<?php echo $row['lng_b'];?>"  class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					<center><button id="show" type="button" class="btn btn-primary">Tampilkan Peta</button>
					<button id="show" type="button" onclick="getLocation()" class="btn btn-success">Cek Lokasi</button>
					  <button type="button" onclick="resetLatLng()" class="btn btn-warning">Reset</center>
					  <br>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="nama_b" name="nama_b" value="<?php echo $row['nama_b'];?>"  class="form-control col-md-7 col-xs-12"  required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Usaha</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  id="jenis_usaha_b" name="jenis_usaha_b" value="<?php echo $row['jenis_usaha_b'];?>"  class="form-control col-md-7 col-xs-12" readonly="readonly">
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="alamat_b" name="alamat_b" class="form-control col-md-7 col-xs-12" required="required"><?php echo $row['alamat_b'];?>
						  </textarea>
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jam Operasional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="jam_operasional_b" name="jam_operasional_b" value="<?php echo $row['jam_operasional_b'];?>"  class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="harga_b" name="harga_b" value="<?php echo $row['harga_b'];?>"  class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No Handphone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" maxlength="12" onkeypress="return hanyaAngka(event)" id="no_hp_b" name="no_hp_b" value="<?php echo $row['no_hp_b'];?>" class="form-control col-md-7 col-xs-12" required="required">
						</div> 						
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="deskripsi_b" name="deskripsi_b" class="form-control col-md-7 col-xs-12" required="required"><?php echo $row['deskripsi_b'];?>
						  </textarea>
                        </div>
                      </div>
					  
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" id="update" name="update" class="btn btn-success">Simpan</button>
						  <a href="table-bensin-eceran.php"><button class="btn btn-danger" type="button">Kembali</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
				<script  src="../vendors/leaflet/bensineceran/edit.js"></script>
			  <?php
			  include "footer.php";
			  ?>
			  