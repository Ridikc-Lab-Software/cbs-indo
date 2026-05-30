<?php 

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);


require_once('../../../include/all_include.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();


function check_in_range($start_date, $end_date, $date_from_user)
{
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi']))
{
	$berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
	$isi =  mysql_real_escape_string($_POST['isi']);

	$hal =  mysql_real_escape_string($_POST['hal']);
	if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai']))
	{
		$dari =  mysql_real_escape_string($_POST['dari']);
		$sampai =  mysql_real_escape_string($_POST['sampai']);
		$query="SELECT * FROM data_promo where $berdasarkan like '%$isi%'";
	}
	else
	{
		$query="SELECT * FROM data_promo where $berdasarkan like '%$isi%'";
	}
}
else
{
	$query = "select * from data_promo";
}


$id_member =  mysql_real_escape_string($_POST['limit']);
$id_kategori_member = baca_database("","id_kategori_member","select * from data_member where id_member='$id_member'");
$kategori_member = baca_database("","kategori_member","select * from data_kategori_member where id_kategori_member='$id_kategori_member'");



$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	$id_promo = $data["id_promo"];	
	$aktifkan_pembatasan_waktu = $data["aktifkan_pembatasan_waktu"];	
	$point = baca_database("","point","select * from data_point_promo where id_promo='$id_promo' and id_kategori_member='$id_kategori_member'");
	if ($point == "" or $point < 1)
	{

	}
	else
	{
	
	$tampil = "ya";
	if ($aktifkan_pembatasan_waktu == "ya")
	{
		$start_date = $data["tanggal_mulai_berlaku"];
		$end_date = $data["tanggal_batas_berlaku"];
		$date_from_user = date('Y-m-d');
		check_in_range($start_date, $end_date, $date_from_user);
		if (check_in_range($start_date, $end_date, $date_from_user)==  "" or check_in_range($start_date, $end_date, $date_from_user)==  "0")
		{
			$tampil = "nggak";
		}
	}
	
	if ($tampil == "ya")
	{
    $hasil['id_promo'] = $id_promo;
	$hasil['tanggal_mulai_berlaku'] = $data["tanggal_mulai_berlaku"];
	$hasil['tanggal_batas_berlaku'] = $data["tanggal_batas_berlaku"];
	$hasil['nama_promo'] = $data["nama_promo"];
	$hasil['keterangan'] = baca_database("","value","select * from data_point_promo where id_promo='$id_promo' and id_kategori_member='$id_kategori_member'");
	$hasil['syarat_dan_ketentuan'] = $kategori_member;
	$hasil['foto_promo'] = $data["foto_promo"];
	$hasil['id_mitra'] = $data["id_mitra"];
	$hasil['jumlah_point'] = baca_database("","point","select * from data_point_promo where id_promo='$id_promo' and id_kategori_member='$id_kategori_member'");
	$hasil['status'] = "Point Berdasarkan Status Kendaraan ".$kategori_member;
    array_push($resp["result"], $hasil);
	}

	
	}
  }
  
json_print($resp);
?>




