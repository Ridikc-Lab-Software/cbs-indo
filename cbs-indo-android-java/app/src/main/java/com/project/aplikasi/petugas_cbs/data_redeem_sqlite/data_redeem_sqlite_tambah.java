package com.project.aplikasi.petugas_cbs.data_redeem_sqlite;

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


public class data_redeem_sqlite_tambah extends AppCompatActivity {

    String validasi;
    private EditText id_redeem;
	private EditText tanggal;
    private EditText jam;
    private EditText id_member;
    private EditText id_mitra;
    private EditText id_promo;
    private EditText point;
    private EditText status;
    
    
    private Button button_tambahdata;

    private data_redeem_sqlite_dbhandler dbHandler;
    private data_redeem_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_redeem_tambah );
        dbHandler = new data_redeem_sqlite_dbhandler(this);

        button_tambahdata = (Button) findViewById(R.id.tombol_simpan);
        id_redeem = (EditText) findViewById(R.id.id_redeem);
		tanggal = (EditText) findViewById(R.id.tanggal);
        jam = (EditText) findViewById(R.id.jam);
        id_member = (EditText) findViewById(R.id.id_member);
        id_mitra = (EditText) findViewById(R.id.id_mitra);
        id_promo = (EditText) findViewById(R.id.id_promo);
        point = (EditText) findViewById(R.id.point);
        status = (EditText) findViewById(R.id.status);
        

        id_redeem.setText( config_global.generate_id( data_redeem_sqlite_tambah.this,"data_redeem") );
		
		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		

        button_tambahdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();
                id_redeem.setText( config_global.generate_id( data_redeem_sqlite_tambah.this,"data_redeem") );
                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_redeem_sqlite_tambah.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.tambah_data_redeem_sqlite( new data_redeem_sqlite_data(
                            id_redeem.getText().toString()
							, tanggal.getText().toString()
                            , jam.getText().toString()
                            , id_member.getText().toString()
                            , id_mitra.getText().toString()
                            , id_promo.getText().toString()
                            , point.getText().toString()
                            , status.getText().toString()
                            
                    ) );

                    List<data_redeem_sqlite_data> data_redeem_sqliteList = dbHandler.get_semua_data_redeem_sqlite();
                    adapter = new data_redeem_sqlite_adapter( data_redeem_sqlite_tambah.this, data_redeem_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_redeem_sqlite_tambah.this, "Berhasil Menambahkan Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_redeem.requestFocus();
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













