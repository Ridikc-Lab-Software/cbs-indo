package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;
import java.util.ArrayList;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class data_group_jenis_transaksi_tambah_v2 extends AppCompatActivity {

	String validasi;
    Button tombol_simpan, tombol_tambah;
    data_group_jenis_transaksi_apiservice mAPIService;
    EditText id_group_jenis_transaksi
            ,nama_group
			 ,id_jenis_transaksi
			 ,gambar_logo
			 ;

    data_group_jenis_transaksi_tambah_v2_adapter adapter;
    ListView data_group_jenis_transaksi_tampil;
	loading loading;

    ArrayList<data_group_jenis_transaksi_apidata> result = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_group_jenis_transaksi_tambah_v2 );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        tombol_tambah = (Button) findViewById(R.id.btnTambah);
		loading = new loading(this);
		
        id_group_jenis_transaksi = (EditText) findViewById(R.id.id_group_jenis_transaksi);
        nama_group = (EditText) findViewById(R.id.nama_group);
		id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
		gambar_logo = (EditText) findViewById(R.id.gambar_logo);
		

		id_group_jenis_transaksi.setText( config_global.generate_id(this,"data_group_jenis_transaksi") );
		
        data_group_jenis_transaksi_tampil = (ListView) findViewById(R.id.cvdata_group_jenis_transaksi);

        adapter = new data_group_jenis_transaksi_tambah_v2_adapter(this, result);
        data_group_jenis_transaksi_tampil.setAdapter(adapter);

        mAPIService = data_group_jenis_transaksi_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		

        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
				id_group_jenis_transaksi.setText( config_global.generate_id(data_group_jenis_transaksi_tambah_v2.this,"data_group_jenis_transaksi") );
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_group_jenis_transaksi_tambah_v2.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
					String token = "Bearer " + new config_global().ambil(data_group_jenis_transaksi_tambah_v2.this);
					mAPIService.proses_simpan_data_group_jenis_transaksi(id_group_jenis_transaksi.getText().toString()
							,nama_group.getText().toString()
                        ,id_jenis_transaksi.getText().toString()
                        ,gambar_logo.getText().toString()
                        
							,token
					).enqueue(new Callback<Object>() {
						@Override
						public void onResponse(Call<Object> call, Response<Object> response) {
							Toast.makeText( data_group_jenis_transaksi_tambah_v2.this, "Berhasil Disimpan",
									Toast.LENGTH_LONG).show();
							result.add(new data_group_jenis_transaksi_apidata(
									id_group_jenis_transaksi.getText().toString()
									,nama_group.getText().toString()
						,id_jenis_transaksi.getText().toString()
						,gambar_logo.getText().toString()
						
							));
							adapter.updateResults(result);
							clearForm((ViewGroup) findViewById(R.id.group));
							id_group_jenis_transaksi.requestFocus();
							loading.hideDialog();
						}
	
						@Override
						public void onFailure(Call<Object> call, Throwable t) {
							Toast.makeText( data_group_jenis_transaksi_tambah_v2.this, "Gagal Disimpan",
									Toast.LENGTH_LONG).show();
									loading.hideDialog();
						}
					});
				}
            }
        });


        tombol_simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                setResult(RESULT_OK);
                finish();



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








