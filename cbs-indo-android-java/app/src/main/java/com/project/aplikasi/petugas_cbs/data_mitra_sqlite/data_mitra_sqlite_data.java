package com.project.aplikasi.petugas_cbs.data_mitra_sqlite;

public class data_mitra_sqlite_data {
    private String id_mitra;
	private String nama_mitra;
    private String alamat;
    private String no_telepon;
    private String nama_pemilik;
    private String no_telepon_pemilik;
    private String tanggal_daftar;
    private String username;
    private String password;
    private String status;
    private String gambar_logo;
    

    public data_mitra_sqlite_data() {
    }

    public data_mitra_sqlite_data(String id_mitra
	,String nama_mitra
	,String alamat
	,String no_telepon
	,String nama_pemilik
	,String no_telepon_pemilik
	,String tanggal_daftar
	,String username
	,String password
	,String status
	,String gambar_logo
	
	
	) {
        this.id_mitra = id_mitra;
		this.nama_mitra = nama_mitra;
        this.alamat = alamat;
        this.no_telepon = no_telepon;
        this.nama_pemilik = nama_pemilik;
        this.no_telepon_pemilik = no_telepon_pemilik;
        this.tanggal_daftar = tanggal_daftar;
        this.username = username;
        this.password = password;
        this.status = status;
        this.gambar_logo = gambar_logo;
        
        
    }

    public String get_id_mitra() {
        return id_mitra;
    }
    public void set_id_mitra(String id_mitra) {
        this.id_mitra = id_mitra;
    }

	public String get_nama_mitra() {
        return nama_mitra;
    }
    public void set_nama_mitra(String nama_mitra) {
        this.nama_mitra = nama_mitra;
    }

    public String get_alamat() {
        return alamat;
    }
    public void set_alamat(String alamat) {
        this.alamat = alamat;
    }

    public String get_no_telepon() {
        return no_telepon;
    }
    public void set_no_telepon(String no_telepon) {
        this.no_telepon = no_telepon;
    }

    public String get_nama_pemilik() {
        return nama_pemilik;
    }
    public void set_nama_pemilik(String nama_pemilik) {
        this.nama_pemilik = nama_pemilik;
    }

    public String get_no_telepon_pemilik() {
        return no_telepon_pemilik;
    }
    public void set_no_telepon_pemilik(String no_telepon_pemilik) {
        this.no_telepon_pemilik = no_telepon_pemilik;
    }

    public String get_tanggal_daftar() {
        return tanggal_daftar;
    }
    public void set_tanggal_daftar(String tanggal_daftar) {
        this.tanggal_daftar = tanggal_daftar;
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

    public String get_status() {
        return status;
    }
    public void set_status(String status) {
        this.status = status;
    }

    public String get_gambar_logo() {
        return gambar_logo;
    }
    public void set_gambar_logo(String gambar_logo) {
        this.gambar_logo = gambar_logo;
    }

    
    
    
}














