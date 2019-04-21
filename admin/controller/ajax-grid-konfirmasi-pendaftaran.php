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
	0 => 'id_daftar',
	1 => 'nik',
	2 => 'no_kk',
	3 => 'nama',
	4 => 'tempat_lahir',
	5 => 'tanggal_lahir',
	6 => 'jenis_kelamin',
	7 => 'alamat',
	8 => 'username',
	9 => 'password',
	10 => 'email',
	11 => 'no_hp',
	12 => 'kota',
	13 => 'foto_profil',
	14 => 'foto_ktp',
	15 => 'foto_surat_izin_usaha',
	16 => 'status'

     
);

// getting total number records without any search
$sql = "SELECT * FROM tbl_daftar";
$query=mysqli_query($conn, $sql) or die("ajax-grid-konfirmasi-pendaftaran.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * FROM tbl_daftar";
	$sql.=" WHERE id_daftar LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nik LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR alamat LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR no_hp LIKE '".$requestData['search']['value']."%' ";
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-konfirmasi-pendaftaran.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-konfirmasi-pendaftaran.php: get PO"); // again run query with limit
	
} else {	

$sql = "SELECT * FROM tbl_daftar";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-konfirmasi-pendaftaran.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 


    $nestedData[] = $row["nik"];
	$nestedData[] = $row["nama"];
	$nestedData[] = $row["alamat"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["no_hp"];
	$nestedData[] = '<td><center><img src="../../android/me-nambal/images/pendaftaran/'.$row["foto_profil"].'" width="60px;" height="50px;"></center></td>';
	$nestedData[] = $row["status"];
     $nestedData[] = '<td><center>
	 <a href="terima-konfirmasi-pendaftaran.php?id&ambil='.$row['id_daftar'].'"  data-toggle="tooltip" title="Approve" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"> Approve</i></a>
	 <a href="detail-konfirmasi-pendaftaran.php?id&ambil='.$row['id_daftar'].'"  data-toggle="tooltip" title="Detail" class="btn btn-info btn-sm"><i class="fa fa-folder"> Detail</i></a>
	 <a href="table-konfirmasi-pendaftaran.php?id=hapus&id='.$row['id_daftar'].'"  onclick="return deleteconfig()" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"> Hapus</i></a>
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
