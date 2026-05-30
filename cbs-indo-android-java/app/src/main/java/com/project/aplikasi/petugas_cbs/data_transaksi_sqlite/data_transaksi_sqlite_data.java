package com.project.aplikasi.petugas_cbs.data_transaksi_sqlite;

public class data_transaksi_sqlite_data {
    private String id_transaksi;
	private String tanggal;
    private String jam;
    private String id_member;
    private String id_petugas;
    private String id_kategori_member;
    private String id_jenis_transaksi;
    private String point;
    private String jumlah;
    

    public data_transaksi_sqlite_data() {
    }

    public data_transaksi_sqlite_data(String id_transaksi
	,String tanggal
	,String jam
	,String id_member
	,String id_petugas
	,String id_kategori_member
	,String id_jenis_transaksi
	,String point
	,String jumlah
	
	
	) {
        this.id_transaksi = id_transaksi;
		this.tanggal = tanggal;
        this.jam = jam;
        this.id_member = id_member;
        this.id_petugas = id_petugas;
        this.id_kategori_member = id_kategori_member;
        this.id_jenis_transaksi = id_jenis_transaksi;
        this.point = point;
        this.jumlah = jumlah;
        
        
    }

    public String get_id_transaksi() {
        return id_transaksi;
    }
    public void set_id_transaksi(String id_transaksi) {
        this.id_transaksi = id_transaksi;
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

    public String get_id_petugas() {
        return id_petugas;
    }
    public void set_id_petugas(String id_petugas) {
        this.id_petugas = id_petugas;
    }

    public String get_id_kategori_member() {
        return id_kategori_member;
    }
    public void set_id_kategori_member(String id_kategori_member) {
        this.id_kategori_member = id_kategori_member;
    }

    public String get_id_jenis_transaksi() {
        return id_jenis_transaksi;
    }
    public void set_id_jenis_transaksi(String id_jenis_transaksi) {
        this.id_jenis_transaksi = id_jenis_transaksi;
    }

    public String get_point() {
        return point;
    }
    public void set_point(String point) {
        this.point = point;
    }

    public String get_jumlah() {
        return jumlah;
    }
    public void set_jumlah(String jumlah) {
        this.jumlah = jumlah;
    }

    
    
    
}



















