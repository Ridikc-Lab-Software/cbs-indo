package com.project.aplikasi.petugas_cbs.data_penjualan_voucher;

import java.util.ArrayList;

public class data_penjualan_voucher_api {
    private ArrayList<data_penjualan_voucher_apidata> result = null;
	private String status;					  
    public ArrayList<data_penjualan_voucher_apidata> get_data_penjualan_voucher() {
        return result;
    }
    public void set_data_penjualan_voucher(ArrayList<data_penjualan_voucher_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
