package com.project.aplikasi.petugas_cbs.data_kategori_member;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_kategori_member_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_kategori_member/tampil.php")
	/* @POST("/data_kategori_member/data_kategori_member") */
    Call<data_kategori_member_api> tampil_data_kategori_member(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_kategori_member/proses_simpan.php")
	/* @POST("/data_kategori_member/insert") */
    Call<Object> proses_simpan_data_kategori_member(
            @Field("id_kategori_member") String id_kategori_member,
			@Field("kategori_member") String kategori_member,
            @Field("gambar_logo") String gambar_logo,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_kategori_member/proses_update.php")
	/* @POST("/data_kategori_member/update") */
    Call<Object> proses_update_data_kategori_member(
            @Field("id_kategori_member") String id_kategori_member,
			@Field("kategori_member") String kategori_member,
            @Field("gambar_logo") String gambar_logo,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_kategori_member/proses_hapus.php")
	/* @POST("/data_kategori_member/delete") */
    Call<Object> proses_hapus_data_kategori_member(
            @Field("id_kategori_member") String id_kategori_member,
			@Header("Authorization") String auth
    );


}





