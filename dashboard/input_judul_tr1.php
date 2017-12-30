<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}

	$sukses=TRUE;

	if($_GET['id']==""){
		header('Location:./daftar_input_judul_tr1.php');
	}

	$id_tr1=$_GET['id'];
	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {


		$query = " SELECT * FROM tr1 INNER JOIN mahasiswa on tr1.nim=mahasiswa.nim WHERE tr1.id_tr1='".$id_tr1."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$id_tr1=$row->id_tr1;
				$nama=$row->nama;
				$judul=$row->judul;
			}
		}
	}else{
		// Cek Nim


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

			$query = "UPDATE tr1 SET judul='".$judul."' WHERE id_tr1='".$id_tr1."'"	;



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
				Masukan Judul TR 1
				 <!-- <?php echo $judul; ?> -->
 			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Judul</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorJudul)) echo $errorJudul;?></span>
								<!-- <textarea class="form-control" name="judul" rows="5" cols="150" maxlength="1000" size="130" placeholder="Judul PKT" required autofocus value="<?php if(isset($judul)){echo $judul;} ?>">

								</textarea> -->
								<input class="form-control" type="text" name="judul" <?php if(isset($judul)){echo "readonly";} ?>maxlength="200" size="200" placeholder="Masukan Judul TR 1" required autofocus value="<?php if(isset($judul)){echo $judul;} ?>">
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
