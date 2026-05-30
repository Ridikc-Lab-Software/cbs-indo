package com.project.aplikasi.petugas_cbs.data_redeem;

import com.google.gson.annotations.SerializedName;

public class RedeemPrintResponse {
    @SerializedName("status")
    private String status;

    @SerializedName("receipt_text")
    private String receipt_text;

    @SerializedName("logo")
    private String logo; // Menangkap "pertamina" atau "cbs" dari PHP

    public String getStatus() {
        return status;
    }

    public String getReceipt_text() {
        return receipt_text;
    }

    public String getLogo() {
        return logo;
    }
}