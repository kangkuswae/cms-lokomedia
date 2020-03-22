<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus sekilas info
if ($module=='sekilasinfo' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM sekilasinfo WHERE id_sekilas='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$_GET[id]'");
     unlink("../../../foto_info/$_GET[namafile]");   
     unlink("../../../foto_info/small_$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module);
}

// Input sekilas info
elseif ($module=='sekilasinfo' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
   if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=sekilasinfo')</script>";
    }
    else{
    UploadInfo($nama_file);
    mysql_query("INSERT INTO sekilasinfo(info,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[info]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO sekilasinfo(info,
                                    tgl_posting) 
                            VALUES('$_POST[info]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
}

// Update sekilas info
elseif ($module=='sekilasinfo' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]'
                             WHERE id_sekilas = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
   if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=sekilasinfo')</script>";
    }
    else{
    UploadInfo($nama_file);
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]',
                                   gambar    = '$nama_file'   
                             WHERE id_sekilas= '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
?>
