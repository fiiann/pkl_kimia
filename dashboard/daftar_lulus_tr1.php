<!DOCTYPE html>
<html>
<head>
	<title>Daftar Mahasiswa Lulus TR 1</title>
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
					Daftar Mahasiswa Lulus TR 1
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
						      <th>Pembimbing</th>
						      <th>Nilai</th>
						      <!-- <th>Semester</th> -->
						      <!-- <th>Periode</th> -->
						      <!-- <?php
						        // if ($status=="petugas") {
						        // 	echo "<th>Action</th>";
						        // }
						        ?> -->
						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php
						    // Assign a query
						    if ($status=="petugas") {
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON p.nip1=d.nip INNER JOIN lab ON p.idlab_tr1=lab.idlab WHERE p.nilai_tr1<>0 ORDER BY m.nama";
						    }elseif ($status=="dosen"){
						      $query= "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON p.nip1=d.nip INNER JOIN lab ON p.idlab_tr1=lab.idlab WHERE p.nilai_tr1<>0 AND p.nip1='".$dosen->nip."' ORDER BY m.nama";
						      // $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  INNER JOIN lab l ON p.flag_lab=l.nama_lab WHERE p.dosen_pembimbing='".$dosen->nip."'";
						    }elseif ($status=="lab"){
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON p.nip1=d.nip INNER JOIN lab ON p.idlab_tr1=lab.idlab WHERE p.idlab_tr1='".$lab->idlab."' AND p.nilai_huruf IS NOT NULL";
						    }else {
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.nim='".$anggota->nim."'";
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
						      echo "<td>".$row->nama_dosen."</td>";
						      echo "<td>".$row->nilai_huruf."</td>";
						      // echo "<td>".$row->smt."</td>";
						      // echo "<td>".$row->periode."</td>";
						      // echo "<td>".$row->periode_lulus."</td>";
						      // if ($status=="petugas") {
						      // echo "<td align='center'>
						      // 		<a href='edit_lab.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
						      //
						      // 	 </td>";
						      // }
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
	include_once('footer.php');

?>
</body>
</html>
