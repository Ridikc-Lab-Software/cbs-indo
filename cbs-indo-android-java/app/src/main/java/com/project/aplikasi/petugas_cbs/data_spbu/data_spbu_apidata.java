package com.project.aplikasi.petugas_cbs.data_spbu;

public class data_spbu_apidata {

    // Nama variabel harus SAMA PERSIS dengan key di PHP ($hasil['...'])
    private String id_spbu;
    private String nama_spbu;
    private String alamat1;
    private String alamat2;
    private String telepon;
    private String penutup;

    // Constructor kosong
    public data_spbu_apidata() {
    }

    // Constructor lengkap
    public data_spbu_apidata(String id_spbu, String nama_spbu, String alamat1, String alamat2, String telepon, String penutup) {
        this.id_spbu = id_spbu;
        this.nama_spbu = nama_spbu;
        this.alamat1 = alamat1;
        this.alamat2 = alamat2;
        this.telepon = telepon;
        this.penutup = penutup;
    }

    // --- GETTER & SETTER ---

    public String get_id_spbu() {
        return id_spbu;
    }

    public void set_id_spbu(String id_spbu) {
        this.id_spbu = id_spbu;
    }

    public String get_nama_spbu() {
        return nama_spbu;
    }

    public void set_nama_spbu(String nama_spbu) {
        this.nama_spbu = nama_spbu;
    }

    public String get_alamat1() {
        return alamat1;
    }

    public void set_alamat1(String alamat1) {
        this.alamat1 = alamat1;
    }

    public String get_alamat2() {
        return alamat2;
    }

    public void set_alamat2(String alamat2) {
        this.alamat2 = alamat2;
    }

    public String get_telepon() {
        return telepon;
    }

    public void set_telepon(String telepon) {
        this.telepon = telepon;
    }

    public String get_penutup() {
        return penutup;
    }

    public void set_penutup(String penutup) {
        this.penutup = penutup;
    }
}