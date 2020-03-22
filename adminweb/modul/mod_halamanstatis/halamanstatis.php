<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_halamanstatis/aksi_halamanstatis.php";
switch($_GET[act]){
  // Tampil Halaman Statis
  default:
    echo "<h2>Halaman Statis</h2>
          <input type=button value='Tambah Halaman Statis' onclick=\"window.location.href='?module=halamanstatis&act=tambahhalamanstatis';\">
          <table>
          <tr><th>no</th><th>judul</th><th>tgl. posting</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM halamanstatis ORDER BY id_halaman DESC");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td>$tgl_posting</td>
		            <td><a href=?module=halamanstatis&act=edithalamanstatis&id=$r[id_halaman]>Edit</a> | 
		                <a href='$aksi?module=halamanstatis&act=hapus&id=$r[id_halaman]&namafile=$r[gambar]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "tambahhalamanstatis":
    echo "<h2>Tambah Halaman Statis</h2>
          <form method=POST action='$aksi?module=halamanstatis&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=70>Judul</td>     <td> : <input type=text name='judul' size=60></td></tr>
          <tr><td>Isi Halaman</td>  <td> <textarea name='isi_halaman'  style='width: 600px; height: 350px;'></textarea></td></tr>
          <tr><td>Gambar</td>  <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "edithalamanstatis":
    $edit = mysql_query("SELECT * FROM halamanstatis WHERE id_halaman='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Halaman Statis</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=halamanstatis&act=update>
          <input type=hidden name=id value=$r[id_halaman]>
          <table>
          <tr><td width=70>Judul</td>  <td> : <input type=text name='judul' size=60 value='$r[judul]'></td></tr>
          <tr><td>Isi Halaman</td>   <td> <textarea name='isi_halaman' style='width: 600px; height: 350px;'>$r[isi_halaman]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]!=''){
              echo "<img src='../foto_banner/$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=40> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>";

    echo  "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}

}
?>
