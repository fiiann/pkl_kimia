<?php
	include_once('functions.php');
	$id=$_SESSION['sip_masuk_aja'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Judul PKT</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <title><?php $site_name ?></title> -->
  <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  </head>
  <body onload="window.print();">
    <div class="row" >
    	<div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    			   Daftar Mahasiswa yang mendaftar TR1
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Nama</th>
    								<!-- <th>SKS</th> -->
    								<!-- <th>Daftar</th> -->
    								<th>Pilihan 1</th>
    								<th>Pilihan 2</th>
    								<th>Pilihan 3</th>
    								<th>Pilihan 4</th>
    								<th>Pilihan 5</th>
    								<!-- <?php if (($status=="petugas")||($status=="lab")) {
    									echo "<th>Tempatkan</th>";
    									// echo "<th>Action</th>";
    								} ?> -->

    							</tr>
    						</thead>
    						<tbody id="hasil_anggota">
    						<?php
    							// Assign a query
    							if (($status=="petugas")||($status=="lab")||($status=="dosen")) {
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan1=lab.idlab LIMIT 10";
    								$query2 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan2=lab.idlab LIMIT 10";
    								$query3 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan3=lab.idlab LIMIT 10";
    								$query4 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan4=lab.idlab LIMIT 10";
    								$query5 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan5=lab.idlab LIMIT 10";
    							}elseif ($status=="anggota") {
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan1=lab.idlab WHERE m.nim='".$anggota->nim."' LIMIT 10";
    								$query2 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan2=lab.idlab WHERE m.nim='".$anggota->nim."' LIMIT 10";
    								$query3 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan3=lab.idlab WHERE m.nim='".$anggota->nim."' LIMIT 10";
    								$query4 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan4=lab.idlab WHERE m.nim='".$anggota->nim."' LIMIT 10";
    								$query5 = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan5=lab.idlab WHERE m.nim='".$anggota->nim."' LIMIT 10";
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
    							$result2 = $con->query( $query2 );
    							$result3 = $con->query( $query3 );
    							$result4 = $con->query( $query4 );
    							$result5 = $con->query( $query5 );
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
    								echo "<td align='center'>".$row->nama_lab."</td>";
    								$row2=$result2->fetch_object();
    								echo "<td align='center'>".$row2->nama_lab."</td>";
    								$row3=$result3->fetch_object();
    								echo "<td align='center'>".$row3->nama_lab."</td>";
    								$row4=$result4->fetch_object();
    								echo "<td align='center'>".$row4->nama_lab."</td>";
    								$row5=$result5->fetch_object();
    								echo "<td align='center'>".$row5->nama_lab."</td>";
    								// if (($status=="petugas")||($status=="lab")){
    								// 	echo "<td align='center'>
    								// 		<a href='edit_lab1.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;
    								// 	 </td>";
    								// 	// echo "<td align='center'>
    								// 	// 	<a href='delete_tr1.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
    								// 	//  </td>";
    								// }
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
  </body>
</html>

<?php
mysqli_close($con);
include_once('footer.php');
?>
