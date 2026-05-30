<form name="formcari" id="formcari" action="../data_relasi/cetak.php" method="get" >
    <fieldset>
        <table>
            <tbody>

                <input type="hidden" name="Berdasarkan" value="tanggal_daftar">

                <?php
                $date = new DateTime();

                $start_date_of_month = date('Y-m-01', strtotime($date->format('Y-m-d')));
                $end_date_of_month = date('Y-m-t', strtotime($date->format('Y-m-d')));
                ?>

                <tr>
                    <td style="width:40%">Dari (Tanggal Daftar) :</td>
                    <td><input type="date" name="tanggal1" class="form-control" value="<?= $start_date_of_month; ?>">
                    </td>
                </tr>

                <tr>
                    <td style="width:40%">Sampai (Tanggal Daftar) :</td>
                    <td><input type="date" name="tanggal2" class="form-control mt-2" value="<?= $end_date_of_month; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="pt-4">
                        <button class="btn btn-info btn-block" name="preview"><i class="fa fa-info"></i> Print
                            Preview</button>
                        <button class="btn btn-warning btn-block" name="cetak"><i class="fa fa-print"></i>
                            Print</button> <button class="btn btn-danger btn-block" name="export"><i
                                class="fa fa-file-excel-o"></i> Export
                            Excel</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>
