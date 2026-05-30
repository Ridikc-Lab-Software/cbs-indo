package com.project.aplikasi.petugas_cbs.data_pengaturan_point_sqlite;

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


public class data_pengaturan_point_sqlite_adapter extends RecyclerView.Adapter<data_pengaturan_point_sqlite_adapter.data_pengaturan_point_ViewHolder> {

    Activity activity;
    private List<data_pengaturan_point_sqlite_data> datalist = new ArrayList<>();
    private data_pengaturan_point_sqlite_dbhandler dbHandler;
    private data_pengaturan_point_sqlite_adapter adapter;


    public data_pengaturan_point_sqlite_adapter(Activity activity,List<data_pengaturan_point_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_pengaturan_point_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_pengaturan_point_tampil_v2, parent, false);
        data_pengaturan_point_ViewHolder mahasiswaViewHolder = new data_pengaturan_point_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_pengaturan_point_ViewHolder holder, int position) {
        holder.txt_result_id_pengaturan_point.setText("id_pengaturan_point : " + datalist.get(position).get_id_pengaturan_point());
		holder.txt_result_nama_pengaturan.setText(Html.fromHtml( "<b>Nama pengaturan : </b>"+datalist.get(position).get_nama_pengaturan()+"") );
		holder.txt_result_id_kategori_member.setText(Html.fromHtml( "<b>Id kategori member : </b>"+datalist.get(position).get_id_kategori_member()+"") );
		holder.txt_result_id_jenis_transaksi.setText(Html.fromHtml( "<b>Id jenis transaksi : </b>"+datalist.get(position).get_id_jenis_transaksi()+"") );
		holder.txt_result_point.setText(Html.fromHtml( "<b>Point : </b>"+datalist.get(position).get_point()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_pengaturan_point_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_pengaturan_point;
		TextView txt_result_nama_pengaturan;
        TextView txt_result_id_kategori_member;
        TextView txt_result_id_jenis_transaksi;
        TextView txt_result_point;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_pengaturan_point_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_pengaturan_point_sqlite_dbhandler(activity);
            txt_result_id_pengaturan_point = (TextView) itemView.findViewById(R.id.id_pengaturan_point);
			txt_result_nama_pengaturan = (TextView) itemView.findViewById(R.id.nama_pengaturan);
            txt_result_id_kategori_member = (TextView) itemView.findViewById(R.id.id_kategori_member);
            txt_result_id_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_jenis_transaksi);
            txt_result_point = (TextView) itemView.findViewById(R.id.point);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_pengaturan_point", datalist.get(getAdapterPosition()).get_id_pengaturan_point());
                    bundle.putString("nama_pengaturan", datalist.get(getAdapterPosition()).get_nama_pengaturan());
                    bundle.putString("id_kategori_member", datalist.get(getAdapterPosition()).get_id_kategori_member());
                    bundle.putString("id_jenis_transaksi", datalist.get(getAdapterPosition()).get_id_jenis_transaksi());
                    bundle.putString("point", datalist.get(getAdapterPosition()).get_point());
                    


                    Intent intent = new Intent(activity, data_pengaturan_point_sqlite_edit.class);
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

                                    dbHandler.hapus_data_pengaturan_point_sqlite( new data_pengaturan_point_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_pengaturan_point()
											, datalist.get(getAdapterPosition()).get_nama_pengaturan()
                                            , datalist.get(getAdapterPosition()).get_id_kategori_member()
                                            , datalist.get(getAdapterPosition()).get_id_jenis_transaksi()
                                            , datalist.get(getAdapterPosition()).get_point()
                                            
                                    ) );

                                    List<data_pengaturan_point_sqlite_data> data_pengaturan_point_sqliteList = dbHandler.get_semua_data_pengaturan_point_sqlite();
                                    adapter = new data_pengaturan_point_sqlite_adapter( activity, data_pengaturan_point_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_pengaturan_point_sqlite_activity)activity).fetch_data_pengaturan_point_sqlite();
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















