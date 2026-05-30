package com.project.aplikasi.petugas_cbs.data_profil;

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


public class data_profil_tambah_v2_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_profil_apidata> data;
    TextView id_profil
			,nama
			,alamat
			,no_telepon
			,sejarah
			,visi
			,misi
			,deskripsi
			,foto
			;
    Button tombol_hapus;
	data_profil_apiservice mAPIService;
	loading loading;

    public data_profil_tambah_v2_adapter(Activity activity, ArrayList<data_profil_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_profil_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_profil_tambah_v2_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_profil = (TextView) v.findViewById(R.id.id_profil);
			nama = (TextView) v.findViewById(R.id.nama);
            alamat = (TextView) v.findViewById(R.id.alamat);
            no_telepon = (TextView) v.findViewById(R.id.no_telepon);
            sejarah = (TextView) v.findViewById(R.id.sejarah);
            visi = (TextView) v.findViewById(R.id.visi);
            misi = (TextView) v.findViewById(R.id.misi);
            deskripsi = (TextView) v.findViewById(R.id.deskripsi);
            foto = (TextView) v.findViewById(R.id.foto);
            
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_profil_tambah_v2)activity);

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
									  data_profil_apiservice mAPIService =
                                            data_profil_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_profil(
                                            data.get(position).get_id_profil(),
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

            id_profil.setText(""+data.get(position).get_id_profil());
            nama.setText(""+data.get(position).get_nama());
            alamat.setText(""+data.get(position).get_alamat());
            no_telepon.setText(""+data.get(position).get_no_telepon());
            sejarah.setText(""+data.get(position).get_sejarah());
            visi.setText(""+data.get(position).get_visi());
            misi.setText(""+data.get(position).get_misi());
            deskripsi.setText(""+data.get(position).get_deskripsi());
            foto.setText(""+data.get(position).get_foto());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_profil_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}






