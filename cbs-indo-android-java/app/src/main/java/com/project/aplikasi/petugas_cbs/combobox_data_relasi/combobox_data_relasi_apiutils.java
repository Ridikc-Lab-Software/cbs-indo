package com.project.aplikasi.petugas.combobox_data_relasi;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;
import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class combobox_data_relasi_apiutils {
    public static combobox_data_relasi_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create(combobox_data_relasi_apiservice.class);
    }
}


