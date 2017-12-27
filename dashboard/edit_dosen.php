<?php 
	$site_name='Update Data Dosen';
	// $email = 'email@email.com';
	require_once("sidebar.php");
	$nip=$_GET['id'];
	if (!isset($_POST['edit'])) {
		$get_data = "SELECT * FROM dosen WHERE dosen.nip='".$nip."'";
		$data_dosen = $con->query($get_data);
		if (!$data_dosen) {
			die('Tidak dapat menjalankan query get data dosen. Error : <br>'.$con->error);
		} else {
			while ($row = $data_dosen->fetch_object()) {
				$email = $row->email;
				$nama = $row->nama_dosen;
				$alamat = $row->alamat;
				$topik = $row->topik;
				$no_telp = $row->no_telp;
				$idlab = $row->idlab;
			}
		}
	} else {
		$nip_baru = test_input($_POST['nip_new']);
    if ($nip_baru == ''){
      $errrorNip = "nip wajib diisi";
      $valid_nip = FALSE;
    }elseif(!preg_match("/^[0-9]{18}$/",$nip_baru)){
      $errrorNip = "NIP harus terdiri dari 18 digit angka";
      $valid_nip = FALSE;
    }else{
      $query = " SELECT * FROM dosen WHERE nip='".$nip."'";
      $result = $con->query( $query );
      if($result->num_rows!=0 && $nip!=$_POST['nip_new']){
        $errrorNip="nip sudah pernah digunakan, harap masukkan nip lain";
        $valid_nip=FALSE;
      }
      else{
        $valid_nip = TRUE;
      }
    }
    // Cek Nama
    $nama=test_input($_POST['nama']);
    if ($nama=='') {
      $errorNama='wajib diisi';
      $validNama=FALSE;
    }elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
      $errorNama='hanya mengizinkan huruf dan spasi';
      $validNama=FALSE;
    }else{
      $validNama=TRUE;
    }

    // cek alamat
    $alamat=test_input($_POST['alamat']);
    if ($alamat=='') {
      $errorAlamat='wajib diisi';
      $validAlamat=FALSE;
    }else{
      $validAlamat=TRUE;
    }

    // cek topik
    $topik=test_input($_POST['topik']);
    if($topik=='') {
      $errorTopik='wajib diisi';
      $validTopik=FALSE;
    }else{
      $validTopik=TRUE;
    }

    // cek email
    $email=test_input($_POST['email']);
   $query1 = "SELECT count(admin) as count_lab FROM lab WHERE admin='".$email."'";
      $result1 = $con->query($query1);
      $row = $result1->fetch_object();
      $count_lab = $row->count_lab;
      // echo "lab : ";
      // echo $count_lab;
      // echo "<br>";
      $query2 = "SELECT count(email) as count_mhs FROM mahasiswa WHERE email='".$email."'";
      $result2 = $con->query($query2);
      $row2 = $result2->fetch_object();
      $count_mhs = $row2->count_mhs;
      // echo "mhs : ";
      // echo $count_mhs;
      // echo "<br>";
      $query3 = "SELECT count(email) as count_admin FROM petugas WHERE email='".$email."'";
      $result3 = $con->query($query3);
      $row3 = $result3->fetch_object();
      $count_admin = $row3->count_admin;
      // echo "admin : ";
      // echo $count_admin;
      // echo "<br>";
      $query4 = "SELECT count(email) as count_dosen FROM dosen WHERE email='".$email."'";
      $result4 = $con->query($query4);
      $row4 = $result4->fetch_object();
      $count_dosen = $row4->count_dosen;
      // echo "dosen : ";
      // echo $count_dosen;
      // echo "<br>";
    if ($email=='') {
      $errorEmail='wajib diisi';
      $validEmail=FALSE;
    }else{
    	$query0 = "SELECT email FROM dosen WHERE nip='".$nip."'";
    	$result0 = $con->query($query0);
    	$rowz = $result0->fetch_object();
    	$email_lama = $rowz->email;

    	// $query = "SELECT count(email) as count_dosen FROM dosen WHERE email='".$email."'";
    	// $result = $con->query($query);
    	// $row = $result->fetch_object();
    	// $count_dosen = $row->count_dosen;
    	// $email_lab = $row1->count_lab;
    	// if ( ($count_dosen <= 1) && ($email_lama==$email)) {
    	if ( (($count_dosen == 0)|| ($email_lama==$email)) && ($count_mhs == 0) && ($count_admin == 0) && ($count_lab == 0) ) {
        $validEmail = TRUE;
    	} else {
    		$errorEmail = "Email sudah pernah digunakan";
      	$validEmail=FALSE;
    	}
    }

    // cek nomor telpon
    $no_telp=test_input($_POST['telpon']);
    if ($no_telp=='') {
      $errorTlp='wajib diisi';
      $validTlp=FALSE;
    }elseif (!preg_match("/^[0-9]*$/",$no_telp)) {
      $errorTlp='hanya mengizinkan angka 0-9';
      $validTlp=FALSE;
    }else{
      $validTlp=TRUE;
    }

    // jika tidak ada kesalahan input
    if ($valid_nip && $validNama && $validAlamat && $validTopik && $validEmail && $validTlp) {
      $nip_baru=$con->real_escape_string($nip_baru);
      $nama=$con->real_escape_string($nama);
      $alamat=$con->real_escape_string($alamat);
      $topik=$con->real_escape_string($topik);
      $email=$con->real_escape_string($email);
      $no_telp=$con->real_escape_string($no_telp);
			$query = "UPDATE dosen SET nama_dosen='".$nama."',email='".$email."', alamat='".$alamat."',topik='".$topik."', nip='".$nip_baru."', no_telp='".$no_telp."' WHERE nip='".$nip."'";
		$result = $con->query($query);
			if (!$result) {
		  	  die("Tidak dapat menjalankan query database: <br>".$con->error);
		  }else{
		     $berhasil = "Berhasil";
		  }
	}
}
	
	
    
?>
<div class="row">
  <div class="col-md-6">
    <!-- Form Elements -->
    <div class="panel panel-default">
      <div class="panel-heading">
        Update Data Dosen <span class="label label-success"><?php if(isset($berhasil)) echo $berhasil;?></span>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" role="form" autocomplete="on" action="">

              <div class="form-group">
                <label>NIP</label>&nbsp; <span class="label label-warning">*<?php if(isset($errrorNip)) echo $errrorNip;?></span>
                <input class="form-control" type="text" name="nip_new" maxlength="18" size="30" placeholder="nip 14 digit angka" required autofocus value="<?php if(isset($nip)) echo $nip; else echo $_POST['nip_new']; ?>">
              </div>
              <div class="form-group">
                <label>Nama</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorNama)) echo $errorNama;?></span>
                <input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
              </div>
              <div class="form-group">
                <label>Alamat</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorAlamat)) echo $errorAlamat;?></span>
                <textarea required class="form-control" name="alamat" placeholder="masukan alamat rumah" cols="26" rows="5" maxlength="150"><?php if(isset($alamat)){echo $alamat;} ?></textarea>
              </div>
              <div class="form-group">
                <label>topik</label>&nbsp; <span class="label label-warning">*<?php if(isset($errortopik)) echo $errortopik;?></span>
                <input class="form-control" type="text" name="topik" maxlength="50" size="30" placeholder="topik asal" required value="<?php if(isset($topik)){echo $topik;} ?>">
              </div>
              <div class="form-group">
                <label>Telp/HP</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorTlp)) echo $errorTlp;?></span>
                <input class="form-control" type="text" name="telpon" maxlength="15" size="30" placeholder="nomor telpon HP aktif" required value="<?php if(isset($no_telp)){echo $no_telp;} ?>">
              </div>
              <div class="form-group">
                <label>Email</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorEmail)) echo $errorEmail;?></span>
                <input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(isset($email)){echo $email;} ?>">
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
</div>

<?php 
		include_once('footer.php');
		$con->close();
 ?>