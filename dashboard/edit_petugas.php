<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	$site_name='Update Petugas';
	require_once('sidebar.php');
	if($status=="anggota" || $status=="dosen" || $status=="lab"){
		header('Location:./index.php');
	}

	$errorNama='';
	$errorEmail='';

	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id']==""){
			header('Location:./daftar_petugas.php');
		}
		$id=$_GET['id'];
		$query = " SELECT * FROM petugas WHERE idpetugas='".$id."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nama=$row->nama;
				$email_lama = $row->email;
			}
		}
	}else{
		// Cek Nama
		$id=test_input($_POST['id']);
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
			$query0 = "SELECT email FROM petugas WHERE idpetugas='".$id."'";
    	$result0 = $con->query($query0);
    	$rowz = $result0->fetch_object();
    	$email_lama = $rowz->email;
			if ( (($count_admin == 0)|| ($email_lama==$email)) && ($count_dosen == 0) && ($count_mhs == 0) && ($count_lab == 0) ) {
        $validEmail = TRUE;
    	} else {
    		$errorEmail = "Email sudah pernah digunakan";
      	$validEmail=FALSE;
    	}
		}

		// jika tidak ada kesalahan input
		if ($validNama && $validEmail) {
			$nama=$con->real_escape_string($nama);
			$email=$con->real_escape_string($email);

			$query = "UPDATE petugas SET nama='".$nama."', email='".$email."' WHERE idpetugas='".$id."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses="Anda berhasil mengubah data";
			}
		}
		else{
			$sukses=FALSE;
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Update Data Petugas
			<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>ID Petugas</label>
								<input class="form-control" type="text" name="id" maxlength="14" size="30" value="<?php echo $id; ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">*<?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Email</label>&nbsp;<span class="label label-warning">*<?php if(isset($errorEmail)) echo $errorEmail;?></span>
								<input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(isset($email_lama)){echo $email_lama;} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="daftar_petugas.php"><button class="btn btn-info">Kembali ke Daftar Petugas</button>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
