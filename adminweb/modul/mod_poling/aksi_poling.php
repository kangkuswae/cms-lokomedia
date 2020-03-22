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

// Hapus poling
if ($module=='poling' AND $act=='hapus'){
  mysql_query("DELETE FROM poling WHERE id_poling='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input poling
elseif ($module=='poling' AND $act=='input'){
  mysql_query("INSERT INTO poling(pilihan,
                                  status, 
                                  aktif) 
	                       VALUES('$_POST[pilihan]',
	                              '$_POST[status]',
                                '$_POST[aktif]')");
  header('location:../../media.php?module='.$module);
}

// Update poling
elseif ($module=='poling' AND $act=='update'){
  mysql_query("UPDATE poling SET pilihan = '$_POST[pilihan]',
                                 status  = '$_POST[status]',
                                 aktif   = '$_POST[aktif]'  
                          WHERE id_poling = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
