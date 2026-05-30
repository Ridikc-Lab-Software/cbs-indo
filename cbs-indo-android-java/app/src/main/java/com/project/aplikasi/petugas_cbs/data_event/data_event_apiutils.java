package com.project.aplikasi.petugas_cbs.data_event;

import com.project.aplikasi.petugas_cbs.config.config_apiclient;

import static com.project.aplikasi.petugas_cbs.config.config_global.BASE_URL;

public class data_event_apiutils {


    public static data_event_apiservice getAPIService() {
        return config_apiclient.getClient(BASE_URL).create( data_event_apiservice.class);
    }
}


