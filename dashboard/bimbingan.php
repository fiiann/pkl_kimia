<?php
	require_once('sidebar.php');
	if(($status=="anggota")||($status=="dosen")){
		header('Location:./index.php');
	}

	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$errorLab='';


	$sukses=TRUE;
	if($_GET['id']==""){
		header('Location:./daftar_pkt.php');
	}
	$id_pkt=$_GET['id'];

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		$query = " SELECT * FROM pkt INNER JOIN lab ON pkt.pilihan_lab1=lab.idlab left join mahasiswa on pkt.nim=mahasiswa.nim WHERE id_pkt='".$id_pkt."'" ;
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$nama=$row->nama;

			}
		}
	}else{
		// Cek Nama
		// $nim=test_input($_POST['nim']);
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

			$query = "UPDATE pkt SET  dosen_pembimbing='".$nip."' WHERE id_pkt='".$id_pkt."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses='berhasil update data';
			}
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
				Bimbingan
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nama" maxlength="14" size="30" required readonly value="<?php echo $nama; ?>">
							</div>
							<!-- <div class="form-group">
								<label>NIP</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip)) echo $errorNip;?></span>
								<input class="form-control" type="text" name="nip" maxlength="18" size="30" placeholder="id_pkt 18 digit angka" required autofocus value="<?php if(!$sukses&&$validNip){echo $nip;} ?>">
							</div> -->
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
								<input class="form-control" type="submit" name="edit" value="Daftar">
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
