package com.project.aplikasi.petugas_cbs.data_mitra;

import java.util.ArrayList;

public class data_mitra_api {
    private ArrayList<data_mitra_apidata> result = null;
	private String status;					  
    public ArrayList<data_mitra_apidata> get_data_mitra() {
        return result;
    }
    public void set_data_mitra(ArrayList<data_mitra_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


