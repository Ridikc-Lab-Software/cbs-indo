package com.project.aplikasi.petugas_cbs.combobox_data_petugas;

import retrofit2.Call;
import retrofit2.http.POST;

public interface combobox_data_petugas_apiservice {

    @POST("api/include/combobox/data_petugas.php")
    Call<combobox_data_petugas_api> api(
            
    );

}







