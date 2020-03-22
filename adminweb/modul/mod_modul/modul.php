<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    echo "<h2>Modul</h2>
          <input type=button value='Tambah Modul' onclick=\"window.location.href='?module=modul&act=tambahmodul';\"><br /><br />
          <div id=paging>
          *) Apabila PUBLISH = Y, maka Modul ditampilkan di halaman pengunjung. <br />
          **) Apabila AKTIF = Y, maka Modul ditampilkan di halaman administrator pada daftar menu yang berada di bagian kiri.</div>
          <table>
          <tr><th>no</th><th>nama modul</th><th>link</th><th>publish</th><th>aktif</th><th>status</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$r[urutan]</td>
            <td>$r[nama_modul]</td>
            <td><a href=$r[link]>$r[link]</a></td>
            <td align=center>$r[publish]</td>
            <td align=center>$r[aktif]</td>
            <td>$r[status]</td>
            <td><a href=?module=modul&act=editmodul&id=$r[id_modul]>Edit</a> | 
	              <a href=$aksi?module=modul&act=hapus&id=$r[id_modul]>Hapus</a>
            </td></tr>";
    }
    echo "</table>";
    break;

  case "tambahmodul":
    echo "<h2>Tambah Modul</h2>
          <form method=POST action='$aksi?module=modul&act=input'>
          <table>
          <tr><td>Nama Modul</td> <td> : <input type=text name='nama_modul'></td></tr>
          <tr><td>Link</td>       <td> : <input type=text name='link' size=30></td></tr>
          <tr><td>Publish</td>    <td> : <input type=radio name='publish' value='Y' checked>Y  
                                         <input type=radio name='publish' value='N'> N</td></tr>
          <tr><td>Aktif</td>      <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                         <input type=radio name='aktif' value='N'> N</td></tr>
          <tr><td>Status</td>     <td> : <input type=radio name='status' value='admin' checked>admin 
                                         <input type=radio name='status' value='user'>user</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
 
  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Modul</h2>
          <form method=POST action=$aksi?module=modul&act=update>
          <input type=hidden name=id value='$r[id_modul]'>
          <table>
          <tr><td>Nama Modul</td>     <td> : <input type=text name='nama_modul' value='$r[nama_modul]'></td></tr>
          <tr><td>Link</td>     <td> : <input type=text name='link' size=30 value='$r[link]'></td></tr>";
    if ($r[publish]=='Y'){
      echo "<tr><td>Publish</td> <td> : <input type=radio name='publish' value='Y' checked>Y  
                                        <input type=radio name='publish' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Publish</td> <td> : <input type=radio name='publish' value='Y'>Y  
                                        <input type=radio name='publish' value='N' checked>N</td></tr>";
    }
    if ($r[aktif]=='Y'){
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }
    if ($r[status]=='user'){
      echo "<tr><td>Status</td> <td> : <input type=radio name='status' value='user' checked>user  
                                       <input type=radio name='status' value='admin'> admin</td></tr>";
    }
    else{
      echo "<tr><td>Status</td> <td> : <input type=radio name='status' value='user'>user  
                                       <input type=radio name='status' value='admin' checked>admin</td></tr>";
    }
    echo "<tr><td>Urutan</td>       <td> : <input type=text name='urutan' size=1 value='$r[urutan]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
