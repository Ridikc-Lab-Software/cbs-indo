package com.project.aplikasi.petugas_cbs.data_relasi;

import com.project.aplikasi.petugas_cbs.data_relasi.data_relasi_api;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_relasi_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_relasi/tampil.php")
	/* @POST("/data_relasi/data_relasi") */
    Call<data_relasi_api> tampil_data_relasi(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_relasi/proses_simpan.php")
	/* @POST("/data_relasi/insert") */
    Call<Object> proses_simpan_data_relasi(
            @Field("id_relasi") String id_relasi,
                   @Field("nama") String nama,
                   @Field("nomor_telepon") String nomor_telepon,
                   @Field("email") String email,
                   @Field("alamat") String alamat,
                   @Field("id_spbu") String id_spbu,
                   @Field("nama_spbu") String nama_spbu,
                   @Field("password") String password,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_relasi/proses_update.php")
	/* @POST("/data_relasi/update") */
    Call<Object> proses_update_data_relasi(
            @Field("id_relasi") String id_relasi,
                   @Field("nama") String nama,
                   @Field("nomor_telepon") String nomor_telepon,
                   @Field("email") String email,
                   @Field("alamat") String alamat,
                   @Field("id_spbu") String id_spbu,
                   @Field("nama_spbu") String nama_spbu,
                   @Field("password") String password,

			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_relasi/proses_hapus.php")
	/* @POST("/data_relasi/delete") */
    Call<Object> proses_hapus_data_relasi(
            @Field("id_relasi") String id_relasi,
			@Header("Authorization") String auth
    );


}
