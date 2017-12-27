<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	$site_name = "Input Persentase Kategori TR1";
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
		// if($_GET['nim']==""){
		// 	header('Location:./nilai_pkt.php');
		// }
		// $nim=$_GET['nim'];
		$query01 = " SELECT persentase_kat FROM kategori WHERE id=1";
		// Execute the query
		$result01 = $con->query( $query01 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result01->fetch_object()){

				$persentase_outline = $row->persentase_kat;
			}
		}

		$query02 = " SELECT persentase_kat FROM kategori WHERE id=2";
		// Execute the query
		$result02 = $con->query( $query02 );
		if (!$result02){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result02->fetch_object()){

				$persentase_progress = $row->persentase_kat;
			}
		}

	}else{

		$persentase_outline=test_input($_POST['persentase_outline']);
		if ($persentase_outline=='') {
			$errorNilai_outline='wajib diisi';
			$validNilai_outline=FALSE;
		}else{
			$validNilai_outline=TRUE;
		}

		$persentase_progress=test_input($_POST['persentase_progress']);
		if ($persentase_progress=='') {
			$errorNilai_progress='wajib diisi';
			$validNilai_progress=FALSE;
		}else{
			$validNilai_progress=TRUE;
		}

		$total = $persentase_outline+$persentase_progress;
		if ($total != 100) {
			$errorTotal = "Jumlah persentase harus 100%";
			$validTotal = FALSE;
		}else {
			$validTotal = TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNilai_outline && $validNilai_progress && $validTotal) {

			$persentase_outline=$con->real_escape_string($persentase_outline);
			$persentase_progress=$con->real_escape_string($persentase_progress);

			$query_0 = "UPDATE kategori SET  persentase_kat='".$persentase_outline."' WHERE id=1";
			$query_1 = "UPDATE kategori SET  persentase_kat='".$persentase_progress."' WHERE id=2";

			$hasil0=$con->query($query_0);
			$hasil1=$con->query($query_1);
			if (!($hasil0 && $hasil1 )) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses="Berhasil edit data";
				// echo "<br/>Berhasil edit data";
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
				Update Data Persentase TR1
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
							<div class="form-group">
								<label>Nilai Outline</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorNilai_outline)) echo $errorNilai_outline;?></span>
								<input class="form-control" type="number" name="persentase_outline" min="0" max="100" placeholder="edit nilai" required value="<?php if(isset($persentase_outline)){echo $persentase_outline;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Progress</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorNilai_progress)) echo $errorNilai_progress;?></span>
								<input class="form-control" type="number" name="persentase_progress" min="0" max="100" placeholder="edit nilai" required value="<?php if(isset($persentase_outline)){echo $persentase_progress;} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- <a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai TR1</button></a> -->
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
