<?php 
require_once('../../../include/all_include.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();

function cleanjson($text) {
    // Hilangkan karakter yang tidak valid di JSON
    $text = trim($text);                        // Hapus spasi di awal & akhir
    $text = strip_tags($text);                  // Hapus tag HTML (jika ada)
    $text = htmlspecialchars($text, ENT_QUOTES); // Konversi karakter HTML sensitif
    $text = str_replace(["\r", "\n", "\t"], ' ', $text); // Hilangkan newline/tab
    $text = addslashes($text);                  // Escape kutip & karakter khusus
    return $text;
}



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
		$query="SELECT * FROM data_redeem where $berdasarkan like '%$isi%' order by id_redeem desc limit 0,100 ";
	}
	else
	{
		$query="SELECT * FROM data_redeem where $berdasarkan like '%$isi%' order by id_redeem desc limit 0,100";
	}
}
else
{
	$query = "select * from data_redeem order by id_redeem desc limit 0,100";
}

$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	
	$id_redeem = $data["id_redeem"];	
    $hasil['id_redeem'] = $id_redeem;
	$hasil['tanggal'] = $data["tanggal"];
	$hasil['jam'] = $data["jam"];
	$id_member = $data["id_member"];
	$hasil['id_member'] = baca_database("","nama","select * from data_member where id_member='$id_member'");
	$id_mitra = $data["id_mitra"];
	$hasil['id_mitra'] = baca_database("","nama_mitra","select * from data_mitra where id_mitra='$id_mitra'");

	$id_promo = $data["id_promo"];
	$hasil['id_promo'] = cleanjson(baca_database("","nama_promo","select * from data_promo where id_promo='$id_promo'"));

	$hasil['point'] = $data["point"]." Point";
	$hasil['status'] = "Rp".number_format($data["jumlah"]*$data["value_redeem"])."<br><b>Jumlah : </b>".$data["jumlah"];
	
    array_push($resp["result"], $hasil);
  }
  
json_print($resp);
?>




