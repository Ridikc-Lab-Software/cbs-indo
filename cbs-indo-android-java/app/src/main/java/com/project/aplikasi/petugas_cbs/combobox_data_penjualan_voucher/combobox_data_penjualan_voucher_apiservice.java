package com.project.aplikasi.petugas.combobox_data_penjualan_voucher;

import retrofit2.Call;
import retrofit2.http.POST;

public interface combobox_data_penjualan_voucher_apiservice {

    @POST("api/include/combobox/data_penjualan_voucher.php")
    Call<combobox_data_penjualan_voucher_api> api();
}





