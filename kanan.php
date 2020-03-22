<script language="JavaScript" type="text/javascript">
  function addSmiley(textToAdd){
  document.formshout.pesan.value += textToAdd;
  document.formshout.pesan.focus();
}
</script>


<?php
// RSS
$qrss=mysql_num_rows(mysql_query("select * from modul where nama_modul='RSS' and publish='Y'"));
// Apabila modul RSS diaktifkan Publish=Y, maka tampilkan modul RSS
if ($qrss > 0){
  echo "<p align=center><a href=rss.xml target=_blank><img src=$f[folder]/images/rssku.jpg border=0 /></a><br />
        <a href=rss.xml target=_blank>Langganan RSS</a></p>";
}
     
// Status YM (Yahoo Messenger)   -> Hasilnya akan terlihat kalau sudah di online-kan di Internet   
// O iya, jangan lupa ganti alamat YM iin.suka dengan alamat YM Anda (bisa lebih dari satu)
$qym=mysql_num_rows(mysql_query("select * from modul where nama_modul='YM' and publish='Y'"));
// Apabila modul YM diaktifkan Publish=Y, maka tampilkan modul YM
if ($qym > 0){
  echo "<p align=center><a href='ymsgr:sendIM?iin.suka'>
		    <img src='http://opi.yahoo.com/online?u=iin.suka&amp;m=g&amp;t=9' border='0'></a></p>";
}

// Form indeks berita
$qindeks=mysql_num_rows(mysql_query("select * from modul where nama_modul='Indeks Berita' and publish='Y'"));
// Apabila modul YM diaktifkan Publish=Y, maka tampilkan modul YM
if ($qindeks > 0){
  echo "<hr color=#e0cb91 noshade=noshade /><br />
        <img src=$f[folder]/images/indeksberita.jpg /><br /><br />
        <form method=POST action='indeks-berita.html'>";    
        combotgl(1,31,'tanggal',$tgl_skrg);
  echo " / ";
        combobln(1,12,'bulan',$bln_sekarang);
  echo " / ";
        combothn(2000,$thn_sekarang,'tahun',$thn_sekarang);
  echo "<br /><input type=submit value=Go /></form>";
}


// Kalender
$qkalender=mysql_num_rows(mysql_query("select * from modul where nama_modul='Kalender' and publish='Y'"));
// Apabila modul Kalender diaktifkan Publish=Y, maka tampilkan modul Kalender
if ($qkalender > 0){
  echo "<hr color=#e0cb91 noshade=noshade /><br />
        <img src='$f[folder]/images/kalender.jpg' /><p align=center>";

  $tgl_skrg=date("d");
  $bln_skrg=date("n");
  $thn_skrg=date("Y");

  echo buatkalender($tgl_skrg,$bln_skrg,$thn_skrg); 

  echo "</p><br />";
}


// Statistik user
$qstatistik=mysql_num_rows(mysql_query("select * from modul where nama_modul='Statistik User' and publish='Y'"));
// Apabila modul Statistik diaktifkan Publish=Y, maka tampilkan modul Statistik
if ($qstatistik > 0){
  echo "<hr color=#e0cb91 noshade=noshade /><br />
        <img src='$f[folder]/images/statistik.jpg' /><br />";

  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  if(mysql_num_rows($s) == 0){
    mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
	   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
  }

  echo "<p align=center>$tothitsgbr </p>
      <img src=counter/hariini.png> Pengunjung hari ini : $pengunjung <br>
      <img src=counter/total.png> Total pengunjung    : $totalpengunjung <br><br>
      <img src=counter/hariini.png> Hits hari ini    : $hits[hitstoday] <br>
      <img src=counter/total.png> Total Hits       : $totalhits <br><br>
      <img src=counter/online.png> Pengunjung Online: $pengunjungonline<br><br>";
}

// Polling
$qpoling=mysql_num_rows(mysql_query("select * from modul where nama_modul='Poling' and publish='Y'"));
// Apabila modul poling diaktifkan Publish=Y, maka tampilkan modul Poling
if ($qpoling > 0){
  echo "<hr color=#e0cb91 noshade=noshade /><br />
        <img src='$f[folder]/images/polling.jpg' /><br /><br />";

  $tanya=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
  $t=mysql_fetch_array($tanya);

  echo "<b>$t[pilihan]</b> <br /><br />";

  echo "<form method=POST action='hasil-poling.html'>";

  $poling=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  while ($p=mysql_fetch_array($poling)){
    echo "<input type=radio name=pilihan value='$p[id_poling]' />$p[pilihan]<br />";
  }
  echo "<p align=center><input type=submit value=Vote /></p>
        </form>
        <p align=center><a href=lihat-poling.html>Lihat Hasil Poling</a></p>";
}

// Shoutbox
$qshoutbox=mysql_num_rows(mysql_query("select * from modul where nama_modul='Shoutbox' and publish='Y'"));
// Apabila modul poling diaktifkan Publish=Y, maka tampilkan modul Poling
if ($qshoutbox > 0){
  echo "<hr color=#e0cb91 noshade=noshade /><br />
        <img src='$f[folder]/images/shoutbox.jpg' /><br /><br />";
  echo "<iframe src='shoutbox.php' width=160 height=250 border=1 solid></iframe><br /><br />";
  echo "<table class=shout width=100%>
        <form name=formshout action=simpanshoutbox.php method=POST>
        <tr><td>Nama</td><td> : <input class=shout type=text name=nama size=21></td></tr>
        <tr><td>Website</td><td> : <input class=shout type=text name=website size=21></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea class=shout name='pesan' style='width: 115px; height: 35px;'></textarea></td></tr>";
  ?>
        <tr><td colspan=2>
        <a onClick="addSmiley(':-)')"><img src='smiley/1.gif'></a> 
        <a onClick="addSmiley(':-(')"><img src='smiley/2.gif'></a>
        <a onClick="addSmiley(';-)')"><img src='smiley/3.gif'></a>
        <a onClick="addSmiley(';-D')"><img src='smiley/4.gif'></a>
        <a onClick="addSmiley(';;-)')"><img src='smiley/5.gif'></a>
        <a onClick="addSmiley('<:D>')"><img src='smiley/6.gif'></a>
        </td></tr>
  <?php
  echo "<tr><td colspan=2><input class=shout type=submit name=submit value=Kirim><input class=shout type=reset name=reset value=Reset></td></tr>
        </form></table><br />";
}


// Banner
$qbanner=mysql_num_rows(mysql_query("select * from modul where nama_modul='Banner' and publish='Y'"));
// Apabila modul banner diaktifkan Publish=Y, maka tampilkan modul Banner max 4 buah
if ($qbanner > 0){
  echo "<hr color=#e0cb91 noshade=noshade />";
  $banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 4");
  while($b=mysql_fetch_array($banner)){
    echo "<p align=center><a href=$b[url] target='_blank' title='$b[judul]'><img src='foto_banner/$b[gambar]' border=0></a></p>";
  }
} 
?>
<style>
.tr_judul {
  font-weight : bold;
  text-align : center;
  background : #d0d0d0;
}
.tr_terang {
  text-align : center;
  background : #f0f0f0;
}
.tabel_data {
  background : #d0d0d0;
  color : #000000;
}
</style>
