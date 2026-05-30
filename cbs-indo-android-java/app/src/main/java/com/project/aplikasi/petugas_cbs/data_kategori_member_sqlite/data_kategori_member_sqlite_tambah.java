package com.project.aplikasi.petugas_cbs.data_kategori_member_sqlite;

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


public class data_kategori_member_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_kategori_member;
	private EditText kategori_member;
    private EditText gambar_logo;
    
    
    private Button button_tambahdata;

    private data_kategori_member_sqlite_dbhandler dbHandler;
    private data_kategori_member_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_kategori_member_tambah );
        dbHandler = new data_kategori_member_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
		kategori_member = (EditText) findViewById(R.id.kategori_member);
        gambar_logo = (EditText) findViewById(R.id.gambar_logo);
        

        id_kategori_member.setText( config_global.generate_id( data_kategori_member_sqlite_tambah.this,"data_kategori_member") );
		
		config_global.init_inputTypes();
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_kategori_member.setText( config_global.generate_id( data_kategori_member_sqlite_tambah.this,"data_kategori_member") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_kategori_member_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_kategori_member_sqlite( new data_kategori_member_sqlite_data(
                            id_kategori_member.getText().toString()
							, kategori_member.getText().toString()
                            , gambar_logo.getText().toString()
                            
                    ) );

                    List<data_kategori_member_sqlite_data> data_kategori_member_sqliteList = dbHandler.get_semua_data_kategori_member_sqlite();
                    adapter = new data_kategori_member_sqlite_adapter( data_kategori_member_sqlite_tambah.this, data_kategori_member_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_kategori_member_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_kategori_member.requestFocus();
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













