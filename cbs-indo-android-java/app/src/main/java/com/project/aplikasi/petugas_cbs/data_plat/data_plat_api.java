package com.project.aplikasi.petugas_cbs.data_plat;

import java.util.ArrayList;

public class data_plat_api {

    private String status;

    // Nama variabel ini harus "result" karena di JSON key-nya adalah "result"
    private ArrayList<data_plat_apidata> result = null;

    // Getter & Setter Status
    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    // Getter & Setter Result
    // Nama method saya ubah dari get_data_spbu menjadi get_data_plat
    // atau getResult agar sesuai konteks
    public ArrayList<data_plat_apidata> get_data_plat() {
        return result;
    }

    public void set_data_plat(ArrayList<data_plat_apidata> result) {
        this.result = result;
    }
}