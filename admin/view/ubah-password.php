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
include "../view/header.php";

?>
    		</script>
                <div class="x_panel">
                  <div class="x_title">
                    <h2><code>Ubah Password Admin</code></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<?php
				//proses jika tombol rubah di klik
	if(isset($_POST['submit'])){
		//membuat variabel untuk menyimpan data inputan yang di isikan di form
		$password_baru			= $_POST['password_baru'];
		$konfirmasi_password	= $_POST['konfirmasi_password'];
		
		//cek dahulu ke database dengan query SELECT
		//kondisi adalah WHERE (dimana) kolom password adalah $password_lama di encrypt m5
		//encrypt -> md5($password_lama)
	
			//kondisi ini jika password lama yang dimasukkan sama dengan yang ada di database
			//membuat kondisi minimal password adalah 5 karakter
			if(strlen($password_baru) >= 5){
				//jika password baru sudah 5 atau lebih, maka lanjut ke bawah
				//membuat kondisi jika password baru harus sama dengan konfirmasi password
				if($password_baru == $konfirmasi_password){
					//jika semua kondisi sudah benar, maka melakukan update kedatabase
					//query UPDATE SET password = encrypt md5 password_baru
					//kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
					$password_baru 	= md5($password_baru);
					$nama 		= $_SESSION['nama_user']; //ini dari session saat login
					
					$update 		= $koneksi->query("UPDATE tbl_user SET password='$password_baru' WHERE nama='$nama'");
					if($update){
						//kondisi jika proses query UPDATE berhasil
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Berhasil Dirubah.</div>';
					}else{
						//kondisi jika proses query gagal
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Gagal Ubah Password</div>';
					}					
				}else{
					//kondisi jika password baru beda dengan konfirmasi password
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Konfirmasi Data Tidak Cocok!</div>';
				}
			}else{
				//kondisi jika password baru yang dimasukkan kurang dari 5 karakter
				echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Minimal Password Adalah 5 Karakter!</div>';
			}
	}

			?>

			
                    <form name="ubah-password" id="ubah-password" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" action="ubah-password.php" method="POST" >

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password Baru</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="password" name="password_baru" id="password_baru" placeholder="Password Baru"class="form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Ulangi Password"class="form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>
  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" id="submit" name="submit" class="btn btn-success">Simpan</button>
						  <a href="../index.php" class="btn btn-danger">Kembali</a>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
				<script src="datepicker/js/bootstrap-datepicker.js"></script>
			  <?php
			  include "../view/footer.php";
			  ?>
			  