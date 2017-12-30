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
    			   Nilai TR1 Progress
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th rowspan="2">No</th>
    								<th rowspan="2">NIM</th>
    								<th rowspan="2">Nama</th>
    								<th colspan="6">Nilai</th>
                    <th rowspan="2">Nilai Total</th>
                    <!-- <th rowspan="2">Nilai Huruf</th> -->
    								<!-- <?php if ($status=="petugas"||$status=="dosen") {
    									echo "<th rowspan='2'>Action</th>";
    								} ?> -->

    							</tr>
    							<tr>
    								<th>Bahasa & Format</th>
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
    								$query = "SELECT * FROM tr1 p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nilai_progress IS NOT NULL ORDER BY nama ";
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
    								// if ($status=="petugas"||$status=="dosen"){
    								// 	echo "<td align='center'>
    								// 			<a href='input_nilai_progress.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;</td>";
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
