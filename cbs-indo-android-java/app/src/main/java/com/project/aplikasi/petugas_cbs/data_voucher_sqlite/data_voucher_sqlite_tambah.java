package com.project.aplikasi.petugas_cbs.data_voucher_sqlite;

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


public class data_voucher_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_voucher;
    private EditText qrcode;
    private EditText id_relasi;
    private EditText nominal;
    private EditText tanggal_kadaluarsa;
    private EditText id_spbu;
    private EditText id_penjualan_voucher;
    private EditText status;
    private EditText file_voucher;
    private EditText tanggal_dibuka;

    
    private Button button_tambahdata;

    private data_voucher_sqlite_dbhandler dbHandler;
    private data_voucher_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_voucher_tambah );
        dbHandler = new data_voucher_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_voucher = (EditText) findViewById(R.id.id_voucher);
        qrcode = (EditText) findViewById(R.id.qrcode);
        id_relasi = (EditText) findViewById(R.id.id_relasi);
        nominal = (EditText) findViewById(R.id.nominal);
        tanggal_kadaluarsa = (EditText) findViewById(R.id.tanggal_kadaluarsa);
        id_spbu = (EditText) findViewById(R.id.id_spbu);
        id_penjualan_voucher = (EditText) findViewById(R.id.id_penjualan_voucher);
        status = (EditText) findViewById(R.id.status);
        file_voucher = (EditText) findViewById(R.id.file_voucher);
        tanggal_dibuka = (EditText) findViewById(R.id.tanggal_dibuka);


        id_voucher.setText( config_global.generate_id( data_voucher_sqlite_tambah.this,"data_voucher") );
		
		config_global.init_inputTypes();


        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_voucher.setText( config_global.generate_id( data_voucher_sqlite_tambah.this,"data_voucher") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_voucher_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_voucher_sqlite( new data_voucher_sqlite_data(
                            id_voucher.getText().toString()
                            ,qrcode.getText().toString()
                            ,id_relasi.getText().toString()
                            ,nominal.getText().toString()
                            ,tanggal_kadaluarsa.getText().toString()
                            ,id_spbu.getText().toString()
                            ,id_penjualan_voucher.getText().toString()
                            ,status.getText().toString()
                            ,file_voucher.getText().toString()
                            ,tanggal_dibuka.getText().toString()

                    ) );

                    List<data_voucher_sqlite_data> data_voucher_sqliteList = dbHandler.get_semua_data_voucher_sqlite();
                    adapter = new data_voucher_sqlite_adapter( data_voucher_sqlite_tambah.this, data_voucher_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_voucher_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_voucher.requestFocus();
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






