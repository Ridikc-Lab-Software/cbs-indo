package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi_sqlite;

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


public class data_group_jenis_transaksi_sqlite_adapter extends RecyclerView.Adapter<data_group_jenis_transaksi_sqlite_adapter.data_group_jenis_transaksi_ViewHolder> {

    Activity activity;
    private List<data_group_jenis_transaksi_sqlite_data> datalist = new ArrayList<>();
    private data_group_jenis_transaksi_sqlite_dbhandler dbHandler;
    private data_group_jenis_transaksi_sqlite_adapter adapter;


    public data_group_jenis_transaksi_sqlite_adapter(Activity activity,List<data_group_jenis_transaksi_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_group_jenis_transaksi_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_group_jenis_transaksi_tampil_v2, parent, false);
        data_group_jenis_transaksi_ViewHolder mahasiswaViewHolder = new data_group_jenis_transaksi_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_group_jenis_transaksi_ViewHolder holder, int position) {
        holder.txt_result_id_group_jenis_transaksi.setText("id_group_jenis_transaksi : " + datalist.get(position).get_id_group_jenis_transaksi());
		holder.txt_result_nama_group.setText(Html.fromHtml( "<b>Nama group : </b>"+datalist.get(position).get_nama_group()+"") );
		holder.txt_result_id_jenis_transaksi.setText(Html.fromHtml( "<b>Id jenis transaksi : </b>"+datalist.get(position).get_id_jenis_transaksi()+"") );
		holder.txt_result_gambar_logo.setText(Html.fromHtml( "<b>Gambar logo : </b>"+datalist.get(position).get_gambar_logo()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_group_jenis_transaksi_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_group_jenis_transaksi;
		TextView txt_result_nama_group;
        TextView txt_result_id_jenis_transaksi;
        TextView txt_result_gambar_logo;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_group_jenis_transaksi_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_group_jenis_transaksi_sqlite_dbhandler(activity);
            txt_result_id_group_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_group_jenis_transaksi);
			txt_result_nama_group = (TextView) itemView.findViewById(R.id.nama_group);
            txt_result_id_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_jenis_transaksi);
            txt_result_gambar_logo = (TextView) itemView.findViewById(R.id.gambar_logo);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_group_jenis_transaksi", datalist.get(getAdapterPosition()).get_id_group_jenis_transaksi());
                    bundle.putString("nama_group", datalist.get(getAdapterPosition()).get_nama_group());
                    bundle.putString("id_jenis_transaksi", datalist.get(getAdapterPosition()).get_id_jenis_transaksi());
                    bundle.putString("gambar_logo", datalist.get(getAdapterPosition()).get_gambar_logo());
                    


                    Intent intent = new Intent(activity, data_group_jenis_transaksi_sqlite_edit.class);
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

                                    dbHandler.hapus_data_group_jenis_transaksi_sqlite( new data_group_jenis_transaksi_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_group_jenis_transaksi()
											, datalist.get(getAdapterPosition()).get_nama_group()
                                            , datalist.get(getAdapterPosition()).get_id_jenis_transaksi()
                                            , datalist.get(getAdapterPosition()).get_gambar_logo()
                                            
                                    ) );

                                    List<data_group_jenis_transaksi_sqlite_data> data_group_jenis_transaksi_sqliteList = dbHandler.get_semua_data_group_jenis_transaksi_sqlite();
                                    adapter = new data_group_jenis_transaksi_sqlite_adapter( activity, data_group_jenis_transaksi_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_group_jenis_transaksi_sqlite_activity)activity).fetch_data_group_jenis_transaksi_sqlite();
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















