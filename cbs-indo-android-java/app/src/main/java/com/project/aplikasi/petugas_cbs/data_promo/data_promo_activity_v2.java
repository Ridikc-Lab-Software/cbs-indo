package com.project.aplikasi.petugas_cbs.data_promo;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.cardview.widget.CardView;

import android.app.DatePickerDialog;
import android.content.DialogInterface;
import android.content.Intent;
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


public class data_promo_activity_v2 extends AppCompatActivity {

    ArrayList<data_promo_apidata> result = new ArrayList<>();
    data_promo_adapter_v2 adapter;
    RecyclerView data_promo_tampil;
    data_promo_apiservice mAPIService;
    Button tombol_tambah, tombol_refresh, tombol_cari ;
    TextView a,b;
    protected int REQUEST_CODE_TAMBAH = 3543;
    RecyclerView.LayoutManager layoutManager;
    Boolean isRefresh = false;
    Toolbar toolbar;
    AlertDialog.Builder dialog;
    LayoutInflater inflater;
    View dialogView;
    Spinner spinnerPencarian;
	private CardView filter_tanggal;
    private DatePickerDialog datePickerDialog;
    private SimpleDateFormat dateFormatter;
    private TextView tvDateResult;
    private Button btDatePicker;
    private TextView tvDateResult1;
    private Button btDatePicker1;
    private EditText editPencarian;

    private String[] spinnerArray = {
			"nama_promo"
    };
	
	private Timer timer;
	
	RelativeLayout infogif;
    GifImageView gif1;
    GifImageView gif2;
    TextView text1,text2;
	loading loading;
	static String id_member;
    static String point;
    static String nama;
    static String id_mitra;
    static String nama_mitra;

    private void gif_no_internet()
    {
        data_promo_tampil.setVisibility( View.GONE );
        infogif.setVisibility( View.VISIBLE );
        gif1.setVisibility( View.VISIBLE );
        gif2.setVisibility( View.INVISIBLE );
        text1.setText( "Tidak ada Koneksi Internet" );
        text2.setText( "Silahkan Coba Lagi" );
    }

    private void gif_no_data()
    {
        data_promo_tampil.setVisibility( View.GONE );
        infogif.setVisibility( View.VISIBLE );
        gif1.setVisibility( View.INVISIBLE );
        gif2.setVisibility( View.VISIBLE );
        text1.setText( "Tidak ada data" );
        text2.setText( "Data Masih Kosong" );
    }

    private void hidden_gif()
    {
        infogif.setVisibility( View.GONE );
        gif1.setVisibility( View.GONE );
        gif2.setVisibility( View.GONE );
        data_promo_tampil.setVisibility( View.VISIBLE );
    }
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_promo_activity_v2);

        data_promo_tampil = (RecyclerView) findViewById(R.id.data_promo_tampil);
        tombol_tambah = (Button) findViewById(R.id.tombol_tambah);
        tombol_refresh = (Button) findViewById(R.id.tombol_refresh);
        tombol_cari = (Button) findViewById(R.id.tombol_cari);

        adapter = new data_promo_adapter_v2(result, this);
        layoutManager = new LinearLayoutManager(data_promo_activity_v2.this);
        data_promo_tampil.setLayoutManager(layoutManager);
        data_promo_tampil.setAdapter(adapter);
		
		infogif = (RelativeLayout) findViewById(R.id.infogif );
        gif1 = (GifImageView) findViewById(R.id.gif1 );
        gif2 = (GifImageView) findViewById(R.id.gif2 );
        text1 = (TextView) findViewById(R.id.text1 );
        text2 = (TextView) findViewById(R.id.text2 );
        a = (TextView) findViewById(R.id.a );
        b = (TextView) findViewById(R.id.b );
        hidden_gif();

		loading = new loading(this);
        mAPIService = data_promo_apiutils.getAPIService();
        fetch_data_promo();

        Bundle bundle = getIntent().getExtras();


        id_member = (bundle.getString("id_member"));
        nama = (bundle.getString("nama"));
        point = (bundle.getString("point"));
        id_mitra = (bundle.getString("id_mitra"));
        nama_mitra = (bundle.getString("nama_mitra"));



        a.setText(bundle.getString("nama"));
        b.setText("Point : "+bundle.getString("point")+" Point");

        tombol_tambah.setVisibility(View.GONE);
        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent( data_promo_activity_v2.this,
                        data_promo_tambah.class);
                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            }
        });

        tombol_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                isRefresh = true;
                fetch_data_promo();
            }
        });

        tombol_cari.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DialogPencarian();
            }
        });
        fetch_data_promo();

    }

    public void fetch_data_promo(){
		
		if (isRefresh){
			loading.showDialog(1,"Please Wait","Loading Data..");
          }
        String token = new config_global().ambil(this);
        mAPIService.tampil_data_promo(
                "","", id_member, "","","", "Bearer "+token
        ).enqueue(new Callback<data_promo_api>() {
            @Override
            public void onResponse(Call<data_promo_api> call, Response<data_promo_api> response) {
				
                data_promo_api response_data = response.body();
                adapter.updateResults(response_data.get_data_promo());

				int jumlah_data = data_promo_tampil.getAdapter().getItemCount();
                if (jumlah_data<1)
                {
                    gif_no_data();
                }
                else
                {
                    hidden_gif();
                }

                if (isRefresh){
                    Toast.makeText(data_promo_activity_v2.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
					loading.hideDialog();
                    isRefresh = false;
                }
            }

            @Override
            public void onFailure(Call<data_promo_api> call, Throwable t) {
				if (isRefresh){
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
        if (requestCode == REQUEST_CODE_TAMBAH){
            if (resultCode == RESULT_OK){
                isRefresh = true;
                fetch_data_promo();
            }
        }

    }

    private void DialogPencarian() {
        dialog = new AlertDialog.Builder(data_promo_activity_v2.this);
        inflater = getLayoutInflater();
        dialogView = inflater.inflate(R.layout.data_promo_pencarian, null);
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
                datePickerDialog = new DatePickerDialog(data_promo_activity_v2.this,
                    new DatePickerDialog.OnDateSetListener() {

                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                        Calendar newDate = Calendar.getInstance();
                        newDate.set(year, monthOfYear, dayOfMonth);
                        tvDateResult.setText(dateFormatter.format(newDate.getTime()));
                    }

                },newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));

                datePickerDialog.show();
            }
        });

        btDatePicker1 = (Button) dialogView.findViewById(R.id.bt_datepicker1);
        btDatePicker1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar newCalendar = Calendar.getInstance();
                datePickerDialog = new DatePickerDialog(data_promo_activity_v2.this,
                        new DatePickerDialog.OnDateSetListener() {

                            @Override
                            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                                Calendar newDate = Calendar.getInstance();
                                newDate.set(year, monthOfYear, dayOfMonth);
                                tvDateResult1.setText(dateFormatter.format(newDate.getTime()));
                            }

                        },newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));

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
        mAPIService.tampil_data_promo(
                spinnerPencarian.getSelectedItem().toString(),
                editPencarian.getText().toString(),
                "7",
                "1",
                tvDateResult.getText().toString(),
                tvDateResult1.getText().toString(),
                "Bearer "+token
        ).enqueue(new Callback<data_promo_api>() {
            @Override
            public void onResponse(Call<data_promo_api> call, Response<data_promo_api> response) {
                data_promo_api response_data = response.body();
                adapter.updateResults(response_data.get_data_promo());
                if (isRefresh){
                    Toast.makeText(data_promo_activity_v2.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
                    isRefresh = false;
                }
            }

            @Override
            public void onFailure(Call<data_promo_api> call, Throwable t) {
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
                                              fetch_data_promo();
                                          } catch (Exception e) {

                                          }
                                      }
                                  },
                0,
                20000);
    }

    @Override
    public void onResume() {
        super.onResume();

        timer = new Timer();
        timer.scheduleAtFixedRate(new TimerTask() {
                                      @Override
                                      public void run() {
                                          try {

                                              fetch_data_promo();

                                          } catch (Exception e) {

                                          }
                                      }
                                  },
                0,
                1000);
    }

    @Override
    public void onStop() {
        super.onStop();
        timer.cancel();
    }

    @Override
    public void onPause() {
        super.onPause();
        timer.cancel();
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        timer.cancel();
    }

}




