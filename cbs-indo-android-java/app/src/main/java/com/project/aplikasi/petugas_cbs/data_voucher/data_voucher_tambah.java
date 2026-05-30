package com.project.aplikasi.petugas_cbs.data_voucher;

import androidx.appcompat.app.AlertDialog;
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

import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

public class data_voucher_tambah extends AppCompatActivity {

	String validasi;
    Button tombol_simpan;
    data_voucher_apiservice mAPIService;
    EditText id_voucher
    ,qrcode
    ,id_relasi
    ,nominal
    ,tanggal_kadaluarsa
    ,id_spbu
    ,id_penjualan_voucher
    ,status
    ,file_voucher
    ,tanggal_dibuka
;
	loading loading;
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_voucher_tambah );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
		loading = new loading(this);
        id_voucher = (EditText) findViewById(R.id.id_voucher);
        qrcode = (EditText) findViewById(R.id.qrcode);
        id_relasi = (EditText) findViewById(R.id.id_relasi);
        nominal = (EditText) findViewById(R.id.nominal);
        tanggal_kadaluarsa = (EditText) findViewById(R.id.tanggal_kadaluarsa);
        id_spbu = (EditText) findViewById(R.id.id_spbu);
        id_penjualan_voucher = (EditText) findViewById(R.id.id_penjualan_voucher);
        status = (EditText) findViewById(R.id.status);
        file_voucher = (EditText) findViewById(R.id.file_voucher);
        tanggal_dibuka = (EditText) findViewById(R.id.tanggal_dibuka);

		id_voucher.setText( config_global.generate_id(this,"data_voucher") );
        mAPIService = data_voucher_apiutils.getAPIService();

		config_global.init_inputTypes();


        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
                id_voucher.setText( config_global.generate_id(data_voucher_tambah.this,"data_voucher") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_voucher_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    
                }  else {
					
				String token = "Bearer " + new config_global().ambil(data_voucher_tambah.this);
                mAPIService.proses_simpan_data_voucher(id_voucher.getText().toString()
						,qrcode.getText().toString()
						,id_relasi.getText().toString()
						,nominal.getText().toString()
						,tanggal_kadaluarsa.getText().toString()
						,id_spbu.getText().toString()
						,id_penjualan_voucher.getText().toString()
						,status.getText().toString()
						,file_voucher.getText().toString()
						,tanggal_dibuka.getText().toString()

						,token
                        
                ).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_voucher_tambah.this, "Berhasil Disimpan", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
                        clearForm((ViewGroup) findViewById(R.id.group));
                         id_voucher.requestFocus();
                         loading.hideDialog();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_voucher_tambah.this, "Gagal Disimpan", Toast.LENGTH_LONG).show();
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
