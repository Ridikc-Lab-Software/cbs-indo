package com.project.aplikasi.petugas_cbs.data_redeem;

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

public class data_redeem_adapter_v2 extends RecyclerView.Adapter<data_redeem_adapter_v2.data_redeem_adapter_v2_view_holder> {
    private ArrayList<data_redeem_apidata> dataList;
    private Activity activity;

    public data_redeem_adapter_v2(ArrayList<data_redeem_apidata> dataList, Activity activity) {
        this.dataList = dataList;
        this.activity = activity;
    }

    @NonNull
    @Override
    public data_redeem_adapter_v2_view_holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.data_redeem_tampil_v2, parent, false);
        return new data_redeem_adapter_v2_view_holder(view);
    }

    @Override
    public void onBindViewHolder(data_redeem_adapter_v2_view_holder holder, int position) {
        
        //holder.nomor.setText(String.format("%d", position + 1));
        holder.id_redeem.setText("id_redeem "+dataList.get(position).get_id_redeem());
		holder.id_redeem.setVisibility( View.GONE );
		holder.tanggal.setText(Html.fromHtml( "<b>Tanggal : </b>"+dataList.get(position).get_tanggal()+"") );
		holder.jam.setText(Html.fromHtml( "<b>Jam : </b>"+dataList.get(position).get_jam()+"") );
		holder.id_member.setText(Html.fromHtml( "<b>Member : </b>"+dataList.get(position).get_id_member()+"") );
		holder.id_mitra.setText(Html.fromHtml( "<b>Mitra : </b>"+dataList.get(position).get_id_mitra()+"") );
		holder.id_promo.setText(Html.fromHtml( "<b>Promo : </b>"+dataList.get(position).get_id_promo()+"") );
		holder.point.setText(Html.fromHtml( "<b>Point : </b>"+dataList.get(position).get_point()+"") );
		holder.status.setText(Html.fromHtml( "<b>Value : </b>"+dataList.get(position).get_status()+"") );
		

        thumb(holder,BASE_URL +"api/data/image/list/gambar1.png",false);
        edit(holder,"Edit",false);
        hapus(holder,"Hapus",false);
    }

     private void thumb(data_redeem_adapter_v2_view_holder holder,String url_gambar,Boolean visible)
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

    private void edit(data_redeem_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    private void hapus(data_redeem_adapter_v2_view_holder holder,String nama_tombol,Boolean visible)
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

    public class data_redeem_adapter_v2_view_holder extends RecyclerView.ViewHolder {
        TextView id_redeem
				,tanggal
				,jam
				,id_member
				,id_mitra
				,id_promo
				,point
				,status
				
				,nomor;
        TextView tombol_edit,tombol_hapus;
        private LinearLayout linearNomor;
        LinearLayout linearEdit, linearHapus,linearBaris;
        protected int REQUEST_CODE_TAMBAH = 3543;
        ImageView image;


        public data_redeem_adapter_v2_view_holder(final View itemView) {
            super(itemView);
            linearNomor = (LinearLayout) itemView.findViewById(R.id.linearNomor);
            id_redeem = (TextView) itemView.findViewById(R.id.id_redeem);
			tanggal = (TextView) itemView.findViewById(R.id.tanggal);
            jam = (TextView) itemView.findViewById(R.id.jam);
            id_member = (TextView) itemView.findViewById(R.id.id_member);
            id_mitra = (TextView) itemView.findViewById(R.id.id_mitra);
            id_promo = (TextView) itemView.findViewById(R.id.id_promo);
            point = (TextView) itemView.findViewById(R.id.point);
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
                                    data_redeem_apiservice mAPIService = 
									data_redeem_apiutils.getAPIService();
									String token = "Bearer " + new config_global().ambil(activity);
									Log.d("POSITION", Integer.toString(getAdapterPosition()));
									mAPIService.proses_hapus_data_redeem(
											dataList.get(getAdapterPosition()).get_id_redeem(),
											token
									).enqueue(new Callback<Object>() {						  
										@Override
										public void onResponse(Call<Object> call, Response<Object> response) {
											((data_redeem_activity_v2)activity).fetch_data_redeem();
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

                    bundle.putString("id_redeem", dataList.get(getAdapterPosition()).get_id_redeem());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("jam", dataList.get(getAdapterPosition()).get_jam());
					bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());
					bundle.putString("id_promo", dataList.get(getAdapterPosition()).get_id_promo());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
					;

                    Intent intent = new Intent(activity, data_redeem_edit.class);
                    intent.putExtras(bundle);
                    activity.startActivityForResult(intent, REQUEST_CODE_TAMBAH);
                }
            });

            linearBaris.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Bundle bundle = new Bundle();

                    bundle.putString("id_redeem", dataList.get(getAdapterPosition()).get_id_redeem());
					bundle.putString("tanggal", dataList.get(getAdapterPosition()).get_tanggal());
					bundle.putString("jam", dataList.get(getAdapterPosition()).get_jam());
					bundle.putString("id_member", dataList.get(getAdapterPosition()).get_id_member());
					bundle.putString("id_mitra", dataList.get(getAdapterPosition()).get_id_mitra());
					bundle.putString("id_promo", dataList.get(getAdapterPosition()).get_id_promo());
					bundle.putString("point", dataList.get(getAdapterPosition()).get_point());
					bundle.putString("status", dataList.get(getAdapterPosition()).get_status());
					;

                }
            });
        }
    }

    public void updateResults(ArrayList<data_redeem_apidata> result) {
        dataList = result;
        notifyDataSetChanged();
    }
}







