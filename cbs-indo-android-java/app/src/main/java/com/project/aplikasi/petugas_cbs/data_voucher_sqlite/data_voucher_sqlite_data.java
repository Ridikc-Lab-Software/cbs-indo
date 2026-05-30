package com.project.aplikasi.petugas_cbs.data_voucher_sqlite;

public class data_voucher_sqlite_data {
    private String id_voucher;
    private String qrcode;
    private String id_relasi;
    private String nominal;
    private String tanggal_kadaluarsa;
    private String id_spbu;
    private String id_penjualan_voucher;
    private String status;
    private String file_voucher;
    private String tanggal_dibuka;


    public data_voucher_sqlite_data() {
    }

    public data_voucher_sqlite_data(String id_voucher
    ,String qrcode
    ,String id_relasi
    ,String nominal
    ,String tanggal_kadaluarsa
    ,String id_spbu
    ,String id_penjualan_voucher
    ,String status
    ,String file_voucher
    ,String tanggal_dibuka

	
	) {
        this.id_voucher = id_voucher;
        this.qrcode = qrcode;
        this.id_relasi = id_relasi;
        this.nominal = nominal;
        this.tanggal_kadaluarsa = tanggal_kadaluarsa;
        this.id_spbu = id_spbu;
        this.id_penjualan_voucher = id_penjualan_voucher;
        this.status = status;
        this.file_voucher = file_voucher;
        this.tanggal_dibuka = tanggal_dibuka;

        
    }

    public String get_id_voucher() {
        return id_voucher;
    }
    public void set_id_voucher(String id_voucher) {
        this.id_voucher = id_voucher;
    }

public String get_qrcode() {
    return qrcode;
}
public void set_qrcode(String qrcode) {
    this.qrcode = qrcode;
}
public String get_id_relasi() {
    return id_relasi;
}
public void set_id_relasi(String id_relasi) {
    this.id_relasi = id_relasi;
}
public String get_nominal() {
    return nominal;
}
public void set_nominal(String nominal) {
    this.nominal = nominal;
}
public String get_tanggal_kadaluarsa() {
    return tanggal_kadaluarsa;
}
public void set_tanggal_kadaluarsa(String tanggal_kadaluarsa) {
    this.tanggal_kadaluarsa = tanggal_kadaluarsa;
}
public String get_id_spbu() {
    return id_spbu;
}
public void set_id_spbu(String id_spbu) {
    this.id_spbu = id_spbu;
}
public String get_id_penjualan_voucher() {
    return id_penjualan_voucher;
}
public void set_id_penjualan_voucher(String id_penjualan_voucher) {
    this.id_penjualan_voucher = id_penjualan_voucher;
}
public String get_status() {
    return status;
}
public void set_status(String status) {
    this.status = status;
}
public String get_file_voucher() {
    return file_voucher;
}
public void set_file_voucher(String file_voucher) {
    this.file_voucher = file_voucher;
}
public String get_tanggal_dibuka() {
    return tanggal_dibuka;
}
public void set_tanggal_dibuka(String tanggal_dibuka) {
    this.tanggal_dibuka = tanggal_dibuka;
}

    
    
}







