package com.project.aplikasi.petugas_cbs.data_penjualan_voucher;

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

public class data_penjualan_voucher_adapter_v2 extends RecyclerView.Adapter<data_penjualan_voucher_adapter_v2.data_penjualan_voucher_adapter_v2_view_holder> {
    private ArrayList<data_penjualan_voucher_apidata> dataList;
    private Activity activity;

    public data_penjualan_voucher_adapter_v2(ArrayList<data_penjualan_voucher_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_penjualan_voucher_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_penjualan_voucher_tampil_v2, parent, false);
        return new data_penjualan_voucher_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_penjualan_voucher_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_penjualan_voucher.setText(""+dataList.get(position).get_id_penjualan_voucher());
		holder.id_penjualan_voucher.setVisibility( View.GONE );
        holder.tanggal_penjualan.setText(Html.fromHtml("Tanggal Penjualan  : "+dataList.get(position).get_tanggal_penjualan()+""));
        holder.id_relasi.setText(Html.fromHtml("Id Relasi  : "+dataList.get(position).get_id_relasi()+""));
        holder.jumlah_voucher.setText(Html.fromHtml("Jumlah Voucher  : "+dataList.get(position).get_jumlah_voucher()+""));
        holder.nominal.setText(Html.fromHtml("Nominal  : "+dataList.get(position).get_nominal()+""));
        holder.password_voucher.setText(Html.fromHtml("Password Voucher  : "+dataList.get(position).get_password_voucher()+""));
        holder.tanggal_dibuka.setText(Html.fromHtml("Tanggal Dibuka  : "+dataList.get(position).get_tanggal_dibuka()+""));


        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",true);
        hapus(holder,"Hapus",true);
    }

     private void thumb(data_penjualan_voucher_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_penjualan_voucher_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_penjualan_voucher_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_penjualan_voucher_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_penjualan_voucher
        ,tanggal_penjualan
        ,id_relasi
        ,jumlah_voucher
        ,nominal
        ,password_voucher
        ,tanggal_dibuka

				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_penjualan_voucher_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_penjualan_voucher = (TextView) itemView.findViewById(R.id.id_penjualan_voucher);
            tanggal_penjualan = (TextView) itemView.findViewById(R.id.tanggal_penjualan);
            id_relasi = (TextView) itemView.findViewById(R.id.id_relasi);
            jumlah_voucher = (TextView) itemView.findViewById(R.id.jumlah_voucher);
            nominal = (TextView) itemView.findViewById(R.id.nominal);
            password_voucher = (TextView) itemView.findViewById(R.id.password_voucher);
            tanggal_dibuka = (TextView) itemView.findViewById(R.id.tanggal_dibuka);

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
                                    data_penjualan_voucher_apiservice mAPIService = 
									data_penjualan_voucher_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_penjualan_voucher(
											dataList.get(getAdapterPosition()).get_id_penjualan_voucher(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_penjualan_voucher_activity_v2)activity).fetch_data_penjualan_voucher();
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

                    bundle.putString("id_penjualan_voucher", dataList.get(getAdapterPosition()).get_id_penjualan_voucher());
                    bundle.putString("tanggal_penjualan", dataList.get(getAdapterPosition()).get_tanggal_penjualan());
                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
                    bundle.putString("jumlah_voucher", dataList.get(getAdapterPosition()).get_jumlah_voucher());
                    bundle.putString("nominal", dataList.get(getAdapterPosition()).get_nominal());
                    bundle.putString("password_voucher", dataList.get(getAdapterPosition()).get_password_voucher());
                    bundle.putString("tanggal_dibuka", dataList.get(getAdapterPosition()).get_tanggal_dibuka());
;

                    Intent intent = new Intent(activity, data_penjualan_voucher_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_penjualan_voucher", dataList.get(getAdapterPosition()).get_id_penjualan_voucher());
					                    bundle.putString("tanggal_penjualan", dataList.get(getAdapterPosition()).get_tanggal_penjualan());
                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
                    bundle.putString("jumlah_voucher", dataList.get(getAdapterPosition()).get_jumlah_voucher());
                    bundle.putString("nominal", dataList.get(getAdapterPosition()).get_nominal());
                    bundle.putString("password_voucher", dataList.get(getAdapterPosition()).get_password_voucher());
                    bundle.putString("tanggal_dibuka", dataList.get(getAdapterPosition()).get_tanggal_dibuka());
;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_penjualan_voucher_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}
