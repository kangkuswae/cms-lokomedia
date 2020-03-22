<?php
// Form Pencarian
$qcari=mysql_num_rows(mysql_query("select * from modul where nama_modul='Pencarian' and publish='Y'"));
// Apabila modul Pencarian diaktifkan Publish=Y, maka tampilkan modul Pencarian
if ($qcari > 0){
  echo "<img src=$f[folder]/images/pencarian.jpg><br />
        <form method=POST action='hasil-pencarian.html'>    
        <input name=kata type=text size=17 maxlength=50 />
        <input type=submit value=Go />
        </form>";
}


// Menu Kategori
$qkategori=mysql_num_rows(mysql_query("select * from modul where nama_modul='Kategori' and publish='Y'"));
// Apabila modul Kategori diaktifkan Publish=Y, maka tampilkan modul Kategori
if ($qkategori > 0){
  echo "<hr color=#FCEDC7 noshade=noshade /><br />
        <img src='$f[folder]/images/mainmenu.jpg'><br /><br />";

  $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,  
                         count(berita.id_kategori) as jml 
                         from kategori left join berita 
                         on berita.id_kategori=kategori.id_kategori 
                         where kategori.aktif='Y'  
                         group by nama_kategori");
  while($k=mysql_fetch_array($kategori)){
    echo "<span class=kategori>&bull; <a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></span><br />";
  }
}


// Berita Teratas
$qteratas=mysql_num_rows(mysql_query("select * from modul where nama_modul='Berita Teratas' and publish='Y'"));
// Apabila modul Berita Teratas diaktifkan Publish=Y, maka tampilkan modul Berita Teratas
if ($qteratas > 0){
  echo "<br /><hr color=#FCEDC7 noshade=noshade /><br />
        <img src=$f[folder]/images/populer.jpg><br />
        <ul>";
        
  $populer=mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 5");
  while($p=mysql_fetch_array($populer)){
    echo "<p><li><a href=berita-$p[id_berita]-$p[judul_seo].html>$p[judul]</a> ($p[dibaca])</li></p>";
  }
  echo "</ul>";
}


// Komentar Terakhir
$qterakhir=mysql_num_rows(mysql_query("select * from modul where nama_modul='Komentar' and publish='Y'"));
// Apabila modul Komentar diaktifkan Publish=Y, maka tampilkan modul Komentar
if ($qterakhir > 0){
  echo "<br /><hr color=#FCEDC7 noshade=noshade /><br />
        <img src='$f[folder]/images/komentar.jpg' /><br />
        <ul>";
      
  $komentar=mysql_query("SELECT * FROM berita,komentar 
                        WHERE komentar.id_berita=berita.id_berita  
                        ORDER BY id_komentar DESC LIMIT 5");
  while($k=mysql_fetch_array($komentar)){
    echo "<p><li><a href='http://$k[url]' target='_blank'><b>$k[nama_komentar]</b></a> 
          pada <a href='berita-$k[id_berita]-$k[judul_seo].html#$k[id_komentar]'>$k[judul]</a></li></p>";
  }
  echo "</ul>";
}


// Arsip Berita
$qarsip=mysql_num_rows(mysql_query("select * from modul where nama_modul='Arsip Berita' and publish='Y'"));
// Apabila modul Arsip Berita diaktifkan Publish=Y, maka tampilkan modul Arsip Berita
if ($qarsip > 0){
  echo "<br /><hr color=#FCEDC7 noshade=noshade /><br />
        <img src='$f[folder]/images/arsip.jpg' /><br />
        <ul>";
  include "arsipberita.php";
  echo "</ul>";
}


// Download
$qdownload=mysql_num_rows(mysql_query("select * from modul where nama_modul='Download' and publish='Y'"));
// Apabila modul download diaktifkan Publish=Y, maka tampilkan modul Download
if ($qdownload > 0){
  echo "<br /><hr color=#FCEDC7 noshade=noshade /><br />
        <img src='$f[folder]/images/download.jpg' /><br /><ul>";
  $download=mysql_query("SELECT * FROM download 
                    ORDER BY id_download DESC LIMIT 5");
  while($d=mysql_fetch_array($download)){
    echo "<p><li><a href='downlot.php?file=$d[nama_file]'>$d[judul]</a> ($d[hits])</li></p>";
  }
  echo "</ul>";
} 

// Agenda
$qagenda=mysql_num_rows(mysql_query("select * from modul where nama_modul='Agenda' and publish='Y'"));
// Apabila modul agenda diaktifkan Publish=Y, maka tampilkan modul Agenda
if ($qagenda > 0){
  echo "<br /><hr color=#e0cb91 noshade=noshade /><br />
        <img src=$f[folder]/images/agenda.jpg /><br /><br />";
  $agenda=mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT 4");

  while($a=mysql_fetch_array($agenda)){
	  $tgl_agenda = tgl_indo($a['tgl_mulai']);
    echo "<span class=date>&bull; $tgl_agenda </a></span><br />";
    echo "<span class=agenda><a href=agenda-$a[id_agenda]-$a[tema_seo].html> $a[tema]</a></span><br /><br />";
  }
  echo "<br />";
}
?>
