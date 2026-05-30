package com.project.aplikasi.petugas_cbs.data_event_sqlite;

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


public class data_event_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_event;
	private EditText tanggal;
    private EditText judul;
    private EditText foto;
    private EditText isi;
    
    
    private Button button_editdata;

    private data_event_sqlite_dbhandler dbHandler;
    private data_event_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_event_edit );
        dbHandler = new data_event_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_event = (EditText) findViewById(R.id.id_event);
		tanggal = (EditText) findViewById(R.id.tanggal);
        judul = (EditText) findViewById(R.id.judul);
        foto = (EditText) findViewById(R.id.foto);
        isi = (EditText) findViewById(R.id.isi);
        

        Bundle bundle = getIntent().getExtras();
        id_event.setText(bundle.getString("id_event"));
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
                    Toast.makeText( data_event_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_event_sqlite( new data_event_sqlite_data(
                            id_event.getText().toString()
							, tanggal.getText().toString()
                            , judul.getText().toString()
                            , foto.getText().toString()
                            , isi.getText().toString()
                            
                    ) );

                    List<data_event_sqlite_data> data_event_sqliteList = dbHandler.get_semua_data_event_sqlite();
                    adapter = new data_event_sqlite_adapter( data_event_sqlite_edit.this, data_event_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_event_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_event.requestFocus();
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














