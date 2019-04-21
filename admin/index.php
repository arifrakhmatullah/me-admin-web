<?php
session_start();
 
if( !isset($_SESSION['saya_admin']) )
{
    header('location:./../'.$_SESSION['akses']);
    exit();
}
 
$nama = ( isset($_SESSION['nama_user']) ) ? $_SESSION['nama_user'] : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="logo/logo.ico" type="image/ico" />

    <title>Me-Nambal</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	
	<!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="vendors/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-gears"></i> <span>Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="logo/logo.jpg" alt="..." width="210px" height="210px">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="view/table-tambalban.php">Data Tambal Ban</a></li>
					  <li><a href="view/table-bensin-eceran.php">Data Bensin Eceran</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-table"></i> Laporan User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="view/table-laporan-tambalban.php">Laporan Tambal Ban</a></li>
					  <li><a href="view/table-laporan-bensin-eceran.php">Laporan Bensin Eceran</a></li>
                    </ul>
                  </li>
				     <li><a href="view/table-konfirmasi-pendaftaran.php"><i class="fa fa-table"></i>Konfirmasi Pendaftaran</a>
                  </li> 
				    <li><a href="view/maps.php"><i class="fa fa-map-marker"></i>Maps</a>
                  </li> 
				   <li><a href="view/ubah-password.php"><i class="fa fa-edit"></i> Ubah Password</a>
                  </li> 
				    <li><a href="../config/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
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
                   <img src="profile/tuyip.jpg" alt=""><b><?php echo $nama; ?></b>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../config/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
		  include "../config/koneksi.php";
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
		  <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile Founder Me-Nambal</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="profile/tuyip.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>Arif Rakhmatullah.M</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> Kota Pekanbaru, Riau
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer / Freelance
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-facebook user-profile-icon"></i>
                          <a href="https://facebook.com/OursJUMONG" target="_blank">www.facebook.com</a>
                        </li>
                      </ul>

                      <a href="update-profile.php" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                      <!-- start skills -->
                      <h4>Keahlian</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Web Applications</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="75"></div>
                          </div>
                        </li>
                        <li>
                          <p>Website Design</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                        <li>
                          <p>Android Programming</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                        <li>
                          <p>Hardware</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                          </div>
                        </li>
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Total Activity User Reports Invalid Location</h2>
                        </div>
                        <div class="col-md-6">
                          <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                          </div>
                        </div>
                      </div>
                      <!-- start of user-activity-graph -->
					  
                      <div id="container" style="width:100%; height:340px;">
					  <?php include "view/grafik_report.php";?></div>
					  
                      <!-- end of user-activity-graph -->

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							<p>Me-Nambal adalah aplikasi berbasis android yang dapat mencari lokasi tambal ban atau bensin eceran terdekat. Aplikasi me-nambal ini adalah solusi bagi pengendara yang kerap kali mengalami 
							kondisi kebocoran ban atau kehabisan bahan bakar. Pada aplikasi ini memiliki beberapa fitur yaitu mencari lokasi tambal ban atau bensin eceran, dapat melakukan panggilan terhadap pengusaha tambal ban atau bensin eceran, dan juga fitur real-time chat.
							</p>
                            <!-- end recent activity -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- /top tiles -->
		  
		  <br>
		  <br>
		  <?php
		 include "view/footer.php";
		 ?>
		  
		  </div>
		   
		
		 
		 <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
	
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 	
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    
	<!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
	
    <!-- Custom Theme Scripts -->
    <script src="vendors/build/js/custom.min.js"></script>
	
	<!-- morris.js -->
    <script src="vendors/raphael/raphael.min.js"></script>
    <script src="vendors/morris.js/morris.min.js"></script>
	
	<!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	
  </body>
  </html>
</html>