package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi;

public class data_group_jenis_transaksi_apidata {
    private String id_group_jenis_transaksi;
	private String nama_group;
	private String id_jenis_transaksi;
	private String gambar_logo;
	
	
	
	public data_group_jenis_transaksi_apidata(String id_group_jenis_transaksi
	, String nama_group
	, String id_jenis_transaksi
	, String gambar_logo
	
	) {
        this.id_group_jenis_transaksi = id_group_jenis_transaksi;
		this.nama_group = nama_group;
        this.id_jenis_transaksi = id_jenis_transaksi;
        this.gambar_logo = gambar_logo;
        
    }

    public String get_id_group_jenis_transaksi() {
        return id_group_jenis_transaksi;
    }
    public void set_id_group_jenis_transaksi(String id_group_jenis_transaksi) {
        this.id_group_jenis_transaksi = id_group_jenis_transaksi;
    }

    public String get_nama_group() {
        return nama_group;
    }
    public void set_nama_group(String nama_group) {
        this.nama_group = nama_group;
    }
    public String get_id_jenis_transaksi() {
        return id_jenis_transaksi;
    }
    public void set_id_jenis_transaksi(String id_jenis_transaksi) {
        this.id_jenis_transaksi = id_jenis_transaksi;
    }
    public String get_gambar_logo() {
        return gambar_logo;
    }
    public void set_gambar_logo(String gambar_logo) {
        this.gambar_logo = gambar_logo;
    }
    
}







