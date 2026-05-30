package com.project.aplikasi.petugas_cbs.data_profil;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_profil_apiutils {


    public static data_profil_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_profil_apiservice.class);
    }
}


