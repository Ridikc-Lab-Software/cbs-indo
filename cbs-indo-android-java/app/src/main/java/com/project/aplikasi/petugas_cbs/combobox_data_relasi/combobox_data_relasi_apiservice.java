package com.project.aplikasi.petugas.combobox_data_relasi;

import retrofit2.Call;
import retrofit2.http.POST;

public interface combobox_data_relasi_apiservice {

    @POST("api/include/combobox/data_relasi.php")
    Call<combobox_data_relasi_api> api();
}





