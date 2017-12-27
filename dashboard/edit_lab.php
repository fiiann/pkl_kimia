<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	require_once('sidebar.php');
	if(($status=="anggota")||($status=="dosen")){
		header('Location:./index.php');
	}

	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$errorLab='';


	$sukses=TRUE;
	$id_pkt=$_GET['id'];
	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id']==""){
			header('Location:./daftar_pkt.php');
		}
		$id_pkt=$_GET['id'];
		$query = " SELECT * FROM pkt INNER JOIN lab ON pkt.pilihan_lab1=lab.idlab left join mahasiswa on pkt.nim=mahasiswa.nim WHERE id_pkt='".$id_pkt."'" ;
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$nama=$row->nama;
				$lab = $row->flag_lab;
				$pilihan1 = $row->nama_lab;
				$id1 = $row->idlab;
				$query2 = " SELECT * FROM pkt INNER JOIN lab ON pkt.pilihan_lab2=lab.idlab WHERE id_pkt='".$id_pkt."'" ;
				// Execute the query
				$result2 = $con->query( $query2 );
				$row2 = $result2->fetch_object();
				$pilihan2 = $row2->nama_lab;
				$id2 = $row2->idlab;
				$query3 = " SELECT * FROM pkt INNER JOIN lab ON pkt.pilihan_lab3=lab.idlab WHERE id_pkt='".$id_pkt."'" ;
				// Execute the query
				$result3 = $con->query( $query3 );
				$row3 = $result3->fetch_object();
				$pilihan3 = $row3->nama_lab;
				$id3 = $row3->idlab;
				$pilihan3 = $row3->nama_lab;
			}
		}
	}else{

		// Cek Nama
		// $nim=test_input($_POST['nim']);
		$lab=test_input($_POST['lab']);
		if ($lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}



		// jika tidak ada kesalahan input
		if ($validLab) {

			$lab=$con->real_escape_string($lab);

			$query = "UPDATE pkt SET  flag_lab='".$lab."' WHERE pkt.id_pkt='".$id_pkt."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;

			}
			$pesan_sukses='berhasil edit data ';
			// header('Location: daftar_penempatan.php'); exit();
		}
		else{
			$sukses=FALSE;
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Penempatan Laboratorium
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<!-- <div class="alert alert-success">
  								<strong><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></strong>
							</div> -->
							<div class="form-group">
								<label>Nama</label>
								<input class="form-control" type="text" name="nim" maxlength="14" readonly size="30" value="<?php echo $nama; ?>">
							</div>
							<div class="form-group">
								<!-- <label>Laboratorium</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorLab)) echo $errorLab;?></span>
								<input class="form-control" type="text" name="id_lab" maxlength="50" size="30"  required value="<?php if(isset($id_lab)){echo $id_lab;} ?>">
							</div> -->
							<!-- <div class="form-group">
											<label>LABORATORIUM</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_Lab)) echo $error_Lab;?></span>&nbsp;
											<select id="lab" name="lab" required>
							<option value="none">--Pilih lab --</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$sid = $row->idlab;
									$sname = $row->nama_lab;
									echo '<option value='.$sid.' ';
									if(isset($lab) && $lab==$sid)
									echo 'selected="true"';
									echo '>'.$sname.'<br/></option>';
									//echo "cek";
								}
							?></select>
							<span class="error">* <?php if(!empty($error_Lab)) echo $error_Lab; ?></span>
							</div> -->
							<div class="form-group">
								<select class="pilihan" id="lab" name="lab" >
									<option value="<?php echo $id1 ?>"><?php echo $pilihan1; ?></option>
									<option value="<?php echo $id2 ?>"><?php echo $pilihan2; ?></option>
									<option value="<?php echo $id3 ?>"><?php echo $pilihan3; ?></option>
								</select>
							</div>

							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Tempatkan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;&nbsp;&nbsp;<a href="daftar_penempatan.php"><button class="btn btn-info">Kembali ke Daftar Penempatan</button></a>
</div>

<?php
include_once('footer.php');
$con->close();
?>
