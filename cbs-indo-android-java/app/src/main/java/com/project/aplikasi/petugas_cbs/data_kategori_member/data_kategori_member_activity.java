package com.project.aplikasi.petugas_cbs.data_kategori_member;

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

public class data_kategori_member_activity extends AppCompatActivity {

    ArrayList<data_kategori_member_apidata> result = new ArrayList<>();
    data_kategori_member_adapter adapter;
    ListView data_kategori_member_tampil;
    data_kategori_member_apiservice mAPIService;
    Button tombol_tambah,tombol_refresh ;
    protected int REQUEST_CODE_TAMBAH = 3543;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_kategori_member_activity );

        data_kategori_member_tampil = (ListView) findViewById(R.id.data_kategori_member_tampil);
        tombol_tambah = (Button) findViewById(R.id.tombol_tambah);
		tombol_refresh = (Button) findViewById(R.id.tombol_refresh);
		loading = new loading(this);

        adapter = new data_kategori_member_adapter(this, result);
        data_kategori_member_tampil.setAdapter(adapter);
        data_kategori_member_tampil.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });

        mAPIService = data_kategori_member_apiutils.getAPIService();
        fetch_data_kategori_member();

        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent( data_kategori_member_activity.this, data_kategori_member_tambah.class);
                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            }
        });
		
		tombol_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                fetch_data_kategori_member();
				 Toast.makeText(data_kategori_member_activity.this, "Data Berhasil Diperbarui",
                            Toast.LENGTH_SHORT).show();
            }
        });


    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_CODE_TAMBAH){
            if (resultCode == RESULT_OK){
                fetch_data_kategori_member();
            }
        }

    }

    public void fetch_data_kategori_member(){
		loading.showDialog(1,"Please Wait","Loading Data..");
		String token = new config_global().ambil(this);
        mAPIService.tampil_data_kategori_member("", "", "","","","", "Bearer "+token
        ).enqueue(new Callback<data_kategori_member_api>() {
            @Override
            public void onResponse(Call<data_kategori_member_api> call, Response<data_kategori_member_api> response) {
				loading.hideDialog();
                data_kategori_member_api response_data = response.body();
                Log.d("data", response_data.toString());
                adapter.updateResults(response_data.get_data_kategori_member());
            }

            @Override
            public void onFailure(Call<data_kategori_member_api> call, Throwable t) {
				loading.hideDialog();
            }
        });
    }
}


