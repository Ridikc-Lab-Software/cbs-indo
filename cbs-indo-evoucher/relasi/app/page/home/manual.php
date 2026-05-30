<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body p-0">
                <!--begin::Wrapper-->
                <div class="card-px text-center py-12 my-3">
                    <center>

                        <?php
                        if (isset($_GET['qrcode'])) {
                            $proses = ($_GET['qrcode']);
                            $sql = mysql_query("SELECT * FROM data_voucher where qrcode = '$proses'");
                        } else {
                            $proses = (mysql_real_escape_string($_GET['proses']));
                            $proses = str_replace("ID", "", $proses);
                            $sql = mysql_query("SELECT * FROM data_voucher where id_voucher = '$proses'");
                        }


                        $data = mysql_fetch_array($sql);
                        $id_voucher = $data['id_voucher'];
                        $status = $data['status'];
                        if ($data['qrcode'] == "") {
                        ?>
                            <script>
                                alert("E-Voucher tidak valid");
                                window.location.href = "../home/index.php"
                            </script>
                        <?php
                        }

                        if ($status == "Used") {
                        ?>
                            <script>
                                alert("E-Voucher sudah digunakan, tidak dapat digunakan kembali");
                                window.location.href = "../home/index.php"
                            </script>
                        <?php
                        }
                        ?>


                        <h2 class="fs-2x fw-bolder mb-6">Transaksi Voucher </h2>


                    </center>

                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <div class="content-box">
                                <style>
                                    .text-center {
                                        text-align: left !important;
                                    }
                                </style>


                                <div class="content-box-content">
                                    <form action="manual_selesai.php" enctype="multipart/form-data" method="POST">
                                        <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                                            <tbody>
                                                <tr>
                                                    <td class="clleft" width="25%">ID Voucher </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo $data['id_voucher']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="clleft" width="25%">Nama Relasi </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="clleft" width="25%">Nominal </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo rupiah($data['nominal']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="clleft" width="25%">Tanggal Dibuka </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo $data['tanggal_dibuka']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="clleft" width="25%">Tanggal Kadaluarsa </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo $data['tanggal_kadaluarsa']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="clleft" width="25%">Nama Spbu </td>
                                                    <td class="clleft" width="2%">:</td>
                                                    <td class="clleft"><?php echo baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'")  ?></td>
                                                </tr>

                                                <!-- <tr>
                                                <td class="clleft" width="25%">Status </td>
                                                <td class="clleft" width="2%">:</td>
                                                <td class="clleft"><?php echo $data['status']; ?></td>
                                            </tr> -->

                                                <input value="<?php echo ($data['id_voucher']); ?>" class="form-control" style="width:50%" type="hidden" name="id_voucher" id="id_voucher" placeholder="Id Voucher " required="required">
                                                <input value="<?php echo ($data['nominal']); ?>" class="form-control" style="width:50%" type="hidden" name="nominal" id="nominal" placeholder="Nominal " required="required">

                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

                                                <tr>
                                                    <td width="25%" class="leftrowcms">
                                                        <label>Member <span class="highlight"></span></label>
                                                    </td>
                                                    <td width="2%">:</td>
                                                    <td>
                                                        <select class="form-control" style="width:50%" type="text" name="id_member" id="id_member" placeholder="Id Member ">
                                                            <option></option>
                                                            <!-- <option value="non member">Non Member</option> -->
                                                            <?php combo_database2x('data_member', 'id_member', 'nama', ''); ?>
                                                        </select>
                                                    </td>
                                                </tr>




                                                <script>
                                                    $(document).ready(function() {
                                                        $('#id_member').select2({
                                                            placeholder: 'Select a member', // Optional placeholder
                                                            allowClear: true // Optional: allows clearing the selection
                                                        });
                                                    });
                                                </script>


                                                <input class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" style="width:50%" type="hidden" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi " required="required">

                                                <tr>
                                                    <td width="25%" class="leftrowcms">
                                                        <label>Jenis BBM <span class="highlight"></span></label>
                                                    </td>
                                                    <td width="2%">:</td>
                                                    <td>
                                                        <select class="form-control" style="width:50%" type="varchar" name="jenis_bbm" id="jenis_bbm" placeholder="Jenis Bbm " required="required">
                                                            <option></option><?php combo_database_v2('data_jenis_transaksi', 'jenis_transaksi', 'jenis_transaksi', ''); ?>
                                                        </select>
                                                    </td>
                                                </tr>







                                            </tbody>
                                        </table>
                                </div>


                            </div>
                        </div>
                    </div>
                    </p>
                    <center>
                        <button class="btn btn-primary">PROSES TRANSAKSI</button>
                    </center>
                    </form>
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="assets/media/illustrations/sigma-1/2.png">
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
    <!--end::Container-->
</div>