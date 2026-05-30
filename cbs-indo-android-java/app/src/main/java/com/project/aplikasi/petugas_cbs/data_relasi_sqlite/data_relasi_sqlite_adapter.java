package com.project.aplikasi.petugas_cbs.data_relasi_sqlite;

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


public class data_relasi_sqlite_adapter extends RecyclerView.Adapter<data_relasi_sqlite_adapter.data_relasi_ViewHolder> {

    Activity activity;
    private List<data_relasi_sqlite_data> datalist = new ArrayList<>();
    private data_relasi_sqlite_dbhandler dbHandler;
    private data_relasi_sqlite_adapter adapter;


    public data_relasi_sqlite_adapter(Activity activity,List<data_relasi_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_relasi_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_relasi_tampil_v2, parent, false);
        data_relasi_ViewHolder mahasiswaViewHolder = new data_relasi_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_relasi_ViewHolder holder, int position) {
        holder.txt_result_id_relasi.setText("id_relasi : " + datalist.get(position).get_id_relasi());
       holder.txt_result_nama.setText("Nama  : " + Html.fromHtml(datalist.get(position).get_nama()+ "" ));
       holder.txt_result_nomor_telepon.setText("Nomor Telepon  : " + Html.fromHtml(datalist.get(position).get_nomor_telepon()+ "" ));
       holder.txt_result_email.setText("Email  : " + Html.fromHtml(datalist.get(position).get_email()+ "" ));
       holder.txt_result_alamat.setText("Alamat  : " + Html.fromHtml(datalist.get(position).get_alamat()+ "" ));
       holder.txt_result_id_spbu.setText("Id Spbu  : " + Html.fromHtml(datalist.get(position).get_id_spbu()+ "" ));
       holder.txt_result_nama_spbu.setText("Nama Spbu  : " + Html.fromHtml(datalist.get(position).get_nama_spbu()+ "" ));
       holder.txt_result_password.setText("Password  : " + Html.fromHtml(datalist.get(position).get_password()+ "" ));

    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_relasi_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_relasi;
       TextView txt_result_nama;
       TextView txt_result_nomor_telepon;
       TextView txt_result_email;
       TextView txt_result_alamat;
       TextView txt_result_id_spbu;
       TextView txt_result_nama_spbu;
       TextView txt_result_password;

        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_relasi_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_relasi_sqlite_dbhandler(activity);
            txt_result_id_relasi = (TextView) itemView.findViewById(R.id.id_relasi);
           txt_result_nama = (TextView) itemView.findViewById(R.id.nama);
           txt_result_nomor_telepon = (TextView) itemView.findViewById(R.id.nomor_telepon);
           txt_result_email = (TextView) itemView.findViewById(R.id.email);
           txt_result_alamat = (TextView) itemView.findViewById(R.id.alamat);
           txt_result_id_spbu = (TextView) itemView.findViewById(R.id.id_spbu);
           txt_result_nama_spbu = (TextView) itemView.findViewById(R.id.nama_spbu);
           txt_result_password = (TextView) itemView.findViewById(R.id.password);


            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_relasi", datalist.get(getAdapterPosition()).get_id_relasi());
                   bundle.putString("nama", datalist.get(getAdapterPosition()).get_nama());
                   bundle.putString("nomor_telepon", datalist.get(getAdapterPosition()).get_nomor_telepon());
                   bundle.putString("email", datalist.get(getAdapterPosition()).get_email());
                   bundle.putString("alamat", datalist.get(getAdapterPosition()).get_alamat());
                   bundle.putString("id_spbu", datalist.get(getAdapterPosition()).get_id_spbu());
                   bundle.putString("nama_spbu", datalist.get(getAdapterPosition()).get_nama_spbu());
                   bundle.putString("password", datalist.get(getAdapterPosition()).get_password());



                    Intent intent = new Intent(activity, data_relasi_sqlite_edit.class);
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

                                    dbHandler.hapus_data_relasi_sqlite( new data_relasi_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_relasi()
                                           ,datalist.get(getAdapterPosition()).get_nama()
                                           ,datalist.get(getAdapterPosition()).get_nomor_telepon()
                                           ,datalist.get(getAdapterPosition()).get_email()
                                           ,datalist.get(getAdapterPosition()).get_alamat()
                                           ,datalist.get(getAdapterPosition()).get_id_spbu()
                                           ,datalist.get(getAdapterPosition()).get_nama_spbu()
                                           ,datalist.get(getAdapterPosition()).get_password()

                                    ) );

                                    List<data_relasi_sqlite_data> data_relasi_sqliteList = dbHandler.get_semua_data_relasi_sqlite();
                                    adapter = new data_relasi_sqlite_adapter( activity, data_relasi_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_relasi_sqlite_activity)activity).fetch_data_relasi_sqlite();
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







