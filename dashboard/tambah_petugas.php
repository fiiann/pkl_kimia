<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_anggota.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	$site_name = "Tambah Petugas";
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
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
		// cek email
		$email=test_input($_POST['email']);
		$query1 = "SELECT count(admin) as count_lab FROM lab WHERE admin='".$email."'";
      $result1 = $con->query($query1);
      $row = $result1->fetch_object();
      $count_lab = $row->count_lab;
      // echo "lab : ";
      // echo $count_lab;
      // echo "<br>";
      $query2 = "SELECT count(email) as count_mhs FROM mahasiswa WHERE email='".$email."'";
      $result2 = $con->query($query2);
      $row2 = $result2->fetch_object();
      $count_mhs = $row2->count_mhs;
      // echo "mhs : ";
      // echo $count_mhs;
      // echo "<br>";
      $query3 = "SELECT count(email) as count_admin FROM petugas WHERE email='".$email."'";
      $result3 = $con->query($query3);
      $row3 = $result3->fetch_object();
      $count_admin = $row3->count_admin;
      // echo "admin : ";
      // echo $count_admin;
      // echo "<br>";
      $query4 = "SELECT count(email) as count_dosen FROM dosen WHERE email='".$email."'";
      $result4 = $con->query($query4);
      $row4 = $result4->fetch_object();
      $count_dosen = $row4->count_dosen;
      // echo "dosen : ";
      // echo $count_dosen;
      // echo "<br>";
    if ($email=='') {
      $errorEmail='wajib diisi';
      $validEmail=FALSE;
    }else{
      

      // $query = "SELECT count(email) as count_dosen FROM dosen WHERE email='".$email."'";
      // $result = $con->query($query);
      // $row = $result->fetch_object();
      // $count_dosen = $row->count_dosen;
      // $email_lab = $row1->count_lab;
      // if ( ($count_dosen <= 1) && ($email_lama==$email)) {
      if ( (($count_dosen == 0)) && ($count_mhs == 0) && ($count_admin == 0) && ($count_lab == 0) ) {
        $validEmail = TRUE;
      } else {
        $errorEmail = "Email sudah pernah digunakan";
        $validEmail=FALSE;
      }
    }
		// jika tidak ada kesalahan input
		if ($validNama && $validPass && $validEmail) {
			$nama=$con->real_escape_string($nama);
			$password=$con->real_escape_string($password);
			$email=$con->real_escape_string($email);

			$query = "INSERT INTO petugas (nama, password, email) VALUES ('".$nama."','".$password."','".$email."')";

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
				Tambah Petugas
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
								<label>Email</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorEmail)) echo $errorEmail;?></span>
								<input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(!$sukses&&$validEmail){echo $email;} ?>">
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