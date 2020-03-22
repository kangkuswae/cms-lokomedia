<?php
$aksi="modul/mod_sekilasinfo/aksi_sekilasinfo.php";
switch($_GET[act]){
  // Tampil Sekilas Info
  default:
    echo "<h2>Sekilas Info</h2>
          <input type=button value='Tambah Sekilas Info' onclick=location.href='?module=sekilasinfo&act=tambahsekilasinfo'>
          <table>
          <tr><th>no</th><th>info</th><th>tgl. posting</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[info]</td>
                <td>$tgl</td>
                <td><a href=?module=sekilasinfo&act=editsekilasinfo&id=$r[id_sekilas]>Edit</a> | 
	                  <a href='$aksi?module=sekilasinfo&act=hapus&id=$r[id_sekilas]&namafile=$r[gambar]'>Hapus</a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahsekilasinfo":
    echo "<h2>Tambah Sekilas Info</h2>
          <form method=POST action='$aksi?module=sekilasinfo&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Info</td><td>  : <input type=text name='info' size=100></td></tr>
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editsekilasinfo":
    $edit = mysql_query("SELECT * FROM sekilasinfo WHERE id_sekilas='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Sekilas Info</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=sekilasinfo&act=update>
          <input type=hidden name=id value=$r[id_sekilas]>
          <table>
          <tr><td>Info</td><td>     : <input type=text name='info' size=100 value='$r[info]'></td></tr>
          <tr><td>Gambar</td><td>    : <img src='../foto_info/$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
