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
    <title>Cetak Pe</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <title><?php $site_name ?></title> -->
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
    <div class="row" >
    	<div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-default">
    			<div class="panel-body">
    				<div class="col-md-9 col-sm-12 col-xs-12">
    					Search : <input class="form-control" type="text" name="search" placeholder="Masukkan nama, nim," id="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
    				</div>
    				<div class="col-md-2 col-sm-12 col-xs-12">
    					Page :
    				<select class='form-control' id='page'>
    				<?php
    					$query = "SELECT count(nim) as jml_data FROM tr1";
    					// Execute the query
    					$result = $con->query( $query );
    					$row = $result->fetch_object();
    					$jml_data=$row->jml_data;
    					$total_page=ceil($jml_data/10);
    					for($i=1;$i<=$total_page;$i++){
    						echo "<option value='".$i."'>".$i."</option>";
    					}
    				?>
    				</select>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- /. ROW  -->
    <div class="row" >
    	<div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    			   Penempatan Laboratorium
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped table-bordered table-hover">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>NIM</th>
    								<th>Nama</th>
    								<th>Laboratorium</th>
    								<!-- <?php
    									if ($status=="petugas") {
    										echo "<th>Action</th>";
    									}
    							    ?> -->
    							</tr>
    						</thead>
    						<tbody id="hasil_cari">
    						<?php
    							// Assign a query
    							if ($status=="petugas") {
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.idlab_tr1 IS NOT NULL ORDER BY m.nama LIMIT 10";
    							}elseif ($status=="dosen"){
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.nip1='".$dosen->nip."'";
    							}elseif ($status=="lab"){
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  LEFT JOIN lab ON t.idlab_tr1=lab.idlab WHERE t.idlab_tr1='".$lab->idlab."'";
    							}else {
    								$query = "SELECT * FROM tr1 t INNER JOIN mahasiswa m ON t.nim=m.nim  WHERE t.nim='".$anggota->nim."'";
    							}

    							// Execute the query
    							$result = $con->query( $query );
    							if(!$result){
    								die('Could not connect to database : <br/>'.$con->error);
    							}
    							$i=1;
    							while($row = $result->fetch_object()){
    								echo "<tr align='center'>";
    								echo "<td>".$i."</td>";$i++;
    								echo "<td>".$row->nim."</td>";
    								echo "<td>".$row->nama."</td>";
    								echo "<td>".$row->nama_lab."</td>";
    								// if ($status=="petugas") {
    								// echo "<td align='center'>
    								// 		<a href='edit_lab1.php?id=".$row->id_tr1."'><i class='fa fa-edit'></i></a>&nbsp;
                    //
    								// 	 </td>";
    								// }
    								// <a href='delete_penempatan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
    								echo "</tr>";
    							}
    						?>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </body>
</html>

<?php
mysqli_close($con);
include_once('footer.php');
?>
