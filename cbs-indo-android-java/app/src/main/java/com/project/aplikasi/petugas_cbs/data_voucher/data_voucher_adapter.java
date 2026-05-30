package com.project.aplikasi.petugas_cbs.data_voucher;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
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

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class data_voucher_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_voucher_apidata> data;
    TextView id_voucher
                 ,qrcode
                 ,id_relasi
                 ,nominal
                 ,tanggal_kadaluarsa
                 ,id_spbu
                 ,id_penjualan_voucher
                 ,status
                 ,file_voucher
                 ,tanggal_dibuka

            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_voucher_adapter(Activity activity, ArrayList<data_voucher_apidata> data) {
        this.activity = activity;
        this.data = data;
    }

    @Override
    public int getCount() {
        if (data == null){
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
            v = vi.inflate( R.layout.data_voucher_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_voucher = (TextView) v.findViewById(R.id.id_voucher);
            qrcode = (TextView) v.findViewById(R.id.qrcode);
            id_relasi = (TextView) v.findViewById(R.id.id_relasi);
            nominal = (TextView) v.findViewById(R.id.nominal);
            tanggal_kadaluarsa = (TextView) v.findViewById(R.id.tanggal_kadaluarsa);
            id_spbu = (TextView) v.findViewById(R.id.id_spbu);
            id_penjualan_voucher = (TextView) v.findViewById(R.id.id_penjualan_voucher);
            status = (TextView) v.findViewById(R.id.status);
            file_voucher = (TextView) v.findViewById(R.id.file_voucher);
            tanggal_dibuka = (TextView) v.findViewById(R.id.tanggal_dibuka);


            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("", data.get(position).get_id_voucher());
                    bundle.putString("qrcode", data.get(position).get_qrcode());
                    bundle.putString("id_relasi", data.get(position).get_id_relasi());
                    bundle.putString("nominal", data.get(position).get_nominal());
                    bundle.putString("tanggal_kadaluarsa", data.get(position).get_tanggal_kadaluarsa());
                    bundle.putString("id_spbu", data.get(position).get_id_spbu());
                    bundle.putString("id_penjualan_voucher", data.get(position).get_id_penjualan_voucher());
                    bundle.putString("status", data.get(position).get_status());
                    bundle.putString("file_voucher", data.get(position).get_file_voucher());
                    bundle.putString("tanggal_dibuka", data.get(position).get_tanggal_dibuka());

                    
                    Intent intent = new Intent(activity, data_voucher_edit.class);
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
                    BackAlertDialog.setPositiveButton("Ya",
                            new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    //Proses Hapus
                                    String token = "Bearer " + new config_global().ambil(activity);
									data_voucher_apiservice mAPIService = 
									data_voucher_apiutils.getAPIService();
									mAPIService.proses_hapus_data_voucher(
											data.get(position).get_id_voucher(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_voucher_activity)activity).fetch_data_voucher();
										}
				
										@Override
										public void onFailure(Call<Object> call, Throwable t) {
											Toast.makeText(activity, "Gagal", Toast.LENGTH_LONG).show();
										}
									});

                                }
                            });

                    BackAlertDialog.setNegativeButton("Tidak",
                            new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    //Batal Hapus
                                    dialog.cancel();
                                }
                            });
                    BackAlertDialog.show();
					
                }
            });

            id_voucher.setText("id_voucher "+data.get(position).get_id_voucher());
            qrcode.setText("qrcode "+data.get(position).get_qrcode());
            id_relasi.setText("id_relasi "+data.get(position).get_id_relasi());
            nominal.setText("nominal "+data.get(position).get_nominal());
            tanggal_kadaluarsa.setText("tanggal_kadaluarsa "+data.get(position).get_tanggal_kadaluarsa());
            id_spbu.setText("id_spbu "+data.get(position).get_id_spbu());
            id_penjualan_voucher.setText("id_penjualan_voucher "+data.get(position).get_id_penjualan_voucher());
            status.setText("status "+data.get(position).get_status());
            file_voucher.setText("file_voucher "+data.get(position).get_file_voucher());
            tanggal_dibuka.setText("tanggal_dibuka "+data.get(position).get_tanggal_dibuka());


        }

        return v;
    }

    public void updateResults(ArrayList<data_voucher_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}
