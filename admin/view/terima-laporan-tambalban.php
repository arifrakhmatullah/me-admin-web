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
<script type="text/javascript">
        function konfirmasi(){
        var tujuan=$(this).attr('id');
        var konfirmasi=confirm("Apakah Anda yakin ingin Mengkonfirmasi Data ini ?");
        if(konfirmasi==true){
            window.location.href=tujuan;
            }
            else{
            alert("Data Batal dihapus");
            }
            return konfirmasi;
            }
			function tolak(){
        var tujuan=$(this).attr('id');
        var tolak=confirm("Apakah Anda yakin ingin menolak data ini?");
        if(tolak==true){
            window.location.href=tujuan;
            }
            else{
            alert("Data Batal dihapus");
            }
            return tolak;
            }
			 </script>
			 
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Terima Laporan<code>Tambal Ban</code></h2>
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
			$sql = mysqli_query($koneksi, "SELECT * FROM laporan_tambalban WHERE id_laporan_tmb='".$_GET['ambil']."'");
			if(mysqli_num_rows($sql) == 0){
			header("Location: index.php");
			
			}else{
			$row = mysqli_fetch_assoc($sql);
			}
			
			?>
                    <form name="terima-laporan-tmb" id="terima-laporan-tmb" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="../controller/konfirmasi-laporan-tambalban.php" method="POST" >		
					
					
					
					 <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="id_laporan_tmb" name="id_laporan_tmb" value="<?php echo $row['id_laporan_tmb'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
					   <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="id" name="id" value="<?php echo $row['id'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pelapor
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row['nama_pelapor_tmb'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
                       
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi Laporan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  class="form-control col-md-7 col-xs-12" readonly="readonly"><?php echo $row['isi_laporan'];?>
						  </textarea>
                        </div>
                      </div>
					  
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="<?php echo $row['nama'];?>"  class="form-control col-md-7 col-xs-12" readonly="readonly">
						</div> 						
                      </div>
		
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control col-md-7 col-xs-12" readonly="readonly"><?php echo $row['alamat'];?>
						  </textarea>
                        </div>
                      </div>
					  
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" id="konfirmasi" name="konfirmasi" class="btn btn-success" onclick="return konfirmasi()">Konfirmasi</button>
						<button type="submit" id="tolak" name="tolak" class="btn btn-warning" onclick="return tolak()">Tolak</button>
						  <a href="table-laporan-tambalban.php"><button class="btn btn-danger" type="button">Kembali</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
			  <?php
			  include "footer.php";
			  ?>
			  