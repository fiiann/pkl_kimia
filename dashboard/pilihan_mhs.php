<?php 
  $site_name = "Pilihan Laboratorium Mahasiswa";
  require_once('sidebar.php');
  $id=$_SESSION['sip_masuk_aja'];
  if($status!="petugas"){
      header('Location:./index.php');
    }
  // echo $id;
  $query = "SELECT m.nama, pkt.nim, nama_lab FROM pkt LEFT JOIN mahasiswa m ON pkt.nim=m.nim LEFT JOIN lab ON pkt.pilihan_lab1=lab.idlab WHERE pkt.nim = '".$id."'";
  $result = $con->query($query);
  if (!result) {
    die('Could not connect to database : <br/>'.$con->error);
  }else{
    while ($row = $result->fetch_object()) {
      $nama = $row->nama;
      $nim = $row->nim;
      $lab1 = $row->nama_lab;
    }
  }
  // $query2 = "SELECT "
  // echo $nama;
  // echo $nim;
  // echo $lab1;
 ?>
  
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">Pilihan Mahasiswa PKT</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class= "table table-striped table-bordered table-hover">
              <thead align="center">
                <tr align="center">
                  <th rowspan="2">No</th>
                  <th rowspan="2">NIM</th>
                  <th rowspan="2">NAMA</th>
                  <th colspan="3" align="center">Laboratorium</th>
                </tr>
                <tr>
                  <th>Pilihan 1</th>
                  <th>Pilihan 2</th>
                  <th>Pilihan 3</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

 <?php 
  $con->close();
  include_once('footer.php');
 ?>