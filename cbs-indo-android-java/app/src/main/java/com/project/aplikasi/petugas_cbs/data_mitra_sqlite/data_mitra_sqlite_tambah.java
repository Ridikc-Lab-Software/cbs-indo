package com.project.aplikasi.petugas_cbs.data_mitra_sqlite;

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


public class data_mitra_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_mitra;
	private EditText nama_mitra;
    private EditText alamat;
    private EditText no_telepon;
    private EditText nama_pemilik;
    private EditText no_telepon_pemilik;
    private EditText tanggal_daftar;
    private EditText username;
    private EditText password;
    private EditText status;
    private EditText gambar_logo;
    
    
    private Button button_tambahdata;

    private data_mitra_sqlite_dbhandler dbHandler;
    private data_mitra_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_mitra_tambah );
        dbHandler = new data_mitra_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_mitra = (EditText) findViewById(R.id.id_mitra);
		nama_mitra = (EditText) findViewById(R.id.nama_mitra);
        alamat = (EditText) findViewById(R.id.alamat);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        nama_pemilik = (EditText) findViewById(R.id.nama_pemilik);
        no_telepon_pemilik = (EditText) findViewById(R.id.no_telepon_pemilik);
        tanggal_daftar = (EditText) findViewById(R.id.tanggal_daftar);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        status = (EditText) findViewById(R.id.status);
        gambar_logo = (EditText) findViewById(R.id.gambar_logo);
        

        id_mitra.setText( config_global.generate_id( data_mitra_sqlite_tambah.this,"data_mitra") );
		
		config_global.init_inputTypes();
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_mitra.setText( config_global.generate_id( data_mitra_sqlite_tambah.this,"data_mitra") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_mitra_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_mitra_sqlite( new data_mitra_sqlite_data(
                            id_mitra.getText().toString()
							, nama_mitra.getText().toString()
                            , alamat.getText().toString()
                            , no_telepon.getText().toString()
                            , nama_pemilik.getText().toString()
                            , no_telepon_pemilik.getText().toString()
                            , tanggal_daftar.getText().toString()
                            , username.getText().toString()
                            , password.getText().toString()
                            , status.getText().toString()
                            , gambar_logo.getText().toString()
                            
                    ) );

                    List<data_mitra_sqlite_data> data_mitra_sqliteList = dbHandler.get_semua_data_mitra_sqlite();
                    adapter = new data_mitra_sqlite_adapter( data_mitra_sqlite_tambah.this, data_mitra_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_mitra_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_mitra.requestFocus();
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













