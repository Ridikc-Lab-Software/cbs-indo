package com.project.aplikasi.petugas_cbs.data_transaksi;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.text.Html;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.combobox_data_petugas.combobox_data_petugas_apidata;
import com.project.aplikasi.petugas_cbs.combobox_data_petugas.combobox_data_petugas_apiservice;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_apiutils;

import java.text.NumberFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

public class data_transaksi_tambah extends AppCompatActivity {

    private ProgressDialog progressDialog;


    private static final int PERMISSION_BLUETOOTH = 1;
    String validasi;
    Button tombol_simpan;
    data_transaksi_apiservice mAPIService;
    EditText id_transaksi
            ,tanggal
            ,jam
            ,id_member
            ,id_petugas
            ,id_kategori_member
            ,id_jenis_transaksi
            ,point
            ,jumlah
            ;

    String s_id_transaksi
            ,s_tanggal
            ,s_jam
            ,s_id_member
            ,s_id_kategori_member
            ,s_id_jenis_transaksi
            ,s_jumlah // Ini akan berisi data mentah untuk API (String)
            ,s_nama
            ,s_point_awal
            ,s_tambahan_point
            ,s_harga_perliter
            ,s_kategori_transaksi
            ,s_maksimal_transaksi
            ;
    TextView namas;
    Integer total_tambahan = 0;

    loading loading;
    config_sessionmanager config_sessionmanager;

    // Tambahan variabel global untuk data final
    private int status_nominal = 0;
    private RadioButton rb_liter, rb_rupiah;

    //Combobox
    private Spinner combobox_data_petugas_spinner;
    private View loadingOverlay;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_transaksi_tambah );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        loading = new loading(this);
        id_transaksi = (EditText) findViewById(R.id.id_transaksi);
        tanggal = (EditText) findViewById(R.id.tanggal);
        jam = (EditText) findViewById(R.id.jam);
        id_member = (EditText) findViewById(R.id.id_member);
        id_petugas = (EditText) findViewById(R.id.id_petugas);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
        point = (EditText) findViewById(R.id.point);
        jumlah = (EditText) findViewById(R.id.jumlah);
        loadingOverlay = findViewById(R.id.loading_overlay);
        hideLoading();
        namas = (TextView) findViewById(R.id.namas);

        rb_liter = findViewById(R.id.rb_liter);
        rb_rupiah = findViewById(R.id.rb_rupiah);

        // Default Status
        status_nominal = 0; // 0 = Liter, 1 = Rupiah
        rb_liter.setChecked(true);
        rb_rupiah.setChecked(false);

        //ID TRANSAKSI OTOMATIS
        id_transaksi.setText( config_global.generate_id(this,"data_transaksi") );
        s_id_transaksi = config_global.generate_id(this,"data_transaksi");
        mAPIService = data_transaksi_apiutils.getAPIService();

        config_global.init_inputTypes();
        point.setInputType(inputTypes.get(4).value);
        jumlah.setInputType(inputTypes.get(4).value);

        // TextWatcher untuk format Rupiah (Hanya aktif jika status_nominal == 1)
        jumlah.addTextChangedListener(new android.text.TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {}

            @Override
            public void afterTextChanged(android.text.Editable s) {
                if (status_nominal == 1) { // Mode Rupiah
                    jumlah.removeTextChangedListener(this);
                    try {
                        String originalString = s.toString();
                        String cleanString = originalString.replaceAll("[^\\d]", "");

                        if (!cleanString.isEmpty()) {
                            double parsed = Double.parseDouble(cleanString);
                            NumberFormat formatter = NumberFormat.getInstance(new Locale("id", "ID"));
                            String formattedString = formatter.format(parsed);

                            jumlah.setText(formattedString);
                            jumlah.setSelection(formattedString.length());
                        } else {
                            jumlah.setText("");
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                    jumlah.addTextChangedListener(this);
                }
            }
        });

        Calendar c = Calendar.getInstance();
        //TANGGAL
        SimpleDateFormat tgl = new SimpleDateFormat("yyyy-MM-dd");
        String tanggal_otomatis = tgl.format(c.getTime());
        tanggal.setText(tanggal_otomatis);
        s_tanggal = tanggal_otomatis;

        //JAM
        SimpleDateFormat jm = new SimpleDateFormat("HH:mm:ss");
        String jam_otomatis = jm.format(c.getTime());
        jam.setText(jam_otomatis);
        s_jam = jam_otomatis;

        //ID MEMBER
        Bundle bundle = getIntent().getExtras();
        if(bundle != null) {
            id_member.setText(bundle.getString("id_member"));
            s_id_member = bundle.getString("id_member");
            namas.setText(Html.fromHtml(bundle.getString("jenis_transaksi")));

            id_jenis_transaksi.setText(bundle.getString("id_jenis_transaksi"));
            s_id_jenis_transaksi = bundle.getString("id_jenis_transaksi");

            id_kategori_member.setText(bundle.getString("id_kategori_member"));
            s_id_kategori_member = bundle.getString("id_kategori_member");

            s_nama = bundle.getString("nama");
            s_point_awal = bundle.getString("point");
            s_tambahan_point = bundle.getString("tambahan_point");

            s_harga_perliter = bundle.getString("harga_perliter");
            s_maksimal_transaksi = bundle.getString("maksimal_transaksi");
        }

        //ID PETUGAS
        config_sessionmanager = new config_sessionmanager(data_transaksi_tambah.this);
        id_petugas.setVisibility(View.GONE);
        findViewById(R.id.combo_data_petugas).setVisibility(View.GONE);

        id_petugas.setText(new config_global().capitalize(config_sessionmanager.getSPToken()));
        tampil_combobox_data_petugas(id_petugas.getText().toString());


        // --- LOGIKA KLIK TOMBOL SIMPAN ---
        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final MediaPlayer mp = MediaPlayer.create(data_transaksi_tambah.this, R.raw.click);
                mp.start();

                id_transaksi.setText(config_global.generate_id(data_transaksi_tambah.this, "data_transaksi"));

                validasi = "berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));

                if (validasi.equals("gagal")) {
                    Toast.makeText(data_transaksi_tambah.this, "Gagal Proses, Ada data Yang Masih Kosong.", Toast.LENGTH_LONG).show();
                    return;
                }

                // 1. Ambil Data Numerik (Harga & Input)
                long hargaPerLiter = 0;
                long maksimalLiter = 0;
                long tambahanPointPerUnit = 0;

                try {
                    hargaPerLiter = Long.parseLong(s_harga_perliter);
                    maksimalLiter = Long.parseLong(s_maksimal_transaksi);
                    tambahanPointPerUnit = Long.parseLong(s_tambahan_point);
                } catch (Exception e) {
                    Toast.makeText(data_transaksi_tambah.this, "Error Data Config (Harga/Max)", Toast.LENGTH_SHORT).show();
                    return;
                }

                // Ambil input user (bersihkan dari titik/koma)
                String cleanInput = jumlah.getText().toString().replaceAll("[^0-9]", "");
                if (cleanInput.isEmpty()) cleanInput = "0";

                long inputUser = Long.parseLong(cleanInput);

                // Variabel untuk Modal
                long totalRupiah = 0;
                double totalLiter = 0;

                // 2. Logika Validasi Bisnis & Hitung Point
                if (status_nominal == 1) {
                    // --- MODE RUPIAH ---
                    s_kategori_transaksi = "rupiah";

                    // Input User adalah Rupiah
                    totalRupiah = inputUser;

                    // Cek Min (Minimal 1 Liter harganya)
                    if (totalRupiah < hargaPerLiter) {
                        tampilkanAlertValidasiGagal("Nominal Kurang!",
                                "Minimal transaksi adalah setara 1 Liter.\n" +
                                        "Harga per liter: Rp " + formatRupiah(hargaPerLiter) + "\n\n" +
                                        "Anda memasukkan: Rp " + formatRupiah(totalRupiah));
                        return;
                    }

                    // Hitung Liter (Pakai double untuk presisi display)
                    totalLiter = (double) totalRupiah / hargaPerLiter;

                    // Cek Max (Melebihi Kuota Member?)
                    if (totalLiter > maksimalLiter) {
                        tampilkanAlertValidasiGagal("Melebihi Batas Kuota!",
                                "Sisa Kuota Member: " + maksimalLiter + " Liter.\n\n" +
                                        "Nominal Rp " + formatRupiah(totalRupiah) + " setara dengan ± " +
                                        String.format(new Locale("en", "US"), "%.2f", totalLiter) + " Liter.\n\n" +
                                        "Silakan input ulang nominal yang lebih kecil.");
                        return;
                    }

                    // Hitung Point
                    total_tambahan = (int) (totalLiter * tambahanPointPerUnit);
                    s_jumlah = cleanInput;

                } else {
                    // --- MODE LITER ---
                    s_kategori_transaksi = "liter";

                    // Input User adalah Liter
                    long inputLiter = inputUser;

                    // Cek Min
                    if (inputLiter < 1) {
                        tampilkanAlertValidasiGagal("Jumlah Kurang!",
                                "Minimal transaksi adalah 1 Liter.\n" +
                                        "Anda memasukkan: " + inputLiter + " Liter");
                        return;
                    }

                    // Cek Max
                    if (inputLiter > maksimalLiter) {
                        tampilkanAlertValidasiGagal("Melebihi Batas Kuota!",
                                "Sisa Kuota Member saat ini hanya: " + maksimalLiter + " Liter.\n\n" +
                                        "Anda mencoba input: " + inputLiter + " Liter.\n" +
                                        "Silakan input ulang sesuai sisa kuota.");
                        return;
                    }

                    totalLiter = inputLiter;
                    totalRupiah = inputLiter * hargaPerLiter;
                    total_tambahan = (int) (inputLiter * tambahanPointPerUnit);
                    s_jumlah = cleanInput;
                }

                // 3. Tampilkan Dialog Konfirmasi
                tampilkanKonfirmasiAkhir(totalRupiah, totalLiter, status_nominal);
            }
        });
    }

    // --- METHOD UNTUK MENAMPILKAN MODAL KONFIRMASI ---
    private void tampilkanKonfirmasiAkhir(long nominalRupiah, double jumlahLiter, int modeInput) {
        String sLiter = String.format(new Locale("en", "US"), "%.2f", jumlahLiter);
        if (sLiter.endsWith(".00")) sLiter = sLiter.replace(".00", "");

        String pesan;
        if (modeInput == 0) { // Input Liter
            pesan = "Pastikan data berikut benar:\n\n" +
                    "Input: " + sLiter + " Liter\n" +
                    "Bayar: Rp " + formatRupiah(nominalRupiah);
        } else { // Input Rupiah
            pesan = "Pastikan data berikut benar:\n\n" +
                    "Input: Rp " + formatRupiah(nominalRupiah) + "\n" +
                    "Dapat: ± " + sLiter + " Liter";
        }

        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        txtTitle.setText("Konfirmasi Transaksi");
        txtMessage.setText(pesan);
        txtPos.setText("YA, PROSES");
        txtNeg.setText("BATAL");

        btnPos.setOnClickListener(v -> {
            dialog.dismiss();
            prosesSimpanAPI();
        });

        btnNeg.setOnClickListener(v -> dialog.dismiss());
        dialog.setCancelable(false);
        dialog.show();
    }


    private void showLoading() {
        loadingOverlay.setVisibility(View.VISIBLE);
    }

    private void hideLoading() {
        loadingOverlay.setVisibility(View.GONE);
    }

    // --- METHOD KIRIM KE API (Dipanggil setelah klik YA) ---
    private void prosesSimpanAPI() {
        showLoading();

                    String token = "Bearer " + new config_global().ambil(data_transaksi_tambah.this);

                    Log.e("API_DEBUG", "id_transaksi       : " + s_id_transaksi);
                    Log.e("API_DEBUG", "jumlah (dikirim)   : " + s_jumlah);
                    Log.e("API_DEBUG", "total_tambahan     : " + total_tambahan);
                    Log.e("API_DEBUG", "kategori           : " + s_kategori_transaksi);

                    mAPIService.proses_simpan_data_transaksi(
                            s_id_transaksi,
                            s_tanggal,
                            s_jam,
                            s_id_member,
                            id_petugas.getText().toString().toUpperCase(),
                            s_id_kategori_member,
                            s_id_jenis_transaksi,
                            total_tambahan.toString(),
                            s_jumlah, // Mengirim inputan user (entah itu rupiah atau liter, sesuai textfield)
                            token
                    ).enqueue(new Callback<Object>() {
                        @Override
                        public void onResponse(Call<Object> call, Response<Object> response) {
                            hideLoading();

                            if (response.isSuccessful()) {
                                setResult(RESULT_OK);

                                // PRINT
                                Intent intent = new Intent(data_transaksi_tambah.this, print_transaksi.class);
                                Bundle bundle = new Bundle();
                                bundle.putString("id_transaksi", s_id_transaksi);
                                bundle.putString("tanggal", s_tanggal);
                                bundle.putString("jam", s_jam);
                                bundle.putString("id_member", s_id_member);
                                bundle.putString("id_petugas", id_petugas.getText().toString());
                                bundle.putString("petugas", (String) combobox_data_petugas_spinner.getSelectedItem());
                                bundle.putString("kategori_member", s_id_kategori_member);
                                bundle.putString("jenis_transaksi", s_id_jenis_transaksi);
                                bundle.putString("point_awal", s_point_awal);

                                Integer total_keseluruhan = total_tambahan + Integer.parseInt(s_point_awal);
                                bundle.putString("point", String.valueOf(total_keseluruhan));
                                bundle.putString("kategori", s_kategori_transaksi);
                                bundle.putString("jumlah", s_jumlah); // Kirim apa yang diinput user
                                bundle.putString("nama", s_nama);
                                bundle.putString("tambahan_point", String.valueOf(total_tambahan));

                                intent.putExtras(bundle);
                                tampilkanDialogCetak();
                            } else {
                                Toast.makeText(data_transaksi_tambah.this, "Gagal Response: " + response.code(), Toast.LENGTH_SHORT).show();
                            }
                        }

                        @Override
                        public void onFailure(Call<Object> call, Throwable t) {
                            hideLoading();
                            Toast.makeText(data_transaksi_tambah.this, "Koneksi Gagal: " + t.getMessage(), Toast.LENGTH_LONG).show();
                        }
                    });



    }

    // Helper Dialog Error
    private void tampilkanAlertError(String judul, String pesan) {
        new AlertDialog.Builder(this)
                .setTitle(judul)
                .setMessage(pesan)
                .setIcon(android.R.drawable.ic_dialog_alert)
                .setPositiveButton("OK", null)
                .show();
    }

    // Helper Format Rupiah
    private String formatRupiah(long angka) {
        NumberFormat formatRupiah = NumberFormat.getInstance(new Locale("in", "ID"));
        return formatRupiah.format(angka);
    }

    public void validasiForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                if(!TextUtils.isEmpty(((EditText)view).getText().toString()))  {
                }  else  {
                    validasi = "gagal";
                    ((EditText)view).setError("Silahkan Input Terlebih Dahulu");
                    ((EditText)view).requestFocus();
                }
            }
            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                validasiForm((ViewGroup)view);
        }
    }

    public void tampil_combobox_data_petugas(String namaPetugas) {
        Spinner spinnerPetugas = (Spinner) findViewById(R.id.combo_data_petugas);
        combobox_data_petugas_spinner = spinnerPetugas;
        java.util.List<String> singleList = new java.util.ArrayList<>();
        singleList.add(namaPetugas);
        android.widget.ArrayAdapter<String> adapter = new android.widget.ArrayAdapter<>(
                this,
                android.R.layout.simple_spinner_item,
                singleList
        );
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerPetugas.setAdapter(adapter);
        spinnerPetugas.setEnabled(false);
        spinnerPetugas.setSelection(0);
    }

    public void onRadioButtonClicked(View view) {
        final MediaPlayer mp = MediaPlayer.create(data_transaksi_tambah.this, R.raw.click);
        mp.start();

        jumlah.setText("");
        jumlah.setError(null);

        if(rb_rupiah.isChecked()){
            status_nominal = 1;
        }
        else {
            status_nominal = 0;
        }
    }

    private void tampilkanAlertValidasiGagal(String judul, String pesan) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);

        // Hide Negative Buttons
        dialogView.findViewById(R.id.txt_negative).setVisibility(View.GONE);
        dialogView.findViewById(R.id.btn_negative_card).setVisibility(View.GONE);

        txtTitle.setText(judul);
        txtMessage.setText(pesan);
        txtPos.setText("INPUT ULANG");

        btnPos.setOnClickListener(v -> {
            dialog.dismiss();
            jumlah.setText("");
            jumlah.requestFocus();
        });
        dialog.setCancelable(false);
        dialog.show();
    }

    private void tampilkanDialogCetak() {
        // 1. Setup Builder & Layout Custom
        AlertDialog.Builder builder = new AlertDialog.Builder(data_transaksi_tambah.this);
        LayoutInflater inflater = getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        // 2. Buat Dialog & Set Background Transparan (PENTING)
        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        // 3. Binding View dari Layout Custom
        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        // 4. Set Teks untuk Dialog Ini
        txtTitle.setText("Transaksi Berhasil");
        txtMessage.setText("Data berhasil disimpan. Apakah Anda ingin mencetak struk transaksi ini?");
        txtPos.setText("CETAK STRUK");
        txtNeg.setText("TIDAK");

        // 5. Logic Tombol Positif (CETAK STRUK)
        btnPos.setOnClickListener(v -> {
            dialog.dismiss();

            // --- MULAI COPY LOGIC LAMA ANDA ---
            Intent intent = new Intent(data_transaksi_tambah.this, print_transaksi.class);
            Bundle bundle = new Bundle();

            bundle.putString("id_transaksi", s_id_transaksi);
            bundle.putString("tanggal", s_tanggal);
            bundle.putString("jam", s_jam);
            bundle.putString("id_member", s_id_member);
            bundle.putString("id_petugas", id_petugas.getText().toString());

            // Sedikit safety check jika spinner null
            if (combobox_data_petugas_spinner != null && combobox_data_petugas_spinner.getSelectedItem() != null) {
                bundle.putString("petugas", (String) combobox_data_petugas_spinner.getSelectedItem());
            } else {
                bundle.putString("petugas", id_petugas.getText().toString());
            }

            bundle.putString("kategori_member", s_id_kategori_member);
            bundle.putString("jenis_transaksi", s_id_jenis_transaksi);
            bundle.putString("point_awal", s_point_awal);

            // Hitung total point baru (dengan try-catch agar aman)
            try {
                Integer total_keseluruhan = total_tambahan + Integer.parseInt(s_point_awal);
                bundle.putString("point", String.valueOf(total_keseluruhan));
            } catch (NumberFormatException e) {
                bundle.putString("point", "0");
            }

            bundle.putString("kategori", s_kategori_transaksi);
            bundle.putString("jumlah", s_jumlah);
            bundle.putString("nama", s_nama);
            bundle.putString("tambahan_point", String.valueOf(total_tambahan));

            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
            intent.putExtras(bundle);
            startActivity(intent);

            // Tutup halaman tambah
            finish();
            // --- AKHIR LOGIC LAMA ---
        });

        // 6. Logic Tombol Negatif (TUTUP)
        btnNeg.setOnClickListener(v -> {
            dialog.dismiss();
            finish(); // Hanya tutup halaman tambah
        });

        // 7. Tampilkan
        dialog.setCancelable(false);
        dialog.show();
    }



}