<?php
	require_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	if(($status=="dosen")||($status=="lab")){
		header('Location:./index.php');
	}
	if($con->connect_errno){
		die("Could not connect to the database: <br />".$con->connect_error);
	}
	// if($status=="anggota"){
	// 	header('Location:./index.php');
	// }
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);
		$query_1 = "SELECT dosen_pembimbing FROM pkt";
		$hasil_2=$con->query($query_1);

	$sukses=TRUE;
	$errorNama='';
	$errorNim='';
	$errorKumulatif='';
	$errorSks='';
	$errorKrs='';
	$errorDaftar='';
	// eksekusi tombol daftar
	if (isset($_POST['submit'])) {
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}else{
			$query = " SELECT * FROM tr1 WHERE nim='".$nim."'";
			$result = $con->query( $query );
			// $query1 = "SELECT dosen_pembimbing FROM pkt WHERE nim=$nim";
			// $hasil2=$con->query($query1);
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}

		$kumulatif=test_input($_POST['kumulatif']);
		if ($kumulatif=='') {
			$errorKumulatif='wajib diisi';
			$validKumulatif=FALSE;
		}else{
			$validKumulatif=TRUE;
		}

		$sks=test_input($_POST['sks']);
		if ($sks=='') {
			$errorSks='wajib diisi';
			$validSks=FALSE;
		}else{
			$validSks=TRUE;
		}

		$krs=test_input($_POST['krs']);
		if ($krs=='') {
			$errorKrs='wajib diisi';
			$validKrs=FALSE;
		}else{
			$validKrs=TRUE;
		}

		$daftar=test_input($_POST['daftar']);
		if ($daftar=='') {
			$errorDaftar='wajib diisi';
			$validDaftar=FALSE;
		}else{
			$validDaftar=TRUE;
		}


		$smt=$_POST['smt'];
		$lab=$_POST['lab'];
		$periode=$_POST['periode'];
		$smt = test_input($_POST['smt']);
		if($smt == '' || $smt == "none"){
			$error_smt= "Laboratorium harus diisi";
			$valid_smt= FALSE;
		} else{
			$valid_smt= TRUE;
		}

		// jika tidak ada kesalahan input
		if ($valid_smt && $validNim && $validKumulatif && $validSks && $validKrs && $validDaftar ) {
			$nim=$con->real_escape_string($nim);
			$lab=$con->real_escape_string($lab);

			$kumulatif=$con->real_escape_string($kumulatif);
			$sks=$con->real_escape_string($sks);
			$krs=$con->real_escape_string($krs);
			$smt=$con->real_escape_string($smt);
			$periode=$con->real_escape_string($periode);
			$daftar=$con->real_escape_string($daftar);

			$query = "INSERT INTO tr1 (nim, ipk, sks, tanggal_krs, tanggal_daftar,smt,periode_daftar,idlab_tr1) VALUES ('".$nim."','".$kumulatif."','".$sks."','".$krs."','".$daftar."','".$smt."','".$periode."','".$lab."')";

			$hasil=$con->query($query);
			$que = "SELECT id_tr1 from tr1 WHERE nim=$nim";
			$hasilq=$con->query($que);
			$rows = $hasilq->fetch_object();
			$id = $rows->id_tr1;
			$query1 = "INSERT INTO nilai_tr1 (id_tr1,id_komponen_tr1) VALUES ('".$id."',1),('".$id."',2),('".$id."',3),('".$id."',4),('".$id."',5),('".$id."',6),('".$id."',7),
			('".$id."',8),('".$id."',9),('".$id."',10),('".$id."',11),('".$id."',12),($id,13)" ;
			$hasil1=$con->query($query1);
			$query2 = "INSERT INTO final_tr1 (id_tr1, id_kategori) VALUES ($id, 1),($id,2)";
			$hasil2=$con->query($query2);
			if (!($hasil && $hasil1 && $hasil2)) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil menambahkan data.";
			// echo "string";
			// echo $nimku;
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
				Daftar TR 1
				<!-- <?php echo $id ?> -->
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>

							<!-- NIM -->
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" <?php if ($status=='anggota') {echo 'readonly';} ?> maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if($status=="anggota"){echo $anggota->nim;} ?>">
							</div>


							<div class="form-group">
								<label>Nilai Komulatif</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKumulatif)) echo $errorKumulatif;?></span>
								<input class="form-control" type="number" name="kumulatif" min="2.5" max="4" step="0.01" placeholder="masukan IPK" required value="<?php if(!$sukses&&$validKumulatif){echo $kumulatif;} ?>">
							</div>

							<div class="form-group">
								<label>Jumlah SKS</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorSks)) echo $errorSks;?></span>
								<input class="form-control" type="number" name="sks" min="90" max="160" placeholder="Masukan Nilai SKS" required value="<?php if(!$sukses&&$validSks){echo $sks;} ?>">
							</div>

							<div class="form-group">
								<label>Tanggal KRS</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKrs)) echo $errorKrs;?></span>
								<input class="form-control" type="date" name="krs"placeholder="masukan tanggal KRS" required >
							</div>
							<div class="form-group" hidden>
								<label>Tanggal Daftar</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKrs)) echo $errorKrs;?></span>
								<input class="form-control" type="text" name="daftar" value="<?php echo date('Y-m-d') ?>" required >
							</div>

							<div class="form-group">
								<label>Semester</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_smt)) echo $error_smt;?></span>
								<input class="form-control" type="number" name="smt" min="0" max="12"  placeholder="numerik" required autofocus>
							</div>
							<?php
							$querys = " SELECT flag_lab FROM pkt WHERE nim='".$id."'" ;
							$results = $con->query( $querys );
							if (!$results){
								die ("Could not query the databases: <br />". $con->error);
							}else{
								while ($rows = $results->fetch_object()){
									$lab = $rows->flag_lab;
								}
							}
							 ?>
							<div class="form-group" hidden>
								<label>Lab</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_smt)) echo $error_smt;?></span>
								<input class="form-control" type="text" name="lab" maxlength="14" size="30" required value="<?php echo $lab ?>">
							</div>
							<div class="form-group">
								<label>Periode</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_periode)) echo $error_smt;?></span>
								<select class="form-control" name="periode">
									<option value="16172">Genap 2016/2017</option>
									<option value="17181">Ganjil 2017/2018</option>
									<option value="18192">Genap 2018/2019</option>
									<option value="19201">Ganjil 2019/2020</option>
								</select>
							</div>

							<div class="form-group">
								<input class="form-control" type="submit"  name="submit" value="Daftar">
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
