package com.project.aplikasi.petugas_cbs.combobox_data_jenis_transaksi;

import retrofit2.Call;
import retrofit2.http.POST;

public interface combobox_data_jenis_transaksi_apiservice {

    @POST("api/include/combobox/data_jenis_transaksi.php")
    Call<combobox_data_jenis_transaksi_api> api();
}







