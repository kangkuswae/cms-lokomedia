<?php
	// Agar memastikan bahwa halaman ini diakses dengan parameter POST: bulan_tanggal
	isset($_POST['bulan_tanggal']) or die('Error Parameter');
	
	include 'config/koneksi.php'; // koneksi ke database
	
	$filter = $_POST['bulan_tanggal']; // value yang ditampung berformat: 'January 2009', 'February 2009', dsb
	
	// Tampilkan semua isi berita yang pada tanggal sesuai format 'Bulan Tahun' ( '%M %Y' )
	$query = mysql_query("SELECT * FROM berita WHERE DATE_FORMAT(tanggal,'%M %Y') = '$filter'");
	if($query && mysql_num_rows($query) > 0){
	  while($row = mysql_fetch_object($query)){
		echo '<p><li><a href="berita-'.$row->id_berita.'-'.$row->judul_seo.'.html">'.$row->judul.'</a></li></p>';
	  }
	}
?>
