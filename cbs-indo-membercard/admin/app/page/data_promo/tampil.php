<style>
    /* Tombol atas */
    .action-bar {
        margin-bottom: 25px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }



    /* Grid Card 5 kolom */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 50px;
    }

    @media (max-width: 1400px) {
        .card-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 1100px) {
        .card-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 800px) {
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .card-grid {
            grid-template-columns: 1fr;
        }
    }

    .card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.35s ease;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18);
    }

    .card.expired {
        opacity: 0.55;
    }

    .card-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .card-body {
        padding: 18px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .card-mitra {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 12px;
    }

    .point-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 14px;
    }

    .point-tag {
        background: oklch(0.97 0 0);
        color: #71717c;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
    }

    .card-date {
        font-size: 0.88rem;
        color: var(--success);
        font-weight: 600;
        margin-bottom: 14px;
    }

    /* Badge status & overlay kadaluarsa */
    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #06d6a0;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        z-index: 10;
    }

    .status-badge-expired {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #ef6e67;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        z-index: 10;
    }

    .status-inactive {
        background: #8d99ae !important;
    }

    .expired-overlay {
        position: absolute;
        inset: 0;
        background: rgba(239, 71, 111, 0.94);
        color: white;
        font-size: 1.7rem;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9;
    }

    /* Tombol aksi bawah */
    .card-actions {
        margin-top: auto;
        display: flex;
        gap: 8px;
    }

    .card-actions a {
        flex: 1;
        text-align: center;
        padding: 9px 6px;
        font-size: 0.85rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }



    .card-actions a:hover {
        transform: scale(1.05);
    }

    /* Pagination (sederhana) */
    .pagination {
        text-align: center;
        margin: 40px 0;
    }

    .pagination a {
        display: inline-block;
        padding: 10px 16px;
        margin: 0 4px;
        background: white;
        color: var(--primary);
        text-decoration: none;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .pagination a.active,
    .pagination a:hover {
        background: var(--primary);
        color: white;
    }
</style>

<div class="">


    <div class="card-group-title">
        <div class="title-left">
            <img src="../../../data/tmp/membercard/files/icon/promo.png" width="40px">
            <p>
                Promo Mitra
            </p>
        </div>

        <div class="title-right">
            <a href="<?php index(); ?>?input=tambah&isi=<?php echo $_GET['isi']; ?>" class="btn btn-success">Tambah Promo</a>

        </div>
    </div>






    <!-- CARD GRID -->
    <div class="card-grid">
        <?php
        function check_in_range($start_date, $end_date, $today)
        {
            return (strtotime($today) >= strtotime($start_date) && strtotime($today) <= strtotime($end_date));
        }

        $startRow = ($page - 1) * $dataPerPage;

        if (!empty($_GET['Berdasarkan']) && !empty($_GET['isi'])) {
            $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
            $isi         = mysql_real_escape_string($_GET['isi']);
            $querytabel  = "SELECT * FROM data_promo WHERE $berdasarkan LIKE '%$isi%' ";
            $querypagination = "SELECT COUNT(*) AS total FROM data_promo WHERE $berdasarkan LIKE '%$isi%'";
        } else {
            $querytabel  = "SELECT * FROM data_promo ";
            $querypagination = "SELECT COUNT(*) AS total FROM data_promo";
        }

        $no = $startRow;
        $proses = mysql_query($querytabel);
        while ($data = mysql_fetch_array($proses)) {
            $no++;

            $expired = false;
            if ($data["aktifkan_pembatasan_waktu"] == "ya") {
                if (!check_in_range($data["tanggal_mulai_berlaku"], $data["tanggal_batas_berlaku"], date('Y-m-d'))) {
                    $expired = true;
                }
            }

            $nama_mitra = baca_database("", "nama_mitra", "SELECT * FROM data_mitra WHERE id_mitra = '{$data['id_mitra']}'");
            $status_class = ($data['status'] == 'aktif') ? '' : 'status-inactive';
        ?>
            <div class="card ">

                <?php if ($expired) { ?>
                    <span class="status-badge-expired">
                        EXPIRED

                    </span>
                <?php } else { ?>
                    <span class="status-badge <?php echo $status_class; ?>">
                        <?php echo strtoupper($data['status']); ?>

                    </span>
                <?php } ?>


                <img src="../../../../admin/upload/<?php echo $data['foto_promo']; ?>"
                    class="card-img"
                    alt="<?php echo htmlspecialchars($data['nama_promo']); ?>"
                    onerror="this.src='<?php echo $imageerror; ?>'">

                <div class="card-body">
                    <div class="card-title"><?php echo htmlspecialchars($data['nama_promo']); ?></div>
                    <div class="card-mitra">Mitra : <?php echo htmlspecialchars($nama_mitra); ?></div>

                    <div class="point-tags">
                        <?php
                        $qkat = mysql_query("SELECT * FROM data_kategori_member");
                        while ($kat = mysql_fetch_array($qkat)) {
                            $point = baca_database("", "point", "SELECT point FROM data_point_promo WHERE id_kategori_member='{$kat['id_kategori_member']}' AND id_promo='{$data['id_promo']}'");
                            if ($point !== "" && $point !== null) {
                                echo "<span class='point-tag'>{$kat['kategori_member']}: {$point}</span>";
                            }
                        }
                        ?>
                    </div>

                    <div class="card-date">
                        Mulai : <?php echo format_indo($data['tanggal_mulai_berlaku']); ?> <br> Selesai : <?php echo format_indo($data['tanggal_batas_berlaku']); ?>
                    </div>

                    <div class="card-actions">

                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_promo']); ?>"><button type='submit' class='btn btn-warning'><i class='fas fa-pen-to-square'></i> Edit</button></a>
                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_promo']); ?>"
                            onclick="return confirm('Yakin hapus promo ini?')"><button type='submit' class='btn btn-danger'><i class='fas fa-trash-can'></i> Hapus</button></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>



</div>