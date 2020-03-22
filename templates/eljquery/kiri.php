 <?php
 if ($_GET['module']=='home'){
 ?>
			<!-- CONTENT -->
		  <div id="content">            
          <!-- Slideshow Headline Berita -->
          <div id="content-kiri">
            <div id="divTrigger">
              <a href="javascript:;" onClick="bukaContent(this,'div1')" id="slideAwal">1</a>
              <a href="javascript:;" onClick="bukaContent(this,'div2')">2</a>
              <a href="javascript:;" onClick="bukaContent(this,'div3')">3</a>
              <a href="javascript:;" onClick="bukaContent(this,'div4')">4</a>
              <a href="javascript:;" onClick="bukaContent(this,'div5')">5</a>
            </div><br />

            <div id="divContent"> 
              <?php
                $terkini=mysql_query("SELECT * FROM berita 
                                      WHERE headline='Y' ORDER BY id_berita DESC LIMIT 5");
                $no=1;
              	while($t=mysql_fetch_array($terkini)){             	    
                  echo "<div id='div$no'>
                          <img src=foto_berita/medium_$t[gambar] width='360' height='250' />
                          <span class='t'><a href='berita-$t[id_berita]-$t[judul_seo].html'>$t[judul]</a></span>
                        </div>";           
                  $no++;
                } 
              ?>
            </div>          
          </div><!-- / end content-kiri untuk headline berita -->

          <!-- TAB -->         
          <div id="content-kanan">
            <div id="tabsview">
		          <div id="tab1" class="tab_sel" onclick="javascript: displayPanel('1');" align="center">&nbsp; Terpopuler &nbsp;</div>
 		          <div id="tab2" class="tab" style="margin-left: 1px;" onclick="javascript: displayPanel('2');" align="center">&nbsp; Terkini &nbsp;</div>
 		          <div id="tab3" class="tab" style="margin-left: 1px;" onclick="javascript: displayPanel('3');" align="center">&nbsp; Komentar &nbsp;</div>
            </div>
  
	          <div class="tab_bdr"></div>
	          
	          <!-- tab 1: berita terpopuler -->
            <div class="panel" id="panel1" style="display: block;">
              <span>
              <div class="tips">
              <ul>            
                <?php
                  $populer=mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 7");
                  while($p=mysql_fetch_array($populer)){

                    $isi_berita = strip_tags($p['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita,0,100); // ambil sebanyak 100 karakter
                    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                    echo "<li class='garisbawah'><a href=berita-$p[id_berita]-$p[judul_seo].html title='$isi ...'>$p[judul]</a> ($p[dibaca])</li>";
                  }
                ?>          
              </ul>
              </div>
              </span>
            </div>

	          <!-- tab 2: berita terkini/terbaru -->
            <div class="panel" id="panel2" style="display: none;">
              <span>
              <div class="tips">
              <ul>            
                <?php
                  $terkini=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 7");
                  while($t=mysql_fetch_array($terkini)){
                  
                    $isi_berita = strip_tags($t['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita,0,100); // ambil sebanyak 100 karakter
                    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                    echo "<li class='garisbawah'><a href=berita-$t[id_berita]-$t[judul_seo].html title='$isi ...'>$t[judul]</a></li>";
                  }
                ?>                    
              </ul>
              </div>
              </span>
            </div>
  
	          <!-- tab 3: komentar terakhir -->
            <div class="panel" id="panel3" style="display: none;">
              <span>
              <div class="tips">
              <ul>        
                <?php
                  $komentar=mysql_query("SELECT * FROM berita,komentar 
                                         WHERE komentar.id_berita=berita.id_berita  
                                         ORDER BY id_komentar DESC LIMIT 7");
                  while($k=mysql_fetch_array($komentar)){

                    $isi_komentar = strip_tags($k['isi_komentar']); // membuat paragraf pada isi komentar dan mengabaikan tag html
                    $isi = substr($isi_komentar,0,100); // ambil sebanyak 100 karakter
                    $isi = substr($isi_komentar,0,strrpos($isi," ")); // potong per spasi kalimat

                    echo "<li class='garisbawah'><a href='http://$k[url]' target='_blank'><b>$k[nama_komentar]</b></a> 
                          pada <a href='berita-$k[id_berita]-$k[judul_seo].html#$k[id_komentar]' title='$isi ...'>$k[judul]</a></li>";
                  }
                ?>      
              </ul>
              </div>
              </span>
            </div><br />  
          </div><!-- / end content-kanan untuk tabs-->

          <div id="content-kiri">
            <?php
              // Berita Sebelumnya (tampilkan 10 berita sebelumnya) 
              echo "<br /><img src=$f[folder]/images/berita_sebelumnya.jpg><br />
                    <div class='tips'><ul>";
              $sebelum=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 8,10");		 
	            while($s=mysql_fetch_array($sebelum)){
	              
                $isi_berita = strip_tags($s['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
                $isi = substr($isi_berita,0,100); // ambil sebanyak 100 karakter
                $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
                
	               echo "<li><b><a href='berita-$s[id_berita]-$s[judul_seo].html' title='$isi ...'>$s[judul]</a></b></li>";
	            }    
	            echo "</div></ul><br />";
	  
	            // Galeri Foto (tampilkan 6 foto secara horizontal)
              echo "<img src='$f[folder]/images/galeri.jpg' /><br />";

              // Tentukan kolom
              $col = 3;
              $g = mysql_query("SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT 6");
              
              echo "<div class='tipsatas'><table><tr>";              
              $cnt = 0;
              while ($w = mysql_fetch_array($g)) {
                if ($cnt >= $col) {
                echo "</tr><tr>";
                $cnt = 0;
                }
                $cnt++;
                echo "<td align=center valign=top><br />
                      <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'>
                      <img alt='$w[keterangan]' src='img_galeri/kecil_$w[gbr_gallery]' /></a><br />
                      <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'><b>$w[jdl_gallery]</b></a></td>";
              }
              echo "</tr></table></div>";
            ?>
          </div><!-- / end content-kiri untuk berita sebelumnya dan galeri foto -->
          
          <div id="content-kanan">
            <div id="kotakjudul">
              <span class="judulhead">Kategori Berita</span>
            </div>
            <div id="kotakisi">
              <table cellpadding="2" width="100%" border="0" cellspacing="4">
              <tbody>
              <div class="tips">
                <ul>  
                <?php
                  $kategori=mysql_query("SELECT nama_kategori, kategori.id_kategori, kategori_seo,  
                                         COUNT(berita.id_kategori) AS jml 
                                         FROM kategori LEFT JOIN berita 
                                         ON berita.id_kategori=kategori.id_kategori 
                                         WHERE kategori.aktif='Y'  
                                         GROUP BY nama_kategori");
                  while($k=mysql_fetch_array($kategori)){
                    $nama_kategori=strtoupper($k[nama_kategori]);
                    echo "<li class='garisbawah'><a href=kategori-$k[id_kategori]-$k[kategori_seo].html title='Ada $k[jml] berita pada kategori $k[nama_kategori]'> 
                    $nama_kategori</a></li>";
                  }
                ?>
                </ul>
              </div>
              </tbody>
              </table>
            </div><br /> <!-- / end kategori berita -->
            
              <div id="kotakjudul">
                <span class="judulhead">Download</span>
              </div>
              <div id="kotakisi">
                <table cellpadding="2" width="100%" border="0" cellspacing="4">
                <tbody>
                <div class="tips">
                  <ul>  
                  <?php
                    $download=mysql_query("SELECT * FROM download ORDER BY id_download DESC LIMIT 5");
                  
                    while($d=mysql_fetch_array($download)){
                      echo "<li class='garisbawah'><a href='downlot.php?file=$d[nama_file]' title='Sudah didownload sebanyak $d[hits] kali'>$d[judul]</a></li>";
                    }
                  ?>
                  </ul>
                </div>
                </tbody>
                </table>
              </div><br />  <!-- / end download -->
              
              <div id="kotakjudul">
                <span class="judulhead">Agenda</span>
              </div>
              <div id="kotakisi">
                <table cellpadding="2" width="100%" border="0" cellspacing="4">
                <tbody>
                 <div class="tips">
                  <ul>
                  <?php
                    $agenda=mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT 3");
                    while($a=mysql_fetch_array($agenda)){
	                      $tgl_agenda = tgl_indo($a[tgl_mulai]);
	                      $isi_agenda = strip_tags($a['isi_agenda']); // membuat paragraf pada isi berita dan mengabaikan tag html
                        $isi = substr($isi_agenda,0,200); // ambil sebanyak 220 karakter
                        $isi = substr($isi_agenda,0,strrpos($isi," ")); // potong per spasi kalimat
   
                       echo "<li class='garisbawah'><span class='tanggal'>$tgl_agenda</span>
                             <br /><a href='agenda-$a[id_agenda]-$a[tema_seo].html' title='$isi_agenda ...'>$a[tema]</a></li>";
                    }
                  ?>
                  </ul>
                 </div>
                </tbody>
                </table>
              </div>
          </div><!-- / end content-kanan untuk kategori berita, download, dan agenda -->
	    </div> <!-- / end content -->


<?php 
}
elseif ($_GET['module']=='detailberita'){
	echo "<div id='content'>          
           <div id='content-detail'>";            

	$detail=mysql_query("SELECT * FROM berita,users,kategori    
                      WHERE users.username=berita.username 
                      AND kategori.id_kategori=berita.id_kategori 
                      AND id_berita='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);
	$baca = $d[dibaca]+1;
	echo "<span class=tanggal><img src=$f[folder]/images/clock.gif> $d[hari], $tgl - $d[jam] WIB</span><br />";
	echo "<span class=judul>$d[judul]</span><br />";
	echo "<span class=posting>Diposting oleh : <b>$d[nama_lengkap]</b><br /> 
        Kategori: <a href=kategori-$d[id_kategori]-$d[kategori_seo].html><b>$d[nama_kategori]</b></a> 
        - Dibaca: <b>$baca</b> kali</span><br />";
  // Apabila ada gambar dalam berita, tampilkan   
 	if ($d[gambar]!=''){
		echo "<p><span class=image><img src='foto_berita/$d[gambar]' border=0></span></p>";
	}
 	//$isi_berita=nl2br($d[isi_berita]); // membuat paragraf pada isi berita
	echo "$d[isi_berita] <br />";	 		  
  
  // Tampilkan judul berita yang terkait (maks: 5) 
  echo "<img src=$f[folder]/images/berita_terkait.jpg><br /><ul>";
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata  = explode(",",$d[tag]);
  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1; 
  $ambil_id = substr($_GET[id],0,4);

  // Looping query sebanyak jml_kata
  $cari = "SELECT * FROM berita WHERE (id_berita<'$ambil_id') and (id_berita!='$ambil_id') and (" ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tag LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
   $cari .= ") ORDER BY id_berita DESC LIMIT 5";
 
  $hasil  = mysql_query($cari);
  while($h=mysql_fetch_array($hasil)){
  		echo "<li><a href=berita-$h[id_berita]-$h[judul_seo].html>$h[judul]</a></li>";
  }      
	echo "</ul>";

  // Apabila detail berita dilihat, maka tambahkan berapa kali dibacanya
  mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 
              WHERE id_berita='$_GET[id]'"); 


  // Hitung jumlah komentar
  $komentar = mysql_query("select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$_GET[id]' AND aktif='Y'");
  $k = mysql_fetch_array($komentar); 
  echo "<span class=judul><b>$k[jml]</b> Komentar : </span><br /><hr color=#CCC noshade=noshade />";

  // Paging komentar
  $p      = new Paging7;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  // Komentar berita
  $sql = mysql_query("SELECT * FROM komentar WHERE id_berita='$_GET[id]' AND aktif='Y' LIMIT $posisi,$batas");
	$jml = mysql_num_rows($sql);
  // Apabila sudah ada komentar, tampilkan 
  if ($jml > 0){
    while ($s = mysql_fetch_array($sql)){
      $tanggal = tgl_indo($s[tgl]);
      // Apabila ada link website diisi, tampilkan dalam bentuk link   
 	    if ($s[url]!=''){
        echo "<span class=komentar><a name=$s[id_komentar] id=$s[id_komentar]><a href='http://$s[url]' target='_blank'>$s[nama_komentar]</a></a></span><br />";  
	    }
	    else{
        echo "<span class=komentar>$s[nama_komentar]</span><br />";  
      }

  		echo "<span class=tanggal>$tanggal - $s[jam_komentar] WIB</span><br /><br />";
      $isian=nl2br($s[isi_komentar]); // membuat paragraf pada isi komentar
      $isikan=sensor($isian); 
 
  	  echo autolink($isikan);
      echo "<hr color=#CCC noshade=noshade />";	 		  
    }

   	$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE id_berita='$_GET[id]' AND aktif='Y'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halkomentar'], $jmlhalaman);

    echo "$linkHalaman";
  }
  // Form komentar
  echo "<br /><br /><b>Isi Komentar :</b>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form name='form' action=simpankomentar.php method=POST onSubmit=\"return validasi(this)\">
        <input type=hidden name=id value=$_GET[id]>
        <tr><td>Nama</td><td> : <input type=text name=nama_komentar size=40 maxlength=50></td></tr>
        <tr><td>Website</td><td> : <input type=text name=url size=40 maxlength=50></td></tr>
        <tr><td valign=top>Komentar</td><td> <textarea name='isi_komentar' style='width: 300px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
        <tr><td>&nbsp;</td><td><input type=submit name=submit value=Kirim></td></tr>
        </form></table><br />";        
  echo "</div>
    </div>";            
}

// Modul berita per kategori
elseif ($_GET['module']=='detailkategori'){
	echo "<div id='content'>          
           <div id='content-detail'>";            
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);
  echo "<span class=judul_head>&#187; Kategori : <b>$n[nama_kategori]</b></span><br /><br />";
  
  $p      = new Paging3;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
  
  // Tampilkan daftar berita sesuai dengan kategori yang dipilih
 	$sql   = "SELECT * FROM berita WHERE id_kategori='$_GET[id]' 
            ORDER BY id_berita DESC LIMIT $posisi,$batas";		 

	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	// Apabila ditemukan berita dalam kategori
	if ($jumlah > 0){
   while($r=mysql_fetch_array($hasil)){
		$tgl = tgl_indo($r[tanggal]);
		echo "<table><tr><td><span class=tanggal><img src=$f[folder]/images/clock.gif> $r[hari], $tgl - $r[jam] WIB</span><br />";
		echo "<span class=judul><a href=berita-$r[id_berita]-$r[judul_seo].html>$r[judul]</a></span><br />";
 		// Apabila ada gambar dalam berita, tampilkan
    if ($r[gambar]!=''){
			echo "<span class=image><img src='foto_berita/small_$r[gambar]' width=110 border=0></span>";
		}
    // Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($r[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita,0,400); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
    echo "$isi ... <a href=berita-$r[id_berita]-$r[judul_seo].html>Selengkapnya</a>
          <br /></td></tr></table><hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

  echo "Hal: $linkHalaman";
  }
  else{
    echo "Belum ada berita pada kategori ini.";
  }
  echo "</div>
    </div>";            
}

// Modul detail agenda
elseif ($_GET['module']=='detailagenda'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
               
	$detail=mysql_query("SELECT * FROM agenda 
                      WHERE id_agenda='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
  $tgl_mulai   = tgl_indo($d[tgl_mulai]);
  $tgl_selesai = tgl_indo($d[tgl_selesai]);
  $isi_agenda=nl2br($d[isi_agenda]);
	
  echo "<span class=judul>$d[tema]</span><br />";
  echo "<span class=tanggal>Diposting tanggal: $tgl_posting</span><br /><br />";
	echo "<b>Topik</b>  : $isi_agenda <br />";
 	echo "<b>Tanggal</b> : $tgl_mulai s/d $tgl_selesai <br /><br />";
 	echo "<b>Tempat</b> : $d[tempat] <br /><br />";
 	echo "<b>Pukul</b> : $d[jam] <br /><br />";
 	echo "<b>Pengirim (Contact Person)</b> : $d[pengirim] <br />";
            
  echo "</div>
    </div>";            
}


// Modul hasil pencarian berita 
elseif ($_GET['module']=='hasilcari'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hasil Pencarian</b></span><br />";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM berita WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul OR isi_berita LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_berita DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Ditemukan <b>$ketemu</b> berita dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
    while($t=mysql_fetch_array($hasil)){
		echo "<table><tr><td><span class=judul><a href=berita-$t[id_berita]-$t[judul_seo].html>$t[judul]</a></span><br />";
      // Tampilkan hanya sebagian isi berita
      $isi_berita = htmlentities(strip_tags($t[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita,0,250); // ambil sebanyak 150 karakter
      $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <a href=berita-$t[id_berita]-$t[judul_seo].html>Selengkapnya</a>
            <br /></td></tr>
            </table><hr color=#CCC noshade=noshade />";
    }                                                          
  }
  else{
    echo "<p></p><p align=center>Tidak ditemukan berita dengan kata <b>$kata</b></p>";
  }

  echo "</div>
    </div>";            
}


// Modul hasil poling
elseif ($_GET['module']=='hasilpoling'){
 echo "<div id='content'>          
          <div id='content-detail'>";
 if (isset($_COOKIE["poling"])) {
   echo "Sorry, anda sudah pernah melakukan voting terhadap poling ini.";
 }
 else{
  // membuat cookie dengan nama poling
  // cookie akan secara otomatis terhapus dalam waktu 24 jam
  setcookie("poling", "sudah poling", time() + 3600 * 24);

  echo "<span class=judul_head>&#187; <b>Hasil Poling</b></span><br /><br />";

  $u=mysql_query("UPDATE poling SET rating=rating+1 WHERE id_poling='$_POST[pilihan]'");

  echo "<p align=center>Terimakasih atas partisipasi Anda mengikuti poling kami<br /><br />
        Hasil poling saat ini: </p><br />";
  
  echo "<table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=120>$s[pilihan] ($s[rating]) </td><td> 
          <img src=$f[folder]/images/blue.png width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p>Jumlah Voting: <b>$jml_vote</b></p>";
 }
  echo "</div>
    </div>";            
}


// Modul hasil poling
elseif ($_GET['module']=='lihatpoling'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hasil Poling</b></span><br /><br />";

  echo "<p align=center>Terimakasih atas partisipasi Anda mengikuti poling kami<br /><br />
        Hasil poling saat ini: </p><br />";
  
  echo "<table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=120>$s[pilihan] ($s[rating]) </td><td> 
          <img src=$f[folder]/images/blue.png width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p>Jumlah Voting: <b>$jml_vote</b></p>";
  echo "</div>
    </div>";            
}

// Menu utama di header

// Modul profil
elseif ($_GET['module']=='profilkami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Profil</b></span><br /><br />"; 

	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='37'");
	$r      = mysql_fetch_array($profil);

  echo "<tr><td class=isi>";
  if ($r[gambar]!=''){
		echo "<span class=image><img src='foto_banner/$r[gambar]'></span>";
	}
  echo "$r[static_content]";  
  echo "</div>
    </div>";            
}

// Modul halaman statis
elseif ($_GET['module']=='halamanstatis'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
               
	$detail=mysql_query("SELECT * FROM halamanstatis 
                      WHERE id_halaman='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
	
  echo "<span class=judul>$d[judul]</span><br />";
  echo "<span class=tanggal>Diposting tanggal: $tgl_posting</span><br /><br />";
  if ($d[gambar]!=''){
		echo "<span class=image><img src='foto_banner/$d[gambar]'></span>";
	}
	echo "$d[isi_halaman] <br />";
            
  echo "</div>
    </div>";            
}

// Modul semua berita
elseif ($_GET['module']=='semuaberita'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Berita</b></span><br /><br />"; 
  $p      = new Paging2;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua berita
  $sql=mysql_query("select count(komentar.id_komentar) as jml, judul, judul_seo, jam, 
                       berita.id_berita, hari, tanggal, gambar, isi_berita    
                       from berita left join komentar 
                       on berita.id_berita=komentar.id_berita
                       and aktif='Y' 
                       group by berita.id_berita DESC LIMIT $posisi,$batas");
  while($r=mysql_fetch_array($sql)){
		$tgl = tgl_indo($r[tanggal]);
		echo "<table><tr><td>
          <span class=tanggal>$r[hari], $tgl - $r[jam] WIB</span><br />";
 		echo "<span class=judul><a href=berita-$r[id_berita]-$r[judul_seo].html>$r[judul]</a></span><br />";
      // Tampilkan hanya sebagian isi berita
      $isi_berita = htmlentities(strip_tags($r[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita,0,220); // ambil sebanyak 150 karakter
      $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <a href=berita-$r[id_berita]-$r[judul_seo].html>Selengkapnya</a> (<b>$r[jml] komentar</b>)
            </td></tr></table>
            <hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halberita], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}

// Modul semua agenda
elseif ($_GET['module']=='semuaagenda'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Agenda</b></span><br /><br />"; 
  $p      = new Paging4;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas); 
  // Tampilkan semua agenda
 	$sql = mysql_query("SELECT * FROM agenda  
                      ORDER BY id_agenda DESC LIMIT $posisi,$batas");		 
  while($d=mysql_fetch_array($sql)){
    $tgl_posting = tgl_indo($d[tgl_posting]);
    $tgl_mulai   = tgl_indo($d[tgl_mulai]);
    $tgl_selesai = tgl_indo($d[tgl_selesai]);
    $isi_agenda  = nl2br($d[isi_agenda]);
	
    echo "<table>";
		echo "<tr><td colspan=2><span class=tanggal>$tgl_posting</span></td></tr>";
    echo "<tr><td colspan=2><span class=judul>$d[tema]</span></td></tr>";
	  echo "<tr><td valign=top><b>Topik</b>  </td><td> : $isi_agenda </td></tr>";
 	  echo "<tr><td><b>Tanggal</b> </td><td> : $tgl_mulai s/d $tgl_selesai </td></tr>";
 	  echo "<tr><td><b>Pukul</b> </td><td> : $d[jam] </td></tr>";
 	  echo "<tr><td><b>Tempat</b> </td><td> : $d[tempat] </td></tr>";
 	  echo "<tr><td><b>Pengirim</b> </td><td> : $d[pengirim] 
          </td></tr></table><hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM agenda"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halagenda], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}


// Modul semua download
elseif ($_GET['module']=='semuadownload'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Download</b></span><br /><br />"; 
  $p      = new Paging5;
  $batas  = 20;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua download
 	$sql = mysql_query("SELECT * FROM download  
                      ORDER BY id_download DESC LIMIT $posisi,$batas");		 

  echo "<ul>";   
   while($d=mysql_fetch_array($sql)){
      echo "<li><a href='downlot.php?file=$d[nama_file]'>$d[judul]</a> ($d[hits])</li>";
	 }
  echo "</ul><hr color=#CCC noshade=noshade />";
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM download"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}


// Modul semua album
elseif ($_GET['module']=='semuaalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Album</b></span><br />"; 
  // Tentukan kolom
  $col = 3;

  $a = mysql_query("SELECT jdl_album, album.id_album, gbr_album, album_seo,  
                  COUNT(gallery.id_gallery) as jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;


 echo "<td align=center valign=top><br />
    <a href=album-$w[id_album]-$w[album_seo].html>
    <img class='img2' src='img_album/kecil_$w[gbr_album]' border=0 width=120 height=90><br />
    $w[jdl_album]</a><br />($w[jumlah] Foto)<br /></td>";
}
echo "</tr></table>";
  echo "</div>
    </div>";            
}


// Modul galeri foto berdasarkan album
elseif ($_GET['module']=='detailalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <a href=semua-album.html><b>Album</b></a> &#187; <b>Galeri Foto</b></span><br />"; 
  $p      = new Paging6;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  // Tentukan kolom
  $col = 5;

  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

    echo "<td align=center valign=top><br />
          <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'>
          <img alt='galeri' src='img_galeri/kecil_$w[gbr_gallery]' /></a><br />
          <a href=#><b>$w[jdl_gallery]</b></a></td>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halgaleri], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
  echo "</div>
    </div>";            
}


// Modul hubungi kami
elseif ($_GET['module']=='hubungikami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hubungi Kami</b></span><br /><br />"; 
  echo "<b>Hubungi kami secara online dengan mengisi form dibawah ini:</b>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td>Nama</td><td> : <input type=text name=nama size=40></td></tr>
        <tr><td>Email</td><td> : <input type=text name=email size=40></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name=subjek size=55></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=pesan  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim></td></tr>
        </form></table><br />";
  echo "</div>
    </div>";            
}


// Modul hubungi aksi
elseif ($_GET['module']=='hubungiaksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";

$nama=trim($_POST[nama]);
$email=trim($_POST[email]);
$subjek=trim($_POST[subjek]);
$pesan=trim($_POST[pesan]);

if (empty($nama)){
  echo "Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($email)){
  echo "Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($subjek)){
  echo "Anda belum mengisikan SUBJEK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($pesan)){
  echo "Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<span class=posting>&#187; <b>Hubungi Kami</b></span><br /><br />"; 
  echo "<p align=center><b>Terimakasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		}else{
			echo "Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}
  echo "</div>
    </div>";            
}

?>      
