package com.project.aplikasi.petugas_cbs.data_relasi_sqlite;

public class data_relasi_sqlite_data {
    private String id_relasi;
    private String nama;
    private String nomor_telepon;
    private String email;
    private String alamat;
    private String id_spbu;
    private String nama_spbu;
    private String password;


    public data_relasi_sqlite_data() {
    }

    public data_relasi_sqlite_data(String id_relasi
    ,String nama
    ,String nomor_telepon
    ,String email
    ,String alamat
    ,String id_spbu
    ,String nama_spbu
    ,String password

	
	) {
        this.id_relasi = id_relasi;
        this.nama = nama;
        this.nomor_telepon = nomor_telepon;
        this.email = email;
        this.alamat = alamat;
        this.id_spbu = id_spbu;
        this.nama_spbu = nama_spbu;
        this.password = password;

        
    }

    public String get_id_relasi() {
        return id_relasi;
    }
    public void set_id_relasi(String id_relasi) {
        this.id_relasi = id_relasi;
    }

public String get_nama() {
    return nama;
}
public void set_nama(String nama) {
    this.nama = nama;
}
public String get_nomor_telepon() {
    return nomor_telepon;
}
public void set_nomor_telepon(String nomor_telepon) {
    this.nomor_telepon = nomor_telepon;
}
public String get_email() {
    return email;
}
public void set_email(String email) {
    this.email = email;
}
public String get_alamat() {
    return alamat;
}
public void set_alamat(String alamat) {
    this.alamat = alamat;
}
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
public String get_password() {
    return password;
}
public void set_password(String password) {
    this.password = password;
}

    
    
}







