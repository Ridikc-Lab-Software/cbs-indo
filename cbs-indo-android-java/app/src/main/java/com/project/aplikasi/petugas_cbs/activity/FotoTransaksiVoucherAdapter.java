package com.project.aplikasi.petugas_cbs.activity;

import android.content.Context;
import android.net.Uri;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.project.aplikasi.petugas_cbs.R;

import java.util.ArrayList;

public class FotoTransaksiVoucherAdapter extends RecyclerView.Adapter<FotoTransaksiVoucherAdapter.ViewHolder> {

    private Context context;
    private ArrayList<Uri> listFoto;

    public FotoTransaksiVoucherAdapter(Context context, ArrayList<Uri> listFoto) {
        this.context = context;
        this.listFoto = listFoto;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.item_foto_upload, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        Uri uri = listFoto.get(position);

        // Load gambar pakai Glide 3.7.0 (Sesuai dependency kamu)
        Glide.with(context)
                .load(uri)
                .centerCrop()
                .crossFade()
                .into(holder.imgPreview);

        holder.btnHapus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Cek agar tidak crash
                int pos = holder.getAdapterPosition();
                if (pos != RecyclerView.NO_POSITION) {
                    listFoto.remove(pos);
                    notifyItemRemoved(pos);
                    notifyItemRangeChanged(pos, listFoto.size());
                }
            }
        });
    }

    @Override
    public int getItemCount() {
        return listFoto.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        ImageView imgPreview, btnHapus;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            imgPreview = itemView.findViewById(R.id.img_preview);
            btnHapus = itemView.findViewById(R.id.btn_hapus);
        }
    }
}
