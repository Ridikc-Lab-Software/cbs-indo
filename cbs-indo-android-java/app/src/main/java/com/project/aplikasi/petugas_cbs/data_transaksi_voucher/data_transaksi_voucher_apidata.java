package com.project.aplikasi.petugas_cbs.data_transaksi_voucher;

import java.text.NumberFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class data_transaksi_voucher_apidata {
    private String id_transaksi_voucher;
    private String id_voucher;
    private String id_member;
    private String nama_member;
    /*
     * date format: yyyy-mm-dd HH:mm:ss
     */
    private String tanggal_transaksi;
    private String jenis_bbm;
    private String nominal;
    private String petugas;

    public data_transaksi_voucher_apidata(String id_transaksi_voucher, String id_voucher, String id_member, String nama_member, String tanggal_transaksi, String jenis_bbm, String nominal, String petugas) {
        this.id_transaksi_voucher = id_transaksi_voucher;
        this.id_voucher = id_voucher;
        this.id_member = id_member;
        this.nama_member = nama_member;
        this.tanggal_transaksi = tanggal_transaksi;
        this.jenis_bbm = jenis_bbm;
        this.nominal = nominal;
        this.petugas = petugas;
    }

    public data_transaksi_voucher_apidata(String id_transaksi_voucher
            , String id_voucher
            , String id_member
            , String nama_member
            , String tanggal_transaksi
            , String jenis_bbm
            , String nominal

    ) {
        this.id_transaksi_voucher = id_transaksi_voucher;
        this.id_voucher = id_voucher;
        this.id_member = id_member;
        this.nama_member = nama_member;
        this.tanggal_transaksi = tanggal_transaksi;
        this.jenis_bbm = jenis_bbm;
        this.nominal = nominal;

    }

    public String get_id_transaksi_voucher() {
        return id_transaksi_voucher;
    }

    public void set_id_transaksi_voucher(String id_transaksi_voucher) {
        this.id_transaksi_voucher = id_transaksi_voucher;
    }

    public String get_id_voucher() {
        return id_voucher;
    }

    public void set_id_voucher(String id_voucher) {
        this.id_voucher = id_voucher;
    }

    public String get_id_member() {
        return id_member;
    }

    public void set_id_member(String id_member) {
        this.id_member = id_member;
    }

    public String get_nama_member() {
        return nama_member;
    }

    public void set_nama_member(String nama_member) {
        this.nama_member = nama_member;
    }

    public String get_tanggal_transaksi() {
        return tanggal_transaksi;
    }

    /*
     * return date format: senin, 1 januari 2020 00:00
     */
    public String get_tanggal_transaksi_indo() {
        Date tanggal = new Date();
        SimpleDateFormat sdf = new SimpleDateFormat("EEEE, d MMMM yyyy HH:mm", new Locale("id", "ID"));
        return sdf.format(tanggal);
    }



    public void set_tanggal_transaksi(String tanggal_transaksi) {
        this.tanggal_transaksi = tanggal_transaksi;
    }

    public String get_jenis_bbm() {
        return jenis_bbm;
    }

    public void set_jenis_bbm(String jenis_bbm) {
        this.jenis_bbm = jenis_bbm;
    }

    public String get_nominal() {
        return nominal;
    }

    public String getNominalRupiah() {
        Locale localeID;
        try {
            localeID = new Locale("in", "ID");
        } catch (Exception e) {
            localeID = Locale.getDefault();
        }
        NumberFormat formatRupiah;
        try {
            formatRupiah = NumberFormat.getCurrencyInstance(localeID);
            formatRupiah.setMaximumFractionDigits(0);
        } catch (Exception e) {
            formatRupiah = NumberFormat.getInstance();
        }
        try {
            return formatRupiah.format((double) Integer.parseInt(nominal));
        } catch (NumberFormatException e) {
            return nominal;
        }
    }

    public void set_nominal(String nominal) {
        this.nominal = nominal;
    }

    public String getPetugas() {
        return this.petugas;
    }
}
