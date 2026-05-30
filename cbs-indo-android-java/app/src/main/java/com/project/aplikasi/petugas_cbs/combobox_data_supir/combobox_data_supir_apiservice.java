package com.project.aplikasi.petugas_cbs.combobox_data_supir;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface combobox_data_supir_apiservice {

    @FormUrlEncoded
    @POST("api/app/page/data_supir/tampil.php")
    Call<combobox_data_supir_api> api(
            @Field("berdasarkan") String pencarian,
            @Field("isi") String isi,
            @Field("limit") String limit,
            @Field("hal") String hal,
            @Field("dari") String dari,
            @Field("sampai") String sampai,
            @Header("Authorization") String auth
    );
}






