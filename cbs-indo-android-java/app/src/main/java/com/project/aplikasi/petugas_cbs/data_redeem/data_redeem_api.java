package com.project.aplikasi.petugas_cbs.data_redeem;

import java.util.ArrayList;

public class data_redeem_api {
    private ArrayList<data_redeem_apidata> result = null;
	private String status;					  
    public ArrayList<data_redeem_apidata> get_data_redeem() {
        return result;
    }
    public void set_data_redeem(ArrayList<data_redeem_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


