package com.project.aplikasi.petugas_cbs.data_spbu;

import java.util.ArrayList;

public class data_spbu_api {

    private String status;
    private ArrayList<data_spbu_apidata> result = null;

    // Getter & Setter Status
    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    // Getter & Setter Result
    // Saya ubah namanya jadi get_data_spbu agar tidak tertukar dengan pekerjaan
    public ArrayList<data_spbu_apidata> get_data_spbu() {
        return result;
    }

    public void set_data_spbu(ArrayList<data_spbu_apidata> result) {
        this.result = result;
    }
}