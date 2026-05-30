package com.project.aplikasi.petugas_cbs.data_transaksi_voucher_sqlite;

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


public class data_transaksi_voucher_sqlite_adapter extends RecyclerView.Adapter<data_transaksi_voucher_sqlite_adapter.data_transaksi_voucher_ViewHolder> {

    Activity activity;
    private List<data_transaksi_voucher_sqlite_data> datalist = new ArrayList<>();
    private data_transaksi_voucher_sqlite_dbhandler dbHandler;
    private data_transaksi_voucher_sqlite_adapter adapter;


    public data_transaksi_voucher_sqlite_adapter(Activity activity,List<data_transaksi_voucher_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_transaksi_voucher_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_transaksi_voucher_tampil_v2, parent, false);
        data_transaksi_voucher_ViewHolder mahasiswaViewHolder = new data_transaksi_voucher_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_transaksi_voucher_ViewHolder holder, int position) {
        holder.txt_result_id_transaksi_voucher.setText("id_transaksi_voucher : " + datalist.get(position).get_id_transaksi_voucher());
       holder.txt_result_id_voucher.setText("Id Voucher  : " + Html.fromHtml(datalist.get(position).get_id_voucher()+ "" ));
       holder.txt_result_id_member.setText("Id Member  : " + Html.fromHtml(datalist.get(position).get_id_member()+ "" ));
       holder.txt_result_nama_member.setText("Nama Member  : " + Html.fromHtml(datalist.get(position).get_nama_member()+ "" ));
       holder.txt_result_tanggal_transaksi.setText("Tanggal Transaksi  : " + Html.fromHtml(datalist.get(position).get_tanggal_transaksi()+ "" ));
       holder.txt_result_jenis_bbm.setText("Jenis Bbm  : " + Html.fromHtml(datalist.get(position).get_jenis_bbm()+ "" ));
       holder.txt_result_nominal.setText("Nominal  : " + Html.fromHtml(datalist.get(position).get_nominal()+ "" ));

    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_transaksi_voucher_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_transaksi_voucher;
       TextView txt_result_id_voucher;
       TextView txt_result_id_member;
       TextView txt_result_nama_member;
       TextView txt_result_tanggal_transaksi;
       TextView txt_result_jenis_bbm;
       TextView txt_result_nominal;

        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_transaksi_voucher_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_transaksi_voucher_sqlite_dbhandler(activity);
            txt_result_id_transaksi_voucher = (TextView) itemView.findViewById(R.id.id_transaksi_voucher);
           txt_result_id_voucher = (TextView) itemView.findViewById(R.id.id_voucher);
           txt_result_id_member = (TextView) itemView.findViewById(R.id.id_member);
           txt_result_nama_member = (TextView) itemView.findViewById(R.id.nama_member);
           txt_result_tanggal_transaksi = (TextView) itemView.findViewById(R.id.tanggal_transaksi);
           txt_result_jenis_bbm = (TextView) itemView.findViewById(R.id.jenis_bbm);
           txt_result_nominal = (TextView) itemView.findViewById(R.id.nominal);


            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_transaksi_voucher", datalist.get(getAdapterPosition()).get_id_transaksi_voucher());
                   bundle.putString("id_voucher", datalist.get(getAdapterPosition()).get_id_voucher());
                   bundle.putString("id_member", datalist.get(getAdapterPosition()).get_id_member());
                   bundle.putString("nama_member", datalist.get(getAdapterPosition()).get_nama_member());
                   bundle.putString("tanggal_transaksi", datalist.get(getAdapterPosition()).get_tanggal_transaksi());
                   bundle.putString("jenis_bbm", datalist.get(getAdapterPosition()).get_jenis_bbm());
                   bundle.putString("nominal", datalist.get(getAdapterPosition()).get_nominal());



                    Intent intent = new Intent(activity, data_transaksi_voucher_sqlite_edit.class);
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

                                    dbHandler.hapus_data_transaksi_voucher_sqlite( new data_transaksi_voucher_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_transaksi_voucher()
                                           ,datalist.get(getAdapterPosition()).get_id_voucher()
                                           ,datalist.get(getAdapterPosition()).get_id_member()
                                           ,datalist.get(getAdapterPosition()).get_nama_member()
                                           ,datalist.get(getAdapterPosition()).get_tanggal_transaksi()
                                           ,datalist.get(getAdapterPosition()).get_jenis_bbm()
                                           ,datalist.get(getAdapterPosition()).get_nominal()

                                    ) );

                                    List<data_transaksi_voucher_sqlite_data> data_transaksi_voucher_sqliteList = dbHandler.get_semua_data_transaksi_voucher_sqlite();
                                    adapter = new data_transaksi_voucher_sqlite_adapter( activity, data_transaksi_voucher_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_transaksi_voucher_sqlite_activity)activity).fetch_data_transaksi_voucher_sqlite();
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







