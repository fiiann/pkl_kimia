<!DOCTYPE html>
<html>
<head>
	<title>Daftar Mahasiswa Lulus PKT</title>
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
					 Daftar Mahasiswa Lulus PKT
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead>
						    <tr>
						      <th>No</th>
						      <th>NIM</th>
						      <th>Nama</th>
						    </tr>
						  </thead>
						  <tbody id="hasil_anggota">
						  <?php
						    // Assign a query
						    if (($status=="petugas")||($status=="lab")||($status=="dosen")) {
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  LIMIT 10";

						    }elseif ($status=="anggota") {
						      $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim WHERE m.nim='".$anggota->nim."'";

						      // $query = " SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim WHERE m.nim='".$anggota->nim."'";
						    }
						    // elseif ($status=="dosen") {
						      // $query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan1=lab.idlab WHERE t.nip1='".$dosen->nip."' LIMIT 10";
						      // $query2 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan2=lab.idlab WHERE t.nip1='".$dosen->nip."' LIMIT 10";
						      // $query3 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan3=lab.idlab WHERE t.nip1='".$dosen->nip."' LIMIT 10";
						      // $query4 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan4=lab.idlab WHERE t.nip1='".$dosen->nip."' LIMIT 10";
						      // $query5 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan5=lab.idlab WHERE t.nip1='".$dosen->nip."' LIMIT 10";
						      // $query = " SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim INNER JOIN dosen on anggota.id_wali=dosen.id_wali WHERE anggota.id_wali='".$dosen->id_wali."'";
						    // }
						    // $query = "SELECT * FROM t INNER JOIN anggota ON t.nim=anggota.nim ORDER BY nama LIMIT 10";
						    // Execute the query
						    $result = $con->query( $query );

						    if(!$result){
						      die('Could not connect to database : <br/>'.$con->error);
						    }
						    $i=1;
						    while($row = $result->fetch_object()){
						      echo "<tr>";
						      echo "<td>".$i."</td>";$i++;
						      echo "<td>".$row->nim."</td>";
						      echo "<td>".$row->nama."</td>";
						      //echo "<td>".$row->komulatif."</td>";
						      // echo "<td>".$row->sks."</td>";
						      //echo "<td>".$row->krs."</td>";
						      // echo "<td>".$row->tanggal_daftar."</td>";

						      // <a href='edit_t.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
						      // <a href='input_nilai_tr1.php?nim=".$row->nim."'><button class='btn btn-info'>Input Nilai</button></a>
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

?>
</body>
</html>
