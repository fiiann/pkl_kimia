<?php
	include_once('functions.php');
	$id=$_SESSION['sip_masuk_aja'];
  if($status!="petugas"){
      header('Location:./index.php');
    }
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
    <div class="panel-body" onload="window.print();">
			<h5>Daftar Pendaftaran PKT</h5> 
			<h5>Departemen Kimia Universitas Diponegoro</h5>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead align="center">
            <tr align="center">
              <th rowspan="2">No</th>
              <th rowspan="2">NIM</th>
              <th rowspan="2">NAMA</th>
              <!-- <th>Wali</th>
              <th>Angkatan</th> -->
              <th colspan="3" align="center">Laboratorium</th>
              <!-- <th rowspan="2">Penempatan</th>
              <th rowspan="2">Bimbingan</th>
              <th rowspan="2">Nilai</th> -->
              <?php if (($status=='petugas')||($status=='lab')): ?>

                <!-- <th rowspan="2">Tempatkan</th>
                <th rowspan="2">Action</th> -->
              <?php endif; ?>
            </tr>
            <tr>
              <!-- <th>Wali</th>
              <th>Angkatan</th> -->
              <th>Pilihan 1</th>
              <th>Pilihan 2</th>
              <th>Pilihan 3</th>
            </tr>
          </thead>
          <tbody id="hasil_cari">
          <?php

            if (($status=="petugas")||($status=="lab")||($status=='dosen')) {
              $query = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab1=lab.idlab LIMIT 10";
              $query2 = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab2=lab.idlab LIMIT 10";
              $query3 = "SELECT * FROM pkt t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.pilihan_lab3=lab.idlab LIMIT 10";
            }elseif ($status=="anggota"){
              $query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab1=d.idlab WHERE m.nim='".$anggota->nim."'";
              $query2 = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab2=d.idlab WHERE m.nim='".$anggota->nim."'";
              $query3 = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN lab d ON p.pilihan_lab3=d.idlab WHERE m.nim='".$anggota->nim."'";
            }
            // elseif ($status=="dosen"){
            // 	$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip ORDER BY nama LIMIT 10";
            // }
            //$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
            $result = $con->query( $query );
            $result2 = $con->query( $query2 );
            $result3 = $con->query( $query3 );
            if(!$result){
              die('Could not connect to database : <br/>'.$con->error);
            }
            $i=1;
            while($row = $result->fetch_object()){
              echo "<tr align='center'>";
              echo "<td>".$i."</td>";$i++;

              echo "<td>".$row->nim."</td>";
              echo "<td>".$row->nama."</td>";
              // echo "<td>".$row->nama_wali."</td>";
              // echo "<td>".$row->angkatan."</td>";
              echo "<td>".$row->nama_lab."</td>";
              $row2=$result2->fetch_object();
              echo "<td align='center'>".$row2->nama_lab."</td>";
              $row3=$result3->fetch_object();
              echo "<td align='center'>".$row3->nama_lab."</td>";
              if (($status=="petugas")||($status=="lab")){
                // echo "<td align='center'>
                //   <a href='edit_lab.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;
                //  </td>";
                //  echo "<td align='center'>
                //   <a href='delete_pkt.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
                //  </td>";
              }
              echo "</tr>";
//
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>

<?php
mysqli_close($con);
include_once('footer.php');
?>
