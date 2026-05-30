package com.project.aplikasi.petugas_cbs.data_jenis_transaksi;

import android.os.Parcel;
import android.os.Parcelable;

public class data_jenis_transaksi_apidata implements Parcelable {
    private String id_jenis_transaksi;
    private String jenis_transaksi;
    private String gambar_logo;
    private String point;
    private String harga;

    public data_jenis_transaksi_apidata(String id_jenis_transaksi, String jenis_transaksi, String gambar_logo) {
        this.id_jenis_transaksi = id_jenis_transaksi;
        this.jenis_transaksi = jenis_transaksi;
        this.gambar_logo = gambar_logo;
    }

    public data_jenis_transaksi_apidata(String id_jenis_transaksi, String jenis_transaksi, String gambar_logo, String point, String harga) {
        this.id_jenis_transaksi = id_jenis_transaksi;
        this.jenis_transaksi = jenis_transaksi;
        this.gambar_logo = gambar_logo;
        this.point = point;
        this.harga = harga;
    }

    protected data_jenis_transaksi_apidata(Parcel in) {
        id_jenis_transaksi = in.readString();
        jenis_transaksi = in.readString();
        gambar_logo = in.readString();
        point = in.readString();
        harga = in.readString();
    }

    public static final Creator<data_jenis_transaksi_apidata> CREATOR = new Creator<data_jenis_transaksi_apidata>() {
        @Override
        public data_jenis_transaksi_apidata createFromParcel(Parcel in) {
            return new data_jenis_transaksi_apidata(in);
        }

        @Override
        public data_jenis_transaksi_apidata[] newArray(int size) {
            return new data_jenis_transaksi_apidata[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(id_jenis_transaksi);
        dest.writeString(jenis_transaksi);
        dest.writeString(gambar_logo);
        dest.writeString(point);
        dest.writeString(harga);
    }

    public String get_id_jenis_transaksi() {
        return id_jenis_transaksi;
    }

    public void set_id_jenis_transaksi(String id_jenis_transaksi) {
        this.id_jenis_transaksi = id_jenis_transaksi;
    }

    public String get_jenis_transaksi() {
        return jenis_transaksi;
    }

    public void set_jenis_transaksi(String jenis_transaksi) {
        this.jenis_transaksi = jenis_transaksi;
    }

    public String get_gambar_logo() {
        return gambar_logo;
    }

    public void set_gambar_logo(String gambar_logo) {
        this.gambar_logo = gambar_logo;
    }

    public String get_point() {
        return point;
    }

    public void set_point(String point) {
        this.point = point;
    }

    public void set_harga(String harga) {
        this.harga = harga;
    }

    public String get_harga() {
        return harga;
    }
}
