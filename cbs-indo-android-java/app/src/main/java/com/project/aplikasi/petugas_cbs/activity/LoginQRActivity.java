package com.project.aplikasi.petugas_cbs.activity;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.zxing.ResultPoint;
import com.journeyapps.barcodescanner.BarcodeCallback;
import com.journeyapps.barcodescanner.BarcodeResult;
import com.journeyapps.barcodescanner.BarcodeView;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.home.home_activity;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginQRActivity extends AppCompatActivity {

    private static final String TAG = "API_DEBUGGGGG"; // Tag untuk LogCat
    private static final int CAMERA_PERMISSION_REQUEST = 100;

    // UI Components
    private BarcodeView barcodeScanner;
    private ProgressBar loginProgress;
    private TextView scanStatus;
    private Button btnScan;
    private Button btnBatal;
    private TextView loginNormalText;

    // Data Variables
    private String idPetugas = "";
    private boolean isScanning = false;

    login_apiservice mAPIService;
    config_sessionmanager config_sessionmanager;
    loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_login_qractivity);

        // Initialize Views
        initializeViews();

        // Setup Window Insets
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.halamanloginqr), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        mAPIService = login_apiutils.getAPIService();
        config_sessionmanager = new config_sessionmanager(this);
        config_sessionmanager.logOut();
        loading = new loading(this);

        // Setup Click Listeners
        setupClickListeners();

        // Request Camera Permission
        checkCameraPermission();
    }

    private void initializeViews() {
        barcodeScanner = findViewById(R.id.barcode_scanner);
        loginProgress = findViewById(R.id.login_progress);
        scanStatus = findViewById(R.id.scan_status);
        btnScan = findViewById(R.id.btn_scan);
        btnBatal = findViewById(R.id.btn_batal);
        loginNormalText = findViewById(R.id.login_normal_text);
    }

    private void setupClickListeners() {
        btnScan.setOnClickListener(v -> startScan(v));
        btnBatal.setOnClickListener(v -> batal(v));

        loginNormalText.setOnClickListener(v -> {
            // Kembali ke login normal
            finish();
        });
    }

    private void checkCameraPermission() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.CAMERA},
                    CAMERA_PERMISSION_REQUEST);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions,
                                           @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);

        if (requestCode == CAMERA_PERMISSION_REQUEST) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Log.d(TAG, "Izin kamera diberikan.");
                Toast.makeText(this, "Izin kamera diberikan", Toast.LENGTH_SHORT).show();
            } else {
                Log.e(TAG, "Izin kamera ditolak oleh pengguna.");
                Toast.makeText(this, "Izin kamera diperlukan untuk scan QR Code",
                        Toast.LENGTH_LONG).show();
                finish();
            }
        }
    }

    public void startScan(View view) {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA)
                != PackageManager.PERMISSION_GRANTED) {
            Log.w(TAG, "Izin kamera belum diberikan. Meminta izin...");
            Toast.makeText(this, "Izin kamera diperlukan", Toast.LENGTH_SHORT).show();
            checkCameraPermission();
            return;
        }

        if (!isScanning) {
            Log.d(TAG, "Memulai pemindaian QR Code...");
            isScanning = true;
            btnScan.setEnabled(false);
            scanStatus.setText("Sedang memindai QR Code...");

            barcodeScanner.decodeContinuous(new BarcodeCallback() {
                @Override
                public void barcodeResult(BarcodeResult result) {
                    if (result.getText() != null && !result.getText().isEmpty()) {
                        // Stop scanning
                        barcodeScanner.pause();
                        isScanning = false;

                        // Get ID Petugas from QR Code
                        idPetugas = result.getText();
                        Log.d(TAG, "QR Code berhasil dipindai. ID Petugas: " + idPetugas); // <-- Log Hasil Scan

                        // Update UI
                        scanStatus.setText("QR Code berhasil dipindai!");

                        // Process QR Code data
                        processQRCode(idPetugas);
                    }
                }

                @Override
                public void possibleResultPoints(List<ResultPoint> resultPoints) {
                    // Optional: Show scanning points
                }
            });

            barcodeScanner.resume();
        } else {
            Log.d(TAG, "Proses pemindaian sedang berlangsung.");
        }
    }

    private void processQRCode(String qrData) {
        // Validasi data QR Code
        if (qrData == null || qrData.isEmpty()) {
            Log.w(TAG, "Data QR Code kosong atau null.");
            Toast.makeText(this, "QR Code tidak valid", Toast.LENGTH_SHORT).show();
            resetScanner();
            return;
        }

        // Parse QR Code data jika formatnya kompleks (contoh: JSON, delimiter, dll)
        // Untuk saat ini anggap QR Code berisi ID Petugas langsung
        idPetugas = qrData.trim();
        Log.d(TAG, "Memproses data QR: " + idPetugas);
        loginWithQRCode(idPetugas);
    }

    private void loginWithQRCode(String idPetugas) {
        Log.d(TAG, "Memulai permintaan API login dengan id_petugas_qr: " + idPetugas); // <-- Log Permintaan API
        scanStatus.setText("Memproses login...");
        loading.showDialog(1, "Please Wait", "Loading..");

        Call<login_pegawai_api> call = mAPIService.login_pegawai_qr(idPetugas);
        call.enqueue(new Callback<login_pegawai_api>() {
            @Override
            public void onResponse(@NonNull Call<login_pegawai_api> call, @NonNull Response<login_pegawai_api> response) {
                loading.hideDialog();

                // <-- Log Respons API -->
                if (response.isSuccessful()) {
                    Log.d(TAG, "Respons API Sukses. Kode: " + response.code());
                    Log.d(TAG, "Body Respons: " + response.body()); // Ini bisa sangat panjang jika respons besar

                    login_pegawai_api res = response.body();
                    if (res != null) { // Pastikan body tidak null
                        try {
                            if ("success".equals(res.getStatus())) {
                                Log.d(TAG, "Login API berhasil. Status: success");
                                Toast.makeText(LoginQRActivity.this, "Login Berhasil", Toast.LENGTH_SHORT).show();

                                // --- Simpan Session ---
                                config_sessionmanager.saveSPString(config_sessionmanager.SP_TOKEN, res.getResult().get_tkn());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_NAMA, res.getResult().get_nama_pegawai());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ID, res.getResult().get_id());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_JABATAN, res.getResult().get_jabatan());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_SPBU, res.getResult().get_spbu());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ALAMAT1, res.getResult().get_alamat1());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ALAMAT2, res.getResult().get_alamat2());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_TELEPON, res.getResult().get_telepon());
                                config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_PENUTUP, res.getResult().get_penutup());
                                config_sessionmanager.saveSPBoolean(config_sessionmanager.SP_SUDAH_LOGIN, true);

                                Intent intent = new Intent(LoginQRActivity.this, home_activity.class);
                                startActivity(intent);
                                finish();
                            } else {
                                Log.d(TAG, "Login API gagal. Status dari server: " + res.getStatus());
                                Toast.makeText(LoginQRActivity.this, "Login Gagal: " + res.getStatus(), Toast.LENGTH_SHORT).show();
                            }
                        } catch (NullPointerException ex) {
                            Log.e(TAG, "Error saat memproses respons API (NullPointerException): ", ex);
                            Toast.makeText(LoginQRActivity.this, "Login Gagal: Data tidak lengkap", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Log.e(TAG, "Respons body dari API adalah null.");
                        Toast.makeText(LoginQRActivity.this, "Login Gagal: Respons server tidak valid", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Log.e(TAG, "Respons API Tidak Sukses. Kode: " + response.code() + ". Pesan: " + response.message());
                    Toast.makeText(LoginQRActivity.this, "Koneksi Error: " + response.code(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(@NonNull Call<login_pegawai_api> call, @NonNull Throwable t) {
                loading.hideDialog();
                Log.e(TAG, "Permintaan API Gagal.", t); // <-- Log Failure -->
                Toast.makeText(LoginQRActivity.this, "Koneksi Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
        resetScanner();
    }

    private void resetScanner() {
        isScanning = false;
        btnScan.setEnabled(true);
        scanStatus.setText("Arahkan kamera ke QR Code");
        idPetugas = "";
        Log.d(TAG, "Scanner direset, siap untuk scan ulang.");

        // Resume scanner untuk scan ulang
        if (barcodeScanner != null) {
            barcodeScanner.resume();
        }
    }

    public void batal(View view) {
        Log.d(TAG, "Tombol Batal ditekan, activity selesai.");
        finish();
    }

    @Override
    protected void onResume() {
        super.onResume();
        if (barcodeScanner != null && !isScanning) {
            barcodeScanner.resume();
        }
    }

    @Override
    protected void onPause() {
        super.onPause();
        if (barcodeScanner != null) {
            barcodeScanner.pause();
        }
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        if (barcodeScanner != null) {
            barcodeScanner.pause();
        }
    }
}