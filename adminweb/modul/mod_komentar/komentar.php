<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_komentar/aksi_komentar.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<h2>Komentar</h2>
          <table>
          <tr><th>no</th><th>nama</th><th>komentar</th><th>aktif</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM komentar ORDER BY id_komentar DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td width=80>$r[nama_komentar]</td>
                <td width=290>$r[isi_komentar]</td>
                <td width=5 align=center>$r[aktif]</td>
                <td><a href=?module=komentar&act=editkomentar&id=$r[id_komentar]>Edit</a> | 
	                  <a href=$aksi?module=komentar&act=hapus&id=$r[id_komentar]>Hapus</a>
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM komentar"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
    break;
  
  case "editkomentar":
    $edit = mysql_query("SELECT * FROM komentar WHERE id_komentar='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Komentar</h2>
          <form method=POST action=$aksi?module=komentar&act=update>
          <input type=hidden name=id value=$r[id_komentar]>
          <table>
          <tr><td>Nama</td><td>     : <input type=text name='nama_komentar' size=30 value='$r[nama_komentar]'></td></tr>
          <tr><td>Website</td><td>  : <input type=text name='url' size=30 value='$r[url]'></td></tr>
          <tr><td>Isi Komentar</td><td> <textarea name=isi_komentar style='width: 600px; height: 150px;'>$r[isi_komentar]</textarea></td></tr>";

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
