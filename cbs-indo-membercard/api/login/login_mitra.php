<?php 
require_once('../../admin/include/koneksi/koneksi.php');

function cek_database($tabel,$field,$value,$query)
{
	if ($query=="")
	{
		$sql = "SELECT * FROM ".$tabel." WHERE ".$field." ='".$value."'";
	}
	else
	{
		$sql = $query;
	}
	
	$cek_user=mysql_num_rows(mysql_query($sql));
	if ($cek_user > 0) 
	{   
		$hasiltermantab = "ada";
	}
	else
	{
		$hasiltermantab = "nggak";
	}
	return $hasiltermantab;
}


//BACA DATABASE
function baca_database($tabel,$field,$query)
{
	
	if ($query=="")
	{
		$sql = 'SELECT * FROM '.$tabel;
	}
	else
	{
		$sql = $query;
	}
	
	$querytabelualala=$sql;
	$prosesulala = mysql_query($querytabelualala);
	$datahasilpemrosesanquery = mysql_fetch_array($prosesulala);
	$hasiltermantab = $datahasilpemrosesanquery[$field];
	return $hasiltermantab;
}



$username = $_POST['username'];
$password = md5($_POST['password']);
$statement = $dbh->prepare("SELECT * FROM data_mitra where username='$username' and password='$password'");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$resp = [];

$cek = cek_database("","","","SELECT * FROM data_mitra where username='$username' and password='$password'");
if ($cek=="ada")
{
    $resp["status"]="success";
}
else
{
    $resp["status"]="gagal";
}

$id_mitra = baca_database("","id_mitra","SELECT * FROM data_mitra where username='$username' and password='$password'");
$logo_mitra = baca_database("","gambar_logo","SELECT * FROM data_mitra where id_mitra='$id_mitra'");
$nama_mitra = baca_database("","nama_mitra","SELECT * FROM data_mitra where id_mitra='$id_mitra'");
$alamat_mitra = baca_database("","alamat","SELECT * FROM data_mitra where id_mitra='$id_mitra'");
$status_mitra = baca_database("","status","SELECT * FROM data_mitra where id_mitra='$id_mitra'");


$resp['result'] = array(
                'nama_pegawai' => $username,
                'jabatan'      => $id_mitra,
                'tkn'        => $id_mitra,
				'logo_mitra'        => $logo_mitra,
				'nama_mitra'        => $nama_mitra,
				'alamat_mitra'        => $alamat_mitra,
				'status_mitra'        => $status_mitra
				);
				

echo (json_encode($resp)) 
?>