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
	$query_11 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=1";
	// Execute the query
	$result_11 = $con->query( $query_11);

	if (!$result_11){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_11->fetch_object()){
			$persentase_identifikasi = $row->persentase_tr1;
		}
	}

	$query_22 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=2";
	// Execute the query
	$result_22 = $con->query( $query_22 );

	if (!$result_22){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_22->fetch_object()){
			$persentase_rumusan = $row->persentase_tr1;
		}
	}

	$query_33 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=3";
	// Execute the query
	$result_33 = $con->query( $query_33 );

	if (!$result_33){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_33->fetch_object()){
			$persentase_tujuan = $row->persentase_tr1;
		}
	}

	$query_44 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=4";
	// Execute the query
	$result_44 = $con->query( $query_44 );

	if (!$result_44){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_44->fetch_object()){
			$persentase_metodologi = $row->persentase_tr1;
		}
	}

	$query_55 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=5";
	// Execute the query
	$result_55 = $con->query( $query_55 );

	if (!$result_55){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_55->fetch_object()){
			$persentase_hipotesis = $row->persentase_tr1;
		}
	}

	$query_66 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=6";
	// Execute the query
	$result_66 = $con->query( $query_66 );

	if (!$result_66){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_66->fetch_object()){
			$persentase_analisis = $row->persentase_tr1;
		}
	}

	$query_77 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 n WHERE n.id_komponen_tr1=7";
	// Execute the query
	$result_77 = $con->query( $query_77 );

	if (!$result_77){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_77->fetch_object()){
			$persentase_kontrak = $row->persentase_tr1;
		}
	}

	$query_111 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=1";
	// Execute the query
	$result_111 = $con->query( $query_111);

	if (!$result_111){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_111->fetch_object()){
			$nilai_identifikasi = $row->nilai;
		}
	}

	$query_222 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=2";
	// Execute the query
	$result_222 = $con->query( $query_222);

	if (!$result_222){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_222->fetch_object()){
			$nilai_rumusan = $row->nilai;
		}
	}
	$query_333 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=3";
	// Execute the query
	$result_333 = $con->query( $query_333);

	if (!$result_333){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_333->fetch_object()){
			$nilai_tujuan = $row->nilai;
		}
	}
	$query_444 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=4";
	// Execute the query
	$result_444 = $con->query( $query_444);

	if (!$result_444){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_444->fetch_object()){
			$nilai_metodologi = $row->nilai;
		}
	}
	$query_555 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=5";
	// Execute the query
	$result_555 = $con->query( $query_555);

	if (!$result_555){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_555->fetch_object()){
			$nilai_hipotesis = $row->nilai;
		}
	}
	$query_666 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=6";
	// Execute the query
	$result_666 = $con->query( $query_666);

	if (!$result_666){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_666->fetch_object()){
			$nilai_analisis = $row->nilai;
		}
	}
	$query_777 = " SELECT nilai FROM nilai_tr1 n WHERE n.id_tr1=$id_tr1 and n.id_komponen_tr1=7";
	// Execute the query
	$result_777 = $con->query( $query_777);

	if (!$result_777){
		die ("Could not query the database: <br />". $con->error);
	}else{
		while ($row = $result_777->fetch_object()){
			$nilai_kontrak = $row->nilai;
		}
	}

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

		$nilai_identifikasi=test_input($_POST['nilai_identifikasi']);
		if ($nilai_identifikasi=='') {
			$errornilai_identifikasi='wajib diisi';
			$validnilai_identifikasi=FALSE;
		}else{
			$validnilai_identifikasi = TRUE;
		}

		$nilai_rumusan=test_input($_POST['nilai_rumusan']);
		if ($nilai_rumusan=='') {
			$errornilai_rumusan='wajib diisi';
			$validnilai_rumusan=FALSE;
		}else{
			$validnilai_rumusan = TRUE;
	  }

		$nilai_tujuan=test_input($_POST['nilai_tujuan']);
		if ($nilai_tujuan=='') {
			$errornilai_tujuan='wajib diisi';
			$validnilai_tujuan=FALSE;
		}else{
			$validnilai_tujuan = TRUE;
		}

		$nilai_metodologi=test_input($_POST['nilai_metodologi']);
		if ($nilai_metodologi=='') {
			$errornilai_metodologi='wajib diisi';
			$validnilai_metodologi=FALSE;
		}else{
			$validnilai_metodologi = TRUE;
		}

		$nilai_hipotesis=test_input($_POST['nilai_hipotesis']);
		if ($nilai_hipotesis=='') {
			$errornilai_hipotesis='wajib diisi';
			$validnilai_hipotesis=FALSE;
		}else{
			$validnilai_hipotesis = TRUE;
	  }


		$nilai_analisis=test_input($_POST['nilai_analisis']);
		if ($nilai_analisis=='') {
			$errornilai_analisis='wajib diisi';
			$validnilai_analisis=FALSE;
		}else{
			$validnilai_analisis = TRUE;
		}

		$nilai_kontrak=test_input($_POST['nilai_kontrak']);
		$tanggal_ujian=test_input($_POST['tanggal_ujian']);
		if ($nilai_kontrak=='') {
			$errornilai_kontrak='wajib diisi';
			$validnilai_kontrak=FALSE;
		}else{
			$validnilai_kontrak = TRUE ;
		}
		// // Cek persentase
		// $persentase_identifikasi=test_input($_POST['persentase_identifikasi']);
		// if ($persentase_identifikasi=='') {
		// 	$error_persentase_identifikasi='wajib diisi';
		// 	$valid_persentase_identifikasi=FALSE;
		// }else{
		// 	$valid_persentase_identifikasi = TRUE;
		// }
		//
		// $persentase_rumusan=test_input($_POST['persentase_rumusan']);
		// if ($persentase_rumusan=='') {
		// 	$error_persentase_rumusan='wajib diisi';
		// 	$valid_persentase_rumusan=FALSE;
		// 	}else{
 	// 		$valid_persentase_rumusan = TRUE;
		//  }
		//
		// $persentase_tujuan=test_input($_POST['persentase_tujuan']);
  	// if ($persentase_tujuan=='') {
		// 	$error_persentase_tujuan='wajib diisi';
		// 	$valid_persentase_tujuan=FALSE;
		// }else{
		// 	$valid_persentase_tujuan = TRUE;
	  // }
		// $persentase_metodologi=test_input($_POST['persentase_metodologi']);
		// if ($persentase_metodologi=='') {
		// 	$error_persentase_metodologi='wajib diisi';
		// 	$valid_persentase_metodologi=FALSE;
		// }else{
		// 	$valid_persentase_metodologi = TRUE;
		// }
		//
		// $persentase_hipotesis=test_input($_POST['persentase_hipotesis']);
		// if ($persentase_hipotesis=='') {
		// 	$error_persentase_hipotesis='wajib diisi';
		// 	$valid_persentase_hipotesis=FALSE;
		// 	}else{
 	// 		$valid_persentase_hipotesis = TRUE;
		//  }
		//
		// $persentase_analisis=test_input($_POST['persentase_analisis']);
  	// if ($persentase_analisis=='') {
		// 	$error_persentase_analisis='wajib diisi';
		// 	$valid_persentase_analisis=FALSE;
		// }else{
		// 	$valid_persentase_analisis = TRUE;
	  // }
		//
		// $persentase_kontrak=test_input($_POST['persentase_kontrak']);
  	// if ($persentase_kontrak=='') {
		// 	$error_persentase_kontrak='wajib diisi';
		// 	$valid_persentase_kontrak=FALSE;
		// }else{
		// 	$valid_persentase_kontrak= TRUE;
	  // }

		if ($validnilai_identifikasi && $validnilai_rumusan && $validnilai_tujuan && $validnilai_metodologi && $validnilai_hipotesis && $validnilai_analisis && $validnilai_kontrak) {
					// && $valid_persentase_identifikasi && $valid_persentase_rumusan && $valid_persentase_tujuan && $valid_persentase_metodologi && $valid_persentase_hipotesis && $valid_persentase_analisis && $valid_persentase_kontrak) {
			$nilai_identifikasi=$con->real_escape_string($nilai_identifikasi);
			$nilai_rumusan=$con->real_escape_string($nilai_rumusan);
			$nilai_tujuan=$con->real_escape_string($nilai_tujuan);
			$nilai_metodologi=$con->real_escape_string($nilai_metodologi);
			$nilai_hipotesis=$con->real_escape_string($nilai_hipotesis);
			$nilai_analisis=$con->real_escape_string($nilai_analisis);
			$nilai_kontrak=$con->real_escape_string($nilai_kontrak);
			$tanggal_ujian=$con->real_escape_string($tanggal_ujian);
			// $persentase_identifikasi=$con->real_escape_string($nilai_identifikasi);
			// $persentase_rumusan=$con->real_escape_string($nilai_rumusan);
			// $persentase_tujuan=$con->real_escape_string($nilai_tujuan);
			// $persentase_metodologi=$con->real_escape_string($nilai_metodologi);
			// $persentase_hipotesis=$con->real_escape_string($nilai_hipotesis);
			// $persentase_analisis=$con->real_escape_string($nilai_analisis);
			// $persentase_kontrak=$con->real_escape_string($nilai_kontrak);
			$nilai_total=(($persentase_identifikasi/100)*$nilai_identifikasi)+(($persentase_rumusan/100)*$nilai_rumusan)+(($persentase_tujuan/100)*$nilai_tujuan)
			 + (($persentase_metodologi/100)*$nilai_metodologi)+(($persentase_hipotesis/100)*$nilai_hipotesis)+(($persentase_analisis/100)*$nilai_analisis)+(($persentase_kontrak/100)*$nilai_kontrak);
			$query1 = "UPDATE nilai_tr1 SET nilai='".$nilai_identifikasi."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=1";
			$query2 = "UPDATE nilai_tr1 SET nilai='".$nilai_rumusan."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=2";
			$query3 = "UPDATE nilai_tr1 SET nilai='".$nilai_tujuan."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=3";
			$query4 = "UPDATE nilai_tr1 SET nilai='".$nilai_metodologi."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=4";
			$query5 = "UPDATE nilai_tr1 SET nilai='".$nilai_hipotesis."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=5";
			$query6 = "UPDATE nilai_tr1 SET nilai='".$nilai_analisis."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=6";
			$query7 = "UPDATE nilai_tr1 SET nilai='".$nilai_kontrak."' WHERE id_tr1='".$id_tr1."' AND id_komponen_tr1=7";

			$query8 = "UPDATE final_tr1 SET nilai='".$nilai_total."' WHERE id_tr1='".$id_tr1."' AND id_kategori=1";
			$query9 = "UPDATE tr1 SET nilai_outline='".$nilai_total."' WHERE id_tr1='".$id_tr1."'";
			$query10 = "UPDATE final_tr1 SET tanggal_ujian='".$tanggal_ujian."' WHERE id_tr1='".$id_tr1."' AND id_kategori=1";

			$hasil1=$con->query($query1);
			$hasil2=$con->query($query2);
			$hasil3=$con->query($query3);
			$hasil4=$con->query($query4);
			$hasil5=$con->query($query5);
			$hasil6=$con->query($query6);
			$hasil7=$con->query($query7);

			$hasil8=$con->query($query8);
			$hasil9=$con->query($query9);
			$hasil10=$con->query($query10);

			if (!($hasil1 && $hasil2 && $hasil3 && $hasil4 && $hasil5 && $hasil6 && $hasil7 && $hasil8 && $hasil9  && $hasil10)) {
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
	<title>Form Pendaftaran </title>
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

						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Identifikasi Permasalahan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_identifikasi)) echo $errornilai_identifikasi;?></span>
								<input class="form-control" type="number" name="nilai_identifikasi" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_identifikasi)){echo $nilai_identifikasi;} if(!$sukses&&$validnilai_identifikasi){echo $nilai_identifikasi;} ?>">
							</div>

							<div class="form-group">
								<label>Rumusan Masalah</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_rumusan)) echo $errornilai_rumusan;?></span>
								<input class="form-control" type="number" name="nilai_rumusan" min="0" max="100" required value="<?php if(isset($nilai_rumusan)){echo $nilai_rumusan;} if(!$sukses&&$validnilai_rumusan){echo $nilai_rumusan;} ?>">
							</div>

							<div class="form-group">
								<label>Tujuan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_tujuan)) echo $errornilai_tujuan;?></span>
								<input class="form-control" type="number" name="nilai_tujuan" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_tujuan)){echo $nilai_tujuan;}if(!$sukses&&$validnilai_tujuan){echo $nilai_tujuan;} ?>">
							</div>
							<div class="form-group">
								<label>Metodologi</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_metodologi)) echo $errornilai_metodologi;?></span>
								<input class="form-control" type="number" name="nilai_metodologi" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_metodologi)){echo $nilai_metodologi;}if(!$sukses&&$validnilai_metodologi){echo $nilai_metodologi;} ?>">
							</div>
							<div class="form-group">
								<label>Hipotesis</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_hipotesis)) echo $errornilai_hipotesis;?></span>
								<input class="form-control" type="number" name="nilai_hipotesis" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_hipotesis)){echo $nilai_hipotesis
									;}if(!$sukses&&$validnilai_hipotesis){echo $nilai_hipotesis;} ?>">
							</div>
							<div class="form-group">
								<label>Analisis</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_analisis)) echo $errornilai_analisis;?></span>
								<input class="form-control" type="number" name="nilai_analisis" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_analisis)){echo $nilai_analisis;}if(!$sukses&&$validnilai_analisis){echo $nilai_analisis;} ?>">
							</div>
							<div class="form-group">
								<label>Kontrak TR1</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_kontrak)) echo $errornilai_kontrak;?></span>
								<input class="form-control" type="number" name="nilai_kontrak" min="0" max="100" placeholder="0-100" required value="<?php if(isset($nilai_kontrak)){echo $nilai_kontrak;}if(!$sukses&&$validnilai_kontrak){echo $nilai_kontrak;} ?>">
							</div>
							<div class="form-group">
								<label>Tanggal Ujian</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_kontrak)) echo $errornilai_kontrak;?></span>
								<input class="form-control" type="date" name="tanggal_ujian"  size="30"  required>
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
								<input class="form-control" type="text" name="persentase_identifikasi" required placeholder="input persentase" value="<?php echo $persentase_identifikasi ?>">
							</div>
							<div class="form-group" >
								<label>Persentase laporan (%)</label>
								<input class="form-control" type="text" name="persentase_rumusan" required placeholder="input persentase" value="<?php echo $persentase_rumusan ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_tujuan" required placeholder="input persentase" value="<?php echo $persentase_tujuan ?>">
							</div>
							<div class="form-group">
								<label>Persentase identifikasi (%)</label>
								<input class="form-control" type="text" name="persentase_metodologi" required placeholder="input persentase" value="<?php echo $persentase_metodologi ?>">
							</div>
							<div class="form-group" >
								<label>Persentase laporan (%)</label>
								<input class="form-control" type="text" name="persentase_hipotesis" required placeholder="input persentase" value="<?php echo $persentase_hipotesis ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_analisis" required placeholder="input persentase" value="<?php echo $persentase_analisis ?>">
							</div>
							<div class="form-group" >
								<label>Persentase Praktikum (%)</label>
								<input class="form-control" type="text" name="persentase_kontrak" required placeholder="input persentase" value="<?php echo $persentase_kontrak ?>">
							</div>
							</div> -->

							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
							</div>

						</form>
						<div class="form-group">
								<a href="nilai_outline.php"><button class="btn btn-info">Kembali ke Daftar Nilai Outline</button></a>
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
