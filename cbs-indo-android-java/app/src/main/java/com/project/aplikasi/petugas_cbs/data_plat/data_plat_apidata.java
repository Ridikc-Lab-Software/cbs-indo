package com.project.aplikasi.petugas_cbs.data_plat;

public class data_plat_apidata {

    // Nama variabel disesuaikan dengan key JSON target
    private String id_plat;
    private String plat;
    private String id_relasi;

    // Constructor kosong
    public data_plat_apidata() {
    }

    // Constructor lengkap
    public data_plat_apidata(String id_plat, String plat, String id_relasi) {
        this.id_plat = id_plat;
        this.plat = plat;
        this.id_relasi = id_relasi;
    }

    // --- GETTER & SETTER ---

    public String get_id_plat() {
        return id_plat;
    }

    public void set_id_plat(String id_plat) {
        this.id_plat = id_plat;
    }

    public String get_plat() {
        return plat;
    }

    public void set_plat(String plat) {
        this.plat = plat;
    }

    public String get_id_relasi() {
        return id_relasi;
    }

    public void set_id_relasi(String id_relasi) {
        this.id_relasi = id_relasi;
    }
}