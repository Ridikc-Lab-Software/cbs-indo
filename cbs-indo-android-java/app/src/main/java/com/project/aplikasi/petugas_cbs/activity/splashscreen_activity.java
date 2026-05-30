package com.project.aplikasi.petugas_cbs.activity;

import android.app.ActionBar;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;

import androidx.appcompat.app.AppCompatActivity;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.home.home_activity;

public class splashscreen_activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.splashscreen_activity);


        try {

            new Handler().postDelayed(new Runnable() {
                @Override
                public void run() {
                    Boolean sudahLogin =
                            new config_sessionmanager(splashscreen_activity.this).getSPSudahLogin();
                    if (sudahLogin){
                        Intent intent = new Intent(splashscreen_activity.this, home_activity.class);
                        startActivity(intent);
                    } else {
                        Intent intent = new Intent(splashscreen_activity.this, login_activity.class);
                        startActivity(intent);
                    }
                    finish();
                }
            }, 3000);


        } catch (Exception e) {
            e.printStackTrace();
        }

    }
}
