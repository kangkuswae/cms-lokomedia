<script language="javascript" src="jquery.js"></script>
 <script language="javascript">
   // untuk melihat daftar artikel pada bulan dan tahun yang ditentukan
   function loadArtikel(element,filter){ 
	 // ambil element span yang sejajar dengan element link
	 var span = $(element).next('span'); 
	 // perlihatkan terlebih dahulu text 'loading' sebelum muncul list artikel
	 span.html('<small>loading...</small>'); 
	 $.post('getarticle.php',
		{bulan_tanggal: filter}, // kirim parameter 'bulan_tanggal' ke 'getarticle.php'
		function(response){ 
		  span.html(response); // ubah isi span dengan hasil response dari getarticle
		}
	 );
   }
 </script>
 <?php
 // Arsip Berita
 include 'config/koneksi.php'; // koneksi ke database
/*
		Penjelasan syntax SQL:
		 DATE_FORMAT(tanggal_posting,'%M %Y') : untuk mendapatkan format tanggal berupa 'Bulan Tahun'
		 SUM(1) AS TotalArtikel : Akan menampung jumlah baris hasil looping artikel setiap bulan dan tahun
		 GROUP BY YEAR(tanggal_posting), MONTH(tanggal_posting) : Mengelompokkan atau mengkompres 
		 	data artikel berdasar tahun dan bulan dari tanggal posting artikel
		 ORDER BY YEAR(tanggal_posting) DESC, MONTH(tanggal_posting) DESC : Agar hasil grouping artikel
		    ditampilkan berdasar bulan dan tahun terbaru
	*/
	$SQL = "SELECT DATE_FORMAT(tanggal,'%M %Y') AS SumTanggal, SUM(1) AS TotalArtikel 
			FROM berita GROUP BY YEAR(tanggal), MONTH(tanggal) 
			ORDER BY YEAR(tanggal) DESC, MONTH(tanggal) DESC";
	$query = mysql_query($SQL);
	if($query && mysql_num_rows($query) > 0){
	  while($row = mysql_fetch_object($query)){
	  	// Setiap list diberikan event 'loadArtikel' agar ketika di click akan menampilkan daftar artikel pada setiap bulan
		echo '<p><a name="'.$row->SumTanggal.'" id="'.$row->SumTanggal.'"></a>
          <img src="icon/arroworange.gif" width="12" height="11" /> <a href="#'.$row->SumTanggal.'" onClick="loadArtikel(this,\''.$row->SumTanggal.'\')">'.$row->SumTanggal.'</a> ('.$row->TotalArtikel.')<span></span></p>';
	  }
	}
?>