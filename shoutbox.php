<link href="templates/building/style.css" rel="stylesheet" type="text/css" />

<?php
include "config/koneksi.php";

$shoutbox=mysql_query("SELECT * FROM shoutbox WHERE aktif='Y' ORDER BY id_shoutbox DESC LIMIT 10");
while($d=mysql_fetch_array($shoutbox)){
  $pesan = $d['pesan'];
  $pesan = str_replace(":-)", "<img src=\"smiley/1.gif\">", $pesan);
  $pesan = str_replace(":-(", "<img src=\"smiley/2.gif\">", $pesan);
  $pesan = str_replace(";-)", "<img src=\"smiley/3.gif\">", $pesan);
  $pesan = str_replace(";-D", "<img src=\"smiley/4.gif\">", $pesan);
  $pesan = str_replace(";;-)", "<img src=\"smiley/5.gif\">", $pesan);
  $pesan = str_replace("<:D>", "<img src=\"smiley/6.gif\">", $pesan);

      // Apabila ada link website diisi, tampilkan dalam bentuk link   
 	    if ($d['website']!=''){
        echo "<span class=shout><b><a href='http://$d[website]' target='_blank'>$d[nama]</a> : </b></span>";  
	    }
	    else{
        echo "<span class=shout><b>$d[nama] : </b></span>";  
      }

echo "<span class=shout>$pesan</span><br />";
echo "<span class=shoutdate>$d[tanggal]/$d[jam]#</span>";
echo "<hr color=#e0cb91 noshade=noshade />";
}
?>
