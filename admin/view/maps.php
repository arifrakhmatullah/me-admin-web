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
include "header.php";
?>
	<!-- Leaflet MAP Style -->
	<link rel="stylesheet" href="../vendors/leaflet/maps/leaflet.css" />
	<script src="../vendors/leaflet/maps/leaflet.js"></script>
	<script>
	var bensineceran = L.icon({
    iconUrl: '../marker_icon/bensin.png',

    iconSize:     [40, 60], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
var tambalban = L.icon({
    iconUrl: '../marker_icon/tambalban.png',

    iconSize:     [40, 60], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
	</script>
	<script>
	
		function peta_awal() {
			// posisi default peta saat diload
			// koordinat dan zoom view peta 
			var map = L.map('map').setView([0.506566, 101.437790], 14);
			// Tile layer using key api at cloudmade.com
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    key: '760506895e284217a7442ce2efe97797',
    styleId: 103288,
    maxZoom: 18
  }).addTo(map);

			<?php
			require ('../../config/koneksi.php');
			// query
			$sql_tambalban = "SELECT * from tambalban";
			$sql_bensineceran = "SELECT * from bensineceran";
			$data_tambalban = mysqli_query($koneksi,$sql_tambalban);
			$data_bensineceran = mysqli_query($koneksi,$sql_bensineceran);

			$js_tambalban = '';
			$js_bensineceran = '';

			// looping script js ini sesuai dengan jumlah lokasi yang ada pada database
			while($row = mysqli_fetch_assoc($data_tambalban)) {
				$js_tambalban .= 'L.marker(['.$row['lat'].', '.$row['lng'].'],{icon: tambalban}).addTo(map)
						.bindPopup("<b>'.$row['nama'].'</b>");
						';
			}
			// menampilkan script js hasil dari looping diatas
			echo $js_tambalban;
			
			// looping script js ini sesuai dengan jumlah lokasi yang ada pada database
			while($row = mysqli_fetch_assoc($data_bensineceran)) {
				$js_bensineceran .= 'L.marker(['.$row['lat_b'].', '.$row['lng_b'].'],{icon: bensineceran}).addTo(map)
						.bindPopup("<b>'.$row['nama_b'].'</b>");
						';
			}
			// menampilkan script js hasil dari looping diatas
			echo $js_bensineceran;

			?>

			var popup = L.popup();
		}
		
	</script>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Peta Lokasi Tambal Ban dan Bensin Eceran</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				
                    <p class="text-muted font-13 m-b-30">
                    Data Lokasi<code>Bensin Eceran</code> & <code>Bensin Eceran</code> Dapat Dilihat Pada Peta Di Bawah !
                    </p>
<body onload="peta_awal()">
	<div id="map" style="width: 100%; height:500px;"></div>
</body>
  </div>
  </div>
  <?php
  include "footer.php";
  ?>
