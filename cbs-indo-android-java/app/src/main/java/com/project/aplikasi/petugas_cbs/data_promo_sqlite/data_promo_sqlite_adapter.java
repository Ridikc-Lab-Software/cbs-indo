package com.project.aplikasi.petugas_cbs.data_promo_sqlite;

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


public class data_promo_sqlite_adapter extends RecyclerView.Adapter<data_promo_sqlite_adapter.data_promo_ViewHolder> {

    Activity activity;
    private List<data_promo_sqlite_data> datalist = new ArrayList<>();
    private data_promo_sqlite_dbhandler dbHandler;
    private data_promo_sqlite_adapter adapter;


    public data_promo_sqlite_adapter(Activity activity,List<data_promo_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_promo_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_promo_tampil_v2, parent, false);
        data_promo_ViewHolder mahasiswaViewHolder = new data_promo_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_promo_ViewHolder holder, int position) {
        holder.txt_result_id_promo.setText("id_promo : " + datalist.get(position).get_id_promo());
		holder.txt_result_tanggal_mulai_berlaku.setText(Html.fromHtml( "<b>Tanggal mulai berlaku : </b>"+datalist.get(position).get_tanggal_mulai_berlaku()+"") );
		holder.txt_result_tanggal_batas_berlaku.setText(Html.fromHtml( "<b>Tanggal batas berlaku : </b>"+datalist.get(position).get_tanggal_batas_berlaku()+"") );
		holder.txt_result_nama_promo.setText(Html.fromHtml( "<b>Nama promo : </b>"+datalist.get(position).get_nama_promo()+"") );
		holder.txt_result_keterangan.setText(Html.fromHtml( "<b>Keterangan : </b>"+datalist.get(position).get_keterangan()+"") );
		holder.txt_result_syarat_dan_ketentuan.setText(Html.fromHtml( "<b>Syarat dan ketentuan : </b>"+datalist.get(position).get_syarat_dan_ketentuan()+"") );
		holder.txt_result_foto_promo.setText(Html.fromHtml( "<b>Foto promo : </b>"+datalist.get(position).get_foto_promo()+"") );
		holder.txt_result_jumlah_point.setText(Html.fromHtml( "<b>Jumlah point : </b>"+datalist.get(position).get_jumlah_point()+"") );
		holder.txt_result_status.setText(Html.fromHtml( "<b>Status : </b>"+datalist.get(position).get_status()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_promo_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_promo;
		TextView txt_result_tanggal_mulai_berlaku;
        TextView txt_result_tanggal_batas_berlaku;
        TextView txt_result_nama_promo;
        TextView txt_result_keterangan;
        TextView txt_result_syarat_dan_ketentuan;
        TextView txt_result_foto_promo;
        TextView txt_result_jumlah_point;
        TextView txt_result_status;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_promo_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_promo_sqlite_dbhandler(activity);
            txt_result_id_promo = (TextView) itemView.findViewById(R.id.id_promo);
			txt_result_tanggal_mulai_berlaku = (TextView) itemView.findViewById(R.id.tanggal_mulai_berlaku);
            txt_result_tanggal_batas_berlaku = (TextView) itemView.findViewById(R.id.tanggal_batas_berlaku);
            txt_result_nama_promo = (TextView) itemView.findViewById(R.id.nama_promo);
            txt_result_keterangan = (TextView) itemView.findViewById(R.id.keterangan);
            txt_result_syarat_dan_ketentuan = (TextView) itemView.findViewById(R.id.syarat_dan_ketentuan);
            txt_result_foto_promo = (TextView) itemView.findViewById(R.id.foto_promo);
            txt_result_jumlah_point = (TextView) itemView.findViewById(R.id.jumlah_point);
            txt_result_status = (TextView) itemView.findViewById(R.id.status);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_promo", datalist.get(getAdapterPosition()).get_id_promo());
                    bundle.putString("tanggal_mulai_berlaku", datalist.get(getAdapterPosition()).get_tanggal_mulai_berlaku());
                    bundle.putString("tanggal_batas_berlaku", datalist.get(getAdapterPosition()).get_tanggal_batas_berlaku());
                    bundle.putString("nama_promo", datalist.get(getAdapterPosition()).get_nama_promo());
                    bundle.putString("keterangan", datalist.get(getAdapterPosition()).get_keterangan());
                    bundle.putString("syarat_dan_ketentuan", datalist.get(getAdapterPosition()).get_syarat_dan_ketentuan());
                    bundle.putString("foto_promo", datalist.get(getAdapterPosition()).get_foto_promo());
                    bundle.putString("jumlah_point", datalist.get(getAdapterPosition()).get_jumlah_point());
                    bundle.putString("status", datalist.get(getAdapterPosition()).get_status());
                    


                    Intent intent = new Intent(activity, data_promo_sqlite_edit.class);
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

                                    dbHandler.hapus_data_promo_sqlite( new data_promo_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_promo()
											, datalist.get(getAdapterPosition()).get_tanggal_mulai_berlaku()
                                            , datalist.get(getAdapterPosition()).get_tanggal_batas_berlaku()
                                            , datalist.get(getAdapterPosition()).get_nama_promo()
                                            , datalist.get(getAdapterPosition()).get_keterangan()
                                            , datalist.get(getAdapterPosition()).get_syarat_dan_ketentuan()
                                            , datalist.get(getAdapterPosition()).get_foto_promo()
                                            , datalist.get(getAdapterPosition()).get_jumlah_point()
                                            , datalist.get(getAdapterPosition()).get_status()
                                            
                                    ) );

                                    List<data_promo_sqlite_data> data_promo_sqliteList = dbHandler.get_semua_data_promo_sqlite();
                                    adapter = new data_promo_sqlite_adapter( activity, data_promo_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_promo_sqlite_activity)activity).fetch_data_promo_sqlite();
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















