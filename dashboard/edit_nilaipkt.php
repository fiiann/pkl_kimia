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
	
	$errorNilai='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./nilai_pkt.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$nilai_pkt = $row->nilai_pkt;
			}
		}
	}else{
		// Cek Nama
		
		$nim=test_input($_POST['nim']);
		$nilai_pkt=test_input($_POST['nilai_pkt']);
		if ($nilai_pkt=='') {
			$errorNilai='wajib diisi';
			$validNilai=FALSE;
		}else{
			$validNilai=TRUE;
		}
		
	
		
		// jika tidak ada kesalahan input
		if ($validNilai) {
			
			$nilai_pkt=$con->real_escape_string($nilai_pkt);

			$query = "UPDATE nilai_pkt SET  nilai_pkt='".$nilai_pkt."' WHERE nim='".$nim."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				echo "<br/>Berhasil edit data";
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
								<label>Nilai</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNilai)) echo $errorNilai;?></span>
								<input class="form-control" type="text" name="nilai_pkt" maxlength="50" size="30" placeholder="edit nilai" required value="<?php if(isset($nilai_pkt)){echo $nilai_pkt;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>

				</div>

			</div>

		</div>
		<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai PKT</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>