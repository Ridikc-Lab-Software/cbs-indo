package com.project.aplikasi.petugas_cbs.data_transaksi_voucher;
import androidx.appcompat.app.AlertDialog;
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

public class data_transaksi_voucher_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_transaksi_voucher
    ,id_voucher
    ,id_member
    ,nama_member
    ,tanggal_transaksi
    ,jenis_bbm
    ,nominal

            ;
    data_transaksi_voucher_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_transaksi_voucher_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_transaksi_voucher = (EditText) findViewById(R.id.id_transaksi_voucher);
        id_voucher = (EditText) findViewById(R.id.id_voucher);
        id_member = (EditText) findViewById(R.id.id_member);
        nama_member = (EditText) findViewById(R.id.nama_member);
        tanggal_transaksi = (EditText) findViewById(R.id.tanggal_transaksi);
        jenis_bbm = (EditText) findViewById(R.id.jenis_bbm);
        nominal = (EditText) findViewById(R.id.nominal);


        Bundle bundle = getIntent().getExtras();

        id_transaksi_voucher.setText(bundle.getString("id_transaksi_voucher"));
        id_voucher.setText(bundle.getString("id_voucher"));
        id_member.setText(bundle.getString("id_member"));
        nama_member.setText(bundle.getString("nama_member"));
        tanggal_transaksi.setText(bundle.getString("tanggal_transaksi"));
        jenis_bbm.setText(bundle.getString("jenis_bbm"));
        nominal.setText(bundle.getString("nominal"));


        mAPIService = data_transaksi_voucher_apiutils.getAPIService();
		
		config_global.init_inputTypes();


        tombol_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Update Data..");
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_transaksi_voucher_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_transaksi_voucher_edit.this);
                mAPIService.proses_update_data_transaksi_voucher(id_transaksi_voucher.getText().toString()
				,id_voucher.getText().toString()
				,id_member.getText().toString()
				,nama_member.getText().toString()
				,tanggal_transaksi.getText().toString()
				,jenis_bbm.getText().toString()
				,nominal.getText().toString()

				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_transaksi_voucher_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_transaksi_voucher_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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
