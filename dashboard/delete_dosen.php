<?php
$nip = $_GET['id'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the queryd
$query = " SELECT * FROM dosen WHERE nip='".$nip."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>NIM</td>';
				echo '<td> : '.$row->nip.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Nama</td>';
				echo '<td> : '.$row->nama_dosen.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Email</td>';
				echo '<td> : '.$row->email.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Alamat</td>';
				echo '<td> : '.$row->alamat.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Topik</td>';
				echo '<td> : '.$row->topik.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus data dosen ini? <a href="delete.php?data=dosen&id='.$row->nip.'">YA</a> / <a href="daftar_dosen.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>
