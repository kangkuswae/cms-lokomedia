<?php
if($_GET['module']=='home'){
	echo "<span class=judul_head><a href='home'>Beranda</a></span>";
}
elseif($_GET['module']=='detailberita'){
	$detail	=mysql_query("SELECT * FROM berita,users,kategori    
            	          WHERE users.username=berita.username 
                	      AND kategori.id_kategori=berita.id_kategori 
                     	  AND id_berita='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<span class=judul_head><a href='home'>Beranda</a> &#187; <a href=kategori-$d[id_kategori]-$d[kategori_seo].html>$d[nama_kategori]</a> &#187; $d[judul]</span>";
}
elseif($_GET['module']=='detailkategori'){
	$detail	=mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<span class=judul_head><a href='home'>Beranda</a> &#187; $d[nama_kategori]</span>";
}
?>
