CMS Lokomedia versi 1.4.6
(Update terakhir 22 Januari 2011)


- Seiring terbitnya buku 'TRIK RAHASIA MASTER PHP TERBONGKAR LAGI',
dimana didalamnya dibahas perbaikan bug, trik security (keamanan), dan penambahan modul baru (fitur-fitur terbaru), maka CMS Lokomedia pun resmi update.

- Syarat utama menjalankan CMS Lokomedia, pastikan mod_rewrite pada server Apache sudah diaktifkan, caranya ada di buku atau bisa disaksikan langsung video tutorialnya yang ada di CD.

- Dan jangan lupa Import databasenya melalui phpMyAdmin dengan nama database dblokomedia (dblokomedia.sql).

- Untuk masuk ke halaman Administrator, ketik alamat berikut:

http://localhost/lokomedia/adminweb/

atau kalau sudah di online-kan:

http://namadomain/adminweb/

Isikan Username: admin dan Password: admin.
Tips: Segera ganti passwordnya apabila Anda sudah masuk ke halaman Administrator.  

- Adapun file untuk konfigurasi database bisa Anda temukan di folder lokomedia/config/koneksi.php, silahkan sesuaikan dengan username dan password database di komputer atau server hosting(domain) Anda.

- Dan terakhir, kritik dan saran membangun sangat saya harapkan dari para pembaca/pengguna CMS Lokomedia agar terus dapat berjalan dengan baik dan stabil.


Salam Hangat,

Lukmanul Hakim
(www.bukulokomedia.com)



Log update terakhir:

22/01/2011 (lokomedia-1.4.6)
- Penambahan session timeout (security), apabila admin/user lupa Logout (tidak ada aktifitas selama 90 detik) di halaman administrator, maka akan logout secara otomatis, untuk mengeset waktunya ada di file timeout.php yang terdapat di folder adminweb, penerapannya pada file media.php yang juga terdapat di folder adminweb.
- Untuk form yang menyediakan form upload gambar, divalidasi hanya file ber-ekstension *.jpg yang boleh diupload (security), dalam hal ini terdapat di file aksi_berita.php, aksi_galerifoto.php, aksi_sekilasinfo.php, aksi_album.php, aksi_banner.php, dan aksi_halamanstatis.php
- Begitu juga dengan file aksi_download.php, divalidasi tidak boleh mengupload file yang ber-ekstension *.php (security).
- Perbaikan pada paging hasil pencarian Berita yang tidak berfungsi (config/class_paging.php).
- Perbaikan pada modul Halaman Statis, dimana gambar tidak bisa di update (modul/mod_halamanstatis/aksi_halamanstatis.php).
- Penambahan fitur Headline pada Berita, sehingga apabila berita di set Headline, terutama untuk berita yang ada gambarnya, maka akan tampil di halaman utama website sebagai headline berita.


27/09/2010 (lokomedia-1.4.5):
- Penambahan templates baru bernama eL jQuery yang diambil dari buku 'Bikin Website Super Keren dengan PHP & jQuery" dan akan dijadikan templates default dari CMS Lokomedia.
- Perbaikan Paging ala Google, sehingga dapat berfungsi pada semua modul, termasuk kategori yang mengandung dua kata, perbaikannya cukup di file .htaccess (thanks to Husada).
- Penambahan Paging ala Google untuk Komentar.
- Sedikit perbaikan pada halaman Profil, dimana apabila Anda mengedit profil dan menggantinya dengan profil website Anda, maka tampilan pada halaman pengunjung untuk halaman profil akan tampil berantakan, jarak antar baris terlalu jauh, begitu juga dengan halaman statis lainnya (thanks to Chondik)
- Sedikit perbaikan pada file dina_titel.php (thanks to Hardie).
- Penambahan fasilitas pencarian berita berdasarkan judul di halaman administrator (modifikasi file berita.php di foder adminweb/modul/mod_berita.

02/09/2010 (lokomedia-1.4.4):
- Penerapan Paging ala Google, baik di halaman administrator maupun halaman pengunjung (thanks to Husada).
- Perbaikan desain footer overlapping pada halaman administrator (thanks to luky wijaya).
- Apabila kategori mengandung dua kata atau lebih yang ada spasinya, maka akan mengakibatkan paging menjadi tidak berfungsi, misalnya Baju Tidur.

23/06/2010 (lokomedia-1.4.3):
Update kali ini diambil dari pengembang website http://wiraswastamuslim.com (thanks to Imran), yaitu:
- Penambahan Halaman Statis (tabel halamanstatis), contohnya Profil dan Visi Misi.
- Penambahan Top Menu (topmenu.php), yaitu Menu Utama dan Sub Menu (tabel mainmenu dan tabel submenu). Untuk menambah/mengedit menu bisa dilakukan melalui halaman administrator.
- Ada juga tambahan navigasi atau breadcumb (breadcumb.php) agar user mengetahui sedang berada di halaman mana.

27/05/2010 (lokomedia-1.4.2):
- Penambahan tinymce_compressor untuk mempercepat agar editor tinymcpuk dapat ditampilkan lebih cepat. Efeknya akan terasa saat online (thanks to Husada).
- Pencarian tidak hanya mencari dari isi berita saja, tapi juga judul berita, karena tidak menutup kemungkinan kata yang dicari malah ada pada judulnya (thanks to Husada).
- apabila kita menghapus berita yang tidak ada gambarnya, maka akan tampil peringatan di browser, namun proses penghapusan berhasil, namun mengganggu pandangan dan tidak kembali ke halaman halaman administrator. Jadi, pada file aksi_berita.php ditambahkan IF untuk mengecek apakah ada gambar pada sebuah berita atau tidak? (thanks to Fajar Nugraha).


20/05/2010 (lokomedia-1.4.1):
- Agar tidak bosan, header dari Halaman Administrator telah saya ganti.
- Pada file .htaccess untuk kategori telah saya ubah agar alamat urlnya mengikuti nama kategori, kalau sebelumnya: kategori-2.html diubah menjadi kategori-2-olahraga.html (thanks to Ahmed Ridho).
- Pada file kiri.php di bagian detail berita perkategori telah ditambahkan <table> untuk merapikan tampilan seperti halaman utama/Home (thanks to Fajar Nugraha).
- Celah lainnya, kita bisa menginputkan berita tanpa Login, yaitu dengan langsung mengetik alamat domain/adminweb/modul/mod_berita/berita.php, kemudian mengubah actionnya menjadi domain/adminweb/modul/mod_berita/aksi_berita.php. Oleh karena itu, setiap file dalam modul sudah ditambahkan session untuk menangkal hal tersebut (thanks to Bayu).


17/05/2010 (lokomedia-1.4):
- Untuk mempercantik Halaman Administrator, ditambahkan ikon-ikon Control Panel sebagai alternatif selain menu untuk mengelola content website (thanks to Suhan).
- Pada input text untuk Pencarian, pengunjung masih bisa mengisikan kode XSS, misalnya <script>, maka hasil pencariannya akan membuat layout website menjadi berantakan, maka pada file kiri.php (baris 267) telah ditambahkan fungsi untuk menangkal XSS (thanks to Eddy Irawan).
- Sebelumnya untuk mengubah pertanyaan pada Poling dilakukan secara manual melalui file kanan.php. Agar terlihat dinamis, maka pertanyaan untuk Poling bisa diubah melalui Halaman Administrator (thanks to Bayu). Pertama, saya menambahkan field status pada tabel poling untuk membedakan antara Pertanyaan dan Jawaban Poling. Kemudian pada file kanan.php juga disesuaikan agar bisa menampilkan Pertanyaan dan Jawaban Poling yang aktif. Sedangkan pada file kiri.php juga disesuaikan untuk Pertanyaan dan Jawaban Poling.
- Beberapa email yang masuk menanyakan mengapa mod_rewrite tidak bisa diaktifkan/xampp gagal di restart, padahal sudah sesuai dengan petunjuk pada video tutorial. Kemudian, saya coba pada beberapa komputer di kantor, ternyata ada yang berhasil dan ada juga yang gagal, termasuk di komputer Macintosh juga gagal. Untuk komputer yang gagal, saya coba uninstall xampp dan menggantinya dengan wamp, ternyata berhasil (mod_rewrite sukses). Dan sampai saat ini, wamp selalu berhasil menjalankan mod_rewrite pada semua komputer yang pernah saya coba, baik di kantor, rumah maupun warnet.
- Namun, apabila CMS Lokomedia dijalankan pada wamp, akan tampil peringatan (Notice) yang mengganggu layout dan content website. Oleh karena itu, pada versi ini telah saya perbaiki dengan menyesuaikan beberapa skrip seperti:
$_GET[module] disesuaikan dengan menambahkan tanda petik tunggal menjadi $_GET['module']. Dan pada file media.php yang terdapat di folder adminweb juga telah saya tambahkan baris error_reporting(0);
- Apabila file .htaccess tidak berfungsi saat Anda online-kan di suatu server hosting, coba tambahkan pada file .htaccess pada baris ke-2 (thanks to Fajar Nugraha):

RewriteBase /


26/02/2010 (lokomedia-1.3):
- Ada yang bisa menuliskan berita langsung tanpa harus login, caranya http://namadomain/content.php? (thanks to Daus), sehingga file content.php harus diproteksi dengan cara mencek level user yang login (baris 51 s/d 53): 
- Sekarang untuk mengaktifkan/menon-aktifkan suatu modul di halaman pengunjung tidak perlu melalui skrip lagi, katanya agak ribet bagi newbie, jadi cukup masuk ke halaman administrator, lalu klik Manajemen Modul, lihat status Publish, apabila suatu Modul status Publish = Y, artinya modul tersebut ditampilkan di halaman pengunjung. Sedangkan untuk menon-aktifkan suatu modul, klik link Edit pada modul yang diinginkan, lalu ubah Publish = N, dan klik Update.
Beberapa file yang diubah:
  - modul.php yang terdapat di folder adminweb/modul/mod_modul/, yaitu pada bagian 'tambahmodul' ditambahkan input untuk Publish dan Aktif (baris 31 s/d 34).
  - kiri.php, kanan.php, dan tengah.php yang terdapat di folder lokomedia, intinya memeriksa apakah sebuah modul status Publish, apabila Y maka ditampilkan, sedangkan N berarti tidak ditampilkan. Salah satu contohnya pada file kanan.php (baris 11 s/d 16) untuk memeriksa apakah modul RSS dipublish atau tidak.
 

10/02/2010 (lokomedia-1.2):
- Menampilkan ikon youtube (halaman administrator, misalnya Tambah Berita), solusinya ada di file media.php yang berada di folder adminweb, pada baris 21 dan baris 25, tambahkan kata-kata: youtube.
- Mengenai berita terkait yang tidak tampil dikarenakan id_berita lebih dari dua digit, misalnya 100 .. solusinya ada di file kiri.php yang berada di folder lokomedia, pada baris 118, yaitu: $ambil_id = substr($_GET[id],0,4); --> maksudnya mengambil empat digit dari id_berita, jadi kalau id_beritanya sampai ribuan masih mendukung dan kalau dibawah empat digit juga terbaca kok.
 

05/02/2010 (lokomedia-1.1): 
- Membatasi input teks di form pencarian untuk mencegah user memasukkan teks sampai 1000 karakter, cukup tambahkan maxlength=50 pada file tengah.php pada baris ke-5 (thanks to thondi).
- Mulai saat ini, setiap ada update akan saya sertakan tanggalnya dan saya beritahu bagian mana dan baris ke berapa yang saya perbaiki (thanks to wilda).


=====> daftar update dibawah ini sudah lupa tanggalnya.

- Donwload Counter sudah bisa berjalan dengan baik.
- Merapikan tampilan hasil pencarian (thanks to thondi).
- Memproteksi Agenda dan Profil Administrator agar tidak bisa diakses oleh user biasa (thanks to Adhi Nugroho).
- Merapikan tampilan semua berita (thanks to thondi)
- Wuih aplikasi download yang sudah saya proteksi ternyata masih bisa ditembus dengan cara mengetikkan http://localhost/lokomedia/downlot.php?file=../config/koneksi.php (syukur deh sekarang makin banyak aja yang pinter programming - thanks to komaruddin a.k.a virus13). Oleh karena itu segera saya update menggunakan tekniknya Ahmed Ridho yang telah saya bahas pada buku Trik Rahasia Master PHP Terbongkar Lagi, tepatnya pada halaman 149.
- Menurut laporan code13 yang mencoba login sebagai user biasa, dia bisa mengakses modul-modul admin, contohnya dengan mengetikkan http://localhost/lokomedia/adminweb/media.php?module=komentar, dan modul-modul lainnya .. perbaikan bug tersebut bisa ditangani dengan mengecek level user yang ada di session, implementasinya bisa dilihat di file content.php yang terdapat di folder lokomedia/adminweb.
- Beberapa komentar dan email yang masuk menyarankan agar mengganti nicedit dengan tinymcpuk sebagai editor textarea, karena lebih kaya fiturnya, thanks to code13 dan reva atas sumbangsihnya, sehingga memudahkan saya dalam mengintegrasikan tinymcpuk dengan cms lokomedia.
- Penambahan fungsi unlink pada file aksi_berita yang terdapat di folder adminweb/modul/mod_berita, fungsinya untuk menghapus file gambar di server, jadi tidak hanya menghapus nama filenya di database, akan tetapi juga menghapus filenya di server.
- Penambahan fitur Arsip Berita (thanks to code 13 from http://blog.nagageni.com) yang di include pada file tengah.php .. adapun file-file yang menangani arsip berita adalah arsipberita.php, getarticle.php, dan jquery.js.
- Perbaikan Tambah Agenda yang datanya tidak bisa tersimpan ke database.
- Menghilangkan angka 1 di pojok kiri bawah (bug).
- Menghilangkan tampilan error saat melakukan vote pada polling (bug).
- Validasi input pada shoutbox.
- Validasi input pada hubungi kami disertai penambahan captcha pada form hubungi kami.
- Pembatasan karakter yang boleh dimasukkan ke dalam form komentar untuk mencegah user jahil yang mengisikan komentar lebih dari 1000 karakter.
- Perbaikan error saat menyimpan komentar berita (simpankomentar.php).
- Pemberian Anchor pada nama komentar (kiri.php pada bagian detail berita), sehingga ketika diklik komentar pada bagian Komentar Terakhir di halaman utama (tengah.php), maka akan langsung menuju komentar yang diklik pada halaman detail berita.s
- Penambahan status YM (Yahoo Messenger) pada file kanan.php, hasilnya hanya bisa dilihat saat sudah di online-kan di Internet.
- Penambahan fungsi session_generate_id pada file cek_login.php agar user biasa lebih sulit mengganti password sang administrator.
- Penambahan fungsi unlink pada file aksi_galerifoto yang terdapat di folder adminweb/modul/mod_galerifoto, fungsinya untuk menghapus file gambar di server, jadi tidak hanya menghapus nama filenya di database, akan tetapi juga menghapus filenya di server.
- Penambahan fungsi trim pada file simpankomentar.php untuk mengantisipasi pengunjung mengisikan spasi untuk mengosongkan nama dan komentarnya.
- Penambahan field aktif pada tabel kategori dan tabel album, nantinya data-data pada kedua tabel tersebut tidak bisa dihapus, tapi bisa di non-aktifkan dengan mengklik menu Edit. Mengapa tidak boleh dihapus? Karena kalau data kategori dihapus, maka berita-berita pada kategori tersebut sudah tidak bisa ditampilkan. Begitu juga dengan album, apabila album dihapus, maka foto-foto pada album tersebut sudah tidak bisa ditampilkan.


