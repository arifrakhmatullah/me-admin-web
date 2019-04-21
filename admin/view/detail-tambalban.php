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
    		</script>
			<div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Foto</h2>
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
			$sql = mysqli_query($koneksi, "SELECT *
		FROM tambalban WHERE id='".$_GET['ambil']."'");
			if(mysqli_num_rows($sql) == 0){
			header("Location: index.php");
			
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>

			
                    <form class="form-horizontal form-label-left">

                  	  <div class="form-group">
                        <div class="img-preview preview-lg">
                           <img src="../../android/me-nambal/images/tambalban/<?php echo $row["gambar"]?>" width="100%" height="300px">
                        </div>
                      </div>
					  
							
                      <div class="ln_solid"></div>
                      <div class="form-group">
                      </div>

                    </form>
                  </div>
                </div>
				</div>
				<div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail Tambal Ban</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
			
                    <form class="form-horizontal form-label-left">
					
					    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row['nama']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
                      
                     <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Usaha
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text"  value="<?php echo $row['jenis_usaha']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Alamat
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control col-md-7 col-xs-12" readonly="readonly" ><?php echo $row['alamat']; ?></textarea>
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jam Operasional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text"  value="<?php echo $row['jam_operasional']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Harga
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text"  value="<?php echo $row['harga']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">No Handphone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row['no_hp']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
                      
                     <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea class="form-control col-md-7 col-xs-12" readonly="readonly"><?php echo $row['deskripsi']; ?></textarea>
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Latitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row['lat']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Longitude
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text"  value="<?php echo $row['lng']; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
						<center><a href="table-tambalban.php" class="btn btn-sm btn-danger">Kembali</a><center>
                      </div>

                    </form>
                  </div>
                </div>
				</div>
				</div>
				
				
				
				
				
				
			  <?php
			  include "footer.php";
			  ?>
			  