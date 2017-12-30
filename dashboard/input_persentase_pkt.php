<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	$site_name="Input Persentase PKT";
	require_once('sidebar.php');
	if(($status=="anggota")||($status=="lab")||($status=="dosen")){
		header('Location:./index.php');
	}

	$errorNilai_prak='';
	$errorNilai_lap='';
	$errorNilai_presentasi='';


	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		// if($_GET['nim']==""){
		// 	header('Location:./nilai_pkt.php');
		// }
		// $nim=$_GET['nim'];
		$query01 = " SELECT * FROM nilai_komponen_pkt WHERE id_komponen=1";
		// Execute the query
		$result01 = $con->query( $query01 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result01->fetch_object()){

				$persentase_presentasi = $row->persentase;
			}
		}

		$query02 = " SELECT * FROM nilai_komponen_pkt WHERE id_komponen=2";
		// Execute the query
		$result02 = $con->query( $query02 );
		if (!$result02){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result02->fetch_object()){

				$persentase_laporan = $row->persentase;
			}
		}

		$query = " SELECT * FROM nilai_komponen_pkt WHERE id_komponen=3";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){

				$persentase_praktikum = $row->persentase;
			}
		}
	}else{
		// Cek Nama

		$nim=test_input($_POST['nim']);
		$nilai_praktikum=test_input($_POST['nilai_prak']);
		if ($nilai_praktikum=='') {
			$errorNilai_prak='wajib diisi';
			$validNilai_prak=FALSE;
		}else{
			$validNilai_prak=TRUE;
		}

		$nilai_laporan=test_input($_POST['nilai_lap']);
		if ($nilai_laporan=='') {
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

		$total = $nilai_praktikum+$nilai_laporan+$nilai_presentasi;
		if ($total != 100) {
			$errorTotal = "Jumlah persentase harus 100%";
			$validTotal = FALSE;
		}else {
			$validTotal = TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNilai_prak && $validNilai_lap && $validNilai_presentasi && $validTotal) {

			$nilai_praktikum=$con->real_escape_string($nilai_praktikum);
			$nilai_laporan=$con->real_escape_string($nilai_laporan);
			$nilai_presentasi=$con->real_escape_string($nilai_presentasi);

			$query_0 = "UPDATE nilai_komponen_pkt SET  persentase='".$nilai_praktikum."' WHERE id_komponen=3";
			$query_1 = "UPDATE nilai_komponen_pkt SET  persentase='".$nilai_laporan."' WHERE id_komponen=2";
			$query_2 = "UPDATE nilai_komponen_pkt SET  persentase='".$nilai_presentasi."' WHERE id_komponen=1";

			$hasil0=$con->query($query_0);
			$hasil1=$con->query($query_1);
			$hasil2=$con->query($query_2);
			if (!($hasil0 && $hasil1 && $hasil2 )) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses="Berhasil edit data";
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
				Update Data Persentase PKT
				<!-- <?php
				// echo $persentase_presentasi;
				// echo $persentase_praktikum;
				// echo $persentase_laporan;
				 ?> -->
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<span class="label label-warning"><?php if(isset($errorTotal)) echo $errorTotal;?></span>
							<div class="form-group" hidden>
								<label>NIM</label>
								<input class="form-control"  type="text" name="nim" maxlength="14" size="30" value="<?php echo $nim; ?>">
							</div>
							<div class="form-group">
								<label>Nilai Praktikum</label>&nbsp  <span class="label label-warning">*<?php if(isset($errorNilai_prak)) echo $errorNilai_prak;?></span>
								<input class="form-control"  type="number" name="nilai_prak" min="0" max="100" placeholder="0-100" required value="<?php if(isset($persentase_praktikum)){echo $persentase_praktikum;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Laporan</label>&nbsp  <span class="label label-warning">*<?php if(isset($errorNilai_lap)) echo $errorNilai_lap;?></span>
								<input class="form-control"  type="number" name="nilai_lap" min="0" max="100" placeholder="0-100" required value="<?php if(isset($persentase_laporan)){echo $persentase_laporan;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Presentasi</label>&nbsp <span class="label label-warning">*<?php if(isset($errorNilai_presentasi)) echo $errorNilai_presentasi;?></span>
								<input class="form-control"  type="number" name="nilai_presentasi" min="0" max="100" placeholder="0-100" required value="<?php if(isset($persentase_presentasi)){echo $persentase_presentasi;} ?>">
							</div>


							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- <a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai PKT</button></a> -->
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
