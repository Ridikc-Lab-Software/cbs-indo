package com.project.aplikasi.petugas_cbs.data_transaksi;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
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
import com.squareup.picasso.Picasso;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_transaksi_adapter_v2 extends RecyclerView.Adapter<data_transaksi_adapter_v2.data_transaksi_adapter_v2_view_holder> {
    private ArrayList<data_transaksi_apidata> dataList;
    private Activity activity;

    public data_transaksi_adapter_v2(ArrayList<data_transaksi_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_transaksi_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_transaksi_tampil_v2, parent, false);
        return new data_transaksi_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_transaksi_adapter_v2_view_holder holder, int position) {


        holder.id_transaksi.setText("id_transaksi "+dataList.get(position).get_id_transaksi());
		holder.id_transaksi.setVisibility( View.GONE );
		holder.tanggal.setText(Html.fromHtml( "<b>Tanggal : </b>"+dataList.get(position).get_tanggal()+"") );
		holder.jam.setText(Html.fromHtml( "<b>Jam : </b>"+dataList.get(position).get_jam()+"") );
		holder.id_member.setText(Html.fromHtml( "<b>Nama : </b>"+dataList.get(position).get_id_member()+"") );
		holder.id_petugas.setText(Html.fromHtml( "<b>Petugas : </b>"+dataList.get(position).get_id_petugas()+"") );
		holder.id_kategori_member.setText(Html.fromHtml( "<b>Jenis Kendaraan : </b>"+dataList.get(position).get_id_kategori_member()+"") );
		holder.id_jenis_transaksi.setText(Html.fromHtml( "<b>Jenis transaksi : </b>"+dataList.get(position).get_id_jenis_transaksi()+"") );
		holder.point.setText(Html.fromHtml( "<b>Penambahan Point : </b>"+dataList.get(position).get_point()+" Point") );
		holder.jumlah.setText(Html.fromHtml( "<b>Jumlah : </b>"+dataList.get(position).get_jumlah()+"") );

        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",false);
        hapus(holder,"Hapus",false);
    }

     private void thumb(data_transaksi_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_transaksi_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_transaksi_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_transaksi_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_transaksi
				,tanggal
				,jam
				,id_member
				,id_petugas
				,id_kategori_member
				,id_jenis_transaksi
				,point
				,jumlah
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_transaksi_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_transaksi = (TextView) itemView.findViewById(R.id.id_transaksi);
			tanggal = (TextView) itemView.findViewById(R.id.tanggal);
            jam = (TextView) itemView.findViewById(R.id.jam);
            id_member = (TextView) itemView.findViewById(R.id.id_member);
            id_petugas = (TextView) itemView.findViewById(R.id.id_petugas);
            id_kategori_member = (TextView) itemView.findViewById(R.id.id_kategori_member);
            id_jenis_transaksi = (TextView) itemView.findViewById(R.id.id_jenis_transaksi);
            point = (TextView) itemView.findViewById(R.id.point);
            jumlah = (TextView) itemView.findViewById(R.id.jumlah);
            
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
                                    data_transaksi_apiservice mAPIService = 
									data_transaksi_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_transaksi(
											dataList.get(getAdapterPosition()).get_id_transaksi(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_transaksi_activity_v2)activity).fetch_data_transaksi();
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

                    bundle.putString("id_transaksi", dataList.get(getAdapterPosition()).get_id_transaksi());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("jam", dataList.get(getAdapterPosition()).get_jam());
					bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("id_petugas", dataList.get(getAdapterPosition()).get_id_petugas());
					bundle.putString("id_kategori_member", dataList.get(getAdapterPosition()).get_id_kategori_member());
					bundle.putString("id_jenis_transaksi", dataList.get(getAdapterPosition()).get_id_jenis_transaksi());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("jumlah", dataList.get(getAdapterPosition()).get_jumlah());
					;

                    Intent intent = new Intent(activity, data_transaksi_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_transaksi", dataList.get(getAdapterPosition()).get_id_transaksi());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("jam", dataList.get(getAdapterPosition()).get_jam());
					bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("id_petugas", dataList.get(getAdapterPosition()).get_id_petugas());
					bundle.putString("id_kategori_member", dataList.get(getAdapterPosition()).get_id_kategori_member());
					bundle.putString("id_jenis_transaksi", dataList.get(getAdapterPosition()).get_id_jenis_transaksi());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("jumlah", dataList.get(getAdapterPosition()).get_jumlah());
					;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_transaksi_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}












