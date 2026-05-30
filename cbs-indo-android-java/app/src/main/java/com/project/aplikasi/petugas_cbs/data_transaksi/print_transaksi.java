package com.project.aplikasi.petugas_cbs.data_transaksi;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothAdapter;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.cardview.widget.CardView;

import com.dantsu.escposprinter.EscPosPrinter;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothConnection;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothPrintersConnections;
import com.dantsu.escposprinter.exceptions.EscPosConnectionException;
import com.dantsu.escposprinter.exceptions.EscPosEncodingException;
import com.dantsu.escposprinter.exceptions.EscPosParserException;
import com.dantsu.escposprinter.textparser.PrinterTextParserImg;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.activity.login_activity;
import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.data_redeem.print_redeem;
import com.project.aplikasi.petugas_cbs.home.home_activity;
import com.project.aplikasi.petugas_cbs.tag_rfid_redeem;
import com.project.aplikasi.petugas_cbs.tag_rfid_transaksi;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class print_transaksi extends Activity {

    protected static final String TAG = "print_transaksi";
    private static final int REQUEST_ENABLE_BT = 2;

    // UI
    Button mScan, mPrint;
    TextView stat;
    LinearLayout layout;
    private ProgressDialog mBluetoothConnectProgressDialog;

    // Data Variables
    String id_transaksi, nama, point, jenis_transaksi, kategori_member, tambahan_point, jumlah, operator, kategori_input;
    String spbu, alamat1, alamat2, telepon, penutup;

    // Printer Variables
    private config_sessionmanager config_sessionmanager;
    private BluetoothConnection selectedDevice;
    private String receiptContent; // Simpan konten struk dari API
    private String point_awal;

    // --- VARIABEL BARU UNTUK LOGO DINAMIS ---
    // Default kita set ke logo_print (CBS)
    private int currentLogoId = R.drawable.logo_print;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.print);

        // Inisialisasi UI
        stat = findViewById(R.id.bpstatus);
        layout = findViewById(R.id.layout);
        mScan = findViewById(R.id.Scan);
        mPrint = findViewById(R.id.mPrint);
        mPrint.setEnabled(true);

        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_HIDDEN);

        // Inisialisasi Session
        config_sessionmanager = new config_sessionmanager(this);
        spbu = config_sessionmanager.getSPBU();
        alamat1 = config_sessionmanager.getAlamat1();
        alamat2 = config_sessionmanager.getAlamat2();
        telepon = config_sessionmanager.getTelepon();
        penutup = config_sessionmanager.getSpPenutup();
        operator = config_sessionmanager.getSPNama();

        // Ambil Data dari Intent
        Bundle bundle = getIntent().getExtras();
        if (bundle != null) {
            id_transaksi = bundle.getString("id_transaksi");
            nama = bundle.getString("nama");
            kategori_member = bundle.getString("kategori_member");
            jenis_transaksi = bundle.getString("jenis_transaksi");
            point_awal = bundle.getString("point_awal");
            point = bundle.getString("point");
            tambahan_point = bundle.getString("tambahan_point");
            jumlah = bundle.getString("jumlah");
            kategori_input = bundle.getString("kategori");
        }

        // Cek Koneksi Awal
        checkPrinterConnection();

        mScan.setOnClickListener(v -> browseBluetoothDevice());

        mPrint.setOnClickListener(v -> {
            loadStrukFromAPI();
        });
    }

    private void askTransactionAgain() {
        // 1. Setup Layout Custom
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        // 2. Buat Dialog & Set Background Transparan
        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        // 3. Binding Komponen View
        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        // 4. Set Teks
        txtTitle.setText("Transaksi Selesai");
        txtMessage.setText("Apakah ingin melakukan transaksi lagi?");
        txtPos.setText("YA");
        txtNeg.setText("TIDAK");

        // 5. Logika Tombol Positif (YA -> Ke tag_rfid_transaksi)
        btnPos.setOnClickListener(v -> {
            dialog.dismiss();

            Intent intent = new Intent(print_transaksi.this, tag_rfid_transaksi.class);
            // Flag untuk membersihkan tumpukan activity lama
            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            finish();
        });

        // 6. Logika Tombol Negatif (TIDAK -> Ke home_activity)
        btnNeg.setOnClickListener(v -> {
            dialog.dismiss();

            Intent intent = new Intent(print_transaksi.this, home_activity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            finish();
        });

        // 7. Tampilkan Dialog (Tidak bisa di-cancel tombol back)
        dialog.setCancelable(false);
        dialog.show();
    }

    private void logout() {
        config_sessionmanager session = new config_sessionmanager(this);
        session.logOut();
        Toast.makeText(this, "Logout berhasil.", Toast.LENGTH_SHORT).show();

        Intent intent = new Intent(this, login_activity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void checkPrinterConnection() {
        if (config_sessionmanager.getPRINT().isEmpty()) {
            mScan.setText("Connect");
            mScan.setVisibility(View.VISIBLE);
            mPrint.setVisibility(View.VISIBLE);
            updatePrinterStatus("Disconnected", Color.RED);
        } else {
            try {
                selectedDevice = new BluetoothConnection(
                        BluetoothAdapter.getDefaultAdapter()
                                .getRemoteDevice(config_sessionmanager.getPRINT())
                );
                mScan.setText("Reconnect Printer");
                updatePrinterStatus("Connected", Color.rgb(97, 170, 74));
            } catch (Exception e) {
                updatePrinterStatus("Disconnected", Color.RED);
                mScan.setText("Connect");
            }
        }
    }

    private void updatePrinterStatus(String status, int color) {
        runOnUiThread(() -> {
            stat.setText(status);
            stat.setTextColor(color);
        });
    }

    private void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList = (new BluetoothPrintersConnections()).getList();

        if (bluetoothDevicesList == null || bluetoothDevicesList.length == 0) {
            Toast.makeText(this, "Tidak ada perangkat Bluetooth ditemukan.", Toast.LENGTH_SHORT).show();
            return;
        }

        final String[] items = new String[bluetoothDevicesList.length];
        for (int i = 0; i < bluetoothDevicesList.length; i++) {
            items[i] = bluetoothDevicesList[i].getDevice().getName() + "\n" +
                    bluetoothDevicesList[i].getDevice().getAddress();
        }

        AlertDialog.Builder alertDialog = new AlertDialog.Builder(print_transaksi.this);
        alertDialog.setTitle("Pilih Printer Bluetooth")
                .setItems(items, (dialogInterface, position) -> {
                    selectedDevice = bluetoothDevicesList[position];
                    config_sessionmanager.saveSPString(
                            config_sessionmanager.SP_PRINTER,
                            selectedDevice.getDevice().getAddress()
                    );
                    updatePrinterStatus("Connected", Color.rgb(97, 170, 74));
                    mScan.setText("Reconnect Printer");
                })
                .setNegativeButton("Batal", null);
        alertDialog.show();
    }

    // --- LOGIKA API ---
    private void loadStrukFromAPI() {
        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Loading...", "Mengambil data struk...", true, false);

        data_transaksi_apiservice api = config_apiclient
                .getClient(config_global.BASE_URL)
                .create(data_transaksi_apiservice.class);

        String id_operator = new config_global().ambil(this);
        api.get_print_template(
                id_transaksi, nama, point_awal, point, jenis_transaksi,
                kategori_member, tambahan_point, jumlah, id_operator, kategori_input
        ).enqueue(new Callback<TransaksiPrintResponse>() {
            @Override
            public void onResponse(Call<TransaksiPrintResponse> call, Response<TransaksiPrintResponse> response) {
                if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();

                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(print_transaksi.this, "Gagal mengambil data", Toast.LENGTH_SHORT).show();
                    return;
                }

                // Ambil data
                String receiptRaw = response.body().getReceipt_text();
                String logoType = response.body().getLogo();

                // Set Logo
                if (logoType != null && logoType.equalsIgnoreCase("pertamina")) {
                    currentLogoId = R.drawable.logo_pertamina;
                } else {
                    currentLogoId = R.drawable.logo_print;
                }

                if (receiptRaw != null) {
                    receiptContent = receiptRaw.replace("\\n", "\n"); // Fix newline

                    // SETELAH DATA DAPAT, TAMPILKAN DIALOG PREVIEW PELANGGAN
                    showCustomerPreviewDialog();
                }
            }

            @Override
            public void onFailure(Call<TransaksiPrintResponse> call, Throwable t) {
                if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                Toast.makeText(print_transaksi.this, "Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    // --- 2. DIALOG PREVIEW PELANGGAN ---
    private void showCustomerPreviewDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        // builder.setTitle("Konfirmasi Cetak"); // Tidak perlu title bawaan jika layout sudah ada header

        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_print_preview, null);

        // 1. Binding View Utama
        ImageView imgLogo = dialogView.findViewById(R.id.img_preview_logo);
        TextView txtReceipt = dialogView.findViewById(R.id.txt_preview_receipt);

        // 2. Binding Tombol Custom (CardView)
        androidx.cardview.widget.CardView btnCetak = dialogView.findViewById(R.id.btn_cetak_card);
        androidx.cardview.widget.CardView btnSelesai = dialogView.findViewById(R.id.btn_selesai_card);
        TextView txtLabelCetak = dialogView.findViewById(R.id.txt_cetak); // Untuk ubah teks jadi "CETAK (1)"

        // 3. Set Data
        imgLogo.setImageResource(currentLogoId);
        txtReceipt.setText(receiptContent);

        if (txtLabelCetak != null) {
            txtLabelCetak.setText("CETAK (1)");
        }

        builder.setView(dialogView);
        AlertDialog dialog = builder.create();

        // 4. PENTING: Background Transparan agar CardView terlihat bagus
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new android.graphics.drawable.ColorDrawable(android.graphics.Color.TRANSPARENT));
        }

        // 5. Handle Klik Tombol Cetak (Ganti setPositiveButton)
        btnCetak.setOnClickListener(v -> {
            dialog.dismiss(); // Tutup dialog sebelum mulai proses cetak
            cetakPelanggan(receiptContent);
        });

        // 6. Handle Klik Tombol Selesai (Ganti setNegativeButton)
        btnSelesai.setOnClickListener(v -> {
            dialog.dismiss();
            askTransactionAgain();
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    // --- 3. DIALOG PREVIEW ARSIP ---
    // Dipanggil setelah cetakPelanggan selesai
    private void showArchivePreviewDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);

        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_print_preview, null);

        // 1. Binding View Utama
        ImageView imgLogo = dialogView.findViewById(R.id.img_preview_logo);
        TextView txtReceipt = dialogView.findViewById(R.id.txt_preview_receipt);

        // 2. Binding Tombol Custom
        androidx.cardview.widget.CardView btnCetak = dialogView.findViewById(R.id.btn_cetak_card);
        androidx.cardview.widget.CardView btnSelesai = dialogView.findViewById(R.id.btn_selesai_card);
        TextView txtLabelCetak = dialogView.findViewById(R.id.txt_cetak);

        // 3. Set Data
        imgLogo.setImageResource(currentLogoId);
        txtReceipt.setText(receiptContent); // Isi struk sama, nanti footer ditambah di fungsi cetak

        if (txtLabelCetak != null) {
            txtLabelCetak.setText("CETAK (2)");
        }

        builder.setView(dialogView);
        AlertDialog dialog = builder.create();

        // 4. Background Transparan
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new android.graphics.drawable.ColorDrawable(android.graphics.Color.TRANSPARENT));
        }

        // 5. Handle Klik Cetak
        btnCetak.setOnClickListener(v -> {
            dialog.dismiss();
            cetakArsip(receiptContent);
        });

        // 6. Handle Klik Selesai
        btnSelesai.setOnClickListener(v -> {
            dialog.dismiss();
            askTransactionAgain();
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    // --- LOGIKA CETAK (Sedikit penyesuaian di bagian akhir thread) ---

    public void cetakPelanggan(String receiptContent) {
        if (selectedDevice == null) {
            Toast.makeText(this, "Printer belum dipilih!", Toast.LENGTH_SHORT).show();
            browseBluetoothDevice();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Printing...", "Mencetak Pelanggan...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // --- MODIFIKASI: Tambahkan Footer CUSTOMER COPY ---
                String footerCustomer = "[C]--------------------------------\n" +
                        "[C]** CUSTOMER COPY **\n" +
                        "[C]--------------------------------\n";

                String finalPrintText = "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        getApplicationContext().getResources().getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n\n" +
                        receiptContent +
                        footerCustomer + // Masukkan footer disini
                        "\n";
                // --------------------------------------------------

                printer.printFormattedText(finalPrintText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Cetak Customer selesai.", Toast.LENGTH_SHORT).show();

                    // PANGGIL PREVIEW ARSIP SETELAH SELESAI
                    showArchivePreviewDialog();
                });

            } catch (Exception e) {
                e.printStackTrace();
                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Gagal Print ", Toast.LENGTH_LONG).show();
                });
            }
        }).start();
    }

    // --- LOGIKA CETAK ARSIP ---
    public void cetakArsip(String receiptContent) {
        if (selectedDevice == null) {
            Toast.makeText(this, "Printer belum dipilih!", Toast.LENGTH_SHORT).show();
            browseBluetoothDevice();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Printing...", "Sedang mencetak (Arsip)...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // --- MODIFIKASI: Tambahkan Footer SPBU COPY ---
                String footerSpbu = "[C]--------------------------------\n" +
                        "[C]** SPBU COPY **\n" +
                        "[C]--------------------------------\n";

                String finalPrintText = "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        getApplicationContext().getResources().getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n\n" +
                        receiptContent +
                        footerSpbu + // Masukkan footer disini
                        "\n";
                // ----------------------------------------------

                printer.printFormattedText(finalPrintText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Cetak Arsip selesai.", Toast.LENGTH_SHORT).show();

                    // Selesai Transaksi -> Tanya Transaksi Lagi
                    askTransactionAgain();
                });

            } catch (Exception e) {
                e.printStackTrace();
                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Gagal Print Arsip ", Toast.LENGTH_LONG).show();
                });
            }
        }).start();
    }

    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(print_transaksi.this, tag_rfid_transaksi.class);
        intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }
}