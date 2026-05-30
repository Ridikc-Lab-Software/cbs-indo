package com.project.aplikasi.petugas_cbs.data_mitra;

import android.app.Activity;
import android.content.DialogInterface;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AlertDialog;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class data_mitra_tambah_v2_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_mitra_apidata> data;
    TextView id_mitra
			,nama_mitra
			,alamat
			,no_telepon
			,nama_pemilik
			,no_telepon_pemilik
			,tanggal_daftar
			,username
			,password
			,status
			,gambar_logo
			;
    Button tombol_hapus;
	data_mitra_apiservice mAPIService;
	loading loading;

    public data_mitra_tambah_v2_adapter(Activity activity, ArrayList<data_mitra_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_mitra_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_mitra_tambah_v2_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_mitra = (TextView) v.findViewById(R.id.id_mitra);
			nama_mitra = (TextView) v.findViewById(R.id.nama_mitra);
            alamat = (TextView) v.findViewById(R.id.alamat);
            no_telepon = (TextView) v.findViewById(R.id.no_telepon);
            nama_pemilik = (TextView) v.findViewById(R.id.nama_pemilik);
            no_telepon_pemilik = (TextView) v.findViewById(R.id.no_telepon_pemilik);
            tanggal_daftar = (TextView) v.findViewById(R.id.tanggal_daftar);
            username = (TextView) v.findViewById(R.id.username);
            password = (TextView) v.findViewById(R.id.password);
            status = (TextView) v.findViewById(R.id.status);
            gambar_logo = (TextView) v.findViewById(R.id.gambar_logo);
            
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_mitra_tambah_v2)activity);

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
									loading.showDialog(1,"Please Wait","Proses Hapus Data..");
									  data_mitra_apiservice mAPIService =
                                            data_mitra_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_mitra(
                                            data.get(position).get_id_mitra(),
                                            token
                                    ).enqueue(new Callback<Object>() {
                                        @Override
                                        public void onResponse(Call<Object> call, Response<Object> response) {
                                            if (new config_global().checkTokenOlineIsValid(activity,
                                                    response.code())){
                                                data.remove(position);
                                                 notifyDataSetChanged();
                                            }
                                            loading.hideDialog();
                                        }

                                        @Override
                                        public void onFailure(Call<Object> call, Throwable t) {
                                            loading.hideDialog();
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

            id_mitra.setText(""+data.get(position).get_id_mitra());
            nama_mitra.setText(""+data.get(position).get_nama_mitra());
            alamat.setText(""+data.get(position).get_alamat());
            no_telepon.setText(""+data.get(position).get_no_telepon());
            nama_pemilik.setText(""+data.get(position).get_nama_pemilik());
            no_telepon_pemilik.setText(""+data.get(position).get_no_telepon_pemilik());
            tanggal_daftar.setText(""+data.get(position).get_tanggal_daftar());
            username.setText(""+data.get(position).get_username());
            password.setText(""+data.get(position).get_password());
            status.setText(""+data.get(position).get_status());
            gambar_logo.setText(""+data.get(position).get_gambar_logo());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_mitra_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}






