<?php
  ob_start();
  error_reporting(0);
  
	require_once('connect.php');
	
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if(mysqli_connect_errno()){
		die('Could not connect to database : <br/>'.$mysqli_connect_error());
	}

	$site_name="SIP";

	date_default_timezone_set("Asia/Jakarta");
					
	session_start();
	
	if(isset($_SESSION['sip_masuk_aja'])){
		if($_SESSION['sip_status']=='petugas'){
			$query = "SELECT * FROM petugas WHERE idpetugas=".$_SESSION['sip_masuk_aja']."";
			$petugas=mysqli_query($con,$query); 
			$petugas=$petugas->fetch_object();
			$status=$_SESSION['sip_status'];
		}elseif($_SESSION['sip_status']=='anggota'){
			$query = "SELECT * FROM anggota WHERE nim=".$_SESSION['sip_masuk_aja']."";
			$anggota=mysqli_query($con,$query); 
			$anggota=$anggota->fetch_object();
			$status=$_SESSION['sip_status'];
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function hitungdenda($pinjam, $kembali){
		$selisih = ((abs(strtotime ($kembali) - strtotime ($pinjam)))/(60*60*24));
		if ($selisih <= 14){
			$selisih = 0;
		}else{
			$selisih = ($selisih-14) * 1000;
		}
		return $selisih;
	}
	
?>
