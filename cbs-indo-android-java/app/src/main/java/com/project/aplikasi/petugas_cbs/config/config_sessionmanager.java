package com.project.aplikasi.petugas_cbs.config;

import android.content.Context;
import android.content.SharedPreferences;

public class config_sessionmanager {

    public static final String SP_APP = "app";
    public static final String SP_NAMA = "nama";
    public static final String SP_TOKEN = "email";
    public static final String SP_ID = "id_pegawai";
    public static final String SP_PRINTER = "printer";
    public static final String SP_JABATAN = "jabatan";
    public static final String SP_SPBU = "spbu";
    public static final String SP_ALAMAT1 = "alamat1";
    public static final String SP_ALAMAT2 = "alamat2";
    public static final String SP_TELEPON = "telepon";
    public static final String SP_PENUTUP = "penutup";

    public static final String SP_SUDAH_LOGIN = "sudahlogin";
    public static final int view_error = 0;
    public static final String NOMOR_SPBU = "24.373.27";
    public static final String ALAMAT_SPBU = "Sarolangun";


    SharedPreferences sp;
    SharedPreferences.Editor spEditor;

    public config_sessionmanager(Context context) {
        sp = context.getSharedPreferences(SP_APP, Context.MODE_PRIVATE);
        spEditor = sp.edit();
    }

    public void saveSPString(String keySP, String value) {
        spEditor.putString(keySP, value);
        spEditor.commit();
    }

    public void saveSPInt(String keySP, int value) {
        spEditor.putInt(keySP, value);
        spEditor.commit();
    }

    public void saveSPBoolean(String keySP, boolean value) {
        spEditor.putBoolean(keySP, value);
        spEditor.commit();
    }

    public String getSPNama() {
        return sp.getString(SP_NAMA, "");
    }

    public String getSPToken() {
        return sp.getString(SP_TOKEN, "");
    }

    public Boolean getSPSudahLogin() {
        return sp.getBoolean(SP_SUDAH_LOGIN, false);
    }

    public String getSPId(){
        return sp.getString(SP_ID, "");
    }

    public String getSPJabatan(){
        return sp.getString(SP_JABATAN, "");
    }


    public String getPRINT(){
        return sp.getString(SP_PRINTER, "");
    }


    public String getSPBU(){
        return sp.getString(SP_SPBU, "");
    }
    public String getAlamat1(){
        return sp.getString(SP_ALAMAT1, "");
    }
    public String getAlamat2(){
        return sp.getString(SP_ALAMAT2, "");
    }
    public String getTelepon(){
        return sp.getString(SP_TELEPON, "");
    }
    public String getSpPenutup(){ return sp.getString(SP_PENUTUP, ""); }


    public void logOut(){
        saveSPString(SP_NAMA, "");
        saveSPString(SP_TOKEN, "");
        saveSPString(SP_ID, "");
        saveSPString(SP_JABATAN, "");
        saveSPBoolean(SP_SUDAH_LOGIN, false);
    }
}