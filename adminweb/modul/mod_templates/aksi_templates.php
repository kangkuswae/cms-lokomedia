<?php
  session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input templates
if ($module=='templates' AND $act=='input'){
  mysql_query("INSERT INTO templates(judul,pembuat,folder) VALUES('$_POST[judul]','$_POST[pembuat]','$_POST[folder]')");
  header('location:../../media.php?module='.$module);
}

// Update templates
elseif ($module=='templates' AND $act=='update'){
  mysql_query("UPDATE templates SET judul  = '$_POST[judul]',
                                    pembuat= '$_POST[pembuat]',
                                    folder = '$_POST[folder]'
                              WHERE id_templates = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}

// Aktifkan templates
elseif ($module=='templates' AND $act=='aktifkan'){
  $query1=mysql_query("UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
  $query2=mysql_query("UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
