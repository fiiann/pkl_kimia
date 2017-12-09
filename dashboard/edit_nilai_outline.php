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
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_nilai_outline.php');
		}
		$nim=$_GET['nim'];
		$progress=$_GET['progress'];
		$laporan=$_GET['laporan'];
		$kinerja=$_GET['kinerja'];

		$query = " SELECT * FROM nilai_outline INNER JOIN nilai_tr1 on nilai_outline.nim=nilai_tr1.nim WHERE nilai_outline.nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$progress = $row->progress;
				$laporan = $row->laporan;
				$kinerja = $row->kinerja;
				$nilai_identifikasi = $row->identifikasi;
				$rumusan = $row->rumusan;
				$tujuan = $row->tujuan;
				$metodologi = $row->metodologi;
				$hipotesis = $row->hipotesis;
				$analisis = $row->analisis;
				$kontrak = $row->kontrak;
			}
		}
	}else{
		// Cek Nama
		
		$nim=test_input($_POST['nim']);
		$judul=test_input($_POST['judul']);
		if ($judul=='') {
			$error_judul='wajib diisi';
			$valid_judul=FALSE;
		}else{
				$valid_judul = TRUE;
			 }

		// Cek tanggal
		$tanggal=test_input($_POST['tanggal']);
		if ($tanggal=='') {
			$error_tanggal='wajib diisi';
			$valid_tanggal=FALSE;
		}else{
				$valid_tanggal = TRUE;
			 }


		// cek nilai identifikasi permasalahan
		$nilai_identifikasi=test_input($_POST['nilai_identifikasi']);
		if ($nilai_identifikasi=='') {
			$errornilai_identifikasi='wajib diisi';
			$validnilai_identifikasi=FALSE;
		}else{
				$validnilai_identifikasi = TRUE;
			 }
		
		// cek rumusan masalah
		$rumusan=test_input($_POST['rumusan']);
		if ($rumusan=='') {
			$error_rumusan='wajib diisi';
			$valid_rumusan=FALSE;
		}else{
				$valid_rumusan = TRUE;
			 }

		// cek nilai identifikasi permasalahan
		$tujuan=test_input($_POST['tujuan']);
		if ($tujuan=='') {
			$error_tujuan='wajib diisi';
			$valid_tujuan=FALSE;
		}else{
				$valid_tujuan = TRUE;
			 }


		$metodologi=test_input($_POST['metodologi']);
		if ($metodologi=='') {
			$error_metodologi='wajib diisi';
			$valid_metodologi=FALSE;
		}else{
				$valid_metodologi = TRUE;
			 }


		$hipotesis=test_input($_POST['hipotesis']);
		if ($hipotesis=='') {
			$error_hipotesis='wajib diisi';
			$valid_hipotesis=FALSE;
		}else{
				$valid_hipotesis = TRUE;
			 }


		$analisis=test_input($_POST['analisis']);
		if ($analisis=='') {
			$error_analisis='wajib diisi';
			$valid_analisis=FALSE;
		}else{
				$valid_analisis = TRUE;
			 }


		$kontrak=test_input($_POST['kontrak']);
		if ($kontrak=='') {
			$error_kontrak='wajib diisi';
			$valid_kontrak=FALSE;
		}else{
				$valid_kontrak = TRUE;
			 }
		// jika tidak ada kesalahan input
		if ( $validnilai_identifikasi && $valid_rumusan && $valid_tujuan && $valid_metodologi && $valid_hipotesis && $valid_analisis && $valid_kontrak ) {
			$nim=$con->real_escape_string($nim);
			// $judul=$con->real_escape_string($judul);
			// $tanggal=$con->real_escape_string($tanggal);
			$nilai_identifikasi=$con->real_escape_string($nilai_identifikasi);
			$rumusan=$con->real_escape_string($rumusan);
			$tujuan=$con->real_escape_string($tujuan);
			$metodologi=$con->real_escape_string($metodologi);
			$hipotesis=$con->real_escape_string($hipotesis);
			$analisis=$con->real_escape_string($analisis);
			$kontrak=$con->real_escape_string($kontrak);
			$tanggal=$con->real_escape_string($tanggal);
			$akhir_identifikasi = 30/100*$nilai_identifikasi;
			$akhir_rumusan = 10/100*$rumusan;
			$akhir_tujuan = 10/100*$tujuan;
			$akhir_metodologi = 10/100*$metodologi;
			$akhir_hipotesis = 10/100*$hipotesis;
			$akhir_analisis = 20/100*$analisis;
			$akhir_kontrak = 10/100*$kontrak;
			$akhir = $akhir_identifikasi+$akhir_rumusan+$akhir_tujuan+$akhir_metodologi+$akhir_hipotesis+$akhir_analisis+$akhir_kontrak;
			$nilai_akhir = (10/100*$akhir)+(10/100*$progress)+(80/100*$laporan);
			if ($kinerja >= 70){
				if ($nilai_akhir <= 100 && $nilai_akhir >= 80) {
					$huruf = "A";
				}elseif ($nilai_akhir < 80 && $nilai_akhir >= 70) {
					$huruf = "B";
				}elseif ($nilai_akhir < 70 && $nilai_akhir >= 60) {
					$huruf = "C";
				}elseif ($nilai_akhir < 60 && $nilai_akhir >= 50) {
					$huruf = "D";
				}elseif ($nilai_akhir < 50 && $nilai_akhir >= 0) {
					$huruf = "E";
				}else {
					$huruf ="N/A";
				}
			}elseif ($kinerja < 70) {
				if ($nilai_akhir <= 100 && $nilai_akhir >= 80) {
					$huruf = "B";
				}elseif ($nilai_akhir < 80 && $nilai_akhir >= 70) {
					$huruf = "C";
				}elseif ($nilai_akhir < 70 && $nilai_akhir >= 60) {
					$huruf = "D";
				}elseif ($nilai_akhir < 60 && $nilai_akhir >= 0) {
					$huruf = "E";
				}else {
					$huruf ="N/A";
				}
			}else {
				$huruf = "Nilai kinerja harus diantara 1-100";
			}

			$query = "UPDATE nilai_outline SET  identifikasi='".$nilai_identifikasi."', rumusan='".$rumusan."',tujuan='".$tujuan."',metodologi='".$metodologi."',hipotesis='".$hipotesis."',analisis='".$analisis."',kontrak='".$kontrak."',nilai_total='".$akhir."' WHERE nim='".$nim."'";

			$query2 = "UPDATE nilai_tr1 SET  outline=$akhir WHERE nim='".$nim."'";



			$hasil=$con->query($query);
			$hasil2=$con->query($query2);
			if (!($hasil && $hasil2)) {

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				// echo "<br/>Berhasil edit data";
			}
			$pesan_sukses="Berhasil edit data.";
		}
		else{
			$sukses=FALSE;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Edit nilai outline</title>
</head>
<body>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Nilai Outline
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" readonly name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Identifikasi Permasalahan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_identifikasi)) echo $errornilai_identifikasi;?></span>
								<input class="form-control" type="text" name="nilai_identifikasi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_identifikasi)){echo $nilai_identifikasi;} ?>">
							</div>
							<div class="form-group">
								<label>Rumusan masalah</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_rumusan)) echo $error_rumusan;?></span>
								<input class="form-control" type="text" name="rumusan" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($rumusan)){echo $rumusan;} ?>">
							</div>
							<div class="form-group">
								<label>Tujuan</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_tujuan)) echo $error_tujuan;?></span>
								<input class="form-control" type="text" name="tujuan" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($tujuan)){echo $tujuan;} ?>">
							</div>
							
							<div class="form-group">
								<label>Metodologi</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_metodologi)) echo $error_metodologi;?></span>
								<input class="form-control" type="text" name="metodologi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($metodologi)){echo $metodologi;} ?>">
							</div>

							<div class="form-group">
								<label>Hipotesis</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_hipotesis)) echo $error_hipotesis;?></span>
								<input class="form-control" type="text" name="hipotesis" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($hipotesis)){echo $hipotesis;} ?>">
							</div>

							<div class="form-group">
								<label>Analisis</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_analisis)) echo $error_analisis;?></span>
								<input class="form-control" type="text" name="analisis" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($analisis)){echo $analisis;} ?>">
							</div>

							<div class="form-group">
								<label>Kontrak TR1</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_kontrak)) echo $error_kontrak;?></span>
								<input class="form-control" type="text" name="kontrak" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($kontrak)){echo $kontrak;} ?>">
							</div>
							<!-- <div class="form-group">
								<label>Tanggal</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_tanggal)) echo $error_tanggal;?></span>
								<input class="form-control" type="text" name="tanggal" maxlength="50" size="30" placeholder="ex : 2017-01-17" required value="<?php if(!$sukses&&$valid_tanggal){echo $tanggal;} ?>">
							</div> -->
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
			<a href="daftar_nilai_outline.php"><button class="btn btn-info">Kembali ke Nilai Outline</button></a>
	</div>
</div>
</body>
</html>

<?php
include_once('footer.php');
$con->close();
?>