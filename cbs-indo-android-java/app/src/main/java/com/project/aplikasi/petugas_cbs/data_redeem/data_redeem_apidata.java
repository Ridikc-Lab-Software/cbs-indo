package com.project.aplikasi.petugas_cbs.data_redeem;

public class data_redeem_apidata {
    private String id_redeem;
    private String tanggal;
    private String jam;
    private String id_member;
    private String id_mitra;
    private String id_promo;
    private String point;
    private String status;

    public data_redeem_apidata(String id_redeem,
                               String tanggal,
                               String jam,
                               String id_member,
                               String id_mitra,
                               String id_promo,
                               String point,
                               String status) {
        this.id_redeem = id_redeem;
        this.tanggal = tanggal;
        this.jam = jam;
        this.id_member = id_member;
        this.id_mitra = id_mitra;
        this.id_promo = id_promo;
        this.point = point;
        this.status = status;
    }

    public String get_id_redeem() {
        return id_redeem;
    }

    public void set_id_redeem(String id_redeem) {
        this.id_redeem = id_redeem;
    }

    public String get_tanggal() {
        return tanggal;
    }

    public void set_tanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String get_jam() {
        return jam;
    }

    public void set_jam(String jam) {
        this.jam = jam;
    }

    public String get_id_member() {
        return id_member;
    }

    public void set_id_member(String id_member) {
        this.id_member = id_member;
    }

    public String get_id_mitra() {
        return id_mitra;
    }

    public void set_id_mitra(String id_mitra) {
        this.id_mitra = id_mitra;
    }

    public String get_id_promo() {
        return id_promo;
    }

    public void set_id_promo(String id_promo) {
        this.id_promo = id_promo;
    }

    public String get_point() {
        return point;
    }

    public void set_point(String point) {
        this.point = point;
    }

    public String get_status() {
        return status;
    }

    public void set_status(String status) {
        this.status = status;
    }
}


