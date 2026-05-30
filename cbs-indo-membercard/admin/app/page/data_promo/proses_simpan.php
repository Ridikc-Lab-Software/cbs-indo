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


$id_promo=id_otomatis("data_promo","id_promo","10");
$tanggal_mulai_berlaku=xss($_POST['tanggal_mulai_berlaku']);
$tanggal_batas_berlaku=xss($_POST['tanggal_batas_berlaku']);
$aktifkan_pembatasan_waktu=xss($_POST['aktifkan_pembatasan_waktu']);
$nama_promo=xss($_POST['nama_promo']);
$keterangan=xss($_POST['keterangan']);
$syarat_dan_ketentuan=xss($_POST['syarat_dan_ketentuan']);
$foto_promo= upload('foto_promo');
$jumlah_point=xss($_POST['jumlah_point']);
$id_mitra=xss($_POST['id_mitra']);
$status=xss($_POST['status']);


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


				 $id_point_promo = id_otomatis("data_point_promo","id_point_promo","10");
				 $query=mysql_query("insert into data_point_promo values (
					'$id_point_promo'
					 ,'$id_promo'
					 ,'$id_kategori_member'
					 ,'$point'
					 ,'$value'
					)");
			 }



$query=mysql_query("insert into data_promo values (
'$id_promo'
 ,'$tanggal_mulai_berlaku'
 ,'$tanggal_batas_berlaku'
 ,'$aktifkan_pembatasan_waktu'
 ,'$nama_promo'
 ,'$keterangan'
 ,'$syarat_dan_ketentuan'
 ,'$foto_promo'
 ,0
 ,'$id_mitra'
 ,'$status'

)");

if($query){
?>
<script>location.href = "index.php?Berdasarkan=id_mitra&isi=<?php echo $id_mitra;?>"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>