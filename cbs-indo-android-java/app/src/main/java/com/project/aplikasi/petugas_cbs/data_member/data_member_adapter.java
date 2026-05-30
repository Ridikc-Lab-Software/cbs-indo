package com.project.aplikasi.petugas_cbs.data_member;

import static android.app.Activity.RESULT_OK;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.tag_rfid_transaksi;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class data_member_adapter extends BaseAdapter {

    private String RETURN = "ID_MEMBER";
    Activity activity;
    ArrayList<data_member_apidata> data;
    TextView id_member, nama, alamat, no_telepon, jenis_kelamin, tanggal_terdaftar, id_kategori_member, kode_rfid, point, username, password;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_member_adapter(Activity activity, ArrayList<data_member_apidata> data) {
        this.activity = activity;
        this.data = data;
    }

    @Override
    public int getCount() {
        if (data == null) {
            return 0;
        }
        return data.size();
    }

    @Override
    public Object getItem(int position) {
        return data.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        View v = convertView;

        if (v == null) {
            LayoutInflater vi;
            vi = LayoutInflater.from(activity);
            v = vi.inflate(R.layout.data_member_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_member = (TextView) v.findViewById(R.id.id_member);
            id_member.setVisibility(View.GONE);

            nama = (TextView) v.findViewById(R.id.nama);
            alamat = (TextView) v.findViewById(R.id.alamat);
            no_telepon = (TextView) v.findViewById(R.id.no_telepon);
            jenis_kelamin = (TextView) v.findViewById(R.id.jenis_kelamin);
            jenis_kelamin.setVisibility(View.GONE);

            tanggal_terdaftar = (TextView) v.findViewById(R.id.tanggal_terdaftar);
            tanggal_terdaftar.setVisibility(View.GONE);

            id_kategori_member = (TextView) v.findViewById(R.id.id_kategori_member);
            id_kategori_member.setVisibility(View.GONE);

            kode_rfid = (TextView) v.findViewById(R.id.kode_rfid);
            kode_rfid.setVisibility(View.GONE);

            point = (TextView) v.findViewById(R.id.point);
            point.setVisibility(View.GONE);

            username = (TextView) v.findViewById(R.id.username);
            username.setVisibility(View.GONE);

            password = (TextView) v.findViewById(R.id.password);
            password.setVisibility(View.GONE);

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_edit.setVisibility(View.GONE);

            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
            tombol_hapus.setVisibility(View.GONE);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_member", data.get(position).get_id_member());
                    bundle.putString("nama", data.get(position).get_nama());
                    bundle.putString("alamat", data.get(position).get_alamat());
                    bundle.putString("no_telepon", data.get(position).get_no_telepon());
                    bundle.putString("jenis_kelamin", data.get(position).get_jenis_kelamin());
                    bundle.putString("tanggal_terdaftar", data.get(position).get_tanggal_terdaftar());
                    bundle.putString("id_kategori_member", data.get(position).get_id_kategori_member());
                    bundle.putString("kode_rfid", data.get(position).get_kode_rfid());
                    bundle.putString("point", data.get(position).get_point());
                    bundle.putString("username", data.get(position).get_username());
                    bundle.putString("password", data.get(position).get_password());


                    Intent intent = new Intent(activity, data_member_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            tombol_hapus.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {


                    AlertDialog.Builder BackAlertDialog = new AlertDialog.Builder(activity);
                    BackAlertDialog.setTitle("Proses Hapus");
                    BackAlertDialog.setMessage("Apakah Anda ingin Menghapus Data?");
                    BackAlertDialog.setPositiveButton("Ya", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            //Proses Hapus
                            String token = "Bearer " + new config_global().ambil(activity);
                            data_member_apiservice mAPIService = data_member_apiutils.getAPIService();
                            mAPIService.proses_hapus_data_member(data.get(position).get_id_member(), token).enqueue(new Callback<Object>() {
                                @Override
                                public void onResponse(Call<Object> call, Response<Object> response) {
                                    ((data_member_activity) activity).fetch_data_member();
                                }

                                @Override
                                public void onFailure(Call<Object> call, Throwable t) {
                                    Toast.makeText(activity, "Gagal", Toast.LENGTH_LONG).show();
                                }
                            });

                        }
                    });

                    BackAlertDialog.setNegativeButton("Tidak", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            //Batal Hapus
                            dialog.cancel();
                        }
                    });
                    BackAlertDialog.show();

                }
            });

            id_member.setText("id_member " + data.get(position).get_id_member());
            nama.setText("NAMA: " + data.get(position).get_nama());
            alamat.setText("ALAMAT: " + data.get(position).get_alamat());
            no_telepon.setText("NO TELEPON: " + data.get(position).get_no_telepon());
            jenis_kelamin.setText("jenis_kelamin " + data.get(position).get_jenis_kelamin());
            tanggal_terdaftar.setText("tanggal_terdaftar " + data.get(position).get_tanggal_terdaftar());
            id_kategori_member.setText("id_kategori_member " + data.get(position).get_id_kategori_member());
            kode_rfid.setText("kode_rfid " + data.get(position).get_kode_rfid());
            point.setText("point " + data.get(position).get_point());
            username.setText("username " + data.get(position).get_username());
            password.setText("password " + data.get(position).get_password());
            v.findViewById(R.id.tombol_tambah).setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent();
                    String kode;
                    if (RETURN.equals("ID_MEMBER")) {
                         kode = data.get(position).get_id_member();
                        intent.putExtra("RESULT_STRING", kode);
                    } else { // RETURN.equals("KODE_RFID")
                         kode = data.get(position).get_id_member();
                        intent.putExtra("RESULT_STRING", kode);
                    }

//                    Toast.makeText( activity,  RETURN,
//                            Toast.LENGTH_LONG ).show();
//
//
//                    Toast.makeText( activity,  kode,
//                            Toast.LENGTH_LONG ).show();

                    activity.setResult(RESULT_OK, intent);
                    activity.finish();
                }
            }); //tombol_tambah
        }

        return v;
    }

    public void updateResults(ArrayList<data_member_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }

    public void setReturn(String aReturn) {
        this.RETURN = aReturn;
    }
}







