<?php
if (isset($_GET['id'])){
    $sql = mysql_query("select judul from berita where id_berita='$_GET[id]'");
    $j   = mysql_fetch_array($sql);
		echo "$j[judul]";
}
else{
		echo "lokomedia adalah penerbit buku-buku komputer khususnya di bidang pemrograman web dan internet.";
}
?>
