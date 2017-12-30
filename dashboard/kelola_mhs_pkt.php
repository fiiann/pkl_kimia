<!DOCTYPE html>
<html>
<head>
	<title>Kelola Mahasiswa PKT</title>
	<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<!-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<script src="assets/js/datatables.js" type="text/javascript"></script>
</head> 
<?php
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	// require_once('db_login.php');
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);
?>
<?php if ($status!='anggota'): ?>
	
<script type="text/javascript">
	$(document).ready(function(){
    $('#tabelku').DataTable();
});
</script>
<?php endif ?>
<body>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
							<?php if ($status!='anggota'): echo "Kelola PKT"; ?>
							<?php else: echo "Status Mahasiswa"; ?>
							<?php endif; ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead align="center">
						    <tr align="center">
						      <th>No</th>
						      <th>Nama</th>
						      <th>NIM</th>
									<?php if (($status=="petugas")) {
						        echo '<th>Penempatan</th>
						        <th>Bimbingan</th>';
						      }elseif ($status=="anggota") {
						        echo '<th>Judul</th>
						        <th>Lab</th>
						        <th>Dosen</th>';
						      }elseif ($status=='dosen') {
						        echo '<th>Judul</th>';
						      }else {
						        echo '<th>Bimbingan</th>';
						      }
						      ?>
						      <?php if($status!="lab"){
						          echo '<th>Nilai</th>';
						      } ?>


						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php

						    if (($status=="petugas")) {
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip	LEFT JOIN lab ON p.flag_lab=lab.idlab WHERE p.nilai_huruf IS NULL ORDER BY nama ";
						    }elseif ($status=="anggota"){
						      $query = " SELECT * FROM pkt p LEFT JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip LEFT JOIN lab ON p.flag_lab=lab.idlab WHERE m.nim='".$anggota->nim."'";
						    }elseif ($status=="dosen"){
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip WHERE d.nip='".$dosen->nip."' AND p.nilai_huruf IS NULL ORDER BY nama ";
						    }elseif($status=='lab') {
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip LEFT JOIN lab ON p.flag_lab=lab.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.dosen_pembimbing IS NULL ORDER BY nama ";
						    }
						    //$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
						    $result = $con->query( $query );
						    if(!$result){
						      die('Could not connect to database : <br/>'.$con->error);
						    }
						    $i=1;
						    while($row = $result->fetch_object()){
						      echo "<tr align='left'>";
						      echo "<td>".$i."</td>";$i++;
						      echo "<td>".$row->nama."</td>";
						      echo "<td>".$row->nim."</td>";
						      // echo "<td>".$row->nama_wali."</td>";
						      // echo "<td>".$row->angkatan."</td>";

						      if ($status=="anggota") {
						        echo "<td>".$row->judul."</td>";
						        echo "<td>".$row->nama_lab."</td>";
						        echo "<td>".$row->nama_dosen."</td>";
						        echo "<td>".$row->nilai_huruf."</td>";
						        // echo "<td align='center'>
						        // 	<a href='edit_daftar_pkt.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
						        //  </td>";
						      }elseif ($status=="petugas") {
						        if(($row->flag_lab == null) ){
						          echo "<td align='center'><a href='edit_lab.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Tempatkan</a></td>";
						        }else {
						          echo "<td>".$row->nama_lab."</td>";
						        }
						        if($row->dosen_pembimbing == null){
						        	if ($row->flag_lab == null) {
						          echo "<td align='center'><a disabled href='bimbingan.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Bimbingan</a></td>";
						        	} else {
						        		echo "<td align='center'><a href='bimbingan.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Bimbingan</a></td>";
						        	}
						        	
						        }else {
						          echo "<td>".$row->nama_dosen."</td>";
						        }

						        if($row->nilai_huruf == null){
						        	if ($row->dosen_pembimbing == null) {
						          	echo "<td align='center'><a disabled href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
						        	} else {
						          	echo "<td align='center'><a href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
						        	}
						        }else {
						          echo "<td>".$row->nilai_huruf."</td>";
						        }
						      }elseif ($status=="dosen") {
						        if ($row->judul == null) {
						          echo "<td>
						              <a href='input_judul_pkt.php?id=".$row->id_pkt."'><button class='btn btn-info'>Input Judul PKT</button></a>
						             </td>";
						        }else {
						          echo "<td align='left'>".$row->judul."</td>";
						        }
						        if($row->nilai_huruf == null){
						        	if ($row->judul == null) {
						          echo "<td align='center'><a disabled href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
						        		# code...
						        	} else {
						          echo "<td align='center'><a href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
						        		# code...
						        	}
						        	
						        }else {
						          echo "<td>".$row->nilai_huruf."</td>";
						        }
						      }elseif ($status=="lab") {
						        if($row->dosen_pembimbing == null){
						          echo "<td align='center'><a href='bimbingan.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Bimbingan</a></td>";
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
