package com.project.aplikasi.petugas_cbs.data_redeem;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_redeem_apiutils {


    public static data_redeem_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_redeem_apiservice.class);
    }
}


