<!DOCTYPE html>
<html>
<head>
	<title>Daftar Penempatan TR1</title>
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
	$id=$_SESSION['sip_masuk_aja'];
	// require_once('db_login.php');
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);
?>
<body>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Daftar Penempatan TR1 
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead>
						    <tr>
						      <th>No</th>
						      <th>NIM</th>
						      <th>Nama</th>
						      <th>Laboratorium</th>
						      <?php
						        if ($status=="petugas") {
						          echo "<th>Action</th>";
						        }
						        ?>
						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php
						    // Assign a query
						    if ($status=="petugas") {
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.idlab_tr1 IS NOT NULL ORDER BY m.nama   ";
						    }elseif ($status=="dosen"){
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.nip1='".$dosen->nip."'";
						    }elseif ($status=="lab"){
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.idlab_tr1='".$lab->idlab."'";
						    }else {
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  WHERE t.nim='".$anggota->nim."'";
						    }

						    // Execute the query
						    $result = $con->query( $query );
						    if(!$result){
						      die('Could not connect to database : <br/>'.$con->error);
						    }
						    $i=1;
						    while($row = $result->fetch_object()){
						      echo "<tr align='center'>";
						      echo "<td>".$i."</td>";$i++;
						      echo "<td>".$row->nim."</td>";
						      echo "<td>".$row->nama."</td>";
						      echo "<td>".$row->nama_lab."</td>";
						      if ($status=="petugas") {
						      echo "<td align='center'>
						          <a href='edit_lab1.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;

						         </td>";
						      }
						      // <a href='delete_penempatan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
						      echo "</tr>";
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
	include_once("footer.php");
?>
</body>
</html>
