package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_group_jenis_transaksi_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_group_jenis_transaksi/tampil.php")
	/* @POST("/data_group_jenis_transaksi/data_group_jenis_transaksi") */
    Call<data_group_jenis_transaksi_api> tampil_data_group_jenis_transaksi(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_group_jenis_transaksi/proses_simpan.php")
	/* @POST("/data_group_jenis_transaksi/insert") */
    Call<Object> proses_simpan_data_group_jenis_transaksi(
            @Field("id_group_jenis_transaksi") String id_group_jenis_transaksi,
			@Field("nama_group") String nama_group,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("gambar_logo") String gambar_logo,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_group_jenis_transaksi/proses_update.php")
	/* @POST("/data_group_jenis_transaksi/update") */
    Call<Object> proses_update_data_group_jenis_transaksi(
            @Field("id_group_jenis_transaksi") String id_group_jenis_transaksi,
			@Field("nama_group") String nama_group,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("gambar_logo") String gambar_logo,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_group_jenis_transaksi/proses_hapus.php")
	/* @POST("/data_group_jenis_transaksi/delete") */
    Call<Object> proses_hapus_data_group_jenis_transaksi(
            @Field("id_group_jenis_transaksi") String id_group_jenis_transaksi,
			@Header("Authorization") String auth
    );


}





