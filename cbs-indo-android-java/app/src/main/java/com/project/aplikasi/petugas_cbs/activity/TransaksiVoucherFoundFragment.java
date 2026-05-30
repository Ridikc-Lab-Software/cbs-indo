package com.project.aplikasi.petugas_cbs.activity;

import static com.project.aplikasi.petugas_cbs.config.config_global.show_error_dialog;

import android.Manifest;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.text.Html;
import android.text.TextUtils;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter; // DITAMBAH
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.core.content.ContextCompat;
import androidx.core.content.FileProvider;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.combobox_data_supir.combobox_data_supir;
import com.project.aplikasi.petugas_cbs.combobox_data_supir.combobox_data_supir_api;
import com.project.aplikasi.petugas_cbs.combobox_data_supir.combobox_data_supir_apidata;
import com.project.aplikasi.petugas_cbs.combobox_data_supir.combobox_data_supir_apiservice;
import com.project.aplikasi.petugas_cbs.combobox_data_supir.combobox_data_supir_apiutils;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.data_plat.data_plat_apiutils;
import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_apidata;
// --- DITAMBAH: Import untuk Data Plat ---
import com.project.aplikasi.petugas_cbs.data_plat.data_plat_api;
import com.project.aplikasi.petugas_cbs.data_plat.data_plat_apidata;
import com.project.aplikasi.petugas_cbs.data_plat.data_plat_apiservice;
// Pastikan Anda membuat data_plat_apiutils atau gunakan Retrofit Client generic
// Jika tidak ada apiutils, nanti kita inisialisasi manual di bawah.
// ----------------------------------------
import com.squareup.picasso.Picasso;

import java.io.File;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TransaksiVoucherFoundFragment extends Fragment {

    private static final String TAG = "VoucherFoundFragment";
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    private data_voucher_apidata voucher;
    private String mParam2;

    int REQUEST_CODE_TAMBAH = 1;
    private View view;

    // Variabel untuk combobox supir
    private Spinner spinner_nama_supir;
    private combobox_data_supir combobox_data_supir;
    private combobox_data_supir_apiservice combobox_data_supir_mAPIService;
    private List<combobox_data_supir_apidata> combobox_data_supir_data;
    private String id_supir = "";
    private ArrayList<String> listSupirNama = new ArrayList<>();
    private ArrayList<String> listSupirId = new ArrayList<>();

    // --- DIUBAH: Variabel untuk Spinner Plat ---
    private Spinner spinner_platkendaraan; // Dulunya EditText
    private String selectedIdPlat = ""; // Untuk menyimpan ID Plat yang dipilih
    private ArrayList<String> listPlatNama = new ArrayList<>(); // List nama plat buat UI
    private ArrayList<String> listPlatId = new ArrayList<>();   // List ID plat buat Logic
    // ------------------------------------------

    // --- VARIABEL UNTUK FOTO ---
    private static final int REQUEST_CODE_FOTO = 100;
    private static final int REQUEST_CODE_KAMERA = 101;
    private static final int REQUEST_PERMISSION_CAMERA = 200;

    private String currentPhotoPath;
    private RecyclerView recyclerFoto;
    private ArrayList<Uri> listUriFoto = new ArrayList<>();
    private FotoTransaksiVoucherAdapter fotoAdapter;
    // --------------------------

    public TransaksiVoucherFoundFragment() {
        // Required empty public constructor
    }

    public static TransaksiVoucherFoundFragment newInstance(data_voucher_apidata param1, String param2) {
        TransaksiVoucherFoundFragment fragment = new TransaksiVoucherFoundFragment();
        Bundle args = new Bundle();
        args.putParcelable(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Log.d(TAG, "onCreate: Fragment created");
        getActivity().setTitle("Voucher");
        if (getArguments() != null) {
            voucher = getArguments().getParcelable(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
            Log.d(TAG, "onCreate: Voucher data received");
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        Log.d(TAG, "onCreateView: Starting to inflate view");
        view = inflater.inflate(R.layout.fragment_transaksi_voucher_found, container, false);

        // Hide loading initially
        view.findViewById(R.id.loadingIcon).setVisibility(View.GONE);
        view.findViewById(R.id.loadingText).setVisibility(View.GONE);

        // --- SETUP RECYCLERVIEW FOTO ---
        recyclerFoto = view.findViewById(R.id.recycler_foto);
        fotoAdapter = new FotoTransaksiVoucherAdapter(getActivity(), listUriFoto);
        recyclerFoto.setLayoutManager(new LinearLayoutManager(getActivity(), LinearLayoutManager.HORIZONTAL, false));
        recyclerFoto.setAdapter(fotoAdapter);

        view.findViewById(R.id.btn_pilih_foto).setOnClickListener(v -> tampilkanPilihanFoto());

        // Init Views
        TextView id_voucher = (TextView) view.findViewById(R.id.id_voucher);
        TextView qrcode = (TextView) view.findViewById(R.id.qrcode);
        TextView id_relasi = (TextView) view.findViewById(R.id.id_relasi);
        TextView nominal = (TextView) view.findViewById(R.id.nominal);
        TextView tanggal_kadaluarsa = (TextView) view.findViewById(R.id.tanggal_kadaluarsa);
        TextView id_spbu = (TextView) view.findViewById(R.id.id_spbu);
        TextView id_penjualan_voucher = (TextView) view.findViewById(R.id.id_penjualan_voucher);
        TextView status = (TextView) view.findViewById(R.id.status);
        TextView file_voucher = (TextView) view.findViewById(R.id.file_voucher);
        TextView tanggal_dibuka = (TextView) view.findViewById(R.id.tanggal_dibuka);

        // --- DIUBAH: Init Spinner Plat ---
        // Pastikan di XML tipe nya <Spinner> id nya @+id/platkendaraan
        spinner_platkendaraan = (Spinner) view.findViewById(R.id.platkendaraan);
        ImageView image = (ImageView) view.findViewById(R.id.img);

        // Set Data Text
        id_voucher.setText("" + voucher.get_id_voucher());
        qrcode.setText(Html.fromHtml("Qrcode : " + voucher.get_qrcode() + ""));
        id_relasi.setText(Html.fromHtml("Id Relasi : " + voucher.get_id_relasi() + ""));
        nominal.setText(Html.fromHtml(voucher.get_nominal_rupiah()));
        tanggal_kadaluarsa.setText(Html.fromHtml("Berlaku sampai " + voucher.get_tanggal_kadaluarsa_indo() + ""));
        id_penjualan_voucher.setText(Html.fromHtml("Id Penjualan Voucher : " + voucher.get_id_penjualan_voucher() + ""));
        status.setText(Html.fromHtml("Status : " + voucher.get_status() + ""));
        file_voucher.setText(Html.fromHtml("File Voucher : " + voucher.get_file_voucher() + ""));
        tanggal_dibuka.setText(Html.fromHtml("Tanggal Dibuka : " + voucher.get_tanggal_dibuka() + ""));

        // Logic Member Info display
        if (voucher.get_status().equalsIgnoreCase("Used")) {
            LinearLayout layout = view.findViewById(R.id.wrapper);
            layout.setGravity(Gravity.CENTER);
        }

        // Load Image Voucher
        Picasso.get().load(config_global.BASE_URL + "admin/upload/" + voucher.get_file_voucher()).into(image);

        // Handle Status UI Changes
        showStatus(voucher.get_status());

        // Panggil method untuk load combobox supir
        tampil_combobox_data_supir();

        // --- DITAMBAH: Panggil method load Plat ---
        tampil_data_plat();

        // --- TOMBOL EDIT (SIMPAN) ---
        view.findViewById(R.id.tombol_edit).setOnClickListener(view1 -> {
            Log.d(TAG, "tombol_edit clicked (Bypass Member)");

            // --- DIUBAH: Validasi menggunakan selectedIdPlat ---
            // String plat = platkendaraan.getText().toString().trim(); // HAPUS INI

            // 1. Validasi Plat (Cek apakah ID sudah terpilih)
            if (TextUtils.isEmpty(selectedIdPlat)) {
                new AlertDialog.Builder(getContext())
                        .setTitle("Nomor Plat Kendaraan")
                        .setMessage("Silahkan pilih nomor plat kendaraan terlebih dahulu.")
                        .setPositiveButton("OK", null)
                        .show();
                return;
            }

            // 2. Validasi Supir
            if (TextUtils.isEmpty(id_supir)) {
                new AlertDialog.Builder(getContext())
                        .setTitle("Nama Supir")
                        .setMessage("Nama supir wajib dipilih terlebih dahulu.")
                        .setPositiveButton("OK", null)
                        .show();
                return;
            }

            // 3. Validasi Foto (WAJIB ADA)
            if (listUriFoto.isEmpty()) {
                Toast.makeText(getContext(), "Mohon sertakan minimal 1 foto bukti", Toast.LENGTH_SHORT).show();
                return;
            }

            voucher.setPlatKendaraan(selectedIdPlat);

            ArrayList<String> fotoStringList = new ArrayList<>();
            for (Uri uri : listUriFoto) {
                fotoStringList.add(uri.toString());
            }
            voucher.setListFotoBukti(fotoStringList);

            getActivity().getSupportFragmentManager().beginTransaction()
                    .replace( // Gunakan replace agar fragment lama tidak menumpuk secara visual (berat)
                            R.id.frameLayout,
                            TransaksiVoucherJenisTransaksiFragment.newInstance(
                                    null, voucher, id_supir
                            )
                    )
                    .addToBackStack(null) // PENTING: Menambahkan ke stack agar bisa di-back
                    .commit();

        });

        // --- TOMBOL HAPUS ---
        view.findViewById(R.id.tombol_hapus).setOnClickListener(view1 -> {
            // Logicnya sama persis dengan yang di atas

            // --- DIUBAH: Validasi ID Plat ---
            if (TextUtils.isEmpty(selectedIdPlat)) {
                new AlertDialog.Builder(getContext())
                        .setTitle("Nomor Plat Kendaraan")
                        .setMessage("Silahkan pilih nomor plat kendaraan terlebih dahulu.")
                        .setPositiveButton("OK", null)
                        .show();
                return;
            }

            if (TextUtils.isEmpty(id_supir)) {
                new AlertDialog.Builder(getContext())
                        .setTitle("Nama Supir")
                        .setMessage("Nama supir wajib dipilih terlebih dahulu.")
                        .setPositiveButton("OK", null)
                        .show();
                return;
            }

            if (listUriFoto.isEmpty()) {
                Toast.makeText(getContext(), "Mohon sertakan minimal 1 foto bukti", Toast.LENGTH_SHORT).show();
                return;
            }

            // --- DIUBAH: Set ID Plat ---
            voucher.setPlatKendaraan(selectedIdPlat);

            ArrayList<String> fotoStringList = new ArrayList<>();
            for (Uri uri : listUriFoto) {
                fotoStringList.add(uri.toString());
            }
            voucher.setListFotoBukti(fotoStringList);
            getActivity().getSupportFragmentManager().beginTransaction()
                    .replace(R.id.frameLayout, TransaksiVoucherJenisTransaksiFragment.newInstance(null, voucher, id_supir))
                    .addToBackStack(null) // PENTING: Menambahkan ke stack
                    .commit();
        });

        // Tombol Kembali
        view.findViewById(R.id.tombol_kembali).setOnClickListener(view1 -> {
            Log.d(TAG, "tombol_kembali clicked");
            if (getActivity().getSupportFragmentManager().getBackStackEntryCount() > 0) {
                // Jika ada stack, pop (kembalikan) fragment sebelumnya dari memori
                getActivity().getSupportFragmentManager().popBackStack();
            } else {
                // Jika tidak ada stack (misal ini fragment pertama), baru lakukan replace manual
                // atau finish activity jika perlu.
                getActivity().getSupportFragmentManager().beginTransaction()
                        .replace(R.id.frameLayout, TransaksiVoucherGetFragment.newInstance("", ""))
                        .commit();
            }
        });

        return view;
    }

    // --- DITAMBAH: METHOD LOAD DATA PLAT SPINNER ---
    private void tampil_data_plat() {
        data_plat_apiservice service = data_plat_apiutils.getAPIService();
        Call<data_plat_api> call = service.tampil_data_plat();

        call.enqueue(new Callback<data_plat_api>() {
            @Override
            public void onResponse(Call<data_plat_api> call, Response<data_plat_api> response) {
                if (response.isSuccessful() && response.body() != null) {

                    // 1. Bersihkan List
                    listPlatNama.clear();
                    listPlatId.clear();

                    // 2. Tambah Default Value
                    listPlatNama.add("-- Pilih Plat --");
                    listPlatId.add("");

                    // 3. Filter dan Masukkan Data ke List
                    ArrayList<data_plat_apidata> result = response.body().get_data_plat();
                    if (result != null) {
                        for (data_plat_apidata item : result) {
                            // Filter berdasarkan id_relasi
                            if (item.get_id_relasi() != null &&
                                    item.get_id_relasi().equals(voucher.get_id_relasi())) {

                                listPlatNama.add(item.get_plat());
                                listPlatId.add(item.get_id_plat());
                            }
                        }
                    }

                    // 4. Hitung jumlah data Valid (Total list - 1 header default)
                    int jumlahData = listPlatNama.size() - 1;

                    // Setup Adapter untuk Tampilan Awal Spinner
                    ArrayAdapter<String> adapter = new ArrayAdapter<>(
                            getActivity(),
                            android.R.layout.simple_spinner_item,
                            listPlatNama
                    );
                    adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                    spinner_platkendaraan.setAdapter(adapter);

                    // --- LOGIKA UTAMA DISINI ---

                    if (jumlahData > 5) {
                        // KONDISI A: Data > 5 -> Pakai Mode SEARCH DIALOG

                        // Kita override listener sentuhan
                        spinner_platkendaraan.setOnTouchListener(new View.OnTouchListener() {
                            @Override
                            public boolean onTouch(View v, MotionEvent event) {
                                if (event.getAction() == MotionEvent.ACTION_UP) {
                                    // Tampilkan Dialog Pencarian Kustom
                                    showSearchDialogPlat(listPlatNama, listPlatId);
                                    return true; // Return true agar dropdown bawaan TIDAK muncul
                                }
                                return true; // Consume event lain juga
                            }
                        });

                    } else {
                        // KONDISI B: Data <= 5 -> Pakai Mode SPINNER BIASA

                        // Matikan touch listener agar kembali ke perilaku standar (dropdown)
                        spinner_platkendaraan.setOnTouchListener(null);

                        spinner_platkendaraan.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                            @Override
                            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                                selectedIdPlat = listPlatId.get(position);
                                Log.d(TAG, "Plat Selected (Spinner Mode): " + selectedIdPlat);
                            }

                            @Override
                            public void onNothingSelected(AdapterView<?> parent) {
                                selectedIdPlat = "";
                            }
                        });
                    }

                } else {
                    Log.e(TAG, "Gagal load plat: Response not successful");
                }
            }

            @Override
            public void onFailure(Call<data_plat_api> call, Throwable t) {
                Log.e(TAG, "Gagal load plat: " + t.getMessage());
            }
        });
    }

    // --- METHOD UNTUK BUKA GALERI (TIDAK BERUBAH) ---
    private void bukaGaleri() {
        Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
        intent.setType("image/*");
        intent.putExtra(Intent.EXTRA_ALLOW_MULTIPLE, true);

        if (intent.resolveActivity(getActivity().getPackageManager()) != null) {
            startActivityForResult(Intent.createChooser(intent, "Pilih Foto Kendaraan"), REQUEST_CODE_FOTO);
        } else {
            Toast.makeText(getActivity(), "Tidak ada aplikasi galeri ditemukan", Toast.LENGTH_SHORT).show();
        }
    }

    // --- METHOD COMBOBOX SUPIR (TIDAK BERUBAH) ---
    private void tampil_combobox_data_supir() {
        spinner_nama_supir = view.findViewById(R.id.spinner_nama_supir);
        if (spinner_nama_supir == null) return;

        combobox_data_supir_mAPIService = combobox_data_supir_apiutils.getAPIService();

        // Panggil API dengan filter id_relasi
        combobox_data_supir_mAPIService.api("id_relasi", voucher.get_id_relasi(), "", "", "", "", "").enqueue(new Callback<combobox_data_supir_api>() {
            @Override
            public void onResponse(Call<combobox_data_supir_api> call, Response<combobox_data_supir_api> response) {
                if (response.isSuccessful() && response.body() != null) {
                    if ("success".equals(response.body().getStatus())) {

                        // 1. Bersihkan List
                        listSupirNama.clear();
                        listSupirId.clear();

                        // 2. Tambah Default
                        listSupirNama.add("-- Pilih Supir --");
                        listSupirId.add("");

                        // 3. Masukkan Data API ke List
                        List<combobox_data_supir_apidata> apiData = response.body().getComboBoxApiData();
                        if (apiData != null) {
                            for (combobox_data_supir_apidata item : apiData) {
                                listSupirNama.add(item.getNama_supir());
                                listSupirId.add(item.getId_supir());
                            }
                        }

                        // 4. Siapkan Adapter Spinner
                        ArrayAdapter<String> adapter = new ArrayAdapter<>(
                                getActivity(),
                                android.R.layout.simple_spinner_item,
                                listSupirNama
                        );
                        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                        spinner_nama_supir.setAdapter(adapter);

                        // 5. Cek Jumlah Data (Logic Pintar)
                        int jumlahData = listSupirNama.size() - 1; // Kurangi header

                        if (jumlahData > 5) {
                            // --- KONDISI A: Data Banyak -> SEARCH DIALOG ---

                            spinner_nama_supir.setOnTouchListener((v, event) -> {
                                if (event.getAction() == MotionEvent.ACTION_UP) {
                                    showSearchDialogSupir(listSupirNama, listSupirId);
                                    return true; // Cegah dropdown bawaan muncul
                                }
                                return true;
                            });

                        } else {
                            // --- KONDISI B: Data Sedikit -> SPINNER BIASA ---

                            spinner_nama_supir.setOnTouchListener(null); // Reset touch listener

                            spinner_nama_supir.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                                @Override
                                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                                    id_supir = listSupirId.get(position);
                                    Log.d(TAG, "Supir Selected (Spinner): " + id_supir);
                                }

                                @Override
                                public void onNothingSelected(AdapterView<?> parent) {
                                    id_supir = "";
                                }
                            });
                        }
                    }
                }
            }

            @Override
            public void onFailure(Call<combobox_data_supir_api> call, Throwable t) {
                Log.e(TAG, "Gagal load supir: " + t.getMessage());
            }
        });
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        // --- HANDLE HASIL FOTO ---
        if (requestCode == REQUEST_CODE_FOTO && resultCode == Activity.RESULT_OK) {
            if (data != null) {
                if (data.getClipData() != null) {
                    int count = data.getClipData().getItemCount();
                    for (int i = 0; i < count; i++) {
                        listUriFoto.add(data.getClipData().getItemAt(i).getUri());
                    }
                } else if (data.getData() != null) {
                    listUriFoto.add(data.getData());
                }
                fotoAdapter.notifyDataSetChanged();
                if (listUriFoto.size() > 0) recyclerFoto.setVisibility(View.VISIBLE);
            }
        } else if (requestCode == REQUEST_CODE_KAMERA && resultCode == Activity.RESULT_OK) {
            File f = new File(currentPhotoPath);
            if (f.exists()) {
                Uri contentUri = Uri.fromFile(f);
                listUriFoto.add(contentUri);
                fotoAdapter.notifyDataSetChanged();
                if (listUriFoto.size() > 0) recyclerFoto.setVisibility(View.VISIBLE);

                Intent mediaScanIntent = new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
                mediaScanIntent.setData(contentUri);
                getActivity().sendBroadcast(mediaScanIntent);
            }
        }

    }


    private void showLoading(String s) {
        view.findViewById(R.id.loadingIcon).setVisibility(View.VISIBLE);
        TextView text = view.findViewById(R.id.loadingText);
        text.setVisibility(View.VISIBLE);
        text.setText(s);
    }

    private void showStatus(String s) {
        if (s.equals("Used")) {
            if (view.findViewById(R.id.statusText) != null) {
                view.findViewById(R.id.statusText).setVisibility(View.VISIBLE);
                ((TextView) view.findViewById(R.id.statusText)).setText("Telah digunakan");
            }
            view.findViewById(R.id.tombol_edit).setVisibility(View.GONE);
            view.findViewById(R.id.tombol_hapus).setVisibility(View.GONE);
            view.findViewById(R.id.tombol_kembali).setVisibility(View.VISIBLE);
            // DIUBAH: Gunakan ID platkendaraan untuk hide
            setViewsVisibility(View.GONE, R.id.spinner_nama_supir, R.id.label_supir, R.id.platkendaraan, R.id.label_plat, R.id.btn_pilih_foto, R.id.recycler_foto, R.id.label_foto);
        } else {
            if (view.findViewById(R.id.statusText) != null)
                view.findViewById(R.id.statusText).setVisibility(View.GONE);

            view.findViewById(R.id.tombol_edit).setVisibility(View.VISIBLE);
            view.findViewById(R.id.tombol_hapus).setVisibility(View.GONE);
            view.findViewById(R.id.tombol_kembali).setVisibility(View.GONE);
            // DIUBAH: Gunakan ID platkendaraan untuk show
            setViewsVisibility(View.VISIBLE, R.id.spinner_nama_supir, R.id.label_supir, R.id.platkendaraan, R.id.label_plat, R.id.btn_pilih_foto, R.id.label_foto);
        }
    }

    private void setViewsVisibility(int visibility, int... viewIds) {
        for (int id : viewIds) {
            View v = view.findViewById(id);
            if (v != null) v.setVisibility(visibility);
        }
    }

    private void tampilkanPilihanFoto() {
        String[] options = {"Kamera"};
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        builder.setTitle("Ambil Foto Dari");
        builder.setItems(options, (dialog, which) -> {
            if (which == 0) checkCameraPermissionAndOpen();
        });
        builder.show();
    }

    private void checkCameraPermissionAndOpen() {
        if (ContextCompat.checkSelfPermission(getActivity(), Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
            requestPermissions(new String[]{Manifest.permission.CAMERA}, REQUEST_PERMISSION_CAMERA);
        } else {
            bukaKamera();
        }
    }

    private void bukaKamera() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        if (takePictureIntent.resolveActivity(getActivity().getPackageManager()) != null) {
            File photoFile = null;
            try { photoFile = createImageFile(); } catch (IOException ex) {
                Toast.makeText(getActivity(), "Gagal membuat file foto sementara", Toast.LENGTH_SHORT).show();
            }
            if (photoFile != null) {
                Uri photoURI = FileProvider.getUriForFile(getActivity(), "com.project.aplikasi.petugas_cbs.fileprovider", photoFile);
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                startActivityForResult(takePictureIntent, REQUEST_CODE_KAMERA);
            }
        }
    }

    private File createImageFile() throws IOException {
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = getActivity().getExternalFilesDir(Environment.DIRECTORY_PICTURES);
        File image = File.createTempFile(imageFileName, ".jpg", storageDir);
        currentPhotoPath = image.getAbsolutePath();
        return image;
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == REQUEST_PERMISSION_CAMERA) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                bukaKamera();
            } else {
                Toast.makeText(getActivity(), "Izin kamera diperlukan", Toast.LENGTH_SHORT).show();
            }
        }
    }

    private void showSearchDialogPlat(ArrayList<String> dataNama, ArrayList<String> dataId) {
        // 1. Setup Dialog
        android.app.AlertDialog.Builder builder = new android.app.AlertDialog.Builder(getActivity());
        builder.setTitle("Cari Plat Kendaraan");

        // 2. Buat Layout Sederhana secara Programmatic (LinearLayout isi EditText + ListView)
        // Jika mau rapi bisa pakai layout XML terpisah (di-inflate)
        android.widget.LinearLayout layout = new android.widget.LinearLayout(getActivity());
        layout.setOrientation(android.widget.LinearLayout.VERTICAL);
        layout.setPadding(30, 30, 30, 30);

        // Search Box
        final android.widget.EditText searchBox = new android.widget.EditText(getActivity());
        searchBox.setHint("Ketik nomor plat...");
        layout.addView(searchBox);

        // List View
        final android.widget.ListView listView = new android.widget.ListView(getActivity());
        layout.addView(listView);

        builder.setView(layout);

        // 3. Setup Adapter untuk Dialog (Gunakan list copy agar master data tidak rusak saat filter)
        final ArrayList<String> dialogListNama = new ArrayList<>(dataNama);
        final ArrayList<String> dialogListId = new ArrayList<>(dataId);

        // Hapus opsi "-- Pilih Plat --" dari pencarian agar tidak mengganggu
        if(!dialogListNama.isEmpty() && dialogListNama.get(0).contains("Pilih")) {
            dialogListNama.remove(0);
            dialogListId.remove(0);
        }

        final ArrayAdapter<String> dialogAdapter = new ArrayAdapter<>(
                getActivity(),
                android.R.layout.simple_list_item_1,
                dialogListNama
        );
        listView.setAdapter(dialogAdapter);

        // Create Dialog
        final android.app.AlertDialog dialog = builder.create();

        // 4. Logika Filter Pencarian
        searchBox.addTextChangedListener(new android.text.TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // Filter adapter bawaan Android
                dialogAdapter.getFilter().filter(s);
            }

            @Override
            public void afterTextChanged(android.text.Editable s) {}
        });

        // 5. Logika Saat Item Dipilih di Dialog
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                // Ambil nama yang dipilih
                String selectedName = dialogAdapter.getItem(position);

                // Cari ID asli berdasarkan Nama yang dipilih (Mapping balik)
                // Karena urutan di dialog mungkin berubah kena filter, kita cari index di Master List asli
                int originalIndex = listPlatNama.indexOf(selectedName);

                if (originalIndex >= 0) {
                    // Set text di spinner UI agar terlihat berubah
                    spinner_platkendaraan.setSelection(originalIndex);

                    // Set variabel ID
                    selectedIdPlat = listPlatId.get(originalIndex);
                    Log.d(TAG, "Plat Selected (Search Mode): " + selectedName + " ID: " + selectedIdPlat);
                }

                dialog.dismiss();
            }
        });

        dialog.show();
    }

    // --- TAMBAHAN: DIALOG PENCARIAN SUPIR ---
    private void showSearchDialogSupir(ArrayList<String> dataNama, ArrayList<String> dataId) {
        // 1. Setup Dialog
        android.app.AlertDialog.Builder builder = new android.app.AlertDialog.Builder(getActivity());
        builder.setTitle("Cari Nama Supir");

        // 2. Layout Manual
        android.widget.LinearLayout layout = new android.widget.LinearLayout(getActivity());
        layout.setOrientation(android.widget.LinearLayout.VERTICAL);
        layout.setPadding(30, 30, 30, 30);

        final android.widget.EditText searchBox = new android.widget.EditText(getActivity());
        searchBox.setHint("Ketik nama supir...");
        layout.addView(searchBox);

        final android.widget.ListView listView = new android.widget.ListView(getActivity());
        layout.addView(listView);

        builder.setView(layout);

        // 3. Setup Data untuk Dialog (Copy list agar aman)
        final ArrayList<String> dialogListNama = new ArrayList<>(dataNama);
        // Hapus "-- Pilih Supir --" dari pencarian
        if(!dialogListNama.isEmpty()) dialogListNama.remove(0);

        final ArrayAdapter<String> dialogAdapter = new ArrayAdapter<>(
                getActivity(),
                android.R.layout.simple_list_item_1,
                dialogListNama
        );
        listView.setAdapter(dialogAdapter);

        final android.app.AlertDialog dialog = builder.create();

        // 4. Logic Filter Pencarian
        searchBox.addTextChangedListener(new android.text.TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                dialogAdapter.getFilter().filter(s);
            }
            @Override
            public void afterTextChanged(android.text.Editable s) {}
        });

        // 5. Logic Klik Item
        listView.setOnItemClickListener((parent, view, position, id) -> {
            String selectedName = dialogAdapter.getItem(position);

            // Cari Index Asli di Master List
            int originalIndex = listSupirNama.indexOf(selectedName);

            if (originalIndex >= 0) {
                // Update UI Spinner
                spinner_nama_supir.setSelection(originalIndex);

                // Update Variabel ID
                id_supir = listSupirId.get(originalIndex);
                Log.d(TAG, "Supir Selected (Search): " + selectedName + " ID: " + id_supir);
            }
            dialog.dismiss();
        });

        dialog.show();
    }
}