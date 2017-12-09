<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_anggota.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
  $db=new mysqli($db_host, $db_username, $db_password, $db_database);
  if($db->connect_errno){
    die("Could not connect to the database : <br/>". $db->connect_error);
  }
	$sukses=TRUE;

	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nama
		$nama=test_input($_POST['nama']);
		if ($nama=='') {
			$errorNama='wajib diisi';
			$validNama=FALSE;
		}elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
			$errorNama='hanya mengizinkan huruf dan spasi';
			$validNama=FALSE;
		}else{
			$validNama=TRUE;
		}

		// Cek password
		$password=test_input($_POST['password']);
		$password = md5("sip".$password."pis");
		if ($password=='') {
			$errorPass='wajib diisi';
			$validPass=FALSE;
		}else{
			$validPass=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNama && $validPass ) {
			$nama=$con->real_escape_string($nama);
			$password=$con->real_escape_string($password);

			$query = "INSERT INTO lab (nama_lab, password) VALUES ('".$nama."','".$password."')";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil menambahkan petugas";
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
				Tambah Lab
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>

              <div class="form-group">
								<label>Nama	</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(!$sukses&&$validNama){echo $nama;} ?>">
							</div>

							<div class="form-group">
								<label>Password</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorPass)) echo $errorPass;?></span>
								<input class="form-control" type="password" name="password" minlength="8" maxlength="50" size="30" placeholder="minimal 8 digit" required value="<?php if(!$sukses&&$validPass){echo $_POST['password'];} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Daftar">
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
