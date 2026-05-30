package com.project.aplikasi.petugas_cbs.data_promo;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_promo_apiutils {


    public static data_promo_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_promo_apiservice.class);
    }
}


