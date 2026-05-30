package com.project.aplikasi.petugas_cbs.data_relasi;

import java.util.ArrayList;

public class data_relasi_api {
    private ArrayList<data_relasi_apidata> result = null;
	private String status;					  
    public ArrayList<data_relasi_apidata> get_data_relasi() {
        return result;
    }
    public void set_data_relasi(ArrayList<data_relasi_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
