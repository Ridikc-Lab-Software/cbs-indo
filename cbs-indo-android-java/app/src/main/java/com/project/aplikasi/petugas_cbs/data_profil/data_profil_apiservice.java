package com.project.aplikasi.petugas_cbs.data_profil;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_profil_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_profil/tampil.php")
	/* @POST("/data_profil/data_profil") */
    Call<data_profil_api> tampil_data_profil(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_profil/proses_simpan.php")
	/* @POST("/data_profil/insert") */
    Call<Object> proses_simpan_data_profil(
            @Field("id_profil") String id_profil,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("sejarah") String sejarah,
            @Field("visi") String visi,
            @Field("misi") String misi,
            @Field("deskripsi") String deskripsi,
            @Field("foto") String foto,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_profil/proses_update.php")
	/* @POST("/data_profil/update") */
    Call<Object> proses_update_data_profil(
            @Field("id_profil") String id_profil,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("sejarah") String sejarah,
            @Field("visi") String visi,
            @Field("misi") String misi,
            @Field("deskripsi") String deskripsi,
            @Field("foto") String foto,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_profil/proses_hapus.php")
	/* @POST("/data_profil/delete") */
    Call<Object> proses_hapus_data_profil(
            @Field("id_profil") String id_profil,
			@Header("Authorization") String auth
    );


}





