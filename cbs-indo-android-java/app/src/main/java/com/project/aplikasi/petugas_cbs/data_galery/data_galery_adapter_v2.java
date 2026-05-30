package com.project.aplikasi.petugas_cbs.data_galery;

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

public class data_galery_adapter_v2 extends RecyclerView.Adapter<data_galery_adapter_v2.data_galery_adapter_v2_view_holder> {
    private ArrayList<data_galery_apidata> dataList;
    private Activity activity;

    public data_galery_adapter_v2(ArrayList<data_galery_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_galery_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_galery_tampil_v2, parent, false);
        return new data_galery_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_galery_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_galery.setText("id_galery "+dataList.get(position).get_id_galery());
		holder.id_galery.setVisibility( View.GONE );
		holder.tanggal.setText(Html.fromHtml( "<b>Tanggal : </b>"+dataList.get(position).get_tanggal()+"") );
		holder.judul.setText(Html.fromHtml( "<b>Judul : </b>"+dataList.get(position).get_judul()+"") );
		holder.foto.setText(Html.fromHtml( "<b>Foto : </b>"+dataList.get(position).get_foto()+"") );
		holder.isi.setText(Html.fromHtml( "<b>Isi : </b>"+dataList.get(position).get_isi()+"") );
		

        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",true);
        hapus(holder,"Hapus",true);
    }

     private void thumb(data_galery_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_galery_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_galery_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_galery_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_galery
				,tanggal
				,judul
				,foto
				,isi
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_galery_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_galery = (TextView) itemView.findViewById(R.id.id_galery);
			tanggal = (TextView) itemView.findViewById(R.id.tanggal);
            judul = (TextView) itemView.findViewById(R.id.judul);
            foto = (TextView) itemView.findViewById(R.id.foto);
            isi = (TextView) itemView.findViewById(R.id.isi);
            
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
                                    data_galery_apiservice mAPIService = 
									data_galery_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_galery(
											dataList.get(getAdapterPosition()).get_id_galery(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_galery_activity_v2)activity).fetch_data_galery();
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

                    bundle.putString("id_galery", dataList.get(getAdapterPosition()).get_id_galery());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("judul", dataList.get(getAdapterPosition()).get_judul());
					bundle.putString("foto", dataList.get(getAdapterPosition()).get_foto());
					bundle.putString("isi", dataList.get(getAdapterPosition()).get_isi());
					;

                    Intent intent = new Intent(activity, data_galery_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_galery", dataList.get(getAdapterPosition()).get_id_galery());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("judul", dataList.get(getAdapterPosition()).get_judul());
					bundle.putString("foto", dataList.get(getAdapterPosition()).get_foto());
					bundle.putString("isi", dataList.get(getAdapterPosition()).get_isi());
					;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_galery_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}







