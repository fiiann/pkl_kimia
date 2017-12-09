<?php
	require_once('sidebar.php');
	require_once('datediff.php');
	$id=$_SESSION['sip_masuk_aja'];
	if(($status=="dosen")||($status=="lab")){
		header('Location:./index.php');
	}

	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$sukses=TRUE;

	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nim


		$tgl_awal=$_POST['tgl_awal'];
		$tgl_awal = test_input($_POST['tgl_awal']);
		if($tgl_awal == '' || $tgl_awal == "none"){
			$error_tgl_awal= "Tanggal harus diisi";
			$valid_tgl_awal= FALSE;
		} else{
			$valid_tgl_awal= TRUE;
		}

		$tgl_akhir=$_POST['tgl_akhir'];
		$tgl_akhir = test_input($_POST['tgl_akhir']);
		if($tgl_akhir == '' || $tgl_akhir == "none"){
			$error_tgl_akhir= "Tanggal harus diisi";
			$valid_tgl_akhir= FALSE;
		} else{
			$valid_tgl_akhir= TRUE;
		}



		// jika tidak ada kesalahan input
		if ($valid_tgl_awal && $valid_tgl_akhir) {
			$tgl_awal=$con->real_escape_string($tgl_awal);
			$tgl_akhir=$con->real_escape_string($tgl_akhir);


			$query = "UPDATE petugas SET tgl_awal='".$tgl_awal."',tgl_akhir='".$tgl_akhir."' WHERE idpetugas=1";


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
<?php

		$button='<input class="form-control" type="submit"  name="daftar" value="Daftar">';


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/moment.js"></script>
  <script type="text/javascript" src="assets/js/transition.js"></script>
  <script type="text/javascript" src="assets/js/collapse.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
</head>
<!-- $todayDate = date("Y-m-d");// current date -->
<body>

<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Daftar PKT
				<?php echo $keterangan; ?>

			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>

							<!-- NIM -->
							<div class="form-group">
								<label>Tanggal Awal</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_tgl_awal)) echo $error_tgl_awal;?></span>
								<input class="form-control" type="date" name="tgl_awal" maxlength="14" size="30" placeholder="tanggal" required autofocus >
							</div>


							<div class="form-group">
								<label>Tanggal Akhir</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_tgl_akhir)) echo $error_tgl_akhir;?></span>
								<input class="form-control" type="date" name="tgl_akhir" maxlength="14" size="30"  placeholder="tanggal" required autofocus>
							</div>
							<!-- <table>
								<tr>
									<td class="col-sm-3" align="top">Tanggal Mulai</td>
									<td valign="top">:</td>
									<td valign="top"><div class="container">
								<div class="row">
										<div class='col-sm-3'>
												<div class="form-group">
														<div class='input-group date' id='date_start' name='date_start'>
																<input type='text' class="form-control" name='date_start1'/>
																<span class="input-group-addon">
																		<span class="glyphicon glyphicon-calendar"></span>
																</span>
														</div>
												</div>
										</div>
										<script type="text/javascript">
												$(function () {
														$('#date_start').datetimepicker();
												});
										</script>
								</div>
								</div>
									</td>

								</tr>

									<tr><td><br></td></tr>

									<tr>
										<td class="col-sm-3" valign="top">Tanggal Selesai</td>
										<td valign="top">:</td>
										<td valign="top"><div class="container">
									<div class="row">
											<div class='col-sm-3'>
													<div class="form-group">
															<div class='input-group date' id='date_finish' name='date_finish'>
																	<input type='text' class="form-control" name='date_finish1' />
																	<span class="input-group-addon">
																			<span class="glyphicon glyphicon-calendar"></span>
																	</span>
															</div>
													</div>
											</div>
											<script type="text/javascript">
													$(function () {
															$('#date_finish').datetimepicker();
													});
											</script>
									</div>
									</div>
										</td>

									</tr>
							</table> -->



							<div class="form-group">

								 <?php echo $button;  ?>
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
