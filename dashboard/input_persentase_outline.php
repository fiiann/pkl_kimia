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
    $query01 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=1";
		// Execute the query
		$result01 = $con->query( $query01 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result01->fetch_object()){
				$persentase_identifikasi = $row->persentase_tr1;
			}
		}
    $query02 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=2";
		// Execute the query
		$result02 = $con->query( $query02 );
		if (!$result01){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result02->fetch_object()){
				$persentase_rumusan = $row->persentase_tr1;
			}
		}
    $query03 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=3";
		// Execute the query
		$result03 = $con->query( $query03 );
		if (!$result03){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result03->fetch_object()){
				$persentase_tujuan = $row->persentase_tr1;
			}
		}
    $query04 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=4";
		// Execute the query
		$result04 = $con->query( $query04 );
		if (!$result04){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result04->fetch_object()){
				$persentase_metodologi = $row->persentase_tr1;
			}
		}
    $query05 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=5";
		// Execute the query
		$result05 = $con->query( $query05 );
		if (!$result05){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result05->fetch_object()){
				$persentase_hipotesis = $row->persentase_tr1;
			}
		}
    $query06 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=6";
		// Execute the query
		$result06 = $con->query( $query06 );
		if (!$result06){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result06->fetch_object()){
				$persentase_analisis = $row->persentase_tr1;
			}
		}
    $query07 = " SELECT persentase_tr1 FROM nilai_komponen_tr1 WHERE id_komponen_tr1=7";
		// Execute the query
		$result07 = $con->query( $query07 );
		if (!$result07){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result07->fetch_object()){
				$persentase_kontrak = $row->persentase_tr1;
			}
		}

	}else{

		$persentase_identifikasi=test_input($_POST['persentase_identifikasi']);
		if ($persentase_identifikasi=='') {
			$errornilai_identifikasi='wajib diisi';
			$validnilai_identifikasi=FALSE;
		}else{
			$validnilai_identifikasi=TRUE;
		}

		$persentase_rumusan=test_input($_POST['persentase_rumusan']);
		if ($persentase_rumusan=='') {
			$errorNilai_rumusan='wajib diisi';
			$validNilai_rumusan=FALSE;
		}else{
			$validNilai_rumusan=TRUE;
		}

		$persentase_tujuan=test_input($_POST['persentase_tujuan']);
		if ($persentase_tujuan=='') {
			$errornilai_tujuan='wajib diisi';
			$validnilai_tujuan=FALSE;
		}else{
			$validnilai_tujuan=TRUE;
		}

		$persentase_metodologi=test_input($_POST['persentase_metodologi']);
		if ($persentase_metodologi=='') {
			$errorNilai_metodologi='wajib diisi';
			$validnilai_metodologi=FALSE;
		}else{
			$validnilai_metodologi=TRUE;
		}

		$persentase_hipotesis=test_input($_POST['persentase_hipotesis']);
		if ($persentase_hipotesis=='') {
			$errornilai_hipotesis='wajib diisi';
			$validnilai_hipotesis=FALSE;
		}else{
			$validnilai_hipotesis=TRUE;
		}

		$persentase_analisis=test_input($_POST['persentase_analisis']);
		if ($persentase_analisis=='') {
			$errornilai_analisis='wajib diisi';
			$validnilai_analisis=FALSE;
		}else{
			$validnilai_analisis=TRUE;
		}

		$persentase_kontrak=test_input($_POST['persentase_kontrak']);
		if ($persentase_kontrak=='') {
			$errorNilai_kontrak='wajib diisi';
			$validnilai_kontrak=FALSE;
		}else{
			$validnilai_kontrak=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validnilai_identifikasi && $validNilai_rumusan && $validnilai_tujuan && $validnilai_metodologi && $validnilai_hipotesis && $validnilai_analisis && $validnilai_kontrak) {

			$persentase_identifikasi=$con->real_escape_string($persentase_identifikasi);
			$persentase_rumusan=$con->real_escape_string($persentase_rumusan);
			$persentase_tujuan=$con->real_escape_string($persentase_tujuan);
			$persentase_metodologi=$con->real_escape_string($persentase_metodologi);
			$persentase_hipotesis=$con->real_escape_string($persentase_hipotesis);
			$persentase_analisis=$con->real_escape_string($persentase_analisis);
			$persentase_kontrak=$con->real_escape_string($persentase_kontrak);
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

			$query_0 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_identifikasi."' WHERE id_komponen_tr1=1";
			$query_1 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_rumusan."' WHERE id_komponen_tr1=2";
			$query_2 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_tujuan."' WHERE id_komponen_tr1=3";
			$query_3 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_metodologi."' WHERE id_komponen_tr1=4";
			$query_4 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_hipotesis."' WHERE id_komponen_tr1=5";
			$query_5 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_analisis."' WHERE id_komponen_tr1=6";
			$query_6 = "UPDATE nilai_komponen_tr1 SET  persentase_tr1='".$persentase_kontrak."' WHERE id_komponen_tr1=7";

			$hasil0=$con->query($query_0);
			$hasil1=$con->query($query_1);
			$hasil2=$con->query($query_2);
			$hasil3=$con->query($query_3);
			$hasil4=$con->query($query_4);
			$hasil5=$con->query($query_5);
			$hasil6=$con->query($query_6);
			if (!($hasil0 && $hasil1 && $hasil2 && $hasil3 && $hasil4 && $hasil5 && $hasil6 )) {
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
				Update Data Persentase TR1
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
								<label>Nilai Identifikasi Masalah</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_identifikasi)) echo $errornilai_identifikasi;?></span>
								<input class="form-control" type="text" name="persentase_identifikasi" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_identifikasi)){echo $persentase_identifikasi;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Rumusan Masalah</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_rumusan)) echo $errornilai_rumusan;?></span>
								<input class="form-control" type="text" name="persentase_rumusan" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_rumusan)){echo $persentase_rumusan;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Tujuan</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_tujuan)) echo $errornilai_tujuan;?></span>
								<input class="form-control" type="text" name="persentase_tujuan" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_tujuan)){echo $persentase_tujuan;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Metodologi</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_metodologi)) echo $errornilai_metodologi;?></span>
								<input class="form-control" type="text" name="persentase_metodologi" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_metodologi)){echo $persentase_metodologi;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Hipotesis</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_hipotesis)) echo $errornilai_hipotesis;?></span>
								<input class="form-control" type="text" name="persentase_hipotesis" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_hipotesis)){echo $persentase_hipotesis;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Analisis</label>&nbsp;* <span class="label label-warning"><?php if(isset($errornilai_analisis)) echo $errornilai_analisis;?></span>
								<input class="form-control" type="text" name="persentase_analisis" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_analisis)){echo $persentase_analisis;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Kontrak TR 1</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai_kontrak)) echo $errorNilai_kontrak;?></span>
								<input class="form-control" type="text" name="persentase_kontrak" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($persentase_kontrak)){echo $persentase_kontrak;} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
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
