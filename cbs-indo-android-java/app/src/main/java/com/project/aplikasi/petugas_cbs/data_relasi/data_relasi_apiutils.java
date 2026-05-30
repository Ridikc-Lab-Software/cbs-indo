package com.project.aplikasi.petugas_cbs.data_relasi;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_relasi_apiutils {


    public static data_relasi_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_relasi_apiservice.class);
    }
}
