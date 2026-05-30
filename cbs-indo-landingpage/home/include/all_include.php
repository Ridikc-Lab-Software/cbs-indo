<?php
include 'admin/include/function/enc.php';
include 'admin/include/koneksi/koneksi.php';
include 'admin/include/settings/settings.php';
include 'home/include/settings/settings.php';
include 'home/include/settings/settings.php';    
include 'home/include/function/login.php';    
include 'admin/include/function/all.php';        
include 'admin/include/desain/'.$url_desain;
include 'home/include/function/all.php';    
include 'home/include/function/pagination_font_end.php';    

include $komponen.'/widget/produk.php';
include $komponen.'/widget/slideshow.php';

include 'home/content/detail_produk.php';
include 'home/content/kategori_produk.php';
include 'home/content/keranjang.php';
include 'home/content/galery.php';
include 'home/content/vidio.php';
include 'home/content/berita.php';
include 'home/content/detail_berita.php';
include 'home/content/prestasi.php';
include 'home/content/kontak.php';
include 'home/content/transaksi.php';
include 'home/content/daftar.php';
include 'home/content/login.php';
include 'home/content/akun.php';
?>