package com.project.aplikasi.petugas_cbs.activity;

import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.text.Editable;
import android.text.Html;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;

import java.text.NumberFormat;
import java.util.Locale;

import androidx.appcompat.app.AlertDialog; // Pastikan pakai AndroidX
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.config.print_transaksi;
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_apidata;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_apiservice;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_apiutils;
import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_apidata;

import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.StringTokenizer;

import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class VoucherPrintNonMemberFragment extends Fragment implements View.OnClickListener {

    private static final String TAG = "VoucherNonMember";
    private static final String ARG_PARAM_VOUCHER = "param_voucher";
    private static final String ARG_PARAM_JENIS = "param_jenis";
    private static final String ARG_PARAM_SUPIR = "param_supir";

    private data_voucher_apidata voucher;
    private data_jenis_transaksi_apidata jenis_transaksi;
    private String id_supir;
    private View view;

    private View loadingOverlay;
    String validasi;

    public VoucherPrintNonMemberFragment() {
        // Required empty public constructor
    }

    public static VoucherPrintNonMemberFragment newInstance(data_voucher_apidata paramVoucher, data_jenis_transaksi_apidata paramJenis, String idSupir) {
        VoucherPrintNonMemberFragment fragment = new VoucherPrintNonMemberFragment();
        Bundle args = new Bundle();
        args.putParcelable(ARG_PARAM_VOUCHER, paramVoucher);
        args.putParcelable(ARG_PARAM_JENIS, paramJenis);
        args.putString(ARG_PARAM_SUPIR, idSupir);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            voucher = getArguments().getParcelable(ARG_PARAM_VOUCHER);
            jenis_transaksi = getArguments().getParcelable(ARG_PARAM_JENIS);
            id_supir = getArguments().getString(ARG_PARAM_SUPIR);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_voucher_print_non_member, container, false);
        init();
        return view;
    }

    Button tombol_simpan;
    EditText id_transaksi, tanggal, jam, id_member, id_petugas, id_kategori_member, id_jenis_transaksi, point, jumlah;
    String s_id_transaksi, s_tanggal, s_jam, s_id_member, s_id_kategori_member, s_id_jenis_transaksi, s_jumlah, s_harga_perliter, s_kategori_transaksi, s_maksimal_transaksi;
    TextView namas, txt_nominal_voucher;

    Integer total_tambahan = 0;
    String s_tambahan_point = "0";
    String liter = "";

    private int status_nominal = 0;
    private RadioButton rb_liter, rb_rupiah;
    data_transaksi_apiservice mAPIService;

    config_sessionmanager config_sessionmanager;

    private void init() {
        tombol_simpan = view.findViewById(R.id.tombol_simpan);
        id_transaksi = view.findViewById(R.id.id_transaksi);
        tanggal = view.findViewById(R.id.tanggal);
        jam = view.findViewById(R.id.jam);
        id_member = view.findViewById(R.id.id_member);
        id_petugas = view.findViewById(R.id.id_petugas);
        loadingOverlay = view.findViewById(R.id.loading_overlay);
        hideLoading();
        id_kategori_member = view.findViewById(R.id.id_kategori_member);
        id_jenis_transaksi = view.findViewById(R.id.id_jenis_transaksi);
        point = view.findViewById(R.id.point);
        jumlah = view.findViewById(R.id.jumlah);
        namas = view.findViewById(R.id.namas);
        rb_liter = view.findViewById(R.id.rb_liter);
        rb_rupiah = view.findViewById(R.id.rb_rupiah);
        txt_nominal_voucher = view.findViewById(R.id.txt_nominal_voucher);


        // --- ID TRANSAKSI ---
        s_id_transaksi = config_global.generate_id(getActivity(), "data_transaksi");
        id_transaksi.setText(s_id_transaksi);

        mAPIService = data_transaksi_apiutils.getAPIService();

        config_global.init_inputTypes();
        point.setInputType(inputTypes.get(4).value);
        jumlah.setInputType(inputTypes.get(4).value);

        txt_nominal_voucher.setText(voucher.get_nominal_rupiah());

        final int MAX_NOMINAL;
        try {
            MAX_NOMINAL = Integer.parseInt(voucher.get_nominal());
        } catch (Exception e) {
            throw new RuntimeException("Nominal voucher tidak valid");
        }

        TextWatcher watcher = new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {}

            @Override
            public void afterTextChanged(Editable s) {
                jumlah.removeTextChangedListener(this); // Stop listener biar gak looping
                try {
                    String originalString = s.toString();
                    String cleanString = originalString.replaceAll("[^\\d]", "");

                    if (!cleanString.isEmpty()) {
                        double parsed = Double.parseDouble(cleanString);
                        long value = (long) parsed;

                        Locale localeID = new Locale("id", "ID");
                        NumberFormat formatter = NumberFormat.getInstance(localeID);
                        String formattedString = formatter.format(value);

                        jumlah.setText(formattedString);
                        jumlah.setSelection(formattedString.length());
                    }
                } catch (NumberFormatException e) {
                    e.printStackTrace();
                }
                jumlah.addTextChangedListener(this); // Pasang listener lagi
            }
        };

        jumlah.addTextChangedListener(watcher);

        // --- WAKTU ---
        Calendar c = Calendar.getInstance();
        SimpleDateFormat tgl = new SimpleDateFormat("yyyy-MM-dd");
        s_tanggal = tgl.format(c.getTime());
        tanggal.setText(s_tanggal);

        SimpleDateFormat jm = new SimpleDateFormat("HH:mm:ss");
        s_jam = jm.format(c.getTime());
        jam.setText(s_jam);

        // --- PETUGAS ---
        config_sessionmanager = new config_sessionmanager(getContext());
        View spinnerView = view.findViewById(R.id.combo_data_petugas);
        if (spinnerView != null) spinnerView.setVisibility(View.GONE);

        String namaPetugas = config_sessionmanager.getSPToken();
        id_petugas.setText(namaPetugas);
        id_petugas.setVisibility(View.VISIBLE);

        // --- SETTING NON MEMBER ---
        s_id_member = "";
        id_member.setText("-");
        id_member.setEnabled(false);

        s_id_kategori_member = "";
        id_kategori_member.setText("-");
        id_kategori_member.setEnabled(false);

        point.setText("0");
        point.setEnabled(false);

        // --- PARSING JENIS TRANSAKSI ---
        namas.setText(Html.fromHtml(jenis_transaksi.get_jenis_transaksi()));

        String s = jenis_transaksi.get_id_jenis_transaksi();
        StringTokenizer st = new StringTokenizer(s, "|");

        String id_jenis = "";
        String harga_perliter = "1";
        String maksimal_transaksi = "999999";

        if(st.hasMoreTokens()) id_jenis = st.nextToken();
        if(st.hasMoreTokens()) st.nextToken();
        if(st.hasMoreTokens()) harga_perliter = st.nextToken();
        if(st.hasMoreTokens()) maksimal_transaksi = st.nextToken();

        id_jenis_transaksi.setText(id_jenis);
        s_id_jenis_transaksi = id_jenis;
        s_harga_perliter = harga_perliter;
        s_maksimal_transaksi = maksimal_transaksi;

        view.findViewById(R.id.rb_liter).setOnClickListener(this);
        view.findViewById(R.id.rb_rupiah).setOnClickListener(this);

        rb_liter.setChecked(true);
        rb_rupiah.setChecked(false);
        status_nominal = 0;

        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final MediaPlayer mp = MediaPlayer.create(getContext(), R.raw.click);
                mp.start();

                id_transaksi.setText(config_global.generate_id(getActivity(), "data_transaksi"));
                s_id_transaksi = id_transaksi.getText().toString();

                validasi = "berhasil";
                validasiForm((ViewGroup) view.findViewById(R.id.group));

                if (validasi.equals("gagal")) {
                    Toast.makeText(getContext(), "Ada data yang masih kosong.", Toast.LENGTH_LONG).show();
                    return;
                }

                long maxVoucher = 0;
                try {
                    maxVoucher = Long.parseLong(voucher.get_nominal());
                } catch (NumberFormatException e) {
                    maxVoucher = 0;
                }

                long hargaPerLiter = 0;
                try {
                    hargaPerLiter = Long.parseLong(s_harga_perliter);
                } catch (Exception e) {
                    hargaPerLiter = 0;
                }

                if (hargaPerLiter <= 0) {
                    Toast.makeText(getContext(), "Error: Harga per liter tidak valid (0). Hubungi Admin.", Toast.LENGTH_SHORT).show();
                    return;
                }

                String rawInput = jumlah.getText().toString().replaceAll("[^0-9]", "");
                if (rawInput.isEmpty()) rawInput = "0";

                long inputUser = Long.parseLong(rawInput);
                long totalRupiahYgAkanDikirim = 0;

                if (status_nominal == 1) {
                    // --- MODE RUPIAH ---
                    totalRupiahYgAkanDikirim = inputUser;

                    if (totalRupiahYgAkanDikirim < hargaPerLiter) {
                        tampilkanAlertError("Nominal Kurang!",
                                "Minimal transaksi adalah setara 1 Liter.\n" +
                                        "Harga per liter: Rp " + formatRupiah(hargaPerLiter) + "\n\n" +
                                        "Anda memasukkan: Rp " + formatRupiah(totalRupiahYgAkanDikirim));
                        return;
                    }

                    if (totalRupiahYgAkanDikirim > maxVoucher) {
                        tampilkanAlertError("Saldo Voucher Tidak Cukup!",
                                "Total Transaksi: Rp " + formatRupiah(totalRupiahYgAkanDikirim) + "\n" +
                                        "Sisa Voucher: Rp " + formatRupiah(maxVoucher) + "\n\n" +
                                        "Silakan input ulang sesuai sisa voucher.");
                        return;
                    }
                    s_kategori_transaksi = "rupiah";
                } else {
                    // --- MODE LITER ---
                    totalRupiahYgAkanDikirim = inputUser * hargaPerLiter;

                    if (totalRupiahYgAkanDikirim > maxVoucher) {
                        tampilkanAlertError("Liter Melebihi Saldo Voucher!",
                                inputUser + " Liter setara dengan Rp " + formatRupiah(totalRupiahYgAkanDikirim) +
                                        ".\n\nSedangkan sisa Voucher hanya Rp " + formatRupiah(maxVoucher) +
                                        ".\n\nSilakan kurangi jumlah liter.");
                        return;
                    }
                    s_kategori_transaksi = "liter";
                }

                if (totalRupiahYgAkanDikirim <= 0) {
                    Toast.makeText(getContext(), "Jumlah transaksi tidak valid", Toast.LENGTH_SHORT).show();
                    return;
                }

                s_jumlah = String.valueOf(totalRupiahYgAkanDikirim);

                tampilkanKonfirmasiAkhir(inputUser, totalRupiahYgAkanDikirim, hargaPerLiter, status_nominal);
            }
        });
    }

    private void tampilkanKonfirmasiAkhir(long inputUser, long totalRupiah, long hargaPerLiter, int modeInput) {
        String pesanKonfirmasi = "";
        Locale localeUS = new Locale("en", "US");

        if (modeInput == 0) {
            pesanKonfirmasi = "Apakah data berikut sudah benar?\nProses selanjutnya tidak bisa diulang\n\n" +
                    "Jumlah Pengisian: \n" +
                    "▶ " + inputUser + " Liter\n\n" +
                    "Total Biaya: \n" +
                    "▶ Rp " + formatRupiah(totalRupiah);

            liter =  String.valueOf(inputUser);
        } else {
            double estimasiLiter = (double) totalRupiah / hargaPerLiter;
            String sEstimasiLiter = String.format(localeUS, "%.2f", estimasiLiter);

            pesanKonfirmasi = "Apakah data berikut sudah benar?\n\n" +
                    "Nominal Uang: \n" +
                    "▶ Rp " + formatRupiah(totalRupiah) + "\n\n" +
                    "Dalam Liter: \n" +
                    "▶ ± " + sEstimasiLiter + " Liter";
            liter =  String.valueOf(estimasiLiter);
        }

        showCustomCardDialog(
                "Konfirmasi Transaksi",
                pesanKonfirmasi,
                "YA, PROSES",
                "BATAL",
                this::prosesSimpanMultipart,
                null
        );
    }

    private void tampilkanDialogCetakStruk(final Bundle bundleData) {
        showCustomCardDialog(
                "Cetak Struk?",
                "Transaksi Berhasil. Apakah Anda ingin mencetak struk?",
                "YA, CETAK",
                "TIDAK",
                () -> {
                    Intent intent = new Intent(getContext(), print_transaksi.class);
                    intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
                    intent.putExtras(bundleData);
                    startActivity(intent);
                    getActivity().finish();
                },
                () -> {
                    Intent intent = new Intent(getContext(), TransaksiVoucherActivity.class);
                    intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(intent);
                    getActivity().finish();
                }
        );
    }

    // --- DIALOG ERROR JUGA MENGGUNAKAN CUSTOM CARD SEKARANG ---
    private void tampilkanAlertError(String judul, String pesan) {
        showCustomCardDialog(
                judul,
                pesan,
                "Input Ulang",
                null, // Tombol Negatif Null agar tidak muncul
                () -> {
                    jumlah.setText("");
                    jumlah.requestFocus();
                },
                null
        );
    }

    private RequestBody createPartFromString(String descriptionString) {
        if (descriptionString == null) descriptionString = "";
        return RequestBody.create(MultipartBody.FORM, descriptionString);
    }

    private void showLoading() {
        loadingOverlay.setVisibility(View.VISIBLE);
    }

    private void hideLoading() {
        loadingOverlay.setVisibility(View.GONE);
    }

    private void prosesSimpanMultipart() {
        showLoading();
        String token = "Bearer " + new config_global().ambil(getContext());
        String param_petugas = id_petugas.getText().toString();

        Log.e(TAG, "=== MULAI REQUEST UPLOAD ===");

        List<MultipartBody.Part> parts = new ArrayList<>();
        ArrayList<String> listFotoPath = voucher.getListFotoBukti();

        if (listFotoPath != null && !listFotoPath.isEmpty()) {
            for (String path : listFotoPath) {
                Uri uri = Uri.parse(path);
                String realPath = getRealPathFromURI(getContext(), uri);
                if(realPath == null) realPath = path;

                File file = new File(realPath);
                if (file.exists()) {
                    RequestBody requestBody = RequestBody.create(MediaType.parse("image/*"), file);
                    MultipartBody.Part part = MultipartBody.Part.createFormData("foto[]", file.getName(), requestBody);
                    parts.add(part);
                }
            }
        }

        Call<Object> call = mAPIService.proses_simpan_data_transaksi(
                createPartFromString(s_id_transaksi),
                createPartFromString(s_tanggal),
                createPartFromString(s_jam),
                createPartFromString(""),
                createPartFromString(param_petugas),
                createPartFromString(""),
                createPartFromString(s_id_jenis_transaksi),
                createPartFromString("0"),
                createPartFromString(s_jumlah),
                token,
                createPartFromString(voucher.get_id_voucher()),
                createPartFromString("simpan-voucher"),
                createPartFromString(voucher.getPlatKendaraan()),
                createPartFromString(id_supir),
                createPartFromString(voucher.get_id_relasi()),
                parts
        );

        call.enqueue(new Callback<Object>() {
            @Override
            public void onResponse(Call<Object> call, Response<Object> response) {
                try {
                    if (response.isSuccessful() && response.body() != null) {
                        getActivity().setResult(Activity.RESULT_OK);

                        Intent intent = new Intent(getContext(), print_transaksi.class);
                        Bundle bundle = new Bundle();
                        bundle.putString("id_transaksi", s_id_transaksi);
                        bundle.putString("tanggal", s_tanggal);
                        bundle.putString("jam", s_jam);
                        bundle.putString("petugas", param_petugas);
                        bundle.putString("jenis_transaksi", s_id_jenis_transaksi);
                        bundle.putString("jumlah", s_jumlah);
                        bundle.putString("kategori", s_kategori_transaksi);
                        bundle.putString("id_supir", id_supir);
                        bundle.putString("id_member", "-");
                        bundle.putString("kategori_member", "-");
                        bundle.putString("point", "0");
                        bundle.putString("tambahan_point", "0");
                        bundle.putString("aksi", "simpan-voucher");
                        bundle.putString("id_voucher", voucher.get_id_voucher());
                        bundle.putString("nama", voucher.getPlatKendaraan());
                        bundle.putString("id_supir", id_supir);
                        bundle.putString("liter", liter);
                        bundle.putString("nominal_voucher", voucher.get_nominal());

                        intent.putExtras(bundle);
                        tampilkanDialogCetakStruk(bundle);
                        clearForm((ViewGroup) view.findViewById(R.id.group));

                        hideLoading();
                    } else {
                        Toast.makeText(getContext(), "Gagal: " + response.code(), Toast.LENGTH_LONG).show();
                        hideLoading();
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onFailure(Call<Object> call, Throwable t) {
                Toast.makeText(getContext(), "Koneksi Gagal: " + t.getMessage(), Toast.LENGTH_LONG).show();
                hideLoading();
            }
        });
    }

    private void clearForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) ((EditText) view).setText("");
            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0)) clearForm((ViewGroup) view);
        }
    }

    public void validasiForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                if (view.isEnabled()) {
                    if (TextUtils.isEmpty(((EditText) view).getText().toString())) {
                        validasi = "gagal";
                        ((EditText) view).setError("Silahkan Input Terlebih Dahulu");
                    }
                }
            }
            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0)) validasiForm((ViewGroup) view);
        }
    }

    private String getRealPathFromURI(Context context, Uri uri) {
        if (uri == null) return null;
        if ("file".equalsIgnoreCase(uri.getScheme())) return uri.getPath();
        try {
            InputStream inputStream = context.getContentResolver().openInputStream(uri);
            if (inputStream == null) return null;
            String fileName = "upload_temp_" + System.currentTimeMillis() + ".jpg";
            File tempFile = new File(context.getCacheDir(), fileName);
            OutputStream outputStream = new FileOutputStream(tempFile);
            byte[] buffer = new byte[4 * 1024];
            int read;
            while ((read = inputStream.read(buffer)) != -1) outputStream.write(buffer, 0, read);
            outputStream.flush();
            outputStream.close();
            inputStream.close();
            return tempFile.getAbsolutePath();
        } catch (Exception e) {
            return null;
        }
    }

    private String formatRupiah(long angka) {
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getInstance(localeID);
        return formatRupiah.format(angka);
    }

    public void onRadioButtonClicked(View view) {
        final MediaPlayer mp = MediaPlayer.create(getContext(), R.raw.click);
        mp.start();
        if (rb_rupiah.isChecked()) {
            status_nominal = 1;
        } else {
            status_nominal = 0;
        }
    }

    // --- REVISI PENTING: MENGGUNAKAN CONTEXT YANG BENAR DAN LOGIC TOMBOL NEGATIF ---
    private void showCustomCardDialog(String title, String message, String posText, String negText, Runnable onPositive, Runnable onNegative) {
        // PERBAIKAN 1: Gunakan requireContext() bukan 'this' karena ini Fragment
        AlertDialog.Builder builder = new AlertDialog.Builder(requireContext());
        LayoutInflater inflater = LayoutInflater.from(getContext());

        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();

        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        }

        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);
        CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        txtTitle.setText(title);
        txtMessage.setText(message);
        txtPos.setText(posText);

        // PERBAIKAN 2: Sembunyikan tombol negatif jika negText == null (untuk alert error)
        if (negText == null || negText.isEmpty()) {
            btnNeg.setVisibility(View.GONE);
        } else {
            txtNeg.setText(negText);
            btnNeg.setOnClickListener(v -> {
                dialog.dismiss();
                if (onNegative != null) onNegative.run();
            });
        }

        btnPos.setOnClickListener(v -> {
            dialog.dismiss();
            if (onPositive != null) onPositive.run();
        });

        dialog.setCancelable(false);
        dialog.show();
    }

    @Override
    public void onClick(View view) {
        onRadioButtonClicked(view);
    }
}