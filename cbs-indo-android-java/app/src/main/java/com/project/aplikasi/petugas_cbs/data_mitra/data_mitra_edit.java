package com.project.aplikasi.petugas_cbs.data_mitra;
import androidx.appcompat.app.AppCompatActivity;
import android.text.TextUtils;
import android.os.Bundle;
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

public class data_mitra_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
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
    data_mitra_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_mitra_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
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
        

        Bundle bundle = getIntent().getExtras();

        id_mitra.setText(bundle.getString("id_mitra"));
		nama_mitra.setText(bundle.getString("nama_mitra"));
		alamat.setText(bundle.getString("alamat"));
		no_telepon.setText(bundle.getString("no_telepon"));
		nama_pemilik.setText(bundle.getString("nama_pemilik"));
		no_telepon_pemilik.setText(bundle.getString("no_telepon_pemilik"));
		tanggal_daftar.setText(bundle.getString("tanggal_daftar"));
		username.setText(bundle.getString("username"));
		password.setText(bundle.getString("password"));
		status.setText(bundle.getString("status"));
		gambar_logo.setText(bundle.getString("gambar_logo"));
		

        mAPIService = data_mitra_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_mitra_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_mitra_edit.this);
                mAPIService.proses_update_data_mitra(id_mitra.getText().toString()
				, nama_mitra.getText().toString()
				, alamat.getText().toString()
				, no_telepon.getText().toString()
				, nama_pemilik.getText().toString()
				, no_telepon_pemilik.getText().toString()
				, tanggal_daftar.getText().toString()
				, username.getText().toString()
				, password.getText().toString()
				, status.getText().toString()
				, gambar_logo.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_mitra_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_mitra_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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
                }
			  }
                if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                    validasiForm((ViewGroup)view);
            }
    }
	
}








