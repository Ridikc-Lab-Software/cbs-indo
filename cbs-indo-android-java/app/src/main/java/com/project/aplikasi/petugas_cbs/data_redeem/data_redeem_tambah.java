package com.project.aplikasi.petugas_cbs.data_redeem;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
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
import android.widget.TextView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.config.print_transaksi;

import java.text.NumberFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

public class data_redeem_tambah extends AppCompatActivity {

    String validasi;
    Button tombol_simpan;
    int values;
    data_redeem_apiservice mAPIService;
    EditText id_redeem, tanggal, jam, id_member, id_mitra, id_promo, point, id_petugas, status;
    TextView namas;
    loading loading;
    config_sessionmanager config_sessionmanager;
    String s_id_redeem, s_nama, s_nama_promo, s_mitra, s_pengurangan_point, s_point_awal, s_redeem_value, s_kategori_member;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_redeem_tambah);

        // Inisialisasi Session Manager lebih awal
        config_sessionmanager = new config_sessionmanager(data_redeem_tambah.this);

        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        loading = new loading(this);
        id_redeem = (EditText) findViewById(R.id.id_redeem);
        id_redeem.setVisibility(View.GONE);

        tanggal = (EditText) findViewById(R.id.tanggal);
        tanggal.setVisibility(View.GONE);

        jam = (EditText) findViewById(R.id.jam);
        jam.setVisibility(View.GONE);

        id_petugas = (EditText) findViewById(R.id.id_petugas);
        id_petugas.setVisibility(View.GONE);

        id_petugas.setText(config_sessionmanager.getSPToken());
        // ---------------------------

        Calendar c = Calendar.getInstance();
        // TANGGAL
        SimpleDateFormat tgl = new SimpleDateFormat("yyyy-MM-dd");
        String tanggal_otomatis = tgl.format(c.getTime());
        tanggal.setText(tanggal_otomatis);

        // JAM
        SimpleDateFormat jm = new SimpleDateFormat("HH:mm:ss");
        String jam_otomatis = jm.format(c.getTime());
        jam.setText(jam_otomatis);

        Bundle bundle = getIntent().getExtras();
        namas = (TextView) findViewById(R.id.namas);

        String redeem_value = bundle.getString("redeem_value");

        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        formatRupiah.setMaximumFractionDigits(0);
        redeem_value = (formatRupiah.format((double) Integer.parseInt(redeem_value)));

        namas.setText(Html.fromHtml("<b>" +
                bundle.getString("nama_promo") + "</b><br> Redeem Point : " +
                bundle.getString("jumlah_point") + "<br> Value : " +
                redeem_value));

        id_member = (EditText) findViewById(R.id.id_member);
        id_member.setVisibility(View.GONE);

        id_member.setText(bundle.getString("id_member"));
        id_mitra = (EditText) findViewById(R.id.id_mitra);
        id_mitra.setVisibility(View.GONE);

        id_mitra.setText(bundle.getString("id_mitra"));

        id_promo = (EditText) findViewById(R.id.id_promo);
        id_promo.setVisibility(View.GONE);

        id_promo.setText(bundle.getString("id_promo"));

        point = (EditText) findViewById(R.id.point);
        point.setVisibility(View.GONE);

        point.setText(bundle.getString("point"));
        status = (EditText) findViewById(R.id.status);
        status.setVisibility(View.GONE);

        id_redeem.setText(config_global.generate_id(this, "data_redeem"));
        id_redeem.setVisibility(View.GONE);

        mAPIService = data_redeem_apiutils.getAPIService();

        hiddenForm((ViewGroup) findViewById(R.id.group));
        status.setVisibility(View.VISIBLE);

        config_global.init_inputTypes();
        point.setInputType(inputTypes.get(4).value);
        status.setInputType(inputTypes.get(4).value);

        s_id_redeem = config_global.generate_id(data_redeem_tambah.this, "data_redeem");
        s_nama = bundle.getString("nama");
        s_nama_promo = bundle.getString("nama_promo");
        s_mitra = bundle.getString("nama_mitra");
        s_point_awal = bundle.getString("point");
        s_pengurangan_point = bundle.getString("jumlah_point");
        s_kategori_member = bundle.getString("kategori_member");
        s_redeem_value = bundle.getString("redeem_value");


        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final MediaPlayer mp = MediaPlayer.create(data_redeem_tambah.this, R.raw.click);
                mp.start();
                loading.showDialog(1, "Please Wait", "Proses Simpan Data..");
                id_redeem.setText(s_id_redeem);
                validasi = "berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));

                // Cek apakah status (jumlah) kosong
                if (TextUtils.isEmpty(status.getText().toString())) {
                    validasi = "gagal";
                } else if (Integer.parseInt(status.getText().toString()) < 1) {
                    validasi = "gagal";
                }

                if (validasi == "gagal") {
                    loading.hideDialog();
                    Toast.makeText(data_redeem_tambah.this, "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG).show();

                } else {

                    values = Integer.parseInt(s_point_awal) - Integer.parseInt(s_pengurangan_point) * Integer.parseInt(status.getText().toString());

                    if (values < 0) {
                        Toast.makeText(data_redeem_tambah.this, "GAGAL DIPROSES, POINT TIDAK CUKUP..", Toast.LENGTH_LONG).show();
                        loading.hideDialog();
                    } else {
                        String token = "Bearer " + new config_global().ambil(data_redeem_tambah.this);

                        Log.e("REDEEM_DEBUG", "status              = " + status.getText().toString());
                        Log.e("REDEEM_DEBUG", "redeem_value        = " + s_redeem_value);
                        Log.e("REDEEM_DEBUG", "jam                 = " + jam.getText().toString());
                        Log.e("REDEEM_DEBUG", "id_member           = " + id_member.getText().toString());
                        Log.e("REDEEM_DEBUG", "id_mitra            = " + id_mitra.getText().toString());
                        Log.e("REDEEM_DEBUG", "id_promo            = " + id_promo.getText().toString());
                        Log.e("REDEEM_DEBUG", "pengurangan_point   = " + s_pengurangan_point);
                        Log.e("REDEEM_DEBUG", "id_petugas          = " + id_petugas.getText().toString());
                        Log.e("REDEEM_DEBUG", "token               = " + token);

                        mAPIService.proses_simpan_data_redeem(status.getText().toString()
                                , s_redeem_value
                                , jam.getText().toString()
                                , id_member.getText().toString()
                                , id_mitra.getText().toString()
                                , id_promo.getText().toString()
                                , s_pengurangan_point
                                , id_petugas.getText().toString()
                                , token

                        ).enqueue(new Callback<Object>() {
                            @Override
                            public void onResponse(Call<Object> call, Response<Object> response) {
                                Toast.makeText(data_redeem_tambah.this, "Berhasil Disimpan", Toast.LENGTH_LONG).show();
                                setResult(RESULT_OK);

                                loading.hideDialog();

                                // PRINT
                                Intent intent = new Intent(data_redeem_tambah.this, print_redeem.class);
                                Bundle bundle = new Bundle();
                                bundle.putString("id_redeem", s_id_redeem);
                                bundle.putString("nama", s_nama);
                                bundle.putString("nama_promo", s_nama_promo);
                                bundle.putString("kategori_member", s_kategori_member);

                                // REVISI BAGIAN INI: Ambil nama petugas dari session manager, bukan spinner
                                bundle.putString("petugas", config_sessionmanager.getSPNama());

                                bundle.putString("id_mitra", id_mitra.getText().toString());
                                bundle.putString("redeem_value", String.valueOf(Integer.parseInt(s_redeem_value) * Integer.parseInt(status.getText().toString())));
                                bundle.putString("pengurangan_point", String.valueOf(Integer.parseInt(s_pengurangan_point) * Integer.parseInt(status.getText().toString())));
                                bundle.putString("point", String.valueOf(values));

                                intent.putExtras(bundle);
                                tampilkanDialogCetak();

                            }

                            @Override
                            public void onFailure(Call<Object> call, Throwable t) {
                                Toast.makeText(data_redeem_tambah.this, "GAGAL DIPROSES, POINT TIDAK CUKUP..", Toast.LENGTH_LONG).show();
                                loading.hideDialog();
                                finish();
                            }
                        });
                    }
                }
            }
        });
    }

    public void validasiForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                if (!TextUtils.isEmpty(((EditText) view).getText().toString())) {
                } else {
                    validasi = "gagal";
                    ((EditText) view).setError("Silahkan Input Terlebih Dahulu");
                    ((EditText) view).requestFocus();
                }
            }
            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0))
                validasiForm((ViewGroup) view);
        }
    }

    private void clearForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                ((EditText) view).setText("");
            }
            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0))
                clearForm((ViewGroup) view);
        }
    }

    private void hiddenForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                ((EditText) view).setVisibility(View.GONE);
            }
            if (view instanceof ViewGroup && (((ViewGroup) view).getChildCount() > 0))
                hiddenForm((ViewGroup) view);
        }
    }

    private void tampilkanDialogCetak() {
        // 1. Setup Builder dan Inflate Layout Custom
        AlertDialog.Builder builder = new AlertDialog.Builder(data_redeem_tambah.this);
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_custom_card, null);
        builder.setView(dialogView);

        // 2. Buat Dialog & Set Background Transparan (Agar sudut CardView terlihat rapi)
        AlertDialog dialog = builder.create();
        if (dialog.getWindow() != null) {
            dialog.getWindow().setBackgroundDrawable(new android.graphics.drawable.ColorDrawable(android.graphics.Color.TRANSPARENT));
        }

        // 3. Binding View (Hubungkan ID XML ke Java)
        TextView txtTitle = dialogView.findViewById(R.id.dialog_title);
        TextView txtMessage = dialogView.findViewById(R.id.dialog_message);
        TextView txtPos = dialogView.findViewById(R.id.txt_positive);
        TextView txtNeg = dialogView.findViewById(R.id.txt_negative);

        // Tombol berbentuk CardView
        androidx.cardview.widget.CardView btnPos = dialogView.findViewById(R.id.btn_positive_card);
        androidx.cardview.widget.CardView btnNeg = dialogView.findViewById(R.id.btn_negative_card);

        // 4. Set Teks Label
        txtTitle.setText("Redeem Berhasil");
        txtMessage.setText("Poin berhasil ditukar. Apakah Anda ingin mencetak struk redeem?");
        txtPos.setText("CETAK STRUK");
        txtNeg.setText("TIDAK");

        // 5. Logic Tombol CETAK (Positive)
        btnPos.setOnClickListener(v -> {
            dialog.dismiss();

            // --- MULAI LOGIC LAMA ---
            Intent intent = new Intent(data_redeem_tambah.this, print_redeem.class);
            Bundle bundle = new Bundle();

            bundle.putString("id_redeem", s_id_redeem);
            bundle.putString("nama", s_nama);
            bundle.putString("nama_promo", s_nama_promo);
            bundle.putString("kategori_member", s_kategori_member);
            bundle.putString("petugas", config_sessionmanager.getSPNama());
            bundle.putString("id_mitra", id_mitra.getText().toString());
            bundle.putString("mitra", s_mitra);

            // Hitung total (gunakan try-catch agar aman dari error konversi angka)
            try {
                int qty = Integer.parseInt(status.getText().toString()); // status adalah field input jumlah
                int val = Integer.parseInt(s_redeem_value);
                int potong = Integer.parseInt(s_pengurangan_point);

                int totalValue = val * qty;
                int totalPotong = potong * qty;

                bundle.putString("redeem_value", String.valueOf(totalValue));
                bundle.putString("pengurangan_point", String.valueOf(totalPotong));
            } catch (NumberFormatException e) {
                // Default value jika terjadi error parsing
                bundle.putString("redeem_value", "0");
                bundle.putString("pengurangan_point", "0");
            }

            bundle.putString("point", String.valueOf(values)); // Sisa point

            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
            intent.putExtras(bundle);
            startActivityForResult(intent, 1);

            clearForm((ViewGroup) findViewById(R.id.group));
            finish();
            // --- SELESAI LOGIC LAMA ---
        });

        // 6. Logic Tombol TUTUP (Negative)
        btnNeg.setOnClickListener(v -> {
            dialog.dismiss();
            clearForm((ViewGroup) findViewById(R.id.group));
            finish();
        });

        // Tampilkan Dialog
        dialog.setCancelable(false);
        dialog.show();
    }


    // Bagian Combobox Petugas yang lama bisa dihapus atau dibiarkan (tidak akan dipanggil)
    // Saya hapus agar kode lebih bersih.
}