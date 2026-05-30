package com.project.aplikasi.petugas_cbs.activity;

import static android.app.Activity.RESULT_OK;

import static com.project.aplikasi.petugas_cbs.config.config_global.show_error_dialog;

import android.app.Activity;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;

import android.widget.ProgressBar;

import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.data_voucher.*;

import java.util.logging.Logger;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link TransaksiVoucherGetFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class TransaksiVoucherGetFragment extends Fragment {

    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";
    private static final int REQUEST_CODE_QRCODE = 99;

    private String mParam1;
    private String mParam2;
    private View view;

    private TextView loadingText;
    private ProgressBar loadingIcon;


    private ActivityResultLauncher<Intent> activityResultLauncher;

    data_voucher_apiservice mAPIService;

    public TransaksiVoucherGetFragment() {
    }

    public static TransaksiVoucherGetFragment newInstance(String param1, String param2) {
        TransaksiVoucherGetFragment fragment = new TransaksiVoucherGetFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }

        getActivity().setTitle("Transaksi Voucher");
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_transaksi_voucher_get, container, false);

        init();

        return view;
    }

    void init() {
        loadingText = view.findViewById(R.id.loading_text);
        loadingIcon = view.findViewById(R.id.loading);

        mAPIService = data_voucher_apiutils.getAPIService();

        hideLoading();

        view.findViewById(R.id.scan_voucher).setOnClickListener(view1 -> {
            Intent intent = new Intent(getContext(), qrcode2_activity.class);
            intent.putExtra("SCAN_TIPE", "REQUEST_QRCODE_RAW");
            intent.putExtra("dari", "evoucher");
            getActivity().startActivityForResult(intent, REQUEST_CODE_QRCODE);
        });

    }

    private void hideLoading() {
        loadingIcon.setVisibility(View.GONE);
        loadingText.setVisibility(View.GONE);
    }

    private void showLoading(String s) {
        loadingIcon.setVisibility(View.VISIBLE);
        loadingText.setVisibility(View.GONE);
        loadingText.setText(s);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        showLoading("Cek barcode, mohon ditunggu");

        if (requestCode == REQUEST_CODE_QRCODE) {
            if (resultCode == RESULT_OK) {
                String qrCode = data.getStringExtra("RESULT_STRING");
                showLoading("Cek barcode, mohon ditunggu");
                getVoucher(qrCode);
            }
        }
    }

    void getVoucher(String qrcode) {

        mAPIService.tampil_data_voucher(
                "qrcode",
                "" + qrcode,
                "",
                "",
                "",
                "",
                ""
        ).enqueue(new Callback<data_voucher_api>() {
            @Override
            public void onResponse(Call<data_voucher_api> call, Response<data_voucher_api> response) {
                if (response.isSuccessful()) {
                    data_voucher_api responseData = response.body();
                    if (responseData != null) {
                        if (!responseData.get_data_voucher().isEmpty()) {
                            if (responseData.get_data_voucher().get(0).isKadaluarsa()) {
                                showLoading("Voucher sudah kadaluarsa");

                                show_error_dialog(getContext(), "Maaf, voucher yang Anda gunakan sudah kadaluarsa.", "Voucher sudah kadaluarsa");

                            } else {
                                showVoucherFound(responseData.get_data_voucher().get(0));
                            }
                            return;
                        }
                    }
                }

                showLoading("Voucher tidak ditemukan");

                show_error_dialog(getContext(), "Maaf, voucher yang Anda cari tidak ditemukan.", "Voucher " + qrcode);
            }

            @Override
            public void onFailure(Call<data_voucher_api> call, Throwable t) {
                showLoading("Voucher tidak ditemukan");

                show_error_dialog(getContext(), "Maaf, voucher yang Anda cari tidak ditemukan.", "Voucher  " + qrcode);
            }
        });

    }

    void showVoucherFound(data_voucher_apidata data) {
        getActivity().getSupportFragmentManager().beginTransaction()
                .replace(
                        R.id.frameLayout,
                        TransaksiVoucherFoundFragment.newInstance(data, "")
                )
                .addToBackStack(null)
                .commit();
    }
}


