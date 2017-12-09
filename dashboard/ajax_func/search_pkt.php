<?php
	require_once('functions.php');

	if(isset($_GET['page'])){
		$page=$_GET['page'];
		$start = ($page-1)*10;
	}else{
		$page=1;
		$start=0;
	}

	// if(isset($_GET['search'])){
	// 	$search=$_GET['search'];
	// }else{
	// 	$search='';
	// }
	// Assign a query
  $tempat= $_GET['tempat'];
	$search=$_GET['search'];
	if($search==''){
		if ($tempat=='sudah') {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab WHERE d.flag_lab IS NOT NULL LIMIT 10 OFFSET $start";
		}else {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab WHERE d.flag_lab IS NULL LIMIT 10 OFFSET $start";
		}
		// $query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LIMIT 10 OFFSET $start";
	}elseif(($search=='')){
		$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim WHERE d.flag_lab IS NOT NULL LIMIT 10 OFFSET $start";
	}

	// Execute the query
	$result = $con->query( $query );
	if(!$result){
		die('Could not connect to database : <br/>'.$con->error);
	}
	$i=$start+1;
?>
<?php
	while($row = $result->fetch_object()){
		echo "<tr>";
		echo "<td>".$i."</td>";$i++;
		echo "<td>".$row->nim."</td>";
		echo "<td>".$row->nama."</td>";
		// if ($tempat=='sudah') {
		// 	$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab  WHERE d.flag_lab IS NOT NULL LIMIT 10 OFFSET $start";
		// }else {
		// 	$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab  WHERE d.flag_lab IS NULL LIMIT 10 OFFSET $start";
		// }
		// $result = $con->query( $query );
		// $row = $result->fetch_object();
		echo "<td>".$row->nama_lab."</td>";
		if ($tempat=='sudah') {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab WHERE d.flag_lab IS NOT NULL LIMIT 10 OFFSET $start";
		}else {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab WHERE d.flag_lab IS NULL LIMIT 10 OFFSET $start";
		}
		$result = $con->query( $query );
		$row = $result->fetch_object();
		echo "<td>".$row->nama_lab."</td>";
		if ($tempat=='sudah') {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab  WHERE d.flag_lab IS NOT NULL LIMIT 10 OFFSET $start";
		}else {
			$query = "SELECT * FROM pkt d LEFT JOIN mahasiswa a ON d.nim=a.nim LEFT JOIN lab ON d.flag_lab=lab.idlab  WHERE d.flag_lab IS NULL LIMIT 10 OFFSET $start";
		}
		$result = $con->query( $query );
		$row = $result->fetch_object();
		echo "<td>".$row->nama_lab."</td>";
		echo "<td align'center'>
		<a href='edit_lab.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
		<a href='delete_pkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
		</td>
		</tr>";
	}
?>
