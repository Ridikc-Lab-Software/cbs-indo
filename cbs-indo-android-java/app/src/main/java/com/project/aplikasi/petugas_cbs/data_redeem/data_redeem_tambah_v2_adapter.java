package com.project.aplikasi.petugas_cbs.data_redeem;

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


public class data_redeem_tambah_v2_adapter extends BaseAdapter {

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
    Button tombol_hapus;
	data_redeem_apiservice mAPIService;
	loading loading;

    public data_redeem_tambah_v2_adapter(Activity activity, ArrayList<data_redeem_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_redeem_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_redeem_tambah_v2_tampil, null);
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
            
            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_redeem_tambah_v2)activity);

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
									  data_redeem_apiservice mAPIService =
                                            data_redeem_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_redeem(
                                            data.get(position).get_id_redeem(),
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

            id_redeem.setText(""+data.get(position).get_id_redeem());
            tanggal.setText(""+data.get(position).get_tanggal());
            jam.setText(""+data.get(position).get_jam());
            id_member.setText(""+data.get(position).get_id_member());
            id_mitra.setText(""+data.get(position).get_id_mitra());
            id_promo.setText(""+data.get(position).get_id_promo());
            point.setText(""+data.get(position).get_point());
            status.setText(""+data.get(position).get_status());
            

        }

        return v;
    }

    public void updateResults(ArrayList<data_redeem_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}






