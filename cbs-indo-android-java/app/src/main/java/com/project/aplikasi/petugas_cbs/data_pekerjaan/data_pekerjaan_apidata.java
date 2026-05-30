package com.project.aplikasi.petugas_cbs.data_pekerjaan;

public class data_pekerjaan_apidata {

    // Sesuaikan nama variabel ini PERSIS dengan key di PHP ($hasil['...'])
    private String id_pekerjaan;
    private String nama;

    // Constructor kosong (Penting untuk library JSON converter seperti GSON/Retrofit)
    public data_pekerjaan_apidata() {
    }

    // Constructor dengan parameter
    public data_pekerjaan_apidata(String id_pekerjaan, String nama) {
        this.id_pekerjaan = id_pekerjaan;
        this.nama = nama;
    }

    // Getter dan Setter
    public String get_id_pekerjaan() {
        return id_pekerjaan;
    }

    public void set_id_pekerjaan(String id_pekerjaan) {
        this.id_pekerjaan = id_pekerjaan;
    }

    public String get_nama() {
        return nama;
    }

    public void set_nama(String nama) {
        this.nama = nama;
    }
}