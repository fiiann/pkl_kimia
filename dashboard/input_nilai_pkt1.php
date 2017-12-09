<?php
	require_once('sidebar.php');
	if(($status=="anggota")||($status=="lab")){
		header('Location:./index.php');
	}

	$sukses=TRUE;
	if($_GET['id']==""){
		header('Location:./input_nilai_pkt1.php');
	}

	$id_pkt=$_GET['id'];

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		$nilai_total = $_GET['nilai_total'];
		// $jumlah_total = $_GET['jumlah_total'];
		$nilai_laporan = $_GET['nilai_laporan'];
		$nilai_presentasi = $_GET['nilai_presentasi'];
		$nilai_praktikum = $_GET['nilai_praktikum'];

		$query_pertama= "select nilai from nilai_pkt WHERE id_pkt=$id_pkt and id_komponen=1";
		$hasil_pertama = $con->query($query_pertama);
		$row_pertama= $hasil_pertama->fetch_object();
		$n_presentasi =$row_pertama->nilai;

		$query_kedua= "select nilai from nilai_pkt WHERE id_pkt=$id_pkt and id_komponen=2";
		$hasil_kedua = $con->query($query_kedua);
		$row_kedua= $hasil_kedua->fetch_object();
		$n_laporan =$row_kedua->nilai;

		$query_tiga= "select nilai from nilai_pkt WHERE id_pkt=$id_pkt and id_komponen=3";
		$hasil_tiga = $con->query($query_tiga);
		$row_tiga= $hasil_tiga->fetch_object();
		$n_praktikum =$row_tiga->nilai;

		$query = " SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim WHERE pkt.id_pkt='".$id_pkt."'";
		// Execute the query
		$result = $con->query( $query );
		$query_11 = " SELECT persentase FROM nilai_komponen_pkt n WHERE n.id_komponen=1";
		// Execute the query
		$result_11 = $con->query( $query_11);

		if (!$result_11){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result_11->fetch_object()){
				$persentase_pre = $row->persentase;
			}
		}

		$query_22 = " SELECT persentase FROM nilai_komponen_pkt n WHERE n.id_komponen=2";
		// Execute the query
		$result_22 = $con->query( $query_22 );

		if (!$result_22){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result_22->fetch_object()){
				$persentase_lap = $row->persentase;
			}
		}

		$query_33 = " SELECT persentase FROM nilai_komponen_pkt n WHERE n.id_komponen=3";
		// Execute the query
		$result_33 = $con->query( $query_33 );

		if (!$result_33){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result_33->fetch_object()){
				$persentase_prak = $row->persentase;
			}
		}

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$id_pkt=$row->id_pkt;
				$nim=$row->nim;
				$nama=$row->nama;
				// $nilai_total = $row->nilai;
				// $laporanumlah_total = $row->jumlah_total;
				// $nilai_laporan = $row->nilai_laporan;
				// $nilai_praktikum = $row->nilai_praktikum;
				// $nilai_presentasi = $row->nilai_presentasi;
			}
		}

	}else{

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

		// Cek persentase
		$persentase_prak=test_input($_POST['persentase_prak']);
		if ($persentase_prak=='') {
			$error_persentase_prak='wajib diisi';
			$valid_persentase_prak=FALSE;
		}else{
			$valid_persentase_prak = TRUE;
		}

		$persentase_lap=test_input($_POST['persentase_lap']);
		if ($persentase_lap=='') {
			$error_persentase_lap='wajib diisi';
			$valid_persentase_lap=FALSE;
	 	}else{
 			$valid_persentase_lap = TRUE;
		 }

		$persentase_pre=test_input($_POST['persentase_pre']);
  	if ($persentase_pre=='') {
			$error_persentase_pre='wajib diisi';
			$valid_persentase_pre=FALSE;
		}else{
			$valid_persentase_pre = TRUE;
	  }
		$tgl_lulus=test_input($_POST['tgl_lulus']);
		$periode=test_input($_POST['periode']);

		// jika tidak ada kesalahan input
		if ($validnilai_praktikum && $validnilai_laporan && $validnilai_presentasi && $valid_persentase_prak && $valid_persentase_pre && $valid_persentase_lap) {

			$nilai_praktikum=$con->real_escape_string($nilai_praktikum);
			$nilai_laporan=$con->real_escape_string($nilai_laporan);
			$nilai_presentasi=$con->real_escape_string($nilai_presentasi);
			$persentase_pre = $con->real_escape_string($persentase_pre);
			$persentase_prak = $con->real_escape_string($persentase_prak);
			$persentase_lap = $con->real_escape_string($persentase_lap);
			$tgl_lulus = $con->real_escape_string($tgl_lulus);
			$periode = $con->real_escape_string($periode);
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
			$query = "UPDATE nilai_pkt SET nilai='".$nilai_presentasi."' WHERE id_pkt='".$id_pkt."' AND id_komponen=1";
			$query1 = "UPDATE nilai_pkt SET nilai='".$nilai_laporan."' WHERE id_pkt='".$id_pkt."' AND id_komponen=2";
			$query2 = "UPDATE nilai_pkt SET nilai='".$nilai_praktikum."' WHERE id_pkt='".$id_pkt."' AND id_komponen=3";
			//persentase komponen
			// $query3 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_pre."' WHERE id_komponen=1";
			// $query4 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_lap."' WHERE id_komponen=2";
			// $query5 = "UPDATE nilai_komponen_pkt SET persentase='".$persentase_prak."' WHERE id_komponen=3";
			// tam
			$nila=$persentase_prak;
			$query6 = "UPDATE pkt SET nilai='".$nilai_total."' WHERE id_pkt='".$id_pkt."'";
			$query7 = "UPDATE pkt SET nilai_huruf='".$huruf."' WHERE id_pkt='".$id_pkt."'";
			$query8 = "UPDATE pkt SET nilai_praktikum='".$nilai_praktikum."' WHERE id_pkt='".$id_pkt."'";
			$query9 = "UPDATE pkt SET nilai_presentasi='".$nilai_presentasi."' WHERE id_pkt='".$id_pkt."'";
			$query10 = "UPDATE pkt SET nilai_laporan='".$nilai_laporan."' WHERE id_pkt='".$id_pkt."'";
			$query11 = "UPDATE pkt SET tgl_lulus='".$tgl_lulus."', periode_lulus='".$periode."' WHERE id_pkt='".$id_pkt."'";
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
			$hasil11=$con->query($query11);
			if (!($hasil11 && $hasil && $hasil1 && $hasil2 && $hasil6 && $hasil7 && $hasil8 && $hasil9 && $hasil10)) {
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
				Nilai PKT 			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
						<!-- <form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nama" size="30" readonly required value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Praktikum</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_praktikum)) echo $errornilai_praktikum;?></span>
								<input class="form-control" type="text" name="nilai_praktikum" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($n_praktikum)){echo $n_praktikum;} if(!$sukses&&$validnilai_praktikum){echo $nilai_praktikum;} ?>">

							</div>

							<div class="form-group">
								<label>Nilai Laporan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_laporan)) echo $errornilai_laporan;?></span>
								<input class="form-control" type="text" name="nilai_laporan" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($n_laporan)){echo $n_laporan;} if(!$sukses&&$validnilai_laporan){echo $nilai_laporan;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Presentasi</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<input class="form-control" type="text" name="nilai_presentasi" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($n_presentasi)){echo $n_presentasi;}if(!$sukses&&$validnilai_presentasi){echo $nilai_presentasi;} ?>">
							</div>

							<div class="form-group">
								<label>Tanggal Lulus</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<input class="form-control" type="date" name="tgl_lulus" maxlength="15" size="30" required  >
							</div>
							<div class="form-group">
								<label>Periode Lulus</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<!-- <input class="form-control" type="text" name="periode" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_presentasi)){echo $nilai_presentasi;}if(!$sukses&&$validnilai_presentasi){echo $nilai_presentasi;} ?>"> -->
								<select class="form-control" name="periode" required>
									<option value="16/17">Genap 2016/2017</option>
									<option value="17/18">Gasal 2017/2018</option>
									<option value="18/19">Genap 2018/2019</option>
									<option value="19/20">Gasal 2019/2020</option>
								</select>
							</div>
							<div class="kuduhidden" hidden>


							<div class="form-group">
								<label>Persentase Presentasi (%)</label>
								<input class="form-control" type="text" name="persentase_pre" required placeholder="input persentase" value="<?php echo $persentase_pre ?>">
							</div>
							<div class="form-group" >
								<label>Persentase laporan (%)</label>
								<input class="form-control" type="text" name="persentase_lap" required placeholder="input persentase" value="<?php echo $persentase_lap ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_prak" required placeholder="input persentase" value="<?php echo $persentase_prak ?>">
							</div>
							</div>

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
include_once('footer.php');
$con->close();
?>
