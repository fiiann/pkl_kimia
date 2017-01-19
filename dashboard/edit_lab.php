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
	
	$errorLab='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_penempatan.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM penempatan WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$id_lab = $row->id_lab;
			}
		}
	}else{
		// Cek Nama
		$nim=test_input($_POST['nim']);
		$id_lab=test_input($_POST['id_lab']);
		if ($id_lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}
		
	
		
		// jika tidak ada kesalahan input
		if ($validLab) {
			
			$id_lab=$con->real_escape_string($id_lab);

			$query = "UPDATE penempatan SET  id_lab='".$id_lab."' WHERE nim='".$nim."'";

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
				Update Data Laboratorium
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
								<label>Laboratorium</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorLab)) echo $errorLab;?></span>
								<input class="form-control" type="text" name="id_lab" maxlength="50" size="30"  required value="<?php if(isset($id_lab)){echo $id_lab;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="daftar_penempatan.php"><button class="btn btn-info">Kembali ke Daftar Penempatan</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>