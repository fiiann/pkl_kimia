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
			Daftar Judul PKT <br>
			Departemen Kimia Universitas Diponegoro <br>
    	<div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-default">
    			<!-- <div class="panel-heading">
    			   Judul PKT
    			</div> -->
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Nama</th>
    								<th>Pembimbing</th>
    								<th>Judul PKT</th>
    								<?php
    								// if (!(($status=="anggota")||($status=="lab"))) {
    								// 	echo "<th>Action</th>";
    								// }
    								?>



    							</tr>
    						</thead>
    						<tbody id="hasil_cari">
    						<?php
    							// Assign a query
    							if($status=="petugas"){
    								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim LEFT JOIN dosen ON pkt.dosen_pembimbing=dosen.nip WHERE pkt.judul IS NOT NULL ORDER BY pkt.flag_lab  LIMIT 10";
    							}elseif ($status=="dosen") {
    								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim LEFT JOIN dosen ON pkt.dosen_pembimbing=dosen.nip WHERE pkt.dosen_pembimbing='".$dosen->nip."' and pkt.judul is not null order by pkt.nim limit 10";
    							}elseif ($status=="lab"){
    								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN lab on pkt.flag_lab=lab.idlab INNER JOIN dosen on pkt.dosen_pembimbing=dosen.nip WHERE pkt.flag_lab='".$lab->idlab."' AND pkt.judul IS NOT NULL LIMIT 10";
    							}elseif ($status=="anggota"){
    								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN dosen ON pkt.dosen_pembimbing=dosen.nip WHERE mahasiswa.nim='".$anggota->nim."'";
    							}


    							// Execute the query
    							$result = $con->query( $query );
    							if(!$result){
    								die('Could not connect to database : <br/>'.$con->error);
    							}
    							$i=1;
    							while($row = $result->fetch_object()){
    								echo "<tr align='left'>";
    								echo "<td>".$i."</td>";$i++;
    								echo "<td>".$row->nim."</td>";
    								echo "<td>".$row->nama."</td>";
    								echo "<td>".$row->nama_dosen."</td>";

    									echo "<td>".$row->judul."</td>";



    								if (!(($status=="anggota")||($status=="lab"))) {
    								// echo "<td align='center'>
    								// 		<a href='input_judul_pkt.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;
                    //
    								// 	 </td>";
    								}
    								//// <a href='delete_judul_pkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
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
