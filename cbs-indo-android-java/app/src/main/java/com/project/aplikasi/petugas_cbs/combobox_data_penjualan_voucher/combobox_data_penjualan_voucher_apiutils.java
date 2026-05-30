package com.project.aplikasi.petugas.combobox_data_penjualan_voucher;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class combobox_data_penjualan_voucher_apiutils {
    public static combobox_data_penjualan_voucher_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create(combobox_data_penjualan_voucher_apiservice.class);
    }
}


