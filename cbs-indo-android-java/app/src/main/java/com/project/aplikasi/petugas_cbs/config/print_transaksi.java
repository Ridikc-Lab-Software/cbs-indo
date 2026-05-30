package com.project.aplikasi.petugas_cbs.config;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

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
import com.project.aplikasi.petugas_cbs.activity.TransaksiVoucherActivity;
import com.project.aplikasi.petugas_cbs.activity.login_activity;
import com.project.aplikasi.petugas_cbs.data_redeem.print_redeem;
import com.project.aplikasi.petugas_cbs.data_transaksi_voucher.data_transaksi_voucher_apiservice;
import com.project.aplikasi.petugas_cbs.data_transaksi_voucher.data_transaksi_voucher_apiutils;
import com.project.aplikasi.petugas_cbs.home.home_activity;
import com.project.aplikasi.petugas_cbs.tag_rfid_redeem;

import org.json.JSONObject;

import java.text.NumberFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Response;

public class print_transaksi extends Activity {

    protected static final String TAG = "print_transaksi";

    // UI
    Button mScan, mPrint;
    TextView stat;
    LinearLayout layout;
    private ProgressDialog mBluetoothConnectProgressDialog;

    // Data Transaksi
    String id_transaksi, nama, point, jenis_transaksi, kategori_member, tambahan_point, jumlah, kategori, petugas, id_supir;
    String spbu, penutup, alamat1, alamat2, telepon;
    String aksi;
    String id_voucher, nominal_voucher;

    // Formatting Date
    Calendar c = Calendar.getInstance();
    SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.US);
    final String formattedDate = df.format(c.getTime());

    // Printer & Config
    config_sessionmanager config_sessionmanager;
    private BluetoothConnection selectedDevice;

    // Variables for Preview
    private String receiptContent = "";
    private int currentLogoId = R.drawable.logo_print;
    String liter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.print);

        initializeViews();
        initializeSession();
        loadIntentData();
        setupListeners();
        checkPrinterConnection();
    }

    // --- 1. SETUP AWAL ---

    private void initializeViews() {
        stat = findViewById(R.id.bpstatus);
        layout = findViewById(R.id.layout);
        mScan = findViewById(R.id.Scan);
        mPrint = findViewById(R.id.mPrint);
        mPrint.setEnabled(true);
        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_HIDDEN);
    }

    private void initializeSession() {
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
            aksi = bundle.getString("aksi", "");
            id_voucher = bundle.getString("id_voucher", "");
            id_transaksi = bundle.getString("id_transaksi", "");
            nama = bundle.getString("nama", "");
            kategori_member = bundle.getString("kategori_member", "");
            jenis_transaksi = bundle.getString("jenis_transaksi", "");
            point = bundle.getString("point", "");
            tambahan_point = bundle.getString("tambahan_point", "");
            petugas = bundle.getString("petugas", "");
            id_supir = bundle.getString("id_supir", "");
            jumlah = bundle.getString("jumlah", "");
            kategori = bundle.getString("kategori", "");
            liter = bundle.getString("liter", "");
            nominal_voucher = bundle.getString("nominal_voucher");
        }
    }

    private void setupListeners() {
        mPrint.setOnClickListener(view -> {
            playClickSound();
            prepareDataForPreview(); // Mulai proses pengambilan data
        });

        mScan.setOnClickListener(mView -> {
            playClickSound();
            browseBluetoothDevice();
        });
    }

    private void checkPrinterConnection() {
        if (config_sessionmanager.getPRINT().isEmpty()) {
            updatePrinterStatus("Disconnected", Color.RED);
            mScan.setVisibility(View.VISIBLE);
        } else {
            try {
                BluetoothAdapter mBluetoothAdapter = BluetoothAdapter.getDefaultAdapter();
                selectedDevice = new BluetoothConnection(mBluetoothAdapter.getRemoteDevice(config_sessionmanager.getPRINT()));
                updatePrinterStatus("Connected", Color.rgb(97, 170, 74));
            } catch (Exception e) {
                updatePrinterStatus("Disconnected", Color.RED);
            }
        }
    }

    private void updatePrinterStatus(String statusText, int color) {
        runOnUiThread(() -> {
            stat.setText(statusText);
            stat.setTextColor(color);
        });
    }

    private void playClickSound() {
        MediaPlayer mp = MediaPlayer.create(getApplicationContext(), R.raw.click);
        mp.start();
    }

    // --- 2. LOGIKA PERSIAPAN DATA ---

    private void prepareDataForPreview() {
        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Loading...", "Menyiapkan Data Struk...", true, false);

        new Thread(() -> {
            try {
                if (aksi != null && aksi.equals("simpan-voucher")) {
                    processVoucherAPI();
                } else {
                    processMemberLocal();
                }
            } catch (Exception e) {
                e.printStackTrace();
                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Error: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                });
            }
        }).start();
    }

    private void processVoucherAPI() throws Exception {
        data_transaksi_voucher_apiservice service = data_transaksi_voucher_apiutils.getAPIService();
        Call<ResponseBody> call = service.print_transaksi_voucher(
                id_transaksi, id_voucher, formattedDate, jenis_transaksi, jumlah, petugas, nama, id_supir,kategori, nominal_voucher,liter
        );

        Response<ResponseBody> response = call.execute();

        if (response.isSuccessful() && response.body() != null) {
            String rawJson = response.body().string();
            JSONObject jsonObject = new JSONObject(rawJson);
            String status = jsonObject.optString("status");

            if (status.equals("success")) {
                receiptContent = jsonObject.getString("receipt_text");
                String jenisLogo = jsonObject.optString("logo", "cbs");

                if (jenisLogo.equalsIgnoreCase("pertamina")) {
                    currentLogoId = R.drawable.logo_pertamina;
                } else {
                    currentLogoId = R.drawable.logo_print;
                }

                // DATA SIAP -> LANJUT KE STEP 1 (PELANGGAN)
                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    showDialogPelanggan();
                });

            } else {
                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "API Gagal: Status bukan success", Toast.LENGTH_SHORT).show();
                });
            }
        } else {
            throw new Exception("Gagal koneksi API (Code: " + response.code() + ")");
        }
    }

    private void processMemberLocal() {
        currentLogoId = R.drawable.logo_print;
        StringBuilder sb = new StringBuilder();
        sb.append("        MEMBERCARD PT.CBS\n\n");
        sb.append("SPBU : ").append(spbu).append("\n");
        sb.append("Telp : ").append(telepon).append(" \n\n");

        if (aksi != null && aksi.equals("simpan-voucher-member")) {
            sb.append("      TRANSAKSI VOUCHER \n\n");
        } else {
            sb.append("      TRANSAKSI MEMBER \n\n");
        }

        Calendar cl = Calendar.getInstance();
        SimpleDateFormat localDf = new SimpleDateFormat("dd MMMM yyyy HH:mm:ss", new Locale("id", "ID"));
        sb.append(localDf.format(cl.getTime())).append("\n");
        sb.append("================================\n");

        sb.append("Nama             : ").append(nama).append("\n");
        sb.append("Jenis Kendaraan  : ").append(kategori_member).append("\n");
        sb.append("Jenis Transaksi  : ").append(jenis_transaksi).append("\n");

        String jumlahFmt = jumlah;
        if (kategori != null && kategori.equals("rupiah")) {
            Locale localeID = new Locale("in", "ID");
            NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
            formatRupiah.setMaximumFractionDigits(0);
            try {
                jumlahFmt = (formatRupiah.format((double) Integer.parseInt(jumlah)));
            } catch (Exception e) {
                jumlahFmt = jumlah;
            }
        }

        sb.append("Jumlah Transaksi : ").append(jumlahFmt).append("\n");
        sb.append("Tambahan Point   : ").append(tambahan_point).append(" Point\n");
        sb.append("Total Point      : ").append(point).append(" Point\n");
        sb.append("================================\n");
        sb.append("Operator : ").append(petugas).append("\n\n");
        sb.append(" TERIMAKASIH DAN SELAMAT JALAN.");

        receiptContent = sb.toString();

        // DATA SIAP -> LANJUT KE STEP 1 (PELANGGAN)
        runOnUiThread(() -> {
            if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
            showDialogPelanggan();
        });
    }


    // =========================================================================
    // --- 3. ALUR DIALOG BERANTAI (FLOW LOGIC) ---
    // =========================================================================

    // TAHAP 1: STRUK PELANGGAN
    private void showDialogPelanggan() {
        showPreviewModal("Cetak Struk Member?", receiptContent,
                // Jika Klik CETAK -> Kirim label "CUSTOMER COPY"
                () -> performBluetoothPrint("RELASI COPY", () -> {
                    // Setelah selesai, lanjut ke arsip
                    showDialogArsip();
                }),
                // Jika Klik LEWATI
                () -> {
                    showDialogAkhir();
                },"1"
        );
    }

    // TAHAP 2: STRUK ARSIP
    private void showDialogArsip() {
        showPreviewModal("Cetak Struk Arsip?", receiptContent,
                // Jika Klik CETAK -> Kirim label "RELASI COPY"
                () -> performBluetoothPrint("SPBU COPY", () -> {
                    // Setelah selesai, lanjut ke akhir
                    showDialogAkhir();
                }),
                // Jika Klik LEWATI
                () -> {
                    showDialogAkhir();
                },"2"
        );
    }

    // TAHAP 3: KONFIRMASI AKHIR
    private void showDialogAkhir() {
        // 1. Setup Builder & Layout Custom
        AlertDialog.Builder builder = new AlertDialog.Builder(print_transaksi.this);
        LayoutInflater inflater = getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        // 2. Buat Dialog & Set Background Transparan (Penting untuk CardView)
        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        // 3. Binding View
        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        // 4. Set Teks
        txtTitle.setText("Transaksi Selesai");
        txtMessage.setText("Ingin melakukan transaksi Voucher lagi?");
        txtPos.setText("YA, LAGI");
        txtNeg.setText("TIDAK");

        // 5. Logika Tombol Positif (YA -> Transaksi Voucher Lagi)
        btnPos.setOnClickListener(v -> {
            dialog.dismiss();

            Intent intent = new Intent(print_transaksi.this, TransaksiVoucherActivity.class);
            // Flag untuk menghapus tumpukan lama & buat baru
            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            finish();
        });

        // 6. Logika Tombol Negatif (TIDAK -> Kembali ke Home)
        btnNeg.setOnClickListener(v -> {
            dialog.dismiss();

            Intent intent = new Intent(print_transaksi.this, home_activity.class);
            // Flag untuk menghapus tumpukan lama & buat baru
            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            finish();
        });

        // 7. Tampilkan
        dialog.setCancelable(false); // User WAJIB memilih
        dialog.show();
    }

    // Helper untuk menampilkan Modal Preview secara umum
    private void showPreviewModal(String title, String content, Runnable onCetak, Runnable onLewati, String tahap) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        // builder.setTitle(title); // Tidak perlu jika title sudah ada di layout XML

        LayoutInflater inflater = this.getLayoutInflater();

        // Inflate layout yang sudah berisi tombol CardView Custom
        View dialogView = inflater.inflate(R.layout.dialog_print_preview, null);

        // 1. Init View Konten
        ImageView imgLogo = dialogView.findViewById(R.id.img_preview_logo);
        TextView txtContent = dialogView.findViewById(R.id.txt_preview_receipt);

        // 2. Init Tombol Custom (Sesuaikan ID dengan XML dialog_print_preview)
        androidx.cardview.widget.CardView btnCetak = dialogView.findViewById(R.id.btn_cetak_card);
        androidx.cardview.widget.CardView btnSelesai = dialogView.findViewById(R.id.btn_selesai_card);
        TextView txtLabelCetak = dialogView.findViewById(R.id.txt_cetak);

        // Set Data
        imgLogo.setImageResource(currentLogoId);
        txtContent.setText(content);

        // Ubah teks tombol Cetak (misal: "CETAK (1)")
        if (txtLabelCetak != null) {
            txtLabelCetak.setText("CETAK (" + tahap + ")");
        }

        builder.setView(dialogView);
        AlertDialog dialog = builder.create();

        // 3. PENTING: Hilangkan background kotak putih standar agar CardView terlihat bagus
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new android.graphics.drawable.ColorDrawable(android.graphics.Color.TRANSPARENT));
        }

        // 4. Handle Klik Tombol Custom (Pengganti setPositiveButton)
        btnCetak.setOnClickListener(v -> {
            if(onCetak != null) onCetak.run();
             dialog.dismiss();
        });

        // 5. Handle Klik Tombol Selesai (Pengganti setNegativeButton)
        btnSelesai.setOnClickListener(v -> {
            dialog.dismiss(); // Wajib manual dismiss karena ini bukan tombol bawaan
            if(onLewati != null) onLewati.run();
        });

        dialog.setCancelable(false);
        dialog.show();
    }


    // --- 4. PROSES PRINT KE BLUETOOTH (DENGAN CALLBACK) ---

    private void performBluetoothPrint(String footerLabel, final Runnable onPrintFinished) {
        if (selectedDevice == null) {
            showPrinterErrorDialog();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this, "Printing...", "Sedang mencetak...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // 1. Siapkan Footer (Label Copy)
                String footerText = "[C]--------------------------------\n" +
                        "[C]** " + footerLabel + " **\n" +
                        "[C]--------------------------------\n";

                // 2. Siapkan Content Utama
                String contentBody = receiptContent;
                if(!contentBody.contains("[L]") && !contentBody.contains("[C]")) {
                    contentBody = "[L]" + contentBody;
                }

                // 3. Gabungkan: Logo + Content + Footer
                String finalFormattedText = "[C]<img>" +
                        PrinterTextParserImg.bitmapToHexadecimalString(printer,
                                getApplicationContext().getResources().getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) +
                        "</img>\n\n" +
                        contentBody +
                        footerText; // <-- Footer ditambahkan disini

                // 4. Eksekusi Print
                printer.printFormattedText(finalFormattedText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_transaksi.this, "Cetak " + footerLabel + " Berhasil", Toast.LENGTH_SHORT).show();

                    // JALANKAN PERINTAH SELANJUTNYA (CALLBACK)
                    if (onPrintFinished != null) {
                        onPrintFinished.run();
                    }
                });

            } catch (Exception e) {
                e.printStackTrace();
                handlePrinterError(e);
            }
        }).start();
    }

    // --- HELPER FUNCTIONS ---

    private void handlePrinterError(Exception e) {
        runOnUiThread(() -> {
            if (mBluetoothConnectProgressDialog != null) mBluetoothConnectProgressDialog.dismiss();

            String msg = "Printer Error";
            if(e instanceof EscPosConnectionException) msg = "Koneksi Printer Putus!";
            else if(e instanceof EscPosParserException) msg = "Format Teks Salah!";
            else if(e instanceof EscPosEncodingException) msg = "Encoding Error!";
            else if(e instanceof EscPosBarcodeException) msg = "Barcode Error!";

            AlertDialog.Builder builder = new AlertDialog.Builder(print_transaksi.this);
            builder.setMessage(msg + "\n" + e.getMessage())
                    .setPositiveButton("OK", (dialog, id) -> dialog.dismiss());
            builder.show();

            updatePrinterStatus("Disconnected", Color.RED);
        });
    }

    private void showPrinterErrorDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(print_transaksi.this);
        builder.setTitle("Printer")
                .setMessage("Silahkan Pilih Printer Terlebih Dahulu")
                .setPositiveButton("OK", (dialog, id) -> dialog.dismiss())
                .setNegativeButton("Pilih Printer", (dialog, which) -> browseBluetoothDevice());
        builder.show();
    }

    private void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList = (new BluetoothPrintersConnections()).getList();

        if (bluetoothDevicesList == null || bluetoothDevicesList.length == 0) {
            Toast.makeText(this, "Tidak ada printer bluetooth ditemukan", Toast.LENGTH_SHORT).show();
            return;
        }

        final String[] items = new String[bluetoothDevicesList.length];
        for (int i = 0; i < bluetoothDevicesList.length; i++) {
            items[i] = bluetoothDevicesList[i].getDevice().getName() + "\n" + bluetoothDevicesList[i].getDevice().getAddress();
        }

        AlertDialog.Builder alertDialog = new AlertDialog.Builder(print_transaksi.this);
        alertDialog.setTitle("Pilih Printer Bluetooth");
        alertDialog.setItems(items, (dialogInterface, i) -> {
            selectedDevice = bluetoothDevicesList[i];
            config_sessionmanager.saveSPString(config_sessionmanager.SP_PRINTER, selectedDevice.getDevice().getAddress());
            updatePrinterStatus("Connected", Color.rgb(97, 170, 74));
        });
        alertDialog.show();
    }
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(this, TransaksiVoucherActivity.class);
        intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }
}