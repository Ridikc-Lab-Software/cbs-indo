<?php 
require_once('../../../include/all_include.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();

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
		$query="SELECT * FROM data_pengaturan_point where $berdasarkan like '%$isi%'";
	}
	else
	{
		$query="SELECT * FROM data_pengaturan_point where $berdasarkan like '%$isi%'";
	}
}
else
{
	$query = "select * from data_pengaturan_point";
}

$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	
	$id_pengaturan_point = $data["id_pengaturan_point"];	
    $hasil['id_pengaturan_point'] = $id_pengaturan_point;
	$hasil['nama_pengaturan'] = $data["nama_pengaturan"];
	$hasil['id_kategori_member'] = $data["id_kategori_member"];
	$hasil['id_jenis_transaksi'] = $data["id_jenis_transaksi"];
	$hasil['point'] = $data["point"];
	
    array_push($resp["result"], $hasil);
  }
  
json_print($resp);
?>




