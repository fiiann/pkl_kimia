
<?php
 require_once("functions.php");
 if(isset($_POST["from_date"], $_POST["to_date"]))
 {
   if ($status=="petugas") {
     $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE tgl_lulus BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";

   }elseif ($status=="dosen"){
     $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.dosen_pembimbing='".$dosen->nip."' AND p.nilai_huruf IS NOT NULL AND tgl_lulus BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
   }elseif ($status=="lab"){
     $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN lab l ON p.flag_lab=l.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.nilai_huruf IS NOT NULL AND tgl_lulus BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
   }else{
     $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
   }

   // Execute the query
   $result = $con->query( $query );
   if(!$result){
     die('Could not connect to database : <br/>'.$con->error);
   }
   $i=1;
   $nim=$row->nim;
   // $row=$result->fetch_object();
   // $nilai_akhir=$row->nilai_praktikum;
   while($row = $result->fetch_object()){

     echo "<tr>";
     echo "<td>".$i."</td>";$i++;
     echo "<td>".$row->nim."</td>";
     echo "<td>".$row->nama."</td>";
     echo "<td align='center'>".$row->nilai_praktikum."</td>";
     echo "<td align='center'>".$row->nilai_laporan."</td>";
     echo "<td align='center'>".$row->nilai_presentasi."</td>";
     echo "<td align='center'>".$row->nilai."</td>";
     echo "<td align='center'>".$row->nilai_huruf."</td>";
     if ($status=="petugas"||$status=="dosen"){
       echo "<td align='center'>
           <a href='input_nilai_pkt1.php?id=".$row->id_pkt."'><i class='fa fa-edit'></i></a>&nbsp;</td>";
     }

     echo "</tr>";
   }
 }else {

   echo "<tr><td>Not found</td></tr>";
 }
 ?>
