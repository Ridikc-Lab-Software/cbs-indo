package com.project.aplikasi.petugas_cbs.data_transaksi_voucher_sqlite;

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


public class data_transaksi_voucher_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_transaksi_voucher;
    private EditText id_voucher;
    private EditText id_member;
    private EditText nama_member;
    private EditText tanggal_transaksi;
    private EditText jenis_bbm;
    private EditText nominal;

    
    private Button button_editdata;

    private data_transaksi_voucher_sqlite_dbhandler dbHandler;
    private data_transaksi_voucher_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_transaksi_voucher_edit );
        dbHandler = new data_transaksi_voucher_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_transaksi_voucher = (EditText) findViewById(R.id.id_transaksi_voucher);
        id_voucher = (EditText) findViewById(R.id.id_voucher);
        id_member = (EditText) findViewById(R.id.id_member);
        nama_member = (EditText) findViewById(R.id.nama_member);
        tanggal_transaksi = (EditText) findViewById(R.id.tanggal_transaksi);
        jenis_bbm = (EditText) findViewById(R.id.jenis_bbm);
        nominal = (EditText) findViewById(R.id.nominal);


        Bundle bundle = getIntent().getExtras();
        id_transaksi_voucher.setText(bundle.getString("id_transaksi_voucher"));
        id_voucher.setText(bundle.getString("id_voucher"));
        id_member.setText(bundle.getString("id_member"));
        nama_member.setText(bundle.getString("nama_member"));
        tanggal_transaksi.setText(bundle.getString("tanggal_transaksi"));
        jenis_bbm.setText(bundle.getString("jenis_bbm"));
        nominal.setText(bundle.getString("nominal"));


		config_global.init_inputTypes();



        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_transaksi_voucher_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_transaksi_voucher_sqlite( new data_transaksi_voucher_sqlite_data(
                            id_transaksi_voucher.getText().toString()
                            ,id_voucher.getText().toString()
                            ,id_member.getText().toString()
                            ,nama_member.getText().toString()
                            ,tanggal_transaksi.getText().toString()
                            ,jenis_bbm.getText().toString()
                            ,nominal.getText().toString()

                    ) );

                    List<data_transaksi_voucher_sqlite_data> data_transaksi_voucher_sqliteList = dbHandler.get_semua_data_transaksi_voucher_sqlite();
                    adapter = new data_transaksi_voucher_sqlite_adapter( data_transaksi_voucher_sqlite_edit.this, data_transaksi_voucher_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_transaksi_voucher_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_transaksi_voucher.requestFocus();
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






