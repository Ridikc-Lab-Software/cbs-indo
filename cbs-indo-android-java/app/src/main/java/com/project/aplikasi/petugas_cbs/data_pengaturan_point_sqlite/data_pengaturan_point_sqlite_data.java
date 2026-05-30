package com.project.aplikasi.petugas_cbs.data_pengaturan_point_sqlite;

public class data_pengaturan_point_sqlite_data {
    private String id_pengaturan_point;
	private String nama_pengaturan;
    private String id_kategori_member;
    private String id_jenis_transaksi;
    private String point;
    

    public data_pengaturan_point_sqlite_data() {
    }

    public data_pengaturan_point_sqlite_data(String id_pengaturan_point
	,String nama_pengaturan
	,String id_kategori_member
	,String id_jenis_transaksi
	,String point
	
	
	) {
        this.id_pengaturan_point = id_pengaturan_point;
		this.nama_pengaturan = nama_pengaturan;
        this.id_kategori_member = id_kategori_member;
        this.id_jenis_transaksi = id_jenis_transaksi;
        this.point = point;
        
        
    }

    public String get_id_pengaturan_point() {
        return id_pengaturan_point;
    }
    public void set_id_pengaturan_point(String id_pengaturan_point) {
        this.id_pengaturan_point = id_pengaturan_point;
    }

	public String get_nama_pengaturan() {
        return nama_pengaturan;
    }
    public void set_nama_pengaturan(String nama_pengaturan) {
        this.nama_pengaturan = nama_pengaturan;
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

    
    
    
}














