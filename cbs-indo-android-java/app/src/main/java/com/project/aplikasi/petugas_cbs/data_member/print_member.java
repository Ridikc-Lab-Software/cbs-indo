package com.project.aplikasi.petugas_cbs.data_member;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TOP;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
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
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.home.home_activity;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class print_member extends Activity implements Runnable {

    protected static final String TAG = "print_member";
    private static final int REQUEST_ENABLE_BT = 2;

    // UI Components
    private Button mScan, mPrint;
    private TextView stat;
    private LinearLayout layout;
    private ProgressDialog mBluetoothConnectProgressDialog;

    // Data variables (dari Intent Bundle)
    private String nama, alamat, no_telepon, jenis_kelamin;
    private String tanggal_lahir, kategori_member, agama, pekerjaan, spbu_member;
    private String username, password;

    // Session data
    private String spbu, alamat1, alamat2, telepon, penutup;

    // Printer variables
    private config_sessionmanager config_sessionmanager;
    private BluetoothConnection selectedDevice;
    private MediaPlayer mpClick;

    // Variable untuk menyimpan konten struk
    private String receiptContent;

    // Logo (default CBS)
    private int currentLogoId = R.drawable.logo_pertamina;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.print);

        initializeViews();
        initializeSessionManager();
        loadIntentData();
        setupButtonListeners();
        checkPrinterConnection();

        // Langsung generate struk
        generateReceiptContent();
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
            nama = bundle.getString("nama", "");
            alamat = bundle.getString("alamat", "");
            no_telepon = bundle.getString("no_telepon", "");
            jenis_kelamin = bundle.getString("jenis_kelamin", "");
            tanggal_lahir = bundle.getString("tanggal_lahir", "");
            kategori_member = bundle.getString("kategori_member", "");
            agama = bundle.getString("agama", "");
            pekerjaan = bundle.getString("pekerjaan", "");
            spbu_member = bundle.getString("spbu_member", "");
            username = bundle.getString("username", "");
            password = bundle.getString("password", "");
        }
    }

    private void setupButtonListeners() {
        mPrint.setOnClickListener(mView -> {
            playClickSound();
            showPreviewDialog("Cetak Struk Member", receiptContent);
        });

        mScan.setOnClickListener(mView -> {
            playClickSound();
            browseBluetoothDevice();
        });
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

    // --- GENERATE STRUK CONTENT ---
    private void generateReceiptContent() {
        SimpleDateFormat sdf = new SimpleDateFormat("dd-MM-yyyy HH:mm", Locale.getDefault());
        String waktuSekarang = sdf.format(new Date());

        StringBuilder sb = new StringBuilder();

        // Header
        sb.append("[C]<b>SPBU ").append(spbu).append("</b>\n");
        sb.append("[C]").append(alamat2).append("\n");
        sb.append("[C]--------------------------------\n");
        sb.append("[C]<b>REGISTRASI MEMBER BARU</b>\n");
        sb.append("[C]--------------------------------\n");

        // Data Member
        sb.append("[L]Nama      : <b>").append(nama).append("</b>\n");
        sb.append("[L]Alamat    : ").append(alamat).append("\n");
        sb.append("[L]Kelamin   : ").append(jenis_kelamin).append("\n");
        sb.append("[L]Tgl Lahir : ").append(tanggal_lahir).append("\n");
        sb.append("[L]Kategori  : ").append(kategori_member).append("\n");
//        sb.append("[L]Pekerjaan : ").append(pekerjaan).append("\n");
//        sb.append("[L]Agama     : ").append(agama).append("\n");
        sb.append("[L]SPBU      : ").append(spbu_member).append("\n");

        // Data Login
        sb.append("[C]--------------------------------\n");
        sb.append("[L]Username  : <b>").append(username).append("</b>\n");
        sb.append("[L]Password  : <b>").append(password).append("</b>\n");

        // Footer
        sb.append("[C]--------------------------------\n");
        sb.append("[C]Simpan struk ini baik-baik\n");
        sb.append("[C]Jangan berikan password ke\n");
        sb.append("[C]pihak lain\n");
        sb.append("[C]Terima Kasih\n");
        sb.append("\n\n");

        receiptContent = sb.toString();
    }

    // --- DIALOG PREVIEW ---
    private void showPreviewDialog(String title, String contentText) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();

        View dialogView = inflater.inflate(R.layout.dialog_print_preview, null);
        builder.setView(dialogView);

        // Init View
        ImageView imgLogo = dialogView.findViewById(R.id.img_preview_logo);
        TextView txtContent = dialogView.findViewById(R.id.txt_preview_receipt);
        CardView btnCetak = dialogView.findViewById(R.id.btn_cetak_card);
        TextView txtLabelCetak = dialogView.findViewById(R.id.txt_cetak);
        CardView btnSelesai = dialogView.findViewById(R.id.btn_selesai_card);

        // Set Data
        imgLogo.setImageResource(currentLogoId);

        // Untuk preview di layar, hilangkan tag format
        String previewText = contentText
                .replace("[L]", "")
                .replace("[C]", "")
                .replace("[R]", "")
                .replace("<b>", "")
                .replace("</b>", "");

        txtContent.setText(previewText);
        txtLabelCetak.setText("CETAK");

        // Create Dialog
        AlertDialog dialog = builder.create();

        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        // Logic Tombol CETAK
        btnCetak.setOnClickListener(v -> {
            dialog.dismiss();
            cetakStrukMember(contentText);
        });

        // Logic Tombol SELESAI
        btnSelesai.setOnClickListener(v -> {
            dialog.dismiss();
            askTransactionAgain();
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    // --- LOGIKA CETAK ---
    public void cetakStrukMember(String formattedContent) {
        if (selectedDevice == null) {
            showPrinterErrorDialog();
            return;
        }

        mBluetoothConnectProgressDialog = ProgressDialog.show(this,
                "Printing...", "Sedang mencetak...", true, false);

        new Thread(() -> {
            try {
                EscPosPrinter printer = new EscPosPrinter(selectedDevice, 203, 48f, 32);

                // Tambahkan Logo + Content
                String finalPrintText = "[C]<img>" +
                        PrinterTextParserImg.bitmapToHexadecimalString(printer,
                                getApplicationContext().getResources()
                                        .getDrawableForDensity(currentLogoId, DisplayMetrics.DENSITY_MEDIUM)) +
                        "</img>\n\n" + formattedContent;

                printer.printFormattedText(finalPrintText);

                runOnUiThread(() -> {
                    if (mBluetoothConnectProgressDialog != null)
                        mBluetoothConnectProgressDialog.dismiss();
                    Toast.makeText(print_member.this,
                            "Cetak selesai.", Toast.LENGTH_SHORT).show();
                    askTransactionAgain();
                });

            } catch (Exception e) {
                e.printStackTrace();
                handlePrinterError(e);
            }
        }).start();
    }

    private void handlePrinterError(Exception e) {
        runOnUiThread(() -> {
            if (mBluetoothConnectProgressDialog != null)
                mBluetoothConnectProgressDialog.dismiss();

            String msg = "Printer Error";
            if(e instanceof EscPosConnectionException) msg = "Koneksi Printer Putus!";
            else if(e instanceof EscPosParserException) msg = "Format Teks Salah!";
            else if(e instanceof EscPosEncodingException) msg = "Encoding Error!";
            else if(e instanceof EscPosBarcodeException) msg = "Barcode Error!";

            Toast.makeText(print_member.this, msg, Toast.LENGTH_LONG).show();
            updatePrinterStatus("Disconnected", Color.RED);
        });
    }

    private void showPrinterErrorDialog() {
        runOnUiThread(() -> {
            AlertDialog.Builder builder = new AlertDialog.Builder(print_member.this);
            builder.setTitle("Printer")
                    .setMessage("Silahkan Pilih Printer")
                    .setCancelable(false)
                    .setPositiveButton("OK", (dialog, id) -> dialog.dismiss())
                    .setNegativeButton("Pilih Printer",
                            (dialog, which) -> browseBluetoothDevice());

            AlertDialog alert = builder.create();
            alert.show();
            updatePrinterStatus("Disconnected", Color.RED);
        });
    }

    private void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList =
                (new BluetoothPrintersConnections()).getList();

        if (bluetoothDevicesList == null || bluetoothDevicesList.length == 0) {
            runOnUiThread(() -> {
                AlertDialog.Builder builder = new AlertDialog.Builder(print_member.this);
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
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(print_member.this);
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

    private void askTransactionAgain() {
        showCustomCardDialog(
                "Pendaftaran Selesai",
                "Apakah ingin mendaftarkan member baru lagi?",
                "Ya",
                "Tidak",
                () -> { // Aksi Jika YA
                    Intent intent = new Intent(print_member.this, data_member_tambah.class);
                    intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(intent);
                    finish();
                },
                () -> { // Aksi Jika TIDAK
                    setResult(RESULT_OK);
                    Intent intent = new Intent(print_member.this, home_activity.class);
                    intent.setFlags(FLAG_ACTIVITY_NEW_TASK | FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(intent);
                    finish();
                }
        );
    }

    // --- HELPER: DIALOG DENGAN CARD BUTTONS ---
    private void showCustomCardDialog(String title, String message,
                                      String posText, String negText, Runnable onPositive, Runnable onNegative) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = getLayoutInflater();

        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();

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
    protected void onDestroy() {
        if (mpClick != null) {
            mpClick.release();
        }
        if (mBluetoothConnectProgressDialog != null &&
                mBluetoothConnectProgressDialog.isShowing()) {
            mBluetoothConnectProgressDialog.dismiss();
        }
        super.onDestroy();
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        setResult(RESULT_OK);
        finish();
    }

    @Override
    public void run() {
        // Implementation for Runnable interface if needed
    }
}