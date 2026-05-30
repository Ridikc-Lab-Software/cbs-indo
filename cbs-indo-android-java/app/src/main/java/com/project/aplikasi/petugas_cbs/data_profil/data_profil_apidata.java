package com.project.aplikasi.petugas_cbs.data_profil;

public class data_profil_apidata {
    private String id_profil;
	private String nama;
	private String alamat;
	private String no_telepon;
	private String sejarah;
	private String visi;
	private String misi;
	private String deskripsi;
	private String foto;
	
	
	
	public data_profil_apidata(String id_profil
	, String nama
	, String alamat
	, String no_telepon
	, String sejarah
	, String visi
	, String misi
	, String deskripsi
	, String foto
	
	) {
        this.id_profil = id_profil;
		this.nama = nama;
        this.alamat = alamat;
        this.no_telepon = no_telepon;
        this.sejarah = sejarah;
        this.visi = visi;
        this.misi = misi;
        this.deskripsi = deskripsi;
        this.foto = foto;
        
    }

    public String get_id_profil() {
        return id_profil;
    }
    public void set_id_profil(String id_profil) {
        this.id_profil = id_profil;
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
    public String get_sejarah() {
        return sejarah;
    }
    public void set_sejarah(String sejarah) {
        this.sejarah = sejarah;
    }
    public String get_visi() {
        return visi;
    }
    public void set_visi(String visi) {
        this.visi = visi;
    }
    public String get_misi() {
        return misi;
    }
    public void set_misi(String misi) {
        this.misi = misi;
    }
    public String get_deskripsi() {
        return deskripsi;
    }
    public void set_deskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }
    public String get_foto() {
        return foto;
    }
    public void set_foto(String foto) {
        this.foto = foto;
    }
    
}







