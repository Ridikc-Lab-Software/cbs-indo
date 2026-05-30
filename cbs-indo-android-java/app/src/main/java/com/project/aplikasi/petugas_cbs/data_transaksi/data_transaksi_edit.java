package com.project.aplikasi.petugas_cbs.data_transaksi;
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

public class data_transaksi_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_transaksi
			,tanggal
            ,jam
            ,id_member
            ,id_petugas
            ,id_kategori_member
            ,id_jenis_transaksi
            ,point
            ,jumlah
            
            ;
    data_transaksi_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_transaksi_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_transaksi = (EditText) findViewById(R.id.id_transaksi);
		tanggal = (EditText) findViewById(R.id.tanggal);
        jam = (EditText) findViewById(R.id.jam);
        id_member = (EditText) findViewById(R.id.id_member);
        id_petugas = (EditText) findViewById(R.id.id_petugas);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
        point = (EditText) findViewById(R.id.point);
        jumlah = (EditText) findViewById(R.id.jumlah);
        

        Bundle bundle = getIntent().getExtras();

        id_transaksi.setText(bundle.getString("id_transaksi"));
		tanggal.setText(bundle.getString("tanggal"));
		jam.setText(bundle.getString("jam"));
		id_member.setText(bundle.getString("id_member"));
		id_petugas.setText(bundle.getString("id_petugas"));
		id_kategori_member.setText(bundle.getString("id_kategori_member"));
		id_jenis_transaksi.setText(bundle.getString("id_jenis_transaksi"));
		point.setText(bundle.getString("point"));
		jumlah.setText(bundle.getString("jumlah"));
		

        mAPIService = data_transaksi_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		jumlah.setInputType(inputTypes.get(4).value);
		

        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_transaksi_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_transaksi_edit.this);
                mAPIService.proses_update_data_transaksi(id_transaksi.getText().toString()
				, tanggal.getText().toString()
				, jam.getText().toString()
				, id_member.getText().toString()
				, id_petugas.getText().toString()
				, id_kategori_member.getText().toString()
				, id_jenis_transaksi.getText().toString()
				, point.getText().toString()
				, jumlah.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_transaksi_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_transaksi_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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














