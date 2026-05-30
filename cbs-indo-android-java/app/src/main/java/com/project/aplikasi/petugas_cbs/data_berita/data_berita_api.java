package com.project.aplikasi.petugas_cbs.data_berita;

import java.util.ArrayList;

public class data_berita_api {
    private ArrayList<data_berita_apidata> result = null;
	private String status;					  
    public ArrayList<data_berita_apidata> get_data_berita() {
        return result;
    }
    public void set_data_berita(ArrayList<data_berita_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


