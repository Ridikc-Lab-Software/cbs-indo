<?php
require_once('../../../include/all_include.php');


$id_transaksi = isset($_POST["id_transaksi"]) ? $_POST["id_transaksi"] : "";
$tanggal = isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
$jam = isset($_POST["jam"]) ? $_POST["jam"] : "";
$id_member = isset($_POST["id_member"]) ? $_POST["id_member"] : "";
$id_petugas = isset($_POST["id_petugas"]) ? $_POST["id_petugas"] : "";
$kategori_member = isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"] : ""; // bukan id, kategori_member (motor, mobil)
$jenis_transaksi = isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"] : ""; // bukan id, jenis_transaksi
$point = isset($_POST["point"]) ? $_POST["point"] : "";
$jumlah = isset($_POST["jumlah"]) ? $_POST["jumlah"] : ""; // nominal (jumlah transaksi)
$aksi = isset($_POST["aksi"]) ? $_POST["aksi"] : "";


// data_plat_kendaraan_transaksi_voucher
$id_relasi = isset($_POST["id_relasi"]) ? $_POST["id_relasi"] : "";
$id_supir = isset($_POST["id_supir"]) ? $_POST["id_supir"] : "";



$no_plat_kendaraan = isset($_POST["plat_kendaraan"]) ? $_POST["plat_kendaraan"] : "";
$foto = upload_multiple_files("foto", "../../../../admin/upload/");

if ($jumlah > 1000) {
    $kategori_jumlah = "rupiah";
} else {
    $kategori_jumlah = "liter";
}

$id_jenis_transaksi = baca_database("", "id_jenis_transaksi", "SELECT id_jenis_transaksi FROM data_jenis_transaksi WHERE jenis_transaksi = '$jenis_transaksi'");

$point_nilai = baca_database("", "point", "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi='$jenis_transaksi'");
$harga = baca_database("", "harga", "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi='$jenis_transaksi'");


if ($aksi == "simpan-voucher") {
    if ($id_member == "")
    {
    $id_member = baca_database("","id_member","SELECT id_member FROM data_supir WHERE id_supir='$id_supir'");
    $nama_member = baca_database("", "nama", "SELECT nama FROM data_member WHERE id_member='$id_member'");
    }
    if ($kategori_jumlah == "rupiah") {
    $liter = ($harga > 0) ? floor($jumlah / $harga) : 0;
    } else {
    $liter = $jumlah;
    }
    $point = $liter * $point_nilai;
}

$point_awal = baca_database("", "point", "SELECT * FROM data_member WHERE id_member='$id_member'");
$sisa_point = $point_awal + $point;


if ($aksi == "simpan-voucher") {
    $id_voucher = isset($_POST["id_voucher"]) ? $_POST["id_voucher"] : "";
    //$id_member = "Voucher:" . $id_voucher;

    $kategori_member = baca_database(
        "",
        "kategori_member",
        "SELECT k.kategori_member
     FROM data_plat p
     LEFT JOIN data_kategori_member k
       ON p.id_kategori_member = k.id_kategori_member
     WHERE p.id_plat = '$no_plat_kendaraan'"
    );
}

$query = mysql_query("INSERT INTO data_transaksi VALUES (
    '$id_transaksi'
    ,'$tanggal'
    ,'$jam'
    ,'$id_member'
    ,'$id_petugas'
    ,'$kategori_member'
    ,'$jenis_transaksi'
    ,'$point'
    ,'$kategori_jumlah'
    ,'$jumlah'

)");

$id_harga_transaksi = id_otomatis("data_harga_transaksi", "id_harga_transaksi", "10");
$query = mysql_query("insert into data_harga_transaksi values (
'$id_harga_transaksi'
 ,'$id_transaksi'
 ,'$id_jenis_transaksi'
 ,'$jenis_transaksi'
 ,'$point_nilai'
 ,'$harga'
)");




$sql = "UPDATE data_member SET
point=?
WHERE id_member=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    $sisa_point,
    $id_member
]);

if ($aksi == "simpan-voucher") {
    date_default_timezone_set('Asia/Jakarta');
    $id_transaksi_voucher = $id_transaksi;
    $id_voucher = isset($_POST["id_voucher"]) ? $_POST["id_voucher"] : "";
    
    
    $tanggal_transaksi = date("Y-m-d H:i:s");
    $nominal = $jumlah;

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->beginTransaction();

    try {
        $stmt = $dbh->prepare("UPDATE data_voucher SET status = 'Used' WHERE id_voucher = ?");
        $stmt->execute([$id_voucher]);

        $stmt = $dbh->prepare("INSERT INTO data_transaksi_voucher VALUES (
            '$id_transaksi_voucher'
            ,'$id_voucher'
            ,'$id_member'
            ,'$nama_member'
            ,'$tanggal_transaksi'
            ,'$jenis_transaksi'
            ,'$nominal'
        )");
        $stmt->execute();

        


            $id_sisa_voucher=$id_transaksi;
            $nominal_asli_voucher = (float) baca_database("","nominal","SELECT * FROM data_voucher WHERE id_voucher='$id_voucher'");
            $nominal_sisa_voucher =  $nominal_asli_voucher - $nominal;

            if ($nominal_sisa_voucher > 0) { 
            $query_sisa_voucher=mysql_query("INSERT INTO data_sisa_voucher (id_sisa_voucher, id_voucher, id_relasi, nominal_voucher, nominal_transaksi, nominal_sisa, status) 
                VALUES (
                    '$id_sisa_voucher',
                    '$id_voucher',
                    '$id_relasi',
                    '$nominal_asli_voucher',
                    '$nominal',
                    '$nominal_sisa_voucher',
                    'unused'
                )");
            }



        if (!empty($no_plat_kendaraan)) {
            $id_plat = date('Ymdhis'); // Fungsi untuk generate ID baru
            $stmt = $dbh->prepare("INSERT INTO data_plat_kendaraan_transaksi_voucher (
                id_plat_kendaraan_transaksi_voucher,
                id_transaksi_voucher,
                no_plat_kendaraan,
                id_supir,
                id_relasi,
                foto
            ) VALUES (?, ?, ?, ?, ?, ?  )");
            $stmt->execute([
                $id_plat,
                $id_transaksi_voucher,
                $no_plat_kendaraan,
                $id_supir,
                $id_relasi,
                $foto
            ]);
        }

        $dbh->commit();
    } catch (Exception $e) {
        $dbh->rollBack();

        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'gagal update data voucher',
            // 'error'  => $e->getMessage(),
        ]);
        http_response_code(500);

        die();
    }
}

$resp = [];
if ($query) {
    $resp["status"] = "success";


    if ($aksi == "simpan-voucher") {

            $nama_spbu = baca_database("", "nama_spbu", "SELECT nama_spbu FROM data_petugas WHERE id_petugas='$id_petugas'");
            $kirim_email_transaksi_voucher = baca_database("", "value", "SELECT value FROM data_pengaturan WHERE nama='kirim_email_transaksi_voucher'");

            mysql_query("INSERT INTO data_transaksi_voucher_spbu(id_transaksi_voucher_spbu, id_transaksi_voucher, id_petugas,nama_spbu) 
                VALUES (
                    '$id_transaksi_voucher',
                    '$id_transaksi_voucher',
                    '$id_petugas',
                    '$nama_spbu'
                )");
            

            if ($kirim_email_transaksi_voucher == "yes") {

                $nama_supir = baca_database("", "nama_supir", "SELECT nama_supir FROM data_supir WHERE id_supir='$id_supir'");
                $nama_relasi = baca_database("", "nama", "SELECT nama FROM data_relasi WHERE id_relasi='$id_relasi'");
                $email_relasi = baca_database("", "email", "SELECT email FROM data_relasi WHERE id_relasi='$id_relasi'");
                $plat = baca_database("", "plat", "SELECT plat FROM data_plat WHERE id_plat='$no_plat_kendaraan'");
                include '../../../../../evoucher/admin/include/share_transaksi/send_mail.php';


                $message = createMessage(
                "https://cbs-indo.com/evoucher/index.php",
                "https://cbs-indo.com/admin/data/image/logo/logo2.png",
                "CBS E-Voucher",
                $nama_relasi,
                $id_voucher,
                date('d-m-Y H:i:s'),
                $nama_spbu,
                $plat,
                $nama_supir,
               "Rp " . number_format($nominal_asli_voucher, 0, ',', '.'),
"Rp " . number_format($nominal, 0, ',', '.'),
"Rp " . number_format($nominal_sisa_voucher, 0, ',', '.'));

            shareLinkToUser(
                new EmailShareLink(),
                $email_relasi,
                "Transaksi E-Voucher - ".$nama_relasi." - ".$id_voucher,
                $message
            );
            } 
    }
} else {
    $resp["status"] = "gagal";
}

echo (json_encode($resp));
