//package com.project.aplikasi.petugas_cbs.data_promo;
//
//import android.app.Activity;
//import android.content.DialogInterface;
//import android.view.LayoutInflater;
//import android.view.View;
//import android.view.ViewGroup;
//import android.widget.BaseAdapter;
//import android.widget.Button;
//import android.widget.TextView;
//
//import androidx.appcompat.app.AlertDialog;
//
//import com.project.aplikasi.petugas_cbs.R;
//import com.project.aplikasi.petugas_cbs.config.config_global;
//import com.project.aplikasi.petugas_cbs.activity.loading;
//
//import java.util.ArrayList;
//
//import retrofit2.Call;
//import retrofit2.Callback;
//import retrofit2.Response;
//
//
//public class data_promo_tambah_v2_adapter extends BaseAdapter {
//
//    Activity activity;
//    ArrayList<data_promo_apidata> data;
//    TextView id_promo
//			,tanggal_mulai_berlaku
//			,tanggal_batas_berlaku
//			,nama_promo
//			,keterangan
//			,syarat_dan_ketentuan
//			,foto_promo
//			,jumlah_point
//			,status
//			;
//    Button tombol_hapus;
//	data_promo_apiservice mAPIService;
//	loading loading;
//
//    public data_promo_tambah_v2_adapter(Activity activity, ArrayList<data_promo_apidata> data) {
//        this.activity = activity;
//        this.data = data;
//		mAPIService = data_promo_apiutils.getAPIService();
//    }
//
//    @Override
//    public int getCount() {
//        if (data == null){
//            return 0;
//        }
//        return data.size();
//    }
//
//    @Override
//    public Object getItem(int position) {
//        return data.get(position);
//    }
//
//    @Override
//    public long getItemId(int position) {
//        return 0;
//    }
//
//    @Override
//    public View getView(final int position, View convertView, ViewGroup parent) {
//        View v = convertView;
//
//        if (v == null) {
//            LayoutInflater vi;
//            vi = LayoutInflater.from(activity);
//            v = vi.inflate( R.layout.data_promo_tambah_v2_tampil, null);
//        }
//
//        Object p = getItem(position);
//
//        if (p != null) {
//
//            id_promo = (TextView) v.findViewById(R.id.id_promo);
//			tanggal_mulai_berlaku = (TextView) v.findViewById(R.id.tanggal_mulai_berlaku);
//            tanggal_batas_berlaku = (TextView) v.findViewById(R.id.tanggal_batas_berlaku);
//            nama_promo = (TextView) v.findViewById(R.id.nama_promo);
//            keterangan = (TextView) v.findViewById(R.id.keterangan);
//            syarat_dan_ketentuan = (TextView) v.findViewById(R.id.syarat_dan_ketentuan);
//            foto_promo = (TextView) v.findViewById(R.id.foto_promo);
//            jumlah_point = (TextView) v.findViewById(R.id.jumlah_point);
//            status = (TextView) v.findViewById(R.id.status);
//
//            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
//			loading = new loading((data_promo_tambah_v2)activity);
//
//            tombol_hapus.setOnClickListener(new View.OnClickListener() {
//                @Override
//                public void onClick(View v) {
//
//
//                    AlertDialog.Builder BackAlertDialog = new AlertDialog.Builder(activity);
//                    BackAlertDialog.setTitle("Proses Hapus");
//                    BackAlertDialog.setMessage("Apakah Anda ingin Menghapus Data?");
//                    BackAlertDialog.setPositiveButton("Ya",
//                            new DialogInterface.OnClickListener() {
//                                public void onClick(DialogInterface dialog, int which) {
//                                    //Proses Hapus
//									loading.showDialog(1,"Please Wait","Proses Hapus Data..");
//									  data_promo_apiservice mAPIService =
//                                            data_promo_apiutils.getAPIService();
//                                    String token = "Bearer " + new config_global().ambil(activity);
//                                    mAPIService.proses_hapus_data_promo(
//                                            data.get(position).get_id_promo(),
//                                            token
//                                    ).enqueue(new Callback<Object>() {
//                                        @Override
//                                        public void onResponse(Call<Object> call, Response<Object> response) {
//                                            if (new config_global().checkTokenOlineIsValid(activity,
//                                                    response.code())){
//                                                data.remove(position);
//                                                 notifyDataSetChanged();
//                                            }
//                                            loading.hideDialog();
//                                        }
//
//                                        @Override
//                                        public void onFailure(Call<Object> call, Throwable t) {
//                                            loading.hideDialog();
//                                        }
//                                    });
//                                }
//                            });
//
//                    BackAlertDialog.setNegativeButton("Tidak",
//                            new DialogInterface.OnClickListener() {
//                                public void onClick(DialogInterface dialog, int which) {
//                                    //Batal Hapus
//                                    dialog.cancel();
//                                }
//                            });
//                    BackAlertDialog.show();
//
//
//
//                }
//            });
//
//            id_promo.setText(""+data.get(position).get_id_promo());
//            tanggal_mulai_berlaku.setText(""+data.get(position).get_tanggal_mulai_berlaku());
//            tanggal_batas_berlaku.setText(""+data.get(position).get_tanggal_batas_berlaku());
//            nama_promo.setText(""+data.get(position).get_nama_promo());
//            keterangan.setText(""+data.get(position).get_keterangan());
//            syarat_dan_ketentuan.setText(""+data.get(position).get_syarat_dan_ketentuan());
//            foto_promo.setText(""+data.get(position).get_foto_promo());
//            jumlah_point.setText(""+data.get(position).get_jumlah_point());
//            status.setText(""+data.get(position).get_status());
//
//
//        }
//
//        return v;
//    }
//
//    public void updateResults(ArrayList<data_promo_apidata> result) {
//        data = result;
//        notifyDataSetChanged();
//    }
//}
//
//
//
//
//
//
