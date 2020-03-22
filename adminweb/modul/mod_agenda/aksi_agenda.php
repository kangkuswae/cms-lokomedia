<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus agenda
if ($module=='agenda' AND $act=='hapus'){
  mysql_query("DELETE FROM agenda WHERE id_agenda='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='agenda' AND $act=='input'){
  $mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
  $selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];
  
  $tema_seo = seo_title($_POST['tema']);

  mysql_query("INSERT INTO agenda(tema,
                                  tema_seo, 
                                  isi_agenda,
                                  tempat,
                                  jam,
                                  tgl_mulai,
                                  tgl_selesai,
                                  tgl_posting,
                                  pengirim, 
                                  username) 
					                VALUES('$_POST[tema]',
					                       '$tema_seo', 
                                 '$_POST[isi_agenda]',
                                 '$_POST[tempat]',
                                 '$_POST[jam]',
                                 '$mulai',
                                 '$selesai',
                                 '$tgl_sekarang',
                                 '$_POST[pengirim]',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update agenda
elseif ($module=='agenda' AND $act=='update'){
  $mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
  $selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

  $tema_seo = seo_title($_POST['tema']);

  mysql_query("UPDATE agenda SET tema        = '$_POST[tema]',
                                 tema_seo    = '$tema_seo',
                                 isi_agenda  = '$_POST[isi_agenda]',
                                 tgl_mulai   = '$mulai',
                                 tgl_selesai = '$selesai',
                                 tempat      = '$_POST[tempat]',  
                                 jam         = '$_POST[jam]',  
                                 pengirim    = '$_POST[pengirim]'  
                           WHERE id_agenda   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
