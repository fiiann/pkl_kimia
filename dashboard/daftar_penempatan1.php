<!DOCTYPE html>
<html>
<head>
	<title>Daftar Penempatan</title>
	<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<!-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<script src="assets/js/datatables.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
    $('#tabelku').DataTable();
});
</script>
<?php
	include_once('sidebar.php');
	// $id=$_SESSION['sip_masuk_aja'];
	// require_once('db_login.php');
		// $db=new mysqli($db_host, $db_username, $db_password, $db_database);
?>
<body>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					 Penempatan Laboratorium

				</div>
				<div class="panel-body">
					<div class="table-responsive">
            <table class="table table-condensed" id="tabelku">
                          <tbody>
                             <tr>
                                <th>No</th>
                <th>Nama Bahan Baku</th>
                <th>Kode</th>
                <th>Satuan</th>
                <th>Harga-AHS</th>
                <th>Harga-K</th>
                <th colspan="2">Aksi</th>

                             </tr>
           <?php
             require_once('config.php');
             $db = new mysqli($db_host, $db_username, $db_password, $db_database);
             if ($db->connect_errno){
               die ("Could not connect to the database: <br />". $db->connect_error);
             }
             //Asign a query
             $query = " SELECT * FROM bahan_baku ";
             // Execute the query
             $result = $db->query( $query );
             if (!$result){
                die ("Could not query the database: <br />". $db->error);
             }
             $no  = 1;
             // Fetch and display the results
             while ($row = $result->fetch_object()){
               echo "<tr><td>".$no."</td>";
               echo '<td>'.$row->nama_barang.'</td> ';
               echo '<td>'.$row->kode_barang.'</td> ';
               echo '<td>'.$row->satuan.'</td>';
               echo '<td>'.$row->harga_ahs.'</td>';
               echo '<td>'.$row->harga_k.'</td>';
               echo '<td colspan="2">
                     <a class="btn btn-warning" href="edit_bahan.php?id='.$row->kode_barang.'" ><i class="fa fa-pencil"></i> Edit</a>
                     <a class="btn btn-danger" href="del_bahan.php?id='.$row->kode_barang.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
               echo '</tr>';
             }
                       ?>
              </tbody>
                </table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	mysqli_close($con);

?>
</body>
</html>
