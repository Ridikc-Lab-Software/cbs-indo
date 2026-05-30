package com.project.aplikasi.petugas_cbs.data_promo;

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
import com.project.aplikasi.petugas_cbs.data_redeem.data_redeem_tambah;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_tambah;
import com.squareup.picasso.Picasso;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_promo_adapter_v2 extends RecyclerView.Adapter<data_promo_adapter_v2.data_promo_adapter_v2_view_holder> {
    private ArrayList<data_promo_apidata> dataList;
    private Activity activity;

    public data_promo_adapter_v2(ArrayList<data_promo_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_promo_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_promo_tampil_v2, parent, false);
        return new data_promo_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_promo_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_promo.setText("id_promo "+dataList.get(position).get_id_promo());
		holder.id_promo.setVisibility( View.GONE );
		holder.tanggal_mulai_berlaku.setText(Html.fromHtml( "<b>Tanggal mulai berlaku : </b>"+dataList.get(position).get_tanggal_mulai_berlaku()+"") );
        holder.tanggal_mulai_berlaku.setVisibility( View.GONE );
		holder.tanggal_batas_berlaku.setText(Html.fromHtml( "<b>Tanggal batas berlaku : </b>"+dataList.get(position).get_tanggal_batas_berlaku()+"") );
		holder.nama_promo.setText(Html.fromHtml( "<b>Nama promo : </b>"+dataList.get(position).get_nama_promo()+"") );
		holder.keterangan.setText(Html.fromHtml( "<b>Keterangan : </b>"+dataList.get(position).get_keterangan()+"") );
        holder.keterangan.setVisibility( View.GONE );
		holder.syarat_dan_ketentuan.setText(Html.fromHtml( "<b>Syarat dan ketentuan : </b>"+dataList.get(position).get_syarat_dan_ketentuan()+"") );
        holder.syarat_dan_ketentuan.setVisibility( View.GONE );
		holder.foto_promo.setText(Html.fromHtml( "<b>Foto promo : </b>"+dataList.get(position).get_foto_promo()+"") );
        holder.foto_promo.setVisibility( View.GONE );
		holder.jumlah_point.setText(Html.fromHtml( "<b>Jumlah point : </b>"+dataList.get(position).get_jumlah_point()+"") );

		holder.status.setText(Html.fromHtml( dataList.get(position).get_status()) );


        thumb(holder,BASE_URL +"/admin/upload/" + dataList.get(position).get_foto_promo() ,true);
        edit(holder,"Edit",false);
        hapus(holder,"Hapus",false);
    }

     private void thumb(data_promo_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
    {
        if (visible==true) {
            holder.image.setVisibility( View.VISIBLE );
            Picasso.get().load( url_gambar ).into( holder.image );
        }
        else
        {
            holder.image.setVisibility( View.GONE );
        }
    }

    private void edit(data_promo_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
    {
        holder.tombol_edit.setText(nama_tombol);
        if (visible==true) {
            holder.linearEdit.setVisibility( View.VISIBLE );
        }
        else
        {
            holder.linearEdit.setVisibility( View.GONE );
        }
    }

    private void hapus(data_promo_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
    {
        holder.tombol_hapus.setText(nama_tombol);
        if (visible==true) {
            holder.linearHapus.setVisibility( View.VISIBLE );
        }
        else
        {
            holder.linearHapus.setVisibility( View.GONE );
        }
    }

    @Override
    public int getItemCount() {
        return (dataList != null) ? dataList.size() : 0;
    }

    public class data_promo_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_promo
				,tanggal_mulai_berlaku
				,tanggal_batas_berlaku
				,nama_promo
				,keterangan
				,syarat_dan_ketentuan
				,foto_promo
				,jumlah_point
				,status
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_promo_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_promo = (TextView) itemView.findViewById(R.id.id_promo);
			tanggal_mulai_berlaku = (TextView) itemView.findViewById(R.id.tanggal_mulai_berlaku);
            tanggal_batas_berlaku = (TextView) itemView.findViewById(R.id.tanggal_batas_berlaku);
            nama_promo = (TextView) itemView.findViewById(R.id.nama_promo);
            keterangan = (TextView) itemView.findViewById(R.id.keterangan);
            syarat_dan_ketentuan = (TextView) itemView.findViewById(R.id.syarat_dan_ketentuan);
            foto_promo = (TextView) itemView.findViewById(R.id.foto_promo);
            jumlah_point = (TextView) itemView.findViewById(R.id.jumlah_point);
            status = (TextView) itemView.findViewById(R.id.status);
            
            nomor = (TextView) itemView.findViewById(R.id.txt_nomor);
            linearEdit = (LinearLayout) itemView.findViewById(R.id.linearEdit);
            tombol_edit = (TextView) itemView.findViewById(R.id.tombol_edit);
            linearHapus = (LinearLayout) itemView.findViewById(R.id.linearHapus);
            tombol_hapus = (TextView) itemView.findViewById(R.id.tombol_hapus);  
            linearBaris = (LinearLayout) itemView.findViewById(R.id.linearBaris);
            image = (ImageView) itemView.findViewById(R.id.img);

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
                                    data_promo_apiservice mAPIService = 
									data_promo_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_promo(
											dataList.get(getAdapterPosition()).get_id_promo(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_promo_activity_v2)activity).fetch_data_promo();
										}
				
										@Override
										public void onFailure(Call<Object> call, Throwable t) {
											Toast.makeText(activity, "Gagal", Toast.LENGTH_LONG).show();
										}
									});
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

            linearEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_promo", dataList.get(getAdapterPosition()).get_id_promo());
					bundle.putString("tanggal_mulai_berlaku", dataList.get(getAdapterPosition()).get_tanggal_mulai_berlaku());
					bundle.putString("tanggal_batas_berlaku", dataList.get(getAdapterPosition()).get_tanggal_batas_berlaku());
					bundle.putString("nama_promo", dataList.get(getAdapterPosition()).get_nama_promo());
					bundle.putString("keterangan", dataList.get(getAdapterPosition()).get_keterangan());
					bundle.putString("syarat_dan_ketentuan", dataList.get(getAdapterPosition()).get_syarat_dan_ketentuan());
					bundle.putString("foto_promo", dataList.get(getAdapterPosition()).get_foto_promo());
					bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());
					bundle.putString("jumlah_point", dataList.get(getAdapterPosition()).get_jumlah_point());
					bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
					bundle.putString("nama_mitra", dataList.get(getAdapterPosition()).get_status());
					;

                    Intent intent = new Intent(activity, data_promo_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {


                    final MediaPlayer mp = MediaPlayer.create(activity, R.raw.click);
                    mp.start();
                    Bundle bundle = new Bundle();

                    bundle.putString("id_promo", dataList.get(getAdapterPosition()).get_id_promo());
					bundle.putString("tanggal_mulai_berlaku", dataList.get(getAdapterPosition()).get_tanggal_mulai_berlaku());
					bundle.putString("tanggal_batas_berlaku", dataList.get(getAdapterPosition()).get_tanggal_batas_berlaku());
					bundle.putString("nama_promo", dataList.get(getAdapterPosition()).get_nama_promo());
					bundle.putString("redeem_value", dataList.get(getAdapterPosition()).get_keterangan());
					bundle.putString("kategori_member", dataList.get(getAdapterPosition()).get_syarat_dan_ketentuan());
					bundle.putString("foto_promo", dataList.get(getAdapterPosition()).get_foto_promo());
					bundle.putString("jumlah_point", dataList.get(getAdapterPosition()).get_jumlah_point());
					bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
					bundle.putString("id_member", data_promo_activity_v2.id_member);
					bundle.putString("nama",data_promo_activity_v2.nama);
					bundle.putString("point", data_promo_activity_v2.point);
					bundle.putString("nama_mitra", data_promo_activity_v2.nama_mitra);
					bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());


                    Intent intent = new Intent(activity, data_redeem_tambah.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                    activity.finish();

                }
            });
        }
    }

    public void updateResults(ArrayList<data_promo_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}







