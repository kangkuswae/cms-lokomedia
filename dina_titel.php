<?php
if (isset($_GET['id'])){
    $sql = mysql_query("select judul from berita where id_berita='$_GET[id]'");
    $j   = mysql_fetch_array($sql);
    if ($j) {
        echo "$j[judul]";
    } else
        echo "bukulokomedia.com - penerbit lokomedia yogyakarta";
}
else{
        echo "bukulokomedia.com - penerbit lokomedia yogyakarta";
}
?>
