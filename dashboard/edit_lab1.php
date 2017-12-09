<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
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
		header('Location:./daftar_tr1.php');
	}
	$id_tr1=$_GET['id'];

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		$query = " SELECT * FROM tr1 left join mahasiswa m on tr1.nim=m.nim WHERE id_tr1='".$id_tr1."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $id_tr1=$row->id_tr1;
				$nama = $row->nama;
				$lab = $row->idlab_tr1;
				$pilihan1 = $row->pilihan1;
				$pilihan2 = $row->pilihan2;
				$pilihan3 = $row->pilihan3;
				$pilihan4 = $row->pilihan4;
				$pilihan5 = $row->pilihan5;
			}
			if ($lab=$pilihan1) {
				$pilihan1=$lab;
			}elseif ($lab=$pilihan2) {
				$tmp = $pilihan1;
				$pilihan1=$pilihan2;
				$$pilihan2=$tmp;
			}elseif ($lab=$pilihan3) {
				$tmp1 = $pilihan1;
				$pilihan1=$lab;
				$pilihan3=$pilihan2;
				$pilihan2=$tmp1;
			}elseif ($lab=$pilihan4) {
				$tmp2=$pilihan1;
				$pilihan1=$lab;
				$pilihan4=$pilihan3;
				$pilihan3=$pilihan2;
				$pilihan2=$tmp;
			}else {
				$tmp3=$pilihan1;
				$pilihan1=$pilihan5;
				$pilihan5=$pilihan4;
				$pilihan4=$pilihan3;
				$pilihan3=$pilihan2;
				$pilihan2=$tmp3;
			}
		}
	}else{
		// Cek Nama

		$lab=test_input($_POST['lab']);
		if ($lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}



		// jika tidak ada kesalahan input
		if ($validLab) {

			$lab=$con->real_escape_string($lab);

			$query = "UPDATE tr1 SET  idlab_tr1='".$lab."' WHERE id_tr1='".$id_tr1."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				// echo $lab;
				// echo "<br/>Berhasil edit data";
				$pesan_sukses='berhasil update data';
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
				Penempatan Laboratorium
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>Nama</label>
								<input class="form-control" type="text" name="id_tr1" maxlength="14" readonly size="30" value="<?php echo $nama; ?>">
							</div>

							<div class="form-group">
											<label>LABORATORIUM</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_Lab)) echo $error_Lab;?></span>&nbsp;
											<select id="lab" name="lab" required>
							<option value="none">--Pilih lab --</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$sid = $row->idlab;
									$sname = $row->nama_lab;
									echo '<option value='.$sid.' ';
									if(isset($lab) && $lab==$sid)
									echo 'selected="true"';
									echo '>'.$sname.'<br/></option>';
									//echo "cek";
								}
							?></select>
							<span class="error">* <?php if(!empty($error_Lab)) echo $error_Lab; ?></span>
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
	&nbsp;&nbsp;&nbsp;<a href="daftar_penempatan_tr1.php"><button class="btn btn-info">Kembali ke Daftar Penempatan</button></a>
</div>

<?php
include_once('footer.php');
$con->close();
?>
