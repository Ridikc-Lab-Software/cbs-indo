package com.project.aplikasi.petugas_cbs.data_promo_sqlite;

public class data_promo_sqlite_data {
    private String id_promo;
	private String tanggal_mulai_berlaku;
    private String tanggal_batas_berlaku;
    private String nama_promo;
    private String keterangan;
    private String syarat_dan_ketentuan;
    private String foto_promo;
    private String jumlah_point;
    private String status;
    

    public data_promo_sqlite_data() {
    }

    public data_promo_sqlite_data(String id_promo
	,String tanggal_mulai_berlaku
	,String tanggal_batas_berlaku
	,String nama_promo
	,String keterangan
	,String syarat_dan_ketentuan
	,String foto_promo
	,String jumlah_point
	,String status
	
	
	) {
        this.id_promo = id_promo;
		this.tanggal_mulai_berlaku = tanggal_mulai_berlaku;
        this.tanggal_batas_berlaku = tanggal_batas_berlaku;
        this.nama_promo = nama_promo;
        this.keterangan = keterangan;
        this.syarat_dan_ketentuan = syarat_dan_ketentuan;
        this.foto_promo = foto_promo;
        this.jumlah_point = jumlah_point;
        this.status = status;
        
        
    }

    public String get_id_promo() {
        return id_promo;
    }
    public void set_id_promo(String id_promo) {
        this.id_promo = id_promo;
    }

	public String get_tanggal_mulai_berlaku() {
        return tanggal_mulai_berlaku;
    }
    public void set_tanggal_mulai_berlaku(String tanggal_mulai_berlaku) {
        this.tanggal_mulai_berlaku = tanggal_mulai_berlaku;
    }

    public String get_tanggal_batas_berlaku() {
        return tanggal_batas_berlaku;
    }
    public void set_tanggal_batas_berlaku(String tanggal_batas_berlaku) {
        this.tanggal_batas_berlaku = tanggal_batas_berlaku;
    }

    public String get_nama_promo() {
        return nama_promo;
    }
    public void set_nama_promo(String nama_promo) {
        this.nama_promo = nama_promo;
    }

    public String get_keterangan() {
        return keterangan;
    }
    public void set_keterangan(String keterangan) {
        this.keterangan = keterangan;
    }

    public String get_syarat_dan_ketentuan() {
        return syarat_dan_ketentuan;
    }
    public void set_syarat_dan_ketentuan(String syarat_dan_ketentuan) {
        this.syarat_dan_ketentuan = syarat_dan_ketentuan;
    }

    public String get_foto_promo() {
        return foto_promo;
    }
    public void set_foto_promo(String foto_promo) {
        this.foto_promo = foto_promo;
    }

    public String get_jumlah_point() {
        return jumlah_point;
    }
    public void set_jumlah_point(String jumlah_point) {
        this.jumlah_point = jumlah_point;
    }

    public String get_status() {
        return status;
    }
    public void set_status(String status) {
        this.status = status;
    }

    
    
    
}














