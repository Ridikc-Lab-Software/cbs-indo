package com.project.aplikasi.petugas_cbs.data_member;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface data_member_apiservice {
    
	@FormUrlEncoded
    @POST("api/app/page/data_member/tampil.php")
	/* @POST("/data_member/data_member") */
    Call<data_member_api> tampil_data_member(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );

    @FormUrlEncoded
    @POST("api/app/page/data_member/proses_simpan.php")
	/* @POST("/data_member/insert") */
    Call<Object> proses_simpan_data_member(
            @Field("id_member") String id_member,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("jenis_kelamin") String jenis_kelamin,
            @Field("tanggal_terdaftar") String tanggal_terdaftar,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("kode_rfid") String kode_rfid,
            @Field("point") String point,
            @Field("username") String username,
            @Field("password") String password,
            @Field("tanggal_lahir") String tanggal_lahir,
            @Field("agama") String agama,
            @Field("id_pekerjaan") String id_pekerjaan,
            @Field("id_spbu") String id_spbu,

			@Header("Authorization") String auth							 
    );

    @FormUrlEncoded
    @POST("api/app/page/data_member/proses_update.php")
	/* @POST("/data_member/update") */
    Call<Object> proses_update_data_member(
            @Field("id_member") String id_member,
			@Field("nama") String nama,
            @Field("alamat") String alamat,
            @Field("no_telepon") String no_telepon,
            @Field("jenis_kelamin") String jenis_kelamin,
            @Field("tanggal_terdaftar") String tanggal_terdaftar,
            @Field("id_kategori_member") String id_kategori_member,
            @Field("kode_rfid") String kode_rfid,
            @Field("point") String point,
            @Field("username") String username,
            @Field("password") String password,
            
			@Header("Authorization") String auth								
    );

    @FormUrlEncoded
    @POST("api/app/page/data_member/proses_hapus.php")
	/* @POST("/data_member/delete") */
    Call<Object> proses_hapus_data_member(
            @Field("id_member") String id_member,
			@Header("Authorization") String auth
    );


}





