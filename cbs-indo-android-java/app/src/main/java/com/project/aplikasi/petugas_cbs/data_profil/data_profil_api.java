package com.project.aplikasi.petugas_cbs.data_profil;

import java.util.ArrayList;

public class data_profil_api {
    private ArrayList<data_profil_apidata> result = null;
	private String status;					  
    public ArrayList<data_profil_apidata> get_data_profil() {
        return result;
    }
    public void set_data_profil(ArrayList<data_profil_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


