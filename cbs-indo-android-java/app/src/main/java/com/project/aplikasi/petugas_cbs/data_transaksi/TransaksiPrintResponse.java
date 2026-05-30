    package com.project.aplikasi.petugas_cbs.data_transaksi;

    import com.google.gson.annotations.SerializedName;

    public class TransaksiPrintResponse {
        @SerializedName("receipt_text")
        private String receipt_text;

        public String getReceipt_text() {
            return receipt_text;
        }

        private String logo;

        public String getLogo() {
            return logo;
        }

        public void setLogo(String logo) {
            this.logo = logo;
        }
    }
