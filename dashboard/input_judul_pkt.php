<?php
	$site_name="Input Judul PKT";
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}

	$sukses=TRUE;
	if($_GET['id']==""){
		header('Location:./daftar_input_judul.php');
	}
	$id_pkt=$_GET['id'];

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		$nim=$_GET['nim'];



		$query = " SELECT * FROM pkt INNER JOIN mahasiswa on pkt.nim=mahasiswa.nim WHERE pkt.id_pkt='".$id_pkt."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$id_pkt=$row->id_pkt;
				$nama=$row->nama;
				$judul=$row->judul;
			}
		}
	}else{
		$judul=test_input($_POST['judul']);
		if ($judul=='') {
			$errorJudul='wajib diisi';
			$validJudul=FALSE;
		}else{
				$validJudul = TRUE;
			}

		// jika tidak ada kesalahan input
		if ($validJudul) {

			$judul=$con->real_escape_string($judul);

			$query = "UPDATE pkt SET judul='".$judul."' WHERE id_pkt='".$id_pkt."'"	;



			$hasil=$con->query($query);

			if (!($hasil)) {
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
				Masukan Judul PKT <!-- <?php echo $judul; ?> -->
 			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Judul</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorJudul)) echo $errorJudul;?></span>
<!-- 								<textarea class="form-control" name="judul" rows="5" cols="150" placeholder="Judul PKT" required  value="<?php if(isset($judul)){echo $judul;} ?>">

								</textarea> -->
								<input class="form-control" type="text" name="judul" <?php if(isset($judul)){echo "readonly";} ?>maxlength="200" size="200" placeholder="Masukan Judul PKT" required autofocus value="<?php if(isset($judul)){echo $judul;} ?>">
								<!-- <input class="form-control" type="text-area" name="judul" maxlength="50" size="30" placeholder="Judul PKT" required autofocus value="<?php if(!$sukses&&$validJudul){echo $judul;} ?>"> -->
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
