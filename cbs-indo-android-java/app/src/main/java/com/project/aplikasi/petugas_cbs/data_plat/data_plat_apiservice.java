package com.project.aplikasi.petugas_cbs.data_plat;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface data_plat_apiservice {

    @GET("api/app/page/data_plat/tampil.php")
    Call<data_plat_api> tampil_data_plat();

    @FormUrlEncoded
    @POST("api/app/page/data_mitra/proses_simpan.php")
	/* @POST("/data_mitra/insert") */
    Call<Object> proses_simpan_data_plat(
            @Field("id_mitra") String id_mitra,
            @Field("plat") String plat,
            @Field("id_relasi") String id_relasi,

			@Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_mitra/proses_update.php")
	/* @POST("/data_mitra/update") */
    Call<Object> proses_update_data_plat(
            @Field("id_mitra") String id_mitra,
			@Field("plat") String plat,
            @Field("id_relasi") String id_relasi,

			@Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_mitra/proses_hapus.php")
	/* @POST("/data_mitra/delete") */
    Call<Object> proses_hapus_data_plat(
            @Field("id_mitra") String id_mitra,
			@Header("Authorization") String auth
    );


}





