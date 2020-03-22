<?php
include "config/koneksi.php";

$sql = mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 5");

$file = fopen("rss.xml", "w");

fwrite($file, '<?xml version="1.0"?> 
<rss version="2.0"> 
<channel> 
<title>Bukulokomedia Feed</title> 
<link>http://bukulokomedia..com</link> 
<description>Feed Description</description> 
<language>en-us</language>');

while($r=mysql_fetch_array($sql)){
  $isi_berita = htmlentities(strip_tags(nl2br($r[isi_berita]))); // membuat paragraf pada isi berita dan mengabaikan tag html
  $isi   = substr($isi_berita,0,220); // ambil sebanyak 220 karakter
  $isi   = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

  fwrite($file, "<item>
                 <title>$r[judul]</title>
                 <link>http://bukulokomedia.com/berita-$r[id_berita]-$r[judul_seo].html</link>
                 <description>$isi ...</description>
                 </item>");
}

fwrite($file, "</channel></rss>");
fclose($file);
?>
