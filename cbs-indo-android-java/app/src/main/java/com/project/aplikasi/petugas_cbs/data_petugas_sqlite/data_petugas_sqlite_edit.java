package com.project.aplikasi.petugas_cbs.data_petugas_sqlite;

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


public class data_petugas_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_petugas;
	private EditText nama;
    private EditText alamat;
    private EditText no_telepon;
    private EditText jenis_kelamin;
    private EditText username;
    private EditText password;
    
    
    private Button button_editdata;

    private data_petugas_sqlite_dbhandler dbHandler;
    private data_petugas_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_petugas_edit );
        dbHandler = new data_petugas_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_petugas = (EditText) findViewById(R.id.id_petugas);
		nama = (EditText) findViewById(R.id.nama);
        alamat = (EditText) findViewById(R.id.alamat);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        jenis_kelamin = (EditText) findViewById(R.id.jenis_kelamin);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        

        Bundle bundle = getIntent().getExtras();
        id_petugas.setText(bundle.getString("id_petugas"));
		nama.setText(bundle.getString("nama"));
        alamat.setText(bundle.getString("alamat"));
        no_telepon.setText(bundle.getString("no_telepon"));
        jenis_kelamin.setText(bundle.getString("jenis_kelamin"));
        username.setText(bundle.getString("username"));
        password.setText(bundle.getString("password"));
        

		config_global.init_inputTypes();
		


        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_petugas_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_petugas_sqlite( new data_petugas_sqlite_data(
                            id_petugas.getText().toString()
							, nama.getText().toString()
                            , alamat.getText().toString()
                            , no_telepon.getText().toString()
                            , jenis_kelamin.getText().toString()
                            , username.getText().toString()
                            , password.getText().toString()
                            
                    ) );

                    List<data_petugas_sqlite_data> data_petugas_sqliteList = dbHandler.get_semua_data_petugas_sqlite();
                    adapter = new data_petugas_sqlite_adapter( data_petugas_sqlite_edit.this, data_petugas_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_petugas_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_petugas.requestFocus();
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














