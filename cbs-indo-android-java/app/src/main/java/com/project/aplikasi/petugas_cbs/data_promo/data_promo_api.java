package com.project.aplikasi.petugas_cbs.data_promo;

import java.util.ArrayList;

public class data_promo_api {
    private ArrayList<data_promo_apidata> result = null;
	private String status;					  
    public ArrayList<data_promo_apidata> get_data_promo() {
        return result;
    }
    public void set_data_promo(ArrayList<data_promo_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


