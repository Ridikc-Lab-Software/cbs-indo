<form name="formcari" id="formcari" action="../data_transaksi_voucher/cetak.php" method="get">
<fieldset>
<table>
<tbody>

<input type="hidden" name="Berdasarkan" value="tanggal_transaksi">

<?php
$start_date_of_month = date('Y-m-01');
$end_date_of_month   = date('Y-m-t');
?>

<tr>
    <td style="width:40%">Dari (Tanggal Transaksi)</td>
    <td>
        <input type="date" name="tanggal1" class="form-control" value="<?= $start_date_of_month ?>">
    </td>
</tr>

<tr>
    <td style="width:40%">Sampai (Tanggal Transaksi)</td>
    <td>
        <input type="date" name="tanggal2" class="form-control mt-2" value="<?= $end_date_of_month ?>">
    </td>
</tr>

<tr>
    <td style="width:40%">Jenis BBM</td>
    <td>
        <select class="form-control selectpicker mt-2" data-live-search="true" name="jenis_bbm">
            <option value="">Semua</option>
            <?php
            $jenis = QB::table("data_jenis_transaksi")->get();
            foreach ($jenis as $j) {
                echo '<option value="'.$j->id_jenis_transaksi.'">'.$j->jenis_transaksi.'</option>';
            }
            ?>
        </select>
    </td>
</tr>

<tr>
    <td style="width:40%">Nominal</td>
    <td>
        <select class="form-control selectpicker mt-2" data-live-search="true" name="nominal">
            <option value="">Semua</option>
            <?php
            $q = mysql_query("SELECT * FROM data_nominal");
            while ($d = mysql_fetch_array($q)) {
                echo '<option value="'.$d['nominal'].'">'.rupiah($d['nominal']).'</option>';
            }
            ?>
        </select>
    </td>
</tr>

<!-- RELASI -->
<tr>
    <td style="width:40%">Relasi</td>
    <td>
        <select class="form-control selectpicker mt-2"
        data-live-search="true"
        name="relasi"
        id="relasi"
        onchange="loadSupirPlat(this.value)">

            <option value="">Semua</option>
            <?php
            $relasi = QB::table("data_relasi")->get();
            foreach ($relasi as $r) {
                echo '<option value="'.$r->id_relasi.'">'.$r->nama.'</option>';
            }
            ?>
        </select>
    </td>
</tr>

<!-- SUPIR -->
 
<tr>
    <td style="width:40%">Nama Supir</td>
    <td>
        <select class="form-control selectpicker mt-2"
                data-live-search="true"
                name="id_supir"
                id="id_supir">
            <option value="">Semua</option>
        </select>
    </td>
</tr>

<!-- PLAT -->
<tr>
    <td style="width:40%">Plat Kendaraan</td>
    <td>
        <select class="form-control selectpicker mt-2"
                data-live-search="true"
                name="no_plat_kendaraan"
                id="no_plat_kendaraan">
            <option value="">Semua</option>
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

<br>
        Silahkan pilih relasi terlebih dahulu untuk <br>dapat memilih nama supir dan plat kendaraan.


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
function loadSupirPlat(id_relasi) {

    if (id_relasi === "") {
        $('#id_supir').html('<option value="">Silahkan pilih relasi terlebih dahulu</option>');
        $('#no_plat_kendaraan').html('<option value="">Silahkan pilih relasi terlebih dahulu</option>');

        $('#id_supir').selectpicker('refresh');
        $('#no_plat_kendaraan').selectpicker('refresh');
        return;
    }

    $.ajax({
        url: "ajax_relasi.php",
        type: "GET",
        dataType: "json",
        data: { id_relasi: id_relasi },
        success: function(res) {

            /* ================= SUPIR ================= */
            $('#id_supir').empty();
            $('#id_supir').append('<option value="">Pilih Supir</option>');
            $('#id_supir').append('<option value="">Semua</option>');

            $.each(res.supir, function(i, s) {
                $('#id_supir').append(
                    '<option value="'+s.id_supir+'">'+s.nama_supir+'</option>'
                );
            });

            

            /* ================= PLAT ================= */
            $('#no_plat_kendaraan').empty();
            $('#no_plat_kendaraan').append('<option value="">Pilih Plat Kendaraan</option>');
            $('#no_plat_kendaraan').append('<option value="">Semua</option>');

            $.each(res.plat, function(i, p) {
                $('#no_plat_kendaraan').append(
                    '<option value="'+p.plat+'">'+p.plat+'</option>'
                );
            });

            $('#no_plat_kendaraan').selectpicker('refresh');
            $('#id_supir').selectpicker('refresh');
        }
    });
}
</script>
