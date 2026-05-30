package com.project.aplikasi.petugas_cbs.data_penjualan_voucher;

import com.project.aplikasi.petugas_cbs.data_penjualan_voucher.data_penjualan_voucher_api;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_penjualan_voucher_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_penjualan_voucher/tampil.php")
	/* @POST("/data_penjualan_voucher/data_penjualan_voucher") */
    Call<data_penjualan_voucher_api> tampil_data_penjualan_voucher(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_penjualan_voucher/proses_simpan.php")
	/* @POST("/data_penjualan_voucher/insert") */
    Call<Object> proses_simpan_data_penjualan_voucher(
            @Field("id_penjualan_voucher") String id_penjualan_voucher,
                   @Field("tanggal_penjualan") String tanggal_penjualan,
                   @Field("id_relasi") String id_relasi,
                   @Field("jumlah_voucher") String jumlah_voucher,
                   @Field("nominal") String nominal,
                   @Field("password_voucher") String password_voucher,
                   @Field("tanggal_dibuka") String tanggal_dibuka,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_penjualan_voucher/proses_update.php")
	/* @POST("/data_penjualan_voucher/update") */
    Call<Object> proses_update_data_penjualan_voucher(
            @Field("id_penjualan_voucher") String id_penjualan_voucher,
                   @Field("tanggal_penjualan") String tanggal_penjualan,
                   @Field("id_relasi") String id_relasi,
                   @Field("jumlah_voucher") String jumlah_voucher,
                   @Field("nominal") String nominal,
                   @Field("password_voucher") String password_voucher,
                   @Field("tanggal_dibuka") String tanggal_dibuka,

			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_penjualan_voucher/proses_hapus.php")
	/* @POST("/data_penjualan_voucher/delete") */
    Call<Object> proses_hapus_data_penjualan_voucher(
            @Field("id_penjualan_voucher") String id_penjualan_voucher,
			@Header("Authorization") String auth
    );


}
