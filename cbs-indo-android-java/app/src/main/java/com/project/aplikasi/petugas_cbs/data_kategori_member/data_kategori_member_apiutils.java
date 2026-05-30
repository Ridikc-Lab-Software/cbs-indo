package com.project.aplikasi.petugas_cbs.data_kategori_member;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_kategori_member_apiutils {


    public static data_kategori_member_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_kategori_member_apiservice.class);
    }
}


