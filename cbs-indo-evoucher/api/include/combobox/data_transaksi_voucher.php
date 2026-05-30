<?php 
require_once('../../../admin/include/koneksi/koneksi.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();
$hasil['id']    = "0";
$hasil['nama']  = "- Pilih Data -";
array_push($resp["result"], $hasil);

$query = "select * from data_transaksi_voucher";
$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {

    $hasil['id']    = $data['id_transaksi_voucher'];
    $hasil['nama']    = $data['id_voucher'];
	
    array_push($resp["result"], $hasil);
  }
echo (json_encode($resp)) 
?>
