package com.project.aplikasi.petugas_cbs.data_relasi;

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
import com.project.aplikasi.petugas_cbs.data_admin.data_admin_activity_v2;
import com.squareup.picasso.Picasso;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_relasi_adapter_v2 extends RecyclerView.Adapter<data_relasi_adapter_v2.data_relasi_adapter_v2_view_holder> {
    private ArrayList<data_relasi_apidata> dataList;
    private Activity activity;

    public data_relasi_adapter_v2(ArrayList<data_relasi_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_relasi_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_relasi_tampil_v2, parent, false);
        return new data_relasi_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_relasi_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_relasi.setText(""+dataList.get(position).get_id_relasi());
		holder.id_relasi.setVisibility( View.GONE );
        holder.nama.setText(Html.fromHtml("Nama  : "+dataList.get(position).get_nama()+""));
        holder.nomor_telepon.setText(Html.fromHtml("Nomor Telepon  : "+dataList.get(position).get_nomor_telepon()+""));
        holder.email.setText(Html.fromHtml("Email  : "+dataList.get(position).get_email()+""));
        holder.alamat.setText(Html.fromHtml("Alamat  : "+dataList.get(position).get_alamat()+""));
        holder.id_spbu.setText(Html.fromHtml("Id Spbu  : "+dataList.get(position).get_id_spbu()+""));
        holder.nama_spbu.setText(Html.fromHtml("Nama Spbu  : "+dataList.get(position).get_nama_spbu()+""));
        holder.password.setText(Html.fromHtml("Password  : "+dataList.get(position).get_password()+""));


        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",true);
        hapus(holder,"Hapus",true);
    }

     private void thumb(data_relasi_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_relasi_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_relasi_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_relasi_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_relasi
        ,nama
        ,nomor_telepon
        ,email
        ,alamat
        ,id_spbu
        ,nama_spbu
        ,password

				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_relasi_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_relasi = (TextView) itemView.findViewById(R.id.id_relasi);
            nama = (TextView) itemView.findViewById(R.id.nama);
            nomor_telepon = (TextView) itemView.findViewById(R.id.nomor_telepon);
            email = (TextView) itemView.findViewById(R.id.email);
            alamat = (TextView) itemView.findViewById(R.id.alamat);
            id_spbu = (TextView) itemView.findViewById(R.id.id_spbu);
            nama_spbu = (TextView) itemView.findViewById(R.id.nama_spbu);
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
                                    data_relasi_apiservice mAPIService = 
									data_relasi_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_relasi(
											dataList.get(getAdapterPosition()).get_id_relasi(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_relasi_activity_v2)activity).fetch_data_relasi();
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

                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
                    bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
                    bundle.putString("nomor_telepon", dataList.get(getAdapterPosition()).get_nomor_telepon());
                    bundle.putString("email", dataList.get(getAdapterPosition()).get_email());
                    bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
                    bundle.putString("id_spbu", dataList.get(getAdapterPosition()).get_id_spbu());
                    bundle.putString("nama_spbu", dataList.get(getAdapterPosition()).get_nama_spbu());
                    bundle.putString("password", dataList.get(getAdapterPosition()).get_password());
;

                    Intent intent = new Intent(activity, data_relasi_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
					                    bundle.putString("nama", dataList.get(getAdapterPosition()).get_nama());
                    bundle.putString("nomor_telepon", dataList.get(getAdapterPosition()).get_nomor_telepon());
                    bundle.putString("email", dataList.get(getAdapterPosition()).get_email());
                    bundle.putString("alamat", dataList.get(getAdapterPosition()).get_alamat());
                    bundle.putString("id_spbu", dataList.get(getAdapterPosition()).get_id_spbu());
                    bundle.putString("nama_spbu", dataList.get(getAdapterPosition()).get_nama_spbu());
                    bundle.putString("password", dataList.get(getAdapterPosition()).get_password());
;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_relasi_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}
