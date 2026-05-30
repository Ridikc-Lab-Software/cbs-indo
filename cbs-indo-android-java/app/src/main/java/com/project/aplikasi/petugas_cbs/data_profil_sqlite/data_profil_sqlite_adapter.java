package com.project.aplikasi.petugas_cbs.data_profil_sqlite;

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


public class data_profil_sqlite_adapter extends RecyclerView.Adapter<data_profil_sqlite_adapter.data_profil_ViewHolder> {

    Activity activity;
    private List<data_profil_sqlite_data> datalist = new ArrayList<>();
    private data_profil_sqlite_dbhandler dbHandler;
    private data_profil_sqlite_adapter adapter;


    public data_profil_sqlite_adapter(Activity activity,List<data_profil_sqlite_data> datalist) {
        this.activity = activity;
        this.datalist = datalist;
    }

    @Override
    public data_profil_ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.data_profil_tampil_v2, parent, false);
        data_profil_ViewHolder mahasiswaViewHolder = new data_profil_ViewHolder(view);
        return mahasiswaViewHolder;
    }

    @Override
    public void onBindViewHolder(data_profil_ViewHolder holder, int position) {
        holder.txt_result_id_profil.setText("id_profil : " + datalist.get(position).get_id_profil());
		holder.txt_result_nama.setText(Html.fromHtml( "<b>Nama : </b>"+datalist.get(position).get_nama()+"") );
		holder.txt_result_alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+datalist.get(position).get_alamat()+"") );
		holder.txt_result_no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+datalist.get(position).get_no_telepon()+"") );
		holder.txt_result_sejarah.setText(Html.fromHtml( "<b>Sejarah : </b>"+datalist.get(position).get_sejarah()+"") );
		holder.txt_result_visi.setText(Html.fromHtml( "<b>Visi : </b>"+datalist.get(position).get_visi()+"") );
		holder.txt_result_misi.setText(Html.fromHtml( "<b>Misi : </b>"+datalist.get(position).get_misi()+"") );
		holder.txt_result_deskripsi.setText(Html.fromHtml( "<b>Deskripsi : </b>"+datalist.get(position).get_deskripsi()+"") );
		holder.txt_result_foto.setText(Html.fromHtml( "<b>Foto : </b>"+datalist.get(position).get_foto()+"") );
		
    }

    @Override
    public int getItemCount() {
        return datalist.size();
    }

    public class data_profil_ViewHolder extends RecyclerView.ViewHolder {
        TextView txt_result_id_profil;
		TextView txt_result_nama;
        TextView txt_result_alamat;
        TextView txt_result_no_telepon;
        TextView txt_result_sejarah;
        TextView txt_result_visi;
        TextView txt_result_misi;
        TextView txt_result_deskripsi;
        TextView txt_result_foto;
        
        LinearLayout linearEdit, linearHapus;
        protected int REQUEST_CODE_TAMBAH = 3543;
        public data_profil_ViewHolder(final View itemView) {
            super(itemView);
            dbHandler = new data_profil_sqlite_dbhandler(activity);
            txt_result_id_profil = (TextView) itemView.findViewById(R.id.id_profil);
			txt_result_nama = (TextView) itemView.findViewById(R.id.nama);
            txt_result_alamat = (TextView) itemView.findViewById(R.id.alamat);
            txt_result_no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            txt_result_sejarah = (TextView) itemView.findViewById(R.id.sejarah);
            txt_result_visi = (TextView) itemView.findViewById(R.id.visi);
            txt_result_misi = (TextView) itemView.findViewById(R.id.misi);
            txt_result_deskripsi = (TextView) itemView.findViewById(R.id.deskripsi);
            txt_result_foto = (TextView) itemView.findViewById(R.id.foto);
            

            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Bundle bundle = new Bundle();
                    bundle.putString("id_profil", datalist.get(getAdapterPosition()).get_id_profil());
                    bundle.putString("nama", datalist.get(getAdapterPosition()).get_nama());
                    bundle.putString("alamat", datalist.get(getAdapterPosition()).get_alamat());
                    bundle.putString("no_telepon", datalist.get(getAdapterPosition()).get_no_telepon());
                    bundle.putString("sejarah", datalist.get(getAdapterPosition()).get_sejarah());
                    bundle.putString("visi", datalist.get(getAdapterPosition()).get_visi());
                    bundle.putString("misi", datalist.get(getAdapterPosition()).get_misi());
                    bundle.putString("deskripsi", datalist.get(getAdapterPosition()).get_deskripsi());
                    bundle.putString("foto", datalist.get(getAdapterPosition()).get_foto());
                    


                    Intent intent = new Intent(activity, data_profil_sqlite_edit.class);
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

                                    dbHandler.hapus_data_profil_sqlite( new data_profil_sqlite_data(
                                            datalist.get(getAdapterPosition()).get_id_profil()
											, datalist.get(getAdapterPosition()).get_nama()
                                            , datalist.get(getAdapterPosition()).get_alamat()
                                            , datalist.get(getAdapterPosition()).get_no_telepon()
                                            , datalist.get(getAdapterPosition()).get_sejarah()
                                            , datalist.get(getAdapterPosition()).get_visi()
                                            , datalist.get(getAdapterPosition()).get_misi()
                                            , datalist.get(getAdapterPosition()).get_deskripsi()
                                            , datalist.get(getAdapterPosition()).get_foto()
                                            
                                    ) );

                                    List<data_profil_sqlite_data> data_profil_sqliteList = dbHandler.get_semua_data_profil_sqlite();
                                    adapter = new data_profil_sqlite_adapter( activity, data_profil_sqliteList );
                                    adapter.notifyDataSetChanged();
                                    Toast.makeText( activity, "Berhasil Terhapus", Toast.LENGTH_SHORT ).show();
                                    ((data_profil_sqlite_activity)activity).fetch_data_profil_sqlite();
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















