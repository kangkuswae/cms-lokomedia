<?php
if (isset($_GET['id'])){
  $sql = mysql_query("select tag from berita where id_berita='$_GET[id]'");
  $j   = mysql_fetch_array($sql);
	echo "$j[tag]";
}
else{
		echo "lokomedia, bukulokomedia, toko online, buku komputer, trik, tutorial, konsultasi, distro kaos, php";
}
?>
