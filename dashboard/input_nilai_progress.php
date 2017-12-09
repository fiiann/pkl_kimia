<?php
	require_once('sidebar.php');
	if(($status=="anggota")||($status=="lab")){
		header('Location:./index.php');
	}

	$sukses=TRUE;
	if($_GET['id']==""){
		header('Location:./daftar_input_nilai_tr1.php');
	}
	$id_tr1=$_GET['id'];
	$query_11 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=8";
	// Execute the query
	$result_11 = $con->query( $query_11);

	if (!$result_11){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_11->fetch_object()){
			$persentase_bahasa = $row->persentase_tr1;
		}
	}

	$query_22 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=9";
	// Execute the query
	$result_22 = $con->query( $query_22 );

	if (!$result_22){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_22->fetch_object()){
			$persentase_substansi = $row->persentase_tr1;
		}
	}

	$query_33 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=10";
	// Execute the query
	$result_33 = $con->query( $query_33 );

	if (!$result_33){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_33->fetch_object()){
			$persentase_media = $row->persentase_tr1;
		}
	}

	$query_44 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=11";
	// Execute the query
	$result_44 = $con->query( $query_44 );

	if (!$result_44){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_44->fetch_object()){
			$persentase_materi = $row->persentase_tr1;
		}
	}

	$query_55 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=12";
	// Execute the query
	$result_55 = $con->query( $query_55 );

	if (!$result_55){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_55->fetch_object()){
			$persentase_analisis = $row->persentase_tr1;
		}
	}


	$query_77 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=13";
	// Execute the query
	$result_77 = $con->query( $query_77 );

	if (!$result_77){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_77->fetch_object()){
			$persentase_pengetahuan = $row->persentase_tr1;
		}
	}

	$query_111 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=8";
	// Execute the query
	$result_111 = $con->query( $query_111);

	if (!$result_111){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_111->fetch_object()){
			$nilai_bahasa = $row->nilai;
		}
	}

	$query_222 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=9";
	// Execute the query
	$result_222 = $con->query( $query_222);

	if (!$result_222){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_222->fetch_object()){
			$nilai_substansi = $row->nilai;
		}
	}
	$query_333 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=10";
	// Execute the query
	$result_333 = $con->query( $query_333);

	if (!$result_333){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_333->fetch_object()){
			$nilai_media = $row->nilai;
		}
	}
	$query_444 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=11";
	// Execute the query
	$result_444 = $con->query( $query_444);

	if (!$result_444){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_444->fetch_object()){
			$nilai_materi = $row->nilai;
		}
	}
	$query_555 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=12";
	// Execute the query
	$result_555 = $con->query( $query_555);

	if (!$result_555){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_555->fetch_object()){
			$nilai_analisis = $row->nilai;
		}
	}
	$query_666 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=13";
	// Execute the query
	$result_666 = $con->query( $query_666);

	if (!$result_666){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_666->fetch_object()){
			$nilai_pengetahuan = $row->nilai;
		}
	}

	$query9 = "SELECT nilai FROM final_tr1 where id_tr1=$id_tr1 and id_kategori=1";
	$hasil9=$con->query($query9);
	$row = $hasil9->fetch_object();
	$nilai_outline = $row->nilai;
	$query10 = "SELECT persentase_kat FROM kategori where id=1";
	$hasil10=$con->query($query10);
	$row = $hasil10->fetch_object();
	$persentase_nilai_outline = $row->persentase_kat;
	$query11 = "SELECT persentase_kat FROM kategori where id=2";
	$hasil11=$con->query($query11);
	$row = $hasil11->fetch_object();
	$persentase_nilai_progress = $row->persentase_kat;

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		$query = " SELECT * FROM tr1 INNER JOIN mahasiswa ON tr1.nim=mahasiswa.nim WHERE tr1.id_tr1='".$id_tr1."'";
		$result = $con->query( $query );


		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$nama=$row->nama;
			}
		}

	}else{

		$nilai_bahasa=test_input($_POST['nilai_bahasa']);
		if ($nilai_bahasa=='') {
			$errornilai_bahasa='wajib diisi';
			$validnilai_bahasa=FALSE;
		}else{
			$validnilai_bahasa = TRUE;
		}

		$nilai_substansi=test_input($_POST['nilai_substansi']);
		if ($nilai_substansi=='') {
			$errornilai_substansi='wajib diisi';
			$validnilai_substansi=FALSE;
		}else{
			$validnilai_substansi = TRUE;
	  }

		$nilai_media=test_input($_POST['nilai_media']);
		if ($nilai_media=='') {
			$errornilai_media='wajib diisi';
			$validnilai_media=FALSE;
		}else{
			$validnilai_media = TRUE;
		}

		$nilai_materi=test_input($_POST['nilai_materi']);
		if ($nilai_materi=='') {
			$errornilai_materi='wajib diisi';
			$validnilai_materi=FALSE;
		}else{
			$validnilai_materi = TRUE;
		}

		$nilai_analisis=test_input($_POST['nilai_analisis']);
		if ($nilai_analisis=='') {
			$errornilai_analisis='wajib diisi';
			$validnilai_analisis=FALSE;
		}else{
			$validnilai_analisis = TRUE;
	  }


		$nilai_pengetahuan=test_input($_POST['nilai_pengetahuan']);
		$tanggal_ujian=test_input($_POST['tanggal_ujian']);
		if ($nilai_pengetahuan=='') {
			$errornilai_pengetahuan='wajib diisi';
			$validnilai_pengetahuan=FALSE;
		}else{
			$validnilai_pengetahuan = TRUE;
		}



		if ($validnilai_bahasa && $validnilai_substansi && $validnilai_media && $validnilai_materi && $validnilai_analisis && $validnilai_pengetahuan ) {
			$nilai_bahasa=$con->real_escape_string($nilai_bahasa);
			$nilai_substansi=$con->real_escape_string($nilai_substansi);
			$nilai_media=$con->real_escape_string($nilai_media);
			$nilai_materi=$con->real_escape_string($nilai_materi);
			$nilai_analisis=$con->real_escape_string($nilai_analisis);
			$nilai_pengetahuan=$con->real_escape_string($nilai_pengetahuan);
			$tanggal_ujian=$con->real_escape_string($tanggal_ujian);
			// $persentase_bahasa=$con->real_escape_string($persentase_bahasa);
			// $persentase_substansi=$con->real_escape_string($persentase_substansi);
			// $persentase_media=$con->real_escape_string($persentase_media);
			// $persentase_materi=$con->real_escape_string($persentase_materi);
			// $persentase_analisis=$con->real_escape_string($nilai_analisis);
			// $persentase_pengetahuan=$con->real_escape_string($nilai_pengetahuan);
			$nilai_total=(($persentase_bahasa/100)*$nilai_bahasa)+(($persentase_substansi/100)*$nilai_substansi)+(($persentase_media/100)*$nilai_media
			 + ($persentase_materi/100)*$nilai_materi)+(($persentase_analisis/100)*$nilai_analisis)+(($persentase_pengetahuan/100)*$nilai_pengetahuan);
			$query1 = "UPDATE nilai_tr1 SET nilai='".$nilai_bahasa."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=8";
			$query2 = "UPDATE nilai_tr1 SET nilai='".$nilai_substansi."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=9";
			$query3 = "UPDATE nilai_tr1 SET nilai='".$nilai_media."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=10";
			$query4 = "UPDATE nilai_tr1 SET nilai='".$nilai_materi."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=11";
			$query5 = "UPDATE nilai_tr1 SET nilai='".$nilai_analisis."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=12";
			$query6 = "UPDATE nilai_tr1 SET nilai='".$nilai_pengetahuan."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=13";

			$query8 = "UPDATE final_tr1 SET nilai='".$nilai_total."' WHERE id_tr1='".$id_tr1."' AND id_kategori=2";

			$nilai_tr1 = (($persentase_nilai_outline/100)*$nilai_outline)+(($persentase_nilai_progress/100)*$nilai_total);
			$query9 =  "UPDATE tr1 SET nilai_tr1=$nilai_tr1 WHERE id_tr1=$id_tr1";
			$query10 =  "UPDATE tr1 SET nilai_progress=$nilai_total WHERE id_tr1=$id_tr1";
			$query11 = "UPDATE final_tr1 SET tanggal_ujian='".$tanggal_ujian."' WHERE id_tr1='".$id_tr1."' AND id_kategori=2";


			$hasil1=$con->query($query1);
			$hasil2=$con->query($query2);
			$hasil3=$con->query($query3);
			$hasil4=$con->query($query4);
			$hasil5=$con->query($query5);
			$hasil6=$con->query($query6);
			$hasil8=$con->query($query8);
			$hasil9=$con->query($query9);
			$hasil10=$con->query($query10);
			$hasil11=$con->query($query11);
			if (!($hasil1 && $hasil2 && $hasil3 && $hasil4 && $hasil5 && $hasil6 && $hasil8 && $hasil9 && $hasil10 && $hasil11)) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				// echo $nilai_tr1;
				// echo $nilai_total;
				$sukses=TRUE;
			}
			$pesan_sukses="berhasil input data";
		}
		else{
			$sukses=FALSE;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran </title>
</head>
<body>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Nilai Progress
				<!-- <?php echo $persentase_bahasa; echo " "; echo $persentase_substansi;echo " "; echo $persentase_media;echo " "; echo $persentase_materi;echo " "; echo $persentase_analisis;echo " "; echo $persentase_pengetahuan; ?> -->
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">

						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="" value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Bahasa dan Format</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_bahasa)) echo $errornilai_bahasa;?></span>
								<input class="form-control" type="text" name="nilai_bahasa" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($nilai_bahasa)){echo $nilai_bahasa;} if(!$sukses&&$validnilai_bahasa){echo $nilai_bahasa;} ?>">

							</div>

							<div class="form-group">
								<label>Substansi</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_substansi)) echo $errornilai_substansi;?></span>
								<input class="form-control" type="text" name="nilai_substansi" maxlength="3" size="30" required value="<?php if(isset($nilai_substansi)){echo $nilai_substansi;} if(!$sukses&&$validnilai_substansi){echo $nilai_substansi;} ?>">
							</div>

							<div class="form-group">
								<label>Penyajian Penggunaan Media, dan Ketepatan Waktu </label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_media)) echo $errornilai_media;?></span>
								<input class="form-control" type="text" name="nilai_media" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($nilai_media)){echo $nilai_media;}if(!$sukses&&$validnilai_media){echo $nilai_media;} ?>">
							</div>
							<div class="form-group">
								<label>Penguasaan Materi</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_materi)) echo $errornilai_materi;?></span>
								<input class="form-control" type="text" name="nilai_materi" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($nilai_materi)){echo $nilai_materi;}if(!$sukses&&$validnilai_materi){echo $nilai_materi;} ?>">
							</div>
							<div class="form-group">
								<label>Penguasaan Analisis</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_hipotesis)) echo $errornilai_analisis;?></span>
								<input class="form-control" type="text" name="nilai_analisis" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($nilai_analisis)){echo $nilai_analisis;}if(!$sukses&&$validnilai_analisis){echo $nilai_analisis;} ?>">
							</div>

							<div class="form-group">
								<label>Penguasaan Pengetahuan Penunjang</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_pengetahuan)) echo $errornilai_pengetahuan;?></span>
								<input class="form-control" type="text" name="nilai_pengetahuan" maxlength="3" size="30" placeholder="0-100" required value="<?php if(isset($nilai_pengetahuan)){echo $nilai_pengetahuan;}if(!$sukses&&$validnilai_pengetahuan){echo $nilai_pengetahuan;} ?>">
							</div>
							<div class="form-group">
								<label>Tanggal Ujian</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_pengetahuan)) echo $errornilai_pengetahuan;?></span>
								<input class="form-control" type="date" name="tanggal_ujian" required>
							</div>

							<!-- <div class="form-group">
								<label>Tanggal Lulus</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<input class="form-control" type="date" name="tgl_lulus" maxlength="15" size="30" required  >
							</div> -->
							<!-- <div class="form-group"> -->
								<!-- <label>Periode Lulus</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span> -->
								<!-- <input class="form-control" type="text" name="periode" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_presentasi)){echo $nilai_presentasi;}if(!$sukses&&$validnilai_presentasi){echo $nilai_presentasi;} ?>"> -->
								<!-- <select class="form-control" name="periode"> -->
									<!-- <option value="16/17">2016/2017</option>
									<option value="17/18">2017/2018</option>
									<option value="18/19">2018/2019</option>
									<option value="19/20">2019/2020</option> -->
								<!-- </select>
							</div> -->
							<!-- <div class="kuduhidden" hidden>


							<div class="form-group">
								<label>Persentase identifikasi (%)</label>
								<input class="form-control" type="text" name="persentase_bahasa" required placeholder="input persentase" value="<?php echo $persentase_bahasa ?>">
							</div>
							<div class="form-group" >
								<label>Persentase laporan (%)</label>
								<input class="form-control" type="text" name="persentase_substansi" required placeholder="input persentase" value="<?php echo $persentase_substansi ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_media" required placeholder="input persentase" value="<?php echo $persentase_media ?>">
							</div>
							<div class="form-group">
								<label>Persentase identifikasi (%)</label>
								<input class="form-control" type="text" name="persentase_materi" required placeholder="input persentase" value="<?php echo $persentase_materi ?>">
							</div>
							<div class="form-group" >
								<label>Persentase laporan (%)</label>
								<input class="form-control" type="text" name="persentase_analisis" required placeholder="input persentase" value="<?php echo $persentase_analisis ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_pengetahuan" required placeholder="input persentase" value="<?php echo $persentase_pengetahuan ?>">
							</div>
							</div> -->
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
							</div>

						</form>
						<div class="form-group">
								<a href="nilai_tr1.php"><button class="btn btn-info">Kembali ke Daftar Nilai TR1</button></a>
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
