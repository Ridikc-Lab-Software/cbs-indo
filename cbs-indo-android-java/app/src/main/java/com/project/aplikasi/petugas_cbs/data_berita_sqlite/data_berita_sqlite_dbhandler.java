package com.project.aplikasi.petugas_cbs.data_berita_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_berita_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_berita";
    private static final String kolom_id_berita = "id_berita";
	private static final String kolom_tanggal = "tanggal";
    private static final String kolom_judul = "judul";
    private static final String kolom_foto = "foto";
    private static final String kolom_isi = "isi";
    

    public data_berita_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_berita + " TEXT " +
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
    public int get_data_berita_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_berita_sqlite_data>  get_data_berita_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_berita_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_berita_sqlite_data data_berita = new data_berita_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				
				);
                datalist.add(data_berita);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_berita_sqlite_data> get_semua_data_berita_sqlite(){
        List<data_berita_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_berita_sqlite_data data_berita = new data_berita_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				
				);
                datalist.add(data_berita);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_berita_sqlite(data_berita_sqlite_data data_berita){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_berita, data_berita.get_id_berita());
        values.put( kolom_tanggal, data_berita.get_tanggal());
        values.put( kolom_judul, data_berita.get_judul());
        values.put( kolom_foto, data_berita.get_foto());
        values.put( kolom_isi, data_berita.get_isi());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_berita_sqlite(data_berita_sqlite_data data_berita) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_tanggal, data_berita.get_tanggal());
        values.put( kolom_judul, data_berita.get_judul());
        values.put( kolom_foto, data_berita.get_foto());
        values.put( kolom_isi, data_berita.get_isi());
        
        return db.update( nama_tabel, values, kolom_id_berita + " = ?",
                new String[]{String.valueOf(data_berita.get_id_berita())});
    }

    // HAPUS DATA
    public void hapus_data_berita_sqlite(data_berita_sqlite_data data_berita) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_berita + " = ?",
                new String[]{String.valueOf(data_berita.get_id_berita())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_berita_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













