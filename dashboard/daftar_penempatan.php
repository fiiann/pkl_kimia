<!DOCTYPE html>
<html>
<head>
	<title>Daftar Penempatan</title>
	<!-- <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script> -->
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
					 Penempatan Laboratorium <?php if ($status=='lab'):echo $lab->nama_lab; ?>

					 <?php endif; ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th>
									<?php
										if ($status=="petugas") {
											echo "<th>Lab</th>";
											echo "<th>Action</th>";
										}elseif ($status=='dosen') {
											echo "<th>Lab</th>";
										}
										?>
								</tr>
							</thead>
							<tbody id="hasil_cari">
							<?php
								// Assign a query
								if (($status=="petugas")) {
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab ON p.flag_lab=lab.idlab WHERE p.flag_lab IS NOT NULL ORDER BY lab.idlab LIMIT 10";
								}
								elseif ($status=="dosen"){
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab l ON p.flag_lab=l.idlab LEFT JOIN dosen ON p.dosen_pembimbing=dosen.nip WHERE p.flag_lab='".$dosen->idlab."'";
								}
								elseif ($status=="lab"){
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.flag_lab='".$lab->idlab."'";
								}
								else {
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
								}

								// Execute the query
								$result = $con->query( $query );
								if(!$result){
									die('Could not connect to database : <br/>'.$con->error);
								}
								$i=1;
								while($row = $result->fetch_object()){
									$nim=$row->nim;
									echo "<tr align='center'>";
									echo "<td>".$i."</td>";$i++;
									echo "<td>".$nim."</td>";
									echo "<td>".$row->nama."</td>";
									// echo "";
									if ($status=="petugas") {
									echo "<td>".$row->nama_lab."</td><td align='center'>
											<a href='edit_lab.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;
										 </td>";
									}elseif ($status=='dosen') {
										echo "<td>".$row->nama_lab."</td>";
									}
									// <a href='delete_penempatan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
									echo "</tr>";
								}
								$row = $result->fetch_object();
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

?>
</body>
</html>
