package com.project.aplikasi.petugas_cbs.data_redeem;
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

public class data_redeem_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_redeem
			,tanggal
            ,jam
            ,id_member
            ,id_mitra
            ,id_promo
            ,point
            ,status
            
            ;
    data_redeem_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_redeem_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_redeem = (EditText) findViewById(R.id.id_redeem);
		tanggal = (EditText) findViewById(R.id.tanggal);
        jam = (EditText) findViewById(R.id.jam);
        id_member = (EditText) findViewById(R.id.id_member);
        id_mitra = (EditText) findViewById(R.id.id_mitra);
        id_promo = (EditText) findViewById(R.id.id_promo);
        point = (EditText) findViewById(R.id.point);
        status = (EditText) findViewById(R.id.status);
        

        Bundle bundle = getIntent().getExtras();

        id_redeem.setText(bundle.getString("id_redeem"));
		tanggal.setText(bundle.getString("tanggal"));
		jam.setText(bundle.getString("jam"));
		id_member.setText(bundle.getString("id_member"));
		id_mitra.setText(bundle.getString("id_mitra"));
		id_promo.setText(bundle.getString("id_promo"));
		point.setText(bundle.getString("point"));
		status.setText(bundle.getString("status"));
		

        mAPIService = data_redeem_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_redeem_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_redeem_edit.this);
                mAPIService.proses_update_data_redeem(id_redeem.getText().toString()
				, tanggal.getText().toString()
				, jam.getText().toString()
				, id_member.getText().toString()
				, id_mitra.getText().toString()
				, id_promo.getText().toString()
				, point.getText().toString()
				, status.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_redeem_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_redeem_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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








