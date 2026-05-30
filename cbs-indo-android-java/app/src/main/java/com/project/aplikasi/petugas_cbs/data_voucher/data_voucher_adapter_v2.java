package com.project.aplikasi.petugas_cbs.data_voucher;

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

public class data_voucher_adapter_v2 extends RecyclerView.Adapter<data_voucher_adapter_v2.data_voucher_adapter_v2_view_holder> {
    private ArrayList<data_voucher_apidata> dataList;
    private Activity activity;

    public data_voucher_adapter_v2(ArrayList<data_voucher_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_voucher_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_voucher_tampil_v2, parent, false);
        return new data_voucher_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_voucher_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_voucher.setText(""+dataList.get(position).get_id_voucher());
		holder.id_voucher.setVisibility( View.GONE );
        holder.qrcode.setText(Html.fromHtml("Qrcode  : "+dataList.get(position).get_qrcode()+""));
        holder.id_relasi.setText(Html.fromHtml("Id Relasi  : "+dataList.get(position).get_id_relasi()+""));
        holder.nominal.setText(Html.fromHtml("Nominal  : "+dataList.get(position).get_nominal()+""));
        holder.tanggal_kadaluarsa.setText(Html.fromHtml("Tanggal Kadaluarsa  : "+dataList.get(position).get_tanggal_kadaluarsa()+""));
        holder.id_spbu.setText(Html.fromHtml("Id Spbu  : "+dataList.get(position).get_id_spbu()+""));
        holder.id_penjualan_voucher.setText(Html.fromHtml("Id Penjualan Voucher  : "+dataList.get(position).get_id_penjualan_voucher()+""));
        holder.status.setText(Html.fromHtml("Status  : "+dataList.get(position).get_status()+""));
        holder.file_voucher.setText(Html.fromHtml("File Voucher  : "+dataList.get(position).get_file_voucher()+""));
        holder.tanggal_dibuka.setText(Html.fromHtml("Tanggal Dibuka  : "+dataList.get(position).get_tanggal_dibuka()+""));


        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",true);
        hapus(holder,"Hapus",true);
    }

     private void thumb(data_voucher_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_voucher_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_voucher_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_voucher_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_voucher
        ,qrcode
        ,id_relasi
        ,nominal
        ,tanggal_kadaluarsa
        ,id_spbu
        ,id_penjualan_voucher
        ,status
        ,file_voucher
        ,tanggal_dibuka

				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_voucher_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_voucher = (TextView) itemView.findViewById(R.id.id_voucher);
            qrcode = (TextView) itemView.findViewById(R.id.qrcode);
            id_relasi = (TextView) itemView.findViewById(R.id.id_relasi);
            nominal = (TextView) itemView.findViewById(R.id.nominal);
            tanggal_kadaluarsa = (TextView) itemView.findViewById(R.id.tanggal_kadaluarsa);
            id_spbu = (TextView) itemView.findViewById(R.id.id_spbu);
            id_penjualan_voucher = (TextView) itemView.findViewById(R.id.id_penjualan_voucher);
            status = (TextView) itemView.findViewById(R.id.status);
            file_voucher = (TextView) itemView.findViewById(R.id.file_voucher);
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
                                    data_voucher_apiservice mAPIService = 
									data_voucher_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_voucher(
											dataList.get(getAdapterPosition()).get_id_voucher(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_voucher_activity_v2)activity).fetch_data_voucher();
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

                    bundle.putString("id_voucher", dataList.get(getAdapterPosition()).get_id_voucher());
                    bundle.putString("qrcode", dataList.get(getAdapterPosition()).get_qrcode());
                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
                    bundle.putString("nominal", dataList.get(getAdapterPosition()).get_nominal());
                    bundle.putString("tanggal_kadaluarsa", dataList.get(getAdapterPosition()).get_tanggal_kadaluarsa());
                    bundle.putString("id_spbu", dataList.get(getAdapterPosition()).get_id_spbu());
                    bundle.putString("id_penjualan_voucher", dataList.get(getAdapterPosition()).get_id_penjualan_voucher());
                    bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
                    bundle.putString("file_voucher", dataList.get(getAdapterPosition()).get_file_voucher());
                    bundle.putString("tanggal_dibuka", dataList.get(getAdapterPosition()).get_tanggal_dibuka());
;

                    Intent intent = new Intent(activity, data_voucher_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_voucher", dataList.get(getAdapterPosition()).get_id_voucher());
					                    bundle.putString("qrcode", dataList.get(getAdapterPosition()).get_qrcode());
                    bundle.putString("id_relasi", dataList.get(getAdapterPosition()).get_id_relasi());
                    bundle.putString("nominal", dataList.get(getAdapterPosition()).get_nominal());
                    bundle.putString("tanggal_kadaluarsa", dataList.get(getAdapterPosition()).get_tanggal_kadaluarsa());
                    bundle.putString("id_spbu", dataList.get(getAdapterPosition()).get_id_spbu());
                    bundle.putString("id_penjualan_voucher", dataList.get(getAdapterPosition()).get_id_penjualan_voucher());
                    bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
                    bundle.putString("file_voucher", dataList.get(getAdapterPosition()).get_file_voucher());
                    bundle.putString("tanggal_dibuka", dataList.get(getAdapterPosition()).get_tanggal_dibuka());
;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_voucher_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}
