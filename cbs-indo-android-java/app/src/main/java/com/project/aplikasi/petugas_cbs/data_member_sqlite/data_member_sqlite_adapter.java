package com.project.aplikasi.petugas_cbs.data_member_sqlite;

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


public class data_member_sqlite_adapter extends RecyclerView.Adapter<data_member_sqlite_adapter.data_member_ViewHolder> {

    Activity activity;
    private List<data_member_sqlite_data> datalist = new ArrayList<>();
    private data_member_sqlite_dbhandler dbHandler;
    private data_member_sqlite_adapter adapter;


    public data_member_sqlite_adapter(Activity activity,List<data_member_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_member_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_member_tampil_v2, parent, false);
        data_member_ViewHolder mahasiswaViewHolder = new data_member_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_member_ViewHolder holder, int position) {
        holder.txt_result_id_member.setText("id_member : " + datalist.get(position).get_id_member());
		holder.txt_result_nama.setText(Html.fromHtml( "<b>Nama : </b>"+datalist.get(position).get_nama()+"") );
		holder.txt_result_alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+datalist.get(position).get_alamat()+"") );
		holder.txt_result_no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+datalist.get(position).get_no_telepon()+"") );
		holder.txt_result_jenis_kelamin.setText(Html.fromHtml( "<b>Jenis kelamin : </b>"+datalist.get(position).get_jenis_kelamin()+"") );
		holder.txt_result_tanggal_terdaftar.setText(Html.fromHtml( "<b>Tanggal terdaftar : </b>"+datalist.get(position).get_tanggal_terdaftar()+"") );
		holder.txt_result_id_kategori_member.setText(Html.fromHtml( "<b>Id kategori member : </b>"+datalist.get(position).get_id_kategori_member()+"") );
		holder.txt_result_kode_rfid.setText(Html.fromHtml( "<b>Kode rfid : </b>"+datalist.get(position).get_kode_rfid()+"") );
		holder.txt_result_point.setText(Html.fromHtml( "<b>Point : </b>"+datalist.get(position).get_point()+"") );
		holder.txt_result_username.setText(Html.fromHtml( "<b>Username : </b>"+datalist.get(position).get_username()+"") );
		holder.txt_result_password.setText(Html.fromHtml( "<b>Password : </b>"+datalist.get(position).get_password()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_member_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_member;
		TextView txt_result_nama;
        TextView txt_result_alamat;
        TextView txt_result_no_telepon;
        TextView txt_result_jenis_kelamin;
        TextView txt_result_tanggal_terdaftar;
        TextView txt_result_id_kategori_member;
        TextView txt_result_kode_rfid;
        TextView txt_result_point;
        TextView txt_result_username;
        TextView txt_result_password;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_member_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_member_sqlite_dbhandler(activity);
            txt_result_id_member = (TextView) itemView.findViewById(R.id.id_member);
			txt_result_nama = (TextView) itemView.findViewById(R.id.nama);
            txt_result_alamat = (TextView) itemView.findViewById(R.id.alamat);
            txt_result_no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            txt_result_jenis_kelamin = (TextView) itemView.findViewById(R.id.jenis_kelamin);
            txt_result_tanggal_terdaftar = (TextView) itemView.findViewById(R.id.tanggal_terdaftar);
            txt_result_id_kategori_member = (TextView) itemView.findViewById(R.id.id_kategori_member);
            txt_result_kode_rfid = (TextView) itemView.findViewById(R.id.kode_rfid);
            txt_result_point = (TextView) itemView.findViewById(R.id.point);
            txt_result_username = (TextView) itemView.findViewById(R.id.username);
            txt_result_password = (TextView) itemView.findViewById(R.id.password);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_member", datalist.get(getAdapterPosition()).get_id_member());
                    bundle.putString("nama", datalist.get(getAdapterPosition()).get_nama());
                    bundle.putString("alamat", datalist.get(getAdapterPosition()).get_alamat());
                    bundle.putString("no_telepon", datalist.get(getAdapterPosition()).get_no_telepon());
                    bundle.putString("jenis_kelamin", datalist.get(getAdapterPosition()).get_jenis_kelamin());
                    bundle.putString("tanggal_terdaftar", datalist.get(getAdapterPosition()).get_tanggal_terdaftar());
                    bundle.putString("id_kategori_member", datalist.get(getAdapterPosition()).get_id_kategori_member());
                    bundle.putString("kode_rfid", datalist.get(getAdapterPosition()).get_kode_rfid());
                    bundle.putString("point", datalist.get(getAdapterPosition()).get_point());
                    bundle.putString("username", datalist.get(getAdapterPosition()).get_username());
                    bundle.putString("password", datalist.get(getAdapterPosition()).get_password());
                    


                    Intent intent = new Intent(activity, data_member_sqlite_edit.class);
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

                                    dbHandler.hapus_data_member_sqlite( new data_member_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_member()
											, datalist.get(getAdapterPosition()).get_nama()
                                            , datalist.get(getAdapterPosition()).get_alamat()
                                            , datalist.get(getAdapterPosition()).get_no_telepon()
                                            , datalist.get(getAdapterPosition()).get_jenis_kelamin()
                                            , datalist.get(getAdapterPosition()).get_tanggal_terdaftar()
                                            , datalist.get(getAdapterPosition()).get_id_kategori_member()
                                            , datalist.get(getAdapterPosition()).get_kode_rfid()
                                            , datalist.get(getAdapterPosition()).get_point()
                                            , datalist.get(getAdapterPosition()).get_username()
                                            , datalist.get(getAdapterPosition()).get_password()
                                            
                                    ) );

                                    List<data_member_sqlite_data> data_member_sqliteList = dbHandler.get_semua_data_member_sqlite();
                                    adapter = new data_member_sqlite_adapter( activity, data_member_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_member_sqlite_activity)activity).fetch_data_member_sqlite();
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















