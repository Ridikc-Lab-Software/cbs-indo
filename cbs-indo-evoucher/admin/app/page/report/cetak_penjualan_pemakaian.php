<?php
$date = new DateTime();
$start_date_of_month = date('Y-m-01', strtotime($date->format('Y-m-d')));
$end_date_of_month   = date('Y-m-t',  strtotime($date->format('Y-m-d')));
?>
<form name="formcari" id="formcari" action="../report/cetak_detail_penjualan_pemakaian.php" method="get">
    <fieldset>
        <table>
            <tbody>

                <input type="hidden" name="Berdasarkan" value="tanggal">

                <tr>
                    <td style="width:40%">Dari (Tanggal) :</td>
                    <td>
                        <input type="date" name="tanggal1" class="form-control" value="<?= $start_date_of_month ?>">
                    </td>
                </tr>

                <tr>
                    <td style="width:40%">Sampai (Tanggal) :</td>
                    <td>
                        <input type="date" name="tanggal2" class="form-control mt-2" value="<?= $end_date_of_month ?>">
                    </td>
                </tr>

                <tr>
                    <td style="width:40%">Relasi :</td>
                    <td>
                        <select class="form-control selectpicker mt-2" data-live-search="true" name="relasi" id="relasi">
                            <option value="">Semua</option>
                            <?php
                            $relasis = QB::table('data_relasi')->get();
                            foreach ($relasis as $r) {
                                echo '<option value="' . $r->id_relasi . '">' . $r->nama . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="pt-4">
                        <button class="btn btn-info btn-block" name="preview">
                            <i class="fa fa-info"></i> Print Preview
                        </button>
                        <button class="btn btn-danger btn-block mt-2" name="export">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>
