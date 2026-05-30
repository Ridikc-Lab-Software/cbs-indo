//package com.project.aplikasi.petugas_cbs.data_promo;
//import androidx.appcompat.app.AppCompatActivity;
//
//import android.os.Bundle;
//import android.text.TextUtils;
//import android.view.View;
//import android.view.ViewGroup;
//import android.widget.Button;
//import android.widget.EditText;
//import android.widget.ListView;
//import android.widget.Toast;
//import com.project.aplikasi.petugas_cbs.R;
//import com.project.aplikasi.petugas_cbs.config.config_global;
//import com.project.aplikasi.petugas_cbs.activity.loading;
//import java.util.ArrayList;
//import retrofit2.Call;
//import retrofit2.Callback;
//import retrofit2.Response;
//import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;
//
//public class data_promo_tambah_v2 extends AppCompatActivity {
//
//	String validasi;
//    Button tombol_simpan, tombol_tambah;
//    data_promo_apiservice mAPIService;
//    EditText id_promo
//            ,tanggal_mulai_berlaku
//			 ,tanggal_batas_berlaku
//			 ,nama_promo
//			 ,keterangan
//			 ,syarat_dan_ketentuan
//			 ,foto_promo
//			 ,jumlah_point
//			 ,status
//			 ;
//
//    data_promo_tambah_v2_adapter adapter;
//    ListView data_promo_tampil;
//	loading loading;
//
//    ArrayList<data_promo_apidata> result = new ArrayList<>();
//    @Override
//    protected void onCreate(Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        setContentView( R.layout.data_promo_tambah_v2 );
//        tombol_simpan = (Button) findViewById(R.id.tombol_simpan);
//        tombol_tambah = (Button) findViewById(R.id.btnTambah);
//		loading = new loading(this);
//
//        id_promo = (EditText) findViewById(R.id.id_promo);
//        tanggal_mulai_berlaku = (EditText) findViewById(R.id.tanggal_mulai_berlaku);
//		tanggal_batas_berlaku = (EditText) findViewById(R.id.tanggal_batas_berlaku);
//		nama_promo = (EditText) findViewById(R.id.nama_promo);
//		keterangan = (EditText) findViewById(R.id.keterangan);
//		syarat_dan_ketentuan = (EditText) findViewById(R.id.syarat_dan_ketentuan);
//		foto_promo = (EditText) findViewById(R.id.foto_promo);
//		jumlah_point = (EditText) findViewById(R.id.jumlah_point);
//		status = (EditText) findViewById(R.id.status);
//
//
//		id_promo.setText( config_global.generate_id(this,"data_promo") );
//
//        data_promo_tampil = (ListView) findViewById(R.id.cvdata_promo);
//
//        adapter = new data_promo_tambah_v2_adapter(this, result);
//        data_promo_tampil.setAdapter(adapter);
//
//        mAPIService = data_promo_apiutils.getAPIService();
//
//		config_global.init_inputTypes();
//		jumlah_point.setInputType(inputTypes.get(4).value);
//
//
//        tombol_tambah.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//				loading.showDialog(1,"Please Wait","Proses Simpan Data..");
//				id_promo.setText( config_global.generate_id(data_promo_tambah_v2.this,"data_promo") );
//				validasi ="berhasil";
//                validasiForm((ViewGroup) findViewById(R.id.group));
//                if (validasi =="gagal") {
//                    loading.hideDialog();
//					Toast.makeText( data_promo_tambah_v2.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
//                            Toast.LENGTH_LONG ).show();
//
//                }  else {
//					String token = "Bearer " + new config_global().ambil(data_promo_tambah_v2.this);
//					mAPIService.proses_simpan_data_promo(id_promo.getText().toString()
//							,tanggal_mulai_berlaku.getText().toString()
//                        ,tanggal_batas_berlaku.getText().toString()
//                        ,nama_promo.getText().toString()
//                        ,keterangan.getText().toString()
//                        ,syarat_dan_ketentuan.getText().toString()
//                        ,foto_promo.getText().toString()
//                        ,jumlah_point.getText().toString()
//                        ,status.getText().toString()
//
//							,token
//					).enqueue(new Callback<Object>() {
//						@Override
//						public void onResponse(Call<Object> call, Response<Object> response) {
//							Toast.makeText( data_promo_tambah_v2.this, "Berhasil Disimpan",
//									Toast.LENGTH_LONG).show();
//							result.add(new data_promo_apidata(
//									id_promo.getText().toString()
//									,tanggal_mulai_berlaku.getText().toString()
//						,tanggal_batas_berlaku.getText().toString()
//						,nama_promo.getText().toString()
//						,keterangan.getText().toString()
//						,syarat_dan_ketentuan.getText().toString()
//						,foto_promo.getText().toString()
//						,id_mitra.getText().toString()
//						,jumlah_point.getText().toString()
//						,status.getText().toString()
//
//							));
//							adapter.updateResults(result);
//							clearForm((ViewGroup) findViewById(R.id.group));
//							id_promo.requestFocus();
//							loading.hideDialog();
//						}
//
//						@Override
//						public void onFailure(Call<Object> call, Throwable t) {
//							Toast.makeText( data_promo_tambah_v2.this, "Gagal Disimpan",
//									Toast.LENGTH_LONG).show();
//									loading.hideDialog();
//						}
//					});
//				}
//            }
//        });
//
//
//        tombol_simpan.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//
//                setResult(RESULT_OK);
//                finish();
//
//
//
//            }
//        });
//    }
//	public void validasiForm(ViewGroup group) {
//        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
//            View view = group.getChildAt(i);
//            if (view instanceof EditText) {
//                if(!TextUtils.isEmpty(((EditText)view).getText().toString()))  {
//                }  else  {
//                    validasi = "gagal";
//                    ((EditText)view).setError("Silahkan Input Terlebih Dahulu");
//					((EditText)view).requestFocus();
//                }
//			  }
//                if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
//                    validasiForm((ViewGroup)view);
//            }
//    }
//
//	private void clearForm(ViewGroup group) {
//        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
//            View view = group.getChildAt(i);
//            if (view instanceof EditText) {
//                ((EditText)view).setText("");
//            }
//            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
//                clearForm((ViewGroup)view);
//        }
//    }
//
//
//
//}
//
//
//
//
//
//
//
//
