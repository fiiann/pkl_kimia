<!DOCTYPE html>
<html>
<head>
	<title>Daftar Nilai TR1</title>
	<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
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
					Daftar Nilai TR1
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead align="center">
						    <tr align="center">
						      <th>No</th>
						      <th>Nama</th>
						      <th>NIM</th>
						      <?php 
						        echo '	<th>Nilai Outline</th>';
						        echo '	<th>Nilai Progress</th>';
						        echo '	<th>Nilai TR1</th>';
						      ?>

						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php

						    if (($status=="petugas")) {
							      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.nip1=d.nip	WHERE p.nilai_tr1 IS NOT NULL ORDER BY m.nim   ";
							    }elseif ($status=="anggota"){
							      $query = " SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.nip1=d.nip WHERE m.nim='".$anggota->nim."'";
							    }elseif ($status=="dosen"){
							      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.nip1=d.nip WHERE p.nip1='".$dosen->nip."' ORDER BY nama   ";
							    }elseif($status=="lab") {
							      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.nip1=d.nip INNER JOIN lab ON p.idlab_tr1=lab.idlab WHERE p.idlab_tr1='".$lab->idlab."'";
						    }
						    $result = $con->query( $query );
						    if(!$result){
						      die('Could not connect to database : <br/>'.$con->error);
						    }
						    $i=1;
						    while($row = $result->fetch_object()){
						      echo "<tr align='center'>";
						      echo "<td>".$i."</td>";$i++;
						      echo "<td>".$row->nama."</td>";
						      echo "<td>".$row->nim."</td>";
						      echo "<td>".$row->nilai_outline."</td>";
						      echo "<td>".$row->nilai_progress."</td>";
						      echo "<td>".$row->nilai_tr1."</td>";
						    }
						      echo "</tr>";
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
