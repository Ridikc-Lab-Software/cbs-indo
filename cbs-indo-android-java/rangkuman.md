# Rangkuman Project: CBS Indo Android (Petugas CBS)

Dokumen ini merangkum spesifikasi teknologi, struktur direktori, konfigurasi global, serta analisis pola pengembangan CRUD dalam proyek Android Java ini.

---

## Informasi Teknologi Project

*   **Bahasa Pemrograman**: Java (Java Development Kit 1.8)
*   **Build System**: Gradle (Gradle Wrapper)
*   **Minimum SDK**: API 23 (Android 6.0 Marshmallow)
*   **Target & Compile SDK**: API 35 (Android 15)
*   **Networking & HTTP Client**: Retrofit 2, OkHttp 3 (dengan Logging Interceptor), Gson Converter, RxJava 2, RxAndroid
*   **Integrasi Hardware**:
    *   **NFC (Near Field Communication)**: Digunakan untuk pembacaan kartu RFID / Member Card secara langsung.
    *   **Bluetooth**: Digunakan untuk printer struk thermal POS (ESC/POS) menggunakan library `ESCPOS-ThermalPrinter-Android`.
*   **Kamera & Scanner**: Google MLKit Barcode Scanning, CameraX, ZXing Embedded, me.dm7.barcodescanner (ZXing)
*   **Maps & GPS**: Google Play Services Maps & Location
*   **Media & Image Rendering**: Glide, Picasso, Android GIF Drawable

---

## Konfigurasi Global & File Utama

Konfigurasi sistem utama dan parameter global tersimpan pada file-file berikut:

### AndroidManifest.xml
*   **Path**: [app/src/main/AndroidManifest.xml](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/AndroidManifest.xml)
*   **Peran**: File konfigurasi utama Android OS.
*   **Poin Utama**:
    *   Deklarasi permission penting: NFC (membaca kartu RFID), Bluetooth (koneksi printer thermal), ACCESS_FINE_LOCATION (koordinat GPS), dan INTERNET.
    *   Konfigurasi launcher activity (`splashscreen_activity` mengarah ke `login_activity` / `home_activity`).
    *   Registrasi seluruh Activity yang ada di dalam aplikasi.

### config_global.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_global.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_global.java)
*   **Peran**: Menyediakan konstanta dan fungsi utilitas global di tingkat aplikasi.
*   **Poin Utama**:
    *   `BASE_URL`: Endpoint server backend utama (`https://membercard.cbs-indo.com/`).
    *   `checkTokenOlineIsValid`: Validasi token sesi petugas. Mengarahkan otomatis ke login activity jika menerima kode HTTP 401 (Unauthorized).
    *   `generate_id`: Fungsi pembuat ID unik otomatis berbasis tanggal dan generator acak untuk baris data baru.
    *   `show_error_dialog`: Standardisasi dialog kesalahan untuk pesan transaksi atau kedaluwarsa voucher.

### config_sessionmanager.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_sessionmanager.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_sessionmanager.java)
*   **Peran**: Mengelola penyimpanan data sesi lokal menggunakan Shared Preferences.
*   **Poin Utama**:
    *   Menyimpan status autentikasi petugas (`sudahlogin`).
    *   Menyimpan metadata petugas aktif: Nama, Token/Email, ID Pegawai, Jabatan, Nama SPBU, Alamat SPBU, Telepon SPBU, serta alamat MAC address Bluetooth Printer yang terhubung.
    *   `logOut()`: Fungsi untuk menghapus kredensial sesi lokal ketika petugas keluar dari aplikasi.

### config_apiclient.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient.java)
*   **Peran**: Inisialisasi client REST API Retrofit dengan interceptor logging OkHttp.

### config_apiclient_flexible.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient_flexible.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient_flexible.java)
*   **Peran**: Client API dinamis yang memungkinkan perubahan endpoint secara dinamis.

### config_apiclient_voucher.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient_voucher.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/config_apiclient_voucher.java)
*   **Peran**: Client API khusus untuk menangani integrasi E-Voucher.

### devicelist.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/devicelist.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/devicelist.java)
*   **Peran**: Activity pencarian dan penyandingan (pairing) perangkat Bluetooth printer.

### print_transaksi.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/print_transaksi.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/print_transaksi.java)
*   **Peran**: Helper pembentuk layout struk belanja/transaksi berbasis perintah ESC/POS untuk dicetak ke thermal printer.

### UnicodeFormatter.java
*   **Path**: [app/src/main/java/com/project/aplikasi/petugas_cbs/config/UnicodeFormatter.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/config/UnicodeFormatter.java)
*   **Peran**: Konverter karakter unicode agar kompatibel dengan pembacaan printer thermal.

---

## Struktur Direktori Utama

Seluruh source code Java utama terletak di bawah package:
`app/src/main/java/com/project/aplikasi/petugas_cbs/`

### 1. config/
Berisi konfigurasi client API Retrofit, Shared Preferences session manager, pencarian Bluetooth, dan utilitas cetak printer thermal.

### 2. activity/
Berisi logika antarmuka utama non-CRUD, seperti:
*   [login_activity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/login_activity.java) & [LoginQRActivity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/LoginQRActivity.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/activity/`
    *   **Peran**: Logika proses autentikasi petugas (secara manual maupun melalui scan QR).
*   [TransaksiVoucherActivity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/TransaksiVoucherActivity.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/activity/TransaksiVoucherActivity.java`
    *   **Peran**: Alur validasi dan klaim e-voucher yang terbagi dalam fragmen Member, Non-Member, Print, dan Jenis Transaksi.
*   [qrcode_activity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/qrcode_activity.java) & [qrcode_camera.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/qrcode_camera.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/activity/`
    *   **Peran**: Penanganan hardware kamera dan proses scanning QR Code.
*   [lokasianda_activity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/activity/lokasianda_activity.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/activity/lokasianda_activity.java`
    *   **Peran**: Penentuan koordinat lokasi GPS petugas menggunakan Google Maps API.

### 3. home/
*   [home_activity.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/home/home_activity.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/home/home_activity.java`
    *   **Peran**: Activity utama pasca-login. Memiliki mekanisme Foreground Dispatch NFC untuk menangkap event tempel kartu RFID/Member secara real-time.
*   [home_fragment.java](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/src/main/java/com/project/aplikasi/petugas_cbs/home/home_fragment.java)
    *   **Path**: `app/src/main/java/com/project/aplikasi/petugas_cbs/home/home_fragment.java`
    *   **Peran**: Dashboard utama petugas yang menyajikan nama petugas dan nama SPBU tempat bertugas.

### 4. combobox_...
Kumpulan sub-package berisi adapter dan model untuk data spinner (dropdown select input) pada form transaksi yang diisi dinamis dari server API (contoh: `combobox_data_jenis_transaksi`, `combobox_data_petugas`, `combobox_data_voucher`).

### 5. data_... (Modul Fitur Utama)
Modul-modul ini menangani pengolahan data CRUD secara online dengan server backend menggunakan Retrofit. Masing-masing modul biasanya memiliki:
*   `..._activity.java`: Menampilkan daftar data menggunakan `RecyclerView`.
*   `..._tambah.java` / `..._tambah_v2.java`: Halaman input form data baru.
*   `..._edit.java`: Halaman edit/perbarui data.
*   `..._adapter.java`: Adapter untuk menghubungkan list data ke UI `RecyclerView`.
*   `..._apiservice.java` / `..._api.java`: Interface endpoint REST API.

**Daftar Modul Fitur Utama:**
*   `data_member`: Pendaftaran dan pengelolaan data anggota/kartu member (termasuk print thermal).
*   `data_transaksi`: Transaksi point / pengisian bahan bakar oleh member (termasuk cetak struk).
*   `data_redeem`: Penukaran poin member dengan hadiah/promo tertentu (termasuk cetak struk penukaran).
*   `data_penjualan_voucher` & `data_voucher`: Transaksi dan penjualan e-voucher fisik maupun elektronik.
*   `data_mitra`: Data mitra kerja sama SPBU/CBS.
*   `data_petugas`: Pengelolaan data akun petugas/pegawai.
*   `data_plat`: Identifikasi dan manajemen nomor plat kendaraan terdaftar.
*   `data_spbu`: Informasi lokasi dan profil SPBU.
*   `data_berita` & `data_event`: Informasi pengumuman, berita, atau event aktif di lingkungan SPBU/CBS.
*   `data_galery`: Galeri foto dokumentasi.

---

## File Konfigurasi Project Gradle

### build.gradle (Project)
*   **Path**: [build.gradle](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/build.gradle)
*   **Peran**: Konfigurasi repositori buildscript global dan versi Gradle Build Tools (`classpath 'com.android.tools.build:gradle:8.6.1'`).

### build.gradle (Module: app)
*   **Path**: [app/build.gradle](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/app/build.gradle)
*   **Peran**: Konfigurasi modul aplikasi, versi target SDK (Target SDK 35, Min SDK 23), serta dependensi library penting:
    *   **Networking**: Retrofit 2, OkHttp 3, RxJava & RxAndroid.
    *   **QR Scanner**: ZXing Embedded & BarcodeScanner ZXing.
    *   **Printer**: ESCPOS-ThermalPrinter-Android.
    *   **Maps & GPS**: Play Services Location & Maps.
    *   **Image & UI Loader**: Picasso, Glide, Android GIF Drawable.
    *   **Camera & Barcode ML Kit**: CameraX & MLKit Barcode Scanning.

### gradle.properties
*   **Path**: [gradle.properties](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/gradle.properties)
*   **Peran**: Pengaturan memori JVM untuk kompilasi dan pengaktifan AndroidX (`android.useAndroidX=true`).

### local.properties
*   **Path**: [local.properties](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/local.properties)
*   **Peran**: Path lokal direktori Android SDK pada komputer pengembang.

### settings.gradle
*   **Path**: [settings.gradle](file:///Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-android-java/settings.gradle)
*   **Peran**: Mendaftarkan nama modul aplikasi (`include ':app'`).
