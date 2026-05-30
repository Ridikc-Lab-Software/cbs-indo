package com.project.aplikasi.petugas_cbs.data_galery;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_galery_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_galery/tampil.php")
	/* @POST("/data_galery/data_galery") */
    Call<data_galery_api> tampil_data_galery(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_galery/proses_simpan.php")
	/* @POST("/data_galery/insert") */
    Call<Object> proses_simpan_data_galery(
            @Field("id_galery") String id_galery,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_galery/proses_update.php")
	/* @POST("/data_galery/update") */
    Call<Object> proses_update_data_galery(
            @Field("id_galery") String id_galery,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_galery/proses_hapus.php")
	/* @POST("/data_galery/delete") */
    Call<Object> proses_hapus_data_galery(
            @Field("id_galery") String id_galery,
			@Header("Authorization") String auth
    );


}





