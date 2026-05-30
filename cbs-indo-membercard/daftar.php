<!-- Load Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    /* Card container */
    .card {
        max-width: 900px;
        margin: 30px auto;
        background-color: #ffffff;
        border: 1px solid #ffffff !important;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 30px 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card h3 {
        text-align: center;
        margin-bottom: 20px;

    }

    .login-link {
        text-align: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .login-link a {
        color: #4A90E2;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .form-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 250px;
        margin-bottom: 18px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #555;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 12px 10px 36px;
        /* padding left untuk icon */
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #4A90E2;
        box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        outline: none;
    }

    .form-group i {
        position: absolute;
        left: 10px;
        top: 43px;
        color: #888;
        font-size: 19px;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #4A90E2;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background-color: #357ABD;
    }

    /* Responsive untuk mobile */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
        }

        .form-group i {
            top: 36px;
        }
    }
</style>

<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
    <div class="card">
        <h3>Pendaftaran Member Baru</h3>
        <div class="login-link">
            Silahkan login jika sudah memiliki akun <a style="color: #1acc8d" href="index.php?p=login">Login disini</a>
        </div>

        <!-- Hidden fields -->
        <input type="hidden" name="id_member" value="<?php echo id_otomatis("data_member", "id_member", "10"); ?>">
        <input type="hidden" name="tanggal_terdaftar" value="<?php echo tanggal_otomatis(); ?>">
        <input type="hidden" name="kode_rfid" value="">
        <input type="hidden" name="point" value="">
        <!-- <?php $jenenge = decrypt($_COOKIE['jenenge']); ?>
        <input type="hidden" name="id_admin" value="<?= baca_database('data_admin', 'id_admin', "select id_admin from data_admin where username='$jenenge'"); ?>"> -->
        <input type="hidden" name="status_perkawinan" id="status_perkawinan">
        <input type="hidden" name="nik" id="nik" placeholder="NIK">

        <div class="form-row">
            <div class="form-group">
                <label for="nama">Nama</label>
                <i class="fas fa-user"></i>
                <input onkeypress='return h(event)' onkeyup="this.value = this.value.toUpperCase()" type="text" name="nama" id="nama" placeholder="Nama" required>
            </div>




            <div class="form-group">
                <label for="alamat">Alamat</label>
                <i class="fas fa-home"></i>
                <input onkeyup="this.value = this.value.toUpperCase()" type="text" name="alamat" id="alamat" placeholder="Alamat" required>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <i class="fas fa-phone"></i>
                <input onkeypress='return a(event)' type="text" name="no_telepon" id="no_telepon" placeholder="No Telepon" required>
            </div>


            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <i class="fas fa-venus-mars"></i>
                <select class="selectpicker" data-live-search="true" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option></option>
                    <?php combo_enum('data_member', 'jenis_kelamin', ''); ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <i class="fas fa-calendar-alt"></i>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir">
            </div>


            <div class="form-group">
                <label for="agama">Agama</label>
                <i class="fas fa-praying-hands"></i>
                <select name="agama" id="agama">
                    <option></option>
                    <?php combo_enum('data_member', 'agama', ''); ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="id_kategori_member">Kategori Member</label>
                <i class="fas fa-tags"></i>
                <select class="selectpicker" data-live-search="true" name="id_kategori_member" id="id_kategori_member" required>
                    <option></option>
                    <?php combo_database_v2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
                </select>
            </div>



            <div class="form-group">
                <label for="id_pekerjaan">Pekerjaan</label>
                <i class="fas fa-briefcase"></i>
                <select name="id_pekerjaan" id="pekerjaan">
                    <option></option>
                    <?php combo_database("data_pekerjaan", "nama", ""); ?>
                </select>
            </div>


        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="username">Username</label>
                <i class="fas fa-user-circle"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <i class="fas fa-lock"></i>
                <input type="text" name="password" id="password" placeholder="Password" required>
            </div>
        </div>


        <div class="form-group">
            <label for="spbu">SPBU</label>
            <i class="fas fa-gas-pump"></i>
            <select name="spbu" id="spbu" required>
                <option></option>
                <?php combo_database("data_spbu", "nama_spbu", ""); ?>
            </select>
        </div>


        <button type="submit" class="btn-submit">PROSES PENDAFTARAN</button>
    </div>
</form>


<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi buat generate password 6 digit
    function generateRandomPassword() {
        return Math.floor(100000 + Math.random() * 900000); // 6 digit
    }

    const noTelpInput = document.getElementById('no_telepon');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    noTelpInput.addEventListener('input', function() {
        // 1. Username otomatis dari no telepon jika belum diedit manual
        if (!usernameInput.dataset.manual) {
            usernameInput.value = this.value;
        }

        // 2. Password random otomatis muncul jika no telepon diisi
        if (this.value.length > 0 && passwordInput.value.trim() === "") {
            passwordInput.value = generateRandomPassword();
        }
    });

    usernameInput.addEventListener('input', function() {
        // Tandai jika user edit username manual
        this.dataset.manual = true;
    });

    // Validasi tanggal lahir pakai SweetAlert saat submit
    const form = document.querySelector('form');

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