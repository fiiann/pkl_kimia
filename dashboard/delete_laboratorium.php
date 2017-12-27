<?php
$id = $_GET['id'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the queryd
$query = " SELECT * FROM lab WHERE idlab='".$id."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>Nama Lab</td>';
				echo '<td> : '.$row->nama_lab.'</td>';
			echo '</tr>';

		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus data lab ini? <a href="delete.php?data=lab&id='.$id.'">YA</a> / <a href="daftar_lab.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>
