package com.project.aplikasi.petugas_cbs.data_petugas;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_petugas_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_petugas/tampil.php")
	/* @POST("/data_petugas/data_petugas") */
    Call<data_petugas_api> tampil_data_petugas(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_petugas/proses_simpan.php")
	/* @POST("/data_petugas/insert") */
    Call<Object> proses_simpan_data_petugas(
            @Field("id_petugas") String id_petugas,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("jenis_kelamin") String jenis_kelamin,
            @Field("username") String username,
            @Field("password") String password,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_petugas/proses_update.php")
	/* @POST("/data_petugas/update") */
    Call<Object> proses_update_data_petugas(
            @Field("id_petugas") String id_petugas,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("jenis_kelamin") String jenis_kelamin,
            @Field("username") String username,
            @Field("password") String password,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_petugas/proses_hapus.php")
	/* @POST("/data_petugas/delete") */
    Call<Object> proses_hapus_data_petugas(
            @Field("id_petugas") String id_petugas,
			@Header("Authorization") String auth
    );


}





