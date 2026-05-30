package com.project.aplikasi.petugas_cbs.data_pengaturan_point;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_pengaturan_point_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_pengaturan_point/tampil.php")
	/* @POST("/data_pengaturan_point/data_pengaturan_point") */
    Call<data_pengaturan_point_api> tampil_data_pengaturan_point(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_point/proses_simpan.php")
	/* @POST("/data_pengaturan_point/insert") */
    Call<Object> proses_simpan_data_pengaturan_point(
            @Field("id_pengaturan_point") String id_pengaturan_point,
			@Field("nama_pengaturan") String nama_pengaturan,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("point") String point,
            
			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_point/proses_update.php")
	/* @POST("/data_pengaturan_point/update") */
    Call<Object> proses_update_data_pengaturan_point(
            @Field("id_pengaturan_point") String id_pengaturan_point,
			@Field("nama_pengaturan") String nama_pengaturan,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("id_jenis_transaksi") String id_jenis_transaksi,
            @Field("point") String point,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_pengaturan_point/proses_hapus.php")
	/* @POST("/data_pengaturan_point/delete") */
    Call<Object> proses_hapus_data_pengaturan_point(
            @Field("id_pengaturan_point") String id_pengaturan_point,
			@Header("Authorization") String auth
    );


}





