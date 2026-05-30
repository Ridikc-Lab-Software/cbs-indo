package com.project.aplikasi.petugas_cbs.data_mitra;

import static com.project.aplikasi.petugas_cbs.config.config_sessionmanager.view_error;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.cardview.widget.CardView;

import android.app.DatePickerDialog;
import android.app.PendingIntent;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.nfc.NfcAdapter;
import android.nfc.tech.IsoDep;
import android.nfc.tech.MifareClassic;
import android.nfc.tech.MifareUltralight;
import android.nfc.tech.Ndef;
import android.nfc.tech.NfcA;
import android.nfc.tech.NfcB;
import android.nfc.tech.NfcF;
import android.nfc.tech.NfcV;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.RelativeLayout;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity_v2;
import com.project.aplikasi.petugas_cbs.data_promo.data_promo_activity_v2;
import com.project.aplikasi.petugas_cbs.data_redeem.data_redeem_activity_v2;
import com.project.aplikasi.petugas_cbs.home.home_activity;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Locale;
import java.util.Timer;
import java.util.TimerTask;

import pl.droidsonroids.gif.GifImageView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class data_mitra_activity_v2 extends AppCompatActivity {

    ArrayList<data_mitra_apidata> result = new ArrayList<>();
    data_mitra_adapter_v2 adapter;
    RecyclerView data_mitra_tampil;
    data_mitra_apiservice mAPIService;
    Button tombol_tambah, tombol_refresh, tombol_cari;
    protected int REQUEST_CODE_TAMBAH = 3543;
    RecyclerView.LayoutManager layoutManager;
    Boolean isRefresh = false;
    Toolbar toolbar;
    AlertDialog.Builder dialog;
    LayoutInflater inflater;
    View dialogView;
    Spinner spinnerPencarian;

    com.project.aplikasi.petugas_cbs.config.config_sessionmanager config_sessionmanager;

    private CardView filter_tanggal;
    private DatePickerDialog datePickerDialog;
    private SimpleDateFormat dateFormatter;
    private TextView tvDateResult;
    private Button btDatePicker;
    private TextView tvDateResult1;
    private Button btDatePicker1;
    private EditText editPencarian;

    static String id_member;
    static String point;
    static String nama;

    private String[] spinnerArray = {
            "",
            "id_mitra",
            "nama_mitra",
            "alamat",
            "no_telepon",
            "nama_pemilik",
            "no_telepon_pemilik",
            "tanggal_daftar",
            "username",
            "password",
            "status",
            "gambar_logo"
    };

    private Timer timer;

    RelativeLayout infogif;
    GifImageView gif1;
    GifImageView gif2;
    TextView text1, text2;
    loading loading;

    private void gif_no_internet() {
        data_mitra_tampil.setVisibility(View.GONE);
        infogif.setVisibility(View.VISIBLE);
        gif1.setVisibility(View.VISIBLE);
        gif2.setVisibility(View.INVISIBLE);
        text1.setText("Tidak ada Koneksi Internet");
        text2.setText("Silahkan Coba Lagi");
    }

    private void gif_no_data() {
        data_mitra_tampil.setVisibility(View.GONE);
        infogif.setVisibility(View.VISIBLE);
        gif1.setVisibility(View.INVISIBLE);
        gif2.setVisibility(View.VISIBLE);
        text1.setText("Tidak ada data");
        text2.setText("Data Masih Kosong");
    }

    private void hidden_gif() {
        infogif.setVisibility(View.GONE);
        gif1.setVisibility(View.GONE);
        gif2.setVisibility(View.GONE);
        data_mitra_tampil.setVisibility(View.VISIBLE);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_mitra_activity_v2);

        data_mitra_tampil = (RecyclerView) findViewById(R.id.data_mitra_tampil);
        tombol_tambah = (Button) findViewById(R.id.tombol_tambah);
        tombol_refresh = (Button) findViewById(R.id.tombol_refresh);
        tombol_cari = (Button) findViewById(R.id.tombol_cari);

        adapter = new data_mitra_adapter_v2(result, this);
        layoutManager = new LinearLayoutManager(data_mitra_activity_v2.this);
        data_mitra_tampil.setLayoutManager(layoutManager);
        data_mitra_tampil.setAdapter(adapter);

        infogif = (RelativeLayout) findViewById(R.id.infogif);
        gif1 = (GifImageView) findViewById(R.id.gif1);
        gif2 = (GifImageView) findViewById(R.id.gif2);
        text1 = (TextView) findViewById(R.id.text1);
        text2 = (TextView) findViewById(R.id.text2);
        hidden_gif();

        Bundle bundle = getIntent().getExtras();

        id_member = (bundle.getString("id_member"));
        nama = (bundle.getString("nama"));
        point = (bundle.getString("point"));

        loading = new loading(this);
        mAPIService = data_mitra_apiutils.getAPIService();
        isRefresh = true;

        // Periksa dukungan NFC
        NfcAdapter nfcAdapter = NfcAdapter.getDefaultAdapter(this);
        if (nfcAdapter == null) {

            if (view_error == 1) {
                Toast.makeText(this, "Perangkat tidak mendukung NFC", Toast.LENGTH_LONG).show();
            }
        } else if (!nfcAdapter.isEnabled()) {
            Toast.makeText(this, "NFC dimatikan. Silakan aktifkan NFC di pengaturan.", Toast.LENGTH_LONG).show();
        }

        fetch_data_mitra();

        tombol_tambah.setVisibility(View.GONE);
        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(data_mitra_activity_v2.this, data_mitra_tambah.class);
                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            }
        });

        tombol_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                isRefresh = true;
                fetch_data_mitra();
            }
        });

        tombol_cari.setVisibility(View.GONE);
        tombol_cari.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DialogPencarian();
            }
        });
    }

    public void fetch_data_mitra() {
        if (isRefresh) {
            loading.showDialog(1, "Please Wait", "Loading Data..");
        }
        String token = new config_global().ambil(this);
        config_sessionmanager = new config_sessionmanager(data_mitra_activity_v2.this);
        String id_mitra = new config_global().capitalize(config_sessionmanager.getSPJabatan());

        mAPIService.tampil_data_mitra(
                "id_mitra", id_mitra, "", "", "", "", "Bearer " + token
        ).enqueue(new Callback<data_mitra_api>() {
            @Override
            public void onResponse(Call<data_mitra_api> call, Response<data_mitra_api> response) {
                data_mitra_api response_data = response.body();
                adapter.updateResults(response_data.get_data_mitra());

                int jumlah_data = data_mitra_tampil.getAdapter().getItemCount();
                if (jumlah_data < 1) {
                    gif_no_data();
                } else {
                    hidden_gif();
                }

                if (isRefresh) {
                    Toast.makeText(data_mitra_activity_v2.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
                    loading.hideDialog();
                    isRefresh = false;
                }
            }

            @Override
            public void onFailure(Call<data_mitra_api> call, Throwable t) {
                if (isRefresh) {
                    loading.hideDialog();
                    isRefresh = false;
                }
                gif_no_internet();
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_CODE_TAMBAH) {
            if (resultCode == RESULT_OK) {
                isRefresh = true;
                fetch_data_mitra();
            }
        }
    }

    private void DialogPencarian() {
        dialog = new AlertDialog.Builder(data_mitra_activity_v2.this);
        inflater = getLayoutInflater();
        dialogView = inflater.inflate(R.layout.data_mitra_pencarian, null);
        dateFormatter = new SimpleDateFormat("dd-MM-yyyy", Locale.US);
        dialog.setView(dialogView);
        dialog.setCancelable(false);
        editPencarian = (EditText) dialogView.findViewById(R.id.editPencarian);

        final ArrayAdapter<String> adapter = new ArrayAdapter<>(this,
                android.R.layout.simple_dropdown_item_1line, spinnerArray);

        filter_tanggal = (CardView) dialogView.findViewById(R.id.filter_tanggal);
        filter_tanggal.setVisibility(View.GONE);

        spinnerPencarian = (Spinner) dialogView.findViewById(R.id.spinnerPencarian);
        spinnerPencarian.setAdapter(adapter);

        tvDateResult = (TextView) dialogView.findViewById(R.id.tv_dateresult);
        tvDateResult1 = (TextView) dialogView.findViewById(R.id.tv_dateresult1);
        btDatePicker = (Button) dialogView.findViewById(R.id.bt_datepicker);
        btDatePicker.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar newCalendar = Calendar.getInstance();
                datePickerDialog = new DatePickerDialog(data_mitra_activity_v2.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                                Calendar newDate = Calendar.getInstance();
                                newDate.set(year, monthOfYear, dayOfMonth);
                                tvDateResult.setText(dateFormatter.format(newDate.getTime()));
                            }
                        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));

                datePickerDialog.show();
            }
        });

        btDatePicker1 = (Button) dialogView.findViewById(R.id.bt_datepicker1);
        btDatePicker1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar newCalendar = Calendar.getInstance();
                datePickerDialog = new DatePickerDialog(data_mitra_activity_v2.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                                Calendar newDate = Calendar.getInstance();
                                newDate.set(year, monthOfYear, dayOfMonth);
                                tvDateResult1.setText(dateFormatter.format(newDate.getTime()));
                            }
                        }, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));

                datePickerDialog.show();
            }
        });

        dialog.setPositiveButton("Cari", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                fetch_pencarian();
                dialog.dismiss();
            }
        });

        dialog.setNegativeButton("Batal", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });

        dialog.show();
    }

    void fetch_pencarian() {
        String token = new config_global().ambil(this);
        mAPIService.tampil_data_mitra(
                spinnerPencarian.getSelectedItem().toString(),
                editPencarian.getText().toString(),
                "7",
                "1",
                tvDateResult.getText().toString(),
                tvDateResult1.getText().toString(),
                "Bearer " + token
        ).enqueue(new Callback<data_mitra_api>() {
            @Override
            public void onResponse(Call<data_mitra_api> call, Response<data_mitra_api> response) {
                data_mitra_api response_data = response.body();
                adapter.updateResults(response_data.get_data_mitra());
                if (isRefresh) {
                    Toast.makeText(data_mitra_activity_v2.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
                    isRefresh = false;
                }
            }

            @Override
            public void onFailure(Call<data_mitra_api> call, Throwable t) {
                gif_no_internet();
            }
        });
    }

    @Override
    public void onStart() {
        super.onStart();
        timer = new Timer();
        timer.scheduleAtFixedRate(new TimerTask() {
            @Override
            public void run() {
                try {
                    fetch_data_mitra();
                } catch (Exception e) {
                }
            }
        }, 0, 20000);
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        timer.cancel();
    }

    public data_mitra_activity_v2() {
        techList = new String[][]{
                new String[]{
                        NfcA.class.getName(),
                        NfcB.class.getName(),
                        NfcF.class.getName(),
                        NfcV.class.getName(),
                        IsoDep.class.getName(),
                        MifareClassic.class.getName(),
                        MifareUltralight.class.getName(), Ndef.class.getName()
                }
        };
    }

    private final String[][] techList;

    @Override
    public void onResume() {
        super.onResume();

        timer = new Timer();
        timer.scheduleAtFixedRate(new TimerTask() {
            @Override
            public void run() {
                try {
                    fetch_data_mitra();
                } catch (Exception e) {
                }
            }
        }, 0, 20000);

        NfcAdapter nfcAdapter = NfcAdapter.getDefaultAdapter(this);
        if (nfcAdapter != null && nfcAdapter.isEnabled()) {
            int flags = 0;
            if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.S) {
                // Untuk Android 12 (S) ke atas, WAJIB pakai FLAG_MUTABLE untuk NFC
                flags = PendingIntent.FLAG_MUTABLE;
            } else {
                // Untuk Android di bawah 12
                flags = 0;
            }

            PendingIntent pendingIntent = PendingIntent.getActivity(
                    this,
                    0,
                    new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP),
                    flags // Gunakan variabel flags yang sudah diset
            );
            IntentFilter filter = new IntentFilter();
            filter.addAction(NfcAdapter.ACTION_TAG_DISCOVERED);
            filter.addAction(NfcAdapter.ACTION_NDEF_DISCOVERED);
            filter.addAction(NfcAdapter.ACTION_TECH_DISCOVERED);
            nfcAdapter.enableForegroundDispatch(this, pendingIntent, new IntentFilter[]{filter}, this.techList);
        }
    }

    @Override
    protected void onPause() {
        super.onPause();
        timer.cancel();

        NfcAdapter nfcAdapter = NfcAdapter.getDefaultAdapter(this);
        if (nfcAdapter != null) {
            nfcAdapter.disableForegroundDispatch(this);
        }
    }

    @Override
    protected void onNewIntent(Intent intent) {
        super.onNewIntent(intent);
        if (intent.getAction().equals(NfcAdapter.ACTION_TAG_DISCOVERED)) {
            Toast.makeText(data_mitra_activity_v2.this, "BERHASIL MENDETEKSI NFC, MEMBERCARD KODE CBS : NFC Tag\n" +
                    ByteArrayToHexString(intent.getByteArrayExtra(NfcAdapter.EXTRA_ID)), Toast.LENGTH_LONG).show();
            Bundle bundle1 = new Bundle();
            String id_mitra = (bundle1.getString("id_mitra"));
            Bundle bundle = new Bundle();
            bundle.putString("id_member", ByteArrayToHexString(intent.getByteArrayExtra(NfcAdapter.EXTRA_ID)));
            bundle.putString("id_mitra", id_mitra);
            Intent intents = new Intent(data_mitra_activity_v2.this, data_promo_activity_v2.class);
            intents.putExtras(bundle);
            startActivity(intents);
        }
    }

    private String ByteArrayToHexString(byte[] inarray) {
        int i, j, in;
        String[] hex = {"0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F"};
        String out = "";
        for (j = 0; j < inarray.length; ++j) {
            in = (int) inarray[j] & 0xff;
            i = (in >> 4) & 0x0f;
            out += hex[i];
            i = in & 0x0f;
            out += hex[i];
        }
        return out;
    }

    @Override
    public void onBackPressed() {
        finish();
    }
}