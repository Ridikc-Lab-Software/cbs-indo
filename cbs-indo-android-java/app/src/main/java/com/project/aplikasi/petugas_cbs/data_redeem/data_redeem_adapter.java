package com.project.aplikasi.petugas_cbs.data_redeem;

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


public class data_redeem_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_redeem_apidata> data;
    TextView id_redeem
			,tanggal
			,jam
			,id_member
			,id_mitra
			,id_promo
			,point
			,status
			
            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_redeem_adapter(Activity activity, ArrayList<data_redeem_apidata> data) {
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
            v = vi.inflate( R.layout.data_redeem_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_redeem = (TextView) v.findViewById(R.id.id_redeem);
			tanggal = (TextView) v.findViewById(R.id.tanggal);
            jam = (TextView) v.findViewById(R.id.jam);
            id_member = (TextView) v.findViewById(R.id.id_member);
            id_mitra = (TextView) v.findViewById(R.id.id_mitra);
            id_promo = (TextView) v.findViewById(R.id.id_promo);
            point = (TextView) v.findViewById(R.id.point);
            status = (TextView) v.findViewById(R.id.status);
            

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_redeem", data.get(position).get_id_redeem());
					bundle.putString("tanggal", data.get(position).get_tanggal());
                    bundle.putString("jam", data.get(position).get_jam());
                    bundle.putString("id_member", data.get(position).get_id_member());
                    bundle.putString("id_mitra", data.get(position).get_id_mitra());
                    bundle.putString("id_promo", data.get(position).get_id_promo());
                    bundle.putString("point", data.get(position).get_point());
                    bundle.putString("status", data.get(position).get_status());
                    
                    
                    Intent intent = new Intent(activity, data_redeem_edit.class);
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
									data_redeem_apiservice mAPIService = 
									data_redeem_apiutils.getAPIService();
									mAPIService.proses_hapus_data_redeem(
											data.get(position).get_id_redeem(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_redeem_activity)activity).fetch_data_redeem();
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

            id_redeem.setText("id_redeem "+data.get(position).get_id_redeem());
			tanggal.setText("tanggal "+data.get(position).get_tanggal());
            jam.setText("jam "+data.get(position).get_jam());
            id_member.setText("id_member "+data.get(position).get_id_member());
            id_mitra.setText("id_mitra "+data.get(position).get_id_mitra());
            id_promo.setText("id_promo "+data.get(position).get_id_promo());
            point.setText("point "+data.get(position).get_point());
            status.setText("status "+data.get(position).get_status());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_redeem_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}







