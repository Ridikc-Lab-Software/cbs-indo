package com.project.aplikasi.petugas_cbs.data_galery_sqlite;

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


public class data_galery_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_galery;
	private EditText tanggal;
    private EditText judul;
    private EditText foto;
    private EditText isi;
    
    
    private Button button_editdata;

    private data_galery_sqlite_dbhandler dbHandler;
    private data_galery_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_galery_edit );
        dbHandler = new data_galery_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_galery = (EditText) findViewById(R.id.id_galery);
		tanggal = (EditText) findViewById(R.id.tanggal);
        judul = (EditText) findViewById(R.id.judul);
        foto = (EditText) findViewById(R.id.foto);
        isi = (EditText) findViewById(R.id.isi);
        

        Bundle bundle = getIntent().getExtras();
        id_galery.setText(bundle.getString("id_galery"));
		tanggal.setText(bundle.getString("tanggal"));
        judul.setText(bundle.getString("judul"));
        foto.setText(bundle.getString("foto"));
        isi.setText(bundle.getString("isi"));
        

		config_global.init_inputTypes();
		


        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_galery_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_galery_sqlite( new data_galery_sqlite_data(
                            id_galery.getText().toString()
							, tanggal.getText().toString()
                            , judul.getText().toString()
                            , foto.getText().toString()
                            , isi.getText().toString()
                            
                    ) );

                    List<data_galery_sqlite_data> data_galery_sqliteList = dbHandler.get_semua_data_galery_sqlite();
                    adapter = new data_galery_sqlite_adapter( data_galery_sqlite_edit.this, data_galery_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_galery_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_galery.requestFocus();
                    hideLoading();
                    finish();
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
                .setMessage("Mengupdate Data ...")
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














