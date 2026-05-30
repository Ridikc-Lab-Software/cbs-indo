package com.project.aplikasi.petugas_cbs.data_kategori_member;

public class data_kategori_member_apidata {
    private String id_kategori_member;
	private String kategori_member;
	private String gambar_logo;
	
	
	
	public data_kategori_member_apidata(String id_kategori_member
	, String kategori_member
	, String gambar_logo
	
	) {
        this.id_kategori_member = id_kategori_member;
		this.kategori_member = kategori_member;
        this.gambar_logo = gambar_logo;
        
    }

    public String get_id_kategori_member() {
        return id_kategori_member;
    }
    public void set_id_kategori_member(String id_kategori_member) {
        this.id_kategori_member = id_kategori_member;
    }

    public String get_kategori_member() {
        return kategori_member;
    }
    public void set_kategori_member(String kategori_member) {
        this.kategori_member = kategori_member;
    }
    public String get_gambar_logo() {
        return gambar_logo;
    }
    public void set_gambar_logo(String gambar_logo) {
        this.gambar_logo = gambar_logo;
    }
    
}







