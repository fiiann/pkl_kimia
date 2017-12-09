<?php
	include_once('functions.php');
	$id=$_SESSION['sip_masuk_aja'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar PKT</title>
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
  <body onload="window.print();">
		Daftar Penempatan PKT <br>
		Departemen Kimia Universitas Diponegoro <br>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="15%">NIM</th>
              <th>Nama</th>
              <th width="30%">Lab</th>
            </tr>
          </thead>
          <tbody id="hasil_cari">
          <?php
            // Assign a query
            if (($status=="petugas")) {
              $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab ON p.flag_lab=lab.idlab WHERE p.flag_lab IS NOT NULL ORDER BY lab.idlab LIMIT 10";
            }
            elseif ($status=="dosen"){
              $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab l ON p.flag_lab=l.idlab LEFT JOIN dosen ON p.dosen_pembimbing=dosen.nip WHERE p.flag_lab='".$dosen->idlab."'";
            }
            elseif ($status=="lab"){
              $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.flag_lab='".$lab->idlab."'";
            }
            else {
              $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
            }

            // Execute the query
            $result = $con->query( $query );
            if(!$result){
              die('Could not connect to database : <br/>'.$con->error);
            }
            $i=1;
            while($row = $result->fetch_object()){
              $nim=$row->nim;
              echo "<tr align='center'>";
              echo "<td>".$i."</td>";$i++;
              echo "<td>".$nim."</td>";
              echo "<td>".$row->nama."</td>";
              echo "<td>".$row->nama_lab."</td>";
              // echo "";
              // if ($status=="petugas") {
              // echo "<td>".$row->nama_lab."</td><td align='center'></td>";
              // }
              // <a href='delete_penempatan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
              echo "</tr>";
            }
            $row = $result->fetch_object();
          ?>
          </tbody>
        </table>
      </div>
      <!-- <?php $hai='hai' ?>
      <?php $hai; ?>
      <?php echo $nim ?> -->
    </div>
  </body>
</html>

<?php
mysqli_close($con);
include_once('footer.php');
?>
