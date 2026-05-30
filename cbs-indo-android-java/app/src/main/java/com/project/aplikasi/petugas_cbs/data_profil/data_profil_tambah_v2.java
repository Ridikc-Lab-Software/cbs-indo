package com.project.aplikasi.petugas_cbs.data_profil;
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

public class data_profil_tambah_v2 extends AppCompatActivity {

	String validasi;
    Button tombol_simpan, tombol_tambah;
    data_profil_apiservice mAPIService;
    EditText id_profil
            ,nama
			 ,alamat
			 ,no_telepon
			 ,sejarah
			 ,visi
			 ,misi
			 ,deskripsi
			 ,foto
			 ;

    data_profil_tambah_v2_adapter adapter;
    ListView data_profil_tampil;
	loading loading;

    ArrayList<data_profil_apidata> result = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_profil_tambah_v2 );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        tombol_tambah = (Button) findViewById(R.id.btnTambah);
		loading = new loading(this);
		
        id_profil = (EditText) findViewById(R.id.id_profil);
        nama = (EditText) findViewById(R.id.nama);
		alamat = (EditText) findViewById(R.id.alamat);
		no_telepon = (EditText) findViewById(R.id.no_telepon);
		sejarah = (EditText) findViewById(R.id.sejarah);
		visi = (EditText) findViewById(R.id.visi);
		misi = (EditText) findViewById(R.id.misi);
		deskripsi = (EditText) findViewById(R.id.deskripsi);
		foto = (EditText) findViewById(R.id.foto);
		

		id_profil.setText( config_global.generate_id(this,"data_profil") );
		
        data_profil_tampil = (ListView) findViewById(R.id.cvdata_profil);

        adapter = new data_profil_tambah_v2_adapter(this, result);
        data_profil_tampil.setAdapter(adapter);

        mAPIService = data_profil_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		

        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
				id_profil.setText( config_global.generate_id(data_profil_tambah_v2.this,"data_profil") );
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_profil_tambah_v2.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
					String token = "Bearer " + new config_global().ambil(data_profil_tambah_v2.this);
					mAPIService.proses_simpan_data_profil(id_profil.getText().toString()
							,nama.getText().toString()
                        ,alamat.getText().toString()
                        ,no_telepon.getText().toString()
                        ,sejarah.getText().toString()
                        ,visi.getText().toString()
                        ,misi.getText().toString()
                        ,deskripsi.getText().toString()
                        ,foto.getText().toString()
                        
							,token
					).enqueue(new Callback<Object>() {
						@Override
						public void onResponse(Call<Object> call, Response<Object> response) {
							Toast.makeText( data_profil_tambah_v2.this, "Berhasil Disimpan",
									Toast.LENGTH_LONG).show();
							result.add(new data_profil_apidata(
									id_profil.getText().toString()
									,nama.getText().toString()
						,alamat.getText().toString()
						,no_telepon.getText().toString()
						,sejarah.getText().toString()
						,visi.getText().toString()
						,misi.getText().toString()
						,deskripsi.getText().toString()
						,foto.getText().toString()
						
							));
							adapter.updateResults(result);
							clearForm((ViewGroup) findViewById(R.id.group));
							id_profil.requestFocus();
							loading.hideDialog();
						}
	
						@Override
						public void onFailure(Call<Object> call, Throwable t) {
							Toast.makeText( data_profil_tambah_v2.this, "Gagal Disimpan",
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








