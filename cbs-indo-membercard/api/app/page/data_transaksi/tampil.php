<?php 

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

date_default_timezone_set("Asia/Jakarta");
date_default_timezone_get();

require_once('../../../include/all_include.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();
$sekarang = date('Y-m-d');

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi']))
{
	$berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
	$isi =  mysql_real_escape_string($_POST['isi']);
	$limit =  mysql_real_escape_string($_POST['limit']);
	$hal =  mysql_real_escape_string($_POST['hal']);
	if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai']))
	{
		$dari =  mysql_real_escape_string($_POST['dari']);
		$sampai =  mysql_real_escape_string($_POST['sampai']);
		$query="SELECT * FROM data_transaksi where $berdasarkan like '%$isi%'";
	}
	else
	{
		$query="SELECT * FROM data_transaksi where $berdasarkan like '%$isi%'";
	}
}
else
{
	 $query = "select * from data_transaksi where tanggal = '$sekarang' order by id_transaksi desc";
}

$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	
	$id_transaksi = $data["id_transaksi"];	
    $hasil['id_transaksi'] = $id_transaksi;
	$hasil['tanggal'] = $data["tanggal"];
	$hasil['jam'] = $data["jam"];
	$id_member = $data["id_member"];
	$hasil['id_member'] = baca_database("","nama","select * from data_member where id_member='$id_member'");
	$id_petugas = $data["id_petugas"];
	$hasil['id_petugas'] =  baca_database("","nama","select * from data_petugas where id_petugas='$id_petugas'");
	$hasil['id_kategori_member'] = $data["id_kategori_member"];
	$hasil['id_jenis_transaksi'] = $data["id_jenis_transaksi"];
	$hasil['point'] = $data["point"];

	$jumlah = $data["jumlah"];
	if($jumlah < 1000)
	{
		$jumlah = $data["jumlah"]." Liter";
	}
	else
	{
		$jumlah = "Rp".number_format($data["jumlah"]);
	}

	$hasil['jumlah'] = $jumlah;
	
    array_push($resp["result"], $hasil);
  }
  
json_print($resp);
?>






