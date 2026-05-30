package com.project.aplikasi.petugas_cbs.data_transaksi;
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
import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;

public class data_transaksi_tambah_v2 extends AppCompatActivity {

	String validasi;
    Button tombol_simpan, tombol_tambah;
    data_transaksi_apiservice mAPIService;
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

    data_transaksi_tambah_v2_adapter adapter;
    ListView data_transaksi_tampil;
	loading loading;

    ArrayList<data_transaksi_apidata> result = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.data_transaksi_tambah_v2 );
        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
        tombol_tambah = (Button) findViewById(R.id.btnTambah);
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
		

		id_transaksi.setText( config_global.generate_id(this,"data_transaksi") );
		
        data_transaksi_tampil = (ListView) findViewById(R.id.cvdata_transaksi);

        adapter = new data_transaksi_tambah_v2_adapter(this, result);
        data_transaksi_tampil.setAdapter(adapter);

        mAPIService = data_transaksi_apiutils.getAPIService();
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		jumlah.setInputType(inputTypes.get(4).value);
		

        tombol_tambah.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
				id_transaksi.setText( config_global.generate_id(data_transaksi_tambah_v2.this,"data_transaksi") );
				validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    loading.hideDialog();
					Toast.makeText( data_transaksi_tambah_v2.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
					
                }  else {
					String token = "Bearer " + new config_global().ambil(data_transaksi_tambah_v2.this);
					mAPIService.proses_simpan_data_transaksi(id_transaksi.getText().toString()
							,tanggal.getText().toString()
                        ,jam.getText().toString()
                        ,id_member.getText().toString()
                        ,id_petugas.getText().toString()
                        ,id_kategori_member.getText().toString()
                        ,id_jenis_transaksi.getText().toString()
                        ,point.getText().toString()
                        ,jumlah.getText().toString()
                        
							,token
					).enqueue(new Callback<Object>() {
						@Override
						public void onResponse(Call<Object> call, Response<Object> response) {
							Toast.makeText( data_transaksi_tambah_v2.this, "Berhasil Disimpan",
									Toast.LENGTH_LONG).show();
							result.add(new data_transaksi_apidata(
									id_transaksi.getText().toString()
									,tanggal.getText().toString()
						,jam.getText().toString()
						,id_member.getText().toString()
						,id_petugas.getText().toString()
						,id_kategori_member.getText().toString()
						,id_jenis_transaksi.getText().toString()
						,point.getText().toString()
						,jumlah.getText().toString()
						
							));
							adapter.updateResults(result);
							clearForm((ViewGroup) findViewById(R.id.group));
							id_transaksi.requestFocus();
							loading.hideDialog();
						}
	
						@Override
						public void onFailure(Call<Object> call, Throwable t) {
							Toast.makeText( data_transaksi_tambah_v2.this, "Gagal Disimpan",
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














