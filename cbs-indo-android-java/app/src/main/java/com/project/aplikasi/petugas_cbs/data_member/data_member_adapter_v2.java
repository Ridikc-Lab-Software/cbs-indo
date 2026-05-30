package com.project.aplikasi.petugas_cbs.data_member;

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
import com.project.aplikasi.petugas_cbs.data_jenis_transaksi.data_jenis_transaksi_activity_v2;
import com.project.aplikasi.petugas_cbs.data_mitra.data_mitra_activity_v2;
import com.project.aplikasi.petugas_cbs.data_promo.data_promo_activity_v2;
import com.project.aplikasi.petugas_cbs.data_transaksi.data_transaksi_tambah;
import com.project.aplikasi.petugas_cbs.home.home_activity;
import com.squareup.picasso.Picasso;

import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_member_adapter_v2 extends RecyclerView.Adapter<data_member_adapter_v2.data_member_adapter_v2_view_holder> {
    private ArrayList<data_member_apidata> dataList;
    private Activity activity;

    public data_member_adapter_v2(ArrayList<data_member_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_member_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_member_tampil_v2, parent, false);
        return new data_member_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_member_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_member.setText("id_member "+dataList.get(position).get_id_member());
		holder.id_member.setVisibility( View.GONE );
		holder.nama.setText(Html.fromHtml( ""+dataList.get(position).get_nama()+"") );

		holder.alamat.setText(Html.fromHtml( "<b>Alamat : </b>"+dataList.get(position).get_alamat()+"") );
        holder.alamat.setVisibility( View.GONE );
		holder.no_telepon.setText(Html.fromHtml( "<b>No telepon : </b>"+dataList.get(position).get_no_telepon()+"") );
        holder.no_telepon.setVisibility( View.GONE );
		holder.jenis_kelamin.setText(Html.fromHtml( "<b>Jenis kelamin : </b>"+dataList.get(position).get_jenis_kelamin()+"") );
        holder.jenis_kelamin.setVisibility( View.GONE );
		holder.tanggal_terdaftar.setText(Html.fromHtml( dataList.get(position).get_tanggal_terdaftar()+"") );

		holder.id_kategori_member.setText(Html.fromHtml( "<b>kategori member : </b>"+dataList.get(position).get_id_kategori_member()+"") );
        holder.id_kategori_member.setVisibility( View.GONE );
		holder.kode_rfid.setText(Html.fromHtml( "<b>Kode rfid : </b>"+dataList.get(position).get_kode_rfid()+"") );
        holder.kode_rfid.setVisibility( View.GONE );

        String pointStr = dataList.get(position).get_point();
        int point = 0;


        try {
            point = Integer.parseInt(pointStr);
        } catch (NumberFormatException e) {
            point = 0;
        }
        NumberFormat nf = NumberFormat.getInstance(new Locale("in", "ID"));
        String pointFormatted = nf.format(point);
        holder.point.setText(Html.fromHtml(pointFormatted + " Point"));

		holder.username.setText(Html.fromHtml( "<b>Username : </b>"+dataList.get(position).get_username()+"") );
		holder.username.setVisibility(View.GONE);
		holder.password.setText(Html.fromHtml( ""+dataList.get(position).get_password()+"") );


        thumb(holder,BASE_URL +"api/data/image/list/user.png",false);
        edit(holder,"Edit",false);
        hapus(holder,"Hapus",false);
    }

     private void thumb(data_member_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_member_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_member_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_member_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_member
				,nama
				,alamat
				,no_telepon
				,jenis_kelamin
				,tanggal_terdaftar
				,id_kategori_member
				,kode_rfid
				,point
				,username
				,password
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_member_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_member = (TextView) itemView.findViewById(R.id.id_member);
			nama = (TextView) itemView.findViewById(R.id.nama);
            alamat = (TextView) itemView.findViewById(R.id.alamat);
            no_telepon = (TextView) itemView.findViewById(R.id.no_telepon);
            jenis_kelamin = (TextView) itemView.findViewById(R.id.jenis_kelamin);
            tanggal_terdaftar = (TextView) itemView.findViewById(R.id.tanggal_terdaftar);
            id_kategori_member = (TextView) itemView.findViewById(R.id.id_kategori_member);
            kode_rfid = (TextView) itemView.findViewById(R.id.kode_rfid);
            point = (TextView) itemView.findViewById(R.id.point);
            username = (TextView) itemView.findViewById(R.id.username);
            password = (TextView) itemView.findViewById(R.id.password);
            
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
                                    data_member_apiservice mAPIService = 
									data_member_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_member(
											dataList.get(getAdapterPosition()).get_id_member(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_member_activity_v2)activity).fetch_data_member();
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

                    bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
					bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
					bundle.putString("no_telepon", dataList.get(getAdapterPosition()).get_no_telepon());
					bundle.putString("jenis_kelamin", dataList.get(getAdapterPosition()).get_jenis_kelamin());
					bundle.putString("tanggal_terdaftar", dataList.get(getAdapterPosition()).get_tanggal_terdaftar());
					bundle.putString("id_kategori_member", dataList.get(getAdapterPosition()).get_id_kategori_member());
					bundle.putString("kode_rfid", dataList.get(getAdapterPosition()).get_kode_rfid());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("username", dataList.get(getAdapterPosition()).get_username());
					bundle.putString("password", dataList.get(getAdapterPosition()).get_password());
					;

                    Intent intent = new Intent(activity, data_member_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    final MediaPlayer mp = MediaPlayer.create(activity, R.raw.click);
                    mp.start();

                    bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
					bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
					bundle.putString("no_telepon", dataList.get(getAdapterPosition()).get_no_telepon());
					bundle.putString("jenis_kelamin", dataList.get(getAdapterPosition()).get_jenis_kelamin());
					bundle.putString("tanggal_terdaftar", dataList.get(getAdapterPosition()).get_tanggal_terdaftar());
					bundle.putString("id_kategori_member", dataList.get(getAdapterPosition()).get_id_kategori_member());
					bundle.putString("kode_rfid", dataList.get(getAdapterPosition()).get_kode_rfid());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("username", dataList.get(getAdapterPosition()).get_username());
					bundle.putString("password", dataList.get(getAdapterPosition()).get_password());
                    String dari = data_member_activity_v2.dari;
                    Intent intent;
                            if(dari.equals("transaksi"))
                            {
                                 intent = new Intent(activity, data_jenis_transaksi_activity_v2.class);
                                 activity.finish();
                            }
                            else
                            {
                                 intent = new Intent(activity, data_promo_activity_v2.class);
                                activity.finish();
                            }

                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });
        }
    }

    public void updateResults(ArrayList<data_member_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }


}







