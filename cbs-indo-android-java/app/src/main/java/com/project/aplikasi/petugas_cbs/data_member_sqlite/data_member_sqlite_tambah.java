package com.project.aplikasi.petugas_cbs.data_member_sqlite;

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


public class data_member_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_member;
	private EditText nama;
    private EditText alamat;
    private EditText no_telepon;
    private EditText jenis_kelamin;
    private EditText tanggal_terdaftar;
    private EditText id_kategori_member;
    private EditText kode_rfid;
    private EditText point;
    private EditText username;
    private EditText password;
    
    
    private Button button_tambahdata;

    private data_member_sqlite_dbhandler dbHandler;
    private data_member_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_member_tambah );
        dbHandler = new data_member_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_member = (EditText) findViewById(R.id.id_member);
		nama = (EditText) findViewById(R.id.nama);
        alamat = (EditText) findViewById(R.id.alamat);
        no_telepon = (EditText) findViewById(R.id.no_telepon);
        jenis_kelamin = (EditText) findViewById(R.id.jenis_kelamin);
        tanggal_terdaftar = (EditText) findViewById(R.id.tanggal_terdaftar);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        kode_rfid = (EditText) findViewById(R.id.kode_rfid);
        point = (EditText) findViewById(R.id.point);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        

        id_member.setText( config_global.generate_id( data_member_sqlite_tambah.this,"data_member") );
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_member.setText( config_global.generate_id( data_member_sqlite_tambah.this,"data_member") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_member_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_member_sqlite( new data_member_sqlite_data(
                            id_member.getText().toString()
							, nama.getText().toString()
                            , alamat.getText().toString()
                            , no_telepon.getText().toString()
                            , jenis_kelamin.getText().toString()
                            , tanggal_terdaftar.getText().toString()
                            , id_kategori_member.getText().toString()
                            , kode_rfid.getText().toString()
                            , point.getText().toString()
                            , username.getText().toString()
                            , password.getText().toString()
                            
                    ) );

                    List<data_member_sqlite_data> data_member_sqliteList = dbHandler.get_semua_data_member_sqlite();
                    adapter = new data_member_sqlite_adapter( data_member_sqlite_tambah.this, data_member_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_member_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_member.requestFocus();
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













