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
	0 => 'id',
    1 => 'nama',
	2 => 'jenis_usaha',
	3 => 'alamat',
	4 => 'jam_operasional',
	5 => 'harga',
	6 => 'no_hp',
	7 => 'gambar',
	8 => 'deskripsi',
	9 => 'lat',
	10 => 'lng'

     
);

// getting total number records without any search
$sql = "SELECT * FROM tambalban";
$query=mysqli_query($conn, $sql) or die("ajax-grid-tambalban.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * FROM tambalban";
	$sql.=" WHERE id LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jenis_usaha LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR alamat LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jam_operasional LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR no_hp LIKE '".$requestData['search']['value']."%' ";
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-tambalban.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-tambalban.php: get PO"); // again run query with limit
	
} else {	

$sql = "SELECT * FROM tambalban";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-tambalban.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 


    $nestedData[] = $row["nama"];
	$nestedData[] = $row["jenis_usaha"];
	$nestedData[] = $row["alamat"];
	$nestedData[] = $row["jam_operasional"];
	$nestedData[] = $row["no_hp"];
	$nestedData[] = '<td><center><img src="../../android/me-nambal/images/tambalban/'.$row["gambar"].'" width="60px;" height="50px;"></center></td>';
     $nestedData[] = '<td><center>
	 <a href="edit-tambalban.php?id='.$row['id'].'" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a> 
	 <a href="detail-tambalban.php?id&ambil='.$row['id'].'"  data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-folder"> Detail</i></a>
	 <a href="table-tambalban.php?id=hapus&id='.$row['id'].'"  onclick="return deleteconfig()" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"> Hapus</i></a>
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
