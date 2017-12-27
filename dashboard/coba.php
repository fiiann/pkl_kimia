<?php 
  require_once("sidebar.php");
  // $nama='BIOKIMIAS';
  // $email = "biokimia@gmail.com"; 
  // $email = "agus@gmail.com"; 
  // $email = 'taufik@gmail.com'; 
  // $email = "anang@gmail.com"; 
  $idlab = 1;
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
    $nip = test_input($_POST['nip']);
    $email = test_input($_POST['email']);
    // $nama_lab="BIOKIMIAA";
    // $email="bio@gmail.com";
    // $nip="240103141200022222";
    // echo $email;
    $query = "UPDATE lab SET nama_lab='".$nama_lab."', admin='".$email."', nip='".$nip."' WHERE idlab='".$idlab."'";
    $result = $con->query($query);
    if (!$result) {
      echo "gagal<br>";
      echo $con->error;
    } else {
      $berhasil = 'Berhasil';
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
                    $querykat = "select * from dosen";
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
  </div>
</div>