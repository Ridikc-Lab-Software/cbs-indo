package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_group_jenis_transaksi_apiutils {


    public static data_group_jenis_transaksi_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_group_jenis_transaksi_apiservice.class);
    }
}


