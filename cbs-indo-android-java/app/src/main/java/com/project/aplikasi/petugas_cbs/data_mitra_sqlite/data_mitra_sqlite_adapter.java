package com.project.aplikasi.petugas_cbs.data_mitra_sqlite;

import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.RecyclerView;
import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;
import android.text.Html;

import com.project.aplikasi.petugas_cbs.R;

import java.util.ArrayList;
import java.util.List;


public class data_mitra_sqlite_adapter extends RecyclerView.Adapter<data_mitra_sqlite_adapter.data_mitra_ViewHolder> {

    Activity activity;
    private List<data_mitra_sqlite_data> datalist = new ArrayList<>();
    private data_mitra_sqlite_dbhandler dbHandler;
    private data_mitra_sqlite_adapter adapter;


    public data_mitra_sqlite_adapter(Activity activity,List<data_mitra_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_mitra_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_mitra_tampil_v2, parent, false);
        data_mitra_ViewHolder mahasiswaViewHolder = new data_mitra_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_mitra_ViewHolder holder, int position) {
        holder.txt_result_id_mitra.setText("id_mitra : " + datalist.get(position).get_id_mitra());
		holder.txt_result_nama_mitra.setText(Html.fromHtml( "<b>Nama mitra : </b>"+datalist.get(position).get_nama_mitra()+"") );
		holder.txt_result_alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+datalist.get(position).get_alamat()+"") );
		holder.txt_result_no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+datalist.get(position).get_no_telepon()+"") );
		holder.txt_result_nama_pemilik.setText(Html.fromHtml( "<b>Nama pemilik : </b>"+datalist.get(position).get_nama_pemilik()+"") );
		holder.txt_result_no_telepon_pemilik.setText(Html.fromHtml( "<b>No telepon pemilik : </b>"+datalist.get(position).get_no_telepon_pemilik()+"") );
		holder.txt_result_tanggal_daftar.setText(Html.fromHtml( "<b>Tanggal daftar : </b>"+datalist.get(position).get_tanggal_daftar()+"") );
		holder.txt_result_username.setText(Html.fromHtml( "<b>Username : </b>"+datalist.get(position).get_username()+"") );
		holder.txt_result_password.setText(Html.fromHtml( "<b>Password : </b>"+datalist.get(position).get_password()+"") );
		holder.txt_result_status.setText(Html.fromHtml( "<b>Status : </b>"+datalist.get(position).get_status()+"") );
		holder.txt_result_gambar_logo.setText(Html.fromHtml( "<b>Gambar logo : </b>"+datalist.get(position).get_gambar_logo()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_mitra_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_mitra;
		TextView txt_result_nama_mitra;
        TextView txt_result_alamat;
        TextView txt_result_no_telepon;
        TextView txt_result_nama_pemilik;
        TextView txt_result_no_telepon_pemilik;
        TextView txt_result_tanggal_daftar;
        TextView txt_result_username;
        TextView txt_result_password;
        TextView txt_result_status;
        TextView txt_result_gambar_logo;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_mitra_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_mitra_sqlite_dbhandler(activity);
            txt_result_id_mitra = (TextView) itemView.findViewById(R.id.id_mitra);
			txt_result_nama_mitra = (TextView) itemView.findViewById(R.id.nama_mitra);
            txt_result_alamat = (TextView) itemView.findViewById(R.id.alamat);
            txt_result_no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            txt_result_nama_pemilik = (TextView) itemView.findViewById(R.id.nama_pemilik);
            txt_result_no_telepon_pemilik = (TextView) itemView.findViewById(R.id.no_telepon_pemilik);
            txt_result_tanggal_daftar = (TextView) itemView.findViewById(R.id.tanggal_daftar);
            txt_result_username = (TextView) itemView.findViewById(R.id.username);
            txt_result_password = (TextView) itemView.findViewById(R.id.password);
            txt_result_status = (TextView) itemView.findViewById(R.id.status);
            txt_result_gambar_logo = (TextView) itemView.findViewById(R.id.gambar_logo);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_mitra", datalist.get(getAdapterPosition()).get_id_mitra());
                    bundle.putString("nama_mitra", datalist.get(getAdapterPosition()).get_nama_mitra());
                    bundle.putString("alamat", datalist.get(getAdapterPosition()).get_alamat());
                    bundle.putString("no_telepon", datalist.get(getAdapterPosition()).get_no_telepon());
                    bundle.putString("nama_pemilik", datalist.get(getAdapterPosition()).get_nama_pemilik());
                    bundle.putString("no_telepon_pemilik", datalist.get(getAdapterPosition()).get_no_telepon_pemilik());
                    bundle.putString("tanggal_daftar", datalist.get(getAdapterPosition()).get_tanggal_daftar());
                    bundle.putString("username", datalist.get(getAdapterPosition()).get_username());
                    bundle.putString("password", datalist.get(getAdapterPosition()).get_password());
                    bundle.putString("status", datalist.get(getAdapterPosition()).get_status());
                    bundle.putString("gambar_logo", datalist.get(getAdapterPosition()).get_gambar_logo());
                    


                    Intent intent = new Intent(activity, data_mitra_sqlite_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);

                }
            });


            linearHapus.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    AlertDialog.Builder BackAlertDialog = new AlertDialog.Builder(activity);
                    BackAlertDialog.setTitle("Proses Hapus");
                    BackAlertDialog.setMessage("Apakah Anda ingin Menghapus Data?");
                    BackAlertDialog.setPositiveButton("Ya",
                            new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    //Proses Hapus

                                    dbHandler.hapus_data_mitra_sqlite( new data_mitra_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_mitra()
											, datalist.get(getAdapterPosition()).get_nama_mitra()
                                            , datalist.get(getAdapterPosition()).get_alamat()
                                            , datalist.get(getAdapterPosition()).get_no_telepon()
                                            , datalist.get(getAdapterPosition()).get_nama_pemilik()
                                            , datalist.get(getAdapterPosition()).get_no_telepon_pemilik()
                                            , datalist.get(getAdapterPosition()).get_tanggal_daftar()
                                            , datalist.get(getAdapterPosition()).get_username()
                                            , datalist.get(getAdapterPosition()).get_password()
                                            , datalist.get(getAdapterPosition()).get_status()
                                            , datalist.get(getAdapterPosition()).get_gambar_logo()
                                            
                                    ) );

                                    List<data_mitra_sqlite_data> data_mitra_sqliteList = dbHandler.get_semua_data_mitra_sqlite();
                                    adapter = new data_mitra_sqlite_adapter( activity, data_mitra_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_mitra_sqlite_activity)activity).fetch_data_mitra_sqlite();
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



        }
    }

    @Override
    public void onAttachedToRecyclerView(RecyclerView recyclerView) {
        super.onAttachedToRecyclerView(recyclerView);
    }
}















