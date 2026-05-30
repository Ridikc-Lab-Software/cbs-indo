package com.project.aplikasi.petugas_cbs.data_redeem;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface data_redeem_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_redeem/tampil.php")
	/* @POST("/data_redeem/data_redeem") */
    Call<data_redeem_api> tampil_data_redeem(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_redeem/proses_simpan.php")
	/* @POST("/data_redeem/insert") */
    Call<Object> proses_simpan_data_redeem(
            @Field("id_redeem") String id_redeem,
			@Field("tanggal") String tanggal,
            @Field("jam") String jam,
            @Field("id_member") String id_member,
            @Field("id_mitra") String id_mitra,
            @Field("id_promo") String id_promo,
            @Field("point") String point,
            @Field("status") String status,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_redeem/proses_update.php")
	/* @POST("/data_redeem/update") */
    Call<Object> proses_update_data_redeem(
            @Field("id_redeem") String id_redeem,
			@Field("tanggal") String tanggal,
            @Field("jam") String jam,
            @Field("id_member") String id_member,
            @Field("id_mitra") String id_mitra,
            @Field("id_promo") String id_promo,
            @Field("point") String point,
            @Field("status") String status,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_redeem/proses_hapus.php")
	/* @POST("/data_redeem/delete") */
    Call<Object> proses_hapus_data_redeem(
            @Field("id_redeem") String id_redeem,
			@Header("Authorization") String auth
    );

    @GET("api/app/page/data_redeem/print.php")
	/* @POST("/data_redeem/delete") */
    Call<RedeemPrintResponse> get_print_template(
        @Query("id_redeem") String idRedeem,
        @Query("nama") String nama,
        @Query("nama_promo") String namaPromo,
        @Query("mitra") String mitra,
        @Query("point") String point,
        @Query("pengurangan_point") String penguranganPoint,
        @Query("petugas") String petugas,
        @Query("kategori_member") String kategori,
        @Query("redeem_value") String redeemValue
//        @Header("Authorization") String auth
    );


}





