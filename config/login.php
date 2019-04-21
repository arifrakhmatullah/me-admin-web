<?php
session_start();

# check apakah ada akse post dari halaman login?, jika tidak kembali kehalaman depan
if( !isset($_POST['usernamemu']) ) { header('location:../index.php'); exit(); }

# set nilai default dari error,
$error = '';

require ( 'koneksi.php' );

$username = trim( $_POST['usernamemu'] );
$password = trim( $_POST['passwordmu'] );

if( strlen($username) < 2 )
{
	# jika ada error dari kolom username yang kosong
	echo "<script>alert('Username Tidak Boleh Kosong'); window.location = '../index.php'</script>";
}else if( strlen($password) < 2 )
{
	# jika ada error dari kolom password yang kosong
	echo "<script>alert('Password Tidak Boleh Kosong'); window.location = '../index.php'</script>";
}else{

	# Escape String, ubah semua karakter ke bentuk string
	$username = $koneksi->escape_string($username);
	$password = $koneksi->escape_string($password);

	# hash dengan md5
	$password = md5($password);

	# SQL command untuk memilih data berdasarkan parameter $username dan $password yang 
	# di inputkan
	$sql = "SELECT nama, hak_akses FROM tbl_user 
			WHERE username='$username' 
			AND password='$password' LIMIT 1";

	# melakukan perintah
	$query = $koneksi->query($sql);

	# check query
	if( !$query )
	{
		die( 'Oops!! Database gagal '. $koneksi->error );
	}

	# check hasil perintah
	if( $query->num_rows == 1 )
	{	
		# jika data yang dimaksud ada
		# maka ditampilkan
		$row =$query->fetch_assoc();
		
		# data nama disimpan di session browser
		$_SESSION['nama_user'] = $row['nama']; 
		$_SESSION['akses']	   = $row['hak_akses'];

		if( $row['hak_akses'] == 'admin')
		{
			# data hak admin di set
			$_SESSION['saya_admin']= 'TRUE';
		}
	#	elseif( $row['hak_akses'] == 'kepdinas')
	#	{
	#		# data hak kepdinas di set
	#		$_SESSION['saya_kepdinas']= 'TRUE';
	#	}
	#	elseif( $row['hak_akses'] == 'puskesmas')
	#	{
	#		# data hak puskesmas di set
	#		$_SESSION['saya_puskesmas']= 'TRUE';
	#	}

		# menuju halaman sesuai hak akses
		header('location:'.$url.'/'.$_SESSION['akses'].'/');
		exit();

	}else{
		
		# jika data yang dimaksud tidak ada
		echo "<script>alert('Username dan Password Tidak ditemukan'); window.location = 'login.php'</script>";
	}

}

if( !empty($error) )
{
	# simpan error pada session
	$_SESSION['error'] = $error;
	header('location:'.$url.'/page_404.html');
	exit();
}