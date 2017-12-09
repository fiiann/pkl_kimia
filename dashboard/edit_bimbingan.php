<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
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

	$errorNilai='';


	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_bimbingan.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM pkt WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$nip = $row->dosen_pembimbing;
			}
		}
	}else{
		// Cek Nama

		$nim=test_input($_POST['nim']);
		$nip=test_input($_POST['pilihan1']);
		if ($nip=='') {
			$errorNip='wajib diisi';
			$validNip=FALSE;
		}else{
			$validNip=TRUE;
		}



		// jika tidak ada kesalahan input
		if ($validNip) {

			$nip=$con->real_escape_string($nip);

			$query = "UPDATE pkt SET  dosen_pembimbing	='".$nip."' WHERE nim='".$nim."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses="berhasil update bimbingan";
				echo $pesan_sukses;
			}
			$pesan_sukses="berhasil update bimbingan";
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
				Update Data Bimbingan
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>NIM</label>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" value="<?php echo $nim; ?>">
							</div>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php echo $nim; ?>">
							</div>
							<div class="form-group">
								<label>Dosen</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_pilihan1)) echo $error_pilihan1;?></span>&nbsp;
								<select id="pilihan1" name="pilihan1" required>
								<option value="none">--Pilih Dosen--</option>
								<?php
										$querykat = "select * from dosen";
										$resultkat = $db->query($querykat);
										if(!$resultkat){
											die("Could not connect to the database : <br/>". $db->connect_error);
										}
										while ($row = $resultkat->fetch_object()){
											$kid = $row->nip;
											$kname = $row->nama_dosen;
											echo '<option value='.$kid.' ';
											if(isset($pilihan1) && $pilihan1==$kid)
											echo 'selected="true"';
											echo '>'.$kname.'<br/></option>';
										}
									?></select>
									<span class="error">* <?php if(!empty($error_pilihan1)) echo $error_pilihan1; ?></span>
								</div>

							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="daftar_bimbingan.php"><button class="btn btn-info">Kembali ke daftar bimbingan</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
