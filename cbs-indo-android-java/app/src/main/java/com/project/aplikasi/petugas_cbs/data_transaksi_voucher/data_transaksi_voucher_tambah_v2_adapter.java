package com.project.aplikasi.petugas_cbs.data_transaksi_voucher;

import android.app.Activity;
import android.content.DialogInterface;
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
import com.project.aplikasi.petugas_cbs.activity.loading;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class data_transaksi_voucher_tambah_v2_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_transaksi_voucher_apidata> data;
    TextView id_transaksi_voucher
    ,id_voucher
    ,id_member
    ,nama_member
    ,tanggal_transaksi
    ,jenis_bbm
    ,nominal
;
    Button tombol_hapus;
	data_transaksi_voucher_apiservice mAPIService;
	loading loading;

    public data_transaksi_voucher_tambah_v2_adapter(Activity activity, ArrayList<data_transaksi_voucher_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_transaksi_voucher_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_transaksi_voucher_tambah_v2_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_transaksi_voucher = (TextView) v.findViewById(R.id.id_transaksi_voucher);
            id_voucher = (TextView) v.findViewById(R.id.id_voucher);
            id_member = (TextView) v.findViewById(R.id.id_member);
            nama_member = (TextView) v.findViewById(R.id.nama_member);
            tanggal_transaksi = (TextView) v.findViewById(R.id.tanggal_transaksi);
            jenis_bbm = (TextView) v.findViewById(R.id.jenis_bbm);
            nominal = (TextView) v.findViewById(R.id.nominal);

            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_transaksi_voucher_tambah_v2)activity);

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
									  data_transaksi_voucher_apiservice mAPIService =
                                            data_transaksi_voucher_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_transaksi_voucher(
                                            data.get(position).get_id_transaksi_voucher(),
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

            id_transaksi_voucher.setText(""+data.get(position).get_id_transaksi_voucher());
            id_voucher.setText(""+data.get(position).get_id_voucher());
            id_member.setText(""+data.get(position).get_id_member());
            nama_member.setText(""+data.get(position).get_nama_member());
            tanggal_transaksi.setText(""+data.get(position).get_tanggal_transaksi());
            jenis_bbm.setText(""+data.get(position).get_jenis_bbm());
            nominal.setText(""+data.get(position).get_nominal());


        }

        return v;
    }

    public void updateResults(ArrayList<data_transaksi_voucher_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}
