<?php
session_start();
 
if( isset($_SESSION['akses']) )
{
    header('location:'.$_SESSION['akses']);
    exit();
}
 
$error = '';
if( isset($_SESSION['error']) ) {
 
     $error = $_SESSION['error']; // set error
 
     unset($_SESSION['error']);
} ?>
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
    <link href="vendors/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="vendors/build/css/custom.min.css" rel="stylesheet">
	<link href="vendors/build/css/custom.css" rel="stylesheet">
	<style type="text/css">
	
</style>
  </head>

  <body class="login-menambal">	
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="config/login.php" method="POST" class="form-horizontal" role="form">
              <img src="logo/logo.jpg" width="250px" height="250px">
              <div>
                <input type="text" name="usernamemu" id="usernamemu" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="passwordmu" id="passwordmu" class="form-control" placeholder="Password" required="" />
              </div>
              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />
				<button type="submit" class="btn btn-dark btn-block">Login <span class="glyphicon glyphicon-lock"></span></button>
                <div>
                  <h1><i class="fa fa-gears">&nbsp;&nbsp;&nbsp;&nbsp;</i>Admin</h1>
                  <p>© 2018 Me-Nambal</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
