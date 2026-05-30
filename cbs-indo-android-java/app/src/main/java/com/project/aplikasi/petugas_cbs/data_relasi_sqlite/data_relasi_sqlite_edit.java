package com.project.aplikasi.petugas_cbs.data_relasi_sqlite;

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


public class data_relasi_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_relasi;
    private EditText nama;
    private EditText nomor_telepon;
    private EditText email;
    private EditText alamat;
    private EditText id_spbu;
    private EditText nama_spbu;
    private EditText password;

    
    private Button button_editdata;

    private data_relasi_sqlite_dbhandler dbHandler;
    private data_relasi_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_relasi_edit );
        dbHandler = new data_relasi_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_relasi = (EditText) findViewById(R.id.id_relasi);
        nama = (EditText) findViewById(R.id.nama);
        nomor_telepon = (EditText) findViewById(R.id.nomor_telepon);
        email = (EditText) findViewById(R.id.email);
        alamat = (EditText) findViewById(R.id.alamat);
        id_spbu = (EditText) findViewById(R.id.id_spbu);
        nama_spbu = (EditText) findViewById(R.id.nama_spbu);
        password = (EditText) findViewById(R.id.password);


        Bundle bundle = getIntent().getExtras();
        id_relasi.setText(bundle.getString("id_relasi"));
        nama.setText(bundle.getString("nama"));
        nomor_telepon.setText(bundle.getString("nomor_telepon"));
        email.setText(bundle.getString("email"));
        alamat.setText(bundle.getString("alamat"));
        id_spbu.setText(bundle.getString("id_spbu"));
        nama_spbu.setText(bundle.getString("nama_spbu"));
        password.setText(bundle.getString("password"));


		config_global.init_inputTypes();



        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_relasi_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_relasi_sqlite( new data_relasi_sqlite_data(
                            id_relasi.getText().toString()
                            ,nama.getText().toString()
                            ,nomor_telepon.getText().toString()
                            ,email.getText().toString()
                            ,alamat.getText().toString()
                            ,id_spbu.getText().toString()
                            ,nama_spbu.getText().toString()
                            ,password.getText().toString()

                    ) );

                    List<data_relasi_sqlite_data> data_relasi_sqliteList = dbHandler.get_semua_data_relasi_sqlite();
                    adapter = new data_relasi_sqlite_adapter( data_relasi_sqlite_edit.this, data_relasi_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_relasi_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_relasi.requestFocus();
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






