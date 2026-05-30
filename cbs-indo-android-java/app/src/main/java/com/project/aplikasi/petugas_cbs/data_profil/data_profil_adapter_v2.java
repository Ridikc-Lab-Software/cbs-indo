package com.project.aplikasi.petugas_cbs.data_profil;

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

public class data_profil_adapter_v2 extends RecyclerView.Adapter<data_profil_adapter_v2.data_profil_adapter_v2_view_holder> {
    private ArrayList<data_profil_apidata> dataList;
    private Activity activity;

    public data_profil_adapter_v2(ArrayList<data_profil_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_profil_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_profil_tampil_v2, parent, false);
        return new data_profil_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_profil_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_profil.setText("id_profil "+dataList.get(position).get_id_profil());
		holder.id_profil.setVisibility( View.GONE );
		holder.nama.setText(Html.fromHtml( "<b>Nama : </b>"+dataList.get(position).get_nama()+"") );
		holder.alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+dataList.get(position).get_alamat()+"") );
		holder.no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+dataList.get(position).get_no_telepon()+"") );
		holder.sejarah.setText(Html.fromHtml( "<b>Sejarah : </b>"+dataList.get(position).get_sejarah()+"") );
		holder.visi.setText(Html.fromHtml( "<b>Visi : </b>"+dataList.get(position).get_visi()+"") );
		holder.misi.setText(Html.fromHtml( "<b>Misi : </b>"+dataList.get(position).get_misi()+"") );
		holder.deskripsi.setText(Html.fromHtml( "<b>Deskripsi : </b>"+dataList.get(position).get_deskripsi()+"") );
		holder.foto.setText(Html.fromHtml( "<b>Foto : </b>"+dataList.get(position).get_foto()+"") );
		

        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",true);
        hapus(holder,"Hapus",true);
    }

     private void thumb(data_profil_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_profil_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_profil_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_profil_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_profil
				,nama
				,alamat
				,no_telepon
				,sejarah
				,visi
				,misi
				,deskripsi
				,foto
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_profil_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_profil = (TextView) itemView.findViewById(R.id.id_profil);
			nama = (TextView) itemView.findViewById(R.id.nama);
            alamat = (TextView) itemView.findViewById(R.id.alamat);
            no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            sejarah = (TextView) itemView.findViewById(R.id.sejarah);
            visi = (TextView) itemView.findViewById(R.id.visi);
            misi = (TextView) itemView.findViewById(R.id.misi);
            deskripsi = (TextView) itemView.findViewById(R.id.deskripsi);
            foto = (TextView) itemView.findViewById(R.id.foto);
            
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
                                    data_profil_apiservice mAPIService = 
									data_profil_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_profil(
											dataList.get(getAdapterPosition()).get_id_profil(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_profil_activity_v2)activity).fetch_data_profil();
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

                    bundle.putString("id_profil", dataList.get(getAdapterPosition()).get_id_profil());
					bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
					bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
					bundle.putString("no_telepon", dataList.get(getAdapterPosition()).get_no_telepon());
					bundle.putString("sejarah", dataList.get(getAdapterPosition()).get_sejarah());
					bundle.putString("visi", dataList.get(getAdapterPosition()).get_visi());
					bundle.putString("misi", dataList.get(getAdapterPosition()).get_misi());
					bundle.putString("deskripsi", dataList.get(getAdapterPosition()).get_deskripsi());
					bundle.putString("foto", dataList.get(getAdapterPosition()).get_foto());
					;

                    Intent intent = new Intent(activity, data_profil_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_profil", dataList.get(getAdapterPosition()).get_id_profil());
					bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
					bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
					bundle.putString("no_telepon", dataList.get(getAdapterPosition()).get_no_telepon());
					bundle.putString("sejarah", dataList.get(getAdapterPosition()).get_sejarah());
					bundle.putString("visi", dataList.get(getAdapterPosition()).get_visi());
					bundle.putString("misi", dataList.get(getAdapterPosition()).get_misi());
					bundle.putString("deskripsi", dataList.get(getAdapterPosition()).get_deskripsi());
					bundle.putString("foto", dataList.get(getAdapterPosition()).get_foto());
					;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_profil_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}







