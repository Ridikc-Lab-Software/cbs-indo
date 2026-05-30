package com.project.aplikasi.petugas_cbs.data_voucher;



import android.os.Parcel;

import android.os.Parcelable;



import java.text.NumberFormat;

import java.text.ParseException;

import java.text.SimpleDateFormat;

import java.util.ArrayList; // Jangan lupa import ini

import java.util.Date;

import java.util.Locale;



public class data_voucher_apidata implements Parcelable {

    private String id_voucher;

    private String qrcode;

    private String id_relasi;

    private String nominal;

    private String tanggal_kadaluarsa;

    private String id_spbu;

    private String id_penjualan_voucher;

    private String status;

    private String file_voucher;

    private String tanggal_dibuka;



    private String platKendaraan;

    private boolean kadaluarsa;

    private String nama_member;

    private String nomor_telepon;



// --- TAMBAHAN BARU: LIST FOTO BUKTI --

    private ArrayList<String> listFotoBukti;

// --------------------------------------



// Getter & Setter List Foto

    public ArrayList<String> getListFotoBukti() {

        return listFotoBukti;

    }



    public void setListFotoBukti(ArrayList<String> listFotoBukti) {

        this.listFotoBukti = listFotoBukti;

    }



    public String getPlatKendaraan() {

        return platKendaraan;

    }



    public void setPlatKendaraan(String platKendaraan) {

        this.platKendaraan = platKendaraan;

    }



    public String getNama_member() {

        return nama_member;

    }



    public void setNama_member(String nama_member) {

        this.nama_member = nama_member;

    }



    public String getNomor_telepon() {

        return nomor_telepon;

    }



    public void setNomor_telepon(String nomor_telepon) {

        this.nomor_telepon = nomor_telepon;

    }



// Constructor Kosong (Opsional tapi berguna)

    public data_voucher_apidata() {}



// Constructor Lengkap (Lama)

    public data_voucher_apidata(String id_voucher, String qrcode, String id_relasi, String nominal, String tanggal_kadaluarsa, String id_spbu, String id_penjualan_voucher, String status, String file_voucher, String tanggal_dibuka, boolean kadaluarsa) {

        this.id_voucher = id_voucher;

        this.qrcode = qrcode;

        this.id_relasi = id_relasi;

        this.nominal = nominal;

        this.tanggal_kadaluarsa = tanggal_kadaluarsa;

        this.id_spbu = id_spbu;

        this.id_penjualan_voucher = id_penjualan_voucher;

        this.status = status;

        this.file_voucher = file_voucher;

        this.tanggal_dibuka = tanggal_dibuka;

        this.kadaluarsa = kadaluarsa;

    }



// Constructor lain (biarkan saja)

    public data_voucher_apidata(String id_voucher

            , String qrcode

            , String id_relasi

            , String nominal

            , String tanggal_kadaluarsa

            , String id_spbu

            , String id_penjualan_voucher

            , String status

            , String file_voucher

            , String tanggal_dibuka



    ) {

        this.id_voucher = id_voucher;

        this.qrcode = qrcode;

        this.id_relasi = id_relasi;

        this.nominal = nominal;

        this.tanggal_kadaluarsa = tanggal_kadaluarsa;

        this.id_spbu = id_spbu;

        this.id_penjualan_voucher = id_penjualan_voucher;

        this.status = status;

        this.file_voucher = file_voucher;

        this.tanggal_dibuka = tanggal_dibuka;

    }



// Constructor lain

    public data_voucher_apidata(String id_voucher, String qrcode, String id_relasi, String nominal, String tanggal_kadaluarsa, String id_spbu, String id_penjualan_voucher, String status, String file_voucher, String tanggal_dibuka, boolean kadaluarsa, String nama_member, String nomor_telepon) {

        this.id_voucher = id_voucher;

        this.qrcode = qrcode;

        this.id_relasi = id_relasi;

        this.nominal = nominal;

        this.tanggal_kadaluarsa = tanggal_kadaluarsa;

        this.id_spbu = id_spbu;

        this.id_penjualan_voucher = id_penjualan_voucher;

        this.status = status;

        this.file_voucher = file_voucher;

        this.tanggal_dibuka = tanggal_dibuka;

        this.kadaluarsa = kadaluarsa;

        this.nama_member = nama_member;

        this.nomor_telepon = nomor_telepon;

    }



    public boolean isKadaluarsa() {

        return kadaluarsa;

    }



    public void setKadaluarsa(boolean kadaluarsa) {

        this.kadaluarsa = kadaluarsa;

    }



// --- BAGIAN PENTING PARCELABLE ---

    protected data_voucher_apidata(Parcel in) {

        id_voucher = in.readString();

        qrcode = in.readString();

        id_relasi = in.readString();

        nominal = in.readString();

        tanggal_kadaluarsa = in.readString();

        id_spbu = in.readString();

        id_penjualan_voucher = in.readString();

        status = in.readString();

        file_voucher = in.readString();

        tanggal_dibuka = in.readString();



// Baca boolean (cara standar)

        kadaluarsa = in.readByte() != 0;



        nama_member = in.readString();

        nomor_telepon = in.readString();

        platKendaraan = in.readString();



// --- BACA LIST FOTO DI SINI ---

        listFotoBukti = in.createStringArrayList();

    }



    @Override

    public void writeToParcel(Parcel dest, int flags) {

        dest.writeString(id_voucher);

        dest.writeString(qrcode);

        dest.writeString(id_relasi);

        dest.writeString(nominal);

        dest.writeString(tanggal_kadaluarsa);

        dest.writeString(id_spbu);

        dest.writeString(id_penjualan_voucher);

        dest.writeString(status);

        dest.writeString(file_voucher);

        dest.writeString(tanggal_dibuka);



// Tulis boolean

        dest.writeByte((byte) (kadaluarsa ? 1 : 0));



        dest.writeString(nama_member);

        dest.writeString(nomor_telepon);

        dest.writeString(platKendaraan);



// --- TULIS LIST FOTO DI SINI ---

        dest.writeStringList(listFotoBukti);

    }

// ---------------------------------



    public static final Creator<data_voucher_apidata> CREATOR = new Creator<data_voucher_apidata>() {

        @Override

        public data_voucher_apidata createFromParcel(Parcel in) {

            return new data_voucher_apidata(in);

        }



        @Override

        public data_voucher_apidata[] newArray(int size) {

            return new data_voucher_apidata[size];

        }

    };



// ... Getter Setter Bawaan lainnya (tidak berubah) ...



    public String get_id_voucher() {

        return id_voucher;

    }



    public void set_id_voucher(String id_voucher) {

        this.id_voucher = id_voucher;

    }



    public String get_qrcode() {

        return qrcode;

    }



    public void set_qrcode(String qrcode) {

        this.qrcode = qrcode;

    }



    public String get_id_relasi() {

        return id_relasi;

    }



    public void set_id_relasi(String id_relasi) {

        this.id_relasi = id_relasi;

    }



    public String get_nominal() {

        return nominal;

    }



    public String get_nominal_rupiah() {

        Locale localeID = new Locale("in", "ID");

        NumberFormat formatRupiah;

        try {

            formatRupiah = NumberFormat.getCurrencyInstance(localeID);
            formatRupiah.setMaximumFractionDigits(0);

        } catch (Exception e) {

            formatRupiah = NumberFormat.getInstance();

        }

// Cegah crash jika nominal null/kosong

        if(nominal == null || nominal.isEmpty()) return "Rp 0";

        try {

            return formatRupiah.format((double) Integer.parseInt(nominal));

        } catch(NumberFormatException e) {

            return nominal;

        }

    }





    public void set_nominal(String nominal) {

        this.nominal = nominal;

    }



    public String get_tanggal_kadaluarsa() {

        return tanggal_kadaluarsa;

    }



    public String get_tanggal_kadaluarsa_indo() {

        SimpleDateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");

        SimpleDateFormat outputFormat = new SimpleDateFormat("dd MMMM yyyy", new Locale("id", "ID"));

        try {

            Date date = inputFormat.parse(tanggal_kadaluarsa);

            return outputFormat.format(date);

        } catch (ParseException e) {

            e.printStackTrace();

            return tanggal_kadaluarsa;

        }

    }
    public void set_tanggal_kadaluarsa(String tanggal_kadaluarsa) {
        this.tanggal_kadaluarsa = tanggal_kadaluarsa;
    }
    public String get_id_spbu() {
        return id_spbu;
    }
    public void set_id_spbu(String id_spbu) {
        this.id_spbu = id_spbu;
    }
    public String get_id_penjualan_voucher() {
        return id_penjualan_voucher;
    }
    public void set_id_penjualan_voucher(String id_penjualan_voucher) {
        this.id_penjualan_voucher = id_penjualan_voucher;
    }
    public String get_status() {
        return status;
    }
    public void set_status(String status) {
        this.status = status;
    }
    public String get_file_voucher() {
        return file_voucher;
    }
    public void set_file_voucher(String file_voucher) {
        this.file_voucher = file_voucher;
    }
    public String get_tanggal_dibuka() {
        return tanggal_dibuka;
    }
    public void set_tanggal_dibuka(String tanggal_dibuka) {
        this.tanggal_dibuka = tanggal_dibuka;
    }
    @Override
    public int describeContents() {
        return 0;
    }
}