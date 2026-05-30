package com.project.aplikasi.petugas_cbs.data_voucher;

import com.project.aplikasi.petugas_cbs.data_voucher.data_voucher_api;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface    data_voucher_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_voucher/tampil.php")
	/* @POST("/data_voucher/data_voucher") */
    Call<data_voucher_api> tampil_data_voucher(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_voucher/proses_simpan.php")
	/* @POST("/data_voucher/insert") */
    Call<Object> proses_simpan_data_voucher(
            @Field("id_voucher") String id_voucher,
                   @Field("qrcode") String qrcode,
                   @Field("id_relasi") String id_relasi,
                   @Field("nominal") String nominal,
                   @Field("tanggal_kadaluarsa") String tanggal_kadaluarsa,
                   @Field("id_spbu") String id_spbu,
                   @Field("id_penjualan_voucher") String id_penjualan_voucher,
                   @Field("status") String status,
                   @Field("file_voucher") String file_voucher,
                   @Field("tanggal_dibuka") String tanggal_dibuka,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_voucher/proses_update.php")
	/* @POST("/data_voucher/update") */
    Call<Object> proses_update_data_voucher(
            @Field("id_voucher") String id_voucher,
                   @Field("qrcode") String qrcode,
                   @Field("id_relasi") String id_relasi,
                   @Field("nominal") String nominal,
                   @Field("tanggal_kadaluarsa") String tanggal_kadaluarsa,
                   @Field("id_spbu") String id_spbu,
                   @Field("id_penjualan_voucher") String id_penjualan_voucher,
                   @Field("status") String status,
                   @Field("file_voucher") String file_voucher,
                   @Field("tanggal_dibuka") String tanggal_dibuka,

			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_voucher/proses_hapus.php")
	/* @POST("/data_voucher/delete") */
    Call<Object> proses_hapus_data_voucher(
            @Field("id_voucher") String id_voucher,
			@Header("Authorization") String auth
    );


}
