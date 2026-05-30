package com.project.aplikasi.petugas_cbs.data_pengaturan_voucher_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_pengaturan_voucher_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_namaaplikasi";
    private static final String nama_tabel = "data_pengaturan_voucher";
    private static final String kolom_id_pengaturan_voucher = "id_pengaturan_voucher";
    private static final String kolom_nama = "nama";
    private static final String kolom_isi = "isi";
    private static final String kolom_status = "status";


    public data_pengaturan_voucher_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_pengaturan_voucher + " TEXT " +
				"," + kolom_nama + " TEXT" +
				"," + kolom_isi + " TEXT" +
				"," + kolom_status + " TEXT" +

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
    public int get_data_pengaturan_voucher_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_pengaturan_voucher_sqlite_data>  get_data_pengaturan_voucher_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_pengaturan_voucher_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_pengaturan_voucher_sqlite_data data_pengaturan_voucher = new data_pengaturan_voucher_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)

				);
                datalist.add(data_pengaturan_voucher);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_pengaturan_voucher_sqlite_data> get_semua_data_pengaturan_voucher_sqlite(){
        List<data_pengaturan_voucher_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_pengaturan_voucher_sqlite_data data_pengaturan_voucher = new data_pengaturan_voucher_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)

				);
                datalist.add(data_pengaturan_voucher);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_pengaturan_voucher_sqlite(data_pengaturan_voucher_sqlite_data data_pengaturan_voucher){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_pengaturan_voucher, data_pengaturan_voucher.get_id_pengaturan_voucher());
        values.put( kolom_nama, data_pengaturan_voucher.get_nama());
        values.put( kolom_isi, data_pengaturan_voucher.get_isi());
        values.put( kolom_status, data_pengaturan_voucher.get_status());

		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_pengaturan_voucher_sqlite(data_pengaturan_voucher_sqlite_data data_pengaturan_voucher) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_nama, data_pengaturan_voucher.get_nama());
        values.put( kolom_isi, data_pengaturan_voucher.get_isi());
        values.put( kolom_status, data_pengaturan_voucher.get_status());

        return db.update( nama_tabel, values, kolom_id_pengaturan_voucher + " = ?",
                new String[]{String.valueOf(data_pengaturan_voucher.get_id_pengaturan_voucher())});
    }

    // HAPUS DATA
    public void hapus_data_pengaturan_voucher_sqlite(data_pengaturan_voucher_sqlite_data data_pengaturan_voucher) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_pengaturan_voucher + " = ?",
                new String[]{String.valueOf(data_pengaturan_voucher.get_id_pengaturan_voucher())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_pengaturan_voucher_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}




