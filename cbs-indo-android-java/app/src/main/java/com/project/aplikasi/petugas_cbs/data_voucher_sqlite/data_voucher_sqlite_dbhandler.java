package com.project.aplikasi.petugas_cbs.data_voucher_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_voucher_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_namaaplikasi";
    private static final String nama_tabel = "data_voucher";
    private static final String kolom_id_voucher = "id_voucher";
    private static final String kolom_qrcode = "qrcode";
    private static final String kolom_id_relasi = "id_relasi";
    private static final String kolom_nominal = "nominal";
    private static final String kolom_tanggal_kadaluarsa = "tanggal_kadaluarsa";
    private static final String kolom_id_spbu = "id_spbu";
    private static final String kolom_id_penjualan_voucher = "id_penjualan_voucher";
    private static final String kolom_status = "status";
    private static final String kolom_file_voucher = "file_voucher";
    private static final String kolom_tanggal_dibuka = "tanggal_dibuka";


    public data_voucher_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_voucher + " TEXT " +
				"," + kolom_qrcode + " TEXT" +
				"," + kolom_id_relasi + " TEXT" +
				"," + kolom_nominal + " TEXT" +
				"," + kolom_tanggal_kadaluarsa + " TEXT" +
				"," + kolom_id_spbu + " TEXT" +
				"," + kolom_id_penjualan_voucher + " TEXT" +
				"," + kolom_status + " TEXT" +
				"," + kolom_file_voucher + " TEXT" +
				"," + kolom_tanggal_dibuka + " TEXT" +

                ")";
        db.execSQL(CREATE_USER_TABLE);
    }

    // CEK DATA
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + nama_tabel );
        onCreate(db);
    }

    // HITUNG DATA
    public int get_data_voucher_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_voucher_sqlite_data>  get_data_voucher_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_voucher_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_voucher_sqlite_data data_voucher = new data_voucher_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				,cursor.getString(9)

				);
                datalist.add(data_voucher);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_voucher_sqlite_data> get_semua_data_voucher_sqlite(){
        List<data_voucher_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_voucher_sqlite_data data_voucher = new data_voucher_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				,cursor.getString(9)

				);
                datalist.add(data_voucher);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_voucher_sqlite(data_voucher_sqlite_data data_voucher){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_voucher, data_voucher.get_id_voucher());
        values.put( kolom_qrcode, data_voucher.get_qrcode());
        values.put( kolom_id_relasi, data_voucher.get_id_relasi());
        values.put( kolom_nominal, data_voucher.get_nominal());
        values.put( kolom_tanggal_kadaluarsa, data_voucher.get_tanggal_kadaluarsa());
        values.put( kolom_id_spbu, data_voucher.get_id_spbu());
        values.put( kolom_id_penjualan_voucher, data_voucher.get_id_penjualan_voucher());
        values.put( kolom_status, data_voucher.get_status());
        values.put( kolom_file_voucher, data_voucher.get_file_voucher());
        values.put( kolom_tanggal_dibuka, data_voucher.get_tanggal_dibuka());

		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_voucher_sqlite(data_voucher_sqlite_data data_voucher) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_qrcode, data_voucher.get_qrcode());
        values.put( kolom_id_relasi, data_voucher.get_id_relasi());
        values.put( kolom_nominal, data_voucher.get_nominal());
        values.put( kolom_tanggal_kadaluarsa, data_voucher.get_tanggal_kadaluarsa());
        values.put( kolom_id_spbu, data_voucher.get_id_spbu());
        values.put( kolom_id_penjualan_voucher, data_voucher.get_id_penjualan_voucher());
        values.put( kolom_status, data_voucher.get_status());
        values.put( kolom_file_voucher, data_voucher.get_file_voucher());
        values.put( kolom_tanggal_dibuka, data_voucher.get_tanggal_dibuka());

        return db.update( nama_tabel, values, kolom_id_voucher + " = ?",
                new String[]{String.valueOf(data_voucher.get_id_voucher())});
    }

    // HAPUS DATA
    public void hapus_data_voucher_sqlite(data_voucher_sqlite_data data_voucher) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_voucher + " = ?",
                new String[]{String.valueOf(data_voucher.get_id_voucher())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_voucher_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}




