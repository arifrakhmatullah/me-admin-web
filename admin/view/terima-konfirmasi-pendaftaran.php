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
                    <h2>Terima Laporan<code>Tambal Ban dan Konfirmasi Via Email</code></h2>
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
			$sql = mysqli_query($koneksi, "SELECT * FROM tbl_daftar WHERE id_daftar='".$_GET['ambil']."'");
			if(mysqli_num_rows($sql) == 0){
			header("Location: index.php");
			
			}else{
			$row = mysqli_fetch_assoc($sql);
			}
			
			?>
                    <form name="terima-konfirmasi-pendaftaran" id="terima-konfirmasi-pendaftaran" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="../controller/konfirmasi-pendaftaran.php" method="POST" >		
					
					
					
					 <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="id_daftar" name="id_daftar" value="<?php echo $row['id_daftar'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
						  <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="id_owner" name="id_owner" value="<?php echo $row['id_daftar'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
						 <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="username" name="username" value="<?php echo $row['username'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
						 <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  id="password" name="password" value="<?php echo $row['password'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pendaftar
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row['nama'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
						<br>
					     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject :
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="subject" id="subject" value="Konfirmasi Pendaftaran Akun Pemilik Usaha" class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="email" id="email" value="<?php echo $row['email'];?>"  class="form-control col-md-7 col-xs-12"  readonly="readonly">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" id="konfirmasi" name="konfirmasi" class="btn btn-success" onclick="return konfirmasi()">Konfirmasi</button>
						<button type="submit" id="tolak" name="tolak" class="btn btn-warning" onclick="return tolak()">Tolak</button>
						  <a href="table-konfirmasi-pendaftaran.php"><button class="btn btn-danger" type="button">Kembali</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
			  <?php
			  include "footer.php";
			  ?>
			  