package com.project.aplikasi.petugas_cbs.data_member_sqlite;

public class data_member_sqlite_data {
    private String id_member;
	private String nama;
    private String alamat;
    private String no_telepon;
    private String jenis_kelamin;
    private String tanggal_terdaftar;
    private String id_kategori_member;
    private String kode_rfid;
    private String point;
    private String username;
    private String password;
    

    public data_member_sqlite_data() {
    }

    public data_member_sqlite_data(String id_member
	,String nama
	,String alamat
	,String no_telepon
	,String jenis_kelamin
	,String tanggal_terdaftar
	,String id_kategori_member
	,String kode_rfid
	,String point
	,String username
	,String password
	
	
	) {
        this.id_member = id_member;
		this.nama = nama;
        this.alamat = alamat;
        this.no_telepon = no_telepon;
        this.jenis_kelamin = jenis_kelamin;
        this.tanggal_terdaftar = tanggal_terdaftar;
        this.id_kategori_member = id_kategori_member;
        this.kode_rfid = kode_rfid;
        this.point = point;
        this.username = username;
        this.password = password;
        
        
    }

    public String get_id_member() {
        return id_member;
    }
    public void set_id_member(String id_member) {
        this.id_member = id_member;
    }

	public String get_nama() {
        return nama;
    }
    public void set_nama(String nama) {
        this.nama = nama;
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

    public String get_jenis_kelamin() {
        return jenis_kelamin;
    }
    public void set_jenis_kelamin(String jenis_kelamin) {
        this.jenis_kelamin = jenis_kelamin;
    }

    public String get_tanggal_terdaftar() {
        return tanggal_terdaftar;
    }
    public void set_tanggal_terdaftar(String tanggal_terdaftar) {
        this.tanggal_terdaftar = tanggal_terdaftar;
    }

    public String get_id_kategori_member() {
        return id_kategori_member;
    }
    public void set_id_kategori_member(String id_kategori_member) {
        this.id_kategori_member = id_kategori_member;
    }

    public String get_kode_rfid() {
        return kode_rfid;
    }
    public void set_kode_rfid(String kode_rfid) {
        this.kode_rfid = kode_rfid;
    }

    public String get_point() {
        return point;
    }
    public void set_point(String point) {
        this.point = point;
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

    
    
    
}














