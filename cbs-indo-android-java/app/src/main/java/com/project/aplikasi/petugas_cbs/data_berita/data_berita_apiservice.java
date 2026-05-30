package com.project.aplikasi.petugas_cbs.data_berita;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_berita_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_berita/tampil.php")
	/* @POST("/data_berita/data_berita") */
    Call<data_berita_api> tampil_data_berita(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_berita/proses_simpan.php")
	/* @POST("/data_berita/insert") */
    Call<Object> proses_simpan_data_berita(
            @Field("id_berita") String id_berita,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_berita/proses_update.php")
	/* @POST("/data_berita/update") */
    Call<Object> proses_update_data_berita(
            @Field("id_berita") String id_berita,
			@Field("tanggal") String tanggal,
            @Field("judul") String judul,
            @Field("foto") String foto,
            @Field("isi") String isi,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_berita/proses_hapus.php")
	/* @POST("/data_berita/delete") */
    Call<Object> proses_hapus_data_berita(
            @Field("id_berita") String id_berita,
			@Header("Authorization") String auth
    );


}





