<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../logo/logo.ico" type="image/ico" />

     <title>Me-Nambal</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	 <!-- Datatables -->
    <link href="../vendors/datatables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="../vendors/datatables/buttons.dataTables.min.css" rel="stylesheet">
	
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	
	<!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../vendors/build/css/custom.min.css" rel="stylesheet">
		  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index.php" class="site_title"><i class="fa fa-gears"></i> <span>Admin</span></a>
            </div>

            <div class="clearfix"></div>

          <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../logo/logo.jpg" alt="..." width="210px" height="210px">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

             <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="../index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="table-tambalban.php">Data Tambal Ban</a></li>
					  <li><a href="table-bensin-eceran.php">Data Bensin Eceran</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-table"></i> Laporan User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="table-laporan-tambalban.php">Laporan Tambal Ban</a></li>
					  <li><a href="table-laporan-bensin-eceran.php">Laporan Bensin Eceran</a></li>
                    </ul>
                  </li>
				   <li><a href="table-konfirmasi-pendaftaran.php"><i class="fa fa-table"></i>Konfirmasi Pendaftaran</a>
                  </li> 
				   <li><a href="maps.php"><i class="fa fa-map-marker"></i>Maps</a>
                  </li> 
				   <li><a href="ubah-password.php"><i class="fa fa-edit"></i> Ubah Password</a>
                  </li> 
				    <li><a href="../../config/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                  </li> 
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

           
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../profile/tuyip.jpg" alt=""><b><?php echo $nama; ?></b>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../../config/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
		  <?php 
		  include "../../config/koneksi.php";
		  $jumlah_tambalban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tambalban"));
		  $jumlah_bensineceran = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bensineceran"));
		  $jumlah_laporan_tambalban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM laporan_tambalban"));
		  $jumlah_laporan_bensineceran = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM laporan_bensineceran"));
		  
		  ?>
            <div class="row title_count">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-globe"></i></div>
                  <div class="count green"><?php echo "$jumlah_tambalban";?></div>
                  <h3>Tambal Ban</h3>
                  <p>Total Data Lokasi <code><b>Tambal Ban</b></code></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-globe"></i></div>
                  <div class="count green"><?php echo "$jumlah_bensineceran";?></div>
                  <h3>Bensin Eceran</h3>
                  <p>Total Data Lokasi <code><b>Bensin Eceran</b></code></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                  <div class="count green"><?php echo "$jumlah_laporan_tambalban";?></div>
                  <h3>Laporan User</h3>
                  <p>Total Laporan Lokasi <code><b>Tambal Ban</b></code></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                  <div class="count green"><?php echo "$jumlah_laporan_bensineceran";?></div>
                  <h3>Laporan User</h3>
                  <p>Total Laporan Lokasi <code><b>Bensin Eceran</b></code></p>
                </div>
              </div>
            </div>
          <!-- /top tiles -->

          
        <!-- /page content -->

        <!-- footer content -->
       
        <!-- /footer content -->


    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
	
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 	
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    
	<!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
	
    <!-- Custom Theme Scripts -->
    <script src="../vendors/build/js/custom.min.js"></script>
	
		<!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
	
	<!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	
  </body>
</html>
