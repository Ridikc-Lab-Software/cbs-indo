package com.project.aplikasi.petugas_cbs.data_promo_sqlite;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import java.util.List;
import static com.project.aplikasi.petugas_cbs.config.config_global.inputTypes;


public class data_promo_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_promo;
	private EditText tanggal_mulai_berlaku;
    private EditText tanggal_batas_berlaku;
    private EditText nama_promo;
    private EditText keterangan;
    private EditText syarat_dan_ketentuan;
    private EditText foto_promo;
    private EditText jumlah_point;
    private EditText status;
    
    
    private Button button_tambahdata;

    private data_promo_sqlite_dbhandler dbHandler;
    private data_promo_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_promo_tambah );
        dbHandler = new data_promo_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_promo = (EditText) findViewById(R.id.id_promo);
		tanggal_mulai_berlaku = (EditText) findViewById(R.id.tanggal_mulai_berlaku);
        tanggal_batas_berlaku = (EditText) findViewById(R.id.tanggal_batas_berlaku);
        nama_promo = (EditText) findViewById(R.id.nama_promo);
        keterangan = (EditText) findViewById(R.id.keterangan);
        syarat_dan_ketentuan = (EditText) findViewById(R.id.syarat_dan_ketentuan);
        foto_promo = (EditText) findViewById(R.id.foto_promo);
        jumlah_point = (EditText) findViewById(R.id.jumlah_point);
        status = (EditText) findViewById(R.id.status);
        

        id_promo.setText( config_global.generate_id( data_promo_sqlite_tambah.this,"data_promo") );
		
		config_global.init_inputTypes();
		jumlah_point.setInputType(inputTypes.get(4).value);
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_promo.setText( config_global.generate_id( data_promo_sqlite_tambah.this,"data_promo") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_promo_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_promo_sqlite( new data_promo_sqlite_data(
                            id_promo.getText().toString()
							, tanggal_mulai_berlaku.getText().toString()
                            , tanggal_batas_berlaku.getText().toString()
                            , nama_promo.getText().toString()
                            , keterangan.getText().toString()
                            , syarat_dan_ketentuan.getText().toString()
                            , foto_promo.getText().toString()
                            , jumlah_point.getText().toString()
                            , status.getText().toString()
                            
                    ) );

                    List<data_promo_sqlite_data> data_promo_sqliteList = dbHandler.get_semua_data_promo_sqlite();
                    adapter = new data_promo_sqlite_adapter( data_promo_sqlite_tambah.this, data_promo_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_promo_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_promo.requestFocus();
                    hideLoading();
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

    AlertDialog alertDialog;
    public void showLoading(){
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(this);
        alertDialogBuilder
                .setMessage("Menyimpan Data ...")
                .setIcon(R.mipmap.ic_launcher)
                .setCancelable(false);
        alertDialog = alertDialogBuilder.create();
        alertDialog.show();
    }

    public void hideLoading(){
        if (alertDialog != null){
            alertDialog.dismiss();
        }
    }

}













