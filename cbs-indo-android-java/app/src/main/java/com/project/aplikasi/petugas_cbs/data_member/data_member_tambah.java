package com.project.aplikasi.petugas_cbs.data_member;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Set;

import com.dantsu.escposprinter.EscPosPrinter;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothConnection;
import com.dantsu.escposprinter.exceptions.EscPosConnectionException;
import com.dantsu.escposprinter.textparser.PrinterTextParserImg;
import com.google.gson.Gson;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;

// Import Kategori
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.data_kategori_member.data_kategori_member_api;
import com.project.aplikasi.petugas_cbs.data_kategori_member.data_kategori_member_apidata;
import com.project.aplikasi.petugas_cbs.data_kategori_member.data_kategori_member_apiservice;
import com.project.aplikasi.petugas_cbs.data_kategori_member.data_kategori_member_apiutils;

// Import Pekerjaan
import com.project.aplikasi.petugas_cbs.data_pekerjaan.data_pekerjaan_api;
import com.project.aplikasi.petugas_cbs.data_pekerjaan.data_pekerjaan_apidata;
import com.project.aplikasi.petugas_cbs.data_pekerjaan.data_pekerjaan_apiservice;
import com.project.aplikasi.petugas_cbs.data_pekerjaan.data_pekerjaan_apiutils;

// Import SPBU
import com.project.aplikasi.petugas_cbs.data_spbu.data_spbu_api;
import com.project.aplikasi.petugas_cbs.data_spbu.data_spbu_apidata;
import com.project.aplikasi.petugas_cbs.data_spbu.data_spbu_apiservice;
import com.project.aplikasi.petugas_cbs.data_spbu.data_spbu_apiutils;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import java.util.Random;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

import org.json.JSONException;
import org.json.JSONObject;

public class data_member_tambah extends AppCompatActivity {

    private static final int REQUEST_ENABLE_BT = 1;
    private static final int REQUEST_BLUETOOTH_PERMISSIONS = 2;

    String validasi;

    // Variabel Penampung Nilai Terpilih
    String selectedJenisKelamin = "";
    String selectedIdKategoriMember = "";
    String selectedAgama = "";
    String selectedIdPekerjaan = "";
    String selectedIdSpbu = "";

    Button tombol_simpan;
    loading loading;

    // Services
    data_member_apiservice mAPIService;
    data_kategori_member_apiservice mAPIServiceKategori;
    data_pekerjaan_apiservice mAPIServicePekerjaan;
    data_spbu_apiservice mAPIServiceSpbu;

    EditText id_member, nama, alamat, no_telepon, tanggal_terdaftar, kode_rfid, point, username, password, tanggal_lahir;

    // UBAH TIPE DATA MENJADI AutoCompleteTextView
    AutoCompleteTextView spinner_jenis_kelamin, spinner_kategori_member, spinner_agama, spinner_pekerjaan, spinner_spbu;

    // List Data untuk Spinner Dynamic
    List<data_kategori_member_apidata> listKategori = new ArrayList<>();
    List<data_pekerjaan_apidata> listPekerjaan = new ArrayList<>();
    List<data_spbu_apidata> listSpbu = new ArrayList<>();

    // Calendar untuk DatePicker
    Calendar myCalendar;

    config_sessionmanager config_sessionmanager;
    private ProgressDialog progressDialogPrint;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_member_tambah );

        loading = new loading(this);
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        config_sessionmanager = new config_sessionmanager(this);

        // Inisialisasi View
        id_member = (EditText) findViewById(R.id.id_member);
        nama = (EditText) findViewById(R.id.nama);
        alamat = (EditText) findViewById(R.id.alamat);
        tanggal_lahir = (EditText) findViewById(R.id.tanggal_lahir);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        tanggal_terdaftar = (EditText) findViewById(R.id.tanggal_terdaftar);
        kode_rfid = (EditText) findViewById(R.id.kode_rfid);
        point = (EditText) findViewById(R.id.point);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);

        // Inisialisasi AutoCompleteTextView (Pengganti Spinner)
        spinner_jenis_kelamin = findViewById(R.id.jenis_kelamin);
        spinner_kategori_member = findViewById(R.id.id_kategori_member);
        spinner_agama = findViewById(R.id.agama);
        spinner_pekerjaan = findViewById(R.id.id_pekerjaan);
        spinner_spbu = findViewById(R.id.id_spbu);

        // Setup Awal
        id_member.setText( config_global.generate_id(this,"data_member") );
        id_member.setVisibility(View.GONE);

        // Inisialisasi Service API
        mAPIService = data_member_apiutils.getAPIService();
        mAPIServiceKategori = data_kategori_member_apiutils.getAPIService();
        mAPIServicePekerjaan = data_pekerjaan_apiutils.getAPIService();
        mAPIServiceSpbu = data_spbu_apiutils.getAPIService();

        config_global.init_inputTypes();
        point.setInputType(inputTypes.get(4).value);
        point.setText("0");
        point.setVisibility(View.GONE);

        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd", Locale.getDefault());
        String currentDateTime = dateFormat.format(new Date());
        tanggal_terdaftar.setText(currentDateTime);
        tanggal_terdaftar.setVisibility(View.GONE);

        kode_rfid.setText("0");
        kode_rfid.setVisibility(View.GONE);
        password.setText(generateRandomPassword(6));

        // --- 1. SETUP DATE PICKER (TANGGAL LAHIR) ---
        myCalendar = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear,
                                  int dayOfMonth) {
                myCalendar.set(Calendar.YEAR, year);
                myCalendar.set(Calendar.MONTH, monthOfYear);
                myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                updateLabelTanggalLahir();
            }
        };

        tanggal_lahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new DatePickerDialog(data_member_tambah.this, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show();
            }
        });

        // --- 2. SETUP DATA STATIS (KELAMIN & AGAMA) ---
        List<String> jenisKelaminList = new ArrayList<>();
        jenisKelaminList.add("Pilih Jenis Kelamin");
        jenisKelaminList.add("Laki-laki");
        jenisKelaminList.add("Perempuan");
        setupSimpleSpinner(spinner_jenis_kelamin, jenisKelaminList, "kelamin");

        List<String> agamaList = new ArrayList<>();
        agamaList.add("Pilih Agama");
        agamaList.add("Islam");
        agamaList.add("Kristen Katolik");
        agamaList.add("Kristen Protestan");
        agamaList.add("Hindu");
        agamaList.add("Budha");
        setupSimpleSpinner(spinner_agama, agamaList, "agama");

        // --- 4. LOAD DATA DARI API ---
        fetch_data_kategori_member();
        fetch_data_pekerjaan();
        fetch_data_spbu();

        // --- 5. LOGIKA USERNAME AUTO FILL ---
        no_telepon.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                username.setText(s.toString());
            }
            @Override
            public void afterTextChanged(Editable s) {}
        });

        // --- 6. TOMBOL SIMPAN ---
        tombol_simpan.setOnClickListener(v -> {
            loading.showDialog(1,"Please Wait","Proses Simpan Data..");

            id_member.setText(config_global.generate_id(this,"data_member"));
            validasi ="berhasil";

            validasiForm((ViewGroup) findViewById(R.id.group));
            checkSpinnerValidation();

            if (validasi.equals("gagal")) {
                loading.hideDialog();
                Toast.makeText(this, "Gagal Proses, Ada data Yang Masih Kosong.", Toast.LENGTH_LONG).show();
                return;
            }

            // 🔥 KHUSUS TANGGAL LAHIR
            if (TextUtils.isEmpty(tanggal_lahir.getText().toString())) {
                showTanggalLahirConfirmDialog(() -> prosesSimpanData());
            } else {
                prosesSimpanData();
            }
        });

    }

    // --- HELPER METHODS ---

    private void updateLabelTanggalLahir() {
        String myFormat = "yyyy-MM-dd";
        SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.US);
        tanggal_lahir.setText(sdf.format(myCalendar.getTime()));
    }

    // PERBAIKAN 1: Method untuk data Statis (Kelamin & Agama)
    private void setupSimpleSpinner(AutoCompleteTextView textView, List<String> data, final String type) {
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_dropdown_item_1line, data);
        textView.setAdapter(adapter);

        // Gunakan OnItemClickListener untuk AutoCompleteTextView
        textView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                String value = parent.getItemAtPosition(position).toString();

                // Logic: Jika pilih index 0 ("Pilih..."), kosongkan value
                if(position == 0){
                    if (type.equals("kelamin")) selectedJenisKelamin = "";
                    else if (type.equals("agama")) selectedAgama = "";
                } else {
                    if (type.equals("kelamin")) selectedJenisKelamin = value;
                    else if (type.equals("agama")) selectedAgama = value;
                }
            }
        });
    }

    // PERBAIKAN 2: Method untuk data API (Kategori, Pekerjaan, SPBU)
    private void setSpinnerAdapter(AutoCompleteTextView textView, List<String> data, final String type) {
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_dropdown_item_1line, data);
        textView.setAdapter(adapter);

        // Gunakan OnItemClickListener untuk AutoCompleteTextView
        textView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                // Logic Mapping ID berdasarkan posisi
                // Index 0 adalah "Pilih...", jadi Data asli mulai dari Index - 1

                if (position > 0) {
                    if (type.equals("kategori")) selectedIdKategoriMember = listKategori.get(position - 1).get_id_kategori_member();
                    else if (type.equals("pekerjaan")) selectedIdPekerjaan = listPekerjaan.get(position - 1).get_nama();
                    else if (type.equals("spbu")) selectedIdSpbu = listSpbu.get(position - 1).get_nama_spbu();
                } else {
                    // Jika user memilih "Pilih Kategori...", kosongkan ID
                    if (type.equals("kategori")) selectedIdKategoriMember = "";
                    else if (type.equals("pekerjaan")) selectedIdPekerjaan = "";
                    else if (type.equals("spbu")) selectedIdSpbu = "";
                }
            }
        });
    }

    private String generateRandomPassword(int length) {
        String chars = "0123456789";
        Random random = new Random();
        StringBuilder password = new StringBuilder();
        for (int i = 0; i < length; i++) {
            password.append(chars.charAt(random.nextInt(chars.length())));
        }
        return password.toString();
    }

    // --- API FETCHING METHODS ---

    // 1. Kategori Member
    public void fetch_data_kategori_member(){
        String token = new config_global().ambil(this);
        mAPIServiceKategori.tampil_data_kategori_member("", "", "","","","", "Bearer "+token).enqueue(new Callback<data_kategori_member_api>() {
            @Override
            public void onResponse(Call<data_kategori_member_api> call, Response<data_kategori_member_api> response) {
                if (response.body() != null && response.body().get_data_kategori_member() != null) {
                    listKategori = response.body().get_data_kategori_member();
                    List<String> spinnerList = new ArrayList<>();
                    spinnerList.add("Pilih Kategori Member");
                    for (data_kategori_member_apidata item : listKategori) {
                        spinnerList.add(item.get_kategori_member());
                    }
                    setSpinnerAdapter(spinner_kategori_member, spinnerList, "kategori");
                }
            }
            @Override
            public void onFailure(Call<data_kategori_member_api> call, Throwable t) {
                Log.e("CHECK_URL_KATEGORI", "ERROR");
            }
        });
    }

    // 2. Pekerjaan
    public void fetch_data_pekerjaan(){
        mAPIServicePekerjaan.tampil_data_pekerjaan().enqueue(new Callback<data_pekerjaan_api>() {
            @Override
            public void onResponse(Call<data_pekerjaan_api> call, Response<data_pekerjaan_api> response) {
                if (response.isSuccessful() && response.body() != null) {
                    if(response.body().get_data_pekerjaan() != null){
                        listPekerjaan = response.body().get_data_pekerjaan();
                        List<String> spinnerList = new ArrayList<>();
                        spinnerList.add("Pilih Pekerjaan");
                        for (data_pekerjaan_apidata item : listPekerjaan) {
                            spinnerList.add(item.get_nama());
                        }
                        setSpinnerAdapter(spinner_pekerjaan, spinnerList, "pekerjaan");
                    }
                }
            }
            @Override
            public void onFailure(Call<data_pekerjaan_api> call, Throwable t) {
                Log.e("CHECK_URL_PEKERJAAN", "ERROR");
            }
        });
    }

    // 3. SPBU
    public void fetch_data_spbu(){
        mAPIServiceSpbu.tampil_data_spbu().enqueue(new Callback<data_spbu_api>() {
            @Override
            public void onResponse(Call<data_spbu_api> call, Response<data_spbu_api> response) {
                if (response.isSuccessful() && response.body() != null) {
                    if (response.body().get_data_spbu() != null) {
                        listSpbu = response.body().get_data_spbu();
                        List<String> spinnerList = new ArrayList<>();
                        spinnerList.add("Pilih SPBU");
                        for (data_spbu_apidata item : listSpbu) {
                            spinnerList.add(item.get_nama_spbu());
                        }
                        setSpinnerAdapter(spinner_spbu, spinnerList, "spbu");
                    }
                }
            }
            @Override
            public void onFailure(Call<data_spbu_api> call, Throwable t) {
                Log.e("CHECK_URL_SPBU", "ERROR");
            }
        });
    }

    // --- VALIDATION & RESET ---

    public void validasiForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);

            if (view instanceof EditText) {

                // 🔥 SKIP VALIDASI WAJIB UNTUK TANGGAL LAHIR
                if (view.getId() == R.id.tanggal_lahir) {
                    continue;
                }

                if (!TextUtils.isEmpty(((EditText) view).getText().toString())) {
                    // OK
                } else {
                    validasi = "gagal";
                    ((EditText) view).setError("Silahkan Input Terlebih Dahulu");
                }
            }

            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0)) {
                validasiForm((ViewGroup) view);
            }
        }
    }

    private void checkSpinnerValidation() {
        if (TextUtils.isEmpty(selectedIdKategoriMember)) validasi = "gagal";
        if (TextUtils.isEmpty(selectedJenisKelamin)) validasi = "gagal";
        if (TextUtils.isEmpty(selectedAgama)) validasi = "gagal";
        if (TextUtils.isEmpty(selectedIdPekerjaan)) validasi = "gagal";
        if (TextUtils.isEmpty(selectedIdSpbu)) validasi = "gagal";
    }

    private void resetAllForm() {
        clearForm((ViewGroup) findViewById(R.id.group));
        id_member.requestFocus();

        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
        tanggal_terdaftar.setText(dateFormat.format(new Date()));

        password.setText(generateRandomPassword(8));

        // PERBAIKAN 3: Cara Reset AutoCompleteTextView (Bukan setSelection)
        spinner_kategori_member.setText(null);
        spinner_jenis_kelamin.setText(null);
        spinner_agama.setText(null);
        spinner_pekerjaan.setText(null);
        spinner_spbu.setText(null);

        // Reset Variables
        selectedIdKategoriMember = "";
        selectedJenisKelamin = "";
        selectedAgama = "";
        selectedIdPekerjaan = "";
        selectedIdSpbu = "";
    }

    private void clearForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                ((EditText)view).setText("");
            }
            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                clearForm((ViewGroup)view);
        }
    }


    private void prosesSimpanData() {
        String token = "Bearer " + new config_global().ambil(this);
        String id_admin =  new config_global().ambil(this);

        mAPIService.proses_simpan_data_member(
                id_admin, //numpang id_member
                nama.getText().toString(),
                alamat.getText().toString(),
                no_telepon.getText().toString(),
                selectedJenisKelamin,
                tanggal_terdaftar.getText().toString(),
                selectedIdKategoriMember,
                kode_rfid.getText().toString(),
                point.getText().toString(),
                username.getText().toString(),
                password.getText().toString(),
                // Field Baru
                tanggal_lahir.getText().toString(),
                selectedAgama,
                selectedIdPekerjaan,
                selectedIdSpbu,
                token
        ).enqueue(new Callback<Object>() {
            @Override
            public void onResponse(Call<Object> call, Response<Object> response) {
                loading.hideDialog();

                if (response.isSuccessful() && response.body() != null) {
                    try {
                        // Parsing JSON
                        JSONObject jsonObject = new JSONObject(new Gson().toJson(response.body()));
                        String status = jsonObject.optString("status");
                        String message = jsonObject.optString("message");

                        if (status.equals("success")) {
                            Toast.makeText(data_member_tambah.this, "Berhasil Disimpan", Toast.LENGTH_LONG).show();

                            // PERUBAHAN: Pindah ke halaman print dengan Bundle
                            Intent intent = new Intent(data_member_tambah.this, print_member.class);

                            // Kirim semua data yang dibutuhkan
                            intent.putExtra("nama", nama.getText().toString());
                            intent.putExtra("alamat", alamat.getText().toString());
                            intent.putExtra("no_telepon", no_telepon.getText().toString());
                            intent.putExtra("jenis_kelamin", selectedJenisKelamin);
                            intent.putExtra("tanggal_lahir", tanggal_lahir.getText().toString());
                            intent.putExtra("kategori_member", spinner_kategori_member.getText().toString());
                            intent.putExtra("agama", selectedAgama);
                            intent.putExtra("pekerjaan", spinner_pekerjaan.getText().toString());
                            intent.putExtra("spbu_member", spinner_spbu.getText().toString());
                            intent.putExtra("username", username.getText().toString());
                            intent.putExtra("password", password.getText().toString());

                            startActivity(intent);
                            finish();

                        } else if (status.equals("gagal") && message.contains("No telepon")) {
                            // CASE: No telepon sudah ada
                            new AlertDialog.Builder(data_member_tambah.this)
                                    .setTitle("Perhatian")
                                    .setMessage("No telepon sudah terdaftar. Silakan ubah nomor telepon terlebih dahulu.")
                                    .setPositiveButton("OK", null)
                                    .show();
                        } else {
                            // CASE: gagal lain
                            Toast.makeText(data_member_tambah.this, "Gagal: " + message, Toast.LENGTH_LONG).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(data_member_tambah.this, "Error parsing response", Toast.LENGTH_LONG).show();
                    }
                } else {
                    Toast.makeText(data_member_tambah.this, "Gagal Response Code: " + response.code(), Toast.LENGTH_LONG).show();
                }
            }


            @Override
            public void onFailure(Call<Object> call, Throwable t) {
                Toast.makeText(data_member_tambah.this, "Gagal Disimpan: " + t.getMessage(), Toast.LENGTH_LONG).show();
                loading.hideDialog();
            }
        });
    }


    private void showTanggalLahirConfirmDialog(Runnable lanjutSimpan) {
        new androidx.appcompat.app.AlertDialog.Builder(this)
                .setTitle("Tanggal Lahir Belum Diisi")
                .setMessage("Apakah Anda ingin mengisi tanggal lahir terlebih dahulu?")
                .setCancelable(false)
                .setPositiveButton("Ya, isi dulu", (dialog, which) -> {
                    tanggal_lahir.requestFocus();
                    dialog.dismiss();
                    loading.hideDialog();
                })
                .setNegativeButton("Tidak, lanjutkan simpan", (dialog, which) -> {
                    dialog.dismiss();
                    lanjutSimpan.run();
                })
                .show();
    }
}