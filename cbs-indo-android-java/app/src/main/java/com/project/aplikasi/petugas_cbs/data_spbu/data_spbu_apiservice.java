package com.project.aplikasi.petugas_cbs.data_spbu;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_spbu_apiservice {

    @GET("api/app/page/data_spbu/tampil.php")
	/* @POST("/data_mitra/data_mitra") */
    Call<data_spbu_api> tampil_data_spbu();
//
//    @FormUrlEncoded
//    @POST("api/app/page/data_mitra/proses_simpan.php")
//	/* @POST("/data_mitra/insert") */
//    Call<Object> proses_simpan_data_mitra(
//            @Field("id_mitra") String id_mitra,
//			@Field("nama_mitra") String nama_mitra,
//            @Field("alamat") String alamat,
//            @Field("no_telepon") String no_telepon,
//            @Field("nama_pemilik") String nama_pemilik,
//            @Field("no_telepon_pemilik") String no_telepon_pemilik,
//            @Field("tanggal_daftar") String tanggal_daftar,
//            @Field("username") String username,
//            @Field("password") String password,
//            @Field("status") String status,
//            @Field("gambar_logo") String gambar_logo,
//
//			@Header("Authorization") String auth
//    );
//
//    @FormUrlEncoded
//    @POST("api/app/page/data_mitra/proses_update.php")
//	/* @POST("/data_mitra/update") */
//    Call<Object> proses_update_data_mitra(
//            @Field("id_mitra") String id_mitra,
//			@Field("nama_mitra") String nama_mitra,
//            @Field("alamat") String alamat,
//            @Field("no_telepon") String no_telepon,
//            @Field("nama_pemilik") String nama_pemilik,
//            @Field("no_telepon_pemilik") String no_telepon_pemilik,
//            @Field("tanggal_daftar") String tanggal_daftar,
//            @Field("username") String username,
//            @Field("password") String password,
//            @Field("status") String status,
//            @Field("gambar_logo") String gambar_logo,
//
//			@Header("Authorization") String auth
//    );
//
//    @FormUrlEncoded
//    @POST("api/app/page/data_mitra/proses_hapus.php")
//	/* @POST("/data_mitra/delete") */
//    Call<Object> proses_hapus_data_mitra(
//            @Field("id_mitra") String id_mitra,
//			@Header("Authorization") String auth
//    );
//

}





