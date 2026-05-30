package com.project.aplikasi.petugas_cbs.data_penjualan_voucher_sqlite;

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


public class data_penjualan_voucher_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_penjualan_voucher;
    private EditText tanggal_penjualan;
    private EditText id_relasi;
    private EditText jumlah_voucher;
    private EditText nominal;
    private EditText password_voucher;
    private EditText tanggal_dibuka;

    
    private Button button_tambahdata;

    private data_penjualan_voucher_sqlite_dbhandler dbHandler;
    private data_penjualan_voucher_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_penjualan_voucher_tambah );
        dbHandler = new data_penjualan_voucher_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_penjualan_voucher = (EditText) findViewById(R.id.id_penjualan_voucher);
        tanggal_penjualan = (EditText) findViewById(R.id.tanggal_penjualan);
        id_relasi = (EditText) findViewById(R.id.id_relasi);
        jumlah_voucher = (EditText) findViewById(R.id.jumlah_voucher);
        nominal = (EditText) findViewById(R.id.nominal);
        password_voucher = (EditText) findViewById(R.id.password_voucher);
        tanggal_dibuka = (EditText) findViewById(R.id.tanggal_dibuka);


        id_penjualan_voucher.setText( config_global.generate_id( data_penjualan_voucher_sqlite_tambah.this,"data_penjualan_voucher") );
		
		config_global.init_inputTypes();


        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_penjualan_voucher.setText( config_global.generate_id( data_penjualan_voucher_sqlite_tambah.this,"data_penjualan_voucher") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_penjualan_voucher_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_penjualan_voucher_sqlite( new data_penjualan_voucher_sqlite_data(
                            id_penjualan_voucher.getText().toString()
                            ,tanggal_penjualan.getText().toString()
                            ,id_relasi.getText().toString()
                            ,jumlah_voucher.getText().toString()
                            ,nominal.getText().toString()
                            ,password_voucher.getText().toString()
                            ,tanggal_dibuka.getText().toString()

                    ) );

                    List<data_penjualan_voucher_sqlite_data> data_penjualan_voucher_sqliteList = dbHandler.get_semua_data_penjualan_voucher_sqlite();
                    adapter = new data_penjualan_voucher_sqlite_adapter( data_penjualan_voucher_sqlite_tambah.this, data_penjualan_voucher_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_penjualan_voucher_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_penjualan_voucher.requestFocus();
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






