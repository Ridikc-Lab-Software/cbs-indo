package com.project.aplikasi.petugas_cbs.data_penjualan_voucher_sqlite;

public class data_penjualan_voucher_sqlite_data {
    private String id_penjualan_voucher;
    private String tanggal_penjualan;
    private String id_relasi;
    private String jumlah_voucher;
    private String nominal;
    private String password_voucher;
    private String tanggal_dibuka;


    public data_penjualan_voucher_sqlite_data() {
    }

    public data_penjualan_voucher_sqlite_data(String id_penjualan_voucher
    ,String tanggal_penjualan
    ,String id_relasi
    ,String jumlah_voucher
    ,String nominal
    ,String password_voucher
    ,String tanggal_dibuka

	
	) {
        this.id_penjualan_voucher = id_penjualan_voucher;
        this.tanggal_penjualan = tanggal_penjualan;
        this.id_relasi = id_relasi;
        this.jumlah_voucher = jumlah_voucher;
        this.nominal = nominal;
        this.password_voucher = password_voucher;
        this.tanggal_dibuka = tanggal_dibuka;

        
    }

    public String get_id_penjualan_voucher() {
        return id_penjualan_voucher;
    }
    public void set_id_penjualan_voucher(String id_penjualan_voucher) {
        this.id_penjualan_voucher = id_penjualan_voucher;
    }

public String get_tanggal_penjualan() {
    return tanggal_penjualan;
}
public void set_tanggal_penjualan(String tanggal_penjualan) {
    this.tanggal_penjualan = tanggal_penjualan;
}
public String get_id_relasi() {
    return id_relasi;
}
public void set_id_relasi(String id_relasi) {
    this.id_relasi = id_relasi;
}
public String get_jumlah_voucher() {
    return jumlah_voucher;
}
public void set_jumlah_voucher(String jumlah_voucher) {
    this.jumlah_voucher = jumlah_voucher;
}
public String get_nominal() {
    return nominal;
}
public void set_nominal(String nominal) {
    this.nominal = nominal;
}
public String get_password_voucher() {
    return password_voucher;
}
public void set_password_voucher(String password_voucher) {
    this.password_voucher = password_voucher;
}
public String get_tanggal_dibuka() {
    return tanggal_dibuka;
}
public void set_tanggal_dibuka(String tanggal_dibuka) {
    this.tanggal_dibuka = tanggal_dibuka;
}

    
    
}







