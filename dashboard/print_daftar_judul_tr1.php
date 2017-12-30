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
    			   Judul tr1
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Nama</th>
    								<th>Pembimbing</th>
    								<th>Judul tr1</th>
    								<!-- <?php
    								if (($status=='petugas')||($status=='dosen')) {
    									echo "<th>Action</th>";
    								}
    								?> -->



    							</tr>
    						</thead>
    						<tbody id="hasil_cari">
    						<?php
    							// Assign a query
    							if($status=="petugas"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen ON tr1.nip1=dosen.nip WHERE tr1.judul IS NOT NULL ORDER BY tr1.nim  LIMIT 10";
    							}elseif ($status=="dosen") {
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen ON tr1.nip1=dosen.nip WHERE tr1.nip1='".$dosen->nip."' AND tr1.judul IS NOT NULL LIMIT 10";
    							}elseif ($status=="lab"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim INNER JOIN lab on tr1.idlab_tr1=lab.idlab INNER JOIN dosen on tr1.nip1=dosen.nip WHERE tr1.idlab_tr1='".$lab->idlab."' LIMIT 10";
    							}elseif ($status=="anggota"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen ON tr1.nip1=dosen.nip WHERE mahasiswa.nim='".$anggota->nim."' LIMIT 10";
    							}

                  echo $lab->idlab;
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
