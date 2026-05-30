package com.project.aplikasi.petugas_cbs;

import static com.project.aplikasi.petugas_cbs.config.config_sessionmanager.view_error;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.app.PendingIntent;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.nfc.NfcAdapter;
import android.nfc.tech.IsoDep;
import android.nfc.tech.MifareClassic;
import android.nfc.tech.MifareUltralight;
import android.nfc.tech.Ndef;
import android.nfc.tech.NfcA;
import android.nfc.tech.NfcB;
import android.nfc.tech.NfcF;
import android.nfc.tech.NfcV;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.activity.qrcode2_activity;
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity;
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity_v2;
import com.project.aplikasi.petugas_cbs.data_promo.data_promo_activity_v2;
public class tag_rfid_redeem extends AppCompatActivity {

    Button qrcode;
    int REQUEST_CODE_TAMBAH = 1;
    private boolean isNfcAvailable = false;
    private NfcAdapter nfcAdapter;
    private final String[][] techList;
    private String id_mitra_from_intent = "";
    private boolean shouldShowDialog = true;

    public tag_rfid_redeem() {
        techList = new String[][] {
                new String[] {
                        NfcA.class.getName(),
                        NfcB.class.getName(),
                        NfcF.class.getName(),
                        NfcV.class.getName(),
                        IsoDep.class.getName(),
                        MifareClassic.class.getName(),
                        MifareUltralight.class.getName(),
                        Ndef.class.getName()
                }
        };
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tag_rfid_redeem);
        qrcode = findViewById(R.id.qrcode);

        // Cek status NFC
        nfcAdapter = NfcAdapter.getDefaultAdapter(this);

        if (nfcAdapter == null) {
            if (view_error == 1) {
                Toast.makeText(this, "Perangkat tidak mendukung NFC", Toast.LENGTH_LONG).show();
            }
            isNfcAvailable = false;
        } else if (!nfcAdapter.isEnabled()) {
            Toast.makeText(this, "NFC tidak aktif, silakan aktifkan terlebih dahulu", Toast.LENGTH_LONG).show();
            isNfcAvailable = false;
        } else {
            isNfcAvailable = true;
        }

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            id_mitra_from_intent = extras.getString("id_mitra", ""); // Simpan id_mitra dari Intent pembuka
        }

        qrcode.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               tampilkanOpsiRedeem();
            }
        });
//        tampilkanOpsiRedeem();

    }

    @Override
    protected void onResume() {
        super.onResume();
        if (isNfcAvailable) {
            PendingIntent pendingIntent = PendingIntent.getActivity(
                    this, 0,
                    new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP),
                    PendingIntent.FLAG_UPDATE_CURRENT | PendingIntent.FLAG_MUTABLE
            );
            IntentFilter filter = new IntentFilter();
            filter.addAction(NfcAdapter.ACTION_TAG_DISCOVERED);
            filter.addAction(NfcAdapter.ACTION_NDEF_DISCOVERED);
            filter.addAction(NfcAdapter.ACTION_TECH_DISCOVERED);

            nfcAdapter.enableForegroundDispatch(this, pendingIntent, new IntentFilter[]{filter}, techList);
        }
        if (shouldShowDialog) {
            tampilkanOpsiRedeem();
        }
        shouldShowDialog = false;
    }

    @Override
    protected void onPause() {
        super.onPause();
        if (isNfcAvailable) {
            nfcAdapter.disableForegroundDispatch(this);
        }
    }

    @Override
    protected void onNewIntent(Intent intent) {
        super.onNewIntent(intent); // Wajib

        if (isNfcAvailable && NfcAdapter.ACTION_TAG_DISCOVERED.equals(intent.getAction())) {

            // Gunakan variabel global yang sudah disimpan di onCreate
            // Agar tidak NullPointerException
            String id_mitra = id_mitra_from_intent;

            String nfcId = ByteArrayToHexString(intent.getByteArrayExtra(NfcAdapter.EXTRA_ID));

            Bundle bundle = new Bundle();
            bundle.putString("id_member", nfcId);
            bundle.putString("id_mitra", id_mitra);
            bundle.putString("dari", "redeem");

            Intent intents = new Intent(tag_rfid_redeem.this, data_member_activity_v2.class);
            intents.putExtras(bundle);
            startActivity(intents);
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        shouldShowDialog = true;
        if (requestCode == REQUEST_CODE_TAMBAH && resultCode == RESULT_OK) {
            Bundle bundles = getIntent().getExtras();
            String id_mitra_to_send = id_mitra_from_intent;
            String string = data.getStringExtra("RESULT_STRING");

            string = string.replace("http://membercard.cbs-indo.com/index.php?p=login&code=", "code=");

            Bundle bundle = new Bundle();
            bundle.putString("id_member", string);
//            bundle.putString("id_mitra", id_mitra);
            bundle.putString("id_mitra", id_mitra_to_send);
            bundle.putString("dari", "redeem");

            Intent intents = new Intent(tag_rfid_redeem.this, data_member_activity_v2.class);
            intents.putExtras(bundle);
            startActivity(intents);
        }
    }

    private String ByteArrayToHexString(byte[] inarray) {
        StringBuilder out = new StringBuilder();
        String[] hex = {"0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"};
        for (byte b : inarray) {
            int in = b & 0xff;
            out.append(hex[(in >> 4) & 0x0f]);
            out.append(hex[in & 0x0f]);
        }
        return out.toString();
    }

//    private void tampilkanOpsiRedeem(){
//        androidx.appcompat.app.AlertDialog.Builder builder = new AlertDialog.Builder(tag_rfid_redeem.this);
//        builder.setTitle("Input Redeem");
//        String[] array = {"Scan Qr Code", "Nomor Telepon", "Scan NFC"};
//        builder.setItems(array, (dialog, which) -> {
//            shouldShowDialog = false;
//            if (which == 0) {
//                Intent intent = new Intent(tag_rfid_redeem.this, qrcode2_activity.class);
//                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
//                dialog.dismiss();
//            } else if (which == 1) {
//                Intent intent = new Intent(tag_rfid_redeem.this, data_member_activity.class);
//                intent.putExtra("RETURN", "KODE_RFID");
//                startActivityForResult(intent, REQUEST_CODE_TAMBAH);
//                dialog.dismiss();
//            } else if (which == 2) {
//                dialog.dismiss();
//            }
//        });
//        builder.setOnCancelListener(dialog -> shouldShowDialog = true);
//        builder.show();
//    }


    private void tampilkanOpsiRedeem() {
        AlertDialog.Builder builder = new AlertDialog.Builder(tag_rfid_redeem.this);
        LayoutInflater inflater = getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_opsi_redeem, null);
        builder.setView(dialogView);

        AlertDialog alertDialog = builder.create();
        if (alertDialog.getWindow() != null) {
            alertDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
            alertDialog.getWindow().requestFeature(Window.FEATURE_NO_TITLE);
        }

        LinearLayout btnQrCode = dialogView.findViewById(R.id.btn_qr_code);
        LinearLayout btnNomorTelepon = dialogView.findViewById(R.id.btn_nomor_telepon);
        LinearLayout btnNfc = dialogView.findViewById(R.id.btn_nfc);

        btnQrCode.setOnClickListener(v -> {
            shouldShowDialog = false;
            Intent intent = new Intent(tag_rfid_redeem.this, qrcode2_activity.class);
            startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            alertDialog.dismiss();
        });

        btnNomorTelepon.setOnClickListener(v -> {
            shouldShowDialog = false;
            Intent intent = new Intent(tag_rfid_redeem.this, data_member_activity.class);
            intent.putExtra("RETURN", "KODE_RFID");
            startActivityForResult(intent, REQUEST_CODE_TAMBAH);
            alertDialog.dismiss();
        });

        btnNfc.setOnClickListener(v -> {
            alertDialog.dismiss();
            Toast.makeText(this, "Silakan tempelkan kartu NFC Anda", Toast.LENGTH_SHORT).show();
        });

        alertDialog.setOnCancelListener(dialog -> shouldShowDialog = true);
        alertDialog.show();
    }

    public void exit(View view) {
        finish();
    }
}
