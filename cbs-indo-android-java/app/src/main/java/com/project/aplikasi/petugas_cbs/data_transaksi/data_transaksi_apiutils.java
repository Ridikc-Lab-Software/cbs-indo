package com.project.aplikasi.petugas_cbs.data_transaksi;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import com.project.aplikasi.petugas_cbs.config.config_apiclient_flexible;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_transaksi_apiutils {


    public static data_transaksi_apiservice getAPIService() {
        return config_apiclient_flexible.getClient(BASE_URL).create(data_transaksi_apiservice.class);
    }
}


