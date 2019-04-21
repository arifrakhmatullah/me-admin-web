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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail Laporan Lokasi Bensin Eceran Tidak Valid</h2>
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
		FROM laporan_bensineceran WHERE id_laporan_bns='".$_GET['ambil']."'");
			if(mysqli_num_rows($sql) == 0){
			header("Location: index.php");
			
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>

			
                   
                    <form class="form-horizontal form-label-left">
                   <div class="form-group">
                           <center><img src="../../android/me-nambal/images/bensineceran/<?php echo $row["gambar_b"]?>" width="100%" height="400px"></center>
                      </div>
					  
					  <div class="x_title">
					   <h2>Informasi</h2>
                    <div class="clearfix"></div>
                  </div>
                      
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pelapor
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row["nama_pelapor_bns"]; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Detail Isi Laporan
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea class="form-control col-md-7 col-xs-12" readonly="readonly" ><?php echo $row["isi_laporan_b"]; ?></textarea>
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lokasi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row["nama_b"]; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Usaha
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  value="<?php echo $row["jenis_usaha_b"]; ?>"class="form-control col-md-7 col-xs-12" readonly="readonly" >
                        </div>
                      </div>
					  
					      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea class="form-control col-md-7 col-xs-12" readonly="readonly" ><?php echo $row["alamat_b"]; ?></textarea>
                        </div>
                      </div>
                 
                      <div class="ln_solid"></div>
                      <div class="form-group">
						<center><a href="table-laporan-bensin-eceran.php" class="btn btn-sm btn-danger">Kembali</a><center>
                      </div>

                    </form>
                  </div>
				   </div>
                </div>
				</div>
               
			  <?php
			  include "footer.php";
			  ?>