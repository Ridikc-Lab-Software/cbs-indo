package com.project.aplikasi.petugas_cbs.combobox_data_supir;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

public class combobox_data_supir_apiutils {

    // Gunakan BASE_URL_VOUCHER karena API supir ada di evoucher
    public static combobox_data_supir_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create(combobox_data_supir_apiservice.class);
    }
}