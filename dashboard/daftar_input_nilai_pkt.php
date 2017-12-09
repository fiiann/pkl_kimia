<?php
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	if(($status=="anggota")||($status=="lab")){
		header('Location:./index.php');
	}
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script>
	function getQueryVariable(variable)
	{
		   var query = window.location.search.substring(1);
		   var vars = query.split("&");
		   for (var i=0;i<vars.length;i++) {
				   var pair = vars[i].split("=");
				   if(pair[0] == variable){return pair[1];}
		   }
		   return(false);
	}
	$(document).ready(function(){
		if(getQueryVariable("search")!=""){
			var search= getQueryVariable("search");
			$.ajax({
				url:"ajax_func/search_pkt.php?search="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');

				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
		}
		$('#search').keyup(function(){
			if($("#search").val()==undefined){
				var search="";
			}else{
				var search= $("#search").val();
			}
			$.ajax({
				url:"ajax_func/search_pkt.php?search="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
			$.ajax({
				url:"ajax_func/ajax_func.php?pkt=pkt&search="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#page").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#page").html(data);
				},
				error: function(){
					$("#page").html("The page can't be loaded");
				}
			});
			if(search==''){
				window.history.pushState("object or string", "Daftar PKT : "+search, "daftar_pkt.php");
			}else{
				window.history.pushState("object or string", "Daftar PLT : "+search, "daftar_pkt.php?search="+search);
			}
		});
		$('#page').change(function(){
			if($("#page").val()==undefined){
				var page="";
			}else{
				var page= $("#page").val();
			}
			if($("#search").val()==undefined){
				var search="";
			}else{
				var search= $("#search").val();
			}
			$.ajax({
				url:"ajax_func/search_pkt.php?search="+search+"&page="+page,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
		});
	});
</script>
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<!--  -->

				<div class="col-md-9 col-sm-12 col-xs-12">
					Search : <input class="form-control" type="text" name="search" placeholder="Masukkan nama, nim," id="search"  value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12">
					Page :
				<select class='form-control' id='page'>
				<?php
					$query = "SELECT count(nim) as jml_data FROM pkt";
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
				<?php
						if($status=='anggota'){
							echo "Status PKT";
						}else {
							echo "Input Pembimbing PKT";
							// echo "PENDAFTARAN PRAKTIKUM KIMIA TERPADU";
							// echo "<br>";
							// echo "SEMESTER GENAP TAHUN AKADEMIK 2016/2017";
							// echo "<br>";
							// echo "DEPARTEMEN KIMIA FAKULTAS SAINS DAN MATEMATIKA";
							// echo "<br>";
							// echo "UNIVERSITAS DIPONEGORO SEMARANG";
						}
				 ?>

			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead align="center">
							<tr align="center">
								<th rowspan="2">No</th>
								<th rowspan="2">Nama</th>
								<th rowspan="2">NIM</th>
								<th rowspan="2">Nilai</th>
								<!-- <th>Wali</th>
								<th>Angkatan</th> -->

									<!-- echo '<th rowspan="2">Judul</th>'; -->
							</tr>
						</thead>
						<tbody id="hasil_cari">
						<?php

							if (($status=="petugas")) {
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip	WHERE p.nilai_huruf IS NULL ORDER BY nama LIMIT 10";
							}elseif ($status=="anggota"){
								$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip WHERE m.nim='".$anggota->nim."'";
							}elseif ($status=="dosen"){
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip WHERE d.nip='".$dosen->nip."' AND p.nilai_huruf IS NULL ORDER BY nama LIMIT 10";
							}elseif ($status=='lab') {
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim LEFT JOIN dosen d ON p.dosen_pembimbing=d.nip INNER JOIN lab ON p.flag_lab=lab.idlab WHERE p.flag_lab='".$lab->idlab."' AND p.nilai_huruf IS NULL ORDER BY nama LIMIT 10";
							}
							//$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN dosen d ON m.id_dosen=d.nip WHERE m.id_dosen='".$dosen->nip."'"; //diganti
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							while($row = $result->fetch_object()){
								echo "<tr align='center'>";
								echo "<td>".$i."</td>";$i++;
								echo "<td>".$row->nama."</td>";
								echo "<td>".$row->nim."</td>";
								// echo "<td>".$row->nama_wali."</td>";
								// echo "<td>".$row->angkatan."</td>";

								if ($status=="anggota") {
									echo "<td>".$row->judul."</td>";
									echo "<td>".$row->flag_lab."</td>";
									echo "<td>".$row->nama_dosen."</td>";
									echo "<td>".$row->nilai_huruf."</td>";
									// echo "<td align='center'>
									// 	<a href='edit_daftar_pkt.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
									//  </td>";
								}elseif ($status=="petugas") {
									if($row->nilai == 0){
										echo "<td align='center'><a href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
									}else {
										echo "<td>".$row->nilai."</td>";
									}


								}elseif ($status=="dosen") {
									// if ($row->judul == null) {
									// 	echo "<td>
									// 			<a href='input_judul_pkt.php?nim=".$row->nim."'><button class='btn btn-info'>Input Judul PKT</button></a>
									// 		 </td>";
									// }else {
									// 	echo "<td>".$row->judul."</td>";
									// }
									if($row->nilai_huruf == null){
										echo "<td align='center'><a href='input_nilai_pkt1.php?id=".$row->id_pkt."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
									}else {
										echo "<td>".$row->nilai_huruf."</td>";
									}
								}
									// if($row->nilai_huruf == null){
									// 	echo "<td align='center'><a href='input_nilai_pkt.php?nim=".$row->nim."' class='btn btn-info btn-s' role='button'>Nilai</a></td>";
									// }else {
									// 	echo "<td>".$row->nilai_huruf."</td>";
									// }


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
