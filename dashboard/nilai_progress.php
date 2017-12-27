<!DOCTYPE html>
<html>
<head>
	<title>Daftar Nilai Progress</title>
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
					Daftar Nilai Progress
				</div>
				<div class="panel-body">
					<div class="table-responsive" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead>
						    <tr>
						      <th rowspan="2" align="center">No</th>
						      <th rowspan="2">NIM</th>
						      <th rowspan="2">Nama</th>
						      <th colspan="6">Nilai</th>
						      <th rowspan="2">Nilai Total</th>
						      <!-- <th rowspan="2">Nilai Huruf</th> -->
						      <?php if ($status=="petugas"||$status=="dosen") {
						        echo "<th rowspan='2'>Action</th>";
						      } ?>

						    </tr>
						    <tr>
						      <th>Bahasa, Format</th>
						      <th>Substansi</th>
						      <th>Penggunaan Media</th>
						      <th>Penguasaan Materi</th>
						      <th>Penguasaan Analisis</th>
						      <th>Penguasaan Pengetahuan</th>
						      <!-- <th>Huruf</th> -->
						    </tr>
						  </thead>
						  <tbody id="hasil_anggota">
						  <?php
						    // Assign a query
						    if ($status=="petugas") {
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE nilai_progress IS NOT NULL ORDER BY nama ";
						    }elseif ($status=="dosen"){
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.dosen_pembimbing='".$dosen->nip."' AND p.nilai_huruf IS NOT NULL";
						    }elseif ($status=="lab"){
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN lab l ON p.flag_lab=l.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.nilai_huruf IS NOT NULL";
						    }else{
						      $query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
						    }

						    // Execute the query
						    $result = $con->query( $query );
						    if(!$result){
						      die('Could not connect to database : <br/>'.$con->error);
						    }
						    $i=1;
						    // $row = $result->fetch_object();
						    // $nim=$row->nim;
						    while($row = $result->fetch_object()){
						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=8";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_bahasa=$row1->nilai;

						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=9";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_substansi=$row1->nilai;

						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=10";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_media=$row1->nilai;

						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=11";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_materi=$row1->nilai;

						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=13";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_analisis=$row1->nilai;

						      $query1="SELECT nilai FROM tr1 p LEFT JOIN nilai_tr1 ON p.id_tr1=nilai_tr1.id_tr1	WHERE p.nim=$row->nim and id_komponen_tr1=12";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_pengetahuan=$row1->nilai;

						      $query1="SELECT nilai FROM final_tr1 p WHERE p.id_tr1=$row->id_tr1 and id_kategori=2";
						      $result1 = $con->query( $query1 );
						      $row1=$result1->fetch_object();
						      $nilai_total=$row1->nilai;


						      echo "<tr>";
						      echo "<td>".$i."</td>";$i++;
						      echo "<td>".$row->nim."</td>";
						      echo "<td>".$row->nama."</td>";
						      echo "<td align='center'>".$nilai_bahasa."</td>";
						      echo "<td align='center'>".$nilai_substansi."</td>";
						      echo "<td align='center'>".$nilai_media."</td>";
						      echo "<td align='center'>".$nilai_materi."</td>";
						      echo "<td align='center'>".$nilai_analisis."</td>";
						      echo "<td align='center'>".$nilai_pengetahuan."</td>";
						      echo "<td align='center'>".$nilai_total."</td>";
						      // echo "<td align='center'>".$row->nilai_huruf."</td>";
						      if ($status=="petugas"||$status=="dosen"){
						        echo "<td align='center'>
						            <a href='input_nilai_progress.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;</td>";
						      }

						      echo "</tr>";
						      // <a href='delete_nilaipkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
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
