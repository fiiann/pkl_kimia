<?php
	require_once('functions.php');
	
	if(!isset($_SESSION['sip_masuk_aja'])){
	  header("Location:./login.php");
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php $site_name ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-thumbs-o-up"></i> <?php echo $site_name ?></a> 
            </div>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<a href="profil.php" title='Ubah Password' style="color:#fff; font-size:12px;"><i class="fa fa-lock"></i> <?php if($status=="petugas") echo $petugas->nama; else echo $anggota->nama; ?> </a>&nbsp;&nbsp;
				<a style="text-decoration: none; color:#fff; font-size:12px;"> <?php
					echo " ( ".date("D, Y-m-d") . " ". date("h:ia")." )&nbsp;&nbsp;";
				?>
				</a>
				<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
			</div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
					<img src="assets/img/user/default.jpg" class="user-image img-responsive"/>
				</li>
				<li>
					<a class="active-menu" href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
				</li>
				<?php
				if($status=="petugas"){
					echo '<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i> Kelola PKT<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="p_daftar_pkt.php">Pendaftaran PKT</a></li>
							<li><a href="daftar_pkt.php">Daftar Mahasiswa PKT</a></li>
							
							<li><a href="mhs_lab.php">Input penempatan mahasiswa</a></li>
							<li><a href="daftar_penempatan.php">Daftar penempatan mahasiswa</a></li>
							<li><a href="bimbingan.php">Input bimbingan mahasiswa</a></li>
							<li><a href="daftar_bimbingan.php">Daftar bimbingan mahasiswa</a></li>
							<li><a href="input_nilai_pkt.php">Input nilai PKT</a></li>
							<li><a href="nilai_pkt.php">Daftar Nilai PKT</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i> Kelola Mahasiswa<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="daftar_anggota.php">Data Anggota</a></li>
							<li><a href="tambah_anggota.php">Tambah Anggota</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i> Kelola Mahasiswa<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="daftar_petugas.php">Data Petugas</a></li>
							<li><a href="tambah_petugas.php">Tambah Petugas</a></li>
						</ul>
					</li>';
				}elseif ($status=="anggota") {
					echo '<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i> Kelola PKT<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="p_daftar_pkt.php">Pendaftaran PKT</a></li>
							<li><a href="daftar_pkt.php">Daftar Mahasiswa PKT</a></li>
							
							
							<li><a href="daftar_penempatan.php">Daftar penempatan mahasiswa</a></li>
							
							<li><a href="daftar_bimbingan.php">Daftar bimbingan mahasiswa</a></li>
							
							<li><a href="nilai_pkt.php">Daftar Nilai PKT</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i> Informasi<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="daftar_petugas.php">Data Petugas</a></li>
							<li><a href="tambah_petugas.php">Tambah Petugas</a></li>
						</ul>
					</li>';
				}
				?>				
				<li> 
						<?php
							if($status=='petugas'){
								echo '<a href="#"><i class="fa fa-edit fa-2x"></i> Kelola TR1';
							}else{
								echo '<a href="#"><i class="fa fa-book fa-2x"></i> Kelola TR1';
							}
						?>
					<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li><a href="pendaftaran_tr1.php">Pendaftaran TR1</a></li>
						<li><a href="daftar_tr1.php">Daftar Mahasiswa TR1</a></li>
				<?php
					if($status=='anggota'){
						echo '<li><a href="peminjaman_anggota.php">Nilai TR1</a></li>';
					}
				?>
				<?php
					if($status=='petugas'){
						echo '<li><a href="anggota_pinjam.php">Input Nilai</a></li>';
					}
				?>
					</ul>
				</li>  
				<?php
					if($status=='petugas'){
					echo '<li>
						<a href="#"><i class="fa fa-edit fa-2x"></i>Informasi<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li><a href="dosen_lab.php">Daftar Lab Pembimbing</a></li>
							<li><a href="input_jadwal.php">Input Jadwal</a></li>
							<li><a href="daftar_jadwal.php">Daftar Jadwal</a></li>
						</ul>
					</li>  ';
					}
				?>
					<li>
                        <a  href="http://localhost/sip/index.php#about"><i class="fa fa-square-o fa-2x"></i> About</a>
					</li>	
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">