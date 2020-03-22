<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus gallery
if ($module=='galerifoto' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery='$_GET[id]'"));
  if ($data['gbr_gallery']!=''){
    mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
    unlink("../../../img_galeri/$_GET[namafile]");   
    unlink("../../../img_galeri/kecil_$_GET[namafile]");
  }
  else{
    mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");  
  }   
  header('location:../../media.php?module='.$module);
}

// Input gallery
elseif ($module=='galerifoto' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=galerifoto')</script>";
    }
    else{
    UploadGallery($nama_file_unik);
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album,
                                    keterangan,
                                    gbr_gallery) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]',
                                   '$_POST[keterangan]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album,
                                    keterangan) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]',
                                   '$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update gallery
elseif ($module=='galerifoto' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]'  
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=galerifoto')</script>";
    }
    else{
    UploadGallery($nama_file_unik);
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]',  
                                   gbr_gallery      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
}
?>
