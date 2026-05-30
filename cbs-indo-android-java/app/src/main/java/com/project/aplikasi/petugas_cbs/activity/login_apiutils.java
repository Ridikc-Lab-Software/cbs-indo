package com.project.aplikasi.petugas_cbs.activity;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class login_apiutils {


    public static login_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create(login_apiservice.class);
    }
}


