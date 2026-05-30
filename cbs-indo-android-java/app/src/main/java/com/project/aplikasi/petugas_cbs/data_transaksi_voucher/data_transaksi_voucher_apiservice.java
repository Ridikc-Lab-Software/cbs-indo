package com.project.aplikasi.petugas_cbs.data_transaksi_voucher;

import com.project.aplikasi.petugas_cbs.data_transaksi_voucher.data_transaksi_voucher_api;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_transaksi_voucher_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_transaksi_voucher/tampil.php")
	/* @POST("/data_transaksi_voucher/data_transaksi_voucher") */
    Call<data_transaksi_voucher_api> tampil_data_transaksi_voucher(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi_voucher/proses_simpan.php")
	/* @POST("/data_transaksi_voucher/insert") */
    Call<Object> proses_simpan_data_transaksi_voucher(
            @Field("id_transaksi_voucher") String id_transaksi_voucher,
            @Field("id_sisa_voucher") String id_sisa_voucher,
            @Field("id_voucher") String id_voucher,
            @Field("id_member") String id_member,
            @Field("nama_member") String nama_member,
            @Field("tanggal_transaksi") String tanggal_transaksi,
            @Field("jenis_bbm") String jenis_bbm,
            @Field("nominal") String nominal,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi_voucher/proses_update.php")
	/* @POST("/data_transaksi_voucher/update") */
    Call<Object> proses_update_data_transaksi_voucher(
            @Field("id_transaksi_voucher") String id_transaksi_voucher,
            @Field("id_voucher") String id_voucher,
            @Field("id_member") String id_member,
            @Field("nama_member") String nama_member,
            @Field("tanggal_transaksi") String tanggal_transaksi,
            @Field("jenis_bbm") String jenis_bbm,
            @Field("nominal") String nominal,

			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi_voucher/proses_hapus.php")
	/* @POST("/data_transaksi_voucher/delete") */
    Call<Object> proses_hapus_data_transaksi_voucher(
            @Field("id_transaksi_voucher") String id_transaksi_voucher,
			@Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi_voucher/print.php")
	/* @POST("/data_transaksi_voucher/delete") */
    Call<ResponseBody> print_transaksi_voucher(
            @Field("id_transaksi") String idTransaksi,
            @Field("id_voucher") String idVoucher,
            @Field("waktu") String waktu,
            @Field("product") String product,
            @Field("total") String total,
            @Field("operator") String operator,
            @Field("nopol") String nopol,
            @Field("id_supir") String id_supir,
            @Field("kategori") String kategori,
            @Field("nominal_voucher") String nominal_voucher,
            @Field("liter") String liter
    );




}
