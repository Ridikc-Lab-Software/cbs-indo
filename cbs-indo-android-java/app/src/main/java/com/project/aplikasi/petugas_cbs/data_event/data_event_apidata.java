package com.project.aplikasi.petugas_cbs.data_event;

public class data_event_apidata {
    private String id_event;
	private String tanggal;
	private String judul;
	private String foto;
	private String isi;
	
	
	
	public data_event_apidata(String id_event
	, String tanggal
	, String judul
	, String foto
	, String isi
	
	) {
        this.id_event = id_event;
		this.tanggal = tanggal;
        this.judul = judul;
        this.foto = foto;
        this.isi = isi;
        
    }

    public String get_id_event() {
        return id_event;
    }
    public void set_id_event(String id_event) {
        this.id_event = id_event;
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







