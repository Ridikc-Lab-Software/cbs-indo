package com.project.aplikasi.petugas_cbs.data_redeem;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TOP;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothAdapter;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.media.MediaPlayer;
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
import com.dantsu.escposprinter.exceptions.EscPosBarcodeException;
import com.dantsu.escposprinter.exceptions.EscPosConnectionException;
import com.dantsu.escposprinter.exceptions.EscPosEncodingException;
import com.dantsu.escposprinter.exceptions.EscPosParserException;
import com.dantsu.escposprinter.textparser.PrinterTextParserImg;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.activity.login_activity;
import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.home.home_activity;
import com.project.aplikasi.petugas_cbs.tag_rfid_redeem;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class print_redeem extends Activity implements Runnable {

    protected static final String TAG = "print_redeem";
    private static final int REQUEST_ENABLE_BT = 2;

    // UI Components
    private Button mScan, mPrint;
    private TextView stat;
    private LinearLayout layout;
    private ProgressDialog mBluetoothConnectProgressDialog;

    // Data variables (Khusus Redeem)
    String id_mitra;
    private String id_redeem, nama, point, nama_promo, mitra, pengurangan_point, petugas, kategori_member, redeem_value;
    private String spbu, alamat1, alamat2, telepon, penutup;

    // Printer variables
    private config_sessionmanager config_sessionmanager;
    private BluetoothConnection selectedDevice;
    private MediaPlayer mpClick;

    // Variable untuk menyimpan konten struk & Logo dari API
    private String receiptContent;

    // --- VARIABEL BARU UNTUK LOGO DINAMIS ---
    // Default kita set ke logo_print (CBS), akan berubah jika API mengirim 'pertamina'
    private int currentLogoId = R.drawable.logo_print;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.print);

        initializeViews();
        initializeSessionManager();
        loadIntentData();
        setupButtonListeners();
        checkPrinterConnection();
    }

    private void initializeViews() {
        stat = findViewById(R.id.bpstatus);
        layout = findViewById(R.id.layout);
        mScan = findViewById(R.id.Scan);
        mPrint = findViewById(R.id.mPrint);
        mPrint.setEnabled(true);
        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_HIDDEN);

        mpClick = MediaPlayer.create(getApplicationContext(), R.raw.click);
    }

    private void initializeSessionManager() {
        config_sessionmanager = new config_sessionmanager(this);
        spbu = config_sessionmanager.getSPBU();
        alamat1 = config_sessionmanager.getAlamat1();
        alamat2 = config_sessionmanager.getAlamat2();
        telepon = config_sessionmanager.getTelepon();
        penutup = config_sessionmanager.getSpPenutup();
    }

    private void loadIntentData() {
        Bundle bundle = getIntent().getExtras();
        if (bundle != null) {
            id_redeem = bundle.getString("id_redeem", "");
            nama = bundle.getString("nama", "");
            nama_promo = bundle.getString("nama_promo", "");
            id_mitra = bundle.getString("id_mitra", "");
            mitra = bundle.getString("mitra", "");
            point = bundle.getString("point", "");
            pengurangan_point = bundle.getString("pengurangan_point", "");
            petugas = bundle.getString("petugas", "");
            kategori_member = bundle.getString("kategori_member", "");
            redeem_value = bundle.getString("redeem_value", "");
        }
    }

    private void setupButtonListeners() {
        mPrint.setOnClickListener(mView -> {
            playClickSound();
            loadStrukFromAPI();
        });

        mScan.setOnClickListener(mView -> {
            playClickSound();
            browseBluetoothDevice();
        });
    }

    // 1. Konfirmasi Awal (User Klik Tombol Print)
    private void askPrintConfirmation() {
        showCustomCardDialog(
                "Konfirmasi Cetak",
                "Apakah Anda ingin mencetak struk member?",
                "Ya",
                "Tidak",
                this::loadStrukFromAPI, // Aksi Jika YA
                this::askTransactionAgain // Aksi Jika TIDAK
        );
    }

    // 3. Konfirmasi Kedua (Setelah Print Pelanggan Selesai)
    private void askPrintArsipConfirmation() {
        showCustomCardDialog(
                "Konfirmasi Cetak Arsip",
                "Apakah Anda ingin mencetak struk arsip?",
                "Ya",
                "Tidak",
                () -> cetakArsip(receiptContent), // Aksi Jika YA
                this::askTransactionAgain // Aksi Jika TIDAK
        );
    }

    // 4. Konfirmasi Akhir (Selesai semua proses)
    private void askTransactionAgain() {
        showCustomCardDialog(
                "Redeem Selesai",
                "Apakah ingin melakukan redeem lagi?",
                "Ya",
                "Tidak",
                () -> { // Aksi Jika YA
                    Intent intent = new Intent(print_redeem.this, tag_rfid_redeem.class);
                    intent.setFlags(FLAG_ACTIVITY_NEW_TASK);
                    startActivity(intent);
                    finish();
                },
                () -> { // Aksi Jika TIDAK
                    Intent intent = new Intent(this, home_activity.class);
                    intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                    finish();
                }
        );
    }

    private void logout() {
        config_sessionmanager session = new config_sessionmanager(this);
        session.logOut();
        Toast.makeText(this, "Logout berhasil.", Toast.LENGTH_SHORT).show();

        Intent intent = new Intent(this, login_activity.class);
        intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void playClickSound() {
        if (mpClick != null) {
            mpClick.start();
        }
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
                showPrinterErrorDialog();
            }
        }
    }

    private void updatePrinterStatus(String status, int color) {
        runOnUiThread(() -> {
            stat.setText(status);
            stat.setTextColor(color);
        });
    }

    // --- LOGIKA UTAMA: LOAD DATA DARI API ---
    private void loadStrukFromAPI() {
        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Loading...", "Menyiapkan Preview Struk...", true, false);

        data_redeem_apiservice api = config_apiclient
                .getClient(config_global.BASE_URL)
                .create(data_redeem_apiservice.class);
        String id_operator = new config_global().ambil(this);

        api.get_print_template(
                id_redeem, nama, nama_promo, id_mitra, point,
                pengurangan_point, id_operator, kategori_member, redeem_value
        ).enqueue(new Callback<RedeemPrintResponse>() {
            @Override
            public void onResponse(Call<RedeemPrintResponse> call, Response<RedeemPrintResponse> response) {
                if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();

                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(print_redeem.this, "Gagal mengambil data: Response Kosong", Toast.LENGTH_SHORT).show();
                    return;
                }

                String receiptRaw = response.body().getReceipt_text();
                String logoType = response.body().getLogo();

                // 1. Tentukan Logo
                if (logoType != null && logoType.equalsIgnoreCase("pertamina")) {
                    currentLogoId = R.drawable.logo_pertamina; // Pastikan gambar ini ada
                } else {
                    currentLogoId = R.drawable.logo_print;
                }

                // 2. Formatting Text
                if (receiptRaw != null) {
                    receiptContent = receiptRaw.replace("\\n", "\n");

                    // Tambahkan tag alignment hanya untuk printing nanti,
                    // Untuk preview, kita tampilkan raw text saja agar rapi di layar

                    // PANGGIL DIALOG PREVIEW PERTAMA (PELANGGAN)
                    showPreviewDialog("Cetak Struk Member", receiptContent, true);
                } else {
                    Toast.makeText(print_redeem.this, "Data Struk API NULL", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<RedeemPrintResponse> call, Throwable t) {
                if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                Toast.makeText(print_redeem.this, "Error Koneksi: " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    // --- FITUR BARU: DIALOG PREVIEW ---
    private void showPreviewDialog(String title, String contentText, boolean isPelanggan) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();

        // Inflate layout baru yang sudah ada tombol custom-nya
        View dialogView = inflater.inflate(R.layout.dialog_print_preview, null);
        builder.setView(dialogView);

        // 1. Init View Komponen Utama
        ImageView imgLogo = dialogView.findViewById(R.id.img_preview_logo);
        TextView txtContent = dialogView.findViewById(R.id.txt_preview_receipt);

        // 2. Init Tombol Custom (CardView & TextView)
        CardView btnCetak = dialogView.findViewById(R.id.btn_cetak_card);
        TextView txtLabelCetak = dialogView.findViewById(R.id.txt_cetak);

        CardView btnSelesai = dialogView.findViewById(R.id.btn_selesai_card);
        // TextView txtLabelSelesai = dialogView.findViewById(R.id.txt_selesai); // Jika ingin ubah teks "Selesai"

        // Set Data Konten
        imgLogo.setImageResource(currentLogoId);
        txtContent.setText(contentText);

        // Atur Label Tombol Cetak (Misal: "CETAK (1)" atau "CETAK (2)")
        String nomor_cetak = isPelanggan ? "1" : "2";
        txtLabelCetak.setText("CETAK (" + nomor_cetak + ")");

        // Create Dialog
        AlertDialog dialog = builder.create();

        // PENTING: Set Background Transparan agar radius CardView terlihat
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new android.graphics.drawable.ColorDrawable(android.graphics.Color.TRANSPARENT));
        }

        // 3. Logic Tombol CETAK (Positive Action)
        btnCetak.setOnClickListener(v -> {
            String formattedForPrinter = contentText;
            if (!formattedForPrinter.contains("[L]") && !formattedForPrinter.contains("[C]")) {
                formattedForPrinter = "[L]" + formattedForPrinter;
            }

            // Tutup dialog dulu atau biarkan terbuka tergantung flow (biasanya print tidak menutup dialog preview)
             dialog.dismiss();

            if (isPelanggan) {
                cetakPelanggan(formattedForPrinter);
            } else {
                cetakArsip(formattedForPrinter);
            }
        });

        // 4. Logic Tombol SELESAI (Negative Action)
        btnSelesai.setOnClickListener(v -> {
            dialog.dismiss();
            askTransactionAgain(); // Pindah ke dialog "Redeem Lagi?"
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    // --- LOGIKA CETAK PELANGGAN ---
    public void cetakPelanggan(String formattedContent) {
        if (selectedDevice == null) {
            showPrinterErrorDialog();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Printing...", "Sedang mencetak...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // --- MODIFIKASI DISINI: Tambahkan Label Customer Copy ---
                String footerPelanggan = "[C]--------------------------------\n" +
                        "[C]** CUSTOMER COPY **\n" +
                        "[C]--------------------------------\n";

                String finalPrintText = "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        getApplicationContext().getResources().getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n\n" +
                        formattedContent + footerPelanggan;
                // --------------------------------------------------------

                printer.printFormattedText(finalPrintText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_redeem.this, "Cetak selesai.", Toast.LENGTH_SHORT).show();

                    // SETELAH CETAK PELANGGAN SELESAI -> TAMPILKAN PREVIEW ARSIP
                    showPreviewDialog("Cetak Struk Arsip", receiptContent, false);
                });

            } catch (Exception e) {
                e.printStackTrace();
                handlePrinterError(e, "Pelanggan");
            }
        }).start();
    }

    // --- LOGIKA CETAK ARSIP ---
    public void cetakArsip(String formattedContent) {
        if (selectedDevice == null) {
            showPrinterErrorDialog();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Printing...", "Sedang mencetak (Arsip)...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // --- MODIFIKASI DISINI: Tambahkan Label Mitra Copy ---
                String footerMitra = "[C]--------------------------------\n" +
                        "[C]** MITRA COPY **\n" +
                        "[C]--------------------------------\n";

                String finalPrintText = "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        getApplicationContext().getResources().getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n" +
                        formattedContent + footerMitra;
                // -----------------------------------------------------

                printer.printFormattedText(finalPrintText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_redeem.this, "Cetak arsip selesai.", Toast.LENGTH_SHORT).show();
                    askTransactionAgain(); // SELESAI
                });

            } catch (Exception e) {
                e.printStackTrace();
                handlePrinterError(e, "Arsip");
            }
        }).start();
    }

    private void handlePrinterError(Exception e, String type) {
        runOnUiThread(() -> {
            if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();

            String msg = "Printer Error";
            if(e instanceof EscPosConnectionException) msg = "Koneksi Printer Putus!";
            else if(e instanceof EscPosParserException) msg = "Format Teks Salah!";
            else if(e instanceof EscPosEncodingException) msg = "Encoding Error!";
            else if(e instanceof EscPosBarcodeException) msg = "Barcode Error!";

            Toast.makeText(print_redeem.this, msg + " (" + type + ")", Toast.LENGTH_LONG).show();
            updatePrinterStatus("Disconnected", Color.RED);
        });
    }

    private void showPrinterErrorDialog() {
        runOnUiThread(() -> {
            AlertDialog.Builder builder = new AlertDialog.Builder(print_redeem.this);
            builder.setTitle("Printer")
                    .setMessage("Silahkan Pilih Printer")
                    .setCancelable(false)
                    .setPositiveButton("OK", (dialog, id) -> dialog.dismiss())
                    .setNegativeButton("Pilih Printer", (dialog, which) -> browseBluetoothDevice());

            AlertDialog alert = builder.create();
            alert.show();
            updatePrinterStatus("Disconnected", Color.RED);
        });
    }

    private void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList = (new BluetoothPrintersConnections()).getList();

        if (bluetoothDevicesList == null || bluetoothDevicesList.length == 0) {
            runOnUiThread(() -> {
                AlertDialog.Builder builder = new AlertDialog.Builder(print_redeem.this);
                builder.setTitle("Tidak Ada Printer")
                        .setMessage("Tidak ditemukan printer Bluetooth.")
                        .setPositiveButton("OK", null)
                        .show();
            });
            return;
        }

        final String[] items = new String[bluetoothDevicesList.length];
        for (int i = 0; i < bluetoothDevicesList.length; i++) {
            items[i] = bluetoothDevicesList[i].getDevice().getName() + "\n" +
                    bluetoothDevicesList[i].getDevice().getAddress();
        }

        runOnUiThread(() -> {
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(print_redeem.this);
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

            AlertDialog alert = alertDialog.create();
            alert.show();
        });
    }

    @Override
    protected void onDestroy() {
        if (mpClick != null) {
            mpClick.release();
        }
        if (mBluetoothConnectProgressDialog != null && mBluetoothConnectProgressDialog.isShowing()) {
            mBluetoothConnectProgressDialog.dismiss();
        }
        super.onDestroy();
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(print_redeem.this, tag_rfid_redeem.class);
        intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    // --- HELPER BARU: DIALOG DENGAN CARD BUTTONS ---
    private void showCustomCardDialog(String title, String message, String posText, String negText, Runnable onPositive, Runnable onNegative) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = getLayoutInflater();

        // Inflate layout custom yang baru dibuat (dialog_custom_card.xml)
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();

        // Set background transparan agar CardView radius terlihat
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        // Init Components
        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        // Set Data
        txtTitle.setText(title);
        txtMessage.setText(message);
        txtPos.setText(posText);
        txtNeg.setText(negText);

        // Listeners
        btnPos.setOnClickListener(v -> {
            dialog.dismiss();
            if (onPositive != null) onPositive.run();
        });

        btnNeg.setOnClickListener(v -> {
            dialog.dismiss();
            if (onNegative != null) onNegative.run();
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    @Override
    public void run() {
        // Implementation for Runnable interface if needed
    }
}