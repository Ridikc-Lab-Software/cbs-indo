package com.project.aplikasi.petugas_cbs.data_galery;
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

public class data_galery_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_galery
			,tanggal
            ,judul
            ,foto
            ,isi
            
            ;
    data_galery_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_galery_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_galery = (EditText) findViewById(R.id.id_galery);
		tanggal = (EditText) findViewById(R.id.tanggal);
        judul = (EditText) findViewById(R.id.judul);
        foto = (EditText) findViewById(R.id.foto);
        isi = (EditText) findViewById(R.id.isi);
        

        Bundle bundle = getIntent().getExtras();

        id_galery.setText(bundle.getString("id_galery"));
		tanggal.setText(bundle.getString("tanggal"));
		judul.setText(bundle.getString("judul"));
		foto.setText(bundle.getString("foto"));
		isi.setText(bundle.getString("isi"));
		

        mAPIService = data_galery_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_galery_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_galery_edit.this);
                mAPIService.proses_update_data_galery(id_galery.getText().toString()
				, tanggal.getText().toString()
				, judul.getText().toString()
				, foto.getText().toString()
				, isi.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_galery_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_galery_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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








