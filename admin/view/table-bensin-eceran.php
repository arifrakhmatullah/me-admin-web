<?php
session_start();
 
if( !isset($_SESSION['saya_admin']) )
{
    header('location:./../'.$_SESSION['akses']);
    exit();
}
 
$nama = ( isset($_SESSION['nama_user']) ) ? $_SESSION['nama_user'] : '';
?>
<?php include "../../config/koneksi.php";
include "header.php"; 
?>
<script type="text/javascript">
        function deleteconfig(){
        var tujuan=$(this).attr('id');
        var hapusin=confirm("Apakah Anda yakin ingin menghapus data ini?");
        if(hapusin==true){
            window.location.href=tujuan;
            }
            else{
            alert("Data Batal dihapus");
            }
            return hapusin;
            }
        </script>
             <?php
             if(isset($_GET['id']) == 'hapus'){
				$id = $_GET['id'];
				$cek = mysqli_query($koneksi, "SELECT * FROM bensineceran WHERE id_b='$id'");
				$data = mysqli_fetch_array($cek);
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM bensineceran WHERE id_b='$id'");
					$gambar = $data['gambar_b'];
					unlink("../../android/me-nambal/images/bensineceran/".$gambar);
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
					}
				}
			}
			?>

             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Lokasi Bensin Eceran</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     Data Lokasi <code>Bensin Eceran</code> Dapat Dilihat Pada Table Di Bawah !
                    </p><br><br>
					<div class ="table-responsive">
                                    <table id="lookup" class="table table-bordered table-hover" width="100%" cellspacing="0">  
	                                   <thead bgcolor="#eeeeee" align="center">
                                        <tr>
										<th>Nama</th>
										<th>Jenis Usaha</th>
										<th>Alamat</th>
										<th>Jam Operasional</th>
										<th>No Handphone</th>
										<th>Foto</th>
                                        
	                                    <th class="text-center"> Action </th> 
	  
                                       </tr>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							   <div class="pull-right">
                            <a href="tambah-bensin-eceran.php" class="btn btn-sm btn-success">Tambah Data</a>
                            </div>
							</div>
                     
   						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>

        <script src="../vendors/datatables/jquery.dataTables.js"></script>
        <script src="../vendors/datatables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"../controller/ajax-grid-bensin-eceran.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>
		<?php
		include "footer.php";
		?>
