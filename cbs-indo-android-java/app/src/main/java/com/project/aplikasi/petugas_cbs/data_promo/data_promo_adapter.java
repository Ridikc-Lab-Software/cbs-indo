package com.project.aplikasi.petugas_cbs.data_promo;

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


public class data_promo_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_promo_apidata> data;
    TextView id_promo
			,tanggal_mulai_berlaku
			,tanggal_batas_berlaku
			,nama_promo
			,keterangan
			,syarat_dan_ketentuan
			,foto_promo
			,jumlah_point
			,status
			
            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_promo_adapter(Activity activity, ArrayList<data_promo_apidata> data) {
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
            v = vi.inflate( R.layout.data_promo_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_promo = (TextView) v.findViewById(R.id.id_promo);
			tanggal_mulai_berlaku = (TextView) v.findViewById(R.id.tanggal_mulai_berlaku);
            tanggal_batas_berlaku = (TextView) v.findViewById(R.id.tanggal_batas_berlaku);
            nama_promo = (TextView) v.findViewById(R.id.nama_promo);
            keterangan = (TextView) v.findViewById(R.id.keterangan);
            syarat_dan_ketentuan = (TextView) v.findViewById(R.id.syarat_dan_ketentuan);
            foto_promo = (TextView) v.findViewById(R.id.foto_promo);
            jumlah_point = (TextView) v.findViewById(R.id.jumlah_point);
            status = (TextView) v.findViewById(R.id.status);
            

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_promo", data.get(position).get_id_promo());
					bundle.putString("tanggal_mulai_berlaku", data.get(position).get_tanggal_mulai_berlaku());
                    bundle.putString("tanggal_batas_berlaku", data.get(position).get_tanggal_batas_berlaku());
                    bundle.putString("nama_promo", data.get(position).get_nama_promo());
                    bundle.putString("keterangan", data.get(position).get_keterangan());
                    bundle.putString("syarat_dan_ketentuan", data.get(position).get_syarat_dan_ketentuan());
                    bundle.putString("foto_promo", data.get(position).get_foto_promo());
                    bundle.putString("id_mitra", data.get(position).get_id_mitra());
                    bundle.putString("jumlah_point", data.get(position).get_jumlah_point());
                    bundle.putString("status", data.get(position).get_status());
                    
                    
                    Intent intent = new Intent(activity, data_promo_edit.class);
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
									data_promo_apiservice mAPIService = 
									data_promo_apiutils.getAPIService();
									mAPIService.proses_hapus_data_promo(
											data.get(position).get_id_promo(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_promo_activity)activity).fetch_data_promo();
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

            id_promo.setText("id_promo "+data.get(position).get_id_promo());
			tanggal_mulai_berlaku.setText("tanggal_mulai_berlaku "+data.get(position).get_tanggal_mulai_berlaku());
            tanggal_batas_berlaku.setText("tanggal_batas_berlaku "+data.get(position).get_tanggal_batas_berlaku());
            nama_promo.setText("nama_promo "+data.get(position).get_nama_promo());
            keterangan.setText("keterangan "+data.get(position).get_keterangan());
            syarat_dan_ketentuan.setText("syarat_dan_ketentuan "+data.get(position).get_syarat_dan_ketentuan());
            foto_promo.setText("foto_promo "+data.get(position).get_foto_promo());
            jumlah_point.setText("jumlah_point "+data.get(position).get_jumlah_point());
            status.setText("status "+data.get(position).get_status());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_promo_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}







