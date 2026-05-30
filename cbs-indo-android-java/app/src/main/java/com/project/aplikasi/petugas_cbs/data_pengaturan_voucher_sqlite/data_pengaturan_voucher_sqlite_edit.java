package com.project.aplikasi.petugas_cbs.data_pengaturan_voucher_sqlite;

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


public class data_pengaturan_voucher_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_pengaturan_voucher;
    private EditText nama;
    private EditText isi;
    private EditText status;

    
    private Button button_editdata;

    private data_pengaturan_voucher_sqlite_dbhandler dbHandler;
    private data_pengaturan_voucher_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_pengaturan_voucher_edit );
        dbHandler = new data_pengaturan_voucher_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_pengaturan_voucher = (EditText) findViewById(R.id.id_pengaturan_voucher);
        nama = (EditText) findViewById(R.id.nama);
        isi = (EditText) findViewById(R.id.isi);
        status = (EditText) findViewById(R.id.status);


        Bundle bundle = getIntent().getExtras();
        id_pengaturan_voucher.setText(bundle.getString("id_pengaturan_voucher"));
        nama.setText(bundle.getString("nama"));
        isi.setText(bundle.getString("isi"));
        status.setText(bundle.getString("status"));


		config_global.init_inputTypes();



        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_pengaturan_voucher_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_pengaturan_voucher_sqlite( new data_pengaturan_voucher_sqlite_data(
                            id_pengaturan_voucher.getText().toString()
                            ,nama.getText().toString()
                            ,isi.getText().toString()
                            ,status.getText().toString()

                    ) );

                    List<data_pengaturan_voucher_sqlite_data> data_pengaturan_voucher_sqliteList = dbHandler.get_semua_data_pengaturan_voucher_sqlite();
                    adapter = new data_pengaturan_voucher_sqlite_adapter( data_pengaturan_voucher_sqlite_edit.this, data_pengaturan_voucher_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_pengaturan_voucher_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_pengaturan_voucher.requestFocus();
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






