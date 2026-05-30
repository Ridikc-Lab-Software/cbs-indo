package com.project.aplikasi.petugas_cbs.data_galery_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_galery_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_galery";
    private static final String kolom_id_galery = "id_galery";
	private static final String kolom_tanggal = "tanggal";
    private static final String kolom_judul = "judul";
    private static final String kolom_foto = "foto";
    private static final String kolom_isi = "isi";
    

    public data_galery_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_galery + " TEXT " +
				"," + kolom_tanggal + " TEXT" +
                "," + kolom_judul + " TEXT" +
                "," + kolom_foto + " TEXT" +
                "," + kolom_isi + " TEXT" +
                
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
    public int get_data_galery_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_galery_sqlite_data>  get_data_galery_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_galery_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_galery_sqlite_data data_galery = new data_galery_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				
				);
                datalist.add(data_galery);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_galery_sqlite_data> get_semua_data_galery_sqlite(){
        List<data_galery_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_galery_sqlite_data data_galery = new data_galery_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				
				);
                datalist.add(data_galery);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_galery_sqlite(data_galery_sqlite_data data_galery){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_galery, data_galery.get_id_galery());
        values.put( kolom_tanggal, data_galery.get_tanggal());
        values.put( kolom_judul, data_galery.get_judul());
        values.put( kolom_foto, data_galery.get_foto());
        values.put( kolom_isi, data_galery.get_isi());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_galery_sqlite(data_galery_sqlite_data data_galery) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_tanggal, data_galery.get_tanggal());
        values.put( kolom_judul, data_galery.get_judul());
        values.put( kolom_foto, data_galery.get_foto());
        values.put( kolom_isi, data_galery.get_isi());
        
        return db.update( nama_tabel, values, kolom_id_galery + " = ?",
                new String[]{String.valueOf(data_galery.get_id_galery())});
    }

    // HAPUS DATA
    public void hapus_data_galery_sqlite(data_galery_sqlite_data data_galery) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_galery + " = ?",
                new String[]{String.valueOf(data_galery.get_id_galery())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_galery_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













