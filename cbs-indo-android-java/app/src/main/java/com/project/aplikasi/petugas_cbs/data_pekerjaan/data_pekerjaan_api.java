package com.project.aplikasi.petugas_cbs.data_pekerjaan;

import java.util.ArrayList;

public class data_pekerjaan_api {

    // Nama variabel harus sama dengan key JSON PHP ($resp["status"] & $resp["result"])
    private String status;
    private ArrayList<data_pekerjaan_apidata> result = null;

    // Getter untuk Status
    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    // Getter untuk Result (List Data)
    // Nama method ini saya biarkan get_data_pekerjaan agar tidak merusak kodingan di Activity kamu
    public ArrayList<data_pekerjaan_apidata> get_data_pekerjaan() {
        return result;
    }

    public void set_data_pekerjaan(ArrayList<data_pekerjaan_apidata> result) {
        this.result = result;
    }
}