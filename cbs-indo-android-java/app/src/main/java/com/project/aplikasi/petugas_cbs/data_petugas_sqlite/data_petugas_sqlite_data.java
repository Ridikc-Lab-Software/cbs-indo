package com.project.aplikasi.petugas_cbs.data_petugas_sqlite;

public class data_petugas_sqlite_data {
    private String id_petugas;
	private String nama;
    private String alamat;
    private String no_telepon;
    private String jenis_kelamin;
    private String username;
    private String password;
    

    public data_petugas_sqlite_data() {
    }

    public data_petugas_sqlite_data(String id_petugas
	,String nama
	,String alamat
	,String no_telepon
	,String jenis_kelamin
	,String username
	,String password
	
	
	) {
        this.id_petugas = id_petugas;
		this.nama = nama;
        this.alamat = alamat;
        this.no_telepon = no_telepon;
        this.jenis_kelamin = jenis_kelamin;
        this.username = username;
        this.password = password;
        
        
    }

    public String get_id_petugas() {
        return id_petugas;
    }
    public void set_id_petugas(String id_petugas) {
        this.id_petugas = id_petugas;
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














