<?php
	require_once('../functions.php');

	if(!isset($_SESSION['sip_masuk_aja'])){
	  header("Location:./login.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Form Daftar PKT</title>
		<link href="../assets/css/bootstrap.css" rel="stylesheet" />
		<link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
     <!-- G(OOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'
	</head>
	<body onload="window.print(); window.close();">

		<div class="panel-body">
			<h5>PENDAFTARAN PRAKTIKUM KIMIA TERPADU</h5>
			<h5>SEMESTER GENAP TAHUN AKADEMIK 2016/2017</h5>
			<h5>DEPARTEMEN KIMIA FAKULTAS SAINS DAN MATEMATIKA</h5>
			<h5>UNIVERSITAS DIPONEGORO SEMARANG</h5>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead align="center">
						<tr align="center">
							<th rowspan="2">
								<div>
						        <p>No</p>
						    </div>
							</th>
							<th rowspan="2">
								<div>
						        <p>Nama</p>
						    </div>
							</th>
							<th rowspan="2">
								<div>
										<p>NIM</p>
								</div>
							</th>

							<th colspan="3" align="center">Laboratorium</th>
							<th rowspan="2">
						    <div>
						        <p>ttd</p>
						    </div>
							</th>
							<!-- <th rowspan="2" align="center">Action</th> -->
						</tr>
						<tr>
							<!-- <th>Wali</th>
							<th>Angkatan</th> -->
							<th>Pilihan 1</th>
							<th>Pilihan 2</th>
							<th>Pilihan 3</th>
						</tr>
					</thead>
					<tbody id="hasil_cari">
					<?php

						if (($status=="petugas")||($status=="lab")) {
							$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim ORDER BY nama LIMIT 10";
						}elseif ($status=="anggota"){
							$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE m.nim='".$anggota->nim."'";
						}elseif ($status=="dosen"){
							$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim ORDER BY nama LIMIT 10";
						}
						//$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
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
							// echo "<td>".$row->nama_wali."</td>";
							// echo "<td>".$row->angkatan."</td>";
							echo "<td>".$row->pilihan_lab1."</td>";
							echo "<td>".$row->pilihan_lab2."</td>";
							echo "<td>".$row->pilihan_lab3."</td>";
							echo "<td></td>";
							echo "</tr>";

						}
					?>
					</tbody>
				</table>
			</div>
		</div>

	</body>
</html>
