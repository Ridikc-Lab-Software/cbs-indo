package com.project.aplikasi.petugas_cbs.data_petugas_sqlite;

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


public class data_petugas_sqlite_adapter extends RecyclerView.Adapter<data_petugas_sqlite_adapter.data_petugas_ViewHolder> {

    Activity activity;
    private List<data_petugas_sqlite_data> datalist = new ArrayList<>();
    private data_petugas_sqlite_dbhandler dbHandler;
    private data_petugas_sqlite_adapter adapter;


    public data_petugas_sqlite_adapter(Activity activity,List<data_petugas_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_petugas_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_petugas_tampil_v2, parent, false);
        data_petugas_ViewHolder mahasiswaViewHolder = new data_petugas_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_petugas_ViewHolder holder, int position) {
        holder.txt_result_id_petugas.setText("id_petugas : " + datalist.get(position).get_id_petugas());
		holder.txt_result_nama.setText(Html.fromHtml( "<b>Nama : </b>"+datalist.get(position).get_nama()+"") );
		holder.txt_result_alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+datalist.get(position).get_alamat()+"") );
		holder.txt_result_no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+datalist.get(position).get_no_telepon()+"") );
		holder.txt_result_jenis_kelamin.setText(Html.fromHtml( "<b>Jenis kelamin : </b>"+datalist.get(position).get_jenis_kelamin()+"") );
		holder.txt_result_username.setText(Html.fromHtml( "<b>Username : </b>"+datalist.get(position).get_username()+"") );
		holder.txt_result_password.setText(Html.fromHtml( "<b>Password : </b>"+datalist.get(position).get_password()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_petugas_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_petugas;
		TextView txt_result_nama;
        TextView txt_result_alamat;
        TextView txt_result_no_telepon;
        TextView txt_result_jenis_kelamin;
        TextView txt_result_username;
        TextView txt_result_password;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_petugas_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_petugas_sqlite_dbhandler(activity);
            txt_result_id_petugas = (TextView) itemView.findViewById(R.id.id_petugas);
			txt_result_nama = (TextView) itemView.findViewById(R.id.nama);
            txt_result_alamat = (TextView) itemView.findViewById(R.id.alamat);
            txt_result_no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            txt_result_jenis_kelamin = (TextView) itemView.findViewById(R.id.jenis_kelamin);
            txt_result_username = (TextView) itemView.findViewById(R.id.username);
            txt_result_password = (TextView) itemView.findViewById(R.id.password);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_petugas", datalist.get(getAdapterPosition()).get_id_petugas());
                    bundle.putString("nama", datalist.get(getAdapterPosition()).get_nama());
                    bundle.putString("alamat", datalist.get(getAdapterPosition()).get_alamat());
                    bundle.putString("no_telepon", datalist.get(getAdapterPosition()).get_no_telepon());
                    bundle.putString("jenis_kelamin", datalist.get(getAdapterPosition()).get_jenis_kelamin());
                    bundle.putString("username", datalist.get(getAdapterPosition()).get_username());
                    bundle.putString("password", datalist.get(getAdapterPosition()).get_password());
                    


                    Intent intent = new Intent(activity, data_petugas_sqlite_edit.class);
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

                                    dbHandler.hapus_data_petugas_sqlite( new data_petugas_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_petugas()
											, datalist.get(getAdapterPosition()).get_nama()
                                            , datalist.get(getAdapterPosition()).get_alamat()
                                            , datalist.get(getAdapterPosition()).get_no_telepon()
                                            , datalist.get(getAdapterPosition()).get_jenis_kelamin()
                                            , datalist.get(getAdapterPosition()).get_username()
                                            , datalist.get(getAdapterPosition()).get_password()
                                            
                                    ) );

                                    List<data_petugas_sqlite_data> data_petugas_sqliteList = dbHandler.get_semua_data_petugas_sqlite();
                                    adapter = new data_petugas_sqlite_adapter( activity, data_petugas_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_petugas_sqlite_activity)activity).fetch_data_petugas_sqlite();
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















