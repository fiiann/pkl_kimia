<!DOCTYPE html>
<html>
<head>
	<title>Penempatan Lab</title>
	<!-- <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script> -->
</head>
<?php
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	// require_once('db_login.php');
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);
?>
<script type="text/javascript">
	$(document).ready(function(){
    $('#tabelku').DataTable();
});
</script>
<body>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					 Distribusi Pembimbing PKT
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
							<thead align="center">
								<tr align="center">
									<th>No</th>
									<th>Nama</th>
									<th>NIM</th>
									<?php if (($status=="petugas")||($status=="lab")) {
										echo '	<th>Bimbingan</th>';
									}elseif ($status=="anggota") {
										echo '<th>Judul</th>
										<th>Lab</th>
										<th>Dosen</th>';
									}else {
										echo '<th>Judul</th>';
									}
									?>

								</tr>
							</thead>
							<tbody >
							<?php

								if (($status=="petugas")) {
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip	WHERE p.dosen_pembimbing IS NULL ORDER BY nama   ";
								}elseif ($status=="anggota"){
									$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip WHERE m.nim='".$anggota->nim."'";
								}elseif ($status=="dosen"){
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip WHERE d.nip='".$dosen->nip."' ORDER BY nama   ";
								}elseif($status=='lab') {
									$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip	WHERE p.dosen_pembimbing IS NULL AND p.flag_lab=$lab->idlab ORDER BY nama   ";
								}
								//$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
								$result = $con->query( $query );
								if(!$result){
									die('Could not connect to database : <br/>'.$con->error);
								}
								$i=1;
								while($row = $result->fetch_object()){
									echo "<tr align='center'>";
									echo "<td>".$i."</td>";$i++;
									echo "<td>".$row->nama."</td>";
									echo "<td>".$row->nim."</td>";
									// echo "<td>".$row->nama_wali."</td>";
									// echo "<td>".$row->angkatan."</td>";

									if ($status=="anggota") {
										echo "<td>".$row->judul."</td>";
										echo "<td>".$row->flag_lab."</td>";
										echo "<td>".$row->nama_dosen."</td>";
										echo "<td>".$row->nilai_huruf."</td>";
										// echo "<td align='center'>
										// 	<a href='edit_daftar_pkt.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
										//  </td>";
									}elseif ($status=="petugas") {
										if($row->dosen_pembimbing == null){
											echo "<td align='center'><a href='bimbingan.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Bimbingan</a></td>";
										}else {
											echo "<td>".$row->nama_dosen."</td>";
										}


									}elseif ($status=="dosen") {
										if ($row->judul == null) {
											echo "<td>
													<a href='input_judul_pkt.php?nim=".$row->nim."'><button class='btn btn-info'>Input Judul PKT</button></a>
												 </td>";
										}else {
											echo "<td>".$row->judul."</td>";
										}
										if($row->nilai_huruf == null){
											echo "<td align='center'><a href='input_nilai_pkt.php?nim=".$row->nim."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
										}else {
											echo "<td>".$row->nilai_huruf."</td>";
										}
									}elseif ($status=="lab") {
										// if($row->flag_lab == null){
										// 	echo "<td align='center'><a href='edit_lab.php?nim=".$row->nim."' class='btn btn-info btn-s' role='button'>Tempatkan</a></td>";
										// }else {
										// 	echo "<td>".$row->flag_lab."</td>";
										// }
										if($row->dosen_pembimbing == null){
											echo "<td align='center'><a href='bimbingan.php?nim=".$row->nim."' class='btn btn-info btn-s' role='button'>Bimbingan</a></td>";
										}else {
											echo "<td>".$row->nama_dosen."</td>";
										}
										// if($row->nilai_huruf == null){
										// 	echo "<td align='center'><a href='input_nilai_pkt.php?nim=".$row->nim."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
										// }else {
										// 	echo "<td>".$row->nilai_huruf."</td>";
										// }
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
