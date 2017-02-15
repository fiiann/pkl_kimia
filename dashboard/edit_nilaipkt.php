<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	
	$errorNilai_prak='';
	$errorNilai_lap='';
	$errorNilai_presentasi='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./nilai_pkt.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$nilai_prak = $row->nilai_praktikum;
				$nilai_lap = $row->nilai_laporan;
				$nilai_presentasi = $row->nilai_presentasi;
			}
		}
	}else{
		// Cek Nama
		
		$nim=test_input($_POST['nim']);
		$nilai_prak=test_input($_POST['nilai_prak']);
		if ($nilai_prak=='') {
			$errorNilai_prak='wajib diisi';
			$validNilai_prak=FALSE;
		}else{
			$validNilai_prak=TRUE;
		}

		$nilai_lap=test_input($_POST['nilai_lap']);
		if ($nilai_lap=='') {
			$errorNilai_lap='wajib diisi';
			$validNilai_lap=FALSE;
		}else{
			$validNilai_lap=TRUE;
		}
	
		$nilai_presentasi=test_input($_POST['nilai_presentasi']);
		if ($nilai_presentasi=='') {
			$errorNilai_presentasi='wajib diisi';
			$validNilai_presentasi=FALSE;
		}else{
			$validNilai_presentasi=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNilai_prak && $validNilai_lap && $validNilai_presentasi) {
			
			$nilai_prak=$con->real_escape_string($nilai_prak);
			$nilai_lap=$con->real_escape_string($nilai_lap);
			$nilai_presentasi=$con->real_escape_string($nilai_presentasi);

			$query = "UPDATE nilai_pkt SET  nilai_praktikum='".$nilai_prak."', nilai_laporan='".$nilai_lap."',nilai_presentasi='".$nilai_presentasi."' WHERE nim='".$nim."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				echo "<br/>Berhasil edit data";
			}
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
				Update Data Petugas
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>NIM</label>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" value="<?php echo $nim; ?>">
							</div>
							<div class="form-group">
								<label>Nilai Praktikum</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai_prak)) echo $errorNilai_prak;?></span>
								<input class="form-control" type="text" name="nilai_prak" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($nilai_prak)){echo $nilai_prak;} ?>">
							</div>
							
							<div class="form-group">
								<label>Nilai Laporan</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai_lap)) echo $errorNilai_lap;?></span>
								<input class="form-control" type="text" name="nilai_lap" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($nilai_lap)){echo $nilai_lap;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Presentasi</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai_presentasi)) echo $errorNilai_presentasi;?></span>
								<input class="form-control" type="text" name="nilai_presentasi" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($nilai_presentasi)){echo $nilai_presentasi;} ?>">
							</div>


							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai PKT</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>