package com.project.aplikasi.petugas_cbs.data_mitra;

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
import com.project.aplikasi.petugas_cbs.data_member.data_member_activity_v2;
import com.project.aplikasi.petugas_cbs.data_promo.data_promo_activity_v2;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_tambah;
import com.squareup.picasso.Picasso;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;
import static com.project.aplikasi.petugas_cbs.data_mitra.data_mitra_activity_v2.id_member;
import static com.project.aplikasi.petugas_cbs.data_mitra.data_mitra_activity_v2.nama;
import static com.project.aplikasi.petugas_cbs.data_mitra.data_mitra_activity_v2.point;

public class data_mitra_adapter_v2 extends RecyclerView.Adapter<data_mitra_adapter_v2.data_mitra_adapter_v2_view_holder> {
    private ArrayList<data_mitra_apidata> dataList;
    private Activity activity;

    public data_mitra_adapter_v2(ArrayList<data_mitra_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_mitra_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_mitra_tampil_v2, parent, false);
        return new data_mitra_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_mitra_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_mitra.setText("id_mitra "+dataList.get(position).get_id_mitra());
		holder.id_mitra.setVisibility( View.GONE );
		holder.nama_mitra.setText(Html.fromHtml( "<b>Nama mitra : </b>"+dataList.get(position).get_nama_mitra()+"") );
		holder.alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+dataList.get(position).get_alamat()+"") );

		holder.no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+dataList.get(position).get_no_telepon()+"") );
        holder.no_telepon.setVisibility( View.GONE );
		holder.nama_pemilik.setText(Html.fromHtml( "<b>Nama pemilik : </b>"+dataList.get(position).get_nama_pemilik()+"") );
        holder.nama_pemilik.setVisibility( View.GONE );
		holder.no_telepon_pemilik.setText(Html.fromHtml( "<b>No telepon pemilik : </b>"+dataList.get(position).get_no_telepon_pemilik()+"") );
        holder.no_telepon_pemilik.setVisibility( View.GONE );
		holder.tanggal_daftar.setText(Html.fromHtml( "<b>Tanggal daftar : </b>"+dataList.get(position).get_tanggal_daftar()+"") );

		holder.username.setText(Html.fromHtml( "<b>Username : </b>"+dataList.get(position).get_username()+"") );
        holder.username.setVisibility( View.GONE );
		holder.password.setText(Html.fromHtml( "<b>Password : </b>"+dataList.get(position).get_password()+"") );
        holder.password.setVisibility( View.GONE );
		holder.status.setText(Html.fromHtml( "<b>Status : </b>"+dataList.get(position).get_status()+"") );
		holder.gambar_logo.setText(Html.fromHtml( "<b>Gambar logo : </b>"+dataList.get(position).get_gambar_logo()+"") );
        holder.gambar_logo.setVisibility( View.GONE );
		

        thumb(holder,BASE_URL +"/admin/upload/"+dataList.get(position).get_gambar_logo(),true);
        edit(holder,"Edit",false);
        hapus(holder,"Hapus",false);
    }

     private void thumb(data_mitra_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_mitra_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_mitra_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_mitra_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_mitra
				,nama_mitra
				,alamat
				,no_telepon
				,nama_pemilik
				,no_telepon_pemilik
				,tanggal_daftar
				,username
				,password
				,status
				,gambar_logo
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_mitra_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_mitra = (TextView) itemView.findViewById(R.id.id_mitra);
			nama_mitra = (TextView) itemView.findViewById(R.id.nama_mitra);
            alamat = (TextView) itemView.findViewById(R.id.alamat);
            no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            nama_pemilik = (TextView) itemView.findViewById(R.id.nama_pemilik);
            no_telepon_pemilik = (TextView) itemView.findViewById(R.id.no_telepon_pemilik);
            tanggal_daftar = (TextView) itemView.findViewById(R.id.tanggal_daftar);
            username = (TextView) itemView.findViewById(R.id.username);
            password = (TextView) itemView.findViewById(R.id.password);
            status = (TextView) itemView.findViewById(R.id.status);
            gambar_logo = (TextView) itemView.findViewById(R.id.gambar_logo);
            
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
                                    data_mitra_apiservice mAPIService = 
									data_mitra_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_mitra(
											dataList.get(getAdapterPosition()).get_id_mitra(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_mitra_activity_v2)activity).fetch_data_mitra();
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

                    bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());
					bundle.putString("nama_mitra", dataList.get(getAdapterPosition()).get_nama_mitra());
					bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
					bundle.putString("no_telepon", dataList.get(getAdapterPosition()).get_no_telepon());
					bundle.putString("nama_pemilik", dataList.get(getAdapterPosition()).get_nama_pemilik());
					bundle.putString("no_telepon_pemilik", dataList.get(getAdapterPosition()).get_no_telepon_pemilik());
					bundle.putString("tanggal_daftar", dataList.get(getAdapterPosition()).get_tanggal_daftar());
					bundle.putString("username", dataList.get(getAdapterPosition()).get_username());
					bundle.putString("password", dataList.get(getAdapterPosition()).get_password());
					bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
					bundle.putString("gambar_logo", dataList.get(getAdapterPosition()).get_gambar_logo());
					;

                    Intent intent = new Intent(activity, data_mitra_edit.class);
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




                    bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());
					bundle.putString("nama_mitra", dataList.get(getAdapterPosition()).get_nama_mitra());
					bundle.putString("id_member", id_member);
					bundle.putString("point", point);
					bundle.putString("nama", nama);

                    Intent intent = new Intent(activity, data_promo_activity_v2.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                    activity.finish();


                }
            });
        }
    }

    public void updateResults(ArrayList<data_mitra_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }




}







