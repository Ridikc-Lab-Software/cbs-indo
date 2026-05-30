package com.project.aplikasi.petugas_cbs.data_transaksi_voucher;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import com.project.aplikasi.petugas_cbs.config.config_apiclient_voucher;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_transaksi_voucher_apiutils {


    public static data_transaksi_voucher_apiservice getAPIService() {
        return config_apiclient_voucher.getClient(BASE_URL).create(data_transaksi_voucher_apiservice.class);
    }
}
