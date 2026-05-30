package com.project.aplikasi.petugas_cbs.data_petugas;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class data_petugas_activity extends AppCompatActivity {

    ArrayList<data_petugas_apidata> result = new ArrayList<>();
    data_petugas_adapter adapter;
    ListView data_petugas_tampil;
    data_petugas_apiservice mAPIService;
    Button tombol_tambah,tombol_refresh ;
    protected int REQUEST_CODE_TAMBAH = 3543;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_petugas_activity );

        data_petugas_tampil = (ListView) findViewById(R.id.data_petugas_tampil);
        tombol_tambah = (Button) findViewById(R.id.tombol_tambah);
		tombol_refresh = (Button) findViewById(R.id.tombol_refresh);
		loading = new loading(this);

        adapter = new data_petugas_adapter(this, result);
        data_petugas_tampil.setAdapter(adapter);
        data_petugas_tampil.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });

        mAPIService = data_petugas_apiutils.getAPIService();
        fetch_data_petugas();

        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent( data_petugas_activity.this, data_petugas_tambah.class);
                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            }
        });
		
		tombol_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                fetch_data_petugas();
				 Toast.makeText(data_petugas_activity.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
            }
        });


    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_CODE_TAMBAH){
            if (resultCode == RESULT_OK){
                fetch_data_petugas();
            }
        }

    }

    public void fetch_data_petugas(){
		loading.showDialog(1,"Please Wait","Loading Data..");
		String token = new config_global().ambil(this);
        mAPIService.tampil_data_petugas("", "", "","","","", "Bearer "+token
        ).enqueue(new Callback<data_petugas_api>() {
            @Override
            public void onResponse(Call<data_petugas_api> call, Response<data_petugas_api> response) {
				loading.hideDialog();
                data_petugas_api response_data = response.body();
                Log.d("data", response_data.toString());
                adapter.updateResults(response_data.get_data_petugas());
            }

            @Override
            public void onFailure(Call<data_petugas_api> call, Throwable t) {
				loading.hideDialog();
            }
        });
    }
}


