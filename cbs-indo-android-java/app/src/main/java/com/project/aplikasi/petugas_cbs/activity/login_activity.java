package com.project.aplikasi.petugas_cbs.activity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AutoCompleteTextView;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.home.home_activity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class login_activity extends AppCompatActivity {
    config_sessionmanager config_sessionmanager;
    login_apiservice mAPIService;
    AutoCompleteTextView username;
    EditText password;
	loading loading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_activity);
        config_sessionmanager = new config_sessionmanager(this);
        config_sessionmanager.saveSPBoolean(config_sessionmanager.SP_SUDAH_LOGIN, false);
        mAPIService = login_apiutils.getAPIService();

        TextView loginQrText = findViewById(R.id.login_qr_text);
        loginQrText.setOnClickListener(v -> {
            Intent intent = new Intent(login_activity.this, LoginQRActivity.class);
            startActivity(intent);
        });


        username = (AutoCompleteTextView) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);

        // logout (delete data session manager)
        new config_sessionmanager(this).logOut();
		loading = new loading(this);
    }
	

    public void login(View view) {
		loading.showDialog(1,"Please Wait","Loading..");
        mAPIService.login_pegawai(username.getText().toString(), password.getText().toString()).enqueue(new Callback<login_pegawai_api>() {
            @Override
            public void onResponse(Call<login_pegawai_api> call, Response<login_pegawai_api> response) {
                if (response.code() == 200){
					loading.hideDialog();
                    login_pegawai_api res = response.body();
                    try {
                        if (res.getStatus().equals("success")){
                            Toast.makeText(login_activity.this, "Login Berhasil", Toast.LENGTH_SHORT).show();
                            config_sessionmanager.saveSPString(config_sessionmanager.SP_TOKEN, res.getResult().get_tkn());

                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_NAMA, res.getResult().get_nama_pegawai());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ID, res.getResult().get_id());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_JABATAN, res.getResult().get_jabatan());

                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_SPBU, res.getResult().get_spbu());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ALAMAT1, res.getResult().get_alamat1());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_ALAMAT2, res.getResult().get_alamat2());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_TELEPON, res.getResult().get_telepon());
                            config_sessionmanager.saveSPString(com.project.aplikasi.petugas_cbs.config.config_sessionmanager.SP_PENUTUP, res.getResult().get_penutup());

                            config_sessionmanager.saveSPBoolean(config_sessionmanager.SP_SUDAH_LOGIN, true);
                            Intent intent = new Intent(login_activity.this, home_activity.class);
                            startActivity(intent);
                        } else {
                            Toast.makeText(login_activity.this, "Login Gagal", Toast.LENGTH_SHORT).show();
                        }
                    } catch (NullPointerException ex){
                        Toast.makeText(login_activity.this, "Login Gagal", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Toast.makeText(login_activity.this, "Koneksi Error", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<login_pegawai_api> call, Throwable t) {
				loading.hideDialog();
                Toast.makeText(login_activity.this, "Koneksi Error", Toast.LENGTH_SHORT).show();
            }
        });

    }

    public void batal(View view) {
        finish();
    }
}
