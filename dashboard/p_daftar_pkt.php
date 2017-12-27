<?php
	$site_name= "Pendaftaran PKT";
	require_once('sidebar.php');
	require_once('datediff.php');
	$id=$_SESSION['sip_masuk_aja'];
	if(($status=="dosen")||($status=="lab")){
		header('Location:./index.php');
	}

	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$sukses=TRUE;
	$query = " SELECT tgl_awal,tgl_akhir FROM petugas WHERE idpetugas=1";
	// // Execute the query
	$result = $con->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $con->error);
	}
	else{
		while ($row = $result->fetch_object()){
			// $nim=$row->nim;
			$tgl_awal = $row->tgl_awal;
			$tgl_akhir = $row->tgl_akhir;
	}
		}
	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nim
		$nim=test_input($_POST['nim']);
			$querys = " SELECT * FROM mahasiswa WHERE nim='".$nim."'";
			$results = $con->query( $querys );

		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}
		// elseif ($results->num_rows!=0) {
		// 		$errorNim="NIM belum terdaftar di sistem";
		// 		$validNim=FALSE;
		// }
		else{
			$query = " SELECT * FROM pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}

		$smt=$_POST['smt'];
		$smt = test_input($_POST['smt']);
		if($smt == '' || $smt == "none"){
			$error_smt= "Laboratorium harus diisi";
			$valid_smt= FALSE;
		} else{
			$valid_smt= TRUE;
		}

		$pilihan1=$_POST['pilihan1'];
		$pilihan2=$_POST['pilihan2'];
		$pilihan3=$_POST['pilihan3'];
		$pilihan1 = test_input($_POST['pilihan1']);
		if($pilihan1 == '' || $pilihan1 == "none"){
			$error_pilihan1= "Laboratorium harus diisi";
			$valid_pilihan1= FALSE;
		} else{
			$valid_pilihan1= TRUE;
		}

		$pilihan2 = test_input($_POST['pilihan2']);
		if($pilihan2 == '' || $pilihan2 == "none"){
			$error_pilihan2= "Laboratorium harus diisi";
			$valid_pilihan2= FALSE;
		} elseif (($pilihan1==$pilihan2)||($pilihan2==$pilihan3)) {
			$error_pilihan2 = "Pilihan lab harus berbeda";
			$valid_pilihan2 = FALSE;
		}else{
			$valid_pilihan2= TRUE;
		}


		$pilihan3 = test_input($_POST['pilihan3']);
		if($pilihan3 == '' || $pilihan3 == "none"){
			$error_pilihan3= "Laboratorium harus diisi";
			$valid_pilihan3= FALSE;
		}elseif ($pilihan1==$pilihan3) {
			$error_pilihan3 = "Pilihan lab harus berbeda";
			$valid_pilihan3=FALSE;
		} else{
			$valid_pilihan3= TRUE;
		}
		$periode=$_POST['periode'];





		// jika tidak ada kesalahan input
		if ($validNim && $valid_pilihan1 && $valid_pilihan2 && $valid_pilihan3 && $valid_smt) {
			$nim=$con->real_escape_string($nim);
			$smt=$con->real_escape_string($smt);
			$pilihan1=$con->real_escape_string($pilihan1);
			$pilihan2=$con->real_escape_string($pilihan2);
			$pilihan3=$con->real_escape_string($pilihan3);

			$query = "INSERT INTO pkt (nim, pilihan_lab1, pilihan_lab2, pilihan_lab3,smt,periode) VALUES ('".$nim."','".$pilihan1."','".$pilihan2."','".$pilihan3."','".$smt."','".$periode."')";
			$hasil=$con->query($query);

			$que = "SELECT id_pkt from pkt WHERE nim=$nim";
			$hasilq=$con->query($que);
			$rows = $hasilq->fetch_object();
			$id = $rows->id_pkt;

			$query1 = "INSERT INTO nilai_pkt (id_pkt,id_komponen) VALUES ('".$id."',1),('".$id."',2),('".$id."',3)" ;

			$hasil1=$con->query($query1);
			if (!($hasil && $hasil1)) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil mendaftar PKT.";
		}
		else{
			$sukses=FALSE;
		}
	}
?>
<?php
	$awal= "2017-09-01";
	$todayDate = date("Y-m-d");
	$deadline="2017-09-07";
	if (($tgl_awal < $todayDate)&&($todayDate < $tgl_akhir)) {
		$button='<input class="form-control" type="submit"  name="daftar" value="Daftar">';
		$keterangan="";
		// echo $keterangan;
		// echo '';

	}else {
		$keterangan = "Diluar batas waktu yang ditentukan";
		// echo $keterangan;
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran</title>
</head>
<!-- $todayDate = date("Y-m-d");// current date -->
<body>

<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Daftar PKT
				<?php echo $keterangan; ?>

			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>

							<!-- NIM -->
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" <?php if ($status=="anggota") echo "readonly"; ?> placeholder="nim 14 digit angka" required autofocus value="<? if ($status=="anggota"){ echo $anggota->nim; }  ?>">
							</div>

							<div class="form-group">
								<label>Semester</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_smt)) echo $error_smt;?></span>
								<input class="form-control" type="number" name="smt" min="1" max="12"  placeholder="numerik" required autofocus>
							</div>
							<div class="form-group">
								<label>Periode</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_periode)) echo $error_smt;?></span>
								<select class="form-control" name="periode">
									<option value="16/17">2016/2017</option>
									<option value="17/18">2017/2018</option>
									<option value="18/19">2018/2019</option>
									<option value="19/20">2019/2020</option>
								</select>
							</div>
							<div class="form-group">
								<label>Pilih Laboratorium</label>&nbsp;
							</div>
							<!-- pilihan1 -->
							<div class="form-group">
								<label>Pilihan 1</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_pilihan1)) echo $error_pilihan1;?></span>&nbsp;
								<select id="pilihan1" name="pilihan1" required>
							<option value="none">--Pilih lab 1--</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$kid = $row->idlab;
									$kname = $row->nama_lab;
									echo "<option value=".$kid.' ';
									if(isset($pilihan1) && $pilihan1==$kid)
									echo "selected='true'";
									echo ">".$kname."<br/></option>";
								}
							?></select>
						<span class="error"> <?php if(!empty($error_pilihan1)) echo $error_pilihan1; ?></span>
										</div>

										<!-- pilihan2 -->
										<div class="form-group">
											<label>Pilihan 2</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_pilihan2)) echo $error_pilihan2;?></span>&nbsp;
											<select id="pilihan2" name="pilihan2" required>
							<option value="none">--Pilih lab 2--</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$sid = $row->idlab;
									$sname = $row->nama_lab;
									echo "<option value=".$sid.' ';
									if(isset($pilihan2) && $pilihan2==$sid)
									echo "selected='true'";
									echo ">".$sname."<br/></option>";
								}
							?></select>
							</div>
										<!-- pilihan3 -->
							<div class="form-group">
							<label>Pilihan 3</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_pilihan3)) echo $error_pilihan3;?></span>&nbsp;
							<select id="pilihan3" name="pilihan3" required>
							<option value="none">--Pilih lab 3--</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$tid = $row->idlab;
									$tname = $row->nama_lab;
									echo "<option value=".$tid.' ';
									if(isset($pilihan3) && $pilihan3==$tid)
									echo 'selected="true"';
									echo ">".$tname."<br/></option>";
									echo "cek";
								}
							?></select>
			<!-- <span class="error"> <?php if(!empty($error_pilihan3)) echo $error_pilihan3; ?></span> -->
							</div>

							<div class="form-group">

								 <?php echo $button;  ?>
							</div>
						</form>
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
