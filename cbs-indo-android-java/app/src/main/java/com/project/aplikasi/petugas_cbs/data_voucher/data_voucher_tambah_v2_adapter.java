package com.project.aplikasi.petugas_cbs.data_voucher;

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


public class data_voucher_tambah_v2_adapter extends BaseAdapter {

    Activity activity;
    ArrayList<data_voucher_apidata> data;
    TextView id_voucher
    ,qrcode
    ,id_relasi
    ,nominal
    ,tanggal_kadaluarsa
    ,id_spbu
    ,id_penjualan_voucher
    ,status
    ,file_voucher
    ,tanggal_dibuka
;
    Button tombol_hapus;
	data_voucher_apiservice mAPIService;
	loading loading;

    public data_voucher_tambah_v2_adapter(Activity activity, ArrayList<data_voucher_apidata> data) {
        this.activity = activity;
        this.data = data;
		mAPIService = data_voucher_apiutils.getAPIService();
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
            v = vi.inflate( R.layout.data_voucher_tambah_v2_tampil, null);
        }

        Object p = getItem(position);

        if (p != null) {

            id_voucher = (TextView) v.findViewById(R.id.id_voucher);
            qrcode = (TextView) v.findViewById(R.id.qrcode);
            id_relasi = (TextView) v.findViewById(R.id.id_relasi);
            nominal = (TextView) v.findViewById(R.id.nominal);
            tanggal_kadaluarsa = (TextView) v.findViewById(R.id.tanggal_kadaluarsa);
            id_spbu = (TextView) v.findViewById(R.id.id_spbu);
            id_penjualan_voucher = (TextView) v.findViewById(R.id.id_penjualan_voucher);
            status = (TextView) v.findViewById(R.id.status);
            file_voucher = (TextView) v.findViewById(R.id.file_voucher);
            tanggal_dibuka = (TextView) v.findViewById(R.id.tanggal_dibuka);

            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
			loading = new loading((data_voucher_tambah_v2)activity);

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
									  data_voucher_apiservice mAPIService =
                                            data_voucher_apiutils.getAPIService();
                                    String token = "Bearer " + new config_global().ambil(activity);
                                    mAPIService.proses_hapus_data_voucher(
                                            data.get(position).get_id_voucher(),
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

            id_voucher.setText(""+data.get(position).get_id_voucher());
            qrcode.setText(""+data.get(position).get_qrcode());
            id_relasi.setText(""+data.get(position).get_id_relasi());
            nominal.setText(""+data.get(position).get_nominal());
            tanggal_kadaluarsa.setText(""+data.get(position).get_tanggal_kadaluarsa());
            id_spbu.setText(""+data.get(position).get_id_spbu());
            id_penjualan_voucher.setText(""+data.get(position).get_id_penjualan_voucher());
            status.setText(""+data.get(position).get_status());
            file_voucher.setText(""+data.get(position).get_file_voucher());
            tanggal_dibuka.setText(""+data.get(position).get_tanggal_dibuka());


        }

        return v;
    }

    public void updateResults(ArrayList<data_voucher_apidata> result) {
        data = result;
        notifyDataSetChanged();
    }
}
