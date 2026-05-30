package com.project.aplikasi.petugas_cbs.data_spbu;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

import com.project.aplikasi.petugas_cbs.config.config_apiclient_voucher;

public class data_spbu_apiutils {


    public static data_spbu_apiservice getAPIService() {
        return config_apiclient_voucher.getClient(BASE_URL).create( data_spbu_apiservice.class);
    }
}


