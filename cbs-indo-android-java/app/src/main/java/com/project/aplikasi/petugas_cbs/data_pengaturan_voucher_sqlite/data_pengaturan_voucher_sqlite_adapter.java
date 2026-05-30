package com.project.aplikasi.petugas_cbs.data_pengaturan_voucher_sqlite;

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


public class data_pengaturan_voucher_sqlite_adapter extends RecyclerView.Adapter<data_pengaturan_voucher_sqlite_adapter.data_pengaturan_voucher_ViewHolder> {

    Activity activity;
    private List<data_pengaturan_voucher_sqlite_data> datalist = new ArrayList<>();
    private data_pengaturan_voucher_sqlite_dbhandler dbHandler;
    private data_pengaturan_voucher_sqlite_adapter adapter;


    public data_pengaturan_voucher_sqlite_adapter(Activity activity,List<data_pengaturan_voucher_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_pengaturan_voucher_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_pengaturan_voucher_tampil_v2, parent, false);
        data_pengaturan_voucher_ViewHolder mahasiswaViewHolder = new data_pengaturan_voucher_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_pengaturan_voucher_ViewHolder holder, int position) {
        holder.txt_result_id_pengaturan_voucher.setText("id_pengaturan_voucher : " + datalist.get(position).get_id_pengaturan_voucher());
       holder.txt_result_nama.setText("Nama  : " + Html.fromHtml(datalist.get(position).get_nama()+ "" ));
       holder.txt_result_isi.setText("Isi  : " + Html.fromHtml(datalist.get(position).get_isi()+ "" ));
       holder.txt_result_status.setText("Status  : " + Html.fromHtml(datalist.get(position).get_status()+ "" ));

    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_pengaturan_voucher_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_pengaturan_voucher;
       TextView txt_result_nama;
       TextView txt_result_isi;
       TextView txt_result_status;

        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_pengaturan_voucher_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_pengaturan_voucher_sqlite_dbhandler(activity);
            txt_result_id_pengaturan_voucher = (TextView) itemView.findViewById(R.id.id_pengaturan_voucher);
           txt_result_nama = (TextView) itemView.findViewById(R.id.nama);
           txt_result_isi = (TextView) itemView.findViewById(R.id.isi);
           txt_result_status = (TextView) itemView.findViewById(R.id.status);


            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_pengaturan_voucher", datalist.get(getAdapterPosition()).get_id_pengaturan_voucher());
                   bundle.putString("nama", datalist.get(getAdapterPosition()).get_nama());
                   bundle.putString("isi", datalist.get(getAdapterPosition()).get_isi());
                   bundle.putString("status", datalist.get(getAdapterPosition()).get_status());



                    Intent intent = new Intent(activity, data_pengaturan_voucher_sqlite_edit.class);
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

                                    dbHandler.hapus_data_pengaturan_voucher_sqlite( new data_pengaturan_voucher_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_pengaturan_voucher()
                                           ,datalist.get(getAdapterPosition()).get_nama()
                                           ,datalist.get(getAdapterPosition()).get_isi()
                                           ,datalist.get(getAdapterPosition()).get_status()

                                    ) );

                                    List<data_pengaturan_voucher_sqlite_data> data_pengaturan_voucher_sqliteList = dbHandler.get_semua_data_pengaturan_voucher_sqlite();
                                    adapter = new data_pengaturan_voucher_sqlite_adapter( activity, data_pengaturan_voucher_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_pengaturan_voucher_sqlite_activity)activity).fetch_data_pengaturan_voucher_sqlite();
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







