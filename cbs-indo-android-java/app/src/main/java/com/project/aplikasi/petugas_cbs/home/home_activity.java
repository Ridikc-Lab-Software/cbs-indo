package com.project.aplikasi.petugas_cbs.home;

import android.Manifest;
import android.app.PendingIntent;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.pm.PackageManager;
import android.media.MediaPlayer;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.nfc.tech.IsoDep;
import android.nfc.tech.MifareClassic;
import android.nfc.tech.MifareUltralight;
import android.nfc.tech.Ndef;
import android.nfc.tech.NfcA;
import android.nfc.tech.NfcB;
import android.nfc.tech.NfcF;
import android.nfc.tech.NfcV;
import android.os.Build;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

import com.google.android.material.navigation.NavigationView;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.activity.TransaksiVoucherActivity;
import com.project.aplikasi.petugas_cbs.activity.login_activity;
import com.project.aplikasi.petugas_cbs.activity.qrcode2_activity;
import com.project.aplikasi.petugas_cbs.activity.webview_activity;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.config.config_sessionmanager;
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity;
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity_v2;
import com.project.aplikasi.petugas_cbs.data_member.data_member_tambah;
import com.project.aplikasi.petugas_cbs.data_mitra.data_mitra_activity_v2;
import com.project.aplikasi.petugas_cbs.data_promo.data_promo_activity_v2;
import com.project.aplikasi.petugas_cbs.data_redeem.data_redeem_activity_v2;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_activity_v2;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_edit;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_tambah;
import com.project.aplikasi.petugas_cbs.data_transaksi_voucher.data_transaksi_voucher_activity_v2;
import com.project.aplikasi.petugas_cbs.tag_rfid_redeem;
import com.project.aplikasi.petugas_cbs.tag_rfid_transaksi;

import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.os.Parcelable;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;
import static android.media.ToneGenerator.MAX_VOLUME;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

import java.util.Set;

public class home_activity extends AppCompatActivity {

    private static final int REQUEST_CODE_QRCODE = 99;
    private static final int REQUEST_BLUETOOTH_PERMISSION = 1;
    private AppBarConfiguration mAppBarConfiguration;

    config_sessionmanager config_sessionmanager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView( R.layout.home_activity );
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
        mAppBarConfiguration = new AppBarConfiguration.Builder(R.id.nav_home
                ,R.id.nav_kiri5

                
        )
                .setDrawerLayout(drawer)
                .build();
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        NavigationUI.setupActionBarWithNavController(this, navController, mAppBarConfiguration);
        NavigationUI.setupWithNavController(navigationView, navController);

        config_sessionmanager = new config_sessionmanager(this);

        // 🔹 Cek dan minta permission Bluetooth (Android 12+)
        checkBluetoothPermission();

        // 🔹 Contoh penggunaan aman (tidak error di Android 12+)
        showBondedDevicesSafely();

    }


    private void checkBluetoothPermission() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.S) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_CONNECT)
                    != PackageManager.PERMISSION_GRANTED) {

                ActivityCompat.requestPermissions(
                        this,
                        new String[]{Manifest.permission.BLUETOOTH_CONNECT},
                        REQUEST_BLUETOOTH_PERMISSION
                );
            }
        }
    }

    @SuppressWarnings("MissingPermission")
    private void showBondedDevicesSafely() {
        BluetoothAdapter bluetoothAdapter = BluetoothAdapter.getDefaultAdapter();

        if (bluetoothAdapter == null) {
            Toast.makeText(this, "Bluetooth tidak tersedia di perangkat ini", Toast.LENGTH_SHORT).show();
            return;
        }

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.S &&
                ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_CONNECT)
                        != PackageManager.PERMISSION_GRANTED) {
            // Jangan lanjut jika izin belum diberikan
            Log.w("Bluetooth", "Izin BLUETOOTH_CONNECT belum diberikan");
            return;
        }

        // Akses perangkat yang sudah terhubung
        Set<BluetoothDevice> bondedDevices = bluetoothAdapter.getBondedDevices();
        if (bondedDevices != null && bondedDevices.size() > 0) {
            for (BluetoothDevice device : bondedDevices) {
                Log.d("Bluetooth", "Device: " + device.getName() + " - " + device.getAddress());
            }
        } else {
            Log.d("Bluetooth", "Tidak ada perangkat yang terhubung");
        }
    }
    // Callback setelah permission diminta
    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           @NonNull String[] permissions,
                                           @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == REQUEST_BLUETOOTH_PERMISSION) {
            if (grantResults.length > 0 &&
                    grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "Izin Bluetooth diberikan", Toast.LENGTH_SHORT).show();
                showBondedDevicesSafely();
            } else {
                Toast.makeText(this, "Izin Bluetooth ditolak", Toast.LENGTH_SHORT).show();
            }
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onSupportNavigateUp() {
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        return NavigationUI.navigateUp(navController, mAppBarConfiguration)
                || super.onSupportNavigateUp();
    }
	
	 public void open_webview(String url, String judul, String deskripsi)
    {
        Intent intent = new Intent(home_activity.this, webview_activity.class);
        intent.putExtra("url", url);
        intent.putExtra("judul", judul);
        intent.putExtra("deskripsi", deskripsi);
        startActivity(intent);
    }

    public void id_tombol_1(View view) {
       

        Intent intent = new Intent(home_activity.this, tag_rfid_transaksi.class);
        config_sessionmanager = new config_sessionmanager(home_activity.this);
        String id_mitra = new config_global().capitalize(config_sessionmanager.getSPJabatan());
        intent.putExtra("id_mitra", id_mitra);
        startActivity(intent);
    }

    public void id_tombol_2(View view) {

        Intent intent = new Intent(home_activity.this, data_transaksi_activity_v2.class);
        startActivity(intent);
    }

    public void id_tombol_3(View view) {


        Intent intent = new Intent(home_activity.this, tag_rfid_redeem.class);
        config_sessionmanager = new config_sessionmanager(home_activity.this);
        String id_mitra = new config_global().capitalize(config_sessionmanager.getSPJabatan());
        intent.putExtra("id_mitra", id_mitra);
        startActivity(intent);
    }

    public void id_tombol_4(View view) {

        Intent intent = new Intent(home_activity.this, data_redeem_activity_v2.class);
        config_sessionmanager = new config_sessionmanager(home_activity.this);
        String id_mitra = new config_global().capitalize(config_sessionmanager.getSPJabatan());
        intent.putExtra("id_mitra", id_mitra);
        startActivity(intent);
    }

    public void id_tombol_5(View view) {
        startActivity(new Intent(home_activity.this, data_member_tambah.class));
//        open_webview(BASE_URL +"/frame/app/page/panduan.php","Panduan","Informasi Panduan");
    }

    
    public void id_tombol_7(View view) {
//        Intent intent = new Intent( home_activity.this, qrcode2_activity.class);
//        intent.putExtra("SCAN_TIPE", "REQUEST_QRCODE_RAW");
//        startActivityForResult(intent, REQUEST_CODE_QRCODE);

        startActivity(new Intent(home_activity.this, TransaksiVoucherActivity.class));
    }

    public void id_tombol_8(View view) {
        startActivity(new Intent(home_activity.this, data_transaksi_voucher_activity_v2.class));
    }

    public void id_tombol_6(View view) {
        config_sessionmanager.logOut();
        Intent intent = new Intent(home_activity.this, login_activity.class);
        intent.setFlags(FLAG_ACTIVITY_CLEAR_TASK | FLAG_ACTIVITY_NEW_TASK);
        startActivity(intent);
    }

    public void id_tombol_profil(View view) {

    }



    public home_activity() {
        techList = new String[][] {
                new String[] {
                        NfcA.class.getName(),
                        NfcB.class.getName(),
                        NfcF.class.getName(),
                        NfcV.class.getName(),
                        IsoDep.class.getName(),
                        MifareClassic.class.getName(),
                        MifareUltralight.class.getName(), Ndef.class.getName()
                }
        };
    }
    private final String[][] techList;

    @Override
    protected void onResume() {

        super.onResume();

//        PendingIntent pendingIntent = PendingIntent.getActivity(this, 0, new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP), 0);
//        IntentFilter filter = new IntentFilter();
//        filter.addAction(NfcAdapter.ACTION_TAG_DISCOVERED);
//        filter.addAction(NfcAdapter.ACTION_NDEF_DISCOVERED);
//        filter.addAction(NfcAdapter.ACTION_TECH_DISCOVERED);
//        NfcAdapter nfcAdapter = NfcAdapter.getDefaultAdapter(this);
//        nfcAdapter.enableForegroundDispatch(this, pendingIntent, new IntentFilter[]{filter}, this.techList);
    }

    @Override
    protected void onPause() {
        super.onPause();
//        NfcAdapter nfcAdapter = NfcAdapter.getDefaultAdapter(this);
//        nfcAdapter.disableForegroundDispatch(this);
    }

    @Override
    protected void onNewIntent(Intent intent) {
        super.onNewIntent(intent);
        if (intent.getAction().equals(NfcAdapter.ACTION_TAG_DISCOVERED)) {

            //Toast.makeText(home_activity.this,  "BERHASIL MENDETEKSI NFC, MEMBERCARD KODE CBS : NFC Tag\n" +
                   // ByteArrayToHexString(intent.getByteArrayExtra(NfcAdapter.EXTRA_ID)), Toast.LENGTH_LONG).show();
            Bundle bundle = new Bundle();
            bundle.putString("dari", "transaksi");
            bundle.putString("id_member", ByteArrayToHexString(intent.getByteArrayExtra(NfcAdapter.EXTRA_ID)));
            Intent intents = new Intent(home_activity.this, data_member_activity_v2.class);
            intents.putExtras(bundle);
            startActivity(intents);
        }
    }

    private String ByteArrayToHexString(byte [] inarray) {
        int i, j, in;
        String [] hex = {"0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"};
        String out= "";
        for(j = 0 ; j < inarray.length ; ++j)
        {
            in = (int) inarray[j] & 0xff;
            i = (in >> 4) & 0x0f;
            out += hex[i];
            i = in & 0x0f;
            out += hex[i];
        }
        return out;
    }

    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == REQUEST_CODE_QRCODE){
            if (resultCode == RESULT_OK) {
                //Use Data to get string
                String string = data.getStringExtra("RESULT_STRING");

                Log.i("REQUST_CODE_QRCODE", string);

//                showVoucherDialog();


//                Bundle bundle = new Bundle();
//                bundle.putString("dari", "transaksi");
//                bundle.putString("id_member", string);
//
//                string = string.replace("http://membercard.cbs-indo.com/index.php?p=login&code=","code=");
//                Intent intents = new Intent(tag_rfid_transaksi.this, data_member_activity_v2.class);
//                intents.putExtras(bundle);
//                startActivity(intents);
//                finish();
            }

        }
    }

    private void showVoucherDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        LayoutInflater inflater = getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_voucher_transaction, null);
        builder.setView(dialogView);

        AlertDialog dialog = builder.create();

        Button btnMember = dialogView.findViewById(R.id.btnMember);
        Button btnWithoutMember = dialogView.findViewById(R.id.btnWithoutMember);

        btnMember.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Lakukan sesuatu untuk transaksi dengan member
                dialog.dismiss();
            }
        });

        btnWithoutMember.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Lakukan sesuatu untuk transaksi tanpa member
                dialog.dismiss();
            }
        });

        dialog.show();
    }

}


