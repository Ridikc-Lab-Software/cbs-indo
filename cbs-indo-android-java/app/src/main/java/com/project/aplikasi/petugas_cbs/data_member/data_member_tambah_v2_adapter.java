//package com.project.aplikasi.petugas_cbs.data_member;
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
//public class data_member_tambah_v2_adapter extends BaseAdapter {
//
//    Activity activity;
//    ArrayList<data_member_apidata> data;
//    TextView id_member
//			,nama
//			,alamat
//			,no_telepon
//			,jenis_kelamin
//			,tanggal_terdaftar
//			,id_kategori_member
//			,kode_rfid
//			,point
//			,username
//			,password
//			;
//    Button tombol_hapus;
//	data_member_apiservice mAPIService;
//	loading loading;
//
//    public data_member_tambah_v2_adapter(Activity activity, ArrayList<data_member_apidata> data) {
//        this.activity = activity;
//        this.data = data;
//		mAPIService = data_member_apiutils.getAPIService();
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
//            v = vi.inflate( R.layout.data_member_tambah_v2_tampil, null);
//        }
//
//        Object p = getItem(position);
//
//        if (p != null) {
//
//            id_member = (TextView) v.findViewById(R.id.id_member);
//			nama = (TextView) v.findViewById(R.id.nama);
//            alamat = (TextView) v.findViewById(R.id.alamat);
//            no_telepon = (TextView) v.findViewById(R.id.no_telepon);
//            jenis_kelamin = (TextView) v.findViewById(R.id.jenis_kelamin);
//            tanggal_terdaftar = (TextView) v.findViewById(R.id.tanggal_terdaftar);
//            id_kategori_member = (TextView) v.findViewById(R.id.id_kategori_member);
//            kode_rfid = (TextView) v.findViewById(R.id.kode_rfid);
//            point = (TextView) v.findViewById(R.id.point);
//            username = (TextView) v.findViewById(R.id.username);
//            password = (TextView) v.findViewById(R.id.password);
//
//            tombol_hapus = (Button) v.findViewById(R.id.tombol_hapus);
//			loading = new loading((data_member_tambah_v2)activity);
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
//									  data_member_apiservice mAPIService =
//                                            data_member_apiutils.getAPIService();
//                                    String token = "Bearer " + new config_global().ambil(activity);
//                                    mAPIService.proses_hapus_data_member(
//                                            data.get(position).get_id_member(),
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
//            id_member.setText(""+data.get(position).get_id_member());
//            nama.setText(""+data.get(position).get_nama());
//            alamat.setText(""+data.get(position).get_alamat());
//            no_telepon.setText(""+data.get(position).get_no_telepon());
//            jenis_kelamin.setText(""+data.get(position).get_jenis_kelamin());
//            tanggal_terdaftar.setText(""+data.get(position).get_tanggal_terdaftar());
//            id_kategori_member.setText(""+data.get(position).get_id_kategori_member());
//            kode_rfid.setText(""+data.get(position).get_kode_rfid());
//            point.setText(""+data.get(position).get_point());
//            username.setText(""+data.get(position).get_username());
//            password.setText(""+data.get(position).get_password());
//
//
//        }
//
//        return v;
//    }
//
//    public void updateResults(ArrayList<data_member_apidata> result) {
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
