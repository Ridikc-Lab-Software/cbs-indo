package com.project.aplikasi.petugas_cbs.data_galery;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class data_galery_tambah extends AppCompatActivity {

	String validasi;
    Button tombol_simpan;
    data_galery_apiservice mAPIService;
    EditText id_galery
			 ,tanggal
			 ,judul
			 ,foto
			 ,isi
			 ;
	loading loading;
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_galery_tambah );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
		loading = new loading(this);
        id_galery = (EditText) findViewById(R.id.id_galery);
		tanggal = (EditText) findViewById(R.id.tanggal);
		judul = (EditText) findViewById(R.id.judul);
		foto = (EditText) findViewById(R.id.foto);
		isi = (EditText) findViewById(R.id.isi);
		
		id_galery.setText( config_global.generate_id(this,"data_galery") );
        mAPIService = data_galery_apiutils.getAPIService();

		config_global.init_inputTypes();
		

        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
                id_galery.setText( config_global.generate_id(data_galery_tambah.this,"data_galery") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_galery_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    
                }  else {
					
				String token = "Bearer " + new config_global().ambil(data_galery_tambah.this);
                mAPIService.proses_simpan_data_galery(id_galery.getText().toString()
						,tanggal.getText().toString()
                        ,judul.getText().toString()
                        ,foto.getText().toString()
                        ,isi.getText().toString()
                        
						,token
                        
                ).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_galery_tambah.this, "Berhasil Disimpan", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
                        clearForm((ViewGroup) findViewById(R.id.group));
                         id_galery.requestFocus();
                         loading.hideDialog();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_galery_tambah.this, "Gagal Disimpan", Toast.LENGTH_LONG).show();
						 loading.hideDialog();
                    }
                });
				}
            }
        });
    }
	
	public void validasiForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                if(!TextUtils.isEmpty(((EditText)view).getText().toString()))  {
                }  else  {
                    validasi = "gagal";
                    ((EditText)view).setError("Silahkan Input Terlebih Dahulu");
                    ((EditText)view).requestFocus();
                }
            }
            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                validasiForm((ViewGroup)view);
        }
    }

    private void clearForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                ((EditText)view).setText("");
            }
            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                clearForm((ViewGroup)view);
        }
    }

    
}







