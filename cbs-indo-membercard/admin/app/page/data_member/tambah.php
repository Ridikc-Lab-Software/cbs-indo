<form action="proses_simpan.php" enctype="multipart/form-data" id='forms' method="post">
    <div class="content-box-content">
        <div id="postcustom">
            <style>
                /* ====================== GRID 2 KOLOM YANG RATA KANAN-KIRI ====================== */
                .row {
                    display: flex;
                    gap: 0px;
                    /* jarak antar kolom */
                }

                .col-6 {
                    flex: 1;
                    /* kanan & kiri selalu sama lebar */
                    max-width: 50%;
                    /* menjaga tetap 2 kolom */
                    display: flex;
                    flex-direction: column;
                }

                /* ====================== PERAPIAN BOX ====================== */
                .content-widgets.gray {
                    background: #ffffff;
                    border-radius: 12px;
                    padding: 18px 20px;
                    border: 1px solid #e5e7eb;
                    box-shadow: 0 18px 23px rgba(5, 0, 0, 0.05);
                    height: 100%;
                    margin: 16px;

                    /* agar tinggi kanan dan kiri sama */
                }

                /* ====================== PERAPIAN TABEL DI DALAM ====================== */
                .widget-container table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .widget-container table tr {
                    vertical-align: top;
                }

                /* Label kiri */
                .leftrowcms {
                    font-weight: 600;
                    font-size: 0.82rem;
                    color: #475569;
                    padding: 6px 0;
                    white-space: nowrap;
                    width: 32%;
                    /* agar label rata kiri */
                }

                /* Titik dua */
                .widget-container table td:nth-child(2) {
                    width: 12px;
                    text-align: center;
                    font-weight: bold;
                    color: #374151;
                }

                /* Kolom input */
                .widget-container table td:nth-child(3) {
                    padding: 4px 0 12px;
                    width: 68%;
                }

                /* Input biar full */
                .widget-container table input.form-control,
                .widget-container table select.form-control,
                .widget-container table textarea.form-control {
                    width: 100%;
                }

                /* ========== RESPONSIVE UNTUK HP ========== */
                @media(max-width: 768px) {
                    .row {
                        flex-direction: column;
                    }

                    .col-6 {
                        max-width: 100%;
                    }
                }
            </style>

            <div class="card-group-title">
                <div class="title-left">
                    <img src="../../../data/tmp/membercard/files/icon/register.png"
                        width="40px">

                    <p>
                        Pendaftaran Member

                    </p>
                </div>
            </div>

            <div class="row">


                <div class="col-6">
                    <div class="content-widgets gray">

                        <div class="widget-container">

                            <table <?php tabel_in(100, '%', 0, 'center'); ?>>


                                <input class='form-control' type="hidden" name="nik" id="nik" placeholder="Nik">
                                <input type="hidden" readonly
                                    value="<?php echo id_otomatis("data_member", "id_member", "10"); ?>"
                                    name="id_member" placeholder="id_member" id="id_member">
                                <input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="hidden"
                                    name="tanggal_terdaftar" id="tanggal_terdaftar"
                                    placeholder="Tanggal&nbsp;Terdaftar">
                                <input type="hidden" class='form-control' name="status_perkawinan">

                                <input class='form-control' type="hidden" value="0" name="point" id="point" placeholder="Point">



                                <tbody>

                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Nama <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>
                                            <input onkeypress='return h(event)' class='form-control' type="text" onkeyup="this.value = this.value.toUpperCase()" name="nama" id="nama"
                                                placeholder="Nama" required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Alamat <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>
                                            <textarea class='form-control' type="text" onkeyup="this.value = this.value.toUpperCase()" name="alamat" id="alamat" placeholder="Alamat" required="required"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>No&nbsp;Telepon <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>
                                            <input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon"
                                                id="no_telepon" placeholder="No&nbsp;Telepon" required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Jenis&nbsp;Kelamin <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>

                                            <select class='form-control' data-live-search='true' type="enum"
                                                name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis&nbsp;Kelamin"
                                                required="required">
                                                <option></option><?php combo_enum('data_member', 'jenis_kelamin', ''); ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Tanggal&nbsp;Lahir <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>
                                            <input class='form-control' type="date"
                                                name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal&nbsp;Lahir">


                                        </td>
                                    </tr>




                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Pekerjaan <span class="highlight"></span></label>
                                        </td>
                                        <td width="10px">:</td>
                                        <td>
                                            <select class='form-control' name="pekerjaan" id="pekerjaan">
                                                <option>ASN</option>
                                                <option>Wiraswasta</option>

                                                <option>Karyawan Swasta</option>
                                            </select>
                                        </td>
                                    </tr>



                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="content-widgets gray">

                        <div class="widget-container">

                            <table <?php tabel_in(100, '%', 0, 'center'); ?>>




                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Agama <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>
                                        <select class='form-control' name="agama">
                                            <?php
                                            combo_enum('data_member', 'agama', '')
                                            ?>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Kategori&nbsp;Member <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>

                                        <select class='form-control' data-live-search='true' type="text"
                                            name="id_kategori_member" id="id_kategori_member"
                                            placeholder="Id&nbsp;Kategori&nbsp;Member" required="required">
                                            <option></option><?php combo_database_v2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Kode&nbsp;Rfid <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>
                                        <input class='form-control' type="text" name="kode_rfid" id="kode_rfid"
                                            placeholder="Kode&nbsp;Rfid" required="required">


                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Username <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>
                                        <input class='form-control' onkeyup="this.value = this.value.toUpperCase()" type="text" name="username" id="username" placeholder="Username">


                                    </td>
                                </tr>



                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Password <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>
                                        <input class='form-control' type="" name="password" id="password"
                                            placeholder="Password" required="required">

                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>SPBU <span class="highlight"></span></label>
                                    </td>
                                    <td width="10px">:</td>
                                    <td>
                                        <select class="form-control" name="spbu" id="spbu" required>
                                            <option></option>
                                            <?php combo_database("data_spbu", "nama_spbu", ""); ?>
                                        </select>


                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">

                                    </td>
                                    <td width="10px"></td>
                                    <td>
                                        
                                    <?php btn_simpan('PROSES PENDAFTARAN')?>


                                    </td>
                                </tr>


                                <?php $jenenge = decrypt($_COOKIE['jenenge']) ?>
                                <input type="hidden" name="id_admin" value="<?= baca_database('data_admin', 'id_admin', "select id_admin from data_admin where username='$jenenge'"); ?>">

                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</form>


<!-- Tambahkan SweetAlert -->
<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi generate password 6 digit (sudah bagus)
    function generateRandomPassword() {
        return Math.floor(100000 + Math.random() * 900000);
    }

    const noTelpInput = document.getElementById('no_telepon');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    noTelpInput.addEventListener('input', function() {
        if (!usernameInput.dataset.manual) {
            usernameInput.value = this.value;
        }

        if (this.value.length > 0 && passwordInput.value.trim() === "") {
            passwordInput.value = generateRandomPassword();
        }
    });

    usernameInput.addEventListener('input', function() {
        this.dataset.manual = true;
    });

    // === VALIDASI TANGGAL LAHIR DENGAN SWEETALERT ===
    const form = document.getElementById('forms');




    form.addEventListener('submit', function(e) {
        const tanggalLahir = document.getElementById('tanggal_lahir').value;

        if (!tanggalLahir) {
            e.preventDefault(); // hentikan submit dulu

            Swal.fire({
                title: 'Tanggal lahir belum diisi!',
                text: "Apakah Anda ingin mengisi tanggal lahir?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, isi sekarang',
                cancelButtonText: 'Tidak, kosongkan',
                // 🔐 kunci popup
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }).then((result) => {
                 if (result.isConfirmed) {
                    // User mau isi → fokus ke input
                    document.getElementById('tanggal_lahir').focus();

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User sadar & memilih "Tidak, kosongkan"
                    form.submit();
                }
                else
                {
                    document.getElementById('tanggal_lahir').focus();
                }
            });
        }
    });


</script>