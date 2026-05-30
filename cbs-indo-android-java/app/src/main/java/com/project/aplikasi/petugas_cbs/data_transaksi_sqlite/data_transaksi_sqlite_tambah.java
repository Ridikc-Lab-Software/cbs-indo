package com.project.aplikasi.petugas_cbs.data_transaksi_sqlite;

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


public class data_transaksi_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_transaksi;
	private EditText tanggal;
    private EditText jam;
    private EditText id_member;
    private EditText id_petugas;
    private EditText id_kategori_member;
    private EditText id_jenis_transaksi;
    private EditText point;
    private EditText jumlah;
    
    
    private Button button_tambahdata;

    private data_transaksi_sqlite_dbhandler dbHandler;
    private data_transaksi_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_transaksi_tambah );
        dbHandler = new data_transaksi_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_transaksi = (EditText) findViewById(R.id.id_transaksi);
		tanggal = (EditText) findViewById(R.id.tanggal);
        jam = (EditText) findViewById(R.id.jam);
        id_member = (EditText) findViewById(R.id.id_member);
        id_petugas = (EditText) findViewById(R.id.id_petugas);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
        point = (EditText) findViewById(R.id.point);
        jumlah = (EditText) findViewById(R.id.jumlah);
        

        id_transaksi.setText( config_global.generate_id( data_transaksi_sqlite_tambah.this,"data_transaksi") );
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		jumlah.setInputType(inputTypes.get(4).value);
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_transaksi.setText( config_global.generate_id( data_transaksi_sqlite_tambah.this,"data_transaksi") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_transaksi_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_transaksi_sqlite( new data_transaksi_sqlite_data(
                            id_transaksi.getText().toString()
							, tanggal.getText().toString()
                            , jam.getText().toString()
                            , id_member.getText().toString()
                            , id_petugas.getText().toString()
                            , id_kategori_member.getText().toString()
                            , id_jenis_transaksi.getText().toString()
                            , point.getText().toString()
                            , jumlah.getText().toString()
                            
                    ) );

                    List<data_transaksi_sqlite_data> data_transaksi_sqliteList = dbHandler.get_semua_data_transaksi_sqlite();
                    adapter = new data_transaksi_sqlite_adapter( data_transaksi_sqlite_tambah.this, data_transaksi_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_transaksi_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_transaksi.requestFocus();
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


















