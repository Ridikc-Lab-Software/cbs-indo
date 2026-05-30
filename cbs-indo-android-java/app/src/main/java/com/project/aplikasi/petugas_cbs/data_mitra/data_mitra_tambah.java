package com.project.aplikasi.petugas_cbs.data_mitra;

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

public class data_mitra_tambah extends AppCompatActivity {

	String validasi;
    Button tombol_simpan;
    data_mitra_apiservice mAPIService;
    EditText id_mitra
			 ,nama_mitra
			 ,alamat
			 ,no_telepon
			 ,nama_pemilik
			 ,no_telepon_pemilik
			 ,tanggal_daftar
			 ,username
			 ,password
			 ,status
			 ,gambar_logo
			 ;
	loading loading;
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_mitra_tambah );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
		loading = new loading(this);
        id_mitra = (EditText) findViewById(R.id.id_mitra);
		nama_mitra = (EditText) findViewById(R.id.nama_mitra);
		alamat = (EditText) findViewById(R.id.alamat);
		no_telepon = (EditText) findViewById(R.id.no_telepon);
		nama_pemilik = (EditText) findViewById(R.id.nama_pemilik);
		no_telepon_pemilik = (EditText) findViewById(R.id.no_telepon_pemilik);
		tanggal_daftar = (EditText) findViewById(R.id.tanggal_daftar);
		username = (EditText) findViewById(R.id.username);
		password = (EditText) findViewById(R.id.password);
		status = (EditText) findViewById(R.id.status);
		gambar_logo = (EditText) findViewById(R.id.gambar_logo);
		
		id_mitra.setText( config_global.generate_id(this,"data_mitra") );
        mAPIService = data_mitra_apiutils.getAPIService();

		config_global.init_inputTypes();
		

        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
                id_mitra.setText( config_global.generate_id(data_mitra_tambah.this,"data_mitra") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_mitra_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    
                }  else {
					
				String token = "Bearer " + new config_global().ambil(data_mitra_tambah.this);
                mAPIService.proses_simpan_data_mitra(id_mitra.getText().toString()
						,nama_mitra.getText().toString()
                        ,alamat.getText().toString()
                        ,no_telepon.getText().toString()
                        ,nama_pemilik.getText().toString()
                        ,no_telepon_pemilik.getText().toString()
                        ,tanggal_daftar.getText().toString()
                        ,username.getText().toString()
                        ,password.getText().toString()
                        ,status.getText().toString()
                        ,gambar_logo.getText().toString()
                        
						,token
                        
                ).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_mitra_tambah.this, "Berhasil Disimpan", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
                        clearForm((ViewGroup) findViewById(R.id.group));
                         id_mitra.requestFocus();
                         loading.hideDialog();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_mitra_tambah.this, "Gagal Disimpan", Toast.LENGTH_LONG).show();
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







