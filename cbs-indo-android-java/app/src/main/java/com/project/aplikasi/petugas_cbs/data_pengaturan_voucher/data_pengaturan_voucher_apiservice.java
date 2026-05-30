package com.project.aplikasi.petugas_cbs.data_pengaturan_voucher;

import com.project.aplikasi.petugas_cbs.data_pengaturan_voucher.data_pengaturan_voucher_api;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_pengaturan_voucher_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_pengaturan_voucher/tampil.php")
	/* @POST("/data_pengaturan_voucher/data_pengaturan_voucher") */
    Call<data_pengaturan_voucher_api> tampil_data_pengaturan_voucher(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_voucher/proses_simpan.php")
	/* @POST("/data_pengaturan_voucher/insert") */
    Call<Object> proses_simpan_data_pengaturan_voucher(
            @Field("id_pengaturan_voucher") String id_pengaturan_voucher,
                   @Field("nama") String nama,
                   @Field("isi") String isi,
                   @Field("status") String status,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_voucher/proses_update.php")
	/* @POST("/data_pengaturan_voucher/update") */
    Call<Object> proses_update_data_pengaturan_voucher(
            @Field("id_pengaturan_voucher") String id_pengaturan_voucher,
                   @Field("nama") String nama,
                   @Field("isi") String isi,
                   @Field("status") String status,

			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_voucher/proses_hapus.php")
	/* @POST("/data_pengaturan_voucher/delete") */
    Call<Object> proses_hapus_data_pengaturan_voucher(
            @Field("id_pengaturan_voucher") String id_pengaturan_voucher,
			@Header("Authorization") String auth
    );


}
