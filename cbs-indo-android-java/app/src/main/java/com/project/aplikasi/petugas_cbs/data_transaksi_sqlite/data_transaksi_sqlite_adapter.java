package com.project.aplikasi.petugas_cbs.data_transaksi_sqlite;

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


public class data_transaksi_sqlite_adapter extends RecyclerView.Adapter<data_transaksi_sqlite_adapter.data_transaksi_ViewHolder> {

    Activity activity;
    private List<data_transaksi_sqlite_data> datalist = new ArrayList<>();
    private data_transaksi_sqlite_dbhandler dbHandler;
    private data_transaksi_sqlite_adapter adapter;


    public data_transaksi_sqlite_adapter(Activity activity,List<data_transaksi_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_transaksi_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_transaksi_tampil_v2, parent, false);
        data_transaksi_ViewHolder mahasiswaViewHolder = new data_transaksi_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_transaksi_ViewHolder holder, int position) {
        holder.txt_result_id_transaksi.setText("id_transaksi : " + datalist.get(position).get_id_transaksi());
		holder.txt_result_tanggal.setText(Html.fromHtml( "<b>Tanggal : </b>"+datalist.get(position).get_tanggal()+"") );
		holder.txt_result_jam.setText(Html.fromHtml( "<b>Jam : </b>"+datalist.get(position).get_jam()+"") );
		holder.txt_result_id_member.setText(Html.fromHtml( "<b>Id member : </b>"+datalist.get(position).get_id_member()+"") );
		holder.txt_result_id_petugas.setText(Html.fromHtml( "<b>Id petugas : </b>"+datalist.get(position).get_id_petugas()+"") );
		holder.txt_result_id_kategori_member.setText(Html.fromHtml( "<b>Id kategori member : </b>"+datalist.get(position).get_id_kategori_member()+"") );
		holder.txt_result_id_jenis_transaksi.setText(Html.fromHtml( "<b>Id jenis transaksi : </b>"+datalist.get(position).get_id_jenis_transaksi()+"") );
		holder.txt_result_point.setText(Html.fromHtml( "<b>Point : </b>"+datalist.get(position).get_point()+"") );
		holder.txt_result_jumlah.setText(Html.fromHtml( "<b>Jumlah : </b>"+datalist.get(position).get_jumlah()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_transaksi_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_transaksi;
		TextView txt_result_tanggal;
        TextView txt_result_jam;
        TextView txt_result_id_member;
        TextView txt_result_id_petugas;
        TextView txt_result_id_kategori_member;
        TextView txt_result_id_jenis_transaksi;
        TextView txt_result_point;
        TextView txt_result_jumlah;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_transaksi_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_transaksi_sqlite_dbhandler(activity);
            txt_result_id_transaksi = (TextView) itemView.findViewById(R.id.id_transaksi);
			txt_result_tanggal = (TextView) itemView.findViewById(R.id.tanggal);
            txt_result_jam = (TextView) itemView.findViewById(R.id.jam);
            txt_result_id_member = (TextView) itemView.findViewById(R.id.id_member);
            txt_result_id_petugas = (TextView) itemView.findViewById(R.id.id_petugas);
            txt_result_id_kategori_member = (TextView) itemView.findViewById(R.id.id_kategori_member);
            txt_result_id_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_jenis_transaksi);
            txt_result_point = (TextView) itemView.findViewById(R.id.point);
            txt_result_jumlah = (TextView) itemView.findViewById(R.id.jumlah);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_transaksi", datalist.get(getAdapterPosition()).get_id_transaksi());
                    bundle.putString("tanggal", datalist.get(getAdapterPosition()).get_tanggal());
                    bundle.putString("jam", datalist.get(getAdapterPosition()).get_jam());
                    bundle.putString("id_member", datalist.get(getAdapterPosition()).get_id_member());
                    bundle.putString("id_petugas", datalist.get(getAdapterPosition()).get_id_petugas());
                    bundle.putString("id_kategori_member", datalist.get(getAdapterPosition()).get_id_kategori_member());
                    bundle.putString("id_jenis_transaksi", datalist.get(getAdapterPosition()).get_id_jenis_transaksi());
                    bundle.putString("point", datalist.get(getAdapterPosition()).get_point());
                    bundle.putString("jumlah", datalist.get(getAdapterPosition()).get_jumlah());
                    


                    Intent intent = new Intent(activity, data_transaksi_sqlite_edit.class);
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

                                    dbHandler.hapus_data_transaksi_sqlite( new data_transaksi_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_transaksi()
											, datalist.get(getAdapterPosition()).get_tanggal()
                                            , datalist.get(getAdapterPosition()).get_jam()
                                            , datalist.get(getAdapterPosition()).get_id_member()
                                            , datalist.get(getAdapterPosition()).get_id_petugas()
                                            , datalist.get(getAdapterPosition()).get_id_kategori_member()
                                            , datalist.get(getAdapterPosition()).get_id_jenis_transaksi()
                                            , datalist.get(getAdapterPosition()).get_point()
                                            , datalist.get(getAdapterPosition()).get_jumlah()
                                            
                                    ) );

                                    List<data_transaksi_sqlite_data> data_transaksi_sqliteList = dbHandler.get_semua_data_transaksi_sqlite();
                                    adapter = new data_transaksi_sqlite_adapter( activity, data_transaksi_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_transaksi_sqlite_activity)activity).fetch_data_transaksi_sqlite();
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





















