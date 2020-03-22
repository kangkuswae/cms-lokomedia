<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_menuutama/aksi_menuutama.php";
switch($_GET[act]){
  // Tampil Menu Utama
  default:
    echo "<h2>Menu Utama</h2>
          <input type=button value='Tambah Menu Utama' 
          onclick=\"window.location.href='?module=menuutama&act=tambahmenuutama';\">
          <table>
          <tr><th>no</th><th>menu utama</th><th>link</th><th>aktif</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM mainmenu");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_menu]</td>
             <td>$r[link]</td>
             <td align=center>$r[aktif]</td>
             <td><a href=?module=menuutama&act=editmenuutama&id=$r[id_main]>Edit</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo "<div id=paging>*) Data pada Menu tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Menu Utama.</div><br>";
    break;
  
  // Form Tambah Menu Utama
  case "tambahmenuutama":
    echo "<h2>Tambah Menu Utama</h2>
          <form method=POST action='$aksi?module=menuutama&act=input'>
          <table>
          <tr><td>Nama Menu</td><td> : <input type=text name='nama_menu'></td></tr>
          <tr><td>Link</td><td> : <input type=text name='link'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Menu Utama
  case "editmenuutama":
    $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Menu Utama</h2>
          <form method=POST action=$aksi?module=menuutama&act=update>
          <input type=hidden name=id value='$r[id_main]'>
          <table>
          <tr><td>Nama Menu</td><td> : <input type=text name='nama_menu' value='$r[nama_menu]'></td></tr>
          <tr><td>Link</td><td> : <input type=text name='link' value='$r[link]'></td></tr>";
    if ($r[aktif]=='Y'){
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }

    echo "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
