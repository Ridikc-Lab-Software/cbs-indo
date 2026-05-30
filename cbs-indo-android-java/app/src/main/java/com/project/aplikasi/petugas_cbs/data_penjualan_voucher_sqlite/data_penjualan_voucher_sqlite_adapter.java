package com.project.aplikasi.petugas_cbs.data_penjualan_voucher_sqlite;

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


public class data_penjualan_voucher_sqlite_adapter extends RecyclerView.Adapter<data_penjualan_voucher_sqlite_adapter.data_penjualan_voucher_ViewHolder> {

    Activity activity;
    private List<data_penjualan_voucher_sqlite_data> datalist = new ArrayList<>();
    private data_penjualan_voucher_sqlite_dbhandler dbHandler;
    private data_penjualan_voucher_sqlite_adapter adapter;


    public data_penjualan_voucher_sqlite_adapter(Activity activity,List<data_penjualan_voucher_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_penjualan_voucher_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_penjualan_voucher_tampil_v2, parent, false);
        data_penjualan_voucher_ViewHolder mahasiswaViewHolder = new data_penjualan_voucher_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_penjualan_voucher_ViewHolder holder, int position) {
        holder.txt_result_id_penjualan_voucher.setText("id_penjualan_voucher : " + datalist.get(position).get_id_penjualan_voucher());
       holder.txt_result_tanggal_penjualan.setText("Tanggal Penjualan  : " + Html.fromHtml(datalist.get(position).get_tanggal_penjualan()+ "" ));
       holder.txt_result_id_relasi.setText("Id Relasi  : " + Html.fromHtml(datalist.get(position).get_id_relasi()+ "" ));
       holder.txt_result_jumlah_voucher.setText("Jumlah Voucher  : " + Html.fromHtml(datalist.get(position).get_jumlah_voucher()+ "" ));
       holder.txt_result_nominal.setText("Nominal  : " + Html.fromHtml(datalist.get(position).get_nominal()+ "" ));
       holder.txt_result_password_voucher.setText("Password Voucher  : " + Html.fromHtml(datalist.get(position).get_password_voucher()+ "" ));
       holder.txt_result_tanggal_dibuka.setText("Tanggal Dibuka  : " + Html.fromHtml(datalist.get(position).get_tanggal_dibuka()+ "" ));

    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_penjualan_voucher_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_penjualan_voucher;
       TextView txt_result_tanggal_penjualan;
       TextView txt_result_id_relasi;
       TextView txt_result_jumlah_voucher;
       TextView txt_result_nominal;
       TextView txt_result_password_voucher;
       TextView txt_result_tanggal_dibuka;

        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_penjualan_voucher_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_penjualan_voucher_sqlite_dbhandler(activity);
            txt_result_id_penjualan_voucher = (TextView) itemView.findViewById(R.id.id_penjualan_voucher);
           txt_result_tanggal_penjualan = (TextView) itemView.findViewById(R.id.tanggal_penjualan);
           txt_result_id_relasi = (TextView) itemView.findViewById(R.id.id_relasi);
           txt_result_jumlah_voucher = (TextView) itemView.findViewById(R.id.jumlah_voucher);
           txt_result_nominal = (TextView) itemView.findViewById(R.id.nominal);
           txt_result_password_voucher = (TextView) itemView.findViewById(R.id.password_voucher);
           txt_result_tanggal_dibuka = (TextView) itemView.findViewById(R.id.tanggal_dibuka);


            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_penjualan_voucher", datalist.get(getAdapterPosition()).get_id_penjualan_voucher());
                   bundle.putString("tanggal_penjualan", datalist.get(getAdapterPosition()).get_tanggal_penjualan());
                   bundle.putString("id_relasi", datalist.get(getAdapterPosition()).get_id_relasi());
                   bundle.putString("jumlah_voucher", datalist.get(getAdapterPosition()).get_jumlah_voucher());
                   bundle.putString("nominal", datalist.get(getAdapterPosition()).get_nominal());
                   bundle.putString("password_voucher", datalist.get(getAdapterPosition()).get_password_voucher());
                   bundle.putString("tanggal_dibuka", datalist.get(getAdapterPosition()).get_tanggal_dibuka());



                    Intent intent = new Intent(activity, data_penjualan_voucher_sqlite_edit.class);
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

                                    dbHandler.hapus_data_penjualan_voucher_sqlite( new data_penjualan_voucher_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_penjualan_voucher()
                                           ,datalist.get(getAdapterPosition()).get_tanggal_penjualan()
                                           ,datalist.get(getAdapterPosition()).get_id_relasi()
                                           ,datalist.get(getAdapterPosition()).get_jumlah_voucher()
                                           ,datalist.get(getAdapterPosition()).get_nominal()
                                           ,datalist.get(getAdapterPosition()).get_password_voucher()
                                           ,datalist.get(getAdapterPosition()).get_tanggal_dibuka()

                                    ) );

                                    List<data_penjualan_voucher_sqlite_data> data_penjualan_voucher_sqliteList = dbHandler.get_semua_data_penjualan_voucher_sqlite();
                                    adapter = new data_penjualan_voucher_sqlite_adapter( activity, data_penjualan_voucher_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_penjualan_voucher_sqlite_activity)activity).fetch_data_penjualan_voucher_sqlite();
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







