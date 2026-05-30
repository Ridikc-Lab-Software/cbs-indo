package com.project.aplikasi.petugas_cbs.combobox_data_supir;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class combobox_data_supir_api {

    @SerializedName("status")
    @Expose
    private String status;

    @SerializedName("result")
    @Expose
    private List<combobox_data_supir_apidata> comboBoxApiData = null;

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public List<combobox_data_supir_apidata> getComboBoxApiData() {
        return comboBoxApiData;
    }

    public void setComboBoxApiData(List<combobox_data_supir_apidata> comboBoxApiData) {
        this.comboBoxApiData = comboBoxApiData;
    }
}
