package com.project.aplikasi.petugas_cbs.data_jenis_transaksi;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import com.project.aplikasi.petugas_cbs.config.config_apiclient_voucher;

/**
 * Kelas ini digunakan untuk mengakses API data_jenis_transaksi di server e-voucher
 */
public class voucher_data_jenis_transaksi_apiutils {
    /**
     * Method ini digunakan untuk mendapatkan instance dari data_jenis_transaksi_apiservice
     * @return instance dari data_jenis_transaksi_apiservice
     */
    public static data_jenis_transaksi_apiservice getAPIService() {
        return config_apiclient_voucher.getClient(BASE_URL).create( data_jenis_transaksi_apiservice.class);
    }
}

