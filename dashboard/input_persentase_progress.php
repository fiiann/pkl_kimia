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

	$errorNilai_prak='';
	$errorNilai_lap='';
	$errorNilai_presentasi='';

	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		// if($_GET['nim']==""){
		// 	header('Location:./nilai_pkt.php');
		// }
		// $nim=$_GET['nim'];
    $query01 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=8";
		// Execute the query
		$result01 = $con->query( $query01 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result01->fetch_object()){
				$persentase_bahasa = $row->persentase_tr1;
			}
		}
    $query02 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=9";
		// Execute the query
		$result02 = $con->query( $query02 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result02->fetch_object()){
				$persentase_substansi = $row->persentase_tr1;
			}
		}
    $query03 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=10";
		// Execute the query
		$result03 = $con->query( $query03 );
		if (!$result03){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result03->fetch_object()){
				$persentase_media = $row->persentase_tr1;
			}
		}
    $query04 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=11";
		// Execute the query
		$result04 = $con->query( $query04 );
		if (!$result04){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result04->fetch_object()){
				$persentase_materi = $row->persentase_tr1;
			}
		}
    $query05 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=13";
		// Execute the query
		$result05 = $con->query( $query05 );
		if (!$result05){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result05->fetch_object()){
				$persentase_pengetahuan = $row->persentase_tr1;
			}
		}
    $query06 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=12";
		// Execute the query
		$result06 = $con->query( $query06 );
		if (!$result06){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result06->fetch_object()){
				$persentase_analisis = $row->persentase_tr1;
			}
		}


	}else{

		$persentase_bahasa=test_input($_POST['persentase_bahasa']);
		if ($persentase_bahasa=='') {
			$errornilai_bahasa='wajib diisi';
			$validnilai_bahasa=FALSE;
		}else{
			$validnilai_bahasa=TRUE;
		}

		$persentase_substansi=test_input($_POST['persentase_substansi']);
		if ($persentase_substansi=='') {
			$errorNilai_substansi='wajib diisi';
			$validNilai_substansi=FALSE;
		}else{
			$validNilai_substansi=TRUE;
		}

		$persentase_media=test_input($_POST['persentase_media']);
		if ($persentase_media=='') {
			$errornilai_media='wajib diisi';
			$validnilai_media=FALSE;
		}else{
			$validnilai_media=TRUE;
		}

		$persentase_materi=test_input($_POST['persentase_materi']);
		if ($persentase_materi=='') {
			$errorNilai_materi='wajib diisi';
			$validnilai_materi=FALSE;
		}else{
			$validnilai_materi=TRUE;
		}

		$persentase_analisis=test_input($_POST['persentase_analisis']);
		if ($persentase_analisis=='') {
			$errornilai_analisis='wajib diisi';
			$validnilai_analisis=FALSE;
		}else{
			$validnilai_analisis=TRUE;
		}

		$persentase_pengetahuan=test_input($_POST['persentase_pengetahuan']);
		if ($persentase_pengetahuan=='') {
			$errorNilai_pengetahuan='wajib diisi';
			$validnilai_pengetahuan=FALSE;
		}else{
			$validnilai_pengetahuan=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validnilai_bahasa && $validNilai_substansi && $validnilai_media && $validnilai_materi && $validnilai_analisis && $validnilai_pengetahuan) {

			$persentase_bahasa=$con->real_escape_string($persentase_bahasa);
			$persentase_substansi=$con->real_escape_string($persentase_substansi);
			$persentase_media=$con->real_escape_string($persentase_media);
			$persentase_materi=$con->real_escape_string($persentase_materi);
			$persentase_analisis=$con->real_escape_string($persentase_analisis);
			$persentase_pengetahuan=$con->real_escape_string($persentase_pengetahuan);
			$nilai_total = (60/100*$nilai_praktikum)+(30/100*$nilai_laporan)+(10/100*$nilai_presentasi);
			if ($nilai_total <= 100 && $nilai_total >= 80) {
				$huruf = "A";
			}elseif ($nilai_total < 80 && $nilai_total >= 60) {
				$huruf = "B";
			}elseif ($nilai_total < 60 && $nilai_total >= 40) {
				$huruf = "C";
			}elseif ($nilai_total < 40) {
				$huruf = "D";
			}else {
				$huruf ="N/A";
			}

			$query_0 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_bahasa."' WHERE id_komponen_tr1=8";
			$query_1 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_substansi."' WHERE id_komponen_tr1=9";
			$query_2 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_media."' WHERE id_komponen_tr1=10";
			$query_3 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_materi."' WHERE id_komponen_tr1=11";
			$query_5 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_analisis."' WHERE id_komponen_tr1=12";
      $query_4 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_pengetahuan."' WHERE id_komponen_tr1=13";

			$hasil0=$con->query($query_0);
			$hasil1=$con->query($query_1);
			$hasil2=$con->query($query_2);
			$hasil3=$con->query($query_3);
			$hasil4=$con->query($query_4);
			$hasil5=$con->query($query_5);
			if (!($hasil0 && $hasil1 && $hasil2 && $hasil3 && $hasil4 && $hasil5 )) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				$pesan_sukses="Berhasil edit data";
				// echo "<br/>Berhasil edit data";
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
				Update Data Persentase Progress
				<!-- <?php
				// echo $persentase_presentasi;
				// echo $persentase_praktikum;
				// echo $persentase_laporan;
				 ?> -->
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Bahasa dan format</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_bahasa)) echo $errornilai_bahasa;?></span>
								<input class="form-control" type="text" name="persentase_bahasa" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_bahasa)){echo $persentase_bahasa;} ?>">
							</div>

							<div class="form-group">
								<label>Substansi</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_substansi)) echo $errornilai_substansi;?></span>
								<input class="form-control" type="text" name="persentase_substansi" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_substansi)){echo $persentase_substansi;} ?>">
							</div>
							<div class="form-group">
								<label>Penggunaan Media</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_media)) echo $errornilai_media;?></span>
								<input class="form-control" type="text" name="persentase_media" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_media)){echo $persentase_media;} ?>">
							</div>

							<div class="form-group">
								<label>Penguasaan Materi</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_materi)) echo $errornilai_materi;?></span>
								<input class="form-control" type="text" name="persentase_materi" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_materi)){echo $persentase_materi;} ?>">
							</div>
							<div class="form-group">
								<label>Penguasaan Pengetahuan</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_hipotesis)) echo $errornilai_hipotesis;?></span>
								<input class="form-control" type="text" name="persentase_pengetahuan" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_pengetahuan)){echo $persentase_pengetahuan;} ?>">
							</div>

							<div class="form-group">
								<label>Penguasaan Analisis</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_analisis)) echo $errornilai_analisis;?></span>
								<input class="form-control" type="text" name="persentase_analisis" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_analisis)){echo $persentase_analisis;} ?>">
							</div>

							<!-- <div class="form-group">
								<label>Nilai Kontrak TR 1</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai_pengetahuan)) echo $errorNilai_pengetahuan;?></span>
								<input class="form-control" type="text" name="persentase_pengetahuan" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_pengetahuan)){echo $persentase_pengetahuan;} ?>">
							</div> -->
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai TR1</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
