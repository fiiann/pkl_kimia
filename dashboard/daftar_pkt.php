<!DOCTYPE html>
<html>
<head>
	<title>Penempatan Lab PKT</title>
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
<style type="text/css">
	a.links {
		padding-right: 1em;
	}

</style>

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
					 Pilihan Laboratorium Mahasiswa 
					 <?php if ($status =='petugas'): ?>
					 	
					 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								<a  name="links" href="print_daftar_pkt.php"><button name="links" id="links" class="btn btn-info">Print</button></a>
					 <?php endif ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php if ($status!='anggota'): echo '<table class="table table-striped table-bordered table-hover" id="tabelku">'; ?>
							<?php else: echo '<table class="table table-striped table-bordered table-hover">';?>
						<?php endif ?>
						
							<thead align="center">
								<tr align="center">
									<th rowspan="2">No</th>
									<th rowspan="2">NIM</th>
									<th rowspan="2">NAMA</th>
									<!-- <th>Wali</th>
									<th>Angkatan</th> -->
									<th colspan="3" align="center">Laboratorium</th>
									<!-- <th rowspan="2">Penempatan</th>
									<th rowspan="2">Bimbingan</th>
									<th rowspan="2">Nilai</th> -->
									<?php if (($status=='petugas')||($status=='lab')): ?>

										<th rowspan="2">Edit</th>
										<th rowspan="2">Hapus</th>
									<?php endif; ?>
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

								if (($status=="petugas")||($status=="lab")||($status=='dosen')) {
									$query = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab1=lab.idlab ";
									$query2 = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab2=lab.idlab ";
									$query3 = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab3=lab.idlab ";
								}elseif ($status=="anggota"){
									$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab1=d.idlab WHERE m.nim='".$anggota->nim."'";
									$query2 = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab2=d.idlab WHERE m.nim='".$anggota->nim."'";
									$query3 = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab3=d.idlab WHERE m.nim='".$anggota->nim."'";
								}
								// elseif ($status=="dosen"){
								// 	$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip ORDER BY nama ";
								// }
								//$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
								$result = $con->query( $query );
								$result2 = $con->query( $query2 );
								$result3 = $con->query( $query3 );
								if(!$result){
									die('Could not connect to database : <br/>'.$con->error);
								}
								$i=1;
								while($row = $result->fetch_object()){
									echo "<tr align='center'>";
									echo "<td>".$i."</td>";$i++;

									echo "<td>".$row->nim."</td>";
									echo "<td>".$row->nama."</td>";
									// echo "<td>".$row->nama_wali."</td>";
									// echo "<td>".$row->angkatan."</td>";
									echo "<td>".$row->nama_lab."</td>";
									$row2=$result2->fetch_object();
									echo "<td align='center'>".$row2->nama_lab."</td>";
									$row3=$result3->fetch_object();
									echo "<td align='center'>".$row3->nama_lab."</td>";
									if (($status=="petugas")||($status=="lab")){
										echo "<td align='center'>
											<a href='edit_daftar_pkt.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;
										 </td>";
										 echo "<td align='center'>
	 										<a href='delete_pkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
	 									 </td>";
									}
									echo "</tr>";
	//
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
