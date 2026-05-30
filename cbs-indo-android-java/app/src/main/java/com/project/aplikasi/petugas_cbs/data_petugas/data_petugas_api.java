package com.project.aplikasi.petugas_cbs.data_petugas;

import java.util.ArrayList;

public class data_petugas_api {
    private ArrayList<data_petugas_apidata> result = null;
	private String status;					  
    public ArrayList<data_petugas_apidata> get_data_petugas() {
        return result;
    }
    public void set_data_petugas(ArrayList<data_petugas_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


