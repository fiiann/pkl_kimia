<?php 
  $site_name = "Edit laboratorium";
  require_once("sidebar.php");
  // $nama='BIOKIMIAS';
  // $email = "biokimia@gmail.com"; 
  // $email = "agus@gmail.com"; 
  // $email = 'taufik@gmail.com'; 
  // $email = "anang@gmail.com"; 
  // $idlab = 1;
  $idlab= $_GET['id'];
  // echo "<b>edit dosen</b> <br>";
  if (!isset($_POST['edit'])) {
    $querys = "select * FROM lab where idlab='".$idlab."'";
    $results = $con->query($querys);
    if (!$results) {
      echo "Tidak dapat mengakses ke data lab. Error : ".$con->error;
    } else {
      while ($rows=$results->fetch_object()) {
        $nama_lab = $rows->nama_lab;
        $email = $rows->admin;
        $nip = $rows->nip;
      }
    }
  } else {
    $nama_lab = test_input($_POST['nama']);
    if ($nama_lab=='') {
			$errorNama='wajib diisi';
			$validNama=FALSE;
		}elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_lab)) {
			$errorNama='hanya mengizinkan huruf dan spasi';
			$validNama=FALSE;
		}else{
			$validNama=TRUE;
		}
    $nip = test_input($_POST['nip']);
    $validNip = TRUE;
    $email = test_input($_POST['email']);
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
			$query0 = "SELECT admin FROM lab WHERE idlab='".$idlab."'";
    	$result0 = $con->query($query0);
    	$rowz = $result0->fetch_object();
    	$email_lama = $rowz->admin;
			if ( (($count_lab == 0)|| ($email_lama==$email)) && ($count_dosen == 0) && ($count_admin == 0) && ($count_mhs == 0) ) {
        $validEmail = TRUE;
    	} else {
    		$errorEmail = "Email sudah pernah digunakan";
      	$validEmail=FALSE;
    	}
		}
    // $nama_lab="BIOKIMIAA";
    // $email="bio@gmail.com";
    // $nip="240103141200022222";
    // echo $email;
    if ($validNama && $validEmail && $validNip) {
	    $query = "UPDATE lab SET nama_lab='".$nama_lab."', admin='".$email."', nip='".$nip."' WHERE idlab='".$idlab."'";
	    $result = $con->query($query);
	    if (!$result) {
	      echo "gagal<br>";
	      echo $con->error;
	    } else {
	    	$sukses = TRUE;
	      $berhasil = 'Berhasil';
	    }
    } else {
    	$sukses = FALSE;
    }
  }
  

  
  // echo "input : ".$email."<br>";
  
?>
<div class="row">
  <div class="col-md-6">
    <!-- Form Elements -->
    <div class="panel panel-default">
      <div class="panel-heading"><!-- <?php echo $nama_lab; ?> -->
        Update Data Lab <span class="label label-success"><?php if(isset($berhasil)) echo $berhasil;?></span>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" role="form" autocomplete="on" action="">
              <div class="form-group">
                <label>Nama</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorNama)) echo $errorNama;?></span>
                <input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama_lab)){echo $nama_lab;} ?>">
              </div>
              <div class="form-group">
                <label>Dosen</label>&nbsp;<span class="label label-warning">*<?php if(isset($errorNip)) echo $errorNip;?></span>&nbsp;
                <select id="nip" name="nip" required>
                <option value="none">--Pilih Dosen--</option>
                <?php
                    $querykat = "select * from dosen WHERE idlab='".$idlab."'";
                    $resultkat = $con->query($querykat);
                    if(!$resultkat){
                      die("Could not connect to the database : <br/>". $db->connect_error);
                    }
                    while ($row1 = $resultkat->fetch_object()){
                      $kid = $row1->nip;
                      $kname = $row1->nama_dosen;
                      echo '<option value='.$kid.' ';
                      if(isset($nip) && $nip==$kid)
                      echo 'selected="true"';
                      echo '>'.$kname.'<br/></option>';
                    }

                  ?></select>
                  <span class="error"> <?php if(!empty($errorNip)) echo $errorNip; ?></span>
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
    <a href="daftar_lab.php"><button class="btn btn-info">Kembali ke Daftar Lab</button>
  </div>
</div>

<?php 
	$con->close();
	include_once('footer.php');
?>