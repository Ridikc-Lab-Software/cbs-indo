package com.project.aplikasi.petugas_cbs.data_promo;
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
import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

public class data_promo_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_promo
			,tanggal_mulai_berlaku
            ,tanggal_batas_berlaku
            ,nama_promo
            ,keterangan
            ,syarat_dan_ketentuan
            ,foto_promo
            ,jumlah_point
            ,status
            
            ;
    data_promo_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_promo_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_promo = (EditText) findViewById(R.id.id_promo);
		tanggal_mulai_berlaku = (EditText) findViewById(R.id.tanggal_mulai_berlaku);
        tanggal_batas_berlaku = (EditText) findViewById(R.id.tanggal_batas_berlaku);
        nama_promo = (EditText) findViewById(R.id.nama_promo);
        keterangan = (EditText) findViewById(R.id.keterangan);
        syarat_dan_ketentuan = (EditText) findViewById(R.id.syarat_dan_ketentuan);
        foto_promo = (EditText) findViewById(R.id.foto_promo);
        jumlah_point = (EditText) findViewById(R.id.jumlah_point);
        status = (EditText) findViewById(R.id.status);
        

        Bundle bundle = getIntent().getExtras();

        id_promo.setText(bundle.getString("id_promo"));
		tanggal_mulai_berlaku.setText(bundle.getString("tanggal_mulai_berlaku"));
		tanggal_batas_berlaku.setText(bundle.getString("tanggal_batas_berlaku"));
		nama_promo.setText(bundle.getString("nama_promo"));
		keterangan.setText(bundle.getString("keterangan"));
		syarat_dan_ketentuan.setText(bundle.getString("syarat_dan_ketentuan"));
		foto_promo.setText(bundle.getString("foto_promo"));
		jumlah_point.setText(bundle.getString("jumlah_point"));
		status.setText(bundle.getString("status"));
		

        mAPIService = data_promo_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		jumlah_point.setInputType(inputTypes.get(4).value);
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_promo_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_promo_edit.this);
                mAPIService.proses_update_data_promo(id_promo.getText().toString()
				, tanggal_mulai_berlaku.getText().toString()
				, tanggal_batas_berlaku.getText().toString()
				, nama_promo.getText().toString()
				, keterangan.getText().toString()
				, syarat_dan_ketentuan.getText().toString()
				, foto_promo.getText().toString()
				, jumlah_point.getText().toString()
				, status.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_promo_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_promo_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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








