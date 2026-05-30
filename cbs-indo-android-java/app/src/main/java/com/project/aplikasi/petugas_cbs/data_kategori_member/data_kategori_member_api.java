package com.project.aplikasi.petugas_cbs.data_kategori_member;

import java.util.ArrayList;

public class data_kategori_member_api {
    private ArrayList<data_kategori_member_apidata> result = null;
	private String status;					  
    public ArrayList<data_kategori_member_apidata> get_data_kategori_member() {
        return result;
    }
    public void set_data_kategori_member(ArrayList<data_kategori_member_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


