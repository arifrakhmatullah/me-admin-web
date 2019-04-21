<?php
include "../../config/koneksi.php";
require '../phpmailer/PHPMailerAutoload.php';
?>
					<?php
				if(isset($_POST['konfirmasi'])){
				$to							= $_POST['email'];
				$subject					= $_POST['subject'];

		
				$cek = mysqli_query($koneksi, "SELECT * FROM tbl_owner WHERE id_owner='$id_owner'");
				
				
				if(mysqli_num_rows($cek) == 0){
						$update = mysqli_query($koneksi, "UPDATE tbl_daftar SET status='Sudah Dikonfirmasi' WHERE id_daftar='$id_daftar'") or die(mysqli_error());									
															
						if($update){
							echo "<script>alert('Data Berhasil di konfirmasi!'); window.location = '../view/table-konfirmasi-pendaftaran.php'</script>";
						}else{
							echo "<script>alert('Data Gagal di konfirmasi!'); window.location = '../view/table-konfirmasi-pendaftaran.php'</script>";
						}
				}else{
					echo "<script>alert('Nama Pendaftar Sudah Dikonfirmasi'); window.location = '../view/table-konfirmasi-pendaftaran.php'</script>";
				}
				//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "official.menambal@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Menambal10";

//Set who the message is to be sent from
$mail->setFrom('official.menambal@gmail.com', 'Me-Nambal');

//Set an alternative reply-to address
$mail->addReplyTo('official.menambal@gmail.com', 'Me-Nambal');

//Set who the message is to be sent to
$mail->addAddress($to, 'User');

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

$mail->msgHTML(file_get_contents('pages-email/diterima.html'), dirname(__FILE__));



//Attach an image file
//$mail->addAttachment('phpmailer/examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Email Terkirim!";

}

function save_mail($mail) {
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
			}
				
				if(isset($_POST['tolak'])){
				$id_daftar					= $_POST['id_daftar'];
				$id_owner					= $_POST['id_owner'];
				$to2			= $_POST['email'];
				$subject2		= $_POST['subject'];

			   $tolak = mysqli_query($koneksi, "UPDATE tbl_daftar SET status='Konfirmasi Ditolak' WHERE id_daftar='$id_daftar'") or die(mysqli_error());
			   $delete = mysqli_query($koneksi, "DELETE FROM tbl_owner WHERE id_owner='$id_owner'") or die(mysqli_error());
				if($tolak && $delete){
					echo "<script>alert('Data Berhasil di konfirmasi'); window.location = '../view/table-konfirmasi-pendaftaran.php'</script>";
				}else{
					echo "<script>alert('Data Gagal di konfirmasi!'); window.location = '../view/table-konfirmasi-pendaftaran.php'</script>";
				}
				//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "official.menambal@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Menambal10";

//Set who the message is to be sent from
$mail->setFrom('official.menambal@gmail.com', 'Me-Nambal');

//Set an alternative reply-to address
$mail->addReplyTo('official.menambal@gmail.com', 'Me-Nambal');

//Set who the message is to be sent to
$mail->addAddress($to2, 'User');

//Set the subject line
$mail->Subject = $subject2;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
$mail->msgHTML(file_get_contents('pages-email/ditolak.html'), dirname(__FILE__));



//Attach an image file
//$mail->addAttachment('phpmailer/examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Email Terkirim!";

}

function save_mail($mail) {
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
			}
			
			?> 
