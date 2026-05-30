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
		$query="SELECT * FROM data_group_jenis_transaksi where $berdasarkan like '%$isi%'";
	}
	else
	{
		$query="SELECT * FROM data_group_jenis_transaksi where $berdasarkan like '%$isi%'";
	}
}
else
{
	$query = "select * from data_group_jenis_transaksi";
}

$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	
	$id_group_jenis_transaksi = $data["id_group_jenis_transaksi"];	
    $hasil['id_group_jenis_transaksi'] = $id_group_jenis_transaksi;
	$hasil['nama_group'] = $data["nama_group"];
	$hasil['id_jenis_transaksi'] = $data["id_jenis_transaksi"];
	$hasil['gambar_logo'] = $data["gambar_logo"];
	
    array_push($resp["result"], $hasil);
  }
  
json_print($resp);
?>




