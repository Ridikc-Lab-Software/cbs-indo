package com.project.aplikasi.petugas_cbs.data_jenis_transaksi;
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

public class data_jenis_transaksi_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_jenis_transaksi
			,jenis_transaksi
            ,gambar_logo
            
            ;
    data_jenis_transaksi_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_jenis_transaksi_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
		jenis_transaksi = (EditText) findViewById(R.id.jenis_transaksi);
        gambar_logo = (EditText) findViewById(R.id.gambar_logo);
        

        Bundle bundle = getIntent().getExtras();

        id_jenis_transaksi.setText(bundle.getString("id_jenis_transaksi"));
		jenis_transaksi.setText(bundle.getString("jenis_transaksi"));
		gambar_logo.setText(bundle.getString("gambar_logo"));
		

        mAPIService = data_jenis_transaksi_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_jenis_transaksi_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_jenis_transaksi_edit.this);
                mAPIService.proses_update_data_jenis_transaksi(id_jenis_transaksi.getText().toString()
				, jenis_transaksi.getText().toString()
				, gambar_logo.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_jenis_transaksi_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_jenis_transaksi_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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








