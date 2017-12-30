<!DOCTYPE html>
<html>
<head>
	<title>Daftar Distribusi Pembimbing PKT</title>
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
					 Daftar Distribusi Pembimbing 
					<?php if ($status=='petugas'): ?>
						&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a  name="links" href="print_daftar_bimbingan.php"><button name="links" id="links" class="btn btn-info">Print</button></a>
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
										<th>Pembimbing</th>
										<th>Lab</th>
										<?php
											if (($status=="petugas") ||($status=="lab")){
											echo "<th>Action</th>";
										}
										?>
									</tr>
								</thead>
								<tbody id="hasil_cari">
								<?php
									// Assign a query
									if ($status=="petugas") {
										$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN dosen on pkt.dosen_pembimbing = dosen.nip INNER JOIN lab ON pkt.flag_lab=lab.idlab ORDER BY nama  ";
									}elseif ($status=="anggota"){
										$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN dosen on pkt.dosen_pembimbing=dosen.nip WHERE mahasiswa.nim='".$anggota->nim."'";
									}elseif ($status=="dosen"){
										$query = "SELECT * FROM pkt p INNER JOIN mahasiswa ON p.nim=mahasiswa.nim INNER JOIN dosen on p.dosen_pembimbing=dosen.nip INNER JOIN lab ON p.flag_lab=lab.idlab WHERE p.dosen_pembimbing='".$dosen->nip."'";
									}elseif ($status=="lab"){
										$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN dosen on pkt.dosen_pembimbing = dosen.nip INNER JOIN lab ON pkt.flag_lab=lab.idlab WHERE pkt.flag_lab=$lab->idlab ORDER BY nama ";
										// $query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim INNER JOIN dosen on pkt.dosen_pembimbing=dosen.nip WHERE pkt.flag_lab='".$lab->nama_lab."'";
									}

									// Execute the query
									$result = $con->query( $query );
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
										echo "<td>".$row->nama_lab."</td>";
										if (($status=="petugas") ||($status=="lab")){
												echo "<td align='center'>
												<a href='bimbingan.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;

											 </td>";
											}
										// <a href='delete_bimbingan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
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
