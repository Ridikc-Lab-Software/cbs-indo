package com.project.aplikasi.petugas_cbs.data_promo;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_promo_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_promo/tampil.php")
	/* @POST("/data_promo/data_promo") */
    Call<data_promo_api> tampil_data_promo(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_promo/proses_simpan.php")
	/* @POST("/data_promo/insert") */
    Call<Object> proses_simpan_data_promo(
            @Field("id_promo") String id_promo,
			@Field("tanggal_mulai_berlaku") String tanggal_mulai_berlaku,
            @Field("tanggal_batas_berlaku") String tanggal_batas_berlaku,
            @Field("nama_promo") String nama_promo,
            @Field("keterangan") String keterangan,
            @Field("syarat_dan_ketentuan") String syarat_dan_ketentuan,
            @Field("foto_promo") String foto_promo,
            @Field("jumlah_point") String jumlah_point,
            @Field("status") String status,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_promo/proses_update.php")
	/* @POST("/data_promo/update") */
    Call<Object> proses_update_data_promo(
            @Field("id_promo") String id_promo,
			@Field("tanggal_mulai_berlaku") String tanggal_mulai_berlaku,
            @Field("tanggal_batas_berlaku") String tanggal_batas_berlaku,
            @Field("nama_promo") String nama_promo,
            @Field("keterangan") String keterangan,
            @Field("syarat_dan_ketentuan") String syarat_dan_ketentuan,
            @Field("foto_promo") String foto_promo,
            @Field("jumlah_point") String jumlah_point,
            @Field("status") String status,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_promo/proses_hapus.php")
	/* @POST("/data_promo/delete") */
    Call<Object> proses_hapus_data_promo(
            @Field("id_promo") String id_promo,
			@Header("Authorization") String auth
    );


}





