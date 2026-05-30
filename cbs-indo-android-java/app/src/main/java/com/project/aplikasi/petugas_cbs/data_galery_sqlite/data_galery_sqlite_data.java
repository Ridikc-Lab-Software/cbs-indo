package com.project.aplikasi.petugas_cbs.data_galery_sqlite;

public class data_galery_sqlite_data {
    private String id_galery;
	private String tanggal;
    private String judul;
    private String foto;
    private String isi;
    

    public data_galery_sqlite_data() {
    }

    public data_galery_sqlite_data(String id_galery
	,String tanggal
	,String judul
	,String foto
	,String isi
	
	
	) {
        this.id_galery = id_galery;
		this.tanggal = tanggal;
        this.judul = judul;
        this.foto = foto;
        this.isi = isi;
        
        
    }

    public String get_id_galery() {
        return id_galery;
    }
    public void set_id_galery(String id_galery) {
        this.id_galery = id_galery;
    }

	public String get_tanggal() {
        return tanggal;
    }
    public void set_tanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String get_judul() {
        return judul;
    }
    public void set_judul(String judul) {
        this.judul = judul;
    }

    public String get_foto() {
        return foto;
    }
    public void set_foto(String foto) {
        this.foto = foto;
    }

    public String get_isi() {
        return isi;
    }
    public void set_isi(String isi) {
        this.isi = isi;
    }

    
    
    
}














