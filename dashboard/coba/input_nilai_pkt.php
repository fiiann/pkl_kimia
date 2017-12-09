<!-- backup input nilai pkt -->

<?php
	require_once('../sidebar.php');
	if(($status=="anggota")||($status=="lab")){
		header('Location:./index.php');
	}

	$sukses=TRUE;

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		if($_GET['nim']==""){
			header('Location:./input_nilai_pkt1.php');
		}

		$nim=$_GET['nim'];
		$nilai_total = $_GET['nilai_total'];
		// $jumlah_total = $_GET['jumlah_total'];
		$nilai_laporan = $_GET['nilai_laporan'];
		$nilai_presentasi = $_GET['nilai_presentasi'];
		$nilai_praktikum = $_GET['nilai_praktikum'];

		$query = " SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim WHERE pkt.nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$nama=$row->nama;
				// $nilai_total = $row->nilai;
				// $laporanumlah_total = $row->jumlah_total;
				// $nilai_laporan = $row->nilai_laporan;
				// $nilai_praktikum = $row->nilai_praktikum;
				// $nilai_presentasi = $row->nilai_presentasi;
			}
		}
		$query = " SELECT persentase FROM nilai_komponen_pkt WHERE id_komponen=1";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$persentase_pre = $row->persentase;
			}
		}

		$query = " SELECT persentase FROM nilai_komponen_pkt WHERE id_komponen=2";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$persentase_lap = $row->persentase;
			}
		}

		$query = " SELECT persentase FROM nilai_komponen_pkt WHERE id_komponen=3";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$persentase_prak = $row->persentase;
			}
		}
	}else{
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}else{
			$validNim = TRUE;
		}


		$nilai_praktikum=test_input($_POST['nilai_praktikum']);
		if ($nilai_praktikum=='') {
			$errornilai_praktikum='wajib diisi';
			$validnilai_praktikum=FALSE;
		}else{
			$validnilai_praktikum = TRUE;
		}

		// Cek Nilai praktikum
		$nilai_laporan=test_input($_POST['nilai_laporan']);
		if ($nilai_laporan=='') {
			$errornilai_laporan='wajib diisi';
			$validnilai_laporan=FALSE;
		}else{
			$validnilai_laporan = TRUE;
	  }


		$nilai_presentasi=test_input($_POST['nilai_presentasi']);
		if ($nilai_presentasi=='') {
			$errornilai_presentasi='wajib diisi';
			$validnilai_presentasi=FALSE;
		}else{
			$validnilai_presentasi = TRUE;
		}
		// // Cek persentase
		// $persentase_prak=test_input($_POST['persentase_prak']);
		// if ($persentase_prak=='') {
		// 	$error_persentase_prak='wajib diisi';
		// 	$valid_persentase_prak=FALSE;
		// }else{
		// 	$valid_persentase_prak = TRUE;
		// }
		//
		// $persentase_lap=test_input($_POST['persentase_lap']);
		// if ($persentase_lap=='') {
		// 	$error_persentase_lap='wajib diisi';
		// 	$valid_persentase_lap=FALSE;
		// 	}else{
 	// 		$valid_persentase_lap = TRUE;
		//  }
		//
 	 //  $persentase_lap=test_input($_POST['persentase_lap']);
  	// if ($persentase_lap=='') {
		// 	$error_persentase_lap='wajib diisi';
		// 	$valid_persentase_lap=FALSE;
		// }else{
		// 	$valid_persentase_lap = TRUE;
	  // }
		//
		// $persentase_pre=test_input($_POST['persentase_pre']);
  	// if ($persentase_pre=='') {
		// 	$error_persentase_pre='wajib diisi';
		// 	$valid_persentase_pre=FALSE;
		// }else{
		// 	$valid_persentase_pre = TRUE;
	  // }

		// jika tidak ada kesalahan input
		if ($validNim && $validnilai_praktikum && $validnilai_laporan && $validnilai_presentasi) {
			$nim=$con->real_escape_string($nim);
			$nilai_praktikum=$con->real_escape_string($nilai_praktikum);
			$nilai_laporan=$con->real_escape_string($nilai_laporan);
			$nilai_presentasi=$con->real_escape_string($nilai_presentasi);
			// $persentase_pre = ;
			// $persentase_prak =;
			// $persentase_lap = ;
			$nilai_total=($persentase_pre/100*$nilai_presentasi)+($persentase_lap/100*$nilai_laporan)+($persentase_prak/100*$nilai_praktikum);
			// $nilai_total = (60/100*$nilai_praktikum)+(30/100*$nilai_laporan)+(10/100*$nilai_presentasi);
			if ($nilai_total <= 100 && $nilai_total >= 80) {
				$huruf = "A";
			}elseif ($nilai_total < 80 && $nilai_total >= 60) {
				$huruf = "B";
			}elseif ($nilai_total < 60 && $nilai_total >= 40) {
				$huruf = "C";
			}elseif ($nilai_total < 40) {
				$huruf = "D";
			}else {
				$huruf ="N/A";
			}

			// $query = "INSERT INTO nilai_pkt (nim, nilai_praktikum, nilai_laporan, nilai_presentasi, nilai_pkt,nilai_huruf) VALUES ('".$nim."',$nilai_praktikum,$nilai_laporan,$nilai_presentasi,$nilai_total,'".$huruf."')";
			// $query = "UPDATE pkt SET nilai='".$nilai_total."',nilai_huruf='".$huruf."',nilai_praktikum='".$nilai_praktikum."',nilai_laporan='".$nilai_laporan."', nilai_presentasi='".$nilai_presentasi."' WHERE nim='".$nim."'";
			$query = "UPDATE nilai_pkt SET nilai='".$nilai_presentasi."' WHERE nim='".$nim."' AND id_komponen=1";
			$query1 = "UPDATE nilai_pkt SET nilai='".$nilai_laporan."' WHERE nim='".$nim."' AND id_komponen=2";
			$query2 = "UPDATE nilai_pkt SET nilai='".$nilai_praktikum."' WHERE nim='".$nim."' AND id_komponen=3";
			//persentase komponen
			// $query3 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_pre."' WHERE id_komponen=1";
			// $query4 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_lap."' WHERE id_komponen=2";
			// $query5 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_prak."' WHERE id_komponen=3";
			// tam
			$query6 = "UPDATE pkt SET nilai='".$nilai_total."' WHERE nim='".$nim."'";
			$query7 = "UPDATE pkt SET nilai_huruf='".$huruf."' WHERE nim='".$nim."'";
			$query8 = "UPDATE pkt SET nilai_praktikum='".$nilai_praktikum."' WHERE nim='".$nim."'";
			$query9 = "UPDATE pkt SET nilai_presentasi='".$nilai_presentasi."' WHERE nim='".$nim."'";
			$query10 = "UPDATE pkt SET nilai_laporan='".$nilai_laporan."' WHERE nim='".$nim."'";
			$hasil=$con->query($query);
			$hasil1=$con->query($query1);
			$hasil2=$con->query($query2);
			// $hasil3=$con->query($query3);
			// $hasil4=$con->query($query4);
			// $hasil5=$con->query($query5);
			$hasil6=$con->query($query6);
			$hasil7=$con->query($query7);
			$hasil8=$con->query($query8);
			$hasil9=$con->query($query9);
			$hasil10=$con->query($query10);
			if (!($hasil && $hasil1 && $hasil2 && $hasil6 && $hasil7 && $hasil8 && $hasil9 && $hasil10)) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil menambahkan data.";

		}
		else{
			$sukses=FALSE;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran</title>
</head>
<body>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Nilai PKT
				<?php echo $persentase_prak; ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Praktikum</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_praktikum)) echo $errornilai_praktikum;?></span>
								<input class="form-control" type="text" name="nilai_praktikum" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_praktikum)){echo $nilai_praktikum;} if(!$sukses&&$validnilai_praktikum){echo $nilai_praktikum;} ?>">

							</div>
							<!-- <div class="form-group">
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_prak" required placeholder="input persentase" value="60">
							</div> -->
							<div class="form-group">
								<label>Nilai Laporan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_laporan)) echo $errornilai_laporan;?></span>
								<input class="form-control" type="text" name="nilai_laporan" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_laporan)){echo $nilai_laporan;} if(!$sukses&&$validnilai_laporan){echo $nilai_laporan;} ?>">
							</div>
							<!-- <div class="form-group">
								<label>Persentase Laporan (%)</label>
								<input class="form-control" type="text" name="persentase_lap" required placeholder="input persentase" value="30">
							</div> -->
							<div class="form-group">
								<label>Nilai Presentasi</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<input class="form-control" type="text" name="nilai_presentasi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_presentasi)){echo $nilai_presentasi;}if(!$sukses&&$validnilai_presentasi){echo $nilai_presentasi;} ?>">
							</div>
							<!-- <div class="form-group">
								<label>Persentase Presentasi (%)</label>
								<input class="form-control" type="text" name="persentase_pre" required placeholder="input persentase" value="10">
							</div> -->
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
							</div>

						</form>
						<div class="form-group">
								<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Daftar Nilai PKT</button></a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once('../footer.php');
$con->close();
?>
