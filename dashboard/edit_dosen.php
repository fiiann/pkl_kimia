<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_mahasiswa.php
	Deskripsi	: menambah data mahasiswa pada database
-->
<?php
	require_once('sidebar.php');
	if($status=="mahasiswa"){
			header('Location:./index.php');
		}


	$errorNip='';
	$errorNama='';
	$errorTlp='';
	$errorPass='';
	$errorAlamat='';
	$errorTopik='';
	$errorEmail='';
	$validNama='';
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id']==""){
			header('Location:./daftar_dosen.php');
		}
		$id=$_GET['id'];
		$query = " SELECT * FROM dosen WHERE nip='".$id."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nama=$row->nama_dosen;
				$alamat = $row->alamat;
				$topik = $row->topik;
				$email_lama = $row->email;
				$noTlp = $row->no_telp;
			}
		}
	}else{
		// $niplawas = test_input ($_POST['nip']);

		$nip_baru = test_input($_POST['nip_new']);
		if ($nip_baru == ''){
			$errrorNip = "nip wajib diisi";
			$valid_nip = FALSE;
		}elseif(!preg_match("/^[0-9]{18}$/",$nip_baru)){
			$errrorNip = "NIP harus terdiri dari 14 digit angka";
			$valid_nip = FALSE;
		}else{
			$query = " SELECT * FROM dosen WHERE nip='".$id."'";
			$result = $con->query( $query );
			if($result->num_rows!=0 && $id!=$_POST['nip_new']){
				$errrorNip="nip sudah pernah digunakan, harap masukkan nip lain";
				$valid_nip=FALSE;
			}
			else{
				$valid_nip = TRUE;
			}
		}
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

		// cek alamat
		$alamat=test_input($_POST['alamat']);
		if ($alamat=='') {
			$errorAlamat='wajib diisi';
			$validAlamat=FALSE;
		}else{
			$validAlamat=TRUE;
		}

		// cek topik
		$topik=test_input($_POST['topik']);
		if($topik=='') {
			$errorTopik='wajib diisi';
			$validTopik=FALSE;
		}else{
			$validTopik=TRUE;
		}

		// cek email
		$email=test_input($_POST['email']);
		if ($email=='') {
			$errorEmail='wajib diisi';
			$validEmail=FALSE;
		}elseif ($email == $email_lama) {
			$validEmail = TRUE;
		}else{

				$validEmail = TRUE;

		}

		// cek nomor telpon
		$noTlp=test_input($_POST['telpon']);
		if ($noTlp=='') {
			$errorTlp='wajib diisi';
			$validTlp=FALSE;
		}elseif (!preg_match("/^[0-9]*$/",$noTlp)) {
			$errorTlp='hanya mengizinkan angka 0-9';
			$validTlp=FALSE;
		}else{
			$validTlp=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($valid_nip && $validNama && $validAlamat && $validTopik && $validEmail && $validTlp) {
			$nip_baru=$con->real_escape_string($nip_baru);
			$nama=$con->real_escape_string($nama);
			$alamat=$con->real_escape_string($alamat);
			$topik=$con->real_escape_string($topik);
			$email=$con->real_escape_string($email);
			$noTlp=$con->real_escape_string($noTlp);

			$query = "UPDATE dosen SET nip='".$nip_baru."', nama_dosen='".$nama."', alamat='".$alamat."', topik='".$topik."', email='".$email."', no_telp='".$noTlp."' WHERE nip='".$id."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$berhasil = "Berhasil";
			}
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Update Data Dosen <span class="label label-success"><?php if(isset($berhasil)) echo $berhasil;?></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">

							<div class="form-group">
								<label>NIP</label>&nbsp;* <span class="label label-warning"><?php if(isset($errrorNip)) echo $errrorNip;?></span>
								<input class="form-control" type="text" name="nip_new" maxlength="14" size="30" placeholder="nip 14 digit angka" required autofocus value="<?php if(isset($id)) echo $id; else echo $_POST['nip_new']; ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorAlamat)) echo $errorAlamat;?></span>
								<textarea required class="form-control" name="alamat" placeholder="masukan alamat rumah" cols="26" rows="5" maxlength="150"><?php if(isset($alamat)){echo $alamat;} ?></textarea>
							</div>
							<div class="form-group">
								<label>Kota</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorKota)) echo $errorKota;?></span>
								<input class="form-control" type="text" name="topik" maxlength="50" size="30" placeholder="topik asal" required value="<?php if(isset($topik)){echo $topik;} ?>">
							</div>
							<div class="form-group">
								<label>Telp/HP</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorTlp)) echo $errorTlp;?></span>
								<input class="form-control" type="text" name="telpon" maxlength="15" size="30" placeholder="nomor telpon HP aktif" required value="<?php if(isset($noTlp)){echo $noTlp;} ?>">
							</div>
							<div class="form-group">
								<label>Email</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorEmail)) echo $errorEmail;?></span>
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
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
