<!DOCTYPE html>
<html>
<head>
	<title>Daftar Bimbingan TR1</title>
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
				<div class="panel-heading">Daftar Bimbingan TR1 
					<?php if ($status=='petugas'): ?>
						
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a  name="links" href="print_daftar_bimbingan_tr1.php"><button name="links" id="links" class="btn btn-info">Print</button></a>
					<?php endif ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead>
						    <tr>
						      <th>No</th>
						      <th>NIM</th>
						      <th>Mahasiswa</th>
						      <th>Pembimbing 1</th>
						      <th>Pembimbing 2</th>
						      <th>Pembimbing 3</th>
						      <?php
						        if ($status=="petugas")
						        echo "<th>Action</th>";
						      ?>
						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php
						    // Assign a query
						    if ($status=="petugas") {
						      $query = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip1 = dosen.nip  WHERE tr1.nip1 IS NOT NULL  ";
						      $query1 = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip2 = dosen.nip  ";
						      $query2 = "SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim LEFT JOIN dosen on tr1.nip3 = dosen.nip  ";
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
						      if (isset($row1->nama_dosen)) {
						      echo "<td align='center'>".$row1->nama_dosen."</td>";
						      }else {
						      echo "<td align='center'>-</td>";
						      }
						      $row2=$result2->fetch_object();
						      if (isset($row2->nama_dosen)) {
						      echo "<td align='center'>".$row2->nama_dosen."</td>";
						      }else{
						      echo "<td align='center'>-</td>";
						      }
						      if ($status=='petugas') {
						          echo "<td align='center'>
						          <a href='bimbingan_tr1.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;

						         </td>";
						        }
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
	include_once("footer.php");
?>
</body>
</html>
