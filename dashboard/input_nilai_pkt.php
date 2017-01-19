<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	
	$sukses=TRUE;

	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}else{
			$query = " SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}
		// Cek Nip
		$nilai_pkt=test_input($_POST['nilai_pkt']);
		if ($nilai_pkt=='') {
			$errornilai_pkt='wajib diisi';
			$validnilai_pkt=FALSE;
		}else{
				$validnilai_pkt = TRUE;
			}

		

		// jika tidak ada kesalahan input
		if ($validNim && $validnilai_pkt ) {
			$nim=$con->real_escape_string($nim);
			$nilai_pkt=$con->real_escape_string($nilai_pkt);
			

			$query = "INSERT INTO nilai_pkt (nim, nilai_pkt) VALUES ('".$nim."',$nilai_pkt)";

			$hasil=$con->query($query);
			if (!$hasil) {
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
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(!$sukses&&$validNim){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai PKT</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_pkt)) echo $errornilai_pkt;?></span>
								<input class="form-control" type="text" name="nilai_pkt" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$validnilai_pkt){echo $nilai_pkt;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
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