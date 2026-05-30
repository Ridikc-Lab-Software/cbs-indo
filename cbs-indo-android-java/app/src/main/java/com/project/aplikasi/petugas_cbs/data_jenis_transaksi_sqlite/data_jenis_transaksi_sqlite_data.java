package com.project.aplikasi.petugas_cbs.data_jenis_transaksi_sqlite;

public class data_jenis_transaksi_sqlite_data {
    private String id_jenis_transaksi;
	private String jenis_transaksi;
    private String gambar_logo;
    

    public data_jenis_transaksi_sqlite_data() {
    }

    public data_jenis_transaksi_sqlite_data(String id_jenis_transaksi
	,String jenis_transaksi
	,String gambar_logo
	
	
	) {
        this.id_jenis_transaksi = id_jenis_transaksi;
		this.jenis_transaksi = jenis_transaksi;
        this.gambar_logo = gambar_logo;
        
        
    }

    public String get_id_jenis_transaksi() {
        return id_jenis_transaksi;
    }
    public void set_id_jenis_transaksi(String id_jenis_transaksi) {
        this.id_jenis_transaksi = id_jenis_transaksi;
    }

	public String get_jenis_transaksi() {
        return jenis_transaksi;
    }
    public void set_jenis_transaksi(String jenis_transaksi) {
        this.jenis_transaksi = jenis_transaksi;
    }

    public String get_gambar_logo() {
        return gambar_logo;
    }
    public void set_gambar_logo(String gambar_logo) {
        this.gambar_logo = gambar_logo;
    }

    
    
    
}














