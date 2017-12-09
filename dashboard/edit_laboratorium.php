<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_lab.php
	Deskripsi	: menambah data lab pada database
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

	$errorNim='';
	$errorNama='';
	$errorNip='';
	$errorPass='';
	$errorAlamat='';
	$errorKota='';
	$errorEmail='';
	$validNama='';
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id']==""){
      header('Location:./daftar_lab.php');
		}
		$id=$_GET['id'];
		$query = " SELECT * FROM lab WHERE idlab='".$id."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nama_lab=$row->nama_lab;
				$email = $row->admin;
				$nip = $row->nip;
			}
		}
	}else{

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


		// cek email
		$email=test_input($_POST['email']);
		if ($email=='') {
			$errorEmail='wajib diisi';
			$validEmail=FALSE;
		}else{
				$validEmail = TRUE;
		}

		// cek nomor telpon
		$nip=test_input($_POST['nip']);
		if ($nip=='') {
			$errorNip='wajib diisi';
			$validNip=FALSE;
		}elseif (!preg_match("/^[0-9]*$/",$nip)) {
			$errorNip='hanya mengizinkan angka 0-9';
			$validNip=FALSE;
		}else{
			$validNip=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNama && $validEmail && $validNip) {
			$nama=$con->real_escape_string($nama);
			$email=$con->real_escape_string($email);
			$nip=$con->real_escape_string($nip);

			$query = "UPDATE lab SET nama_lab='".$nama."', admin='".$email."', nip='".$nip."' WHERE idlab='".$id."'";

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
				Update Data Lab <span class="label label-success"><?php if(isset($berhasil)) echo $berhasil;?></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group">
								<label>Nama</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama_lab)){echo $nama_lab;} ?>">
							</div>
              <div class="form-group">
								<label>Dosen</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip)) echo $errorNip;?></span>&nbsp;
								<select id="nip" name="nip" required>
								<option value="none">--Pilih Dosen--</option>
								<?php
										$querykat = "select * from dosen";
										$resultkat = $db->query($querykat);
										if(!$resultkat){
											die("Could not connect to the database : <br/>". $db->connect_error);
										}
										while ($row1 = $resultkat->fetch_object()){
											$kid = $row1->nip;
											$kname = $row1->nama_dosen;
											echo '<option value='.$kid.' ';
											if(isset($nip) && $nip==$kid)
											echo 'selected="true"';
											echo '>'.$kname.'<br/></option>';
										}
									?></select>
									<span class="error">* <?php if(!empty($errorNip)) echo $errorNip; ?></span>
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
