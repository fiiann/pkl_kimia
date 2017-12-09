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
		if($_GET['id']==""){
			header('Location:./daftar_bimbingan.php');
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
					$nama=$row->nama;
					$nim=$row->nim;
					$nip = $row->nip1;
					$nip2 = $row->nip2;
					$nip3 = $row->nip3;
				}
			}
		}else{
			// Cek Nama


			$nip=test_input($_POST['pilihan1']);
			if ($nip=='') {
				$errorNip='wajib diisi';
				$validNip=FALSE;
			}else{
				$validNip=TRUE;
			}
			$nip2=test_input($_POST['pilihan2']);
			if ($nip2==$nip ) {
				$errorNip2='Dosen harus berbeda';
				$validNip2=FALSE;
				$pesan_gagal="Dosen harus berbeda";
			}else{
				$validNip2=TRUE;
			}

			$nip3=test_input($_POST['pilihan3']);
			// if (($nip3==$nip2) && ($nip2=='none')) {
			// 	$validNip3=TRUE;
			// }elseif ($nip==$nip3) {
			// 	$errorNip3='Dosen harus berbeda';
			// 	$validNip3=FALSE;
			// }elseif (($nip3==$nip2)&& ($nip2!='none')) {
			// 	$errorNip3='Dosen harus berbeda';
			// 	$validNip3=FALSE;
			// }else {
			// 	$validNip3=TRUE;
			// }
			// if (($nip3==$nip)||($nip3==$nip2) ) {
			// 	$errorNip3='Dosen harus berbeda';
			// 	$pesan_gagal="Dosen harus berbeda";
			// 	$validNip3=FALSE;
			// }else{
			// 	$validNip3=TRUE;
			// }
			if (($nip3==$nip2)&&($nip3=='none') ) {
				$validNip3=TRUE;
			}elseif (($nip3==$nip)||($nip3==$nip2)) {
				$errorNip3='Dosen harus berbeda';
				$pesan_gagal="Dosen harus berbeda";
				$validNip3=FALSE;
			}
			else{
				$validNip3=TRUE;
			}


			// jika tidak ada kesalahan input
			if ($validNip && $validNip2 && $validNip3) {

				$nip=$con->real_escape_string($nip);
				// $nip2=$con->real_escape_string($nip2);
				// $nip3=$con->real_escape_string($nip3);
				if (($nip2=='none')&&($nip3=='none')) {
					$query = "UPDATE tr1 SET nip1 ='".$nip."' WHERE id_tr1='".$id_tr1."'";
				}elseif (($nip3=='none')&&($nip2!='none')) {
					$query = "UPDATE tr1 SET nip1 ='".$nip."',nip2 ='".$nip2."',nip3 ='".$nip3."' WHERE id_tr1='".$id_tr1."'";
				}elseif (($nip3!='none')&&($nip2=='none')) {
					$query = "UPDATE tr1 SET nip1 ='".$nip."',nip2 ='".$nip2."',nip3 ='".$nip3."' WHERE id_tr1='".$id_tr1."'";
				}elseif ($nip3=='none') {
					$query = "UPDATE tr1 SET nip1 ='".$nip."',nip2 ='".$nip2."' WHERE id_tr1='".$id_tr1."'";
				}else {
					$query = "UPDATE tr1 SET nip1 ='".$nip."',nip2 ='".$nip2."',nip3 ='".$nip3."' WHERE id_tr1='".$id_tr1."'";
				}


				$hasil=$con->query($query);
				if (!$hasil) {
					die("Tidak dapat menjalankan query database: <br>".$con->error);
				}else{
					$sukses=TRUE;
					$pesan_sukses="berhasil update bimbingan";


				}
				// $pesan_sukses="berhasil update bimbingan";
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
					Bimbingan TR1
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form method="POST" role="form" autocomplete="on" action="">
								<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
								<span class="label label-warning"><?php if(isset($pesan_gagal)) echo $pesan_gagal;?></span>

								<div class="form-group">
									<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorid_tr1)) echo $errorid_tr1;?></span>
									<input class="form-control" type="text" name="id_tr1" maxlength="14" size="30" readonly value="<?php echo $nama; ?>">
								</div>
								<div class="form-group">
									<label>Dosen  </label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip)) echo $errorNip;?></span>&nbsp;
									<select id="pilihan1" name="pilihan1" required >
									<!-- <option value="none">--Pilih Dosen--</option> -->
									<?php
											$querykat1 = "select dosen_pembimbing,nama_dosen from pkt left join dosen on pkt.dosen_pembimbing=dosen.nip where pkt.nim=$nim";
											$resultkat1 = $db->query($querykat1);
											$row1 = $resultkat1->fetch_object();
											echo '<option value='.$row1->dosen_pembimbing.'>'.$row1->nama_dosen.'</option>';
											$querykat = "select * from dosen where nip <> '".$row1->dosen_pembimbing."'";
											$resultkat = $db->query($querykat);
											if(!$resultkat){
												die("Could not connect to the database : <br/>". $db->connect_error);
											}
											while ($row = $resultkat->fetch_object()){
												$kid = $row->nip;
												$kname = $row->nama_dosen;
												echo '<option value='.$kid.' ';
												if(isset($nip) && $nip==$kid)
												echo 'selected="true"';
												echo '>'.$kname.'<br/></option>';
											}
										?></select>

									</div>

									<div class="form-group">
										<label>Dosen 2</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip2)) {echo $errorNip2;}?></span>&nbsp;
										<select id="pilihan2" name="pilihan2">
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
													if(isset($nip2) && $nip2==$kid)
													echo 'selected="true"';
													echo '>'.$kname.'<br/></option>';
												}
											?></select>
											<!-- <span class="error">* <?php if(!empty($errorNip2)) echo $errorNip2; ?></span> -->
										</div>

										<div class="form-group">
											<label>Dosen 3</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip3)) echo $errorNip3;?></span>&nbsp;
											<select id="pilihan3" name="pilihan3">
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
														if(isset($nip3) && $nip3==$kid)
														echo 'selected="true"';
														echo '>'.$kname.'<br/></option>';
													}
												?></select>
												<!-- <span class="error">* <?php if(!empty($error_pilihan3)) echo $error_pilihan3; ?></span> -->
											</div>

								<div class="form-group">
									<input class="form-control" type="submit" name="edit" value="Update Data">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<a href="daftar_bimbingan_tr1.php"><button class="btn btn-info">Kembali ke daftar bimbingan</button></a>
		</div>
	</div>

	<?php
	include_once('footer.php');
	$con->close();
	?>
