package com.project.aplikasi.petugas_cbs.combobox_data_supir;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class combobox_data_supir_apidata {

    @SerializedName("id_supir")
    @Expose
    private String id_supir;

    @SerializedName("nama_supir")
    @Expose
    private String nama_supir;

    @SerializedName("id_relasi")
    @Expose
    private String id_relasi;

    public String getId_supir() {
        return id_supir;
    }

    public void setId_supir(String id_supir) {
        this.id_supir = id_supir;
    }

    public String getNama_supir() {
        return nama_supir;
    }

    public void setNama_supir(String nama_supir) {
        this.nama_supir = nama_supir;
    }

    public String getId_relasi() {
        return id_relasi;
    }

    public void setId_relasi(String id_relasi) {
        this.id_relasi = id_relasi;
    }
}