<?php
	$site_name="Daftar Lab";
	include_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css">
<script src="assets/js/datatables.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
    $('#tabelku').DataTable();
});
</script>
<!-- /. ROW  -->
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			   Daftar Lab
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tabelku">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Dosen</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="hasil">
            <?php
            // Assign a query
              $query = "SELECT nama_lab,nama_dosen,lab.idlab as idlab FROM lab LEFT JOIN dosen ON lab.nip=dosen.nip ORDER BY idlab";
              // Execute the query
              $result = $con->query( $query );
              if(!$result){
                die('Could not connect to database : <br/>'.$con->error);
              }
              $i=1;
              while($row = $result->fetch_object()){
                echo "<tr>";
                echo "<td>".$i."</td>";$i++;
                echo "<td>".$row->nama_lab."</td>";
                echo "<td>".$row->nama_dosen."</td>";
                echo "<td>
                    <a href='edit_laboratorium.php?id=".$row->idlab."'><i class='fa fa-edit'></i></a>&nbsp;
                    <a href='delete_laboratorium.php?id=".$row->idlab."'><i class='fa fa-trash-o'></i></a>&nbsp;
                    <a href='repass.php?data=petugas&id=".$row->idlab."'><i class='fa fa-lock'></i></a>
                   </td>";
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
<?php
	mysqli_close($con);
	include_once('footer.php');
?>
