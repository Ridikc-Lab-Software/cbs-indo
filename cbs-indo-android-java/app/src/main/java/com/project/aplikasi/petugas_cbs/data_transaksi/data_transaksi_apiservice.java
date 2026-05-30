package com.project.aplikasi.petugas_cbs.data_transaksi;

import java.util.List;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Query;

public interface data_transaksi_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_transaksi/tampil.php")
	/* @POST("/data_transaksi/data_transaksi") */
    Call<data_transaksi_api> tampil_data_transaksi(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi/proses_simpan.php")
	/* @POST("/data_transaksi/insert") */
    Call<Object> proses_simpan_data_transaksi(
            @Field("id_transaksi") String id_transaksi,
			@Field("tanggal") String tanggal,
            @Field("jam") String jam,
            @Field("id_member") String id_member,
            @Field("id_petugas") String id_petugas,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("point") String point,
            @Field("jumlah") String jumlah,
            
			@Header("Authorization") String auth							 
    );


    // untuk di e-voucher
    @Multipart // <--- Ganti FormUrlEncoded jadi Multipart
    @POST("api/app/page/data_transaksi/proses_simpan.php")
    Call<Object> proses_simpan_data_transaksi(
            @Part("id_transaksi") RequestBody id_transaksi,
            @Part("tanggal") RequestBody tanggal,
            @Part("jam") RequestBody jam,
            @Part("id_member") RequestBody id_member,
            @Part("id_petugas") RequestBody id_petugas,
            @Part("id_kategori_member") RequestBody id_kategori_member,
            @Part("id_jenis_transaksi") RequestBody id_jenis_transaksi,
            @Part("point") RequestBody point,
            @Part("jumlah") RequestBody jumlah,
            @Header("Authorization") String auth, // Header tetap sama
            @Part("id_voucher") RequestBody id_voucher,
            @Part("aksi") RequestBody aksi,
            @Part("plat_kendaraan") RequestBody platKendaraan,
            @Part("id_supir") RequestBody id_supir,
            @Part("id_relasi") RequestBody id_relasi,

            // --- BAGIAN FOTO (LIST) ---
            // Gunakan List<MultipartBody.Part> untuk mengirim banyak foto
            @Part List<MultipartBody.Part> foto
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi/proses_update.php")
	/* @POST("/data_transaksi/update") */
    Call<Object> proses_update_data_transaksi(
            @Field("id_transaksi") String id_transaksi,
			@Field("tanggal") String tanggal,
            @Field("jam") String jam,
            @Field("id_member") String id_member,
            @Field("id_petugas") String id_petugas,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("point") String point,
            @Field("jumlah") String jumlah,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_transaksi/proses_hapus.php")
	/* @POST("/data_transaksi/delete") */
    Call<Object> proses_hapus_data_transaksi(
            @Field("id_transaksi") String id_transaksi,
			@Header("Authorization") String auth
    );

    @GET("api/app/page/data_transaksi/print.php")
    Call<TransaksiPrintResponse> get_print_template(
            @Query("id_transaksi") String id_transaksi,
            @Query("nama") String nama,
            @Query("point_awal") String point_awal,
            @Query("point") String point,
            @Query("jenis_transaksi") String jenis_transaksi,
            @Query("kategori_member") String kategori_member,
            @Query("tambahan_point") String tambahan_point,
            @Query("jumlah") String jumlah,
            @Query("operator") String operator,
            @Query("kategori") String kategori

    );

}








