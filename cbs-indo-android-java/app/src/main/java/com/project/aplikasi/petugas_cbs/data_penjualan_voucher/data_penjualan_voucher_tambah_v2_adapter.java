package com.project.aplikasi.petugas_cbs.data_penjualan_voucher;

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


public class data_penjualan_voucher_tambah_v2_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_penjualan_voucher_apidata> data;
    TextView id_penjualan_voucher
    ,tanggal_penjualan
    ,id_relasi
    ,jumlah_voucher
    ,nominal
    ,password_voucher
    ,tanggal_dibuka
;
    Button tombol_hapus;
	data_penjualan_voucher_apiservice mAPIService;
	loading loading;

    public data_penjualan_voucher_tambah_v2_adapter(Activity activity, ArrayList<data_penjualan_voucher_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_penjualan_voucher_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_penjualan_voucher_tambah_v2_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_penjualan_voucher = (TextView) v.findViewById(R.id.id_penjualan_voucher);
            tanggal_penjualan = (TextView) v.findViewById(R.id.tanggal_penjualan);
            id_relasi = (TextView) v.findViewById(R.id.id_relasi);
            jumlah_voucher = (TextView) v.findViewById(R.id.jumlah_voucher);
            nominal = (TextView) v.findViewById(R.id.nominal);
            password_voucher = (TextView) v.findViewById(R.id.password_voucher);
            tanggal_dibuka = (TextView) v.findViewById(R.id.tanggal_dibuka);

            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_penjualan_voucher_tambah_v2)activity);

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
									  data_penjualan_voucher_apiservice mAPIService =
                                            data_penjualan_voucher_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_penjualan_voucher(
                                            data.get(position).get_id_penjualan_voucher(),
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

            id_penjualan_voucher.setText(""+data.get(position).get_id_penjualan_voucher());
            tanggal_penjualan.setText(""+data.get(position).get_tanggal_penjualan());
            id_relasi.setText(""+data.get(position).get_id_relasi());
            jumlah_voucher.setText(""+data.get(position).get_jumlah_voucher());
            nominal.setText(""+data.get(position).get_nominal());
            password_voucher.setText(""+data.get(position).get_password_voucher());
            tanggal_dibuka.setText(""+data.get(position).get_tanggal_dibuka());


        }

        return v;
    }

    public void updateResults(ArrayList<data_penjualan_voucher_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}
