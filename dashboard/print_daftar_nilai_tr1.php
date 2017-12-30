<?php
	include_once('functions.php');
	$id=$_SESSION['sip_masuk_aja'];
    if($status!="petugas"){
      header('Location:./index.php');
    }
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
						Daftar Nilai TR1  <br>
					 Departemen Kimia Universitas Diponegoro <br>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Nama</th>
                                    <th>Nilai Outline</th>
                                    <th>Nilai Progress</th>
    								<th>Nilai TR 1</th>
    								<!-- <?php if ($status=="petugas"||$status=="dosen") {
    									echo "<th rowspan='2'>Action</th>";
    								} ?> -->

    							</tr>
    						</thead>
    						<tbody id="hasil_anggota">
    						<?php
    							// Assign a query
    							if ($status=="petugas") {
    								$query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nilai_huruf IS NOT NULL ORDER BY nama  ";

    							}elseif ($status=="dosen"){
    								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.dosen_pembimbing='".$dosen->nip."' AND p.nilai_huruf IS NOT NULL";
    							}elseif ($status=="lab"){
    								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN lab l ON p.flag_lab=l.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.nilai_huruf IS NOT NULL";
    							}else{
    								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
    							}

    							// Execute the query
    							$result = $con->query( $query );
    							if(!$result){
    								die('Could not connect to database : <br/>'.$con->error);
    							}
    							$i=1;
    							$nim=$row->nim;
    							// $row=$result->fetch_object();
    							// $nilai_akhir=$row->nilai_praktikum;
    							while($row = $result->fetch_object()){

    								echo "<tr>";
    								echo "<td>".$i."</td>";$i++;
    								echo "<td>".$row->nim."</td>";
    								echo "<td>".$row->nama."</td>";
                                    echo "<td align='center'>".$row->nilai_outline."</td>";
                                    echo "<td align='center'>".$row->nilai_progress."</td>";
    								echo "<td align='center'>".$row->nilai_tr1."</td>";
    								// if ($status=="petugas"||$status=="dosen"){
    								// 	echo "<td align='center'>
    								// 			<a href='input_nilai_pkt1.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;</td>";
    								// }

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
  </body>
</html>

<?php
mysqli_close($con);
include_once('footer.php');
?>
