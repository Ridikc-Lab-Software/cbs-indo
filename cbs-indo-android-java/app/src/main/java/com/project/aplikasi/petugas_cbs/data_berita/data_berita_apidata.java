package com.project.aplikasi.petugas_cbs.data_berita;

public class data_berita_apidata {
    private String id_berita;
	private String tanggal;
	private String judul;
	private String foto;
	private String isi;
	
	
	
	public data_berita_apidata(String id_berita
	, String tanggal
	, String judul
	, String foto
	, String isi
	
	) {
        this.id_berita = id_berita;
		this.tanggal = tanggal;
        this.judul = judul;
        this.foto = foto;
        this.isi = isi;
        
    }

    public String get_id_berita() {
        return id_berita;
    }
    public void set_id_berita(String id_berita) {
        this.id_berita = id_berita;
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







