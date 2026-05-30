<?php if (empty($p)) {
    header("Location: index.php?p=home");
    die();
} ?>

<?php
function check_in_range($start_date, $end_date, $date_from_user)
{
    return (strtotime($date_from_user) >= strtotime($start_date) && strtotime($date_from_user) <= strtotime($end_date));
}
?>

<style>
    .promo-wrapper {
        background: #ffffff;
        padding: 40px 0;
    }

    .promo-header-title {
        font-size: 36px;
        font-weight: 700;
        color: #d42e12;
        text-align: center;
        margin-top: 20px;
    }

    .promo-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 18px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .promo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .promo-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .promo-date {
        color: #888;
        font-size: 14px;
    }

    .promo-img {
        width: 140px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
    }

    .promo-btn {
        background: #d42e12;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 14px;
    }

    .promo-btn:hover {
        background: #aa1e0a;
        color: #fff;
    }

    .promo-badge {
        display: inline-block;
        padding: 5px 10px;
        background: #28a745;
        color: #fff;
        font-size: 13px;
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .promo-badge-expired {
        background: #777;
    }
</style>

<section class="promo-wrapper">
    <div class="container">

        <center>
            <img src="admin/upload/promo.png" width="750" style="margin-bottom:20px;">
            <h2 class="promo-header-title">Promo CBS</h2>
        </center>
        <br><br>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php
                // DETAIL PROMO LINK
                if (isset($_GET['detail'])) {
                ?>
                    <a href="?p=detail_promo&id=<?php echo $_GET['id']; ?>" class="btn btn-danger mb-4">⬅ Kembali ke Informasi Promo</a>
                <?php
                    $id_promo = mysql_real_escape_string(decrypt($_GET['detail']));
                    $querytabel = "SELECT * FROM data_promo WHERE id_promo='$id_promo' ORDER BY tanggal_batas_berlaku desc";
                } else {
                    $querytabel = "SELECT * FROM data_promo where status='aktif' ORDER BY tanggal_batas_berlaku DESC";
                }

                $proses = mysql_query($querytabel);

                while ($data = mysql_fetch_array($proses)) {

                    $aktifkan_pembatasan_waktu = $data["aktifkan_pembatasan_waktu"];
                    $start_date = $data["tanggal_mulai_berlaku"];
                    $end_date = $data["tanggal_batas_berlaku"];
                    $today = date("Y-m-d");

                    // STATUS AKTIF / EXPIRED
                    $is_active = true;
                    if ($aktifkan_pembatasan_waktu == "ya") {
                        $is_active = check_in_range($start_date, $end_date, $today);
                    }

                    if ($is_active) {
                        $badge = "<span class='promo-badge'>AKTIF</span>";
                    // } else {
                    //     $badge = "<span class='promo-badge promo-badge-expired'>EXPIRED</span>";
                    // }

                ?>

                    <!-- CARD PROMO -->
                    <div class="promo-card">
                        <img src="admin/upload/<?php echo $data['foto_promo']; ?>"
                            class="promo-img"
                            onerror="this.src='<?php echo $imageerror; ?>'">

                        <div style="flex:1">
                            <?php echo $badge; ?>

                            <p class="promo-title">
                                <?php echo $data['nama_promo']; ?>
                            </p>

                            <p class="promo-date">
                                Berlaku:
                                <br>
                                <b><?php echo format_indo($start_date); ?></b>
                                &nbsp;–&nbsp;
                                <b><?php echo format_indo($end_date); ?></b>
                            </p>
                        </div>

                        <div>
                            <a href="?p=detail&id=<?php echo (encrypt($data['id_promo'], 0, 100)); ?>"
                                class="promo-btn">
                                Detail
                            </a>
                        </div>
                    </div>

                <?php } ?>
                <?php } ?>

            </div>
        </div>

    </div>
</section>

<br><br><br>