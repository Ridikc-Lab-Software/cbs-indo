<?php 

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
file_put_contents("log.txt", date('Y-m-d H:i:s')." login masuk\n", FILE_APPEND);
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
$statement = $dbh->prepare("SELECT * FROM data_petugas where username='$username' and password='$password'");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$resp = [];
$id_petugas = null;

if (isset($_POST['id_petugas_qr']) && !empty($_POST['id_petugas_qr'])) 
{
	$id_petugas_qr = $_POST['id_petugas_qr'];
	$cek = cek_database("","","","SELECT * FROM data_petugas where id_petugas='$id_petugas_qr'");
	
	if ($cek=="ada")
	{
		$resp["status"]="success";
	}
	else
	{
		$resp["status"]="gagal";
	}

	$username = baca_database("","username","SELECT * FROM data_petugas where id_petugas='$id_petugas_qr'");
	$spbu = baca_database("","nama_spbu","SELECT * FROM data_petugas where id_petugas='$id_petugas_qr'");
	$alamat1 = baca_database("","alamat1","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
	$alamat2 = baca_database("","alamat2","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
	$telepon = baca_database("","telepon","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
	$penutup = baca_database("","penutup","SELECT * FROM data_spbu where  nama_spbu='$spbu'");

	$resp['result'] = array(
					'nama_pegawai' => $username,
					'jabatan'      => baca_database("","id_mitra","SELECT * FROM data_mita_cbs"),
					'tkn'        => $id_petugas_qr,
					'spbu'        => $spbu,
					'alamat1'        => $alamat1,
					'alamat2'        => $alamat2,
					'telepon'        => $telepon,
					'penutup'        => $penutup
					);
					

	echo (json_encode($resp));
	die;
}

$cek = cek_database("","","","SELECT * FROM data_petugas where username='$username' and password='$password'");
if ($cek=="ada")
{
    $resp["status"]="success";
}
else
{
    $resp["status"]="gagal";
}

$id_petugas = baca_database("","id_petugas","SELECT * FROM data_petugas where username='$username' and password='$password'");
$spbu = baca_database("","nama_spbu","SELECT * FROM data_petugas where  id_petugas='$id_petugas'");
$alamat1 = baca_database("","alamat1","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
$alamat2 = baca_database("","alamat2","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
$telepon = baca_database("","telepon","SELECT * FROM data_spbu where  nama_spbu='$spbu'");
$penutup = baca_database("","penutup","SELECT * FROM data_spbu where  nama_spbu='$spbu'");

$resp['result'] = array(
                'nama_pegawai' => $username,
                'jabatan'      => baca_database("","id_mitra","SELECT * FROM data_mita_cbs"),
                'tkn'        => $id_petugas,
                 'spbu'        => $spbu,
                 'alamat1'        => $alamat1,
                 'alamat2'        => $alamat2,
                 'telepon'        => $telepon,
                 'penutup'        => $penutup
				);
				

echo (json_encode($resp)) 
?>