package com.project.aplikasi.petugas_cbs.data_galery;

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

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class data_galery_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_galery_apidata> data;
    TextView id_galery
			,tanggal
			,judul
			,foto
			,isi
			
            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_galery_adapter(Activity activity, ArrayList<data_galery_apidata> data) {
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
            v = vi.inflate( R.layout.data_galery_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_galery = (TextView) v.findViewById(R.id.id_galery);
			tanggal = (TextView) v.findViewById(R.id.tanggal);
            judul = (TextView) v.findViewById(R.id.judul);
            foto = (TextView) v.findViewById(R.id.foto);
            isi = (TextView) v.findViewById(R.id.isi);
            

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_galery", data.get(position).get_id_galery());
					bundle.putString("tanggal", data.get(position).get_tanggal());
                    bundle.putString("judul", data.get(position).get_judul());
                    bundle.putString("foto", data.get(position).get_foto());
                    bundle.putString("isi", data.get(position).get_isi());
                    
                    
                    Intent intent = new Intent(activity, data_galery_edit.class);
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
									data_galery_apiservice mAPIService = 
									data_galery_apiutils.getAPIService();
									mAPIService.proses_hapus_data_galery(
											data.get(position).get_id_galery(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_galery_activity)activity).fetch_data_galery();
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

            id_galery.setText("id_galery "+data.get(position).get_id_galery());
			tanggal.setText("tanggal "+data.get(position).get_tanggal());
            judul.setText("judul "+data.get(position).get_judul());
            foto.setText("foto "+data.get(position).get_foto());
            isi.setText("isi "+data.get(position).get_isi());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_galery_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}







