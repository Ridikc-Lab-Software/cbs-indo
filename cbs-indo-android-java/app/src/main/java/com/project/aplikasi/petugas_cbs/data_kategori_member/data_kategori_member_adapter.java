package com.project.aplikasi.petugas_cbs.data_kategori_member;

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


public class data_kategori_member_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_kategori_member_apidata> data;
    TextView id_kategori_member
			,kategori_member
			,gambar_logo
			
            ;
    Button tombol_edit, tombol_hapus;
    protected int REQUEST_CODE_TAMBAH = 3543;

    public data_kategori_member_adapter(Activity activity, ArrayList<data_kategori_member_apidata> data) {
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
            v = vi.inflate( R.layout.data_kategori_member_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_kategori_member = (TextView) v.findViewById(R.id.id_kategori_member);
			kategori_member = (TextView) v.findViewById(R.id.kategori_member);
            gambar_logo = (TextView) v.findViewById(R.id.gambar_logo);
            

            tombol_edit = (Button) v.findViewById(R.id.tombol_edit);
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);

            tombol_edit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_kategori_member", data.get(position).get_id_kategori_member());
					bundle.putString("kategori_member", data.get(position).get_kategori_member());
                    bundle.putString("gambar_logo", data.get(position).get_gambar_logo());
                    
                    
                    Intent intent = new Intent(activity, data_kategori_member_edit.class);
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
									data_kategori_member_apiservice mAPIService = 
									data_kategori_member_apiutils.getAPIService();
									mAPIService.proses_hapus_data_kategori_member(
											data.get(position).get_id_kategori_member(),
											token
									).enqueue(new Callback<Object>() {			  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_kategori_member_activity)activity).fetch_data_kategori_member();
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

            id_kategori_member.setText("id_kategori_member "+data.get(position).get_id_kategori_member());
			kategori_member.setText("kategori_member "+data.get(position).get_kategori_member());
            gambar_logo.setText("gambar_logo "+data.get(position).get_gambar_logo());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_kategori_member_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}







