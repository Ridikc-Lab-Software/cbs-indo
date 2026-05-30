<?php include '../../../include/all_include.php';

if (!isset($_POST['id_promo']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_promo=xss($_POST['id_promo']);
$tanggal_mulai_berlaku=xss($_POST['tanggal_mulai_berlaku']);
$tanggal_batas_berlaku=xss($_POST['tanggal_batas_berlaku']);
$aktifkan_pembatasan_waktu=xss($_POST['aktifkan_pembatasan_waktu']);
$nama_promo=xss($_POST['nama_promo']);
$keterangan=xss($_POST['keterangan']);
$syarat_dan_ketentuan=xss($_POST['syarat_dan_ketentuan']);
$foto_promo=xss($_FILES['foto_promo']['name']); if (empty($foto_promo)){$foto_promo = $_POST['foto_promo1'];} else { $foto_promo = upload('foto_promo');};
$id_mitra=xss($_POST['id_mitra']);

$status=$_POST['status'];


$prefix = "jumlah_point_";
$prefix2 = "jumlah_value_";

$querytabel1="SELECT * FROM data_kategori_member";
$proses1 = mysql_query($querytabel1);
while ($data1 = mysql_fetch_array($proses1))
{
    $id_kategori_member = $data1['id_kategori_member'];
    $k = $prefix.$data1['kategori_member'];
    $point = ${$prefix.$k} = $_POST[$k];

    $k2 = $prefix2.$data1['kategori_member'];
    $value = ${$prefix2.$k2} = $_POST[$k2];



    $query=mysql_query("update data_point_promo set 
point='$point',
value='$value'
where 
id_promo='$id_promo' and
id_kategori_member='$id_kategori_member'

") or die (mysql_error());


}


$query=mysql_query("update data_promo set 
tanggal_mulai_berlaku='$tanggal_mulai_berlaku',
tanggal_batas_berlaku='$tanggal_batas_berlaku',
aktifkan_pembatasan_waktu='$aktifkan_pembatasan_waktu',
nama_promo='$nama_promo',
keterangan='$keterangan',
syarat_dan_ketentuan='$syarat_dan_ketentuan',
foto_promo='$foto_promo',
id_mitra='$id_mitra',

status='$status'
where id_promo='$id_promo' ") or die (mysql_error());

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_edit"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>