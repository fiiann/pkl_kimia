<?php
require_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
if(isset($_GET['data'])){
	if($_GET['data']=='nilai_outline'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM nilai_outline WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM nilai_outline WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data Nilai Outline berhasil dihapus. <br />';
		}
		echo '<br/><a href="daftar_nilai_outline.php">Kembali Daftar Nilai Outline</a>';
	}elseif($_GET['data']=='nilai_progress'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM nilai_progress WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM nilai_progress WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data anggota berhasil dihapus. <br />';
		}
		echo '<a href="daftar_nilai_progress.php"><button class="btn btn-info">Kembali ke Daftar Nilai Progress</button></a>';
		// echo '<br/><a href="daftar_bimbingan.php">Daftar bimbingan</a>';
	}elseif($_GET['data']=='dosen'){
		$nip = $_GET['id'];
		$query = "SELECT * FROM dosen WHERE nip='".$nip."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM dosen WHERE nip='".$nip."'";
			$result = $con->query( $query );
			echo 'Data dosen berhasil dihapus. <br />';
		}
		echo '<a href="daftar_dosen.php"><button class="btn btn-info">Kembali ke Daftar Dosen</button></a>';
		// echo '<br/><a href="daftar_bimbingan.php">Daftar bimbingan</a>';
	}elseif($_GET['data']=='bimbingan'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM bimbingan WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM bimbingan WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data anggota berhasil dihapus. <br />';
		}
		echo '<a href="daftar_bimbingan.php"><button class="btn btn-info">Kembali ke Daftar bimbingan</button></a>';
		// echo '<br/><a href="daftar_bimbingan.php">Daftar bimbingan</a>';
	}elseif($_GET['data']=='nilai_pkt'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM nilai_pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data anggota berhasil dihapus. <br />';
		}
		echo '<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Daftar Nilai PKT</button></a>';
	}elseif($_GET['data']=='pkt'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM pkt WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data mahasiswa PKT berhasil dihapus. <br />';
		}
		echo '<a href="daftar_pkt.php"><button class="btn btn-info">Kembali ke Daftar PKT</button></a>';
		// echo '<br/><a href="daftar_pkt.php">Daftar  PKT</a>';
	}elseif($_GET['data']=='mahasiswa'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM mahasiswa WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM mahasiswa WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data mahasiswa berhasil dihapus. <br />';
		}
		echo '<a href="daftar_anggota.php"><button class="btn btn-info">Kembali ke Daftar mahasiswa1</button></a>';
		// echo '<br/><a href="daftar_pkt.php">Daftar  PKT</a>';
	}elseif ($_GET['data']=='tr1') {
		$nim = $_GET['nim'];
		$query = "SELECT * FROM tr1 WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM tr1 WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data mahasiswa TR1 berhasil dihapus. <br />';
		}
		echo '<a href="daftar_tr1.php"><button class="btn btn-info">Kembali ke Daftar TR1</button></a>';
	}
	elseif($_GET['data']=='penempatan'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM penempatan WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM penempatan WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data anggota berhasil dihapus. <br />';
		}
		echo '<a href="daftar_penempatan.php"><button class="btn btn-info">Kembali ke Daftar Penempatan</button></a>';
		// echo '<br/><a href="daftar_penempatan.php">Daftar Penempatan</a>';
	}elseif($_GET['data']=='petugas'){
		$id = $_GET['id'];
		$query = "SELECT * FROM petugas WHERE idpetugas='".$id."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM petugas WHERE idpetugas='".$id."'";
			$result = $con->query( $query );
			echo 'Data petugas berhasil dihapus. <br />';
		}
		echo '<a href="daftar_petugas.php"><button class="btn btn-info">Kembali ke Daftar Petugas</button></a>';
		// echo '<br/><a href="daftar_petugas.php">Daftar Petugas</a>';
	}elseif($_GET['data']=='judul_pkt'){
		$nim = $_GET['nim'];
		$query = "SELECT * FROM pkt WHERE nim='".$nim."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			echo 'Data judul mahasiswa berhasil dihapus. <br />';
		}
		echo '<a href="daftar_judul.php"><button class="btn btn-info">Kembali ke Daftar Judul</button></a>';
		// echo '<br/><a href="daftar_petugas.php">Daftar Petugas</a>';
	}elseif($_GET['data']=='lab'){
		$id = $_GET['id'];
		$query = "SELECT * FROM lab WHERE idlab='".$id."'";
		$result = $con->query( $query );
		if(mysqli_num_rows($result)==0){
			echo 'Penghapusan data gagal. Data tidak ditemukan.<br/>';
		}else{
			$query = "DELETE FROM lab WHERE idlab='".$id."'";
			$result = $con->query( $query );
			echo 'Data lab berhasil dihapus. <br />';
		}
		echo '<a href="daftar_lab.php"><button class="btn btn-info">Kembali ke Daftar Lab</button></a>';
		// echo '<br/><a href="daftar_petugas.php">Daftar Petugas</a>';
	}else{
		echo 'Tidak ada data dihapus.';
	}

}else{
	echo 'Tidak ada data dihapus. Data tidak dikenali.';
}

$con->close();
include_once('footer.php');
?>
