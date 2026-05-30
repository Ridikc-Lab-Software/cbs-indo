package com.project.aplikasi.petugas_cbs.data_profil_sqlite;

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


public class data_profil_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_profil;
	private EditText nama;
    private EditText alamat;
    private EditText no_telepon;
    private EditText sejarah;
    private EditText visi;
    private EditText misi;
    private EditText deskripsi;
    private EditText foto;
    
    
    private Button button_editdata;

    private data_profil_sqlite_dbhandler dbHandler;
    private data_profil_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_profil_edit );
        dbHandler = new data_profil_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_profil = (EditText) findViewById(R.id.id_profil);
		nama = (EditText) findViewById(R.id.nama);
        alamat = (EditText) findViewById(R.id.alamat);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        sejarah = (EditText) findViewById(R.id.sejarah);
        visi = (EditText) findViewById(R.id.visi);
        misi = (EditText) findViewById(R.id.misi);
        deskripsi = (EditText) findViewById(R.id.deskripsi);
        foto = (EditText) findViewById(R.id.foto);
        

        Bundle bundle = getIntent().getExtras();
        id_profil.setText(bundle.getString("id_profil"));
		nama.setText(bundle.getString("nama"));
        alamat.setText(bundle.getString("alamat"));
        no_telepon.setText(bundle.getString("no_telepon"));
        sejarah.setText(bundle.getString("sejarah"));
        visi.setText(bundle.getString("visi"));
        misi.setText(bundle.getString("misi"));
        deskripsi.setText(bundle.getString("deskripsi"));
        foto.setText(bundle.getString("foto"));
        

		config_global.init_inputTypes();
		


        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_profil_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_profil_sqlite( new data_profil_sqlite_data(
                            id_profil.getText().toString()
							, nama.getText().toString()
                            , alamat.getText().toString()
                            , no_telepon.getText().toString()
                            , sejarah.getText().toString()
                            , visi.getText().toString()
                            , misi.getText().toString()
                            , deskripsi.getText().toString()
                            , foto.getText().toString()
                            
                    ) );

                    List<data_profil_sqlite_data> data_profil_sqliteList = dbHandler.get_semua_data_profil_sqlite();
                    adapter = new data_profil_sqlite_adapter( data_profil_sqlite_edit.this, data_profil_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_profil_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_profil.requestFocus();
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














