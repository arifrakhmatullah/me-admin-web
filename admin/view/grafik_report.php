<!DOCTYPE html>
<html>
<link rel="icon" href="../logo/logo.ico" type="image/ico" />
<head>
<script src="vendors/build/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="vendors/build/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
		 title: {
			 text: 'Users Reports'
			 
		 },
         xAxis: {
            categories: ['Invalid Location']
         },
         yAxis: {
            title: {
               text: 'Jumlah Laporan User'
            }
         },
              series:             
            [
<?php      
// file koneksi php
include "../config/koneksi.php";
$sql_tambalban   = "SELECT * FROM laporan_tambalban"; // file untuk mengakses ke tabel database
$sql_bensineceran  = "SELECT * FROM laporan_bensineceran";	
$query_tambalban=mysqli_query($koneksi, $sql_tambalban) or die("grafik_report.php: get InventoryItems");  
$query_bensineceran=mysqli_query($koneksi, $sql_bensineceran) or die ("grafik_report.php: get InvetoryItems");
$data = mysqli_num_rows($query_tambalban);
$data2 = mysqli_num_rows($query_bensineceran);
$nama = 'Tambal Ban';
$nama2 = 'Bensin Eceran';

	  ?>
	  {
		  name: '<?php echo $nama; ?>',
		  data: [<?php echo $data; ?>]
	  },
	   {
		  name: '<?php echo $nama2; ?>',
		  data: [<?php echo $data2; ?>]
	  },
]
});
});	
</script>
</head>

</html>
