<?php
include "config/koneksi.php";
include "config/library.php";

$nama=trim($_POST['nama']);
$pesan=trim($_POST['pesan']);

if (empty($nama)){
  echo "Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($pesan)){
  echo "Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (strlen($_POST['pesan']) > 100) {
  echo "PESAN Anda kepanjangan, dikurangin atau dibagi jadi beberapa bagian.<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$nama = anti_injection($_POST['nama']);
$website = anti_injection($_POST['website']);
$pesan = anti_injection($_POST['pesan']);

$kueri = mysql_query("INSERT INTO shoutbox(nama, website, pesan, tanggal, jam)
          VALUES('$nama', '$website', '$pesan', '$tgl_sekarang','$jam_sekarang')");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}

?>
