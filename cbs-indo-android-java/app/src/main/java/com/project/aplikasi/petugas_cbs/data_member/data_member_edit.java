package com.project.aplikasi.petugas_cbs.data_member;
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

public class data_member_edit extends AppCompatActivity {

    String validasi;
	Button tombol_update;
    EditText id_member
			,nama
            ,alamat
            ,no_telepon
            ,jenis_kelamin
            ,tanggal_terdaftar
            ,id_kategori_member
            ,kode_rfid
            ,point
            ,username
            ,password
            
            ;
    data_member_apiservice mAPIService;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_member_edit );

        tombol_update = (Button) findViewById(R.id.tombol_update);
		loading = new loading(this);
		
        id_member = (EditText) findViewById(R.id.id_member);
		nama = (EditText) findViewById(R.id.nama);
        alamat = (EditText) findViewById(R.id.alamat);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        jenis_kelamin = (EditText) findViewById(R.id.jenis_kelamin);
        tanggal_terdaftar = (EditText) findViewById(R.id.tanggal_terdaftar);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        kode_rfid = (EditText) findViewById(R.id.kode_rfid);
        point = (EditText) findViewById(R.id.point);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        

        Bundle bundle = getIntent().getExtras();

        id_member.setText(bundle.getString("id_member"));
		nama.setText(bundle.getString("nama"));
		alamat.setText(bundle.getString("alamat"));
		no_telepon.setText(bundle.getString("no_telepon"));
		jenis_kelamin.setText(bundle.getString("jenis_kelamin"));
		tanggal_terdaftar.setText(bundle.getString("tanggal_terdaftar"));
		id_kategori_member.setText(bundle.getString("id_kategori_member"));
		kode_rfid.setText(bundle.getString("kode_rfid"));
		point.setText(bundle.getString("point"));
		username.setText(bundle.getString("username"));
		password.setText(bundle.getString("password"));
		

        mAPIService = data_member_apiutils.getAPIService();
		
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
					Toast.makeText( data_member_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
				
				String token = "Bearer " + new config_global().ambil(data_member_edit.this);
                mAPIService.proses_update_data_member(id_member.getText().toString()
				, nama.getText().toString()
				, alamat.getText().toString()
				, no_telepon.getText().toString()
				, jenis_kelamin.getText().toString()
				, tanggal_terdaftar.getText().toString()
				, id_kategori_member.getText().toString()
				, kode_rfid.getText().toString()
				, point.getText().toString()
				, username.getText().toString()
				, password.getText().toString()
				
				, token
				).enqueue(new Callback<Object>() {
                    @Override
                    public void onResponse(Call<Object> call, Response<Object> response) {
                        Toast.makeText( data_member_edit.this, "Berhasil Diupdate", Toast.LENGTH_LONG).show();
                        setResult(RESULT_OK);
						loading.hideDialog();
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Object> call, Throwable t) {
                        Toast.makeText( data_member_edit.this, "Gagal Diupdate", Toast.LENGTH_LONG).show();
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








