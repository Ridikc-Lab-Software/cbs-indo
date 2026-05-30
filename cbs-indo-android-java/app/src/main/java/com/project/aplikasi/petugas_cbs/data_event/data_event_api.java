package com.project.aplikasi.petugas_cbs.data_event;

import java.util.ArrayList;

public class data_event_api {
    private ArrayList<data_event_apidata> result = null;
	private String status;					  
    public ArrayList<data_event_apidata> get_data_event() {
        return result;
    }
    public void set_data_event(ArrayList<data_event_apidata> result) {
        this.result = result;
    }
	public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}


