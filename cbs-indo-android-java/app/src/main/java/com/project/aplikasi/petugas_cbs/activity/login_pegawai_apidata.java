package com.project.aplikasi.petugas_cbs.activity;

public class login_pegawai_apidata {
    private String username;
    private String id;
    private String printer;
    private String password;
    private String nama_pegawai;
    private String jabatan;
    private String spbu;
    private String alamat1;
    private String alamat2;
    private String telepon;
    private String penutup;
    private String tkn;


    public login_pegawai_apidata(
            String id
            ,String username
            , String password
            , String nama_pegawai
            , String jabatan
            , String spbu
            , String alamat1
            , String alamat2
            , String telepon
            , String penutup
            , String tkn

    ) {
        this.id = id;
        this.printer = printer;
        this.username = username;
        this.password = password;
        this.nama_pegawai = nama_pegawai;
        this.jabatan = jabatan;
        this.spbu = spbu;
        this.alamat1 = alamat1;
        this.alamat2 = alamat2;
        this.telepon = telepon;
        this.penutup = penutup;
        this.tkn = tkn;

    }

    public String get_id() {
        return id;
    }
    public String get_printer() {
        return printer;
    }

    public String get_username() {
        return username;
    }

    public void set_username(String username) {
        this.username = username;
    }

    public String get_password() {
        return password;
    }

    public void set_password(String password) {
        this.password = password;
    }

    public String get_nama_pegawai() {
        return nama_pegawai;
    }

    public void set_nama_pegawai(String nama_pegawai) {
        this.nama_pegawai = nama_pegawai;
    }

    public String get_jabatan() {
        return jabatan;
    }

    public void set_jabatan(String jabatan) {
        this.jabatan = jabatan;
    }


    public String get_spbu() {
        return spbu;
    }

    public void set_spbu(String spbu) {
        this.spbu = spbu;
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


    public String get_tkn() {
        return tkn;
    }

    public void set_tkn(String tkn) {
        this.tkn = tkn;
    }

}







