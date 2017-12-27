<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_anggota.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
  $site_name="Tambah dosen";
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

    // cek telp
		$telp=test_input($_POST['telp']);
		if ($telp=='') {
			$errorTelp='wajib diisi';
			$validTelp=FALSE;
		}else{
			$validTelp=TRUE;
		}

    // cek nip
		$nip=test_input($_POST['nip']);
		if ($nip=='') {
			$errorNip='wajib diisi';
			$validNip=FALSE;
		}else{
      $query = "SELECT * FROM dosen WHERE nip='".$nip."'";
      $result = $con->query($query);
      if ($result->num_rows!=0) {
        $errorNip = 'NIP sudah pernah digunakan';
        $validNip = FALSE;
      } else {
  			$validNip=TRUE;
      }
  		}
    // cek telp
    $alamat=test_input($_POST['alamat']);
    if ($alamat=='') {
      $errorAlamat='wajib diisi';
      $validAlamat=FALSE;
    }else{
      $validAlamat=TRUE;
    }

    // cek telp
		$topik=test_input($_POST['topik']);
		if ($topik=='') {
			$errorTopik='wajib diisi';
			$validTopik=FALSE;
		}else{
			$validTopik=TRUE;
		}

    // cek lab
		$lab=test_input($_POST['lab']);
		if ($lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}
		// jika tidak ada kesalahan input
		if ($validNama && $validPass && $validEmail && $validTelp && $validTopik && $validLab && $validAlamat&& $validNip) {
			$nama=$con->real_escape_string($nama);
      $nip=$con->real_escape_string($nip);
			$password=$con->real_escape_string($password);
			$email=$con->real_escape_string($email);
      $lab=$con->real_escape_string($lab);
      $telp=$con->real_escape_string($telp);
      $topik=$con->real_escape_string($topik);
      $alamat=$con->real_escape_string($alamat);

			$query = "INSERT INTO dosen (nama_dosen, password, email,idlab,topik,no_telp,alamat,nip) VALUES ('".$nama."','".$password."','".$email."','".$lab."','".$topik."','".$telp."','".$alamat."','".$nip."')";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil menambahkan dosen";
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
				Tambah Dosen
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
              <div class="form-group">
								<label>NIP</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip)) echo $errorNip;?></span>
								<input class="form-control" type="text" name="nip" maxlength="18" size="30" placeholder="masukan nip" required value="<?php if(!$sukses&&$validNip){echo $nip;} ?>">
							</div>
              <div class="form-group">
								<label>Nama	</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama"  placeholder="masukan nama" required value="<?php if(!$sukses&&$validNama){echo $nama;} ?>">
							</div>
              <div class="form-group">
								<label>Alamat	</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorAlamat)) echo $errorAlamat;?></span>
                <textarea class="form-control" type="text" name="alamat" cols="26" row="12" maxlength="50" size="30" placeholder="masukan alamat" required value="<?php if(!$sukses&&$validAlamat){echo $alamat;} ?>"></textarea>
								<!-- <input  -->
							</div>
							<div class="form-group">
								<label>Email</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorEmail)) echo $errorEmail;?></span>
								<input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(!$sukses&&$validEmail){echo $email;} ?>">
							</div>
              <div class="form-group">
								<label>No Telp</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorTelp)) echo $errorTelp;?></span>
								<input class="form-control" type="text" name="telp" size="30" placeholder="masukan no telp" required value="<?php if(!$sukses&&$validTelp){echo $telp;} ?>">
							</div>

              <div class="form-group">
								<label>Topik</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorTopik)) echo $errorTopik;?></span>
								<input class="form-control" type="text" name="topik" size="30" placeholder="masukan topik" required value="<?php if(!$sukses&&$validTopik){echo $topik;} ?>">
							</div>
              <div class="form-group">
								<label>Lab</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorEmail)) echo $errorEmail;?></span>
                <select id="lab" name="lab" required>
    							<option value="none">--Pilih lab --</option>
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
                   ?>

                 </select>
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
