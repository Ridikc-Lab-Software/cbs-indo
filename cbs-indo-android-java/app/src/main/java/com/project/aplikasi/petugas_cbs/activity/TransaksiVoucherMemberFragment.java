package com.project.aplikasi.petugas_cbs.activity;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.data_member.data_member_apidata;
import com.project.aplikasi.petugas_cbs.data_member.data_member_apiservice;
import com.project.aplikasi.petugas_cbs.data_member.data_member_apiutils;
import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_apidata;

public class TransaksiVoucherMemberFragment extends Fragment {

    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";
    private static final String ARG_PARAM3 = "param3";

    private data_member_apidata member;
    private data_voucher_apidata voucher;
    private String id_supir; // String

    String token = "";
    View view;

    data_member_apiservice mAPIService;

    public TransaksiVoucherMemberFragment() {
    }

    public static TransaksiVoucherMemberFragment newInstance(data_member_apidata param1, data_voucher_apidata param2, String id_supir) {
        TransaksiVoucherMemberFragment fragment = new TransaksiVoucherMemberFragment();
        Bundle args = new Bundle();
        args.putParcelable(ARG_PARAM1, param1);
        args.putParcelable(ARG_PARAM2, param2);
        args.putString(ARG_PARAM3, id_supir); // Benar: putString
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            member = getArguments().getParcelable(ARG_PARAM1);
            voucher = getArguments().getParcelable(ARG_PARAM2);

            // --- PERBAIKAN 1: Gunakan getString, bukan getParcelable ---
            id_supir = getArguments().getString(ARG_PARAM3);
        }

        getActivity().setTitle("Member");
    }

    void init() {
        token = new config_global().ambil(getContext());
        mAPIService = data_member_apiutils.getAPIService();
        hideError();
        hideLoading();
    }

    void showLoading(String text) {
        view.findViewById(R.id.loading).setVisibility(View.VISIBLE);
        TextView tt = view.findViewById(R.id.loading_text);
        tt.setVisibility(View.GONE);
        tt.setText(text);
    }

    void hideLoading() {
        view.findViewById(R.id.loading).setVisibility(View.GONE);
        view.findViewById(R.id.loading_text).setVisibility(View.GONE);
    }

    void showError(String text) {
        view.findViewById(R.id.image_error).setVisibility(View.VISIBLE);
        TextView tt = view.findViewById(R.id.pesan_error);
        tt.setVisibility(View.VISIBLE);
        tt.setText(text);
    }

    void hideError() {
        view.findViewById(R.id.image_error).setVisibility(View.GONE);
        view.findViewById(R.id.pesan_error).setVisibility(View.GONE);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        view = inflater.inflate(R.layout.fragment_transaksi_voucher_member, container, false);

        view.findViewById(R.id.card2).setOnClickListener(view -> {
            Fragment currentFragment = getActivity().getSupportFragmentManager().findFragmentById(R.id.frameLayout);
            if (currentFragment != null) {
                getActivity().getSupportFragmentManager().beginTransaction()
                        .remove(currentFragment)
                        .commit();
            }

            // --- PERBAIKAN 2: Kirim id_supir ke fragment selanjutnya ---
            // Pastikan kamu juga sudah update 'newInstance' di file TransaksiVoucherJenisTransaksiFragment.java
            // agar menerima parameter ke-3 (id_supir)
            getActivity().getSupportFragmentManager().beginTransaction()
                    .add(R.id.frameLayout, TransaksiVoucherJenisTransaksiFragment.newInstance(member, voucher, id_supir))
                    .commit();
        });

        init();

        set_view_member(member);

        return view;
    }

    private void set_view_member(data_member_apidata member) {
        TextView nama = view.findViewById(R.id.nama);
        TextView kendaraan = view.findViewById(R.id.tanggal_terdaftar);
        TextView point = view.findViewById(R.id.point);

        nama.setText(member.get_nama());
        kendaraan.setText(Html.fromHtml(member.get_tanggal_terdaftar()));
        point.setText(member.get_point());
    }
}