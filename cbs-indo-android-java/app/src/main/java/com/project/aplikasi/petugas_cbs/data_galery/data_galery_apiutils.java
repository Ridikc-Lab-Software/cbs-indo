package com.project.aplikasi.petugas_cbs.data_galery;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_galery_apiutils {


    public static data_galery_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_galery_apiservice.class);
    }
}


