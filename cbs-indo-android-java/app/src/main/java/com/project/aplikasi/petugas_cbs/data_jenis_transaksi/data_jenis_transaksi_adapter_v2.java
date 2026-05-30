package com.project.aplikasi.petugas_cbs.data_jenis_transaksi;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;
import android.text.Html;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.RecyclerView;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_activity_v2;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_tambah;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.StringTokenizer;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_jenis_transaksi_adapter_v2 extends RecyclerView.Adapter<data_jenis_transaksi_adapter_v2.data_jenis_transaksi_adapter_v2_view_holder> {
    private ArrayList<data_jenis_transaksi_apidata> dataList;
    private Activity activity;
    String id, tambahan_point, harga_perliter, maksimal_transaksi;


    public data_jenis_transaksi_adapter_v2(ArrayList<data_jenis_transaksi_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_jenis_transaksi_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_jenis_transaksi_tampil_v2, parent, false);
        return new data_jenis_transaksi_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_jenis_transaksi_adapter_v2_view_holder holder, int position) {

        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_jenis_transaksi.setText(dataList.get(position).get_id_jenis_transaksi());
        holder.id_jenis_transaksi.setVisibility(View.GONE);


        holder.jenis_transaksi.setText(Html.fromHtml("" + dataList.get(position).get_jenis_transaksi()));
        holder.gambar_logo.setText(Html.fromHtml("<b>Gambar logo : </b>" + dataList.get(position).get_gambar_logo() + ""));
        holder.gambar_logo.setVisibility(View.GONE);

        thumb(holder, BASE_URL + "/admin/upload/" + dataList.get(position).get_gambar_logo(), true);
        edit(holder, "Edit", false);
        hapus(holder, "Hapus", false);
    }

    private void thumb(data_jenis_transaksi_adapter_v2_view_holder holder, String url_gambar, Boolean visible) {
        if (visible == true) {
            holder.image.setVisibility(View.VISIBLE);
            Picasso.get().load(url_gambar).into(holder.image);
        } else {
            holder.image.setVisibility(View.GONE);
        }
    }

    private void edit(data_jenis_transaksi_adapter_v2_view_holder holder, String nama_tombol, Boolean visible) {
        holder.tombol_edit.setText(nama_tombol);
        if (visible == true) {
            holder.linearEdit.setVisibility(View.VISIBLE);
        } else {
            holder.linearEdit.setVisibility(View.GONE);
        }
    }

    private void hapus(data_jenis_transaksi_adapter_v2_view_holder holder, String nama_tombol, Boolean visible) {
        holder.tombol_hapus.setText(nama_tombol);
        if (visible == true) {
            holder.linearHapus.setVisibility(View.VISIBLE);
        } else {
            holder.linearHapus.setVisibility(View.GONE);
        }
    }

    @Override
    public int getItemCount() {
        return (dataList != null) ? dataList.size() : 0;
    }

    public class data_jenis_transaksi_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_jenis_transaksi, jenis_transaksi, gambar_logo, nomor;
        TextView tombol_edit, tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus, linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_jenis_transaksi_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_jenis_transaksi);
            jenis_transaksi = (TextView) itemView.findViewById(R.id.jenis_transaksi);
            gambar_logo = (TextView) itemView.findViewById(R.id.gambar_logo);

            nomor = (TextView) itemView.findViewById(R.id.txt_nomor);
            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            tombol_edit = (TextView) itemView.findViewById(R.id.tombol_edit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);
            tombol_hapus = (TextView) itemView.findViewById(R.id.tombol_hapus);
            linearBaris = (LinearLayout) itemView.findViewById(R.id.linearBaris);
            image = (ImageView) itemView.findViewById(R.id.img);


            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    final MediaPlayer mp = MediaPlayer.create(activity, R.raw.click);
                    mp.start();

                    if (callback == null) {

                        bundle.putString("id_member", data_jenis_transaksi_activity_v2.id_member);
                        bundle.putString("id_kategori_member", data_jenis_transaksi_activity_v2.id_kategori_member);
                        bundle.putString("nama", data_jenis_transaksi_activity_v2.nama);
                        bundle.putString("point", data_jenis_transaksi_activity_v2.point);

                        String s = dataList.get(getAdapterPosition()).get_id_jenis_transaksi();
                        StringTokenizer st = new StringTokenizer(s, "|");
                        id = st.nextToken();
                        tambahan_point = st.nextToken();
                        harga_perliter = st.nextToken();
                        maksimal_transaksi = st.nextToken();
                        bundle.putString("id_jenis_transaksi", id);
                        bundle.putString("tambahan_point", tambahan_point);
                        bundle.putString("harga_perliter", harga_perliter);
                        bundle.putString("maksimal_transaksi", maksimal_transaksi);
                        bundle.putString("jenis_transaksi", dataList.get(getAdapterPosition()).get_jenis_transaksi());

                        bundle.putString("gambar_logo", dataList.get(getAdapterPosition()).get_gambar_logo());

                        Intent intent = new Intent(activity, data_transaksi_tambah.class);
                        intent.putExtras(bundle);
                        activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                        activity.finish();
                    } else {
                        callback.click(dataList.get(getAdapterPosition()));
                    }
                }
            });
        }


    }

    private DariCallback callback;

    public void setDariCallback(DariCallback callback) {
        this.callback = callback;
    }

    public interface DariCallback {
        void click(data_jenis_transaksi_apidata item);
    }

    public void updateResults(ArrayList<data_jenis_transaksi_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}







