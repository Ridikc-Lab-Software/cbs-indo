 
<form name="formcari" id="formcari" action="../data_transaksi_voucher/cetak.php" method="get" >
    <fieldset>
        <table>
            <tbody>
                <!-- <tr>
                    <td colspan="2"><b>CETAK PERPERIODE</b></td>
                </tr> -->
                <!-- <tr>
                    <td style="width:40%">Berdasarkan :</td>
                    <td>
                        <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan"
                            id="Berdasarkan">
                            <option name="berdasarkan" value="tanggal_penjualan">tanggal_penjualan</option>
                            <option name="berdasarkan" value="tanggal_dibuka">tanggal_dibuka</option>
                            <option name="berdasarkan" value="tanggal_kadaluarsa">tanggal_kadaluarsa</option>
                        </select>
                    </td>
                </tr> -->

                <input type="hidden" name="Berdasarkan" value="tanggal_transaksi">

                <?php
                $date = new DateTime();

                $start_date_of_month = date('Y-m-01', strtotime($date->format('Y-m-d')));
                $end_date_of_month = date('Y-m-t', strtotime($date->format('Y-m-d')));
                ?>

                <tr>
                    <td style="width:40%">Dari (Tanggal Transaksi) :</td>
                    <td><input type="date" name="tanggal1" class="form-control" value="<?= $start_date_of_month; ?>">
                    </td>
                </tr>

                <tr>
                    <td style="width:40%">Sampai (Tanggal Transaksi) :</td>
                    <td><input type="date" name="tanggal2" class="form-control mt-2" value="<?= $end_date_of_month; ?>">
                    </td>
                </tr>


                <tr>
                    <td style="width:40%">Jenis BBM :</td>
                    <td>
                        <select class="form-control selectpicker mt-2" data-live-search="true" name="jenis_bbm"
                            id="jenis_bbm">
                            <option value="">Semua</option>
                            <?php
                           
                            combo_database_v2("data_jenis_transaksi", "jenis_transaksi", "jenis_transaksi","");
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="width:40%">Nominal :</td>
                    <td>
                        <select class="form-control selectpicker mt-2" data-live-search="true" name="nominal"
                            id="nominal">
                            <option value="">Semua</option>
                          <?php
                $querytabel_nomonal = "SELECT * FROM data_nominal ";
                $proses_nomonal = mysql_query($querytabel_nomonal);
                while ($data_nomonal = mysql_fetch_array($proses_nomonal)) { ?>
            <option value="<?php echo $data_nomonal['nominal'];?>"><?php echo rupiah($data_nomonal['nominal']);?></option>
                <?php } ?>
                        </select>
                    </td>
                </tr>


               
                      <input type="hidden" value="<?php echo decrypt($_COOKIE['kodene']);?>" class="form-control selectpicker mt-2" data-live-search="true" name="relasi"
                            id="relasi">
                            

                <tr>
                    <td style="width:40%">Shift :</td>
                    <td>
                        <select class="form-control selectpicker mt-2" data-live-search="true" name="shift"
                            id="shift">
                            <option value=""> Semua </option>
                            <?php
                            $shifts = QB::table('data_shift')->get();
                            foreach ($shifts as $shift) {
                                echo '<option value="' . $shift->id_shift . '">' . $shift->shift . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>


                <tr>
    <td style="width:40%">Nama Supir :</td>
    <td>
        <select class="form-control selectpicker mt-2" data-live-search="true" name="id_supir" id="id_supir">
            <option value="">Semua</option>
            <?php
            $id_relasi = decrypt($_COOKIE['kodene']);
            $q_supir = mysql_query("
                SELECT id_supir, nama_supir 
                FROM data_supir 
                WHERE id_relasi='$id_relasi'
                ORDER BY nama_supir ASC
            ");
            while ($supir = mysql_fetch_array($q_supir)) {
                echo '<option value="'.$supir['id_supir'].'">'.$supir['nama_supir'].'</option>';
            }
            ?>
        </select>
    </td>
</tr>


<tr>
    <td style="width:40%">Plat Kendaraan :</td>
    <td>
        <select class="form-control selectpicker mt-2" data-live-search="true" name="no_plat_kendaraan" id="no_plat_kendaraan">
            <option value="">Semua</option>
            <?php
            $id_relasi = decrypt($_COOKIE['kodene']);
            $q_plat = mysql_query("
                SELECT id_plat, plat 
                FROM data_plat 
                WHERE id_relasi='$id_relasi'
                ORDER BY plat ASC
            ");
            while ($plat = mysql_fetch_array($q_plat)) {
                echo '<option value="'.$plat['id_plat'].'">'.$plat['plat'].'</option>';
            }
            ?>
        </select>
    </td>
</tr>




                <tr>
                    <td colspan="2" class="pt-4">
                        <button class="btn btn-info btn-block" name="preview"><i class="fa fa-info"></i> Print
                            Preview</button>
                        <!-- <button class="btn btn-warning btn-block"  name="cetak"><i class="fa fa-print"></i>
                            Print</button>  -->
                            <button class="btn btn-danger btn-block" name="export"><i
                                class="fa fa-file-excel-o"></i> Export
                            Excel</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
   
   
</form>