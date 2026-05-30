package com.project.aplikasi.petugas_cbs.data_transaksi;

import java.util.ArrayList;

public class data_transaksi_api {
    private ArrayList<data_transaksi_apidata> result = null;
	private String status;					  
    public ArrayList<data_transaksi_apidata> get_data_transaksi() {
        return result;
    }
    public void set_data_transaksi(ArrayList<data_transaksi_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


