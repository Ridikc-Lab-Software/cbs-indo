package com.project.aplikasi.petugas_cbs.data_pengaturan_point;

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


public class data_pengaturan_point_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_pengaturan_point_apidata> data;
    TextView id_pengaturan_point
			,nama_pengaturan
			,id_kategori_member
			,id_jenis_transaksi
			,point
			
            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_pengaturan_point_adapter(Activity activity, ArrayList<data_pengaturan_point_apidata> data) {
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
            v = vi.inflate( R.layout.data_pengaturan_point_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_pengaturan_point = (TextView) v.findViewById(R.id.id_pengaturan_point);
			nama_pengaturan = (TextView) v.findViewById(R.id.nama_pengaturan);
            id_kategori_member = (TextView) v.findViewById(R.id.id_kategori_member);
            id_jenis_transaksi = (TextView) v.findViewById(R.id.id_jenis_transaksi);
            point = (TextView) v.findViewById(R.id.point);
            

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_pengaturan_point", data.get(position).get_id_pengaturan_point());
					bundle.putString("nama_pengaturan", data.get(position).get_nama_pengaturan());
                    bundle.putString("id_kategori_member", data.get(position).get_id_kategori_member());
                    bundle.putString("id_jenis_transaksi", data.get(position).get_id_jenis_transaksi());
                    bundle.putString("point", data.get(position).get_point());
                    
                    
                    Intent intent = new Intent(activity, data_pengaturan_point_edit.class);
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
									data_pengaturan_point_apiservice mAPIService = 
									data_pengaturan_point_apiutils.getAPIService();
									mAPIService.proses_hapus_data_pengaturan_point(
											data.get(position).get_id_pengaturan_point(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_pengaturan_point_activity)activity).fetch_data_pengaturan_point();
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

            id_pengaturan_point.setText("id_pengaturan_point "+data.get(position).get_id_pengaturan_point());
			nama_pengaturan.setText("nama_pengaturan "+data.get(position).get_nama_pengaturan());
            id_kategori_member.setText("id_kategori_member "+data.get(position).get_id_kategori_member());
            id_jenis_transaksi.setText("id_jenis_transaksi "+data.get(position).get_id_jenis_transaksi());
            point.setText("point "+data.get(position).get_point());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_pengaturan_point_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}







