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
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "me-nambal";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id_laporan_bns',
    1 => 'id_b',
	2 => 'nama_b',
	3 => 'jenis_usaha_b',
	4 => 'alamat_b',
	5 => 'gambar_b',
	6 => 'nama_pelapor_bns',
	7 => 'isi_laporan_b'

     
);

// getting total number records without any search
$sql = "SELECT * FROM laporan_bensineceran";
$query=mysqli_query($conn, $sql) or die("ajax-grid-bensin-eceran.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * FROM laporan_bensineceran";
	$sql.=" WHERE id_laporan_bns LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama_b LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jenis_usaha_b LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR alamat_b LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama_pelapor_bns LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR isi_laporan_b LIKE '".$requestData['search']['value']."%' ";
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-bensin-eceran.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-bensin-eceran.php: get PO"); // again run query with limit
	
} else {	

$sql = "SELECT * FROM laporan_bensineceran";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-bensin-eceran.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 


    $nestedData[] = $row["nama_pelapor_bns"];
	$nestedData[] = substr($row["isi_laporan_b"],0,30).".....";
	$nestedData[] = '<td><center>'.$row["id_b"].'</td></center>';
	$nestedData[] = $row["nama_b"];
	$nestedData[] = $row["jenis_usaha_b"];
	$nestedData[] = $row["alamat_b"];
	$nestedData[] = '<td><center><img src="../../android/me-nambal/images/bensineceran/'.$row["gambar_b"].'" width="60px;" height="50px;"></center></td>';
     $nestedData[] = '<td><center>
	 <a href="terima-laporan-bensineceran.php?id&ambil='.$row['id_laporan_bns'].'"  data-toggle="tooltip" title="Approve" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"> Approve</i></a>
	 <a href="detail-laporan-bensin-eceran.php?id&ambil='.$row['id_laporan_bns'].'"  data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-folder"> Detail</i></a>
				     </center></td>';			
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
