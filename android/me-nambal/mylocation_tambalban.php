<?php 
	include_once "koneksi.php";

	// perhitungan haversine formula pada sintak SQL
	$query = mysqli_query($con, "SELECT id, nama, lat, lng FROM tambalban ORDER BY nama ASC");
	$json = '{"tambalban": [';		// create looping dech array in fetch	while ($row = mysqli_fetch_array($query)){	// quotation marks (") are not allowed by the json string, we will replace it with the` character	// strip_tag serves to remove html tags on strings		$char ='"';		$json .= 		'{			"id":"'.str_replace($char,'`',strip_tags($row['id'])).'", 			"nama":"'.str_replace($char,'`',strip_tags($row['nama'])).'",			"lat":"'.str_replace($char,'`',strip_tags($row['lat'])).'",			"lng":"'.str_replace($char,'`',strip_tags($row['lng'])).'"		},';	}	// omitted commas at the end of the array	$json = substr($json,0,strlen($json)-1);	$json .= ']}';	// print json	echo $json;		mysqli_close($con);
	
?>