package com.project.aplikasi.petugas_cbs.data_pengaturan_point_sqlite;

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


public class data_pengaturan_point_sqlite_edit extends AppCompatActivity {

    String validasi;
    private EditText id_pengaturan_point;
	private EditText nama_pengaturan;
    private EditText id_kategori_member;
    private EditText id_jenis_transaksi;
    private EditText point;
    
    
    private Button button_editdata;

    private data_pengaturan_point_sqlite_dbhandler dbHandler;
    private data_pengaturan_point_sqlite_adapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_pengaturan_point_edit );
        dbHandler = new data_pengaturan_point_sqlite_dbhandler(this);

        button_editdata = (Button) findViewById(R.id.tombol_update);
        id_pengaturan_point = (EditText) findViewById(R.id.id_pengaturan_point);
		nama_pengaturan = (EditText) findViewById(R.id.nama_pengaturan);
        id_kategori_member = (EditText) findViewById(R.id.id_kategori_member);
        id_jenis_transaksi = (EditText) findViewById(R.id.id_jenis_transaksi);
        point = (EditText) findViewById(R.id.point);
        

        Bundle bundle = getIntent().getExtras();
        id_pengaturan_point.setText(bundle.getString("id_pengaturan_point"));
		nama_pengaturan.setText(bundle.getString("nama_pengaturan"));
        id_kategori_member.setText(bundle.getString("id_kategori_member"));
        id_jenis_transaksi.setText(bundle.getString("id_jenis_transaksi"));
        point.setText(bundle.getString("point"));
        

		config_global.init_inputTypes();
		point.setInputType(inputTypes.get(4).value);
		


        button_editdata.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showLoading();

                validasi ="berhasil";
                validasiForm((ViewGroup) findViewById(R.id.group));
                if (validasi =="gagal") {
                    Toast.makeText( data_pengaturan_point_sqlite_edit.this,  "Gagal Proses, Ada data Yang Masih Kosong dan Perlu diinputkan.",
                            Toast.LENGTH_LONG ).show();
                    hideLoading();
                }  else {
                    //proses simpan
                    dbHandler.update_data_pengaturan_point_sqlite( new data_pengaturan_point_sqlite_data(
                            id_pengaturan_point.getText().toString()
							, nama_pengaturan.getText().toString()
                            , id_kategori_member.getText().toString()
                            , id_jenis_transaksi.getText().toString()
                            , point.getText().toString()
                            
                    ) );

                    List<data_pengaturan_point_sqlite_data> data_pengaturan_point_sqliteList = dbHandler.get_semua_data_pengaturan_point_sqlite();
                    adapter = new data_pengaturan_point_sqlite_adapter( data_pengaturan_point_sqlite_edit.this, data_pengaturan_point_sqliteList );
                    adapter.notifyDataSetChanged();
                    Toast.makeText( data_pengaturan_point_sqlite_edit.this, "Berhasil Mengupdate Data", Toast.LENGTH_SHORT ).show();
                    setResult( RESULT_OK );
                    clearForm((ViewGroup) findViewById(R.id.group));
                    id_pengaturan_point.requestFocus();
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














