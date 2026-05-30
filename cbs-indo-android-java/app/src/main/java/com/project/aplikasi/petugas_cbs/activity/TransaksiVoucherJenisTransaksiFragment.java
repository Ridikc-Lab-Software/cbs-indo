package com.project.aplikasi.petugas_cbs.activity;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_adapter_v2;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_api;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_apidata;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_apiservice;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_apiutils;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.voucher_data_jenis_transaksi_apiutils;
import com.project.aplikasi.petugas_cbs.data_member.data_member_apidata;
import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_apidata;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TransaksiVoucherJenisTransaksiFragment extends Fragment {

    private static final String TAG = "JenisTransaksiFragment";
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";
    private static final String ARG_PARAM3 = "param3";

    private data_member_apidata member;
    private data_voucher_apidata voucher;
    private String id_supir;
    private View view;

    // Komponen UI
    RecyclerView data_jenis_transaksi_tampil;
    RecyclerView.LayoutManager layoutManager;
    data_jenis_transaksi_adapter_v2 adapter;
    ArrayList<data_jenis_transaksi_apidata> result = new ArrayList<>();
    data_jenis_transaksi_apiservice mAPIService;

    public TransaksiVoucherJenisTransaksiFragment() {
        // Required empty public constructor
    }

    public static TransaksiVoucherJenisTransaksiFragment newInstance(data_member_apidata param1, data_voucher_apidata param2, String id_supir) {
        TransaksiVoucherJenisTransaksiFragment fragment = new TransaksiVoucherJenisTransaksiFragment();
        Bundle args = new Bundle();
        args.putParcelable(ARG_PARAM1, param1);
        args.putParcelable(ARG_PARAM2, param2);
        args.putString(ARG_PARAM3, id_supir);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            member = getArguments().getParcelable(ARG_PARAM1);
            voucher = getArguments().getParcelable(ARG_PARAM2);
            id_supir = getArguments().getString(ARG_PARAM3);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_transaksi_voucher_jenis_transaksi, container, false);

        // JANGAN PANGGIL hideLoading() DI SINI.
        // Biarkan loading muncul dulu saat init() -> fetch data

        init();

        return view;
    }

    void init() {
        getActivity().setTitle("Pilih Jenis Transaksi");

        data_jenis_transaksi_tampil = view.findViewById(R.id.data_jenis_transaksi_tampil);
        adapter = new data_jenis_transaksi_adapter_v2(result, getActivity());

        // --- LOGIKA KLIK ITEM ---
        adapter.setDariCallback(item -> {


            // PENTING: Pengecekan member null atau tidak untuk menentukan Fragment selanjutnya
            if (member != null) {
                // Jalur Member
                getActivity().getSupportFragmentManager().beginTransaction()
                        .replace(R.id.frameLayout, VoucherPrintNonMemberFragment.newInstance(voucher, item, id_supir))
                        .addToBackStack(null) // Simpan fragment ini di stack agar bisa kembali
                        .commit();
            } else {
                // Jalur Non-Member
                getActivity().getSupportFragmentManager().beginTransaction()
                        .replace(R.id.frameLayout, VoucherPrintNonMemberFragment.newInstance(voucher, item, id_supir))
                        .addToBackStack(null) // Simpan fragment ini di stack agar bisa kembali
                        .commit();
            }
        });

        layoutManager = new LinearLayoutManager(getContext());
        data_jenis_transaksi_tampil.setLayoutManager(layoutManager);
        data_jenis_transaksi_tampil.setAdapter(adapter);

        // Inisialisasi Service Default
        mAPIService = data_jenis_transaksi_apiutils.getAPIService();

        // Panggil Data
        fetch_data_jenis_transaksi();
    }

    public void fetch_data_jenis_transaksi() {
        String token = new config_global().ambil(getActivity());

        showLoading("Mengambil data jenis transaksi...");

        if (member != null) {
            // === LOGIKA JIKA ADA MEMBER ===
            Log.d(TAG, "fetch_data: Mengambil data untuk MEMBER");
            mAPIService.tampil_data_jenis_transaksi(
                    "", member.get_id_kategori_member(), "", "", "", "", "Bearer " + token
            ).enqueue(new Callback<data_jenis_transaksi_api>() {
                @Override
                public void onResponse(Call<data_jenis_transaksi_api> call, Response<data_jenis_transaksi_api> response) {
                    hideLoading(); // Sembunyikan loading saat respons diterima
                    if (response.isSuccessful() && response.body() != null) {
                        data_jenis_transaksi_api response_data = response.body();
                        if (response_data.get_data_jenis_transaksi() != null) {
                            adapter.updateResults(response_data.get_data_jenis_transaksi());
                        } else {
                            Toast.makeText(getActivity(), "Data jenis transaksi kosong", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Toast.makeText(getActivity(), "Gagal mengambil data", Toast.LENGTH_SHORT).show();
                    }
                }

                @Override
                public void onFailure(Call<data_jenis_transaksi_api> call, Throwable t) {
                    hideLoading();
                    Log.e(TAG, "onFailure Member: " + t.getMessage());
                    Toast.makeText(getActivity(), "Koneksi Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });

        } else {
            // === LOGIKA JIKA NON MEMBER (NULL) ===
            Log.d(TAG, "fetch_data: Mengambil data untuk NON MEMBER");
            // Pastikan URL base untuk voucher_data_jenis_transaksi_apiutils sudah benar
            voucher_data_jenis_transaksi_apiutils.getAPIService().tampil_data_jenis_transaksi(
                    "", "", "", "", "", "", "Bearer " + token
            ).enqueue(new Callback<data_jenis_transaksi_api>() {
                @Override
                public void onResponse(Call<data_jenis_transaksi_api> call, Response<data_jenis_transaksi_api> response) {
                    hideLoading(); // PENTING: Sembunyikan loading
                    if (response.isSuccessful() && response.body() != null) {
                        data_jenis_transaksi_api response_data = response.body();
                        if (response_data.get_data_jenis_transaksi() != null) {
                            adapter.updateResults(response_data.get_data_jenis_transaksi());
                        } else {
                            Toast.makeText(getActivity(), "Data jenis transaksi umum kosong", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Toast.makeText(getActivity(), "Gagal mengambil data umum", Toast.LENGTH_SHORT).show();
                    }
                }

                @Override
                public void onFailure(Call<data_jenis_transaksi_api> call, Throwable t) {
                    // PENTING: Handle error di sini agar user tau jika gagal
                    hideLoading();
                    Log.e(TAG, "onFailure NonMember: " + t.getMessage());
                    Toast.makeText(getActivity(), "Koneksi Error: " + t.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
        }
    }

    private void showLoading(String s) {
        View icon = view.findViewById(R.id.loadingIcon);
        TextView text = view.findViewById(R.id.loadingText);

        if(icon != null && text != null){
            icon.setVisibility(View.VISIBLE);
            text.setVisibility(View.VISIBLE);
            text.setText(s);
        }
    }

    private void hideLoading() {
        View icon = view.findViewById(R.id.loadingIcon);
        View text = view.findViewById(R.id.loadingText);

        if(icon != null && text != null){
            icon.setVisibility(View.GONE);
            text.setVisibility(View.GONE);
        }
    }
}