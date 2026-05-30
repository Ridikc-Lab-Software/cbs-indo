<div class="row gy-5 g-xl-8">


    <div class="col-xxl-12">

        <div class="card card-xxl-stretch mb-5 mb-xl-12">

            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="https://t3.ftcdn.net/jpg/01/75/45/72/360_F_175457216_HsANfhbGCfBAvxUtiOoz55hzVaGi2Sk9.jpg" alt="image">
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                        </div>
                    </div>
                    <span class="text-muted mt-1 fw-bold fs-7">Infomasi Transaksi Penjualan</span>
                </h3>


                <div class="card-body py-3">
                    <div class="table-responsive">
                        <div class="content-box">
                            <div class="content-box-content">
                                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                                    <tbody>
                                        <?php
                                        if (!isset($_GET['proses'])) {
                                                
                                        ?>
                                            <script>
                                                alert("AKSES DITOLAK");
                                                location.href = "index.php";
                                            </script>
                                        <?php
                                            die();
                                        }
                                        $proses = decrypt(mysql_real_escape_string($_GET['proses']));
                                        $sql = mysql_query("SELECT * FROM data_penjualan_voucher where id_penjualan = '$proses'");
                                        $data = mysql_fetch_array($sql);
                                        ?>
                                        <tr>
                                            <td class="clleft" width="25%">Nama </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Tanggal Penjualan </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo $data['tanggal_penjualan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Jumlah Voucher </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo $data['jumlah_voucher']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Nominal </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo rupiah($data['nominal']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Password Voucher </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo $data['password_voucher']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Tanggal Dibuka </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo format_indo_no_jam($data['tanggal_dibuka']); ?></td>
                                        </tr>

                                        <tr>
                                            <td class="clleft" width="25%">Tanggal Kadaluarsa </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo format_indo_no_jam($data['tanggal_kadaluarsa']); ?></td>
                                        </tr>

                                        <tr>
                                            <td class="clleft" width="25%">SPBU </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo $nama_spbu = baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'");; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Sub Total </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo rupiah($data['sub_total']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Persentase Ppn </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo ($data['persentase_ppn']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Ppn </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo rupiah($data['ppn']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="clleft" width="25%">Total Bayar </td>
                                            <td class="clleft" width="2%">:</td>
                                            <td class="clleft"><?php echo rupiah($data['total_bayar']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>