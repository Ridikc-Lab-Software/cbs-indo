package com.project.aplikasi.petugas_cbs.data_event;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_event_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_event/tampil.php")
	/* @POST("/data_event/data_event") */
    Call<data_event_api> tampil_data_event(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_event/proses_simpan.php")
	/* @POST("/data_event/insert") */
    Call<Object> proses_simpan_data_event(
            @Field("id_event") String id_event,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_event/proses_update.php")
	/* @POST("/data_event/update") */
    Call<Object> proses_update_data_event(
            @Field("id_event") String id_event,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_event/proses_hapus.php")
	/* @POST("/data_event/delete") */
    Call<Object> proses_hapus_data_event(
            @Field("id_event") String id_event,
			@Header("Authorization") String auth
    );


}





