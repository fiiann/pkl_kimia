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
    	</div>
    </div>
    <!-- /. ROW  -->
    <div class="row" >
    	<div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    			   Daftar Bimbingan TR1
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Mahasiswa</th>
    								<th>Pembimbing 1</th>
    								<th>Pembimbing 2</th>
    								<th>Pembimbing 3</th>
    								<!-- <?php
    									if ($status=="petugas")
    									echo "<th>Action</th>";
    								?> -->
    							</tr>
    						</thead>
    						<tbody id="hasil_cari">
    						<?php
    							// Assign a query
    							if ($status=="petugas") {
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip1 = dosen.nip  WHERE tr1.nip1 IS NOT NULL LIMIT 10";
    								$query1 = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip2 = dosen.nip LIMIT 10";
    								$query2 = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip3 = dosen.nip LIMIT 10";
    								// $query1 = "SELECT * FROM tr1 INNER JOIN dosen on tr1.nip2 = dosen.nip";
    								// $query2 = "SELECT * FROM tr1 INNER JOIN dosen on tr1.nip3 = dosen.nip";
    							}elseif ($status=="anggota"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip1=dosen.nip WHERE mahasiswa.nim='".$anggota->nim."'";
    							}elseif ($status=="dosen"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip1=dosen.nip WHERE tr1.nip1='".$dosen->nip."'";
    								$query1 = "SELECT * FROM tr1 LEFT JOIN dosen on tr1.nip2 = dosen.nip WHERE tr1.nip2='".$dosen->nip."'";
    								$query2 = "SELECT * FROM tr1 LEFT JOIN dosen on tr1.nip3 = dosen.nip WHERE tr1.nip3='".$dosen->nip."'";
    							}elseif ($status=="lab"){
    								$query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip1=dosen.nip WHERE tr1.idlab_tr1='".$lab->idlab."'";
    								$query2 = "SELECT * FROM tr1 LEFT JOIN dosen on tr1.nip3 = dosen.nip WHERE tr1.idlab_tr1='".$lab->idlab."'";
    								$query1 = "SELECT * FROM tr1 LEFT JOIN dosen on tr1.nip2 = dosen.nip WHERE tr1.idlab_tr1='".$lab->idlab."' ";
    							}

    							// Execute the query
    							$result = $con->query( $query );
    							$result1 = $con->query( $query1 );
    							$result2 = $con->query( $query2 );
    							if(!$result){
    								die('Could not connect to database : <br/>'.$con->error);
    							}
    							$i=1;
    							while($row = $result->fetch_object()){
    								echo "<tr align='center'>";
    								echo "<td>".$i."</td>";$i++;
    								echo "<td>".$row->nim."</td>";
    								echo "<td>".$row->nama."</td>";
    								echo "<td>".$row->nama_dosen."</td>";
    								$row1=$result1->fetch_object();
    								echo "<td align='center'>".$row1->nama_dosen."</td>";
    								$row2=$result2->fetch_object();
    								echo "<td align='center'>".$row2->nama_dosen."</td>";


    								// if ($status=='petugas') {
    								// 		echo "<td align='center'>
    								// 		<a href='bimbingan_tr1.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;
                    //
    								// 	 </td>";
    								// 	}
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
