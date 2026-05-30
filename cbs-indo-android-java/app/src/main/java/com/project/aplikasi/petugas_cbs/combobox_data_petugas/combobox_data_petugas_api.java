
package com.project.aplikasi.petugas_cbs.combobox_data_petugas;

import java.util.List;
import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class combobox_data_petugas_api {

    @SerializedName("status")
    @Expose
    private String status;
    @SerializedName("result")
    @Expose
    private List<combobox_data_petugas_apidata> comboBoxApiData = null;
    public String getStatus() {
        return status;
    }
    public void setStatus(String status) {
        this.status = status;
    }
    public List<combobox_data_petugas_apidata> getComboBoxApiData() {
        return comboBoxApiData;
    }
    public void setComboBoxApiData(List<combobox_data_petugas_apidata> comboBoxApiData) {
        this.comboBoxApiData = comboBoxApiData;
    }

}


