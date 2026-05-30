package com.project.aplikasi.petugas_cbs.activity;

import android.widget.Toast;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;

import com.project.aplikasi.petugas_cbs.R;

public class TransaksiVoucherActivity extends AppCompatActivity {

    private static final int REQUEST_CODE_QRCODE = 99;
    TransaksiVoucherGetFragment transaksiVoucherGetFragment = new TransaksiVoucherGetFragment();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaksi_voucher);

        loadFragment(transaksiVoucherGetFragment);
    }

    private void loadFragment(Fragment fragment) {
        getSupportFragmentManager().beginTransaction()
                .replace(R.id.frameLayout, fragment)
                .commit();
    }


    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        Fragment currentFragment = getSupportFragmentManager().findFragmentById(R.id.frameLayout);
        if (currentFragment != null) {
            currentFragment.onActivityResult(requestCode, resultCode, data);
        }

        if (requestCode == REQUEST_CODE_QRCODE) {
            if (resultCode == RESULT_OK) {
                String string = data.getStringExtra("RESULT_STRING");
                Log.i("REQUST_CODE_QRCODE", string);
//                Toast.makeText(this, string, Toast.LENGTH_SHORT).show();
            }

        }
    }
}