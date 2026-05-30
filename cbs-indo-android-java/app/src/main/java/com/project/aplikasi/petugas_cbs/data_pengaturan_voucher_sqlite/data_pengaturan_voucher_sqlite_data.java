package com.project.aplikasi.petugas_cbs.data_pengaturan_voucher_sqlite;

public class data_pengaturan_voucher_sqlite_data {
    private String id_pengaturan_voucher;
    private String nama;
    private String isi;
    private String status;


    public data_pengaturan_voucher_sqlite_data() {
    }

    public data_pengaturan_voucher_sqlite_data(String id_pengaturan_voucher
    ,String nama
    ,String isi
    ,String status

	
	) {
        this.id_pengaturan_voucher = id_pengaturan_voucher;
        this.nama = nama;
        this.isi = isi;
        this.status = status;

        
    }

    public String get_id_pengaturan_voucher() {
        return id_pengaturan_voucher;
    }
    public void set_id_pengaturan_voucher(String id_pengaturan_voucher) {
        this.id_pengaturan_voucher = id_pengaturan_voucher;
    }

public String get_nama() {
    return nama;
}
public void set_nama(String nama) {
    this.nama = nama;
}
public String get_isi() {
    return isi;
}
public void set_isi(String isi) {
    this.isi = isi;
}
public String get_status() {
    return status;
}
public void set_status(String status) {
    this.status = status;
}

    
    
}







