//package com.project.aplikasi.petugas_cbs.activity;
//
//import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;
//
//import android.app.Activity;
//import android.content.Intent;
//import android.media.MediaPlayer;
//import android.os.Bundle;
//
//import androidx.fragment.app.Fragment;
//
//import android.text.Html;
//import android.text.TextUtils;
//import android.util.Log;
//import android.view.LayoutInflater;
//import android.view.View;
//import android.view.ViewGroup;
//import android.widget.Button;
//import android.widget.EditText;
//import android.widget.RadioButton;
//import android.widget.Spinner; // Masih diimport jaga-jaga jika XML membutuhkannya, tapi tidak dipakai logicnya
//import android.widget.TextView;
//import android.widget.Toast;
//
//import com.project.aplikasi.petugas_cbs.R;
//import com.project.aplikasi.petugas_cbs.config.config_global;
//import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
//import com.project.aplikasi.petugas_cbs.config.print_transaksi;
//import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_apidata;
//import com.project.aplikasi.petugas_cbs.data_member.data_member_apidata;
//import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_apiservice;
//import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_apiutils;
//import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_apidata;
//
//import java.text.SimpleDateFormat;
//import java.util.Calendar;
//import java.util.StringTokenizer;
//
//import retrofit2.Call;
//import retrofit2.Callback;
//import retrofit2.Response;
//
///**
// * A simple {@link Fragment} subclass.
// * Use the {@link VoucherPrintFragment#newInstance} factory method to
// * create an instance of this fragment.
// */
//public class VoucherPrintFragment extends Fragment implements View.OnClickListener {
//
//    private static final String ARG_PARAM1 = "param1";
//    private static final String ARG_PARAM2 = "param2";
//    private static final String ARG_PARAM3 = "param3";
//    private static final String ARG_PARAM4 = "param4";
//
//    private data_member_apidata member;
//    private data_voucher_apidata voucher;
//    private String id_supir;
//    private data_jenis_transaksi_apidata jenis_transaksi;
//    private View view;
//
//    String validasi;
//
//    public VoucherPrintFragment() {
//        // Required empty public constructor
//    }
//
//    public static VoucherPrintFragment newInstance(data_member_apidata param1, data_voucher_apidata param2, data_jenis_transaksi_apidata param3, String id_supir) {
//        VoucherPrintFragment fragment = new VoucherPrintFragment();
//        Bundle args = new Bundle();
//        args.putParcelable(ARG_PARAM1, param1);
//        args.putParcelable(ARG_PARAM2, param2);
//        args.putParcelable(ARG_PARAM3, param3);
//        args.putString(ARG_PARAM4, id_supir);
//        fragment.setArguments(args);
//        return fragment;
//    }
//
//    @Override
//    public void onCreate(Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        if (getArguments() != null) {
//            member = getArguments().getParcelable(ARG_PARAM1);
//            voucher = getArguments().getParcelable(ARG_PARAM2);
//            id_supir = getArguments().getString(ARG_PARAM4);
//            jenis_transaksi = getArguments().getParcelable(ARG_PARAM3);
//        }
//    }
//
//    @Override
//    public View onCreateView(LayoutInflater inflater, ViewGroup container,
//                             Bundle savedInstanceState) {
//        view = inflater.inflate(R.layout.fragment_voucher_print, container, false);
//
//        init();
//
//        Log.e("VOUCHER", voucher.toString());
//
//        return view;
//    }
//
//    Button tombol_simpan;
//    EditText id_transaksi, tanggal, jam, id_member, id_petugas, id_kategori_member, id_jenis_transaksi, point, jumlah;
//    String s_id_transaksi, s_tanggal, s_jam, s_id_member, s_id_kategori_member, s_id_jenis_transaksi, s_jumlah, s_nama, s_point_awal, s_tambahan_point, s_harga_perliter, s_kategori_transaksi, s_maksimal_transaksi;
//    TextView namas;
//    Integer total_tambahan = 0;
//
//    private int status_nominal = 1;
//    private RadioButton rb_liter, rb_rupiah;
//    data_transaksi_apiservice mAPIService;
//
//    config_sessionmanager config_sessionmanager;
//
//    private void init() {
//        tombol_simpan = (Button) view.findViewById(R.id.tombol_simpan);
//        id_transaksi = (EditText) view.findViewById(R.id.id_transaksi);
//        tanggal = (EditText) view.findViewById(R.id.tanggal);
//        jam = (EditText) view.findViewById(R.id.jam);
//        id_member = (EditText) view.findViewById(R.id.id_member);
//        id_petugas = (EditText) view.findViewById(R.id.id_petugas);
//        id_kategori_member = (EditText) view.findViewById(R.id.id_kategori_member);
//        id_jenis_transaksi = (EditText) view.findViewById(R.id.id_jenis_transaksi);
//        point = (EditText) view.findViewById(R.id.point);
//        jumlah = (EditText) view.findViewById(R.id.jumlah);
//
//        namas = (TextView) view.findViewById(R.id.namas);
//
//        rb_liter = view.findViewById(R.id.rb_liter);
//        rb_rupiah = view.findViewById(R.id.rb_rupiah);
//
//        // --- SETUP SESI PETUGAS (PENGGANTI COMBOBOX) ---
//        config_sessionmanager = new config_sessionmanager(getContext());
//
//        // Sembunyikan Spinner Combobox agar tidak error/mengganggu
//        View spinnerView = view.findViewById(R.id.combo_data_petugas);
//        if (spinnerView != null) {
//            spinnerView.setVisibility(View.GONE);
//        }
//
//        // Ambil Nama atau Token dari Session
//        // Prioritas Nama, jika kosong ambil Token (Email)
//        String namaPetugas = config_sessionmanager.getSPToken();
//
//        // Set ke EditText dan Lock (Disable)
//        id_petugas.setText(namaPetugas);
//        id_petugas.setEnabled(false); // Tidak bisa diedit
//        id_petugas.setFocusable(false); // Tidak bisa di-klik
//        id_petugas.setVisibility(View.VISIBLE);
//        // ----------------------------------------------
//
//        //ID TRANSAKSI OTOMATIS
//        id_transaksi.setText(config_global.generate_id(getActivity(), "data_transaksi"));
//        s_id_transaksi = config_global.generate_id(getActivity(), "data_transaksi");
//        mAPIService = data_transaksi_apiutils.getAPIService();
//
//        config_global.init_inputTypes();
//        point.setInputType(inputTypes.get(4).value);
//        jumlah.setInputType(inputTypes.get(4).value);
//
//        jumlah.setText(voucher.get_nominal());
//
//        Calendar c = Calendar.getInstance();
//        //TANGGAL
//        SimpleDateFormat tgl = new SimpleDateFormat("yyyy-MM-dd");
//        String tanggal_otomatis = tgl.format(c.getTime());
//        tanggal.setText(tanggal_otomatis);
//        s_tanggal = tanggal_otomatis;
//
//        //JAM
//        SimpleDateFormat jm = new SimpleDateFormat("HH:mm:ss");
//        String jam_otomatis = jm.format(c.getTime());
//        jam.setText(jam_otomatis);
//        s_jam = jam_otomatis;
//
//        //ID MEMBER
//        id_member.setText(member.get_id_member());
//        s_id_member = member.get_id_member();
//        namas.setText(Html.fromHtml(jenis_transaksi.get_jenis_transaksi()));
//
//        String s = jenis_transaksi.get_id_jenis_transaksi();
//        StringTokenizer st = new StringTokenizer(s, "|");
//        String id = st.nextToken();
//
//        //ID JENIS TRANSAKSI
//        id_jenis_transaksi.setText(id);
//        s_id_jenis_transaksi = id;
//
//        //ID KATEGORI MEMBER
//        id_kategori_member.setText(member.get_id_kategori_member());
//        s_id_kategori_member = member.get_id_kategori_member();
//
//        String tambahan_point = st.nextToken();
//        String harga_perliter = st.nextToken();
//        String maksimal_transaksi = st.nextToken();
//
//        s_nama = member.get_nama();
//        s_point_awal = member.get_point();
//        s_tambahan_point = tambahan_point;
//
//        s_harga_perliter = harga_perliter;
//        s_maksimal_transaksi = maksimal_transaksi;
//
//        view.findViewById(R.id.rb_liter).setOnClickListener(this);
//        view.findViewById(R.id.rb_rupiah).setOnClickListener(this);
//
//
//// Tambahkan TAG ini di bagian atas Class atau gunakan string langsung
//        final String TAG = "API_DEBUG_VOUCHER";
//
//        tombol_simpan.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//
//                final MediaPlayer mp = MediaPlayer.create(getContext(), R.raw.click);
//                mp.start();
//
//                id_transaksi.setText(config_global.generate_id(getActivity(), "data_transaksi"));
//                validasi = "berhasil";
//                validasiForm((ViewGroup) view.findViewById(R.id.group));
//
//                if (validasi == "gagal") {
//                    Toast.makeText(getContext(), "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
//                            Toast.LENGTH_LONG).show();
//                } else {
//                    s_jumlah = jumlah.getText().toString();
//                    if (status_nominal == 1) {
//                        s_kategori_transaksi = "rupiah";
//                        //RUPIAH
//                        if (Integer.parseInt(s_jumlah) < Integer.parseInt(s_harga_perliter)) {
//                            validasi = "gagal";
//                            Toast.makeText(getContext(), "GAGAL PROSES, JUMLAH KURANG DARI MINIMUM TRANSAKSI DALAM SATU LITER", Toast.LENGTH_LONG).show();
//                        } else {
//                            if (Integer.parseInt(s_jumlah) / Integer.parseInt(s_harga_perliter) > Integer.parseInt(s_maksimal_transaksi)) {
//                                validasi = "gagal";
//                                Toast.makeText(getContext(), "GAGAL PROSES, JUMLAH MELEBIHI MAKSIMAL TRANSAKSI JENIS KENDARAAN " + s_id_kategori_member.toUpperCase() + ", MAKSIMAL " + s_maksimal_transaksi + " LITER", Toast.LENGTH_LONG).show();
//                            } else {
//                                total_tambahan = (Integer.parseInt(s_jumlah) / Integer.parseInt(s_harga_perliter)) * Integer.parseInt(s_tambahan_point);
//                            }
//                        }
//                    } else {
//                        //LITER
//                        if (Integer.parseInt(s_jumlah) < 1) {
//                            validasi = "gagal";
//                            Toast.makeText(getContext(), "GAGAL PROSES, JUMLAH KURANG DARI MINIMUM TRANSAKSI DALAM SATUAN LITER", Toast.LENGTH_LONG).show();
//                        } else {
//                            s_kategori_transaksi = "liter";
//                            if (Integer.parseInt(s_jumlah) > Integer.parseInt(s_maksimal_transaksi)) {
//                                validasi = "gagal";
//                                Toast.makeText(getContext(), "GAGAL PROSES, JUMLAH MELEBIHI MAKSIMAL TRANSAKSI JENIS KENDARAAN " + s_id_kategori_member.toUpperCase() + ", MAKSIMAL " + s_maksimal_transaksi + " LITER", Toast.LENGTH_LONG).show();
//                            } else {
//                            }
//                            total_tambahan = (Integer.parseInt(s_jumlah) * Integer.parseInt(s_tambahan_point));
//                        }
//                    }
//
//                    if (validasi == "gagal") {
//                        // Do nothing
//                    } else {
//                        String token = "Bearer " + new config_global().ambil(getContext());
//                        String param_petugas = id_petugas.getText().toString();
//                        String param_jumlah = jumlah.getText().toString();
//                        String param_total_tambahan = total_tambahan.toString();
//                        String param_plat = voucher.getPlatKendaraan();
//                        String param_id_voucher = voucher.get_id_voucher();
//                        String param_id_relasi = voucher.get_id_relasi();
//
//                        // ================= LOG REQUEST =================
//                        Log.e(TAG, "================= MULAI REQUEST API ==================");
//                        Log.e(TAG, "URL Endpoint: proses_simpan.php / insert");
//                        Log.e(TAG, "Token Auth  : " + token);
//                        Log.e(TAG, "--- PARAMETER ---");
//                        Log.e(TAG, "id_transaksi       : " + s_id_transaksi);
//                        Log.e(TAG, "tanggal            : " + s_tanggal);
//                        Log.e(TAG, "jam                : " + s_jam);
//                        Log.e(TAG, "id_member          : " + s_id_member);
//                        Log.e(TAG, "id_petugas         : " + param_petugas);
//                        Log.e(TAG, "id_kategori_member : " + s_id_kategori_member);
//                        Log.e(TAG, "id_jenis_transaksi : " + s_id_jenis_transaksi);
//                        Log.e(TAG, "point (tambahan)   : " + param_total_tambahan);
//                        Log.e(TAG, "jumlah             : " + param_jumlah);
//                        Log.e(TAG, "id_voucher         : " + param_id_voucher);
//                        Log.e(TAG, "aksi               : simpan-voucher");
//                        Log.e(TAG, "plat_kendaraan     : " + param_plat);
//                        Log.e(TAG, "id_supir           : " + id_supir);
//                        Log.e(TAG, "id_relasi          : " + param_id_relasi);
//                        Log.e(TAG, "======================================================");
//                        // ===============================================
//
//                        mAPIService.proses_simpan_data_transaksi(
//                                s_id_transaksi
//                                , s_tanggal
//                                , s_jam
//                                , s_id_member
//                                , param_petugas
//                                , s_id_kategori_member
//                                , s_id_jenis_transaksi
//                                , param_total_tambahan
//                                , param_jumlah
//                                , token
//                                , param_id_voucher
//                                , "simpan-voucher"
//                                , param_plat
//                                , id_supir
//                                , param_id_relasi
//
//                        ).enqueue(new Callback<Object>() {
//                            @Override
//                            public void onResponse(Call<Object> call, Response<Object> response) {
//                                // ================= LOG RESPONSE =================
//                                Log.e(TAG, "================= RESPONSE API DITERIMA ==============");
//                                Log.e(TAG, "HIT KE URL  : " + call.request().url().toString());
//
//                                // Cek apakah parameter terkirim (Header/Method)
//                                Log.e(TAG, "METHOD      : " + call.request().method());
//                                Log.e(TAG, "Code    : " + response.code());
//                                Log.e(TAG, "Message : " + response.message());
//
//                                if (response.body() != null) {
//                                    Log.e(TAG, "Body    : " + response.body().toString());
//                                } else {
//                                    Log.e(TAG, "Body    : NULL");
//                                }
//
//                                if (!response.isSuccessful() && response.errorBody() != null) {
//                                    try {
//                                        Log.e(TAG, "ErrorBody: " + response.errorBody().string());
//                                    } catch (Exception e) {
//                                        e.printStackTrace();
//                                    }
//                                }
//                                Log.e(TAG, "======================================================");
//                                // ================================================
//
//                                if (response.isSuccessful()) {
//                                    getActivity().setResult(Activity.RESULT_OK);
//
//                                    //PRINT
//                                    Intent intent = new Intent(getContext(), print_transaksi.class);
//                                    Bundle bundle = new Bundle();
//                                    bundle.putString("id_transaksi", s_id_transaksi);
//                                    bundle.putString("tanggal", s_tanggal);
//                                    bundle.putString("jam", s_jam);
//                                    bundle.putString("id_member", s_id_member);
//                                    bundle.putString("id_petugas", id_petugas.getText().toString());
//                                    bundle.putString("petugas", id_petugas.getText().toString());
//                                    bundle.putString("kategori_member", s_id_kategori_member);
//                                    bundle.putString("jenis_transaksi", s_id_jenis_transaksi);
//
//                                    Integer total_keseluruhan = total_tambahan + Integer.parseInt(s_point_awal);
//                                    bundle.putString("point", String.valueOf(total_keseluruhan));
//                                    bundle.putString("kategori", s_kategori_transaksi);
//                                    bundle.putString("jumlah", s_jumlah);
//                                    bundle.putString("nama", s_nama);
//                                    bundle.putString("tambahan_point", String.valueOf(total_tambahan));
//
//                                    bundle.putString("aksi", "simpan-voucher-member");
//                                    bundle.putString("id_voucher", voucher.get_id_voucher());
//
//                                    intent.putExtras(bundle);
//                                    startActivityForResult(intent, 1);
//
//                                    clearForm((ViewGroup) view.findViewById(R.id.group));
//                                    getActivity().finish();
//                                } else {
//                                    Toast.makeText(getContext(), "Gagal: Respon Server Error (" + response.code() + ")", Toast.LENGTH_LONG).show();
//                                }
//                            }
//
//                            @Override
//                            public void onFailure(Call<Object> call, Throwable t) {
//                                // ================= LOG FAILURE =================
//                                Log.e(TAG, "================= REQUEST API GAGAL ==================");
//                                Log.e(TAG, "Error Message : " + t.getMessage());
//                                Log.e(TAG, "Cause         : " + t.getCause());
//                                t.printStackTrace();
//                                Log.e(TAG, "======================================================");
//                                // ===============================================
//
//                                Toast.makeText(getContext(), "Koneksi Gagal: " + t.getMessage(), Toast.LENGTH_LONG).show();
//                            }
//                        });
//                    }
//                }
//            }
//        });
//    }
//
//    private void clearForm(ViewGroup group) {
//        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
//            View view = group.getChildAt(i);
//            if (view instanceof EditText) {
//                ((EditText) view).setText("");
//            }
//            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0))
//                clearForm((ViewGroup) view);
//        }
//    }
//
//    // Fungsi combobox dihapus karena tidak dipakai lagi
//
//    public void validasiForm(ViewGroup group) {
//        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
//            View view = group.getChildAt(i);
//            if (view instanceof EditText) {
//                // Skip validasi untuk field yang disabled/lock (seperti id_petugas) jika perlu
//                // atau biarkan validasi berjalan karena field sudah terisi otomatis
//                if (!TextUtils.isEmpty(((EditText) view).getText().toString())) {
//                } else {
//                    validasi = "gagal";
//                    ((EditText) view).setError("Silahkan Input Terlebih Dahulu");
//                    ((EditText) view).requestFocus();
//                }
//            }
//            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0))
//                validasiForm((ViewGroup) view);
//        }
//    }
//
//    public void onRadioButtonClicked(View view) {
//        final MediaPlayer mp = MediaPlayer.create(getContext(), R.raw.click);
//        mp.start();
//        if (rb_rupiah.isChecked()) {
//            status_nominal = 1;
//        } else if (rb_liter.isChecked()) {
//            status_nominal = 0;
//        } else {
//            status_nominal = 0;
//        }
//    }
//
//    @Override
//    public void onClick(View view) {
//        onRadioButtonClicked(view);
//    }
//}