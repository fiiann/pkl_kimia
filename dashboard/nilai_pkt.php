<?php
  $site_name = "Daftar Nilai PKT";
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	// require_once('db_login.php');
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Nilai PKT</title>
</head>
<script type="text/javascript">
  $(document).ready(function(){
    $('#tabelku').DataTable();
});
</script>
<style>
.buttonku {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 20px 36px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 30px 2px;
    cursor: pointer;
}
</style>
<script>
      $(document).ready(function(){
           $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
           });
           $(function(){
                $("#from_date").datepicker();
                $("#to_date").datepicker();
           });
           $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' && to_date != '')
                {
                     $.ajax({
                          url:"ajax_func/search_nilai_pkt.php",
                          method:"POST",
                          data:{from_date:from_date, to_date:to_date},
                          success:function(data)
                          {
                               $('#hasil_cari').html(data);
                          }
                     });
                }
                else
                {
                     alert("Please Select Date");
                }
           });
      });
 </script>
<body>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-3">
						From :
             <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
          </div>
          <div class="col-md-3">
						To :
             <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
          </div>
          <div class="col-md-3">
						<br>
             <input type="buttonku" name="filter" id="filter" value="Filter" class="btn btn-info" />
          </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					 Daftar Nilai PKT
				</div>
				<div class="panel-body">
					<div class="table-responsive" id="search">
						<table class="table table-striped table-bordered table-hover" id="tabelku">
						  <thead>
						    <tr>
						      <th rowspan="2">No</th>
						      <th rowspan="2">NIM</th>
						      <th rowspan="2">Nama</th>
						      <th colspan="5">Nilai</th>
						      <?php if ($status=="petugas"||$status=="dosen") {
						        echo "<th rowspan='2'>Action</th>";
						      } ?>

						    </tr>
						    <tr>
						      <th>Praktikum</th>
						      <th>Laporan</th>
						      <th>Presentasi</th>
						      <th>Akhir</th>
						      <th>Huruf</th>
						    </tr>
						  </thead>
						  <tbody id="hasil_cari">
						  <?php
						    // Assign a query
						    if ($status=="petugas") {
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nilai_huruf IS NOT NULL ORDER BY nama   ";

						    }elseif ($status=="dosen"){
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.dosen_pembimbing='".$dosen->nip."' AND p.nilai_huruf IS NOT NULL";
						    }elseif ($status=="lab"){
						      $query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN lab l ON p.flag_lab=l.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.nilai_huruf IS NOT NULL";
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
						      // <a href='delete_nilaipkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
						    }
						  ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	mysqli_close($con);
  include_once("footer.php");
?>
</body>
</html>
